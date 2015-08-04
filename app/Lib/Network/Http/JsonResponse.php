<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('HttpSocketResponse', 'Network/Http');

class JsonResponse extends HttpSocketResponse {

    public function __toString() {
        return json_encode($this->body);
    }

    public function body() {
        return $this->body;
    }

    public function isOk() {
        if (parent::isOk()) {
            return ($this->body['status'] === 'success');
        }
        return false;
    }

    public function parseResponse($message) {
        parent::parseResponse($message);
        $this->body = json_decode($this->body, true);
    }

}
