<?php 

class CategoryService {

    public static function categoriesToArray($categories){
        $results = [];

        foreach($categories as $category){
            $results[] = $category->toArray();  
        } 

        return $results;
    }



}