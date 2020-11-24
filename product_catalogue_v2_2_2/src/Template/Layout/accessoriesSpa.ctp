<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?= $cakeDescription ?>:
            <?= $this->fetch('title') ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <?php
        echo $this->Html->css([
            'base.css',
            'style.css',
//            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'
        ]);
        ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
        <?php
        echo $this->Html->script([
            'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js',
//            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'
                ], ['block' => 'scriptLibraries']
        );
        ?>
    </head>
    <body>
        <nav class="top-bar expanded" data-topbar role="navigation">
            <ul class="title-area large-3 medium-4 columns">
                <li class="name">
                    <h1><a href="">Products Catalog</a></h1>
                </li>
            </ul>
            <div class="top-bar-section">
                <ul class="left">
                    <li>
                        <?= $this->Html->link('Home', ['controller' => 'Products', 'action' => 'index']); ?>
                    </li>
                </ul>
                <ul class="right">
                    <li><?= $this->Html->link(__('Listes liées'), ['controller' => 'Issues', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link(__('Autocomplétion'), ['controller' => 'Products', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link(__('Monopage'), ['controller' => 'Accessories', 'action' => 'index']) ?></li>
                    <li>
                        <?php
                        $loguser = $this->request->getSession()->read('Auth.User');
                        if ($loguser) {
                            $user = $loguser['email'];
                            echo "<span>" . $this->Html->link($user, ['controller' => 'Users', 'action' => 'view', $loguser['id']]);
                            echo $this->Html->link(' logout', ['controller' => 'Users', 'action' => 'logout']) . "</span>";
                        } else {
                            echo $this->Html->link('login', ['controller' => 'Users', 'action' => 'login']);
                        }
                        ?>
                    </li>
                    <li>
                        <?= $this->Html->link('Français', ['action' => 'changeLang', 'fr_CA'], ['escape' => false]); ?>
                    </li>
                    <li>
                        <?= $this->Html->link('English', ['action' => 'changeLang', 'en_US'], ['escape' => false]); ?>
                    </li>
                    <li>
                        <?= $this->Html->link('Español', ['action' => 'changeLang', 'es_MX'], ['escape' => false]); ?>
                    </li>
                    <li>
                        <?= $this->Html->link(__('À Propos'), ['controller' => 'Pages', 'action' => 'aPropos']); ?>
                    </li>
                </ul>
            </div>
        </nav>
        <?= $this->Flash->render() ?>
        <div class="container clearfix">
            <?= $this->fetch('content') ?>
        </div>
        <footer>
        </footer>
        <?= $this->fetch('scriptLibraries') ?>
        <?= $this->fetch('script'); ?>
        <?= $this->fetch('scriptBottom') ?> 
    </body>
</html>
