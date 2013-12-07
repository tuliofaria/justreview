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

var arquivo = casper.cli.get(0);

var links = require(casper.cli.get(0));

function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/[^\w ]+/g,'')
        .replace(/ +/g,'-')
        ;
}

casper.echo("Preparando para iniciar o download de "+links.length+" PDFs na ACM Digital Library: ");
casper.echo("   "+arquivo);

casper.start('http://dl.acm.org/');
casper.then(function(){
	for(i=0; i<links.length; i++){
		casper.open('http://dl.acm.org/'+links[i].url);
		casper.then(function(){
			var linkPDF = this.evaluate(function() {
				return $("a:contains('PDF')").attr("href");
			});
			var filename = convertToSlug(this.getTitle());
			if(linkPDF!="" && linkPDF!=null){
				

				var url = 'http://dl.acm.org/';
    			this.download(url+linkPDF, "acm-"+filename+".pdf");
    		}else{
    			casper.echo("PDF not found or unavailable! ("+this.getTitle()+")");
    		}
		});
		
	}
});

casper.run();