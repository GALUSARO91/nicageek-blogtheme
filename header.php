<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="<?php bloginfo("charset");?>">
    <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_uri() ); ?>" type="text/css" />
    <?php wp_head();?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php 
        $header_options = ngbt_get_header_info(); 
        if($header_options['header-type']!='small' && $header_options['header-mime'] =='image'){
            echo '<style>
                    #shrink-header{
                    background-image: url("'.$header_options['header-src'].'")
                    }
            </style>';
        }
    ?>
</head>
<body>
    <?php 
   
        if($header_options['header-type']=='small'){
            get_template_part( '/template-parts/content', 'small-header');

        } else{
            get_template_part( '/template-parts/content', 'big-header',$header_options);
        } 
        
    ?>
    <main>