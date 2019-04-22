<?php
//We give a title to the homepage
$this->assign('title',  'Homepage');

        if($articles != null) {
            foreach ($articles as $article) {
                $filename = \Cake\Utility\Text::slug($article->name);
                echo '<div style="margin-left: auto; margin-right: auto; display: block; width: 80%; margin-top: 2%; border-width:1px; border-style: solid; border-color: #f3f3f3; margin-bottom: 25px; background: #f6f6f6; border-radius: 15px;">
                         <div style="padding-left: 25px; padding-right: 25px; padding-top: 25px;">
                            <table style="font-family: Bahnschrift;">
                                <tr style="background: #f6f6f6;">
                                    <td colspan="2" style="font-size: 20px;"><u>' . $article->name . '</u></td>      
                                </tr>
                                <tr style="background: #f6f6f6;">
                                    <td>' . $this->Html->Image('img_articles/' . $filename . '.' . $article->extension, ['alt' => 'Article name: ' . $article->name . ' Description: ' . $article->description, 'style' => 'margin: 15px; border-top-right-radius: 15px; border-bottom-right-radius: 15px; border-bottom-left-radius: 15px;', 'url' => '/consult/' . $article->id]).'</td>
                                    <td><div style="margin: 15px; font-size: 17px;">';
                $content = $article->content;
                if (strlen($content) > 400) {
                    $tmpContent = substr($content, 400) . "...";
                } else {
                    $tmpContent = $content;
                }

                echo $tmpContent . '</div></td>
                            </tr></table>
                            <table>
                            <tr style="background: #f6f6f6;">
                                <td style="font-size: 16px;"><u>Main tags</u></td>';
                $size = sizeof($article->tags);

                if($size > 0){
                    if($size > 3){
                        $tags = [$article->tags[0], $article->tags[1], $article->tags[2]];
                        foreach ($tags as $tag){
                            echo '<td><div style="text-align: center; width: 65%; background: #d0bf98; font-size: 15px; border-radius: 12px; padding: 13px; color: white; margin-bottom: 15px;">' .$tag->name.'</div></td>';
                        }
                    }
                    else{
                        if($size == 2){
                            foreach ($article->tags as $tag){
                                echo '<td><div style="text-align: center; width: 65%; background: #d0bf98; font-size: 15px; border-radius: 12px; padding: 13px; color: white; margin-bottom: 15px;">' .$tag->name.'</div></td>';
                            }
                            echo '<td></td>';
                        }
                        else{
                            if($size == 1){
                                foreach ($article->tags as $tag){
                                    echo '<td><div style="text-align: center; width: 65s%; background: #d0bf98; font-size: 15px; border-radius: 12px; padding: 13px; color: white; margin-bottom: 15px;">' .$tag->name.'</div></td>';
                                }
                                echo '<td></td><td></td>';
                            }
                        }
                    }
                }
                else{
                    echo 'No tags';
                }



                echo '</td>
                                <td style="text-align: center;">'.$this->Html->link('Know more about it', '/consult/' . $article->id, ['type' => 'button', 'style' => 'display: block; width: 100%; background: #116d76; font-size: 15px; border-radius: 12px; padding: 15px; color: white;']).'</td>
                            </tr>
                        </table>
                    </div>
                  </div>';
            }
        }
        ?>
    </div>
</div>
