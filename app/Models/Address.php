<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'address_name',
        'number',
        'adjunct',
        'district',
        'city',
        'state',
        'cep',
        'member_id',
        'created_at'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class)->withDefault();
    }
}
