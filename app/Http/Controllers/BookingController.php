<?php
namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\Professional;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
class BookingController extends Controller
{
    public function create(Request $request){ $service = $request->integer('service') ? Service::findOrFail($request->integer('service')) : null; return view('booking.create', ['service'=>$service,'services'=>Service::where('active',true)->get(),'professionals'=>Professional::with('user')->where('active',true)->get()]); }
    public function store(Request $request){
        if (!Auth::check()) return redirect()->route('login')->with('status','Sign in to book your appointment.');
        $data=$request->validate(['service_id'=>'required|exists:services,id','professional_id'=>'required|exists:professionals,id','date'=>'required|date|after_or_equal:today','time'=>'required','notes'=>'nullable|string|max:1000']);
        $service=Service::findOrFail($data['service_id']); $starts=Carbon::parse($data['date'].' '.$data['time']); $ends=$starts->copy()->addMinutes($service->duration_minutes);
        $conflict=Appointment::where('professional_id',$data['professional_id'])->whereIn('status',['pending','confirmed'])->where(function($q)use($starts,$ends){$q->where('starts_at','<',$ends)->where('ends_at','>',$starts);})->exists();
        if($conflict) return back()->withInput()->withErrors(['time'=>'That time is no longer available.']);
        Appointment::create(['user_id'=>Auth::id(),'professional_id'=>$data['professional_id'],'service_id'=>$service->id,'starts_at'=>$starts,'ends_at'=>$ends,'status'=>'pending','notes'=>$data['notes']??null,'total'=>$service->price]);
        return redirect()->route('dashboard')->with('status','Your appointment request has been received.');
    }
}
