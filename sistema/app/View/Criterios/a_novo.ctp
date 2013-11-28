<h2>Novo critério de inclusão/exclusão</h2>
<? echo $this->FF->create("Criterio") ?>
<? echo $this->FF->input("criterio") ?>
<? echo $this->FF->input("descricao") ?>
<? echo $this->FF->radio("tipo", array("I"=>"Inclusão", "E"=>"Exclusão")) ?>
<? echo $this->FF->end("Salvar") ?>
