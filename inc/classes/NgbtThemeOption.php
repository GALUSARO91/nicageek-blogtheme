<?php

namespace Ngbt\classes;

use Ngbt\interfaces\NgbtRegisterOption;


class NgbtThemeOption implements NgbtRegisterOption{

    public $option_name;
    public $option_control_label;
    public $option_title;
    public $option_description;
    public $option_value;
    public $option_section;
    public $option_type = 'string';
    public $option_possible_values = [];

    public function __construct($args = null){
        if(isset($args)){
            $option_name = $args['option_name'];
            $option_value = $args['option_value'];
            $option_type = $args['option_type'];
            $option_title = $args['option_title'];
            $option_description = $args['option_description'];
            $option_section = $args['option_section'];
            array_splice($this->option_possible_values,0,$args['option_possible_values']);
            
        } else {
            throw new Exception ("Arguments where not entered");
        }

    }

    public function register_option(){

        add_action('customize_register', function($wp_customize){

            $wp_customize->add_setting('ngbt_'.$this->$option_name.'_setting',
                [
                    'title' => $this->option_title,
                    'description' => $this->option_description,
                    'default' => $this->option_value,
                ]);

            $wp_customize->add_control('ngbt_'.$this->$option_name.'_section',
                [
                    'label' => $this->option_control_label,
                    'section' => $this->option_section,
                    'settings' => 'ngbt_'.$this->$option_name.'_setting',
                    'type' => $this->option_type,
                    'choices' => $this->option_possible_values

                ]);
        });
        
    }

    public function get_value(){

        return get_theme_mod('ngbt_'.$this->$option_name.'_setting',$this->option_value);
    }


    public function set_value($value){
        
         set_theme_mod('ngbt_'.$this->$option_name.'_setting',$value);

    }

   
}