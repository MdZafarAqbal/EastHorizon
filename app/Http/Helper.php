<?php
use App\Models\Message;
use App\Models\Category;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\city;
use App\Models\Product;
use App\Models\CartItem;

// use Auth;

class Helper
{
  public static function getAllCategories()
  {
    $categories = Category::orderBy('id', 'ASC')->get();
    return $categories;
  }

  // Cart Count
  public static function cartCount() {
    if(Auth::check()) {
      $user_id=auth()->user()->id;
      return CartItem::where('user_id',$user_id)->count('product_id');
    }
    else {
      return 0;
    }
  }

  // Favorites Count
  public static function favCount() {
    if(Auth::check()) {
      $user_id=auth()->user()->id;
      return Wishlist::where('user_id',$user_id)->count('product_id');
    }
    else {
      return 0;
    }
  }

  public static function getAllProductFromCart()
  {
    if (Auth::check()) {
      $user_id = auth()->user()->id;
      return CartItem::with('product')->where('user_id', $user_id)->get();
    } else {
      $cart = Session::get('cart');
      return $cart;
    }
  }

  //Total cart amount without tax
  public static function CartAmount()
  {
    if (Auth::check()) {
      $user_id = auth()->user()->id;
      return CartItem::where('user_id', $user_id)->sum('subtotal');
    } else {
      $cart_items = Session::get('cart');
      $sum = 0;

      foreach ($cart_items as $item) {
        $sum += $item->subtotal;
      }

      return $sum;
    }
  }

  // Total cart tax
  public static function totalCartTax() {
    if (Auth::check()) {
      $user_id = auth()->user()->id;
      return CartItem::where('user_id', $user_id)->sum('tax');
    } else {
      $cart_items = Session::get('cart');
      $sum = 0;

      foreach ($cart_items as $item) {
        $sum += $item->tax;
      }
      return $sum;
    }
  }

  // Total cart tax
  public static function total_discount()
  {
    if (Auth::check()) {
      $user_id = auth()->user()->id;
      return CartItem::where('user_id', $user_id)->sum('discount');
    } else {
      return 0;
    }
  }

  // Total cart amount with tax
  public static function totalCartAmount()
  {
    if (Auth::check()) {
      $user_id = auth()->user()->id;
      return CartItem::where('user_id', $user_id)->sum('total');
    } else {
      $cart_items = Session::get('cart');
      $sum = 0;

      foreach ($cart_items as $item) {
        $sum += $item->total;
      }

      return $sum;
    }
  }
}
?>