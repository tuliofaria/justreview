var casper = require('casper').create(
	{
		verbose: false, 
		logLevel: 'debug',
		pageSettings: {
	        loadImages:  false,        // The WebPage instance used by Casper will
        	webSecurityEnabled: false
	    },
	    clientScripts:  [
        	'jquery.js',      // These two scripts will be injected in remote
    	],

	}
);
var utils = require('utils');

if(!casper.cli.has(0)){
	casper.echo("Informe o nome do arquivo JSON com os links de cada artigo.");	
	casper.exit();
}

if(!casper.cli.has(1)){
	casper.echo("Informe o sub-diretorio para salvar os PDFs");
	casper.exit();
}

var arquivo = casper.cli.get(0);
var subdir = casper.cli.get(1);

var links = require(casper.cli.get(0));

function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/[^\w ]+/g,'')
        .replace(/ +/g,'-')
        ;
}

casper.echo("Preparando para iniciar o download de "+links.length+" PDFs na IEEE XPLORE: ");
casper.echo("   "+arquivo);

var count = 0;
var currentItem = 0;

function craw(){
	if(currentItem<links.length){
		var i = currentItem;
		casper.open(links[i].url);
		casper.then(function(){
			var linkPDF = this.evaluate(function() {
				return $("frame:eq(1)").attr("src");
			});
			casper.echo(linkPDF);
			if(linkPDF!="" && linkPDF!=null){
    			this.download(linkPDF, subdir+"/ieee-"+links[i].name+".pdf");
    		}else{
    			casper.echo("PDF not found or unavailable! ("+this.getTitle()+")");
    		}
		});
		currentItem++;
		casper.then(craw);
	}
}

casper.start('http://ieeexplore.ieee.org/');
casper.then(craw);

casper.run();