<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'topic';

    protected $fillable = [
        'title',
        'description',
        'price',
        'is_free',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_free' => 'boolean',
    ];
}
