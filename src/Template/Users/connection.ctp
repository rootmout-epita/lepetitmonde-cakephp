<?php
//We delete UserName in session  if exists
if($this->request->getSession()->read('userName') != null){
    $this->request->getSession()->delete('userName');
}
if($this->request->getSession()->read('userId') != null){
    $this->request->getSession()->delete('userId');
}
//We give a title to the Login page
$this->assign('title',  'Login');
//We create a form for users to connect
echo $this->Form->create('User');
?>
<!DOCTYPE html>
<html lang=“fr ">
<head>
    <meta charset="UTF-8" >
</head>
<body>
<div style="display: block; width: 350px;margin-left: auto; margin-right: auto; margin-top: 2%; border-width:2px; border-style: solid; border-color: #828282; margin-bottom: 0px; background: gainsboro;">
    <h1 align="center" style=" margin-top: 5px; margin-bottom: 20px;">Login</h1>
    <div style="padding-left: 10px; padding-right: 10px; margin-bottom: 30px;">
        <table>
            <tr><?= $this->Form->control('mail', ['label' => 'Email:', 'placeholder' => 'Ex: jadore@lepetitmonde.com'])?></tr>
            <tr><?= $this->Form->control('password', ['label' => 'Password:', 'placeholder' => '**********']) ?></tr>
            <tr><div align="center" style="padding-top: 15px;"><?= $this->Form->button('Connect'); ?></div></tr>
        </table>
    </div>
    <div align="center"; style="padding-right: 0px;">
        <table>
            <tr><?= $this->Html->link('Create an account ! Join us.', '/create/account')?></tr>
        </table>
    </div>
    <?= $this->Form->end(); ?>
</div>
</body>
</html >