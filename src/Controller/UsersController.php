<?php
/**
 * Created by PhpStorm.
 * User: Helloïs
 * Date: 10/04/2019
 * Time: 21:16
 */

namespace App\Controller;


class UsersController extends AppController
{

    /**
     *
     * This function allows users to login on the website
     *
     */
    public function connection(){
        /** POST processing **/
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            if((empty($data['mail'])) || (empty($data['password']))){
                $this->Flash->error('Please fill in all the fields !');
                return $this->redirect($this->referer());
            }


            /** We check that the email address is well an email address thanks to regex **/
            if (!filter_var($data['mail'], FILTER_VALIDATE_EMAIL)) {
                $this->Flash->error('The email address you entered is not correct!');
                return $this->redirect($this->referer());
            }


            /** We search if the email address matches another one in the DB **/
            $search = $this->Users
                ->find()
                ->where(['email' => $data['mail']])
                ->first();

            if(empty($search)){
                $this->Flash->error('This email address doesn\'t exist !');
                return $this->redirect($this->referer());
            }

            //We hash password to compare with the password in DB
            $data['password'] = hash('sha256',$data['password']);
            if(strcmp($data['password'], $search->password) != 0){
                $this->Flash->error('The password is wrong !');
                return $this->redirect($this->referer());
            }

            $this->request->getSession()->write('userName', $search->pseudo);
            $this->request->getSession()->write('userId', $search->id);
            $this->Flash->success('You are now connected ! Hi '.$search->pseudo.' !');
            if($search->admin){
                $this->request->getSession()->write('isAdmin', 1);
            }
            else{
                $this->request->getSession()->write('isAdmin', 0);
            }
            return $this->redirect('/homepage');
        }
    }



    /**
     * This fuction allow to users to create an account and after to connect and our website
     * @return \Cake\Http\Response|null
     */
    public function createaccount(){
        /** Processing POST **/
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            if ((empty($data['name'])) ||(empty($data['mail'])) || (empty($data['password'])) || (empty($data['repeatPassword']))) {
                $this->Flash->error('Please fill in all the fields !');
                return $this->redirect($this->referer());
            }else{
                /** We check that the email address is well an email address thanks to regex **/
                if (!filter_var($data['mail'], FILTER_VALIDATE_EMAIL)) {
                    $this->Flash->error('The email address you entered is not correct!');
                    return $this->redirect($this->referer());
                }

                $search = $this->Users
                    ->find()
                    ->select(['id'])
                    ->where(['email' => $data['mail']])
                    ->first();


                /** If we find a USER with the same mail address we redirect user **/
                if (!empty($search)) {
                    $this->Flash->error('This email address already exist !');
                    return $this->redirect($this->referer());
                }

                /** If the password and the repeat password are not the same we redirect user **/
                if ($data['password'] != $data['repeatPassword']) {
                    $this->Flash->error('You have don\'t enter the same password !');
                    return $this->redirect($this->referer());
                }

                /** The password must be larger than 8 characters **/
                if (strlen($data['password']) < 9) {
                    $this->Flash->error('Your password must be larger than 8 characters !');
                    return $this->redirect($this->referer());
                }


                /** All is correct we save the account in DB **/
                $user = $this->Users->newEntity();
                $user->pseudo = $data['name'];
                $user->email = $data['mail'];
                $user->admin = false;

                //Hash the password
                $psw = hash('sha256', $data['password']);
                $user->password = $psw;

                if (!$this->Users->save($user)) {
                    $this->Flash->error('Error, we can\'t create an account in Database');
                    return $this->redirect($this->referer());
                }
                $this->Flash->success("Your account has been well created");
                return $this->redirect('/login');
            }
        }
    }


    public function disconnect(){
        $this->request->getSession()->delete('userId');
        $this->request->getSession()->delete('isAdmin');
        $this->Flash->success('You are now disconnected ! Bye '.$this->request->getSession()->read('userName').'!');
        $this->request->getSession()->delete('userName');
        return $this->redirect('/homepage');
    }

}