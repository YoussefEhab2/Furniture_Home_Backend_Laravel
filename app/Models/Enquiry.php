<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Enquiry
 * 
 * @property int $id
 * @property string $description
 * @property int $customer_id
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Enquiry extends Model
{
	protected $table = 'enquiry';
	public $timestamps = false;

	protected $casts = [
		'customer_id' => 'int'
	];

	protected $fillable = [
		'description',
		'customer_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'customer_id');
	}
}
