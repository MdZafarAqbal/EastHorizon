<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Auth;

class ModalController extends Controller
{
  public function create_modal(Request $request) {
    $product = Product::with('images')->where('id', $request->product_id)->first();
    
    $images = $product->images()->pluck('name');
    $price = $product->price;   
    $content = "";

    $content .= <<<EOD
      <div id="modal" class="modal" tab-index="-1">
        <button type="button" class="btn close modal-close" id="close-btn" onclick="closeModal()"><i class="fa-solid fa-xmark"></i></button>   
        <div class="modal-content">
          <div class="shazoom" id="shazoom">
            <div class="img-box">
              <ul class="img-ul">
    EOD;

    foreach($images as $img) {
      $content .= <<<EOD
        <li><img src="/images/products$img" alt="Product Image"></li>
      EOD;
    }

    $content .= <<<EOD
          </ul>
        </div>

        <div class="zoom-nav"></div>

        <!-- Nav Buttons -->
        <p class="zoom-btn">
          <a href="javascript:void(0);" class="zoom-prev-btn"> < </a>
          <a href="javascript:void(0);" class="zoom-next-btn"> > </a>
        </p>
      </div>

      <div class="modal-details-container">
        <div class="product-modal-detail">
          <h1 id="product-name" class="title product-title">$product->name</h1>
          <h1 id="model-no" class="model-no">$product->model_no</h1>

          <h1 id="price" class="price">AED $product->price</h1>         
    EOD;

    $content .= <<<EOD
                 
                <input type="hidden" name="price-input" id="price-input" value="$product->price">
                <div class="qty-manage" id="qty-manage">
                  <input type="button" value="-" class="qty-minus minus qty-control" field="quantity" disabled>
                  <input type="number" name="quantity" id="qty" class="qty" min="1" value="1" oninput="this.value = Math.abs(this.value)">
                  <input type="button" value="+" class="qty-plus plus qty-control" field="quantity">
                </div>
                <div class="cart-btn-div" onclick="cartAdd($product->id)">
                  <button id="modal-cart-btn" class="cart-btn">
                    <span class="add-to-cart">Add to Cart</span>
                    <span class="added">Added</span>
                    <i class="fas fa-shopping-cart"></i>
                    <i class="fas fa-box"></i>
                  </button>
                </div>
              </div>
              
             
                  
              <a href="/product-detail/$product->slug" class="modal-view-link btn" id="modal-view-link"><i class="fa-solid fa-circle-info" id="product-details-icon"></i>VIEW PRODUCT DETAILS</a>
            </div>
          </div>
        </div>
      </div>
    EOD;
    return $content;
  }

  
}
