<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 * 
 * @property int $id
 * @property int $product_id
 * @property int $customer_id
 * @property string $rating
 * @property string $comment
 * 
 * @property Product $product
 * @property User $user
 *
 * @package App\Models
 */
class Review extends Model
{
	protected $table = 'review';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'customer_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'customer_id',
		'rating',
		'comment'
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
