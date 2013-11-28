<?
	class Resultado extends AppModel{
		
		public $virtualFields = array(
				//"aprovados"	=>	"select count(*) from avaliacoes where Resultado.id=avaliacoes.resultado_id and tipo = 'I' and avaliacao = 'INCLUIR'",
				"aprovados"		=>	"select GROUP_CONCAT(criterio_id SEPARATOR '|') from avaliacoes where Resultado.id=avaliacoes.resultado_id and tipo = 'I' and avaliacao = 'INCLUIR'",
				//"reprovados"	=>	"select count(*) from avaliacoes where Resultado.id=avaliacoes.resultado_id and tipo = 'E' and avaliacao = 'EXCLUIR'",
				"reprovados"	=>	"select GROUP_CONCAT(criterio_id SEPARATOR '|') from avaliacoes where Resultado.id=avaliacoes.resultado_id and tipo = 'E' and avaliacao = 'EXCLUIR'"
		);
	}