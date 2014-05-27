![JustReview](https://rawgithub.com/tuliofaria/justreview/master/logo.png)

Ferramentas para auxiliar o trabalho de revisar sistematicamente sobre um determinado assunto.

O JustReview foi desenvolvido durante as aulas de Metodologia da Pesquisa do Curso de Pós-Graduação em Sistemas de Informação da EACH-USP.

É composto por duas partes:
- Scripts de captura de artigos dado uma string de busca (atualmente funciona na ACM Digital Library, RBIE - Revista Brasileira de Informática na Educação, IEEE Xplore e Scopus. 
- Interface de filtragem de artigos


## Executando os scripts: ##

### Pré-requisitos: ###

Instalar o CasperJS (www.casperjs.org), e verificar se o mesmo está no PATH do sistema (o CasperJS possui dependência com o PhantomJS, deve-se verificar se o mesmo também está instalado).

### Para baixar os PDFs: ###

- Baixar PDFs da IEEE (executar no shell do linux ou prompt do windows):

	casperjs pdf-ieee.js artigos.json subDiretorioDestino

Onde artigos.json é um JSON no seguinte formato:

	[
		{
			"name":"Mobile-digital-portfolio-extension",
			"url":"http:\/\/ieeexplore.ieee.org\/stamp\/stamp.jsp?arnumber=1281339"
		},
		{
			"name":"A-mobile-learning-application-for-delivering-educational-resources-to-mobile-devices",
			"url":"http:\/\/ieeexplore.ieee.org\/stamp\/stamp.jsp?arnumber=6285060"
		}
	]

Contribua com o projeto!
