<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Book[]|\Cake\Collection\CollectionInterface $books
  */
?>
<h3><?php echo $this->Html->link('Sách mới','/sach-moi'); ?></h3>

<?php echo $this->element('books',['books'=>$books]) ?>

