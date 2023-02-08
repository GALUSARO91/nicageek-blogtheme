<?php
function ngbt_assets(){
    // register bootstrap and google fonts
    global $wp_query;
    wp_enqueue_style("google-font",'"https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;700&family=DynaPuff:wght@400;500;700&family=Quicksand:wght@300;400;500;700&display=swap',array(),false,'all');
    wp_enqueue_style("bootstrap","https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css",array(),"5-3",'all');
    wp_enqueue_script("boostrap-js","https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js");
    wp_enqueue_style("ratingbox", get_stylesheet_directory_uri()."/assets/css/ratingbox.css",['google-font','bootstrap'] );
    wp_register_script( "ratingbox-js", get_stylesheet_directory_uri()."/assets/js/ratingbox.js",[],null,true );
    if($wp_query->is_single){
        wp_localize_script("ratingbox-js",'ngbt' ,[
            'endpoint' => rest_url('ngbt'),
        ]);
        wp_enqueue_script('ratingbox-js');
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
 add_action( 'customize_register', 'ngbt_register_theme_supports');

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
    $rating_var = get_post_meta(get_the_ID(),'ngbt-rating',true); 
    error_log("rating var: ".$rating_var);
    $data = [
        "user_id" =>get_current_user_id(),
        "post_id" =>get_the_ID(),
        "rating_data" =>calculate_rating($rating_var)
    ];
    get_template_part('assets/template-parts/content','ratingbox',$data);

 }

 function calculate_rating($rating){
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
                    array_push($message,["msg" => "already voted"]);
                    break;
                }
            }
                if(!$found){
                    array_push($unserialized_rating,$data_to_push);
                    update_post_meta($request["post"],"ngbt-rating",serialize($unserialized_rating));

            }  
        
        } else{
            array_push($message,["msg" => "rating info updated"]);
            update_post_meta($request["post"],"ngbt-rating",serialize([$data_to_push]));
        }

        if(sizeof($message)> 1){
            array_push($message,["msg" => "rating info updated"]);
        }
        
        return $message;
    }
    catch(Exception $e){
        error_log("Ha habido un error $e->getMessage()");
    }

 }