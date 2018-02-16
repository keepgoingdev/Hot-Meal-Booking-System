<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Condiment extends Model
{

    protected $fillable = [
        'meal_id', 'name', 'serving_size', 'calories', 'image', 'notes', 'is_snack', 'store'
    ];
    public $timestamps = false;

    public static function createCondiment($record, $mealId)
    {
        $condiment = self::firstOrNew(array(
            'meal_id' => $mealId,
            'name' => $record['MEAL'],
            'serving_size' => $record['SERVING SIZE'],
            'calories' => $record['CALORIES PER SERVING'] == '' ? 0 : $record['CALORIES PER SERVING'],
            'image' => '/img/food/' . $record['IMAGE'],
            'notes' => $record['NOTES'],
            'is_snack' => $record['SNACK OR NOT'],
            'store' => $record['STORE']
        ));
        $condiment->save();
    }
}
