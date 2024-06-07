<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email'
    ];

    /**
     * Indica si el modelo debe tener timestamps.
     *
     * @var bool
     */
    public $timestamps = false;


    public function name():Attribute
    {
        return Attribute::make(
            //Accesor
            get: function ($value){
                return ucfirst($value);
            },
            //Mutador
            set: function ($value){
                return strtolower($value);
            }
        );
    }

}
