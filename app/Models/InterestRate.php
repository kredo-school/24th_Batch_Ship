<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestRate extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'interest_rate';

    protected $fillable = [ 'user_id', 'community_id', 'percentage' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function community()
    {
         return $this->belongsTo(Community::class);
    }

    public function getPercentage()
    {
        return $this->belongsTo(InterestRate::class);

    }
    
}
