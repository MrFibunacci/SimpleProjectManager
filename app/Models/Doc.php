<?php

namespace App\Models;

use Database\Factories\DocFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    /** @use HasFactory<DocFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
    ];
}
