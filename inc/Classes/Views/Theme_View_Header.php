<?php

namespace Nicageek\Blogtheme\Classes\Views;
use Nicageek\Blogtheme\Classes\Views\Abstract_Theme_View;

Class Theme_View_Header extends Abstract_Theme_View {


    public function render($params = null):void{
        global $the_main;
        ?>
        <!DOCTYPE html>
        <html <?php language_attributes();?>>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta charset="<?php bloginfo("charset");?>">
            <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_uri() ); ?>" type="text/css" />
            <?php wp_head();?>
            <title><?php wp_title( '|', true, 'right' ); ?></title>
            <?php 
                $found_mimetype;
                $header_id = $the_main->getChildByNameAndType('ngbt_big_header_bg_setting','option')->get_value();
                $header_link = wp_get_attachment_url($header_id);
                $header_meta = wp_get_attachment_metadata($header_id)?wp_get_attachment_metadata($header_id):[];
                if($header_meta){
                    array_walk_recursive($header_meta,function ($value,$key) use(&$found_mimetype){
                        if($key == 'mime_type' || $key == 'mime-type'){
                            $found_mimetype= $value;
                         }
                    },$found_mimetype);
                
                } 
                $header_mime = isset($found_mimetype)?strtok($found_mimetype,'/'):"";

                $options = [
                    'header-type' => $the_main->getChildByNameAndType('ngbt_header_setting','option')->get_value(),
                    'header-mime' => $header_mime,
                    'header-mimetype' => $found_mimetype??'',
                    'header-src' => $header_link?$header_link:'',
                    'header-color' => $the_main->getChildByNameAndType('ngbt_sm_header_bg_setting','option')->get_value(),
                    
                ]; 
                
                if($options['header-type']!=0 && $options['header-mime'] =='image'){
                    echo '<style>
                            #shrink-header{
                             background-image: url("'.$options['header-src'].'")
                            }
                    </style>';
                } else {
                    echo '<style>
                            header{
                                background-color:'.$options['header-color'].'
                            }
                    </style>';
                }
                $header_font_color = $the_main->getChildByNameAndType('ngbt_header_font_color_setting','option')->get_value();
                $header_link_color = $the_main->getChildByNameAndType('ngbt_header_link_font_color_setting','option')->get_value();

                echo "<style>
                    .site-title{
                        color: $header_font_color;
                        }
                    #navbarNav .nav-link{
                        color: $header_link_color !important
                    }
                </style>"
            ?>
        </head>
        <body>
            <?php 
           
                if($options['header-type']==1){

                    $this->get_view_part('big-header')->render($options);
                  
        
                } else{
                    $view_part= $this->get_view_part('small-header');
                    $view_part->render();
                } 
                
            ?>
            <main>

       <?php
        
    
    }
}