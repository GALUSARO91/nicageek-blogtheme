<?php

require_once get_stylesheet_directory().'/vendor/autoload.php';

use Nicageek\Blogtheme\Classes\Views\Theme_View_Header as ThVwHeader;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Big_Header as ThVwBigHeader;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Small_Header as ThVwSmallHeader;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Footer as ThVwFooter;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Front_Page as ThVwFrontPage;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Rating as ThVwRating;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Home_Page as ThVwHomePage;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Page as ThVwPage;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Index_Page as ThVwIndexPage;
use Nicageek\Blogtheme\Classes\Views\Theme_View_Single_Page as ThVwSingle;
use Nicageek\Blogtheme\Classes\Views\Theme_View_404 as ThVw404;
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

    Begin adding Home page template
*/

$ngbt_home_page = new ThVwHomePage('ngbt-home-page');

/* 
    Stop adding Home page template

    Begin adding Page template
*/

$ngbt_page = new ThVwPage('ngbt-page');

/* 
    Stop adding Page template

    Begin adding Index Page template
*/

$ngbt_index_page = new ThVwIndexPage('ngbt-index');

/* 
    Stop adding index template

    Begin adding Single template
*/

$ngbt_single_page =new ThVwSingle('ngbt-single',[
    $ngbt_rating
]);

/* 
    Stop adding Single template

    Begin adding 404 template
*/
$ngbt_404 = new ThVw404('ngbt-404');

/* 
    Stop adding 404 template
*/

$GLOBALS['theme_main']->setViews([
    $ngbt_header,
    $ngbt_footer,
    $ngbt_front_page,
    $ngbt_home_page,
    $ngbt_page,
    $ngbt_index_page,
    $ngbt_single_page,
    $ngbt_404
]);