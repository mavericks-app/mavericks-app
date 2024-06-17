<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Contact extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'birth_date',
        'email',
        'phone',
        'phone2',
        'photo',
        'address',
        'user_id',
    ];

    /**
     * Set the contact's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst(strtolower($value));
    }

    /**
     * Set the contact's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = str_replace(' ', '', $value);
    }

    /**
     * Set the contact's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setPhone2Attribute($value)
    {
        $this->attributes['phone2'] = str_replace(' ', '', $value);
    }

    /**
     * Indica si el modelo debe tener timestamps.
     *
     * @var bool
     */
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
