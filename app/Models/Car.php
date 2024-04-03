<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = ['color','category_id','model','registration_no','make'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
