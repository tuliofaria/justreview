<?
	class Revisao extends AppModel{
		public $useTable = "revisoes";
		public $hasMany = array(
        'Busca' => array(
            'className' => 'Busca',
            'foreignKey' => 'revisao_id'
        )
    );
	}