<?php get_header();?>

<?php wp_body_open(); ?>

<?php if(have_posts()){ ?>

 
     <section class="latest-post">

            <?php while(have_posts()){ the_post();?>
                <h2><?php the_title();?></h2>
                <div class="post-meta-info row">
                    <?php
                        get_rating_template_part();

                    ?>
                </div>
                        <article>
                            <div class="post-content py-3 my-3">
                                <?php the_content();?>
                            </div>
                        </article>    
            <?php } ?>
<?php } ?>

<?php rewind_posts();?>
    </section>
<section>
    <div class="carousel-nav">
        <ul class="pagination">
            <?php while(have_posts()){ the_post();?>
                <?php previous_post_link(
                    '<li class="page-item page-link">   
                    <span aria-hidden="true">%link</span>
                </li>','Previous Post')?>
                <?php next_post_link(
                        '<li class="page-item page-link">   
                        <span aria-hidden="true">%link</span>
                    </li>','Next Post')?>
            <?php } ?>
        </ul>
    </div>
</section>

<?php 
    comments_template();
;?>


<?php get_footer();?>
