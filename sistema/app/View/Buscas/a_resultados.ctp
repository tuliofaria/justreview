<h2>Resultados</h2>
<? if(count($resultados)==0){ ?>
<div class="alert">Nenhum resultado. <a href="<? echo $this->Html->url("/a/resultados/enviar/".$id) ?>">Envie resultados.</a></div>
<? }else{ ?>
<table class="table table-striped">
	<tr>
		<th>Artigo</th>
		<th>Ações</th>
	</tr>
	<? foreach($resultados as $c){ ?>
	<tr>
		<td><b><? echo $c["Resultado"]["titulo"] ?></b><br /><span class="mute"><? echo $c["Resultado"]["abstract"] ?></span></td>
		<td><a href="<? echo $this->Html->url("/a/buscas/editar/".$c["Resultado"]["id"]) ?>">Editar</a> | <a href="<? echo $this->Html->url("/a/buscas/resultados/".$c["Resultado"]["id"]) ?>">Resultados</a> | <a href="<? echo $this->Html->url("/a/buscas/excluir/".$c["Resultado"]["id"]) ?>">Excluir</a></td>
	</tr>
	<? } ?>
</table>
<? } ?>

<? echo $this->Paginator->numbers(); ?>