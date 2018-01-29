<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = "games";

    protected $fillable = [
        'name','category',
    ];

    //todo 模型关系
    public function belongsTo($related, $foreignKey = null, $ownerKey = null, $relation = null)
    {
    }
}
