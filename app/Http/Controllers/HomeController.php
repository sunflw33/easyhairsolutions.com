<?php
namespace App\Http\Controllers;
use App\Models\Professional;
use App\Models\Product;
use App\Models\Service;
class HomeController extends Controller
{
    public function index(){ return view('visitor.home', ['services'=>Service::where('active',true)->limit(6)->get(), 'professionals'=>Professional::with('user')->where('active',true)->limit(4)->get(), 'products'=>Product::where('active',true)->limit(4)->get()]); }
    public function shop(){ return view('shop.index', ['products'=>Product::where('active',true)->latest()->paginate(12)]); }
    public function services(){ return view('booking.services', ['services'=>Service::where('active',true)->orderBy('category')->get(), 'professionals'=>Professional::with('user')->where('active',true)->get()]); }
}
