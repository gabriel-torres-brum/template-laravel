<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'phone_number',
        'member_id',
        'created_at'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
