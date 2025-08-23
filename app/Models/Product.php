<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property int $discount
 * 
 * @property Category $category
 * @property Collection|Cartitem[] $cartitems
 * @property Collection|Favourite[] $favourites
 * @property Image|null $image
 * @property Collection|OrderItem[] $order_items
 * @property Review|null $review
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'product';
	public $timestamps = false;

	protected $casts = [
		'category_id' => 'int',
		'price' => 'float',
		'discount' => 'int'
	];

	protected $fillable = [
		'category_id',
		'name',
		'description',
		'price',
		'discount'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function cartitems()
	{
		return $this->hasMany(Cartitem::class);
	}

	public function favourites()
	{
		return $this->hasMany(Favourite::class);
	}

	public function image()
	{
		return $this->hasOne(Image::class);
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class);
	}

	public function review()
	{
		return $this->hasOne(Review::class);
	}
}
