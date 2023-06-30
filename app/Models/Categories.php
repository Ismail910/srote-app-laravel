<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;


class Categories extends Model
{
    use HasFactory;
   
    protected $fillable = ['name', 'slug', 'description', 'status', 'parent_id', 'img'];

    public static function rules($id = 0){
        $forbiddenValues = ['laravel', 'php', 'javascript'];
        return [
            'name'=>[
                'required',
                'string',
                'min:3',
                'max:50',
                //////////////
                // "unique:categories,name,$id",
                Rule::unique('categories', 'name')->ignore($id),
                ////////////////////////////
                new Filter($forbiddenValues),
                // function($attribute , $value ,$fails){
                //     if(strtolower($value) == 'laravel'){
                //         $fails('This name is forbidden');
                //     }
                // },

                // 'filter:php,laravel,javascript',
            ],
            'parent_id'=>[
                'nullable','int','exists:categories,id'
            ],
            'img'=>[
                'img'=>'max:1048576',
                // /* 'dimensions:min_width=100,max_width=100' */
            ],
            'description'=>'nullable|string',
            'status'=>'required|in:active,archived',
            // 'slug'=>'nullable|string',
        ];

    }
}
