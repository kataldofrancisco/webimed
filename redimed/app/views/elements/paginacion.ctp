<div id="paginacion">
	<?php
		echo $this->Paginator->counter(array(
			'format' => 'Página %page% de %pages%, mostrando %current% registros de %count%'
			)
		);
	?>
	<div class="paging">
		<?php echo $this->Paginator->first('|<< ', array(), null, array('class'=>'disabled'));?>
		<?php echo $this->Paginator->prev('< Previo', array(), null, array('class'=>'disabled'));?>
		<?php echo $this->Paginator->numbers();?>
		<?php echo $this->Paginator->next('Siguiente >', array(), null, array('class' => 'disabled'));?>
		<?php echo $this->Paginator->last(' >>|', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
