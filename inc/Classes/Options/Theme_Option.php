<?php

namespace Nicageek\Blogtheme\Classes\Options;


class Theme_Option {

    public $option_name;
    public $option_control_label;
    public $option_control_name;
    public $option_title;
    public $option_description;
    public $option_current_value;
    public $option_section;
    public $option_type = 'string';
    public $option_control_callback;
    public $option_possible_values = [];

    public function __construct($args = null){
        if(isset($args)){
            $this->option_name = $args['option_name'];
            $this->option_current_value = $args['option_current_value'];
            $this->option_type = $args['option_type'];
            $this->option_title = $args['option_title'];
            $this->option_description = $args['option_description'];
            $this->option_section = $args['option_section'];
            $this->option_control_name = $args['option_control_name'];
            $this->option_control_label = $args['option_control_label'];
            $this->option_control_callback = $args['option_control_callback'];
            array_splice($this->option_possible_values,0,-1,$args['option_possible_values']);
            
        } else {
            throw new Exception ("Arguments where not entered");
        }

    }



    public function get_value(){
 
        return get_theme_mod($this->option_name,$this->option_current_value);
    }


    public function set_value($value){
  
         set_theme_mod($this->option_name,$value);
         $this->get_value();

    }

   
}