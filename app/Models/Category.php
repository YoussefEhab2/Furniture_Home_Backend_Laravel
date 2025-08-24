<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * 
 * @property Product|null $product
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'category';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function products()
{
    return $this->hasMany(Product::class, 'category_id');
}
}
