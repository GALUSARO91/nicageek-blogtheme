<?php

namespace Nicageek\Blogtheme\Classes\Views;
use Nicageek\Blogtheme\Classes\Views\Abstract_Theme_View;

Class Theme_View_Index_Page extends Abstract_Theme_View {

    public function render($params = null):void{
        ?>
            <?php get_header();?>

            <?php wp_body_open(); ?>

            <?php if(have_posts()){ ?>

                <section class="all-posts">
                    <ul>
                        <?php while(have_posts()){ the_post();?>
                            <li><a class="card-wrapper-link" href="<?php the_permalink();?>">
                                    <article class="card">
                                        <?php the_post_thumbnail('thumbnail', ['class'=>'card-img-top','alt'=>'post-image']);?>
                                        <div class="card-body">
                                            <h3 class="card-title"><?php the_title();?></h3>
                                        </div>
                                    </article>    
                            </a></li>
                        <?php } ?>
                    </ul>
            <?php } ?>

            <?php get_footer();?>     

        <?php
    }

}