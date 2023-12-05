<?php

namespace Nicageek\Blogtheme\Classes\Views;
use Nicageek\Blogtheme\Classes\Views\Abstract_Theme_View;

Class Theme_View_Page extends Abstract_Theme_View {

    public function render($params = null):void{
        ?>
            <?php get_header();?>

            <?php wp_body_open(); ?>

            <?php if(have_posts()){ ?>

                <section>

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

    <?php
    }

}