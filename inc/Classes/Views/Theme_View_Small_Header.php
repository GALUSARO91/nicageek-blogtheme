<?php

namespace Nicageek\Blogtheme\Classes\Views;
use Nicageek\Blogtheme\Classes\Views\Abstract_Theme_View;
use Nicageek\Blogtheme\Traits\Theme_Custom_Logo; 

Class Theme_View_Small_Header extends Abstract_Theme_View {
    use Theme_Custom_Logo;

    public function render($params = null):void{
       
        $params['logo'] = $this->ngbt_outputlogo();
        get_template_part('/template-parts/content', $this->template_name, $params);

    }


}