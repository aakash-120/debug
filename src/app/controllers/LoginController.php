<?php

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
      
    }

    public function loginAction()
    {
        // print_r($this->request->getPost('email'));
        // print_r($this->request->getPost('password'));
        // die;
        $data = array(
            "email" => $this->request->getPost('email'),
            "password" => $this->request->getPost('password')
        );
        $users = $this->mongo->test->users->findOne(["email" => $data['email'], "password" => $data['password']]);
    //   echo "<pre>";
    //     print_r($users);
     //   print_r($users['role']);
        
        if (empty($data['email']) || empty($data['password'])) {
            $this->view->loginmsg = "Please fill all fields";
        }
        if (!$users) {
            $this->view->loginmsg = "User Does not exist";
        }
        if ($users['role'] == 'user')
        {
            $this->response->redirect('/frontend/index');
        }
        if ($users['role'] == 'admin')
        {
            $this->response->redirect('/orders/index');
        }

        // else {
        //     $this->response->redirect('orders/index');
        // }
    }
}
