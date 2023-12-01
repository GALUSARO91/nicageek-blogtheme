<?php

namespace Nicageek\Blogtheme\Classes;
use \Exception;

class Theme_Main {
    public $options =[];
    public $views =[];
    public $functionalities =[];
    public $section_names = [];
    private static $instance ;

    private function __construct(){
    }

    public static function init(){
        if(!isset(self::$instance )){
            self::$instance = new Theme_Main();
        }

        return self::$instance;
    }

    public function setOptions($options){

            if(isset($options)&&!empty($options)){
                foreach($options as $option){
                    array_push($this->options,$option);
            }
            
        }
        return self::$instance;

    }

    public function setFunctionalities($functionalities = null){

        if(isset($functionalities)&&!empty($functionalities)){
            foreach($functionalities as $functionality){
                array_push($this->functionalities,$functionality);
            };
        }
        
        return self::$instance;

    }

    public function setViews($views){
        if(isset($views)&&!empty($views)){
            foreach($views as $view){
                array_push($this->views,$views);

            };
        }

        return self::$instance;
        
    }

    public function activateAllFunctionalities(){
        try{

            array_walk($this->functionalities,function($value,$key){

                if(!empty($value->functionality_args['hook'])){

                    add_action( $value->functionality_args['hook'], $value->functionality_args['feature-func']);
                    $value->activate();

                } elseif(!empty($value->functionality_args['filter'])){
                    
                    add_filter( $value->functionality_args['filter'], $value->functionality_args['feature-func']);
                    $value->activate();
                }
    
            });

         
        } catch(\Exception $e){
            throw new Exception('An error occurred');
        }
    }

    public function registerAllOptions(){
        global $wp_customize ;
        add_action('customize_register',function() use (&$wp_customize){
      
            $wp_customize->add_panel( 'ngbt_theme_panel', array(
                'title' => "Blogtheme Options",
                'description' => "Here you can find theme customizations",
                'capability' => 'edit_theme_options',
                'priority' => 160,
            ) );
        
           

            if(!empty($this->section_names)){
                foreach ($this->section_names as $item) {
                    $wp_customize->add_section( $item['name'], array(
                        'title' => $item['title'],
                        'description' => $item['description'],
                        'panel' => 'ngbt_theme_panel',
                    ) );
                }
            }

            if(!empty($this->options)){

                foreach ($this->options as $opt) {
                    $opt->Register_Option($wp_customize);
                }

            }

                
        });
    }


    public function getChildByNameAndType(string $name=null,string $child_type=null){
        
        if (!isset($name) || !isset($child_type)){ return;}

        $found;
        switch ($child_type){

            case 'view':

                $found = array_filter($this->views,function($value) use ($name){
                        if($value->template_name == $name){
                            return true;
                        }
                });

                break;

            case 'functionality':

                $found = array_filter($this->functionalities,function($value) use ($name){
                    if($value->functionality_name == $name){
                        return true;
                    }
            });


                break;

            case 'option':

                $found = array_filter($this->options,function($value) use ($name){
                    if($value->option_name == $name){
                        return true;
                    }
            });

                break;

            default:
                
                break;
        }

        if(sizeof($found)==1){
            return $found[0];
        }

    }

}