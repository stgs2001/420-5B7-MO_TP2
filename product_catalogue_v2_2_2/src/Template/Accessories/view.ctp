<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Accessory $accessory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Accessory'), ['action' => 'edit', $accessory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Accessory'), ['action' => 'delete', $accessory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accessory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Accessories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Accessory'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="accessories view large-9 medium-8 columns content">
    <h3><?= h($accessory->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($accessory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($accessory->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($accessory->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Products') ?></h4>
        <?php if (!empty($accessory->products)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($accessory->products as $products): ?>
            <tr>
                <td><?= $this->Html->link(h($products->title), ['controller' => 'Products', 'action' => 'view', $products->id]) ?></td>
                <td><?= h($products->description) ?></td>
                <td><?= h($products->created) ?></td>
                <td><?= h($products->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('Are you sure you want to delete # {0}?', $products->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
