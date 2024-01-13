<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class, 'owner_id');
            $table->foreignIdFor(Task::class, 'parent_id')->nullable();

            $table->string('status')->index();
            $table->tinyInteger('priority')->unsigned()->index();
            $table->string('title')->fulltext();
            $table->text('description')->fulltext();
            $table->timestamp('completed_at')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
