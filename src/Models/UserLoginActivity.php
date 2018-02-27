<?php

namespace Aginev\LoginActivity\Models;

use Aginev\LoginActivity\Exceptions\LoginActivityException;
use Illuminate\Database\Eloquent\Model;

class UserLoginActivity extends Model
{
    /**
     * Removes the "updated_at" column
     */
    const UPDATED_AT = null;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_login_activities';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at'];


    /**
     * User relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo($this->getAuthModelName(), 'user_id');
    }

    /**
     * Determine the users model name
     *
     * @return mixed
     * @throws LoginActivityException
     */
    public function getAuthModelName()
    {
        //laravel 5.0 - 5.1
        if (! is_null(config('auth.model'))) {
            return config('auth.model');
        }

        //laravel 5.2
        if (! is_null(config('auth.providers.users.model'))) {
            return config('auth.providers.users.model');
        }

        throw new LoginActivityException('Could not determine the model name for users!');
    }
}