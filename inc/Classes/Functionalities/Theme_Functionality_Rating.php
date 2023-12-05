<?php

namespace Nicageek\Blogtheme\Classes\Functionalities;
use Nicageek\Blogtheme\Classes\Functionalities\Theme_Functionality;
use Nicageek\Blogtheme\Traits\Theme_Calculate_Rating;

/* *
    * Class name:   Theme_Functionality
    * Description:  Sets up all the params that will create all the functionalities
    * Params:
    * @param string $name, is the name of the functionality
    * @param array $args, are the different files, methods, hooks used on the funcionality
    {
        feature: string,
        hook: string,
        filter: string,
        filename: string,
        feature-func: callable,
    }
*/

class Theme_Functionality_Rating extends Theme_Functionality {
    use Theme_Calculate_Rating;
}