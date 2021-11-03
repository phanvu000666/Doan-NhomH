<?php
require_once 'Auth.php';

class FactoryPattern{
    public function make($model){
        if($model == 'auth'){
        return Auths::getInstance();
        } else {
            return null;
        }
    }
}
