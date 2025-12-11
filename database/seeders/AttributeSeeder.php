<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        Attribute::factory()->createMany([
            ['name' => 'title'],
            ['name' => 'description'],
            ['name' => 'parent_task_id'],
            ['name' => 'due_date'],
            ['name' => 'completed'],
            ['name' => 'status_id'],
        ]);
    }
}
