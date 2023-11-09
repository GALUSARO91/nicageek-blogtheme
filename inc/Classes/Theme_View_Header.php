<?php

namespace Nicageek\Blogtheme\Classes;
use Nicageek\Blogtheme\Classes\Abstract_Theme_View;

abstract class Theme_View_Header extends Abstract_Theme_View {


    public function render(array $options):void{

        ob_start();
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
                $options = ngbt_get_header_info(); 
                if($header_options['header-type']!='small' && $options['header-mime'] =='image'){
                    echo '<style>
                            #shrink-header{
                            background-image: url("'.$options['header-src'].'")
                            }
                    </style>';
                }
            ?>
        </head>
        <body>
            <?php 
           
                if($header_options['header-type']=='big'){
                    get_template_part( '/template-parts/content', 'big-header',$header_options);
        
                } else{
                    
                    get_template_part( '/template-parts/content', 'small-header');
                } 
                
            ?>
            <main>

       <?php
        
        echo  ob_clean();
    
    }
}