<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repair;
use Illuminate\Support\Str;
use Helper;
use Session;


class RepairController extends Controller
{
    /**
     * Display all all repair product
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repair=Repair::orderBy('id','ASC')->paginate('10');
        return view('admin_panel.repair.index')->with('repairs',$repair);
    }

    /**
     * Show form for creating repair product
     * 
     * @return \Illuminate\Http\Response
     */

     public function create()
     {
         return view('admin_panel.repair.create');
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
         
      ]);
      //dd($request->all());
      $data=$request->all();
      //dd($data);
      $status=Repair::create($data);
      
      if($status){
          request()->session()->flash('success',' successfully created');
      }
      else{
          request()->session()->flash('error','Error, Please try again');
      }
      return redirect()->route('admin_panel.repair.index');
    }

    /**
     * Show repar data data
     * 
     * @param Repair $repair
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Repair $repair) 
    {
        return view('repairs.show', [
            'repair' => $repair
        ]);
    }

    /**
     * Edit repair data
     * 
     * @param Repair $repair
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Repair $repair) 
    {
        return view('admin_panel.repair.edit', [
            'repair' => $repair            
        ]);
        
        
    }

    /**
     * Update repair data
     * 
     * @param Repair $repair
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,$id)
    {
        $repair = Repair::findOrFail($id);
        $this->validate($request,[
         
        ]);
        $data=$request->all();
        $status=$repair->fill($data)->save();
        
        if($status){
            request()->session()->flash('success',' successfully Update');
        }
        else{
            request()->session()->flash('error','Error, Please try again');
        }
        return redirect()->route('repairs.index');
    }
  
    /**
     * Delete  data
     * 
     * @param Repair $repair
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repair $repair) 
    {
        $repair->delete();

        return redirect()->route('repairs.index')
            ->withSuccess(__('Data deleted successfully.'));
    }


     /**
     * Show form for user creating repair product
     * 
     * @return \Illuminate\Http\Response
     */

     public function repair_create()
     {
         return view('frontend.pages.repair');
     }
    /**
   * User Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
    public function repair_store(Request $request)
    {
      $this->validate($request,[
         
      ]);
      //dd($request->all());
      $data=$request->all();
      //dd($data);
      $status=Repair::create($data);
      
      if($status){
          request()->session()->flash('success',' successfully inserted');
      }
      else{
          request()->session()->flash('error','Error, Please try again');
      }
      return redirect()->route('home');
    }


}
