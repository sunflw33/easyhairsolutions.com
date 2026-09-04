<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Appointment extends Model
{
    protected $fillable = ['user_id','professional_id','service_id','starts_at','ends_at','status','notes','total'];
    protected function casts(): array { return ['starts_at'=>'datetime','ends_at'=>'datetime','total'=>'decimal:2']; }
    public function customer(){ return $this->belongsTo(User::class,'user_id'); }
    public function professional(){ return $this->belongsTo(Professional::class); }
    public function service(){ return $this->belongsTo(Service::class); }
}
