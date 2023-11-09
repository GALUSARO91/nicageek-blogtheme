<?php

namespace Nicageek\Blogtheme\Classes;

use Nicageek\Blogtheme\Classes\Theme_Option;
use Nicageek\Blogtheme\Interfaces\Register_Option;
use \WP_Customize_Media_Control;

class Theme_Media_Option extends Theme_Option implements Register_Option{



    public function Register_Option($wp_customize):void{
            

            $wp_customize->add_setting('ngbt_'.$this->option_name.'_setting',
                [
                    'title' => $this->option_title,
                    'type'    => 'theme_mod',
                    'default' => $this->option_current_value,
                ]);

                $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ngbt_'.$this->option_name.'_setting', array(
                        'label'       =>    $this->option_control_label,
                        'description' =>    $this->option_description,
                        'section'     =>    $this->option_section,
                        'mime_type'   => 'image/video',
                        'active_callback' => function() use ( $wp_customize ) {
                            return $wp_customize->get_setting( 'ngbt_header_setting' )->value() === 'big';
                        },
                ) ) );

        
    }

      
}