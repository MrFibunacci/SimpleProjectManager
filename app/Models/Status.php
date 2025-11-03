<?php

namespace App\Models;

use Database\Factories\StatusFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 */
class Status extends Model
{
    /** @use HasFactory<StatusFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
