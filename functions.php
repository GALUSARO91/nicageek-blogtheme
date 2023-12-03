<?php

require_once get_stylesheet_directory().'/vendor/autoload.php';

use Nicageek\Blogtheme\Classes\Theme_Main as ThMain;


$theme_main = ThMain::init();

array_push($theme_main->section_names,[
    'name' => 'ngbt_header_section',
    'title' => 'Header Options',
    'description' =>'Select your header type and other properties'
]);

$GLOBALS['the_main'] = $theme_main;



require_once get_stylesheet_directory().'/misc/theme-functionalities.php';
require_once get_stylesheet_directory().'/misc/theme-options.php';
require_once get_stylesheet_directory().'/misc/theme-views.php';


$GLOBALS['the_main']->registerAllOptions();

$GLOBALS['the_main']->activateAllFunctionalities();


