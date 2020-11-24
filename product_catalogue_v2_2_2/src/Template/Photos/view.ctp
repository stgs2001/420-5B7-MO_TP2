<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Photo $photo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Photo'), ['action' => 'edit', $photo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Photo'), ['action' => 'delete', $photo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $photo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Photos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Photo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="photos view large-9 medium-8 columns content">
    <h3><?= h($photo->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $photo->has('product') ? $this->Html->link($photo->product->title, ['controller' => 'Products', 'action' => 'view', $photo->product->id]) : '' ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($photo->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($photo->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($photo->description)); ?>
    </div>
</div>
