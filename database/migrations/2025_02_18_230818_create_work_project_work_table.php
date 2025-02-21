<?php

use App\Models\Work;
use App\Models\WorkProjectWork;
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
        Schema::create('work_project_works', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_id');
            $table->foreign('work_id')->references('id')->on('works')->cascadeOnDelete();
            $table->unsignedBigInteger('project_work_id');
            $table->foreign('project_work_id')->references('id')->on('project_works')->cascadeOnDelete();
            $table->timestamps();
        });

        $works = Work::all();
        foreach ($works as $work) {
            WorkProjectWork::create([
                'work_id' => $work->id,
                'project_work_id' => $work->project_work_id,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_project_works');
    }
};
