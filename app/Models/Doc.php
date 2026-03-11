<?php

namespace App\Models;

use Database\Factories\DocFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doc extends Model
{
    /** @use HasFactory<DocFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
