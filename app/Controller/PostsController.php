<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


App::uses('AppController', 'Controller');

class PostsController extends AppController {

    public $components = array('RequestHandler');

    public function index() {
        $this->set(array(
            'posts' => $this->Post->find('all'),
            '_serialize' => array('posts')
        ));
    }
   
    public function view($id) {
        $this->set(array(
            'post' => $this->Post->findById($id),
            '_serialize' => array('post')
        ));
    }

    public function edit($id) {
        $this->Post->id = $id;
        $status = $this->Post->save($this->request->data);
        $this->set(array(
            'status' => ($status) ? 'Post updated' : 'Error updating post',
            '_serialize' => array('status')
        ));
    }

    public function delete($id) {
        $status = $this->Post->delete($id);
        $this->set(array(
            'status' => ($status) ? 'Post deleted' : 'Error deleting post',
            '_serialize' => array('status')
        ));
    }

}
