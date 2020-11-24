<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<?php
$urlToCategoriesAutocompletedemoJson = $this->Url->build([
    "controller" => "Categories",
    "action" => "findCategories",
    "_ext" => "json"
        ]);
echo $this->Html->scriptBlock('var urlToAutocompleteAction = "' . $urlToCategoriesAutocompletedemoJson . '";', ['block' => true]);
echo $this->Html->script('Products/add_edit/categoryAutocomplete', ['block' => 'scriptBottom']);
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Issues'), ['controller' => 'Issues', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Issue'), ['controller' => 'Issues', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Photos'), ['controller' => 'Photos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Photo'), ['controller' => 'Photos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Accessories'), ['controller' => 'Accessories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Accessory'), ['controller' => 'Accessories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($product) ?>
    <fieldset>
        <legend><?= __('Add Product') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')]);
            echo $this->Form->control('category_id', ['label' => '(category_id)', 'type' => 'hidden']);
        ?>
        <div class="input text">
            <label for="autocomplete">
                <?= __("Category") ?>
            </label>
            <input id="autocomplete" type="text">
        </div>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('description');
            echo $this->Form->control('accessories._ids', ['options' => $accessories]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
