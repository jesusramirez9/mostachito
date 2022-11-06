<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts');

        Storage::deleteDirectory('services');
        Storage::makeDirectory('services');

        Storage::deleteDirectory('homes');
        Storage::makeDirectory('homes');

        Storage::deleteDirectory('slides');
        Storage::makeDirectory('slides');

         \App\Models\Post::factory(2)->create();
         \App\Models\Service::factory(2)->create();
         \App\Models\Home::factory(2)->create();
    }
}
