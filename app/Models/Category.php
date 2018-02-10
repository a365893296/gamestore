<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';

    protected $fillable = [
        'name',
    ];

    public static function getAllCategories(){
        $categroies = Category::all();
//        foreach ($categroies as $key => $value)
//        {
//            $value['text'] = $value['name'];
//        }

        return $categroies;
    }
}
