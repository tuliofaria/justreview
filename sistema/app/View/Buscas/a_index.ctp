<h2>Buscas <a href="<? echo $this->Html->url("/a/buscas/novo/".$id) ?>">Nova busca</a></h2>
<? if(count($buscas)==0){ ?>
<div class="alert">Nenhum busca para esta revisão. <a href="<? echo $this->Html->url("/a/buscas/novo/".$id) ?>">Envie a primeira agora.</a></div>
<? }else{ ?>
<table class="table table-striped">
	<tr>
		<th>Busca</th>
		<th>Base</th>
		<th>Total/Avaliado</th>
		<th>Ações</th>
	</tr>
	<? $t = 0 ?>
	<? $t2 = 0 ?>
	<? foreach($buscas as $c){ ?>
	<tr>
		<td><? echo $c["Busca"]["nome"] ?><br /><i class="mute"><? echo $c["Busca"]["string_busca"] ?></i></td>
		<td><? echo $c["Busca"]["base"] ?></td>
		<td style="text-align: right;"><? echo $c["Busca"]["totalResultados"]; $t+=$c["Busca"]["totalResultados"]; ?>/<? echo $c["Busca"]["totalAvaliado"]; $t2+= $c["Busca"]["totalAvaliado"];?></td>
		<td><a href="<? echo $this->Html->url("/a/buscas/editar/".$c["Busca"]["id"]) ?>">Editar</a> | <a href="<? echo $this->Html->url("/a/buscas/resultados/".$c["Busca"]["id"]) ?>">Resultados</a> | <a href="<? echo $this->Html->url("/a/buscas/avaliar/".$c["Busca"]["id"]) ?>">Avaliar</a> | <a href="<? echo $this->Html->url("/a/buscas/excluir/".$id."/".$c["Busca"]["id"]) ?>">Excluir</a></td>
	</tr>
	<? } ?>
	<tr>
		<td colspan="2" style="text-align: right;">Total:</td>
		<td style="text-align: right;"><? echo $t ?>/<? echo $t2 ?></td>
		<td>&nbsp;</td>
	</tr>
</table>
<? } ?>