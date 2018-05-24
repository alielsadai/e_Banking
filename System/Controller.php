<?php
class Controller{
    private $data = [];
    
    protected function set($name, $value){
        if(preg_match('/[a-z]+[a-z_]*$/', $name)){
            $this->data[$name] = $value;
        }
    }
    
    final public function getData(){
        return $this->data;
    }
    
    public function index(){
        
    }
}
