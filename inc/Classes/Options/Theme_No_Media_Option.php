<?php

namespace Nicageek\Blogtheme\Classes\Options;

use Nicageek\Blogtheme\Classes\Options\Theme_Option;
use Nicageek\Blogtheme\Interfaces\Register_Option;


class Theme_No_Media_Option extends Theme_Option implements Register_Option{



    public function Register_Option($wp_customize):void{
            

            $wp_customize->add_setting($this->option_name,
                [
                    'title' => $this->option_title,
                    'description' => $this->option_description,
                    'default' => $this->option_current_value,
                ]);

            $wp_customize->add_control($this->option_control_name,
                [
                    'label' => $this->option_control_label,
                    'section' => $this->option_section,
                    'settings' => array($this->option_name),
                    'type' => $this->option_control_type,
                    'choices' => $this->option_possible_values

                ]);
        
    }

      
}