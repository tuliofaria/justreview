<h2>Nova busca</h2>
<? echo $this->FF->create("Busca", array("enctype"=>"multipart/form-data")) ?>
<? echo $this->FF->input("nome") ?>
<? echo $this->FF->input("base") ?>
<? echo $this->FF->input("string_busca") ?>
<input type="file" name="resultados" />
<? echo $this->FF->end("Salvar") ?>