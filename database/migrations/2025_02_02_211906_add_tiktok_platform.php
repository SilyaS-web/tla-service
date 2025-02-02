<?php

use App\Models\Platform;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Platform::create([
            'title' => 'Tiktok',
            'image' => 'img/tiktok-icon.svg',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Platform::where("title", "=", "Tiktok")->delete();
    }
};
