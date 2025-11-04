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
            self::TITLE => [],
            self::DUE_DATE => [],
            self::DESCRIPTION => [],
            self::COMPLETED => [],
        };
    }
}
