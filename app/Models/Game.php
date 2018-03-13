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

    //添加游戏时多图片以json格式存储
    public function setImagesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['images'] = json_encode($value);
        }
    }

    //decode 然后拼接路径
    public function getImagesAttribute($value)
    {
        $value = json_decode($value, true);
        for ($i = 0; $i < count($value); $i++) {
            $value[$i] = env('APP_URL') . 'uploads/' . $value[$i];
        }

//        if (is_array($value)) {
//            return  json_encode($value);
//        }
        return $value;
    }

    //获取类别名称
    public function getCategroyIdAttribute($value)
    {
        $category = Category::find($value)->name;
        return $category;
    }

    //获取图片
    public function getImageAttribute($value)
    {
        return env('APP_URL') . 'uploads/' . $value;
    }

    //获取背景图片
    public function getBackgroundImageAttribute($value)
    {
        return env('APP_URL') . 'uploads/' . $value;
    }
}
