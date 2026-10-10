<?php

namespace Database\Seeders;

use App\Models\Feat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = file_get_contents(database_path('data/feats.json'));
        $feats = json_decode($file, true);

        foreach($feats as $feat){
            Feat::create([
                'name' => $feat['name'],
                'description' => $feat['description']
            ]);
        }
    }
}
