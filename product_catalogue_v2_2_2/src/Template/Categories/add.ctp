<?php $this->extend('../Layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('List Categories'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="categories form content">
    <?= $this->Form->create($category) ?>
    <fieldset>
        <legend><?= __('Add Category') ?></legend>
        <?php
            echo $this->Form->control('title');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
