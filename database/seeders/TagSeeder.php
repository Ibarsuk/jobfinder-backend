<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TagSeeder extends Seeder
{
    const MAX_TAGS_ATTACHED = 10;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $possibleTags = Storage::disk('resources')->get('data/tags.txt');
        $possibleTagsSeparated = preg_split("/\r\n|\n|\r/", $possibleTags);

        $randomTags = Tag::factory(count($possibleTagsSeparated))->make()->toArray();

        foreach ($randomTags as $key => &$tag) {
            $tag['name'] = $possibleTagsSeparated[$key];
        }

        return Tag::insert($randomTags);
    }

    public static function attachRandomTags ($tagsNumber, $entityCollection) {
        $entityCollection->each(function ($entity) use ($tagsNumber) {
            $nonUniqueTags = array_map(
                function() use ($tagsNumber) {return rand(1, $tagsNumber);},
                array_fill(0, rand(1, TagSeeder::MAX_TAGS_ATTACHED), null)
            );
            $randomTags = array_unique($nonUniqueTags); 
            $entity->tags()->attach($randomTags);
        });
    }
}
