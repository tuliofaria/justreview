<h2>Avaliar</h2>
<form method="post">
<div class="row">
  <div class="col-md-4">
    <b><? echo $atual["Resultado"]["titulo"] ?></b><br/>
    <? echo $atual["Resultado"]["abstract"] ?>
  </div>
  <div class="col-md-8">

<table class="table table-striped">
  <tr>
<? foreach($criterios as $c){ ?>
  <td>
<? if($c["Criterio"]["tipo"]=="I"){ ?><span class="label label-primary"><span class="glyphicon glyphicon-plus"></span></span><? }else{ ?><span class="label label-danger"><span class="glyphicon glyphicon-minus"></span></span><? } ?></td>
<td><? echo $c["Criterio"]["criterio"] ?></td>
<td width="250">
<input type="hidden" value="<? echo $c["Criterio"]["tipo"] ?>" name="crit_t[<? echo $c["Criterio"]["id"] ?>]" />
<? if($c["Criterio"]["tipo"]=="I"){ ?>
<div class="btn-group" data-toggle="buttons">
  <label class="btn btn-default btn-sm active">
    <input type="radio" name="crit[<? echo $c["Criterio"]["id"] ?>]" value="N-AVALIAR" id="option1" checked="checked"> Não avaliar
  </label>
  <label class="btn btn-success btn-sm">
    <input type="radio" name="crit[<? echo $c["Criterio"]["id"] ?>]" value="INCLUIR" id="option2"> Incluir
  </label>
  <label class="btn btn-danger btn-sm">
    <input type="radio" name="crit[<? echo $c["Criterio"]["id"] ?>]" value="N-INCLUIR" id="option3"> Não incluir
  </label>
</div>
<? }else{  ?>
<div class="btn-group" data-toggle="buttons">
  <label class="btn btn-default btn-sm active">
    <input type="radio" name="crit[<? echo $c["Criterio"]["id"] ?>]" value="N-AVALIAR" checked="checked"> Não avaliar
  </label>
  <label class="btn btn-success btn-sm">
    <input type="radio" name="crit[<? echo $c["Criterio"]["id"] ?>]" value="EXCLUIR" id="option2"> Excluir
  </label>
  <label class="btn btn-danger btn-sm">
    <input type="radio" name="crit[<? echo $c["Criterio"]["id"] ?>]" value="N-EXCLUIR" id="option3"> Não excluir
  </label>
</div>
<? } ?>
  </td>
  </tr>
<? } ?>
</table>
<button id="salvar" type="submit">Salvar e ir para próximo</a>
</div>
</div>
<script>
	$(function(){
		$('.btn-group').button();
	})
</script>
<ul class="pagination">
  <? if(!empty($neighbors["prev"])){ ?>
  <li><a href="<? echo $this->Html->url("/a/buscas/avaliar/".$neighbors["prev"]["Resultado"]["busca_id"]."/".$neighbors["prev"]["Resultado"]["id"]) ?>">Anterior</a></li>
  <? } ?>
  <? if(!empty($neighbors["next"])){ ?>
  <li><a href="<? echo $this->Html->url("/a/buscas/avaliar/".$neighbors["next"]["Resultado"]["busca_id"]."/".$neighbors["next"]["Resultado"]["id"]) ?>">Próximo</a></li>
  <? } ?>
</ul>
</form>