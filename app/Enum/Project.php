<?php

namespace App\Enum;

enum Project: string
{
    case NAME = 'name';
    case DESCRIPTION = 'description';
    case DUE_DATE = 'due_date';
    case STATUS_ID = 'status_id';

    public function validationRules(): array
    {
        return match ($this) {
            self::NAME => ['required', 'string', 'max:255'],
            self::DESCRIPTION => ['string', 'max:255'],
            self::DUE_DATE => ['date', 'date_format:Y-m-d', 'after_or_equal:today'],
            self::STATUS_ID => ['required', 'integer', 'exists:statuses,id'],
        };
    }
}
