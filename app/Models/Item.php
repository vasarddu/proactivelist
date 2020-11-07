<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'view_count'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
