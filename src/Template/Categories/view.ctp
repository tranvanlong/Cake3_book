<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Category $category
  */
?>

<div class="categories view large-9 medium-8 columns content">
    <h3><?= h($category->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($category->name) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($category->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Sách trong danh mục') ?></h4>
        <?php if (!empty($books)): ?>
            <?php echo $this->element('books',['books'=>$books]); ?>
            <?php echo $this->element('pagination',['object'=>'quyển sách']); ?>
        <?php endif; ?>
    </div>
</div>
