<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();
        return view('dashboard.pages.brand.index' , compact('brands'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:brands,name'
        ]);

        $store = Brand::create([
            'name' => $request->name,
            'status' => 'active'
        ]);

        if($store){
            return redirect()->back()->with('success', 'Brand has been added successfully');
        }else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function update(Request $request){
        $request->validate([
            'id' => 'required',
            'name' =>'required',
        ]);

        $update = Brand::find($request->id)->update($request->all());
        if($update){
            return redirect()->back()->with('success', 'Brand has been updated successfully');
        }else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function destroy(Request $request){
        if($request->id){
            $delete = Brand::find($request->id)->delete();
            return redirect()->back()->with('success', 'Brand has been deleted successfully');
        }else{
            return redirect()->back()->with('error', 'Something went wrong'); 
        }
    }
}