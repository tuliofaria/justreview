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

casper.echo("Preparando para iniciar busca na ACM Digital Library: ");
casper.echo("   "+searchExpression);


casper.start('http://dl.acm.org/');
/*casper.then(function(){
	this.click('a[href^="advsearch"]');
});*/
/*
casper.thenEvaluate(function(e){
	document.querySelector('input[name="allofem"]').setAttribute('value', e);
	document.querySelector('form').submit();
}, '"classroom system"');
*/
casper.thenEvaluate(function(e){
	document.querySelector('input[name="query"]').setAttribute('value', e);
	document.querySelector('form').submit();
}, searchExpression);

var linksCitation = [];
//var linksss = [];
function craw(){
	this.echo(this.getTitle());
	var links = this.evaluate(function() {
		var links = [];
		Array.prototype.forEach.call(__utils__.findAll('a'), function(e) {
			var href = e.getAttribute('href');
			if ((href!="")&&(href.match(/(citation\.cfm.*)/))) {
				links.push(e.getAttribute('href'));
			}
			//linksss.push(e);
		});
		return links;
	});
	console.log("Size: "+linksCitation.length+"/"+links.length);
	linksCitation = linksCitation.concat(links);

	var linkNext = this.evaluate(function() {
		return $("a:contains('next')").attr("href");
		//return links;
	});
	
	if(linkNext.match(/(results\.cfm.*)/)){
		console.log("==");
		casper.open("http://dl.acm.org/"+linkNext);
		casper.then(craw);
	}

	//console.log(linkNext);
	//linksss.push(linka);


}
casper.then(craw);

var currentItem = 0;

var foundPapers = [];

function getAndSaveCitation(){
	console.log("====>>> "+this.getTitle()+" <<====");
	var citation = this.evaluate(function() {
		return $("a[name='abstract']").parent().next().find('div').html();//$("a[name='abstract']").parent().next().html();
		//return links;
	});
	//console.log(citation);
	//console.log("==========");
	
	var metas = this.evaluate(function() {
		var m = [];
		$("meta").each(function(){
			m.push({ name: $(this).attr("name"), value: $(this).attr("content") });
		});
		return m;
	});

	var paper = {
		url: linksCitation[currentItem],
		abstract: citation,
		metas: metas
	};
	//console.log(utils.serialize(paper));
	foundPapers.push(paper);

	/*metas.forEach(function(item){
	 	console.log(item.name+"::"+item.value);
	});*/
	//console.log(metas);

	if(currentItem<linksCitation.length){
		currentItem++;
		casper.open("http://dl.acm.org/"+linksCitation[currentItem]+"&preflayout=flat");
		casper.then(getAndSaveCitation);
	}
}

casper.then(function(){
	var e = linksCitation[currentItem];
	//console.log(linksCitation);
	//Array.prototype.forEach.call(linksCitation, function(e) {
		console.log(e);
		//console.log("\n");
		casper.open("http://dl.acm.org/"+e+"&preflayout=flat");
		casper.then(getAndSaveCitation);
	//});
});

//var x = require('casper').selectXPath;
casper.then(function(){
	//this.clickLabel('next');
	//this.captureSelector('weather.png', 'body');
	
	//this.click(x('//a[text()="next"]'));
	//console.log(linksss);
	//salvando...

	var currentTime = new Date();
	var month = currentTime.getMonth() + 1;
	var day = currentTime.getDate();
	var year = currentTime.getFullYear();
	var myfile = "acm-data-"+year + "-" + month + "-" + day+".json";

	var fs = require('fs');
	fs.write(myfile, utils.serialize(foundPapers), 'w');
});

casper.run();