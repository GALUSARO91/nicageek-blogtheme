<?php

// Declare Theme funcionalities

require_once get_stylesheet_directory().'/vendor/autoload.php';

use Nicageek\Blogtheme\Classes\Functionalities\Theme_Functionality as ThFunc;

/* 

    Begin addint theme support

*/
$theme_support_routine = function(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails',['post','page']);
    add_theme_support('custom-logo',
        array( 'width' => 100,
        'height' => 100,
        'flex-width' => true,
        'flex-height' => true)
    );
    add_theme_support("widgets");
};

$theme_support_args = [
    'featuer'       => 'theme_support',
    'hook'          => 'after_setup_theme',
    'filter'        => '',
    'filename'      => '',
    'feature-func'  => $theme_support_routine
    
];

$ng_theme_support = new ThFunc('ng_theme_support_functionality',$theme_support_args);
/* 

    End adding theme support

*/

/* 
    Begin adding theme dependencies

*/
$enqueue_dependencies_routine = function(){
    wp_enqueue_style("google-font",'"https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;700&family=DynaPuff:wght@400;500;700&family=Quicksand:wght@300;400;500;700&display=swap',array(),false,'all');
    wp_enqueue_style("bootstrap","https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css",array(),"5-3",'all');
    wp_enqueue_script("boostrap-js","https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js");
    wp_enqueue_style("ratingbox", get_stylesheet_directory_uri()."/assets/css/ratingbox.css",['google-font','bootstrap'] );
};

$theme_assets_args = [
    'featuer'       => 'enqueue_dependencies',
    'hook'          => 'wp_enqueue_scripts',
    'filter'        => '',
    'filename'      => '',
    'feature-func'  => $enqueue_dependencies_routine,

];

$ng_theme_assets =  new ThFunc('ng_theme_assets_functionality',$theme_assets_args);
/* 

    End adding theme dependencies

*/

/* 
    Begin adding theme menu

*/

$register_menu_routine = function(){
    register_nav_menus( ["menu-header" =>"Menu Header"] );
};

$theme_menu_args = [
    'feature' => 'theme_menu',
    'hook'=> 'init',
    'filter' =>'',
    'filename' => '',
    'feature-func'=> $register_menu_routine
];

$ng_theme_menu =  new ThFunc('ng_theme_menu_functionality',$theme_menu_args);
/* 
    End adding theme menu

*/


/* 
    Begin adding theme footer widgets

*/
$register_widgets_routine = function(){
    $sidebar1 =[
        'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',        
		'name'=>__( 'Sidebar 1', 'textdomain' ),
        'id' => 'sidebar-1'	
    ];
    $sidebar2 =[
        'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',        
		'name'=>__( 'Sidebar 2', 'textdomain' ),
        'id' => 'sidebar-2'	
    ];
    $sidebar3 =[
        'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',        
		'name'=>__( 'Sidebar 3', 'textdomain' ),
        'id' => 'sidebar-3'	
    ];
    $sidebar4 =[
        'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',        
		'name'=>__( 'Sidebar 4', 'textdomain' ),
        'id' => 'sidebar-4'	
    ];
    register_sidebar($sidebar1);
    register_sidebar($sidebar2);
    register_sidebar($sidebar3);
    register_sidebar($sidebar4);
};

$theme_widgets_args = [
    'feature'       => 'theme_widgets_args',
    'hook'          => 'widgets_init',
    'filter'        => '',
    'filename'      => '',
    'feature-func'  => $register_widgets_routine

];

$ng_theme_widgets =  new ThFunc('ng_theme_widgets_functionality',$theme_widgets_args);
/* 
    End adding theme footer widgets

*/


/* 
    Begin adding rating box functionality

*/

$rating_box_routine = function(){
    
    global $wp_query;
    wp_register_script( "ratingbox-js", get_stylesheet_directory_uri()."/assets/js/ratingbox.js",[],null,true );
    if($wp_query->is_single){
        wp_localize_script("ratingbox-js",'ngbt' ,[
            'endpoint' => rest_url('ngbt'),
        ]);
        wp_enqueue_script('ratingbox-js');
    }

};

$theme_rating_box_args = [
    'feature'       => 'theme_rating_box',
    'hook'          => 'wp_enqueue_scripts',
    'filter'        => '',
    'feature-func'  => $rating_box_routine
];
$ng_theme_rating_box =  new ThFunc('ng_theme_rating_box _functionality',$theme_rating_box_args);
/* 
    End adding rating box functionality

*/

$GLOBALS['the_main']->setFunctionalities([
    $ng_theme_support,
    $ng_theme_assets,
    $ng_theme_menu,
    $ng_theme_widgets,
    $ng_theme_rating_box,                  
]);