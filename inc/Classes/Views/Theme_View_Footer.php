<?php

namespace Nicageek\Blogtheme\Classes\Views;
use Nicageek\Blogtheme\Classes\Views\Abstract_Theme_View;

Class Theme_View_Footer extends Abstract_Theme_View {


    public function render($params = null):void{
        ?>
       </main> 
        <footer>
            <div class="row">
                <div class="col-6 col-lg-3">
                    <?php dynamic_sidebar('Sidebar 1');?>
                </div>
                <div class="col-6 col-lg-3">
                    <?php dynamic_sidebar('Sidebar 2');?>
                </div>
                <div class="col-6 col-lg-3">
                    <?php dynamic_sidebar('Sidebar 3');?>
                </div>
                <div class="col-6 col-lg-3">
                    <?php dynamic_sidebar('Sidebar 4');?>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>
       <?php
    }
}