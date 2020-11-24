<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Issues'), ['controller' => 'Issues', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Issue'), ['controller' => 'Issues', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Photos'), ['controller' => 'Photos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Photo'), ['controller' => 'Photos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Accessories'), ['controller' => 'Accessories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Accessory'), ['controller' => 'Accessories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="products view large-9 medium-8 columns content">
    <h3><?= h($product->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $product->has('user') ? $this->Html->link($product->user->username, ['controller' => 'Users', 'action' => 'view', $product->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $product->has('category') ? $this->Html->link($product->category->title, ['controller' => 'Categories', 'action' => 'view', $product->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($product->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($product->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($product->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Accessories') ?></h4>
        <?php if (!empty($product->accessories)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Title') ?></th>
                    <th scope="col"><?= __('Description') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($product->accessories as $accessories): ?>
                    <tr>
                        <td><?= $this->Html->link(h($accessories->title), ['controller' => 'Accessories', 'action' => 'view', $accessories->id]) ?></td>
                        <td><?= h($accessories->description) ?></td>
                        <td><?= h($accessories->created) ?></td>
                        <td><?= h($accessories->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Accessories', 'action' => 'view', $accessories->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Accessories', 'action' => 'edit', $accessories->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Accessories', 'action' => 'delete', $accessories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accessories->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Issues') ?></h4>
        <?php if (!empty($product->issues)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Title') ?></th>
                    <th scope="col"><?= __('Description') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($product->issues as $issues): ?>
                    <tr>
                        <td><?= $this->Html->link(h($issues->title), ['controller' => 'Issues', 'action' => 'view', $issues->id]) ?></td>
                        <td><?= h($issues->description) ?></td>
                        <td><?= h($issues->created) ?></td>
                        <td><?= h($issues->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Issues', 'action' => 'view', $issues->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Issues', 'action' => 'edit', $issues->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Issues', 'action' => 'delete', $issues->id], ['confirm' => __('Are you sure you want to delete # {0}?', $issues->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Photos') ?></h4>
        <?php if (!empty($product->photos)): ?>

            <?php foreach ($product->photos as $photos): ?>
                <?php
                if (isset($product->photos[0])) {

                    echo $this->Html->image("../" . $product->photos[0]->path . $product->photos[0]->filename,
                            ["alt" => $product->photos[0]->filename]);
                }
                ?>

            <?php endforeach; ?>

        <?php endif; ?>
    </div>
</div>
