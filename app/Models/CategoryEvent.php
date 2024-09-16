<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryEvent extends Model
{
    use HasFactory;

    protected $table = 'category_event';

    protected $fillable = ['category_id', 'event_id'];

    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
