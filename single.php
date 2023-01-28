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
        $commentbox_args=[
            'class_container' => 'comment-form',
            'class_form' => '',
            'class_submit'=>'btn btn-outline-success',
            'label_submit' => 'Enviar',
            'comment_field' => '<div class="row my-3 justify-content-center">
            <textarea class="col-8" name="comment" id="" cols="4" rows="10" placeholder="Write comment!!!"></textarea>
            </div>',
            'comment_notes_after' => '<div class="row my-3 gx-5 justify-content-end pe-5">',
            'submit_field' => '<div class ="col-2">%1$s</div><div class ="col-2">%2$s</div></div>'
        ];
        comment_form($commentbox_args)
    ;?>



<?php get_footer();?>
