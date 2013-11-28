<h2>Revisões</h2>
<? if(count($revisoes)==0){ ?>
<div class="alert">Nenhuma revisão criada até o momento. <a href="<? echo $this->Html->url("/a/revisoes/nova") ?>">Crie a primeira agora.</a></div>
<? }else{ ?>
<table class="table table-striped">
	<tr>
		<th>Revisão</th>
		<th>Ações</th>
	</tr>
	<? foreach($revisoes as $r){ ?>
	<tr>
		<td><? echo $r["Revisao"]["revisao"] ?></td>
		<td><a href="<? echo $this->Html->url("/a/criterios/index/".$r["Revisao"]["id"]) ?>">Critérios</a> | <a href="<? echo $this->Html->url("/a/buscas/index/".$r["Revisao"]["id"]) ?>">Buscas</a> | <a href="<? echo $this->Html->url("/a/revisoes/lattex/".$r["Revisao"]["id"]) ?>">Lattex</a></td>
	</tr>
	<? } ?>
</table>
<? } ?>