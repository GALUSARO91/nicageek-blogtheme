<?php

namespace Nicageek\Blogtheme\Traits;

trait Theme_Custom_Logo{

    public function ngbt_outputlogo(){
        // Outputs logo URL into an img tag 
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
        return esc_url( $custom_logo_url );
     }

}

