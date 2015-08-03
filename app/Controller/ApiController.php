<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

class ApiController extends AppController {

    public function delegate($object, $command) {
        $result = null;
        try {
            if ($this->request->is('post') || $this->request->is('put')) {
                $args = $this->request->data;
            } else {
                $args = $this->request->query;
            }
            $component = Inflector::camelize($object);
            $this->{$component} = $this->Components->load($component);
            $this->{$component}->initialize($this);
            $action = Inflector::camelize($command);
            $return = $this->{$component}->{$action}($args);
            if ($this->{$component}->status === 'success') {

                $result = $this->_success($return);
            } else {
                $result = $this->_fail($return);
            }
        } catch (Exception $e) {
            $result = $this->_error($e->getMessage(), $e->getCode(), $result);
        }
        $this->response->type('json');
        $this->response->statusCode(200);
        $this->response->body($result);
        $this->response->send();
        $this->_stop();
    }

    protected function _format($status, $response = array()) {
        $object = new stdClass();
        $object->status = $status;
        foreach ($response as $param => $value) {
            $object->{$param} = $value;
        }
        return json_encode($object);
    }

    protected function _success($data = null) {
        return $this->_format('success', array('data' => $data));
    }

    protected function _fail($data = null) {
        return $this->_format('fail', array('data' => $data));
    }

    protected function _error($message = 'Unknown', $code = 0, $data = array()) {
        return $this->_format('error', array(
                    'message' => $message,
                    'code' => $code,
                    'data' => $data
        ));
    }

}
