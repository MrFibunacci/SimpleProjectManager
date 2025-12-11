<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    public function run(): void
    {
        Action::factory()->createMany([
            ['name' => 'create'],
            ['name' => 'update'],
            ['name' => 'delete'],
        ]);
    }
}
