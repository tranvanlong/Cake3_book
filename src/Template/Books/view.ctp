<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Book $book
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Book'), ['action' => 'edit', $book->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Book'), ['action' => 'delete', $book->id], ['confirm' => __('Are you sure you want to delete # {0}?', $book->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Books'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Book'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Writers'), ['controller' => 'Writers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Writer'), ['controller' => 'Writers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="books view large-9 medium-8 columns content">
    <h3><?= h($book->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $book->has('category') ? $this->Html->link($book->category->name, ['controller' => 'Categories', 'action' => 'view', $book->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($book->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($book->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($book->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Publisher') ?></th>
            <td><?= h($book->publisher) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Link Download') ?></th>
            <td><?= h($book->link_download) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($book->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($book->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sale Price') ?></th>
            <td><?= $this->Number->format($book->sale_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Publish Date') ?></th>
            <td><?= h($book->publish_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($book->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($book->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Published') ?></th>
            <td><?= $book->published ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Info') ?></h4>
        <?= $this->Text->autoParagraph(h($book->info)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Comments') ?></h4>
        <?php if (!empty($comments)): ?>
            <?php foreach ($comments as $comment): ?>
                <?php echo $comment['User']['username']; ?> đã gửi:
               " <?php echo $comment['Comments']['content']; ?>"
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Writers') ?></h4>
        <?php if (!empty($book->writers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Biography') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($book->writers as $writers): ?>
            <tr>
                <td><?= h($writers->id) ?></td>
                <td><?= h($writers->name) ?></td>
                <td><?= h($writers->slug) ?></td>
                <td><?= h($writers->biography) ?></td>
                <td><?= h($writers->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Writers', 'action' => 'view', $writers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Writers', 'action' => 'edit', $writers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Writers', 'action' => 'delete', $writers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $writers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        <h3>Sách liên quan</h3>
        <?php echo $this->element('books',['books'=>$related_books]) ?>
    </div>
</div>

<!--comments-->
<div class="comments form">
    <?php if (isset($errors)):?> 
            <?php foreach ($errors as $error):?>
            <?php echo $error[0]; ?>
        <?php endforeach ?>
    <?php endif ?>
    <?php echo $this->Form->create('Comments',['action'=>'add','novalidate'=>true]); ?>
    <fieldset>
        <legend><?php echo __('Add Comments');?></legend>
        <?php
            echo $this->Form->input('user_id',['required'=>false,'label'=>'','type'=>'text','values'=>1,'hidden'=>true]);
            echo $this->Form->input('book_id',['required'=>false,'type'=>'text','values'=>$book['Book']['id'],'hidden'=>true]);
            echo $this->Form->input('content');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>