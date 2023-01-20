<form class="d-flex" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) )?>">
    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar" value="<?php echo get_search_query()?>" name="s">
    <button class="btn btn-outline-success" type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button' )?>">Buscar</button>
</form>