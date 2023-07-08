<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubCategory;
use App\User;
use Auth;
use Session;
use DB;
use Hash;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SendsPasswordResetEmails;

class FrontendController extends Controller
{
  public function home()
  {
    $banners = Banner::where('status', 'active')->orderBy('id', 'ASC')->get();
    $categories = Category::where('status', 'active')->get();
    $pop_products = Product::where('promotion', 'popular')->where('status', 'active')->orderBy('name', 'ASC')->get();
    $trn_products = Product::where('promotion', 'trending')->where('status', 'active')->inRandomOrder()->get();
    $new_products = Product::where('promotion', 'new')->where('status', 'active')->orderBy('created_at', 'DESC')->get();
      
    return view('frontend.index')->with('banners', $banners)->with('categories', $categories)->with('pop_products', $pop_products)->with('new_products', $new_products)->with('trn_products', $trn_products);
  }

  public function product_detail($slug)
  {
    $product = Product::with('categories.products', 'images')->where(['slug' => $slug, 'status' => 'active'])->first();
    $relcats = $product->categories;

    $relproducts = collect();

    foreach($relcats as $cat) {
      $cat_products = $cat->products->where('status', 'active')->unique();
      $relproducts = $relproducts->concat($cat_products)->unique();
    }

    $relproducts = $relproducts->random(fn (Collection $items) => min(10, count($items)));

    return view('frontend.pages.product-detail')->with('product', $product)->with('relproducts', $relproducts);
  }

  public function productSort(Request $request) {
    if($request->search) {
      $products = Product::where('status', 'active')->where(function(Builder $query) {
        $query->where('name', 'like', '%'.$request->que.'%');
      })->get();

    } else if ($request->subslug) {
      $subcat = SubCategory::with('products')->where('slug', $request->subslug)->first();
      $products = $subcat->products()->where('status', 'active')->get();

    } else if ($request->slug) {
      $category = Category::with('products')->where('slug', $request->slug)->first();
      $products = $category->products()->where('status', 'active')->get();

    } else {
      $products = Product::where('status', 'active')->get();
    }

    $sort_by = $request->value;

    if ($sort_by) {
      if($sort_by == 'rand')
        $products = $products->sortBy('id');
      if($sort_by == 'a-z')
        $products = $products->sortBy('name');
      else if($sort_by == 'z-a')
        $products = $products->sortByDesc('name');
      else if($sort_by == 'low-prc')
        $products = $products->sortBy('price');
      else if($sort_by == 'new')
        $products = $products->where('promotion', 'new')->all();
      else if($sort_by == 'popular')
        $products = $products->where('promotion', 'popular')->all();
      else if($sort_by == 'trending')
        $products = $products->where('promotion', 'trending')->all();
    }

    if (count($products) !== 0) {
      $content = '';

      foreach ($products as $product) {
        
        if(Auth::check())
          $wishlist = $product->wishlists()->where('user_id', Auth::user()->id)->get();

        $content .= <<<EOD
          <div class="product-card {$product->id}-card carousel-cell">
          <img class="product-image" src="{$product->photo}" alt="product image">
          
          <div class="overlay">
            <button id="product-{$product->id}" class="btn btn-quick-view" title="Quick View" onclick="showModal(id, {$product->id})"> 
              <i class="fa-regular fa-eye"></i>
              <p>Quick View</p>
            </button>
          </div>

          <div class="meta-detail">
            <h3 class="product-title">{$product->name}</h3>
        EOD;

        
          $content .= <<<EOD
            <p class="price">AED <span class="value">{$product->price}</span></p>
          EOD;
        

        $content .= <<<EOD
            </div>

            <div class="prod-detail-link">
              <a href="/product-detail/{$product->slug}" class="btn btn-submit detail-link"> Product Details </a>
        EOD;

        if(Auth::user()) {
          if(count($wishlist) != 0) {
            $content .= <<<EOD
                <button class="btn favbtn" onclick="fav(this, {$product->id})"><i class="fa-solid fa-heart fav"></i></button>
                </div>
              </div>
              EOD;
          }
          else {
            $content .= <<<EOD
                <button class="btn favbtn" onclick="fav(this, {$product->id})"><i class="fa-regular fa-heart fav"></i></button>
                </div>
              </div>
              EOD;
          }
        }

        else {
          $content .= <<<EOD
                  <button class="btn favbtn" onclick="window.location.href = 'user/login';"><i class="fa-regular fa-heart fav"></i></button>
                </div>
              </div>
            EOD;
        }
      } 
    } else {

      $content = <<<EOD
        <p class="no-product">There is no product in this criteria.</p>
      EOD;
    }
    return $content;
  }

  public function product_search(Request $request) {
    $products = Product::where('status', 'active')->where(function(Builder $query) use ($request) {
      $query->where('name', 'like', '%'.$request->search.'%');
    })->get();

    $categories = Category::get();

    return view('frontend.pages.product-grids')->with(['products' => $products, 'cats' => $categories, 'slug' => null, 'subslug' => null, 'search' => 1, 'que' => $request->search]);
  }

  public function products(Request $request) {
    $products = Product::where('status', 'active')->orderBy('name')->get();
    $categories = Category::where('status', 'active')->get();

    return view('frontend.pages.product-grids')->with(['products' => $products, 'cats' => $categories, 'slug' => null, 'subslug' => null, 'search' => null, 'que' => null]);
  }

  public function productCat(Request $request) {
    $category = Category::with('products')->where('slug', $request->slug)->first();
    $products = $category->products->where('status', 'active')->sortBy('name');
    $categories = Category::where('status', 'active')->get();

    return view('frontend.pages.product-grids')->with(['products' => $products, 'cats' => $categories, 'slug' => $request->slug, 'subslug' => $request->subslug, 'search' => null, 'que' => null]);
  }

  public function productSubCat(Request $request){
    $subcat = SubCategory::with('products')->where('slug', $request->subslug)->first();
    $products = $subcat->products()->where('status', 'active')->orderBy('name')->get();
    $categories = Category::where('status', 'active')->get();

    return view('frontend.pages.product-grids')->with(['products' => $products, 'cats' => $categories, 'slug' => $request->slug, 'subslug' => $request->subslug, 'search' => null, 'que' => null]);
  }

  public function logout(){
    Session::forget('user');
    Auth::logout();
    request()->session()->flash('success','Logout successfully');
    return back();
  }

  public function PassResetForm(Request $request){
    return view('auth.passwords.reset')->with('request', $request);
  }


  public function autocomplete_search(Request $request) {
    $data = array();
    $products = Product::where('status', 'active')->get();
    foreach($products as $product) {
      array_push($data, $product->name);
      foreach ($results as $result) {
        array_push($data, $result);
      }
    }

    $data = array_filter($data, function($value) { return !is_null($value) && $value !== '' && $value !== ' '; });
    $data = array_unique($data);
    $data = array_map('trim', $data);
    sort($data);
    echo json_encode($data);
  }
}
