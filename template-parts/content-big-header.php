
<header class="sticky-top" id="shrink-header">
    <nav class="navbar container-fluid navbar-expand-sm">
                <div class="container-fluid justify-content-center row">

                <div class="col-4">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>             
                        <?php wp_nav_menu( [
                            "menu" => "menu-header",
                            "container" => "",
                            "menu_class" => "collapse navbar-collapse navbarnav",
                            "menu_id" => "navbarNav",
                            "link_before" =>'<span class="nav-link">',
                            "link_after" => "</span>"
                        ] )?> 
                </div>
            
                    
                    <div class="searchbar col-3" id="search-form">
                        <?get_search_form();?>              
                    </div>

                    <a href="<?php echo bloginfo('url');?>" class="site-logo navbar-brand col-3">
                        
                        <div class="row">
                            <img src="<?php echo $args['logo']; ?>" alt="Site logo" class="col mw-">
                        </div>
                </a>
            </div>
        </nav>

        <div>
            <h1 class ="site-title"><?php bloginfo( 'name' ); ?></h1>
        </div>
        <?php 
            if($args['header-mime'] =='video'){

                echo '<video loop autoplay muted><source src="'.$args['header-src'] .'" type="'. $args['header-mimetype'].'"></video>';

            }              
    ?>
    </header>