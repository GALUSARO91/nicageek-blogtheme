<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="<?php bloginfo("charset");?>">
    <link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_uri() ); ?>" type="text/css" />
    <?php wp_head();?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>

</head>
<body>
    <header class="navbar sticky-top navbar-expand-sm">
        <nav class="container-fluid row">
            <a href="<?php bloginfo( 'url' );?>" class="site-logo navbar-brand col-3">
                    <!-- <p class="d-inline-block align-text-top">😼</p> -->
                    <div class="row">
                        <img src="<?php echo get_theme_mod( 'logo' ); ?>" alt="Site logo" class="col mw-">
                        <h1 class ="site-title col"><?php bloginfo( 'name' ); ?></h1>
                    </div>
            </a>
            <div class="searchbar col-3">
                <?get_search_form();?>              
            </div>
            <div class="col-3">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>              
                <ul class="collapse navbar-collapse navbarnav" id="navbarNav">
                    <li><a class="nav-link" href="#" >Link 1</a></li>
                    <li><a class="nav-link" href="#" >Link 2</a></li>
                    <li><a class="nav-link" href="#" >Link 3</a></li>      
                </ul>
            </div>
        </nav>
    </header>
    <main>