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
 */
$cakeDescription = 'Le petit monde';
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

    <?= $this->Html->meta('logo.png', '/img/logo.png', ['type' => 'icon']); ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><?= $this->Html->link($this->fetch('title'), '/homepage'); ?></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><?php
                    if($this->request->getSession()->read('isAdmin') == 1){
                        echo $this->Html->link('NEW TAG', '/create/tag');
                    } ?></li>
                <li><?php
                    if($this->request->getSession()->read('isAdmin') == 1){
                        echo $this->Html->link('PUBLISH', '/publish/article');
                    } ?></li>
                <li><?php
                    if($this->request->getSession()->read('userId') != null){
                        echo $this->Html->link('DISCONNECT', '/disconnect');
                    }
                    else{
                        echo $this->Html->link('LOGIN', '/login');
                    }?>
                </li>
                <li><?= $this->Html->Image('home.png', ['style' => 'max-height: 35px; padding-top: 10px;', 'alt' => 'To home image', 'url' => '/homepage']); ?> </li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <?php
        $nav = '<nav>
                    <ul style="list-style: none;">
                        <li>'.$this->Html->Image('logo.png', ['style' => 'max-width: 350px; padding-top: 25px; margin-left: auto; margin-right: auto; display: block;', 'alt' => 'Logo image', 'url' => '/homepage']).'</li>
                    </ul>';
        if($this->request->getSession()->read('userId') != null){
            $nav .= '<ul style="list-style: none; padding-top: 15px; font-family: Bahnschrift;">
                        <li style="font-size: 20px;"><u>Users connected:</u> '.$this->request->getSession()->read('userName').'</li>
                    </ul>';
        }
        $nav .= '</nav>';
        echo $nav;
    ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
