<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

use Nicageek\Blogtheme\Classes\Theme_Functionality as TheFunc;



class themefunctionalitytest extends WP_UnitTestCase {

    public function test_functionality(){

        $register_menu_routine = function(){
            register_nav_menus( ["menu-header" =>"Menu Header"] );
        };
        
        $theme_menu_args = [
            'feature' => 'theme_menu',
            'hook'=> 'init',
            'filter' =>'',
            'filename' => '',
            'feature-func'=> $register_menu_routine
        ];
        $themefunc= new TheFunc('myfunction',$theme_menu_args);

        $this->assertInstanceOf(theFunc::class,$themefunc);
        $this->assertFalse($themefunc->get_functionality_status());
        $this->assertIsString($themefunc->functionality_name);
        $this->assertIsArray($themefunc->functionality_args);
        $themefunc->activate();
        $this->assertTrue($themefunc->get_functionality_status());
        $this->assertIsCallable($themefunc->functionality_args['feature-func']);
    
    }

}