<?php declare(strict_types=1);

namespace App\Core;

class Validator
{
    public static function form(array $request): bool
    {
        foreach($request['attributes'] as $attribute){
            if(empty($attribute)){
                Session::flash('errors', 'Please, submit required data');
            }

            if(is_numeric($attribute) && $attribute < 0){
                Session::flash('errors', 'Please, provide the data of indicated type');
            }
        }

        if(!isset($request['type'])){
            Session::flash('errors', 'Please, provide the data of indicated type');
        }

        return Session::has('errors');
    }
}