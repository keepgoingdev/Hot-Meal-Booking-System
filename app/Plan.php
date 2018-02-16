<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name', 'slug', 'braintree_plan', 'cost', 'description', 'is_discount'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
