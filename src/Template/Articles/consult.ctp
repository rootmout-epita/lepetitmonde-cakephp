<?php
//We give a title to the homepage
$this->assign('title',  'Consult');
$filename = \Cake\Utility\Text::slug($article->name);
echo $this->Form->create('Comments');
?>
<div style="margin-left: auto; margin-right: auto; display: block; width: 70%; margin-top: 3%; border-width:2px; border-style: solid; border-color: #f3f3f3; margin-bottom: 30px; background: #f6f6f6; border-radius: 15px;">
    <h1 align="center" style="margin-top: 25px; color: #01545b; font-family: Bahnschrift;"><?= $article->name ?></h1>
    <div style="padding-left: 10px; padding-right: 10px;">
        <table style="font-family: Bahnschrift;">
            <tr style="background: #f6f6f6;">
                <td><?= $this->Html->Image('img_articles/' . $filename . '.' . $article->extension, ['alt' => 'Article name: ' . $article->name . ' Description: ' . $article->description, 'style' => 'margin: 15px; border-bottom-right-radius: 15px; margin-right: auto; margin-left: auto; display: block;']) ?></td>
            </tr>
            <tr style="background: #f6f6f6;">
                <td align="justify" style="line-height: 35px; font-size: 19px; padding: 20px;"><?= $article->content ?></td>
            </tr>
        </table>
    </div>
</div>
<?php

if(sizeof($article->comments) > 0){
    echo '<div style="margin-left: auto; margin-right: auto; display: block; width: 70%; margin-top: 3%; border-width:2px; border-style: solid; border-color: #f3f3f3; margin-bottom: 30px; background: #f6f6f6; border-radius: 15px;">
            <h1 align="center" style="margin-top: 25px; color: #01545b; font-family: Bahnschrift;">Comments</h1>
                <div style="padding-left: 10px; padding-right: 10px;">
                    <table style="font-family: Bahnschrift;">
                        <tr style="background: #f6f6f6;">
                            <td>'.$this->Form->control('commentText', ['label' => 'Add your comment:', 'type' => 'textarea', 'placeholder' => 'Your comment here...']).'</td>
                        </tr>
                        <tr style="background: #f6f6f6;">
                            <td><div align="center">'.$this->Form->button('Add').'</div></td>
                        </tr>
                    </table>
                    <table tyle="font-family: Bahnschrift;">';
                    $i = 0;
                    foreach ($article->comments as $comment){
                        echo '<tr>
                                <td style="font-size: 17px;"><u>Send by:</u> '.$commentsUserName[$i].'</td>
                                <td colspan="3" style="font-size: 19px;">'.$comment->commentText.'</td>
                            </tr>';
                        $i++;
                    }
                    echo '</table>
                </div>
            </div>';
}
else{
    echo '<div style="margin-left: 15%; margin-right: 15%; margin-top: 3%; border-width:2px; border-style: solid; border-color: #f3f3f3; margin-bottom: 30px; background: #f6f6f6; border-radius: 15px;">
            <h1 align="center" style="margin-top: 25px; color: #01545b; font-family: Bahnschrift;">Comments</h1>
                <div style="padding-left: 10px; padding-right: 10px;">
                    <table style="font-family: Bahnschrift;">
                        <tr style="background: #f6f6f6;">
                            <td>'.$this->Form->control('commentText', ['label' => 'Add your comment:', 'type' => 'textarea', 'placeholder' => 'Your comment here...']).'</td>
                        </tr>
                        <tr style="background: #f6f6f6;">
                            <td style="padding-left: 45%;">'.$this->Form->button('Add').'</td>
                        </tr>
                    </table>
                </div>
            </div>';
}
echo $this->Form->end();