<?php

namespace App\Enum;

enum Task: string
{
    CASE PROJECT_ID = 'project_id';
    CASE TITLE = 'title';
    CASE DUE_DATE = 'due_date';
    CASE DESCRIPTION = 'description';
    CASE COMPLETED = 'completed';

    public function validationRules(): array
    {
        return match ($this) {
            self::TITLE => ['required', 'string', 'max:64', 'min:3'],
            self::DUE_DATE, self::COMPLETED => ['nullable', 'date', 'date_format:Y-m-d', 'after_or_equal:today'],
            self::DESCRIPTION => ['nullable', 'string', 'max:255'],
            self::PROJECT_ID => ['required', 'integer', 'exists:projects,id'],
        };
    }
}
