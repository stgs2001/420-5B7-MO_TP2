<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Photo[]|\Cake\Collection\CollectionInterface $photos
 */
?>


<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Photo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="photos index large-9 medium-8 columns content">
    <h3><?= __('Photos') ?></h3>
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
            <?php foreach ($photos as $photo): ?>
                <tr>
                    <td><embed src="<?= $photo->path . $photo->filename ?>" width="150px" height="150px"></td>
                    <td><?= h($photo->title) ?></td>
                    <td><?= h($photo->created) ?></td>
                    <td><?= h($photo->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $photo->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $photo->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $photo->id], ['confirm' => __('Are you sure you want to delete {0}?', $photo->title)]) ?>
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
