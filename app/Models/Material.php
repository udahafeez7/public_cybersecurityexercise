<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function  pretasks()
    {
        return $this->belongsTo(Pretasks::class, 'pretasks_id', 'id');
    }
}