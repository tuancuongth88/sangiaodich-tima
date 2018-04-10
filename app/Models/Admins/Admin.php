<?php

namespace App\Models\Admins;

use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable,
        SoftDeletes;

    /**
     * The event map for the model.
     *
     * @var array
     * @author tantan
     */
    protected $dispatchesEvents = [
        // 'retrieved' => Name_Of_Event::class, // fire when an existing model is retrieved from the database
        // 'creating' => Name_Of_Event::class, // a new model is saved for the first time
        // 'created' => Name_Of_Event::class, // a new model is saved for the first time
        // 'updating' => Name_Of_Event::class,
        // 'updated' => Name_Of_Event::class,
        // 'saving' => Name_Of_Event::class,
        // 'saved' => Name_Of_Event::class,
        // 'deleting' => Name_Of_Event::class,
        // 'deleted' => Name_Of_Event::class,
        // 'restoring' => Name_Of_Event::class,
        // 'restored' => Name_Of_Event::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'username',
        'fullname',
        'email',
        'password',
        'address',
        'birthday',
        'phone',
        'avatar',
        'active',
        'role',
        'updated_by',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPassWordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    
}
