<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderStateChange
 * 
 * @property int $id
 * @property int $order_id
 * @property string $state
 * @property Carbon $timestamp
 * 
 * @property Order $order
 *
 * @package App\Models
 */
class OrderStateChange extends Model
{
	protected $table = 'order_state_change';
	public $timestamps = false;

	protected $casts = [
		'order_id' => 'int',
		'timestamp' => 'datetime'
	];

	protected $fillable = [
		'order_id',
		'state',
		'timestamp'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
