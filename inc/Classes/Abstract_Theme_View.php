<?php

namespace Nicageek\Blogtheme\Classes;

abstract class Abstract_Theme_View {

    public $template_name;
    public $template_parts = [];

    public function __construct($name,$parts = null){
        $this->template_name = $name;
        array_splice($this->template_parts,0,-1,$parts);
    }

    abstract public function render(array $options = null):void;
}