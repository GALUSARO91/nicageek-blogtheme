<?php

namespace Nicageek\Blogtheme\Classes\Options;

use Nicageek\Blogtheme\Classes\Options\Theme_Option;
use Nicageek\Blogtheme\Interfaces\Register_Option;
use Nicageek\Blogtheme\Traits\Theme_Activate_Function_Handler;
use \WP_Customize_Color_Control;

class Theme_Color_Option extends Theme_Option implements Register_Option{

    use Theme_Activate_Function_Handler;

    public function Register_Option($wp_customize):void{
            

            $wp_customize->add_setting($this->option_name,
                [
                    'title' => $this->option_title,
                    'type'    => $this->option_type,
                    'default' => $this->option_current_value,
                ]);

                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $this->option_name, array(
                        'label'       =>    $this->option_control_label,
                        'description' =>    $this->option_description,
                        'section'     =>    $this->option_section,
                        'active_callback' => $this->Activate_Function_Handler($this->option_control_callback,$wp_customize),
                ) ) );

        
    }

      
}