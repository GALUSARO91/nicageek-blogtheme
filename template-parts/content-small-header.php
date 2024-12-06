
<header class="navbar sticky-top navbar-expand-sm">
        <nav class="container-fluid row">
            <a href="<?php echo bloginfo('url');?>" class="site-logo navbar-brand col-3">
                
                    <div class="row">
                        <img src="<?php echo $args['logo']; ?>" alt="Site logo" class="col mw-">
                        <h1 class ="site-title col"><?php bloginfo( 'name' ); ?></h1>
                    </div>
            </a>
            <div class="searchbar col-3" id="search-form"> 
                <?get_search_form();?>              
            </div>
            <div class="col-3">
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
        </nav>
    </header>