<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'icon',
        'image',
    ];

    public function category(): HasOne
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }
}
