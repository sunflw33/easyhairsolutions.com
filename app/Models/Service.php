<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Service extends Model
{
    protected $fillable = ['name','slug','category','description','duration_minutes','price','active'];
    protected function casts(): array { return ['price'=>'decimal:2','active'=>'boolean']; }
}
