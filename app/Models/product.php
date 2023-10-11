<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['store_id', 'category_id','name','slug', 'description', 'status', 'image', 'price','compare_price'];

    protected static function booted(){
        // static::addGlobalScope('store', function(Builder $builder){
        //     $user = Auth::user();
        //     if($user->store_id){
        //         $builder->where('store_id', '=', $user->store_id);
        //     }
        // });

        ////////////////////////////////////////
        static::addGlobalScope('store', new StoreScope());

    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store(){
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags(){
        return $this->belongsToMany(
            Tag::class,         //related Model
            'product_tag',      //Pivot table name
            'product_id',       //FK in pivot table for current model
            'tag_id',           //FK in pivot table for related model
            'id',               //PK current model
            'id'                //PK related model
        );
    }

    public function scopeActive(Builder $builder){
        $builder->where('status', '=', 'active');
    }

    public function getImageUrlAttribute(){
        if (!$this->image){
            return 'https://ekit.co.uk/GalleryEntries/eCommerce_solutions_and_services/MedRes_Product-presentation-2.jpg?q=27012012153123';
        }
        if(Str::startsWith($this->image, ['http://', 'https://'])){
            return $this->image;
        };

        return asset('storage/'. $this->image);
    }

    public function getSalePercentAttribute(){
        if(!$this->compare_price){
            return null;
        }
        return  number_format(100 - (100 * $this->price / $this->compare_price),0 );
    }



}
