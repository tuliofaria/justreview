<?
	class Busca extends AppModel{
		
		public $hasMany = array(
        'Resultado' => array(
            'className' => 'Resultado',
            'foreignKey' => 'busca_id'
        )
    );
	}