<?php

namespace Nicageek\Blogtheme\Classes\Views;
use Nicageek\Blogtheme\Classes\Views\Abstract_Theme_View;
use Nicageek\Blogtheme\Traits\Theme_Calculate_Rating;

Class Theme_View_Single_Page extends Abstract_Theme_View {
    use Theme_Calculate_Rating;
    public function render($params = null):void{
        ?>
            <?php get_header();?>

            <?php wp_body_open(); ?>

            <?php if(have_posts()){ ?>
                <section class="latest-post">
                        <?php while(have_posts()){ the_post();?>
                            <h2><?php the_title();?></h2>
                            <div class="post-meta-info row">
                                <?php 
                                    $rating_var = get_post_meta(get_the_ID(),'ngbt-rating',true);
                                    $rating = $this->calculate_rating($rating_var);
                                    $this->get_view_part('ratingbox')->render(['rating' => $rating]);
                                ?>
                                <div class="col">
                                    Date:  <?php the_time("d/m/y")?>
                                </div>
                                <div class="col">
                                    Author: <?php the_author();?>
                                </div>
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
        <?php
    }

}