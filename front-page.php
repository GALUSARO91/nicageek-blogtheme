<?php get_header();?>

<?php wp_body_open(); ?>

    <section class="latest-post">
        <h2>Latest Posts</h2>
        <?php
            // get latest post info
            $lpargs = [
                'posts_per_page' => 10,
                'orderby' => 'date',
                'order' => 'DESC',
            ];
            $latest_post_query = new WP_Query($lpargs);
        ?>

        <?php if($latest_post_query->have_posts()){ ?>
            <div id="carouselLatestPosts" class="carousel slide">
                <div class="carousel-inner">
            <?php while($latest_post_query->have_posts()){ $latest_post_query->the_post();?>

                        <?php if($latest_post_query->current_post == 0):?>
                            <article class="carousel-item active">
                        <?php else:?>
                            <article class="carousel-item">
                        <?php endif ?>
                            <h3><?php the_title();?></h3>

                            <div class="post-content">
                                <?php the_excerpt();?>
                            </div>
                            <a class="see-more-link" href="<?php the_permalink() ;?>">See more...</a>
                        </article>       
                <?php } ?>
            <?php } ?>
            </div>
        </div>
        <div class="carousel-nav" aria-label="Latest Posts">
                    <ul class="pagination">
                        <li class="page-item page-link" data-bs-target="#carouselLatestPosts" data-bs-slide="prev">   
                            <span aria-hidden="true">&laquo;</span>
                        </li>
                        <?php $latest_post_query->rewind_posts();?>
                        <?php while($latest_post_query->have_posts()){ $latest_post_query->the_post();?>
                        <li 
                            class="page-item page-link" 
                            data-bs-target="#carouselLatestPosts" 
                            data-bs-slide-to="<?php echo $latest_post_query->current_post;?>"
                            aria-current="true" 
                            aria-label="Slide <?php echo $latest_post_query->current_post;?>"> 
                            <?php echo $latest_post_query->current_post + 1;?>
                        </li>
                       
                        <?php } ?>
                        <li class="page-item page-link" data-bs-target="#carouselLatestPosts" data-bs-slide="next"> 
                            <span aria-hidden="true">&raquo;</span>
                        </li>
                    </ul>
                </div>
                <?php wp_reset_postdata(); ?>
    </section>
    <section class="top-rated">
            <h2>Top Posts</h2>
            <ul id="top-post-container">
                <?php
                    $post_count = 0;
                    while (have_posts() ) : the_post();
                        $rating_var = get_post_meta(get_the_ID(),'ngbt-rating',true);
                        $rating = calculate_rating($rating_var);
                        if($rating >= 4){ 
                                $post_count++;
                            ?>
                            <li class="card mb-3">
                                <a class="card-wrapper-link" href="<?php the_permalink() ;?>">
                                    <article class="row g-0">
                                        <div class="col-md-4">
                                            <?php the_post_thumbnail('full', ['class'=>'img-fluid rounded-start','alt'=>'post-image']);?>
                                            
                                        </div>
                                        <div class="col-md-8 card-body">
                                            <h3><?php the_title();?></h3>
                                            <p class="card-text"><?php the_excerpt();?></p>
                                            <div class="row">
                                                <p class="col card-text"><small class="text-muted">Author: <?php the_author();?></small></p>
                                                <p class="col card-text"><small class="text-muted">Date: <?php the_time("d/m/y")?></small></p>
                                                <p class="col card-text"><small class="text-muted">Rating: <?php get_rating_template_part()?></small></p>
                                            </div>
                                        </div>
                                    </article>
                                </a>
                            </li>
                <?php    }       
                    endwhile;  
                    if($post_count == 0){
                        echo "<li>No posts found</li>";
                    }
                ?>
            </ul>
    </section>
    <?php wp_reset_postdata(); ?>
    <section class="all-posts">
        <h2>All Posts</h2>
        <ul>
            <?php 
                $args = [
                    'posts_per_page' => 12,
                    'orderby' => 'date',
                    'order' => 'ASC'
                ];
                $allposts = new WP_Query($args);
            ?>
            <?php while($allposts->have_posts()){$allposts->the_post();?>
                <li><a class="card-wrapper-link" href="<?php the_permalink();?>">
                        <article class="card">
                            <?php the_post_thumbnail('thumbnail', ['class'=>'card-img-top','alt'=>'post-image']);?>
                            <div class="card-body">
                                <h3 class="card-title"><?php the_title();?></h3>
                            </div>
                        </article>    
                </a></li>
            <?php } ;?>
            <?php wp_reset_postdata(); ?>
        </ul>
        <a href="<?php echo home_url('/?s=');?>" class="see-more-link">See all..</a>
    </section>

<?php get_footer();?>
