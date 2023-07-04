<?php

namespace App\Http\Controllers;
use App\Models\buying;
use Illuminate\Support\Str;
use Helper;
use Session;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    /**
     * Display all all buying
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buying=buying::orderBy('id','ASC')->paginate('10');
        return view('admin_panel.buying.index')->with('buyings',$buying);
    }

     /**
     * Show form for creating buying Details
     * 
     * @return \Illuminate\Http\Response
     */

     public function create()
     {
        return view('admin_panel.buying.create');
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
        'buying_name'=>'string|nullable', 
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
      $status=buying::create($data);
      
      if($status){
          request()->session()->flash('success',' successfully created');
      }
      else{
          request()->session()->flash('error','Error, Please try again');
      }
      return redirect()->route('buying.index');
    }

    /**
     * Show buying data
     * 
     * @param buying $buying
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(buying $buying) 
    {
        return view('buyings.show', [
            'buying' => $buying
        ]);
    }

    /**
     * Edit buying data
     * 
     * @param buying $buying
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(buying $buying) 
    {
        return view('admin_panel.buying.edit', [
            'buying' => $buying            
        ]);
        
        
    }

    /**
     * Update repair data
     * 
     * @param buying $buying
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,$id)
    {
        $buying = buying::findOrFail($id);
        $this->validate($request,[
         
        ]);
        $total = $request->price * $request->qty;
        $request['total']=$total;  
        //dd($request->all());
        $data=$request->all();
        $status=$buying->fill($data)->save();
        
        if($status){
            request()->session()->flash('success',' successfully Update');
        }
        else{
            request()->session()->flash('error','Error, Please try again');
        }
        return redirect()->route('buying.index');
    }

    /**
     * Delete  data
     * 
     * @param buying $buying
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(buying $buying) 
    {
        $buying->delete();

        return redirect()->route('buying.index')
            ->withSuccess(__('Data deleted successfully.'));
    }

}
