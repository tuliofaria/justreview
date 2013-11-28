<h2>Critérios <a href="<? echo $this->Html->url("/a/criterios/novo/".$id) ?>">Novo critério</a></h2>
<? if(count($criterios)==0){ ?>
<div class="alert">Nenhum critério para esta revisão. <a href="<? echo $this->Html->url("/a/criterios/novo/".$id) ?>">Crie o primeiro agora.</a></div>
<? }else{ ?>
<table class="table table-striped">
	<tr>
		<th width="20">#</th>
		<th>Critério</th>
		<th>Ações</th>
	</tr>
	<? foreach($criterios as $c){ ?>
	<tr>
		<td><? if($c["Criterio"]["tipo"]=="I"){ ?><span class="label label-primary"><span class="glyphicon glyphicon-plus"></span></span><? }else{ ?><span class="label label-danger"><span class="glyphicon glyphicon-minus"></span></span><? } ?></td>
		<td><? echo $c["Criterio"]["criterio"] ?></td>
		<td><a href="<? echo $this->Html->url("/a/criterios/editar/".$c["Criterio"]["id"]) ?>">Editar</a> | <a href="<? echo $this->Html->url("/a/criterios/excluir/".$c["Criterio"]["id"]) ?>">Excluir</a></td>
	</tr>
	<? } ?>
</table>
<? } ?>