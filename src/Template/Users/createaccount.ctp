<?php
//We delete UserName in session  if exists
if($this->request->getSession()->read('userName') != null){
    $this->request->getSession()->delete('userName');
}
if($this->request->getSession()->read('userId') != null){
    $this->request->getSession()->delete('userId');
}
//We give a title to the Login page
$this->assign('title',  'Create an account');
//We create a form for users to connect
echo $this->Form->create('User');
?>
<!DOCTYPE html>
<html lang=“fr ">
<head>
    <meta charset="UTF-8" >
</head>
<body>
<div style="margin-left: auto; margin-right: auto; display: block; width: 450px; margin-top: 2%; border-width:2px; border-style: solid; border-color: #828282; margin-bottom: 0px; background: gainsboro;">
    <h1 align="center" style="margin-top: 25px;">Create an account</h1>
    <div style="padding-left: 10px; padding-right: 10px;">
        <table>
            <div style="margin-bottom: 30px;">
                <tr><?= $this->Form->control('name', ['label' => 'Name:', 'placeholder' => 'Jean-Paul II']); ?></tr>
                <tr><?= $this->Form->control('mail', ['label' => 'Email:', 'placeholder' => 'Ex: franchementonest@lesmeilleurs.com']);?></tr>
                <tr><?= $this->Form->control('password', ['label' => 'Password:', 'placeholder' => '********** (larger than 8 characters)']); ?></tr>
                <tr><?= $this->Form->control('repeatPassword', ['type' => 'password', 'label' => 'Repeat your password:', 'placeholder' => '**********']); ?></tr>
            </div>
            <tr><div align="center" style="margin-top: 35px;"><?= $this->Form->button('Create'); ?></div></tr>
        </table>
    </div>
    <?= $this->Form->end(); ?>
</div>
</body>
</html >