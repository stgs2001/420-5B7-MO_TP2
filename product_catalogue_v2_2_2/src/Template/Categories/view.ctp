<?php $this->extend('../Layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->id], ['class' => 'nav-link']) ?></li>
<li><?= $this->Form->postLink( __('Delete Category'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id), 'class' => 'nav-link'] ) ?></li>
<li><?= $this->Html->link(__('List Categories'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('New Category'), ['action' => 'add'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="categories view large-9 medium-8 columns content">
    <h3><?= h($category->title) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('Title') ?></th>
                <td><?= h($category->title) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($category->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($category->modified) ?></td>
            </tr>
        </table>
    </div>
    <div class="related">
        <h4><?= __('Related Products') ?></h4>
        <?php if (!empty($category->products)): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th scope="col"><?= __('Title') ?></th>
                    <th scope="col"><?= __('Description') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($category->products as $products): ?>
                <tr>
                    <td><?= h($products->title) ?></td>
                    <td><?= h($products->description) ?></td>
                    <td><?= h($products->created) ?></td>
                    <td><?= h($products->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Form->postLink( __('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('Are you sure you want to delete # {0}?', $products->id), 'class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
