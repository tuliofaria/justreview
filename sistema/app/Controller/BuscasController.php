<?
	class BuscasController extends AppController{
		public $uses = array("Busca", "Resultado", "Criterio", "Avaliacao");
		public $bases = array("RBIE"=>"RBIE", "ACM"=>"ACM", "IEEE"=>"IEEE");
		
		function a_index($id){
			$this->Busca->virtualFields = array(
				"totalResultados"=>
				"select count(*) from resultados where resultados.busca_id = Busca.id",
				"totalAvaliado"=>
				"select count(*) from resultados where resultados.busca_id = Busca.id and resultados.id in (select resultado_id from avaliacoes)");
			$this->paginate = array("conditions"=>array("Busca.revisao_id"=>$id));
			$this->set("buscas", $this->paginate("Busca"));
			$this->set("id", $id);
		}
		function a_novo($id){
			$this->set("bases", $this->bases);
			set_time_limit(0);
			if($this->request->is("post")||$this->request->is("put")){
				$this->request->data["Busca"]["revisao_id"] = $id;
				if($this->Busca->save($this->data)){
					$base = $this->request->data["Busca"]["base"];
					if($base=="RBIE" || $base=="ACM"){
						$conteudo = file_get_contents($_FILES["resultados"]["tmp_name"]);
						$data = json_decode($conteudo);
						foreach($data as $d){
							$titulo = "";
							foreach($d->metas as $m){
								if((isset($m->name))&&($m->name=="citation_title")){
									$titulo = $m->value;
								}
							}
							if(isset($d->url)){
								$this->Resultado->create();
								$this->Resultado->id = null;
								$r["Resultado"]["titulo"] = $titulo;
								$r["Resultado"]["abstract"] = $d->abstract;
								$r["Resultado"]["metas"] = serialize($d->metas);
								$r["Resultado"]["url"] = $d->url;
								$r["Resultado"]["busca_id"] = $this->Busca->id;
								$this->Resultado->save($r);
							}
						}
					}else if($base=="IEEE"){
						echo "OK";
						//$dados = str_getcsv(file_get_contents($_FILES["resultados"]["tmp_name"]), "\t");
						//pr($dados);

						$row = 1;
						$handle = fopen ($_FILES["resultados"]["tmp_name"],"r");
						while (($data = fgetcsv($handle, 0, "\t")) !== FALSE) {
						    $num = count ($data);
						    //echo "<p> $num campos na linha $row: <br /></p>\n";
						    $row++;
						    for ($c=0; $c < $num; $c++) {
						        //echo $data[$c] . "<br />\n";
						    }

						    $this->Resultado->create();
							$this->Resultado->id = null;
							$r["Resultado"]["titulo"] = $data[0];
							$r["Resultado"]["abstract"] = $data[2];
							$r["Resultado"]["metas"] = serialize(array());
							$r["Resultado"]["url"] = $data[3];
							$r["Resultado"]["busca_id"] = $this->Busca->id;
							$this->Resultado->save($r);

						}
						fclose ($handle);
					}
					
					$this->Session->setFlash("Busca salva com sucesso!");
					$this->redirect("/a/buscas/index/".$id);
				}
			}
		}
		function a_editar($id){
			if($this->request->is("post")||$this->request->is("put")){
				//$this->request->data["Criterio"]["revisao_id"] = $id;
				$c = $this->Busca->findById($id);
				$this->Busca->id = $id;
				if($this->Busca->save($this->data)){
					$this->Session->setFlash("Busca alterada com sucesso!");
					$this->redirect("/a/buscas/index/".$c["Busca"]["revisao_id"]);
				}
			}else{
				$this->request->data = $this->Busca->findById($id);
			}
		}

		function a_resultados($id){
			$this->paginate = array("conditions"=>
						array(
								"Resultado.busca_id"=>$id
				)
			);
			$this->set("resultados", $this->paginate("Resultado"));
		}
		function a_avaliar($id, $idResultado=""){
			if($idResultado==""){
				$atual = $this->Resultado->find("first", array("conditions"=>array("Resultado.busca_id"=>$id)));
				$this->redirect("/a/buscas/avaliar/".$id."/".$atual["Resultado"]["id"]);
			}
			if($this->request->is("post")){
				foreach($_POST["crit"] as $idC=>$aval){
					$d = array();
					$d["Avaliacao"]["tipo"] = $_POST["crit_t"][$idC];
					$d["Avaliacao"]["avaliacao"] = $aval;
					$d["Avaliacao"]["resultado_id"] = $idResultado;
					$d["Avaliacao"]["criterio_id"] = $idC;
					$this->Avaliacao->create();
					$this->Avaliacao->id = null;
					$this->Avaliacao->save($d);
				}

				// salvou, ir pro prox.
				// vizinhos
				$neighbors = $this->Resultado->find('neighbors', array('field' => 'id', 'value' => $idResultado,"conditions"=>array("Resultado.busca_id"=>$id)));
				$this->redirect("/a/buscas/avaliar/".$id."/".$neighbors["next"]["Resultado"]["id"]);
			}
			
			// preencher os dados do resultado atual
			$atual = $this->Resultado->findById($idResultado);
			$this->set("atual", $atual);

			// vizinhos
			$neighbors = $this->Resultado->find('neighbors', array('field' => 'id', 'value' => $atual["Resultado"]["id"],"conditions"=>array("Resultado.busca_id"=>$id)));
			$this->set("neighbors", $neighbors);

			$busca = $this->Busca->findById($id);
			// perguntas
			$this->set("criterios", $this->Criterio->find("all", array("conditions"=>array("Criterio.revisao_id"=>$busca["Busca"]["revisao_id"]))));

		}
		function a_lattex($id){
			
		}
		function a_excluir($idR, $id){
			$this->Busca->delete($id);
			$this->redirect("/a/buscas/index/".$idR);

		}

	}