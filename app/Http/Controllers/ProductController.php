<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\ProductBrand;
use App\Models\ProductImage;
use App\Imports\ProductsImport;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Str;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $products = Product::paginate(10);
    return view('admin_panel.product.index')->with('products',$products);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $brand=Brand::get();
      $category=Category::with('subcat')->get();
      $subcategory=SubCategory::get();
      $product_category=ProductCategory::get();
     
      // return $category;
      return view('admin_panel.product.create')->with('product_categories',$product_category)
      ->with('categories',$category)->with('brands',$brand)->with('subcategories',$subcategory);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {  
              
      $this->validate($request,[
        // 'plu'=>'required|numeric',
        // 'name'=>'string|required', 
        // 'model_no'=>'string|required',             
        // 'photo'=>'required',
        // 'promotion'=>'required|in:default,new,trending',
        // 'price'=>'numeric|nullable',          
        // 'status'=>'required|in:active,inactive'
          
    ]);
    
     
    $data=$request->all(); 
    
    $slug=Str::slug($request->name);
    $count=Product::where('slug',$slug)->count();        
    $data['slug']=$slug;

    $status=Product::create($data);
    $brands = [];
    $brands[] =$request->brand_id;
    for($i=2; $i<=$request->brands_count; $i++){
        $brand= 'brand_id'.$i;
        $brands[] = $request->$brand;
    }
    foreach ($brands as $product_brand) {
        $brand = new ProductBrand;
        $brand['product_id']=$status->id;           
        $brand['brand_id']=$product_brand;
        $brand->save();
    }   
    $categories = [];
    $categories[] = $request->cat_id;
    $subcategories = [];
    $subcategories[] = $request->subcat_id;
    for($i=2; $i<=$request->cat_count; $i++){
        $cat= 'cat_id'.$i;
        $categories[] = $request->$cat; 
       
    }
    
    for($i=2; $i<=$request->subcat_count; $i++){ 
        $subcat= 'subcat_id'.$i;
        $subcategories[]= $request->$subcat;   
    }

    
    if($categories[0]!==""){
        foreach ($categories as $product_cat) {
            $category = new ProductCategory;
            $category['product_id']=$status->id;           
            $category['cat_id']=$product_cat;
            $category->save();
        }
        
    }

    if($subcategories[0]!==""){
        foreach ($subcategories as $product_subcat) {
            $subcategory = new ProductCategory;
            $subcategory['product_id']=$status->id;          
            $subcategory['subcat_id']=$product_subcat;            
            $subcategory->save();
        }
    }
      
          
    if($request->hasFile("images")){
        $files=$request->file("images");
        foreach($files as $file){
            $imageName='/'.$file->getClientOriginalName();
            $request['product_id']=$status->id;
            $request['name']=$imageName;
            $file->move(base_path("public/images/products"),$imageName);   
            ProductImage::create($request->all());
        }
    }  
                             
    if($status){
        request()->session()->flash('success','Product Successfully added');
    }
    else{
        request()->session()->flash('error','Please try again!!');
    }
    return redirect()->route('product.index');


    }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      return view('products.import');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {   
    $product=Product::findOrFail($id);
    $category=Category::with('subcat')->get();
    
    $procat=ProductCategory::get();
    $brand=Brand::get(); 
      // return $items;
    return view('admin_panel.product.edit')->with('product',$product)
    ->with('categories',$category)
    ->with('procats',$procat)
    ->with('brands',$brand);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
 
      $product=Product::findOrFail($id);
    
      $data=$request->all();
     
      $size=$request->input('size');
     
      $status=$product->fill($data)->save();
      
    $brands = [];
    $brands[] =$request->brand_id;
    for($i=2; $i<=$request->brands_count; $i++){
        $brand= 'brand_id'.$i;
        $brands[] = $request->$brand;
    }
    if($brands[0]){
        foreach ($brands as $product_brand) {
            $brand = new ProductBrand;
            $brand['product_id']=$id;           
            $brand['brand_id']=$product_brand;
            $brand->save();
        } 
    } 
    
    $categories = [];
    $categories[] = $request->cat_id;
    $subcategories = [];
    $subcategories[] = $request->subcat_id;
    for($i=2; $i<=$request->cat_count; $i++){
      $cat= 'cat_id'.$i;
      $categories[] = $request->$cat;    
    }
    
    for($i=2; $i<=$request->subcat_count; $i++){ 
        $subcat= 'subcat_id'.$i;
        $subcategories[]= $request->$subcat;   
    }
    
    if($categories[0] !== ""){
      foreach ($categories as $product_cat) {
        $procat = ProductCategory::where(['product_id' => $id, 'cat_id' => $product_cat])->first();
        if(!$procat) {
          $category = new ProductCategory;
          $category['product_id'] = $id;           
          $category['cat_id'] = $product_cat;
          $category->save();
        }
      }
    }
   
   
    if($subcategories[0]!==""){
      foreach ($subcategories as $product_subcat) {
        $prosubcat = ProductCategory::where(['product_id' => $id, 'subcat_id' => $product_subcat])->first();
        if(!$prosubcat) {
          $subcategory = new ProductCategory;
          $subcategory['product_id'] = $id;  
          $subcategory['subcat_id'] = $product_subcat;            
          $subcategory->save();
        }
      }
    }
  
    
    if($request->hasFile("images")){
        $files=$request->file("images");
        foreach($files as $file){
            $imageName='/'.$file->getClientOriginalName();
            $request['product_id']=$id;
            $request['name']=$imageName;
           $file->move(base_path("public/images/products"),$imageName);   
            ProductImage::create($request->all());
        }
    }     
    if($status){
        
        request()->session()->flash('success','Product Successfully updated');
    }
    else{
        request()->session()->flash('error','Please try again!!');
    }
    return redirect()->route('product.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $product=Product::findOrFail($id);
    $status=$product->delete();
    
    if($status){
        request()->session()->flash('success','Product successfully deleted');
    }
    else{
        request()->session()->flash('error','Error while deleting product');
    }
    return redirect()->route('product.index');
  }
 

  //delete Category
  public function deleteCategory($id, Request $request){
      $productCategory=ProductCategory::where('cat_id',  $id)->where('product_id', $request->productId);
      $status=$productCategory->delete(); 
      if($status){
          request()->session()->flash('success','Product successfully deleted');
      }
      else{
          request()->session()->flash('error','Error while deleting product');
      }
  
      //return redirect()->back();
  }

  public function deleteBrand($id, Request $request){
    $productBrand=ProductBrand::where('brand_id',  $id)->where('product_id', $request->productId);
    $status=$productBrand->delete(); 
    if($status){
        request()->session()->flash('success','Product successfully deleted');
    }
    else{
        request()->session()->flash('error','Error while deleting product');
    }

    //return redirect()->back();
}
      public function deleteImage($id){
          $product=ProductImage::findOrFail($id);
          $status=$product->delete();

          
          if($status){
              request()->session()->flash('success','Product successfully deleted');
          }
          else{
              request()->session()->flash('error','Error while deleting product');
          }
          return redirect()->back();
      }

    public function exportProducts(Request $request){
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

}
