<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Defect;
use App\Models\Device;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $authId = Auth::user()->id;
        $userData = UserProfile::where('user_id', $authId)->first();
        $totalBrands = Brand::where('status' , 'active')->count();
        $Brands = Brand::all();
        $Devices = Device::all();
        $Defects = Defect::all();
        $User = User::all();
        $totalDevices = count($Devices);
        $totalDefects = count($Defects);
        $totalUser = count($User);

        return view('Dashboard.pages.index' , compact('Brands' ,'Devices' , 'Defects' ,'userData' ,'totalBrands' , 'totalDevices' , 'totalDefects' , 'totalUser' ));
    }
}
