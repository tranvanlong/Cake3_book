<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Writer $writer
  */
?>
<div class="writers view large-9 medium-8 columns content">
    <h3><?= h($writer->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($writer->name) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Biography') ?></h4>
        <?= $this->Text->autoParagraph(h($writer->biography)); ?>
    </div>
    <div class="related">
        <h4><?= __('Sách của tác giả') ?></h4>
        <?php if (!empty($books)): ?>
            <?php echo $this->element('books',['books'=>$books]); ?>
            <?php echo $this->element('pagination',['object'=>'tác giả']); ?>
        <?php endif; ?>
    </div>
</div>
