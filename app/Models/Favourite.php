<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Favourite
 * 
 * @property int $product_id
 * @property int $customer_id
 * 
 * @property Product $product
 * @property User $user
 *
 * @package App\Models
 */
class Favourite extends Model
{
	protected $table = 'favourite';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'customer_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'customer_id'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'customer_id');
	}
}
