<?php
/**
 * Created by PhpStorm.
 * User: Helloïs
 * Date: 10/04/2019
 * Time: 21:15
 */

namespace App\Controller;


use Cake\Utility\Text;

class ArticlesController extends AppController
{

    public function root(){
        $this->referer('/homepage');
    }

    public function homepage(){
        $articles = $this->Articles
            ->find()
            ->contain(['Tags'])
            ->all();

        $this->set(compact('articles'));
    }

    public function publisharticle(){
        $tagsList = $this->Articles->Tags
            ->find('list');
        $this->set(compact('tagsList'));

        /** Traitement POST **/
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            if((empty($data['file'])) || (empty($data['name'])) || (empty($data['description']))){
                $this->Flash->error('Please fill in all the fields !');
                return $this->redirect($this->referer());
            }

            $search =  $this->Articles
                ->find()
                ->where(['name' => $data['name']])
                ->first();

            if($search != null){
                $this->Flash->error('An article already has this name ! Choose another name !');
                return $this->redirect($this->referer());
            }
            else{
                if($data['file']['error'] == 0) { //If doesn't have error and if his format is JPEG, JPG or PNG lets save it
                    $extension_file = $data['file']['type'];
                    if(in_array($extension_file, array('image/jpg', 'image/jpeg', 'image/png', 'image/PNG', 'image/JPEG', 'image/JPG'))){
                        $fileInfo = pathinfo($data['file']['name']);
                        $filename = Text::slug($data['name']).'.'.$fileInfo['extension'];

                        //We save file on WEBROOT in /img/img_articles
                        move_uploaded_file($data['file']['tmp_name'], WWW_ROOT.'img'.DS.'img_articles'.DS.$filename);

                        $article = $this->Articles->newEntity($this->getRequest()->getData());
                        $article->content = $data['description'];
                        $article->extension = $fileInfo['extension'];

                        if(!$this->Articles->save($article)){
                            unlink(WWW_ROOT.'img'.DS.'img_articles'.DS.$filename);
                            $this->Flash->error("Problem, we cann\'t save your article in database !");
                            return $this->redirect($this->referer());
                        }
                        else{
                            $this->Flash->success('Your article has been well created !');
                            return $this->redirect('/homepage');
                        }
                    }
                    else{
                        $this->Flash->error("Problem, the file doesn\'t have the right extension !");
                        return $this->redirect($this->referer());
                    }
                }
                else{
                    $this->Flash->error('Your image file is corrupt !');
                    return $this->redirect($this->referer());
                }
            }
        }
    }

    public function consult($id){
        $this->request->getSession()->write('articleId', $id);

        $article = $this->Articles
            ->find()
            ->where(['id' => $id])
            ->contain(['Comments', 'Tags'])
            ->first();

        $commentsUserName = array();
        foreach ($article->comments as $comment){
            $userName = $this->Articles->Users
                ->find()
                ->where(['id' => $comment->user_id])
                ->first();

            array_push($commentsUserName, $userName->pseudo);
        }

        $this->set(compact('article', 'commentsUserName'));

        /** Traitement POST **/
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            if($this->request->getSession()->read('userId') == null){
                $this->Flash->error("Please you must be oonnected to comment this article !");
                return $this->redirect($this->referer());
            }

            if(empty($data['commentText'])){
                $this->Flash->error("Please fill in the comment field !");
                return $this->redirect($this->referer());
            }

            $comment = $this->Articles->Comments->newEntity();
            $comment->user_id = $this->request->getSession()->read('userId');
            $comment->article_id = $this->request->getSession()->read('articleId');
            $comment->commentText = $data['commentText'];

            if(!$this->Articles->Comments->save($comment)){
                $this->Flash->error("We can\'t post your comment !");
                return $this->redirect($this->referer());
            }
            $this->Flash->success("Your comment has been well posted !");
            return $this->redirect($this->referer());
        }
    }

}