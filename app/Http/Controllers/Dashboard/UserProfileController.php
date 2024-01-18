<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(){
        $profileData = UserProfile::where('user_id',auth()->user()->id)->first();
        return view('dashboard.pages.profile.index' , compact('profileData'));
    }

    public function store(Request $request){
        $request->validate([
            'cnic' =>'required|unique:user_profiles,cnic',
            'job_title' =>'required',
            'dob' =>'required',
            'phone' =>'required',
            'image' => 'required',
            'gender' =>'required',
            'skill' =>'required',
            'about' =>'required',
            'address' =>'required'
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName = rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/'), $fileName);
        }else{
            $fileName = "dummy.png";
        }

        $store = UserProfile::create([
            'user_id' => auth()->user()->id,
            'job_title' => $request->job_title,
            'dob' => $request->dob,
            'cnic' => $request->cnic,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'image' => $fileName,
            'skill' => $request->skill,
            'about' => $request->about,
            'address' => $request->address
        ]);

        if($store){
            return redirect()->route('user.profile')->with('success', '{{__("trans.add_profile_success")}}');
        }else{
            return redirect()->back()->with('fail', trans("trans.error"));
        }
        
    }

    public function update(Request $request){
        $request->validate([
            'cnic' =>'required|unique:user_profiles,cnic,'.$request->user_id,
            'job_title' =>'required',
            'dob' =>'required',
            'phone' =>'required',
            'gender' =>'required',
            'skill' =>'required',
            'about' =>'required',
            'address' =>'required'
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName = rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/'), $fileName);

            $update = UserProfile::where('id',$request->user_id)->update([
                'job_title' => $request->job_title,
                'dob' => $request->dob,
                'cnic' => $request->cnic,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'image' => $fileName,
                'skill' => $request->skill,
                'about' => $request->about,
                'address' => $request->address
            ]);
        }else{
            $update = UserProfile::where('id',$request->user_id)->update([
                'job_title' => $request->job_title,
                'dob' => $request->dob,
                'cnic' => $request->cnic,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'skill' => $request->skill,
                'about' => $request->about,
                'address' => $request->address
            ]);
        }

        if($update){
            return redirect()->route('user.profile')->with('success', '{{__("trans.update_profile")}}');
        }else{
            return redirect()->back()->with('fail', trans("trans.error"));
        }
    }
}
