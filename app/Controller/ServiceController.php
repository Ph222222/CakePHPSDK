<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

class ServiceController extends AppController {

    public function call($value) {
        $config = array(
            'request' => array(
                'uri' => array(
                    'host' => env('HTTP_HOST')
                )
            )
        );
        $http = new HttpSocket($config);
        $http = new HttpSocket();
        $http->responseClass = 'JsonResponse';
       /* $response = $http->get('/api/example/say', array('text' =>
            $value));
        if ($response->isOk()) {
            $this->set('result', $response->body['data']);
        } else {
            throw new CakeException('Web service error');
        }*/
    }

}
