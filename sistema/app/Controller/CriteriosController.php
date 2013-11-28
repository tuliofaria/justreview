<?
	class CriteriosController extends AppController{
		
		function a_index($id){
			$this->paginate = array("conditions"=>array("Criterio.revisao_id"=>$id));
			$this->set("criterios", $this->paginate("Criterio"));
			$this->set("id", $id);
		}
		function a_novo($id){
			if($this->request->is("post")||$this->request->is("put")){
				$this->request->data["Criterio"]["revisao_id"] = $id;
				if($this->Criterio->save($this->data)){
					$this->Session->setFlash("Critério de inclusão/exclusão criada com sucesso!");
					$this->redirect("/a/criterios/index/".$id);
				}
			}
		}
		function a_editar($id){
			if($this->request->is("post")||$this->request->is("put")){
				//$this->request->data["Criterio"]["revisao_id"] = $id;
				$c = $this->Criterio->findById($id);
				$this->Criterio->id = $id;
				if($this->Criterio->save($this->data)){
					$this->Session->setFlash("Critério de inclusão/exclusão alterado com sucesso!");
					$this->redirect("/a/criterios/index/".$c["Criterio"]["revisao_id"]);
				}
			}else{
				$this->request->data = $this->Criterio->findById($id);
			}
		}

	}