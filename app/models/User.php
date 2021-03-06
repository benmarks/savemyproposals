<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    const ADMIN_ROLE = 1;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Add to the fillable array
     *
     * @var array
     */
    protected $fillable = array('email', 'password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Returns whether user has admin role
     *
     * Hacky role system for now
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role == self::ADMIN_ROLE;
    }

    /**
     * Get this author's talks
     */
    public function talks()
    {
        return $this->hasMany('Talk', 'author_id');
    }

    /**
     * Get the user's favorited conferences
     */
    public function favoritedConferences()
    {
        return $this->belongstoMany('Conference', 'favorites')->withTimestamps();
    }
}
