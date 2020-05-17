<?php

use App\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Channel::create([
            'name' => 'Laravel 7',
            'slug' => Str::slug('Laravel 7')
        ]);

        Channel::create([
            'name' => 'Symfony 5',
            'slug' => Str::slug('Symfony 5')
        ]);

        Channel::create([
            'name' => 'Vue js 3',
            'slug' => Str::slug('Vue js 3')
        ]);

        Channel::create([
            'name' => 'NodeJs',
            'slug' => Str::slug('NodeJs')
        ]);
    }
}
