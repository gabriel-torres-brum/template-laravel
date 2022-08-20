<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'route',
        'icon',
        'place',
        'admin'
    ];

    public function getMenuForUser(string $place)
    {
        if (!auth()->user()->admin) {
            return Menu::where('admin', false)->where('place', $place)->get();
        }
        
        return Menu::where('place', $place)->get();
    }
}
