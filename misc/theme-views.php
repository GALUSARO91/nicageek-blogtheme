<?php

require_once get_stylesheet_directory().'/vendor/autoload.php';

use Nicageek\Blogtheme\Classes\Views\Theme_View_Header as ThVwHeader;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Big_Header as ThVwBigHeader;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Small_Header as ThVwSmallHeader;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Footer as ThVwFooter;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Front_Page as ThVwFrontPage;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Rating as ThVwRating;


/* 

    Begin adding header template

*/
$ngbt_small_header = new ThVwSmallHeader('small-header');

$ngbt_big_header = new ThVwBigHeader('big-header');


$ngbt_header = new ThVwHeader(
    'ngbt-header',
    [
        $ngbt_small_header,
        $ngbt_big_header
    ]
    );
/* 

    Stop adding header template

    Begin adding rating template

*/
$ngbt_rating = new ThVwRating('ratingbox');

/* 

    Stop adding rating template

    Begin adding footer template

*/

$ngbt_footer = new ThVwFooter('ngbt-footer');

/* 

    Stop adding footer template

    Begin adding Front page template

*/

$ngbt_front_page = new ThVwFrontPage('ngbt-front-page',[
    $ngbt_rating
]);

/* 

    Stop adding Front page template

*/


$GLOBALS['theme_main']->setViews([
    $ngbt_header,
    $ngbt_footer,
    $ngbt_front_page
]);