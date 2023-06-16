<?php declare(strict_types=1);

namespace App\Core;

use App\Exceptions\InvalidInputException;

class Validator
{
    public static function form(array $request): void
    {
        foreach($request as $attribute){
            if(empty(trim($attribute))){
                Session::flash('errors', 'Please, submit required data');
            }

            if(is_numeric($attribute) && $attribute < 0){
                Session::flash('errors', 'Please, provide the data of indicated type');
            }
        }

        if(!isset($request['type'])){
            Session::flash('errors', 'Please, provide the data of indicated type');
        }

        if(Session::has('errors')){
            throw new InvalidInputException();
        }
    }
}