<?php

namespace Ngbt\classes;


class NgbtThemeOption{

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
            
        }

    }

    private function register_option($wp_customize){
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

    }

    public function init(){

        add_action( 'customize_register', array($this,'register_option') );
    }
}