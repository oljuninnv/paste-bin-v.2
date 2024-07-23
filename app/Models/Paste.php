<?php

namespace App\Models;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    use HasFactory;

    protected $table = 'pastes';
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'category_id',
        'syntax_id',
        'tags',
        'rights_id',
        'complaints',
        'access_time',
        'short_url',
    ];

    public static function getAllPastes()
    {
        return self::all();
    }

    public static function findByIdOrShortUrl($identifier)
    {
        return self::where('id', $identifier)
            ->orWhere('short_url', $identifier)
            ->first();
    }
}
