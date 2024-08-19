<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recommend_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recommend_id')->constrained()->onDelete('cascade'); // カラム名を単数形に修正
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('recommend_reviews')->onDelete('cascade');
            $table->integer('star')->nullable();
            $table->string('comment');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommend_reviews');
    }
};
