<?php

use App\Models\Action;
use App\Models\Attribute;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Task::class)->constrained('tasks');
            $table->foreignIdFor(Attribute::class)->constrained('attributes');
            $table->foreignIdFor(Action::class)->constrained('actions');
            $table->mediumText('oldVal')->nullable();
            $table->mediumText('newVal')->nullable();
            $table->foreignIdFor(User::class)->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
