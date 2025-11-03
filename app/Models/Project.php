<?php

namespace App\Models;

use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property mixed $description
 * @property mixed $name
 * @property mixed $due_date
 * @method static where(string $string, string $string1)
 */
class Project extends Model
{
    /** @use HasFactory<ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'due_date',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->using(ProjectUser::class)
            ->withPivot(['role_id']);
    }
}
