<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = "games";

    protected $fillable = [
        'name', 'category_id',
    ];

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public function setImagesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['images'] = json_encode($value);
        }
    }

    public function getImagesAttribute($value)
    {
        return json_decode($value, true);
    }
}
