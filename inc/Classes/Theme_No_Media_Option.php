<?php

namespace Nicageek\Blogtheme\Classes;

use Nicageek\Blogtheme\Classes\Theme_Option;
use Nicageek\Blogtheme\Interfaces\Register_Option;


class Theme_No_Media_Option extends Theme_Option implements Register_Option{



    public function Register_Option($wp_customize):void{
            

            $wp_customize->add_setting('ngbt_'.$this->option_name.'_setting',
                [
                    'title' => $this->option_title,
                    'description' => $this->option_description,
                    'default' => $this->option_current_value,
                ]);

            $wp_customize->add_control('ngbt_'.$this->option_name.'_section',
                [
                    'label' => $this->option_control_label,
                    'section' => $this->option_section,
                    'settings' => 'ngbt_'.$this->option_name.'_setting',
                    'type' => $this->option_type,
                    'choices' => $this->option_possible_values

                ]);
        
    }

      
}