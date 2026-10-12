<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_advertisements', function (Blueprint $table) {
            $table->id();
            // One ad per page; the admin only edits these three rows.
            $table->enum('page_type', ['offers', 'visa', 'transport'])->unique();
            $table->enum('media_type', ['image', 'slider'])->default('image');
            // JSON list of filenames under public/uploads/ads (one for "image", several for "slider").
            $table->text('image_path')->nullable();
            $table->foreignId('offer_id')->nullable()->constrained('offers')->nullOnDelete();
            $table->string('link_url', 2048)->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        $now = now();
        DB::table('page_advertisements')->insert(array_map(fn ($page) => [
            'page_type' => $page,
            'media_type' => 'image',
            'image_path' => '[]',
            'is_active' => false,
            'created_at' => $now,
            'updated_at' => $now,
        ], ['offers', 'visa', 'transport']));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_advertisements');
    }
};
