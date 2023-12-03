<?php

namespace Nicageek\Blogtheme\Classes\Views;

abstract class Abstract_Theme_View {

    public $template_name;
    public $template_parts = [];

    public function __construct($name,$parts = null){
        $this->template_name = $name;
        array_splice($this->template_parts,0,-1,$parts);
    }

    abstract public function render($params =null):void;

    public function get_view_part($name = null ){
        $found = array_filter($this->template_parts,function($part)use($name){
            if($part->template_name == $name){
                return true;
            }
            
        });
        $return = array_values($found);
        return $return[0];
    }
}