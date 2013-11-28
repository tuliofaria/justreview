<?
	class RevisoesController extends AppController{
		public $uses = array("Revisao", "Busca", "Criterio");

		function a_index(){
			$this->set("revisoes", $this->paginate("Revisao"));
		}
		function a_nova(){
			if($this->request->is("post")||$this->request->is("put")){
				if($this->Revisao->save($this->data)){
					$this->Session->setFlash("Revisão criada com sucesso!");
					$this->redirect("/a/criterios");
				}
			}
		}
		function a_lattex($id){
			set_time_limit(0);
			$this->layout = "text";
			$this->response->type('text');
			$this->set("revisao", $this->Revisao->findById($id));
			$this->set("criteriosI", $this->Criterio->find("all", array("conditions"=>array("Criterio.revisao_id"=>$id, "Criterio.tipo"=>"I"))));
			$this->set("criteriosE", $this->Criterio->find("all", array("conditions"=>array("Criterio.revisao_id"=>$id, "Criterio.tipo"=>"E"))));
			$this->Busca->recursive = 2;
			$this->set("buscas", $this->Busca->find("all", array("conditions"=>array("Busca.revisao_id"=>$id))));
		}

	}