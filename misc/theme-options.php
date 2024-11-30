<?php

require_once get_stylesheet_directory().'/vendor/autoload.php';


use Nicageek\Blogtheme\Classes\Options\Theme_Media_Option as ThMOpt;
use Nicageek\Blogtheme\Classes\Options\Theme_Color_Option as ThCOpt;
use Nicageek\Blogtheme\Classes\Options\Theme_NO_Media_Option  as ThNoMOpt;

/* Set Header Options */

$header_args = [
    'option_name' => 'ngbt_header_setting',
    'option_current_value' => 'small',
    'option_control_type' => 'select',
    'option_title' => 'Header Options',
    'option_description' => 'Select your header type',
    'option_section' => 'ngbt_header_section',
    'option_possible_values' => array(
        'small' => 'Small',
        'big' => 'Big',
    ),
    'option_control_name' => 'ngbt_header_control',
    'option_control_label' => 'Header Control',
    'option_control_callback' => ''
];

$ng_header_option = new ThNoMOpt($header_args);

/* End  Header Options */

/* Set Small Header Options*/

$small_header_args=[

    'option_name' => 'ngbt_sm_header_bg_setting',
    'option_control_type' => 'color',
    'option_current_value' => '#B0413E',
    'option_possible_values'=>[],
    'option_title' => 'Small Header Color',
    'option_description' => 'Select Backgrund color',
    'option_section' => 'ngbt_header_section',
    'option_control_name' => 'ngbt_sm_header_bg_control',
    'option_control_label' => 'Small Header Color',
    'option_control_callback' =>function($wp_customize){

        $custom_setting = $wp_customize->get_setting( 'ngbt_header_setting' );
        $custom_value = $custom_setting->value();
        $output = (bool) $custom_value != '1';
        return $output;
    }, 

];

$ng_small_header_option = new ThCOpt($small_header_args);
    

/* End Set Small Header Options*/

/* Set Big Header Options */

$big_header_args = [
    'option_name' => 'ngbt_big_header_bg_setting',
    'option_control_type' => 'media',
    'option_current_value' => '',
    'option_title' => 'Header Options',
    'option_description' => 'Select the media to add',
    'option_section' => 'ngbt_header_section',
    'option_possible_values' =>'',
    'option_control_name' => '',
    'option_control_label' => 'Big Header Background Option',
    'option_control_callback' =>function($wp_customize){

        $custom_setting = $wp_customize->get_setting( 'ngbt_header_setting' );
        $custom_value = $custom_setting->value();
        $output = (bool) $custom_value == '1';
        return $output;
    },
    
];

$ng_big_header_option = new ThMOpt($big_header_args);

/* End Big Header Options */

/* Set Header Font Color Options */
$header_font_color_args=[

    'option_name' => 'ngbt_header_font_color_setting',
    'option_control_type' => 'color',
    'option_current_value' => '#FFFFFF',
    'option_possible_values'=>[],
    'option_title' => ' Header Font Color',
    'option_description' => 'Select Header Font Color',
    'option_section' => 'ngbt_header_section',
    'option_control_name' => 'ngbt_header_font_color_control',
    'option_control_label' => 'Header Font Color',
    'option_control_callback' =>function(){

        return true;
    }, 

];

$ng_header_font_color_option = new ThCOpt($header_font_color_args);

/* End Header Font Color Options */



/* Set Header Link Font Color Options */

$header_link_font_color_args=[

    'option_name' => 'ngbt_header_link_font_color_setting',
    'option_control_type' => 'color',
    'option_current_value' => '#FFFFFF',
    'option_possible_values'=>[],
    'option_title' => ' Header Link Font Color',
    'option_description' => 'Select Header Link Font Color',
    'option_section' => 'ngbt_header_section',
    'option_control_name' => 'ngbt_header_link_font_color_control',
    'option_control_label' => 'Header Font Link Color',
    'option_control_callback' =>function(){

        return true;
    }, 

];

$ng_header_link_font_color_option = new ThCOpt($header_link_font_color_args);


$GLOBALS['the_main']->setOptions([
    $ng_header_option,
    $ng_big_header_option,
    $ng_small_header_option,
    $ng_header_font_color_option,
    $ng_header_link_font_color_option
]);