<div class="col-sm-12">
	<div class="product-image-wrapper">
	<?php foreach($books as $book): ?>

		<div class="single-products col-sm-4">
			<div class="productinfo text-center">
					<?php echo $this->Html->image($book['image'],array('class'=>'img img-responsive', 'style'=>'width:220px;height:220px;')); ?>
					<h4><?php echo $this->Html->link($book['title'],'/'.$book['slug']); ?></h4>
					<?php echo 'Tác giả: ';
					foreach ($book['writers'] as $writer) {
						echo $this->Html->link($writer['name'],'/tac-gia/'.$writer['slug']);
					}  ?><br>					
					Giá bán: <?php echo $this->Number->format($book['sale_price'],['places'=> 0,'after'=>' VNĐ']); ?><br>			
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>