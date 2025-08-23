<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cartitem
 * 
 * @property int $product_id
 * @property int $cart_id
 * @property int $quantity
 * 
 * @property Product $product
 * @property Cart $cart
 *
 * @package App\Models
 */
class Cartitem extends Model
{
	protected $table = 'cartitem';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'cart_id' => 'int',
		'quantity' => 'int'
	];

	protected $fillable = [
		'quantity'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function cart()
	{
		return $this->belongsTo(Cart::class);
	}
}
