<?php
//We give a title to the publish article page
$this->assign('title',  'Publish an article');
echo $this->Form->create('Articles', ['type' => 'file'])
?>

<div style="margin-left: auto; margin-right: auto; display: block; width: 64%; margin-top: 3%; border-width:2px; border-style: solid; border-color: #828282; margin-bottom: 30px; background: gainsboro;">
    <h1 align="center" style="margin-top: 25px; color: #01545b; font-family: Bahnschrift;">NEW ARTICLES</h1>
    <div style="padding-left: 10px; padding-right: 10px;">
        <table>
            <tr style="background: gainsboro;">
                <td style="margin-right: auto; margin-left: auto; display: block; width: 70%;"><?= $this->Form->control('name', ['label' => 'Tag name:', 'placeholder' => 'Ex: Voyage']); ?></td>
            </tr>
            <tr style="background: gainsboro;">
                <td><?= $this->Form->control('tags._ids', ['label' => 'Choose tags', 'options' => $tagsList, 'style' => 'background: white;']);?></td>
            </tr>
            <tr style="background: gainsboro;">
                <td><?= $this->Form->control('file', ['label' => 'Your image in JPEG, JPG or PNG format:', 'type' => 'file', 'style' => 'padding-top: 7px;']); ?></td>
            </tr>
            <tr style="background: gainsboro;">
                <td><?= $this->Form->control('description', ['label' => 'Description/content:', 'type' => 'textarea', 'placeholder' => 'Article content']); ?></td>
            </tr>
</table>

<table>
    <tr style="background: gainsboro;">
        <td><div align="center"><?= $this->Form->button('Create'); ?></div></td>
    </tr>
</table>
</div>
<?= $this->Form->end(); ?>
</div>