<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Professional;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function customer()
    {
        return view('customer.dashboard', [
            'appointments' => Appointment::with(['professional.user','service'])->where('user_id', Auth::id())->orderByDesc('starts_at')->limit(8)->get(),
        ]);
    }

    public function professional()
    {
        $professional = Professional::where('user_id', Auth::id())->first();
        return view('professional.dashboard', [
            'professional' => $professional,
            'appointments' => $professional ? Appointment::with(['customer','service'])->where('professional_id',$professional->id)->where('starts_at','>=',now())->orderBy('starts_at')->limit(10)->get() : collect(),
        ]);
    }

    public function owner()
    {
        return view('owner.dashboard', [
            'appointments' => Appointment::with(['customer','professional.user','service'])->latest()->limit(10)->get(),
            'customers' => User::role('customer')->count(),
            'professionals' => User::role('professional')->count(),
            'services' => Service::count(),
            'products' => Product::count(),
        ]);
    }
}
