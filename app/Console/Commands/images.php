<?php

namespace App\Console\Commands;

use App\Models\ProjectFile;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class images extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:compress';

    /**
     * The console command description.
     *a
     * @var string
     */
    protected $description = 'Сжимает изображения проектов, пользователей';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $this->info('Обрабатываем пользователя: ' . $user->name . ', id: ' . $user->id);
            $image = Storage::get($user->image);
            $urls = ImageService::makeCompressedCopiesFromFile($image, 'profile/'.$user->id.'/');
            $user->image = $urls[1];
            $user->save();
            $this->info('готово, path: : ' . $user->image);
        }

        $project_files = ProjectFile::all();

        foreach ($project_files as $project_file) {
            $this->info('Обрабатываем картинку проекта: ' . $project_file->id . ' проект: ' . $project_file->source_id);
            $image = Storage::get($project_file->link);
            $urls = ImageService::makeCompressedCopiesFromFile($image, 'projects/' .  $project_file->source_id . '/');
            $project_file->link = $urls[1];
            $project_file->save();
            $this->info('готово, path: : ' . $project_file->link);
        }

        return 0;
    }
}
