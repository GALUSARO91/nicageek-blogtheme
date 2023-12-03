<?php

require_once get_stylesheet_directory().'/vendor/autoload.php';


use Nicageek\Blogtheme\Classes\Options\Theme_Media_Option as ThMOpt;

use Nicageek\Blogtheme\Classes\Options\Theme_NO_Media_Option  as ThNoMOpt;



$header_args = [
    'option_name' => 'ngbt_header_setting',
    'option_current_value' => 'small',
    'option_type' => 'select',
    'option_title' => 'Header Options',
    'option_description' => 'Select your header type',
    'option_section' => 'ngbt_header_section',
    'option_possible_values' => array(
        'small' => 'Small',
        'big' => 'Big',
    ),
    'option_control_name' => 'ngbt_header_control',
    'option_control_label' => 'Header Control',
    'option_control_callback' => '',
];

$ng_header_option = new ThNoMOpt($header_args);



$big_header_args = [
    'option_name' => 'ngbt_big_header_bg_setting',
    'option_current_value' => '',
    'option_type' => 'theme_mod',
    'option_title' => 'Header Options',
    'option_description' => 'Select the media to add',
    'option_section' => 'ngbt_header_section',
    'option_possible_values' =>'',
    'option_control_name' => '',
    'option_control_label' => 'Big Header Background Option',
    'option_control_callback' =>function($wp_customize){

        // $test_control = get_theme_mod('ngbt_header_setting');
        $custom_setting = $wp_customize->get_setting( 'ngbt_header_setting' );
        $custom_value = $custom_setting->value();
        $output = (bool) $custom_value == '1';
        return $output;
    },
    
];

$ng_big_header_option = new ThMOpt($big_header_args);


$GLOBALS['the_main']->setOptions([
    $ng_header_option,
    $ng_big_header_option
]);