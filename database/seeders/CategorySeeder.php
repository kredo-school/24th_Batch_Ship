<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;

        //
    }

    public function run(): void
    {
        DB::table('categories')->delete();

        // // categoriesテーブルのオートインクリメント値をリセット
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 1');


        $categories = [
            [
                'name' =>'NONE',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Tweet',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Actor',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Adventure',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Animal',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Anime',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Alcohol',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Art',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Baseball',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Basketball',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Bar',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Beauty',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Bike',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Book',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Bowling',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Business',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Car',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Cafe',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Calture',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Camera',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Camp',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Cereblity',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Cigarettes',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Cooking',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Cosplay',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Country',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Cycling',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Dance',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Darts',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Design',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Diary',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Diving',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'DIY',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'DJ',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Dolls',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Drive',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Fireworks',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Flower',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Food',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Fashion',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Fishing',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Fitness',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Game',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Gambling',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Gardening',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Golf',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Handmade',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Home',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Health',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Hiking',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'History',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Hot spring',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Hose Riding',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Idol',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Investment',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'IT',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Karaoke',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Language',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Makeup',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Masic',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Material Arts',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Music',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Movie',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Nail Art',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Nature',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Painting',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Party',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Rugby',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Savings',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Shisya',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Shopping',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Shrine',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Soccer',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Spaicy Food',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Sports',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Study',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Sweets',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Temple',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Tennis',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Travel',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Train',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'TV',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Running',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Volleyball',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Walking',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Wine',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],
            [
                'name' =>'Yoga',
                'created_at' => NOW(),
               'updated_at' => NOW()
            ],



        ];
        $this->category->insert($categories);
    }
}
