<?php
/**
 * Created by PhpStorm.
 * User: Helloïs
 * Date: 10/04/2019
 * Time: 21:16
 */

namespace App\Controller;


class TagsController extends AppController
{

    public function createtag(){
        $tags = $this->Tags
            ->find()
            ->all();

        $this->set(compact('tags'));

        /** Processing POST **/
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if(empty($data['name'])){
                $this->Flash->error('Please fill in a name for the new tag !');
                return $this->redirect($this->referer());
            }
            else{
                $search = $this->Tags
                    ->find()
                    ->where(['name' => $data['name']])
                    ->first();

                if($search != null){
                    $this->Flash->error('An other tag already have this name !');
                    return $this->redirect($this->referer());
                }
                else{
                    $tag = $this->Tags->newEntity();
                    $tag->name = $data['name'];

                    if(!$this->Tags->save($tag)){
                        $this->Flash->error('We encountered a trouble to save your new tag in database !');
                        return $this->redirect($this->referer());
                    }
                    else{
                        $this->Flash->success('Your tag has been well created !');
                        return $this->redirect('/homepage');
                    }
                }
            }
        }
    }


    public function deletetag($id){
        $tag = $this->Tags
            ->find()
            ->where(['id' => $id])
            ->first();

        if(!$this->Tags->delete($tag, true)){
            $this->Flash->error('We can\'t delete well this tags !');
            return $this->redirect($this->referer());
        }
        else{
            $this->Flash->success('Your tag has been well deleted !');
            return $this->redirect('/homepage');
        }
    }

}