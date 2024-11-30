<?php

namespace Nicageek\Blogtheme\Traits;

trait Theme_Activate_Function_Handler{

public function Activate_Function_Handler($Custom_Function,$wp_customize){
        $is_a_function = is_callable($Custom_Function);
        if (!$is_a_function) {
           
            return false;
        } 
        
        return function()use($Custom_Function,$wp_customize){
            return call_user_func($this->option_control_callback,$wp_customize);
        };
    }

}