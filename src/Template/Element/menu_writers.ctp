<?php
	$writers = $this->requestAction('/writers/menu');
?>
<?php if (!empty($writers)): ?>
	<?php foreach ($writers as $writer): ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<?php echo $this->Html->link($writer['name'], '/tac-gia/'.$writer['slug']) ?>
				</h4>
			</div>
		</div>
	<?php endforeach ?>
<?php endif ?>

<!-- <div class="col-sm-12">
	<ul id="sideManu" class="nav nav-tabs nav-stacked">
		<?php foreach ($writers as $writer): ?>	
			<li ><?php echo $this->Html->link($writer['name'], '/tac-gia/'.$writer['slug'],['class'=>'active']) ?></li>	
		<?php endforeach ?>
	</ul>
</div> -->