<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Issue[]|\Cake\Collection\CollectionInterface $issues
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Issue'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="issues index large-9 medium-8 columns content">
    <h3><?= __('Issues') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= $this->Paginator->sort('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($issues as $issue): ?>
            <tr>
                <td><?= $issue->has('product') ? $this->Html->link($issue->product->title, ['controller' => 'Products', 'action' => 'view', $issue->product->id]) : '' ?></td>
                <td><?= h($issue->title) ?></td>
                <td><?= h($issue->created) ?></td>
                <td><?= h($issue->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $issue->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $issue->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $issue->id], ['confirm' => __('Are you sure you want to delete {0}?', $issue->title)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
