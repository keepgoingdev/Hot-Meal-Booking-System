<?php

use App\Models\FoodItem;
use App\Models\Meal;
use Illuminate\Database\Seeder;

class FoodMealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $breakfast = Meal::firstOrCreate(array(
            'name' => 'Breakfast'
        ));
        $lunch = Meal::firstOrCreate(array(
            'name' => 'Lunch'
        ));
        $dinner = Meal::firstOrCreate(array(
            'name' => 'Dinner'
        ));
        $snacks = Meal::firstOrCreate(array(
            'name' => 'Snacks'
        ));

        $eggItem = FoodItem::firstOrCreate(array(
            'name' => 'Trader Joe\'s Egg (Brown/White)',
            'portion' => '1',
            'unit' => 'egg',
            'calories' => '70',
            'image' => '/img/food/egg.jpg',
            'is_condiment' => false
        ));

        if (!$breakfast->foodItems->contains($eggItem)) {
            $breakfast->foodItems()->attach($eggItem);
        }

        $hummusItem = FoodItem::firstOrCreate(array(
            'name' => 'Trader Joe\'s Chunky Olive Hummus',
            'portion' => '2',
            'unit' => 'tablespoons',
            'calories' => '80',
            'image' => '/img/food/hummus.jpg',
            'is_condiment' => true
        ));

        $greekSalladItem = FoodItem::firstOrCreate(array(
            'name' => 'Trader Joe\'s Classic Greek Salad (With Dressing)',
            'portion' => '1',
            'unit' => 'container',
            'calories' => '350',
            'image' => '/img/food/greek_sallad.jpg',
            'is_condiment' => false
        ));

        if (!$lunch->foodItems->contains($greekSalladItem)) {
            $lunch->foodItems()->attach($greekSalladItem);
        }

        $greekSalladItem2 = FoodItem::firstOrCreate(array(
            'name' => 'Trader Joe\'s Classic Greek Salad (Without Dressing)',
            'portion' => '1',
            'unit' => 'container',
            'calories' => '120',
            'image' => '/img/food/greek_sallad.jpg',
            'is_condiment' => false
        ));

        if (!$lunch->foodItems->contains($greekSalladItem2)) {
            $lunch->foodItems()->attach($greekSalladItem2);
        }
    }
}
