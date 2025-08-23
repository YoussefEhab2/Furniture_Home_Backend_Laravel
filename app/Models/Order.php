<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property int $id
 * @property int $customer_id
 * @property string $state
 * @property float $total_price
 * @property Carbon $date
 * 
 * @property User $user
 * @property Collection|OrderItem[] $order_items
 * @property OrderStateChange|null $order_state_change
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'order';
	public $timestamps = false;

	protected $casts = [
		'customer_id' => 'int',
		'total_price' => 'float',
		'date' => 'datetime'
	];

	protected $fillable = [
		'customer_id',
		'state',
		'total_price',
		'date'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'customer_id');
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class);
	}

	public function order_state_change()
	{
		return $this->hasOne(OrderStateChange::class);
	}
}
