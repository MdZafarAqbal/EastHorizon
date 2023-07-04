<?php

namespace App\Http\Controllers;
use App\Models\Seller;
use Illuminate\Support\Str;
use Helper;
use Session;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display all all seller
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seller=Seller::orderBy('id','ASC')->paginate('10');
        return view('admin_panel.seller.index')->with('sellers',$seller);
    }

     /**
     * Show form for creating seller Details
     * 
     * @return \Illuminate\Http\Response
     */

     public function create()
     {
        return view('admin_panel.seller.create');
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
        'seller_name'=>'string|nullable', 
        'model_no'=>'string|nullable',  
        'email_no'=>'string|nullable',
        'serial_no'=>'numeric|nullable',               
        'imei'=>'numeric|nullable', 
        'qty'=>'numeric|required', 
        'price'=>'numeric|required',         
         
      ]);
      
      $total = $request->price * $request->qty;
      $request['total']=$total;  
       
      $data=$request->all();
      //dd($data);
      $status=Seller::create($data);
      
      if($status){
          request()->session()->flash('success',' successfully created');
      }
      else{
          request()->session()->flash('error','Error, Please try again');
      }
      return redirect()->route('seller.index');
    }

    /**
     * Show seller data
     * 
     * @param Seller $seller
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller) 
    {
        return view('sellers.show', [
            'seller' => $seller
        ]);
    }

    /**
     * Edit seller data
     * 
     * @param Seller $seller
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller) 
    {
        return view('admin_panel.seller.edit', [
            'seller' => $seller            
        ]);
        
        
    }

    /**
     * Update repair data
     * 
     * @param Seller $seller
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,$id)
    {
        $seller = Seller::findOrFail($id);
        $this->validate($request,[
         
        ]);
        $total = $request->price * $request->qty;
        $request['total']=$total;  
        //dd($request->all());
        $data=$request->all();
        $status=$seller->fill($data)->save();
        
        if($status){
            request()->session()->flash('success',' successfully Update');
        }
        else{
            request()->session()->flash('error','Error, Please try again');
        }
        return redirect()->route('seller.index');
    }

    /**
     * Delete  data
     * 
     * @param Seller $seller
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller) 
    {
        $seller->delete();

        return redirect()->route('seller.index')
            ->withSuccess(__('Data deleted successfully.'));
    }

}
