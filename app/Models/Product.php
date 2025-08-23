<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'category_id',
    ];
    public $timestamps = false;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
