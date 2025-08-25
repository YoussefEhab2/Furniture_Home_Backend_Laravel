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
 * @property Cartitem|null $cartitem
 * @property Favourite|null $favourite
 * @property Collection|Image[] $images
 * @property OrderItem|null $order_item
 * @property Collection|Review[] $reviews
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

	public function cartitem()
	{
		return $this->hasOne(Cartitem::class);
	}

	public function favourite()
	{
		return $this->hasOne(Favourite::class);
	}

	public function images()
	{
		return $this->hasMany(Image::class);
	}

	public function order_item()
	{
		return $this->hasOne(OrderItem::class);
	}

	public function reviews()
	{
		return $this->hasMany(Review::class);
	}
}
