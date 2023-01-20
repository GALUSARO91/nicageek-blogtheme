<?php get_header();?>

<?php wp_body_open(); ?>

<?php if(have_posts()){ ?>

    <?php while(have_posts()){ the_post();?>
            <?php  the_content(); ?>
    <?php } ?>

<?php } ?>


<?php get_footer();?>
