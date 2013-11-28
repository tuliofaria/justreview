var casper = require('casper').create(
	{
		verbose: false, 
		logLevel: 'debug',
		pageSettings: {
	        loadImages:  false,        // The WebPage instance used by Casper will
	        //loadPlugins: false         // use these settings
	    	},
	    clientScripts:  [
        	'jquery.js',      // These two scripts will be injected in remote
    	],
	}
);
var utils = require('utils');

if(!casper.cli.has(0)){
	casper.echo("Passe a expressao de busca apos o nome do script.");	
	casper.exit();
}

var searchExpression = casper.cli.get(0);

casper.echo("Preparando para iniciar busca na RBIE: ");
casper.echo("   "+searchExpression);


casper.start('http://www.br-ie.org/pub/index.php/rbie/search');

casper.thenEvaluate(function(e){
	document.querySelector('input[name="query"]').setAttribute('value', e);
	document.querySelector('input[value="Pesquisar"]').click();
}, searchExpression);

var currentItem = -1;
var allItens = [];
var urls = [];

casper.then(function(){
	this.echo(this.getTitle());

	var links = this.evaluate(function() {
		var linkss = [];
		$("table.listing tr").each(function(){
			//linkss.push({teste: 1});
			if($(this).attr("valign")=="top"){
			   var titulo = $(this).find("td:eq(1)").html();
			   var url = $(this).find("td:eq(2)").find("a").attr("href");
			   linkss.push({ titulo: titulo, url: url });
			   //console.log(titulo+"\n"+url);
			}
		});
		return linkss;
	});
	urls = links;
});

function craw(){
	casper.echo("C: "+currentItem+"/"+urls.length+"/"+urls[currentItem+1]+"/");
	currentItem++;
	if(currentItem<urls.length){
		casper.open(urls[currentItem].url);
		casper.then(function(){
			var metas = this.evaluate(function() {
				var m = [];
				$("meta").each(function(){
					m.push({ name: $(this).attr("name"), value: $(this).attr("content") });
				});
				return m;
			});
			var citation = "";
			metas.forEach(function(item, key){
				if(item.name=="DC.Description"){
					citation = item.value;
				}
			})

			var paper = {
				url: urls[currentItem].url,
				abstract: citation,
				metas: metas
			};
			allItens.push(paper);
		});
		casper.then(craw);
	}
}
casper.then(craw);

casper.then(function(){
	//salvando...

	var currentTime = new Date();
	var month = currentTime.getMonth() + 1;
	var day = currentTime.getDate();
	var year = currentTime.getFullYear();
	var myfile = "rbie-data-"+year + "-" + month + "-" + day+".json";

	var fs = require('fs');
	fs.write(myfile, utils.serialize(allItens), 'w');
});

casper.run();