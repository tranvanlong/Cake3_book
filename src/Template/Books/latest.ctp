<h4><?php echo ('Sách mới'); ?></h4>
<h6><?php echo $this->Paginator->sort('title','Sắp xếp theo tên sách'); ?></h6>
<h6><?php echo $this->Paginator->sort('created','Mới nhất/Cũ nhất'); ?></h6>

<?php echo $this->element('books',['books'=>$books]); ?>

<?php echo $this->element('pagination',['object'=>'quyển sách']); ?>