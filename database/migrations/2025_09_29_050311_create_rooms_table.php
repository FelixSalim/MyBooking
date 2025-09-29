<?php
// database/migrations/xxxx_xx_xx_create_rooms_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('floor_number')->nullable(); // e.g. 1, 2, 3
            $table->string('name');          // e.g. "Discussion Room A"
            $table->string('type')->default('discussion');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('rooms');
    }
};
