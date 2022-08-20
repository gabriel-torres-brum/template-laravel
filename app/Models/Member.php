<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'birthday',
        'tither',
        'user_id',
        'role_id',
        'church_id',
    ];

    protected $casts = [
        'birthday' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($member) {
            $member->phones()->delete();
            $member->addresses()->delete();
            // $member->user()->delete();
        });
    }
}
