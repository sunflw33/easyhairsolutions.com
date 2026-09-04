<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Professional extends Model
{
    protected $fillable = ['user_id','bio','specialties','photo','active'];
    protected function casts(): array { return ['specialties'=>'array','active'=>'boolean']; }
    public function user(){ return $this->belongsTo(User::class); }
}
