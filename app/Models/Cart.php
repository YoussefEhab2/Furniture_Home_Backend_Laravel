<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 * 
 * @property int $id
 * @property int $total_no_of_items
 * @property float $total_price
 * 
 * @property Collection|Cartitem[] $cartitems
 * @property User|null $user
 *
 * @package App\Models
 */
class Cart extends Model
{
	protected $table = 'cart';
	public $timestamps = false;

	protected $casts = [
		'total_no_of_items' => 'int',
		'total_price' => 'float'
	];

	protected $fillable = [
		'total_no_of_items',
		'total_price'
	];

	public function cartitems()
	{
		return $this->hasMany(Cartitem::class);
	}

	public function user()
	{
		return $this->hasOne(User::class);
	}
}
