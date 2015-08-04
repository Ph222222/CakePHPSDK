<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('Component', 'Controller');

class ExampleComponent extends Component {

    public $status = 'success';

    public function hello($args) {
        return 'Hello World';
    }

    public function say($args) {
        if (empty($args['text'])) {
            throw new Exception('Missing argument: text');
        }
        return 'You said: ' . $args['text'];
    }
    public function posts() {
        return '/posts.json';
        
    }
}
