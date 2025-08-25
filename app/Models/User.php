<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string $phone
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $role
 * @property int|null $cart_id
 * 
 * @property Cart|null $cart
 * @property Enquiry|null $enquiry
 * @property Collection|Favourite[] $favourites
 * @property Order|null $order
 * @property Review|null $review
 *
 * @package App\Models
 */
class User extends Authenticatable implements JWTSubject
{
	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'cart_id' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'phone',
		'remember_token',
		'role',
		'cart_id'
	];

	  /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

	public function cart()
	{
		return $this->belongsTo(Cart::class);
	}

	public function enquiry()
	{
		return $this->hasMany(Enquiry::class, 'customer_id');
	}

	public function favourites()
	{
		return $this->hasMany(Favourite::class, 'customer_id');
	}

	public function order()
	{
		return $this->hasMany(Order::class, 'customer_id');
	}

	public function review()
	{
		return $this->hasMany(Review::class, 'customer_id');
	}
}
