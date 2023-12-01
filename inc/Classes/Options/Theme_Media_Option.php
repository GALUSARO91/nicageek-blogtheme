<?php

namespace Nicageek\Blogtheme\Classes\Options;

use Nicageek\Blogtheme\Classes\Options\Theme_Option;
use Nicageek\Blogtheme\Interfaces\Register_Option;
use \WP_Customize_Media_Control;

class Theme_Media_Option extends Theme_Option implements Register_Option{



    public function Register_Option($wp_customize):void{
            

            $wp_customize->add_setting($this->option_name,
                [
                    'title' => $this->option_title,
                    'type'    => $this->option_type,
                    'default' => $this->option_current_value,
                ]);

                $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $this->option_name, array(
                        'label'       =>    $this->option_control_label,
                        'description' =>    $this->option_description,
                        'section'     =>    $this->option_section,
                        'mime_type'   => 'image/video',
                        'active_callback' =>  function()use($wp_customize){
                            if (is_callable($this->option_control_callback)) {
                                return call_user_func($this->option_control_callback,$wp_customize);
                            }
                            
                            return false;
                        }
                ) ) );

        
    }

      
}