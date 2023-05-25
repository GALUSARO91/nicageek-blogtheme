<?php


function ngbt_get_header_info(){

    $defaults = [
        'header-type' => 'small',
        'header-mime' => '',
        'header-mimetype' => '',
        'header-scr' => ''

    ];

    $found_mimetype;
    $header_type = get_theme_mod('ngbt_header_setting')?get_theme_mod('ngbt_header_setting'):'';
    $header_id = get_theme_mod('ngbt_big_header_bg_setting');
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
    
    $defaults['header-type'] = $header_type;
    $defaults['header-mime'] = $header_mime;
    $defaults['header-mimetype'] = $found_mimetype??'';
    $defaults['header-src'] = $header_link?$header_link:'';

        return $defaults;
    }



function ngbt_assets(){
    // register bootstrap and google fonts
    $header_type = get_theme_mod('ngbt_header_setting');
    global $wp_query;
    wp_enqueue_style("google-font",'"https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;700&family=DynaPuff:wght@400;500;700&family=Quicksand:wght@300;400;500;700&display=swap',array(),false,'all');
    wp_enqueue_style("bootstrap","https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css",array(),"5-3",'all');
    wp_enqueue_script("boostrap-js","https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js");
    wp_enqueue_style("ratingbox", get_stylesheet_directory_uri()."/assets/css/ratingbox.css",['google-font','bootstrap'] );
    wp_register_style("404page", get_stylesheet_directory_uri()."/assets/css/404.css",[]);
    wp_register_script( "ratingbox-js", get_stylesheet_directory_uri()."/assets/js/ratingbox.js",[],null,true );
    wp_register_style( "small-header", get_stylesheet_directory_uri()."/assets/css/small-header.css",[] );
    wp_register_style( "big-header", get_stylesheet_directory_uri()."/assets/css/big-header.css",[]);
    wp_register_script("shrink-header", get_stylesheet_directory_uri()."/assets/js/shrinkheader.js",[],null,true);
    if($wp_query->is_single){
        wp_localize_script("ratingbox-js",'ngbt' ,[
            'endpoint' => rest_url('ngbt'),
        ]);
        wp_enqueue_script('ratingbox-js');
    }

    if($wp_query->is_404){
        wp_enqueue_style("404page");
    }

    if($header_type == 'small'){
        wp_enqueue_style("small-header");

    } else {
        wp_enqueue_style("big-header");
        wp_enqueue_script('shrink-header');

    }
}

add_action("wp_enqueue_scripts","ngbt_assets");


function ngbt_register_theme_supports() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails',['post','page']);
    add_theme_support('custom-logo',
        array( 'width' => 100,
        'height' => 100,
        'flex-width' => true,
        'flex-height' => true)
    );
    add_theme_support("widgets");
 }
 add_action( 'after_setup_theme', 'ngbt_register_theme_supports');

function ngbt_add_edit_post_featured_image(){
    add_post_type_support('post', 'post-thumbnails');
}

add_action('init','ngbt_add_edit_post_featured_image');

 function ngbt_outputlogo(){
    // Outputs logo URL into an img tag 
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
    return esc_url( $custom_logo_url );
 }

 function ngbt_register_menus(){
    register_nav_menus( ["menu-header" =>"Menu Header"] );
 }

add_action('init','ngbt_register_menus');

 function ngbt_register_footer_sidebars(){
    // 4 sidebars added to the footer
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
 }

 add_action('widgets_init','ngbt_register_footer_sidebars');


$meta_args = [
    'type' => 'string',
    'single'=> false,
    'show_in_rest' => true   
];
    
register_post_meta('post','ngbt-rating',$meta_args);

 function ngbt_api_rating_route(){
    register_rest_route(
        'ngbt',
        'rating',
            [
                "methods" => "POST",
                "callback" => "ngbt_post_rating"
            ]
    );
 }

 add_action('rest_api_init','ngbt_api_rating_route');

 function get_rating_template_part(){
    /* 
        render template with rating info
    */
    $rating_var = get_post_meta(get_the_ID(),'ngbt-rating',true); 
    $data = [
        "user_id" =>get_current_user_id(),
        "post_id" =>get_the_ID(),
        "rating_data" =>calculate_rating($rating_var)
    ];
    get_template_part('template-parts/content','ratingbox',$data);

 }

 function calculate_rating($rating){
    /* 
        @param $rating: is a serialized string containing all the rating data
    */
    if($rating){
        $rating_array = unserialize($rating);
        $rating_values_array = array_column($rating_array,'rating');
        $average = intval(array_sum($rating_values_array)/sizeof($rating_values_array));
        return $average;
    }
 }

 function ngbt_post_rating($request){
  
    try{
        $message =[];
        $found = false;
        $rating_var = get_post_meta($request["post"],'ngbt-rating',true);
        $data_to_push =[
            "user_id"   => $request["user_id"],
            "rating"    => $request["rating"]
        ];   
        if($rating_var){
            $unserialized_rating = unserialize($rating_var);

            foreach($unserialized_rating as $item){

                if($item["user_id"] == $request["user_id"]){
                    $found = true;
                    array_push($message,[
                        "msg" => "already voted",
                        "rating" => calculate_rating($rating_var),
                    ]);
                    break;
                }
            }
                if(!$found){
                    array_push($unserialized_rating,$data_to_push);
                    update_post_meta($request["post"],"ngbt-rating",serialize($unserialized_rating));
                    array_push($message,[
                        "msg" => "rating info updated",
                        "rating" => calculate_rating(serialize($unserialized_rating)),
                    ]);

            }  
        
        } else{
            array_push($message,[
                "msg" => "rating info updated",
                "rating" => $request["rating"] ,
            ]);
            update_post_meta($request["post"],"ngbt-rating",serialize([$data_to_push]));
        }
        
        return $message;
    }
    catch(Exception $e){
        error_log("Ha habido un error $e->getMessage()");
    }

 }

function ngbt_customize_register($wp_customize){
    $wp_customize->add_panel( 'ngbt_header_panel', array(
        'title' => "Header Options",
        'description' => "Select your header type and other properties",
        'capability' => 'edit_theme_options',
        'priority' => 160,
    ) );

    $wp_customize->add_section( 'ngbt_header_section', array(
        'title' => "Header Options",
        'description' => "This could be either a small header or a big one",
        'panel' => 'ngbt_header_panel',
    ) );

    $wp_customize->add_setting('ngbt_header_setting',array(
        'title' => "Header Options",
        'description' => "Select your header type",
        'default' => 'Option 1'

    ));


    $wp_customize->add_control( 'ngbt_header_control', array(
        'label' => "Header Control",
        'section' => 'ngbt_header_section',
        'settings'=>'ngbt_header_setting',
        'type' => 'select',
        'choices' => array(
            'small' => 'Small',
            'big' => 'Big'
            ),
    ) );


    $wp_customize->add_setting('ngbt_big_header_bg_setting',array(
        'default' => '',
        'type'    => 'theme_mod',

    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ngbt_big_header_bg_setting', array(
        'label'       => 'Big Header Background Option',
        'description' => 'Select the media to add',
        'section'     => 'ngbt_header_section',
        'mime_type'   => 'image/video',
        'active_callback' => function() use ( $wp_customize ) {
            return $wp_customize->get_setting( 'ngbt_header_setting' )->value() === 'big';
        },
    ) ) );


}
add_action( 'customize_register', 'ngbt_customize_register' );





