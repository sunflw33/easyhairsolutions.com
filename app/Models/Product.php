<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $fillable = ['name','slug','description','price','stock','active'];
    protected function casts(): array { return ['price'=>'decimal:2','active'=>'boolean']; }
}
