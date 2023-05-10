<?php get_header();?>

<?php wp_body_open(); ?>

<?php if(have_posts()){ ?>

 
     <section class="latest-post">

            <?php while(have_posts()){ the_post();?>
                <h2><?php the_title();?></h2>
                        <article>
                            <div class="post-content py-3 my-3">
                                <?php the_content();?>
                            </div>
                        </article>    
            <?php } ?>
<?php } ?>

    </section>


<?php get_footer();?>
