<?php
/**
 * Created by PhpStorm.
 * User: Andreia
 * Date: 12/04/2025
 * Time: 13:32
 */
namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class JsonSeeder extends Seeder
{
    public function run()
    {
        $json = File::get(database_path('data/db.json'));
        $data = json_decode($json, true);

        foreach ($data['sites'] as $site) {
            DB::table('sites')->updateOrInsert(['id' => $site['id']], $site);
        }

        foreach ($data['categories'] as $category) {
            DB::table('categories')->updateOrInsert(['id' => $category['id']], $category);
        }

        foreach ($data['videos'] as $video) {
            DB::table('videos')->updateOrInsert(
                ['id' => $video['id']],
                [
                    'title' => $video['title'],
                    'created_at' => Carbon::parse($video['created_at'])->format('Y-m-d H:i:s'),
                    'category_id' => $video['category'],
                    'hls_path' => $video['hls_path'],
                    'description' => $video['description'],
                    'thumbnail' => $video['thumbnail'],
                    'site_id' => $video['site_id'],
                    'views' => $video['views'],
                    'likes' => $video['likes'],
                ]
            );
        }
    }
}