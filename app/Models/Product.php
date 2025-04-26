<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id' // o el nombre correcto del campo de relación
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
