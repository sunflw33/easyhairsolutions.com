<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
class CartController extends Controller
{
 public function add(Product $product){ $cart=session('cart',[]); $cart[$product->id]=($cart[$product->id]??0)+1; session(['cart'=>$cart]); return back()->with('status',$product->name.' added to your bag.'); }
 public function index(){ $ids=array_keys(session('cart',[])); $products=Product::whereIn('id',$ids)->get(); $cart=session('cart',[]); $total=$products->sum(fn($p)=>$p->price*($cart[$p->id]??0)); return view('shop.cart',compact('products','cart','total')); }
 public function update(Request $request){ foreach($request->input('qty',[]) as $id=>$qty){ if((int)$qty<=0) session()->forget("cart.$id"); else session(["cart.$id"=>(int)$qty]); } return back(); }
 public function checkout(){ abort_unless(auth()->check(),403); return view('shop.checkout',['total'=>$this->total()]); }
 private function total(){ $cart=session('cart',[]); return Product::whereIn('id',array_keys($cart))->get()->sum(fn($p)=>$p->price*($cart[$p->id]??0)); }
}
