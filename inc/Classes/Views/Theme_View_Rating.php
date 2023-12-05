<?php

namespace Nicageek\Blogtheme\Classes\Views;
use Nicageek\Blogtheme\Classes\Views\Abstract_Theme_View;


Class Theme_View_Rating extends Abstract_Theme_View {


    public function render($params = null):void{
       
        $data = [
            "user_id" =>get_current_user_id(),
            "post_id" =>get_the_ID(),
            "rating_data" =>$params['rating']
        ];
        get_template_part('template-parts/content','ratingbox',$data);

    }


}