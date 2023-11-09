<?php

namespace Nicageek\Blogtheme\Classes;
use Nicageek\Blogtheme\Classes\Abstract_Theme_View;

abstract class Theme_View_Header extends Abstract_Theme_View {


    public function render(array $options = null):void{

        ob_start();
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
        
        echo  ob_clean();
    
    }
}