<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * 
 * @property int $id
 * @property int $product_id
 * @property string $link
 * 
 * @property Product $product
 *
 * @package App\Models
 */
class Image extends Model
{
	protected $table = 'image';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'link'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
