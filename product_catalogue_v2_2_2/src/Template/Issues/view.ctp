<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Issue $issue
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Issue'), ['action' => 'edit', $issue->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Issue'), ['action' => 'delete', $issue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $issue->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Issues'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Issue'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="issues view large-9 medium-8 columns content">
    <h3><?= h($issue->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $issue->has('product') ? $this->Html->link($issue->product->title, ['controller' => 'Products', 'action' => 'view', $issue->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($issue->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($issue->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($issue->description)); ?>
    </div>
</div>
