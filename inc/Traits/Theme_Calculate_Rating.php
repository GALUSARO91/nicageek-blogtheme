<?php

namespace Nicageek\Blogtheme\Traits;


trait Theme_Calculate_Rating{
    public function calculate_rating($rating){
        /* 
            @param $rating: is a serialized string containing all the rating data
        */
        if($rating){
            $rating_array = unserialize($rating);
            $rating_values_array = array_column($rating_array,'rating');
            $average = intval(array_sum($rating_values_array)/sizeof($rating_values_array));
            return $average;
        }
    }
}