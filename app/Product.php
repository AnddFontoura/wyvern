<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $fillable = [
        'sub_category_id',
        'name',
        'nickname',
        'description',
        'isbn',
        'codebar',
        'weight',
        'width',
        'height',
        'depth',
        'price',
    ];
    

    public function subcategory(): HasOne
    {
        return $this->hasOne('App\SubCategory', 'id', 'sub_category_id');
    }
}
