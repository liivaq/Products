<?php declare(strict_types=1);

namespace App\Core;

class Validator
{
    public static function form(array $request): array
    {
        $errors = [];

        foreach($request as $attribute){
            if(empty($attribute)){
                $errors['empty'] = 'Please, fill in all the fields';
            }

            if(is_numeric($attribute) && $attribute < 0){
                $errors['numbers'] = 'Value should be greater than or equal to 0';
            }
        }

        self::validateSku($request['sku']);
        return $errors;
    }

    private static function validateSku (string $sku){

    }

}