<?php

require_once get_stylesheet_directory().'/vendor/autoload.php';

use Nicageek\Blogtheme\Classes\Views\Theme_View_Header as ThVwHeader;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Big_Header as ThVwBigHeader;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Small_Header as ThVwSmallHeader;


$ngbt_small_header = new ThVwSmallHeader('small-header');

$ngbt_big_header = new ThVwBigHeader('big-header');


$ngbt_header = new ThVwHeader(
    'ngbt-header',
    [
        $ngbt_small_header,
        $ngbt_big_header
    ]
    );

$GLOBALS['theme_main']->setViews([$ngbt_header]);