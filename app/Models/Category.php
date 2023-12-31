<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Unique;




class Category extends Model
{
    use HasFactory, SoftDeletes;
   
    protected $fillable = ['name', 'slug', 'description', 'status', 'parent_id', 'img'];

   
    public function products()
{
    return $this->hasMany(product::class);
   
}

    public function parent(){   
        return $this->belongsTo(Category::class, 'parent_id', 'id')
        ->withDefault([
            'name' => '--'
        ]);
    }

    public function children(){
        return $this->hasMany(Category::class, 'parent_id', 'id');
       
    }
    public function scopeActive(Builder $bulder){
         
        $bulder->where('status', '=', 'active');
    }
    public function scopeStatus(Builder $bulder, $status){
        $bulder->where('status', '=', $status);
    }
    public function scopeFilter(Builder $bulder, $filters){
        $bulder->when($filters['name'] ?? false, function($bulder , $value){
            $bulder->where('Categories.name', 'like', "%{$value}%");
        });
        $bulder->when($filters['status'] ?? false, function($bulder , $value){
            $bulder->where('Categories.status', '=', $value);
        });
       
        // if($filters['name'] ?? false){
        //     $bulder->where('name', 'like', "%{$filters['name']}%");
        // }
        // if($filters['status'] ?? false){
        //     $bulder->where('status', '=', $filters['status']);
        // }
        
    }
    public static function rules($id = 0){
        $forbiddenValues = ['laravel', 'php', 'javascript'];
        
        return [
            'name'=>[
                'required',
                'string',
                'min:3',    
                'max:50',
                //////////////
                // "unique:Categories,name,$id",
                Rule::unique('Categories', 'name')->ignore($id),
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
                'nullable','int','exists:Categories,id'
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
