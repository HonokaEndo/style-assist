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
        Schema::create('consult_reviews', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('consults_id')->constrained()->onDelete('cascade');
            //$table->integer('parent_id');
            $table->foreignId('consult_id')->constrained('consults')->onDelete('cascade'); // カラム名を修正
            $table->foreignId('parent_id')->nullable()->constrained('consult_reviews')->onDelete('cascade'); // 必要に応じて外部キー制約を追加
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('consult_reviews');
    }
};