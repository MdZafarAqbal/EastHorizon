<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Support\Str;
use Helper;
use Session;

class CartController extends Controller
{
  protected $product = null;

  public function __construct(Product $product)
  {
    $this->product = $product;
  }

  public function cart_add(Request $request)
  {
    
    $request->validate([
      'product_id' => 'required',
      'qty' => 'required',
      'price'=>'required'
    ]);
   // dd($request->all());
      $product = Product::with('categories', 'subcat')->where('id', $request->product_id)->first();

    if ($request->qty < 1) {
      return response()->json('Invalid Quantity Value. Quantity must be positive integer', 400);

    } else if (empty($product)) {
      return response()->json('Invalid Product. No such product', 400);

    } else if (Auth::check()) {
      $already_cart = CartItem::where(['user_id' => auth()->user()->id, 'product_id' => $product->id])->first();
      $order = Order::where('user_id', auth()->user()->id)->first();
      $discount = 0;

      if ($already_cart) {
        $quantity = $request->qty;
        $total = $request->price * $quantity;
        $subtotal = $total / 1.05;
        $tax = $total - $subtotal;
        $already_cart->quantity += $quantity;
        $already_cart->total += $total + $already_cart->discount;

        if(! $order) {
          $discount += $already_cart->total / 10;
          $already_cart->total -= $discount;
        }
        
        $already_cart->discount = $discount;
        $already_cart->subtotal += $subtotal;
        $already_cart->tax += $tax;
        $already_cart->save();

      } else {
        $carts = CartItem::where('user_id', Auth()->user()->id)->get();
       
        $discount = 0;

        $cart = new CartItem;
        $cart->user_id = auth()->user()->id;
        $cart->product_id = $product->id;
        $cart->price = $request->price;
        $cart->quantity = $request->qty;
        $cart->total = $request->price * $cart->quantity;
        $cart->subtotal = $cart->total / 1.05;
        $cart->tax = $cart->total - $cart->subtotal;
        
        if(!$order) {
          $discount += $cart->total / 10;
          $cart->total -= $cart->total / 10;
        }

        $cart->discount = $discount;
        $cart->save();
      }
      
    } else {
      $already_cart = 0;
      $cart_table = Session::get('cart');

      foreach ($cart_table as $cart_entry) {
        if ($cart_entry->product_id == $product->id ) {
          $already_cart = 1;
          $quantity = $request->qty;
          $total = $request->price * $quantity;
          $subtotal = $total / 1.05;
          $tax = $total - $subtotal;
          $cart_entry->quantity += $quantity;
          $cart_entry->total += $total;
          $cart_entry->subtotal += $subtotal;
          $cart_entry->tax += $tax;
        }
      }

      if ($already_cart == 0) {
        $id = Session::get('id') + 1;
        $cart = new CartItem;
        $cart->id = $id;
        $cart->user_id = Session::get('_token');
        $cart->product_id = $product->id;
        
        $cart->price = $request->price;
        $cart->quantity = $request->qty;
        $cart->total = $cart->price * $cart->quantity;
        $cart->subtotal = $cart->total / 1.05;
        $cart->tax = $cart->total - $cart->subtotal;
        Session::push('cart', $cart);
        Session::put('id', $id);
      }
    }

    $carts = Helper::getAllProductFromCart();
    $count = count(Helper::getAllProductFromCart());
    $total = number_format(Helper::totalCartAmount(), 2);
    $content = '';
    foreach($carts as $cart) {
      $price = number_format($cart->price, 2);
      $content .= <<<EOD
        <li>
          <div class="product-det">
            <h4><a class="prod-name" href="/product-detail/{$cart->product->slug}" target="_blank">{$cart->product->name}</a></h4>
            <p class="font">
      EOD;

      $content .= <<<EOD
      </p>
            <p class="font">$cart->quantity x $price AED</p>
            <a href="/cart-delete/$cart->id" class="remove font" title="Remove"><i class="fa-regular fa-trash-can"></i> Remove Item</a>
          </div>
          <a class="cart-img" href="#"><img src="{$cart->product->photo}" alt="product photo"></a>
        </li>
      EOD;
    }
    
    return [$count, $content, $total];
  }

  public function cartDelete(Request $request)
  {
    if(Auth::check()) {
      $cart = CartItem::find($request->id);
      $cart->delete();
      return back();
    }
    else {
      $cart_items = Session::get('cart');
      $found = null; 

      foreach ($cart_items as $key => $item) {
        if($item->id == $request->id) {
          $found = $key;
        }
      }

      Session::pull('cart');

      if ($found !== null) 
        unset($cart_items[$found]);

      Session::put('cart', $cart_items);
      return back();
    }
  }

  public function cart_update(Request $request)
  {
    $total;
    if (Auth::check()) {
      $cart = CartItem::find($request->id);
      $order = Order::where('user_id', auth()->user()->id)->first();
      $discount = 0;
      
      $cart->quantity = $request->qty;
      $cart->total = $cart->price * $request->qty;
      $cart->subtotal = ($cart->total) / 1.05;
      $cart->tax = $cart->total - $cart->subtotal;

      if(!$order) {
        $discount += $cart->total / 10;
        $cart->total -= $cart->total / 10;
      }
      
      $cart->discount = $discount;
      $cart->save();
      $total = $cart->total;

    } else {
      $cart_items = Session::get('cart');
      $found = null; 

      foreach ($cart_items as $key => $item) {
        if($item->id == $request->id) {
          $item->quantity = $request->qty;
          $item->total = $item->price * $request->qty;
          $item->subtotal = ($item->total) / 1.05;
          $item->tax = $item->total - $item->subtotal;

          $total = $item->total;
          $discount = 0;
        }
      }

      Session::pull('cart');
      Session::put('cart', $cart_items);
    }

    $subtotal = Helper::CartAmount();
    $tax = Helper::totalCartTax();
    $total_discount = Helper::total_discount();
    $total_amount = Helper::totalCartAmount();
    return [$discount, $total, $subtotal, $tax, $total_discount, $total_amount];
  }
}