<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

use Nicageek\Blogtheme\Classes\Theme_Main as TheMain;
use Nicageek\Blogtheme\Classes\Functionalities\Theme_Functionality as ThFunc;

use Nicageek\Blogtheme\Classes\Views\Theme_View_Header as ThView;
// use \Exceptions;
class thememaintester extends WP_UnitTestCase {

    public function test_thememain(){

        $theme_support_routine = function(){
            add_theme_support('title-tag');
            add_theme_support('post-thumbnails',['post','page']);
            add_theme_support('custom-logo',
                array( 'width' => 100,
                'height' => 100,
                'flex-width' => true,
                'flex-height' => true)
            );
            add_theme_support("widgets");
        };
        
        $theme_support_args = [
            'featuer'       => 'theme_support',
            'hook'          => 'after_setup_theme',
            'filter'        => '',
            'filename'      => '',
            'feature-func'  => $theme_support_routine
            
        ];
        
        $ng_theme_support = new ThFunc('ng_theme_support_functionality',$theme_support_args);

        $theme_part = new ThView('test');

        $thememain = TheMain::init();
        $themain2 = TheMain::init();
        $this->assertSame($thememain,$themain2);
        $this->assertIsObject($thememain);
        $this->assertInstanceOf(TheMain::class,$thememain);
        $thememain->setFunctionalities([$ng_theme_support]);
        $thememain->activateAllFunctionalities();
        // $functionality = $thememain->getChildByNameandType('ng_theme_support_functionality','functionality');

        $this->assertInstanceOf(ThFunc::class,$thememain->functionalities[0]);
        $this->assertInstanceOf(ThFunc::class,$thememain->functionalities[0]);

        

    }

}