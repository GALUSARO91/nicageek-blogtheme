<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

use Nicageek\Blogtheme\Classes\Theme_View as TheView;

class themeviewtest extends WP_UnitTestCase {

    public function test_themeview(){

        $themeview = new TheView ('template name',[]);
        $this->assertInstanceOf(TheView::class,$themeview);
        $this->assertIsString($themeview->template_name);
        $this->assertIsArray($themeview->template_args);


    }

}