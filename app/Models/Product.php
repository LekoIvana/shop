<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['user_id','category_id','gender_id', 'name','description','price','size','image'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }


    public function gender()
    {
        return $this->belongsTo(Gender::class,'gender_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    use HasFactory;
}
