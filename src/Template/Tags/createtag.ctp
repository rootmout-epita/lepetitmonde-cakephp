<?php
//We give a title to the create tag page
$this->assign('title',  'Create a new tag');
echo $this->Form->create('Tags');
?>
<div style="margin-left: auto; margin-right: auto; display: block; width: 40%; margin-top: 4%; border-width:2px; border-style: solid; border-color: #828282; margin-bottom: 0px; background: gainsboro;">
    <h1 align="center" style="margin-top: 25px; color: #01545b; font-family: Bahnschrift;">NEW TAG</h1>
    <div style="padding-left: 10px; padding-right: 10px;">
        <table>
            <tr style="background: gainsboro;x">
                <td><div align="center"><?= $this->Form->control('name', ['label' => 'Tag name:', 'placeholder' => 'Ex: Voyage']); ?></div></td>
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


<div style="margin-left: auto; margin-right: auto; display: block; width: 60%; margin-top: 4%; border-width:2px; border-style: solid; border-color: #828282; margin-bottom: 25px; background: gainsboro;">
    <h1 align="center" style="margin-top: 25px; color: #01545b; font-family: Bahnschrift;">EXISTING TAGS</h1>
    <div style="padding-left: 10px; padding-right: 10px;">
        <table style="margin-bottom: 20px; border-radius: 20px;">
        <?php
        if(count($tags) == 0){
            echo '<tr>
                    <td>
                        No tags existing !
                    </td>
                  </tr>';
        }
        else{
            foreach ($tags as $tag){
                echo '<tr style="margin-bottom: 10px;">
                        <td style="padding-top: 25px; text-align: center; font-family: Bahnschrift;"><font size="5">'.
                            $tag->name
                        .'</font></td>
                        <td style="text-align: center;">'.
                            $this->Html->link('Delete', '/delete/tag/'.$tag->id, ['type' => 'button', 'style' => 'display: block; width: 30%; margin-left: auto; font: bold; padding: 15px; color: white; background: #d33c44; font-size: 15px; border-radius: 12px; margin-top: 5px;'])
                        .'</td>
                    </tr>';
            }
        }
        ?>
        </table>
    </div>
</div>
