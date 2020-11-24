<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Accessory $accessory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $accessory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $accessory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Accessories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="accessories form large-9 medium-8 columns content">
    <?= $this->Form->create($accessory) ?>
    <fieldset>
        <legend><?= __('Edit Accessory') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('description');
            echo $this->Form->control('products._ids', ['options' => $products]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
