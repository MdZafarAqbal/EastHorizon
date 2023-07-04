<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\ProductAttribute;

class WishlistController extends Controller
{
    protected $product = null;
    public function __construct(Product $product){
        $this->product = $product;
    }

    public function wishlist() {
      $products = new Collection();
      if(Auth::check()) {
        $wishlists = Wishlist::with('product')->where('user_id', Auth::user()->id)->get();
        $products = $wishlists->pluck('product');
      }
      return view('frontend.pages.wishlist')->with('products', $products);
    }

    public function wishlist_add (Request $request) {
      $request->validate([
        'id' => 'required',
      ]);

      $product = Product::where('id', $request->id)->first();
      dd($request->all());
      $user_id = auth()->user()->id;

        
            $wishlist = new Wishlist;
            $wishlist->user_id = $user_id;
            $wishlist->product_id = $request->id;

            $wishlist->save();

            $fav_counts = Wishlist::where('user_id', $user_id)->count('product_id');
      
            request()->session()->flash('success','Product successfully added to wishlist');  
            return $fav_counts;
          }  
          
    public function wishlist_delete(Request $request) {
      $wishlist = Wishlist::where('product_id', $request->id)->delete();
      request()->session()->flash('success','Wishlist successfully removed');
      $user_id = auth()->user()->id;
      $fav_counts = Wishlist::where('user_id', $user_id)->count('product_id');

      if($request->reload == 1) {
        return back();
      }

      return $fav_counts;
    }     
}
