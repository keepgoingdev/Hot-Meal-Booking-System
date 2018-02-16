<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    protected $fillable = [
        'name', 'code', 'plan_id', 'is_activated', 'activated_by'
    ];
    protected $hidden = [
        'id', 'code', 'plan_id', 'activated_by', 'created_at', 'updated_at'
    ];
    public $timestamps = false;

    public function plan(){
        return $this->belongsTo('App\Plan');
    }

    public function activate($userId){
        $this->is_activated = true;
        $this->activated_by = $userId;
        $this->save();
    }

    public static function validateCode($code)
    {
        return self::where('code', $code)->first();
    }
}
