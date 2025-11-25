<?php

namespace App\Models;

use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property string $title
 * @property string $due_date
 * @property string $description
 * @property int $project_id
 * @property string $completed
 */
class Task extends Model
{
    /** @use HasFactory<TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'title', 'due_date', 'completed', 'description', 'project_id'
    ];

    public function due_date_for_form(): string
    {
        return (new Carbon($this->due_date))->format('Y-m-d');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function parent_task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'parent_task_id');
    }

    public function child_tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_task_id');
    }
}
