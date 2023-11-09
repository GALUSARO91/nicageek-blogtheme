<?php

namespace Nicageek\Blogtheme\Classes;

/* *
    * Class name:   Theme_Functionality
    * Description:  Sets up all the params that will create all the functionalities
    * Params:
    * @param string $name, is the name of the functionality
    * @param array $args, are the different files, methods, hooks used on the funcionality
    {
        feature: string,
        hook: string,
        filter: string,
        filename: string,
        feature-func: callable,
    }
*/

class Theme_Functionality {
    public $functionality_name;
    public $functionality_args;
    private $is_active = false;


    public function __construct($name,$args){
        $this->functionality_name = $name;
        $this->functionality_args = $args;
    }

    public function activate(){

        $this->is_active = true;
     
    }

    public function get_functionality_status(){
        return $this->is_active;
    }

    public function deactivate(){

        $this->is_active = false;
     
    }
}