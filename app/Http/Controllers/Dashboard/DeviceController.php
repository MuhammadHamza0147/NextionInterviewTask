<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Device;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request as APIRequest;

class DeviceController extends Controller
{
    public function index(){
        $devices = Device::all();
        return view('dashboard.pages.devices.index' , compact('devices'));
    }

    public function syncApi(){
        
        $key = 'gcNDIsZ-lYYx-2qGd-uqQq-97dyUCgrK';

        $client = new Client();
        $headers = [
            'Cookie' => '_csrf=5f425a49a77749f067e26c24a6b16e236b54673c42e1c6623d23539ac8157a16a%3A2%3A%7Bi%3A0%3Bs%3A5%3A%22_csrf%22%3Bi%3A1%3Bs%3A32%3A%229ZRHaaTc8mmGf1hB5_IGh4RV897wvkrq%22%3B%7D'
        ];
        $request = new APIRequest('GET', 'https://api.repairdesk.co/api/web/v1/devices?api_key='.$key, $headers);
        $response = $client->sendAsync($request)->wait();

        $response_decode = json_decode($response->getBody() , true);

        $data = $response_decode['data'];
        foreach($data as $value){
            $company = $value['company'];
            $brand_id = Brand::where('name' , $company)->pluck('id')->first();
            $sync = Device::updateOrCreate(
                ['brand_id' => $brand_id],
                ['device_name' => $value['name']]
            );
        }

        if($sync){
            return response()->json([
                'status' => 200,
                'message' => 'Device API Sync successfully'
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Some error occurred while syncing device'
            ]);
        }
    }


    public function update(Request $request){
        $request->validate([
            'id' => 'required',
            'device_name' =>'required',
        ]);
        $update = Device::find($request->id)->update($request->all());
        if($update){
            return redirect()->back()->with('success', 'Device has been updated successfully');
        }else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function destroy(Request $request){
        if($request->id){
            $delete = Device::find($request->id)->delete();
            return redirect()->back()->with('success', 'Device has been deleted successfully');
        }else{
            return redirect()->back()->with('error', 'Something went wrong'); 
        }
    }

    public function HitDeviceAPi(){
        Device::truncate();
        $key = 'gcNDIsZ-lYYx-2qGd-uqQq-97dyUCgrK';

        $client = new Client();
        $headers = [
            'Cookie' => '_csrf=5f425a49a77749f067e26c24a6b16e236b54673c42e1c6623d23539ac8157a16a%3A2%3A%7Bi%3A0%3Bs%3A5%3A%22_csrf%22%3Bi%3A1%3Bs%3A32%3A%229ZRHaaTc8mmGf1hB5_IGh4RV897wvkrq%22%3B%7D'
        ];
        $request = new APIRequest('GET', 'https://api.repairdesk.co/api/web/v1/devices?api_key='.$key, $headers);
        $response = $client->sendAsync($request)->wait();

        $response_decode = json_decode($response->getBody() , true);

        $data = $response_decode['data'];
        foreach($data as $value){
            $company = $value['company'];
            $brand_id = Brand::where('name' , $company)->pluck('id')->first();
            $store = Device::create([
                'brand_id' => $brand_id,
                'device_name' => $value['name']
            ]);
        }
        if($store){
            return response()->json([
               'status' => 200,
               'message' => 'Defects API Sync successfully'
            ]);
        }else{
            return response()->json([
              'status' => 400,
              'message' => 'Some error occurred while syncing defects'
            ]);
        }
    }
 
}
