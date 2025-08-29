<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Storesetting
 * 
 * @property int $id
 * @property string $name
 * @property string $logo_url
 * @property string $about_image_url
 * @property string $about_description
 * @property string $terms_and_conditions
 * @property string $facebook_url
 * @property string $whatsapp_no
 * @property string $phone_no
 * @property string $second_phone_no
 *
 * @package App\Models
 */
class Storesetting extends Model
{
	protected $table = 'storesetting';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'logo_url',
		'about_image_url',
		'about_description',
		'terms_and_conditions',
		'facebook_url',
		'whatsapp_no',
		'phone_no',
		'second_phone_no'
	];	
}
