<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Defect;
use App\Models\Device;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as APIRequest;
class DefectController extends Controller
{
    public function index(){
        $defects = Defect::all();
        return view('Dashboard.pages.defects.index' , compact('defects'));
    }

    public function syncApi(){
        
        $key = 'gcNDIsZ-lYYx-2qGd-uqQq-97dyUCgrK';

        $client = new Client();
        $headers = [
            'Cookie' => '_csrf=5f425a49a77749f067e26c24a6b16e236b54673c42e1c6623d23539ac8157a16a%3A2%3A%7Bi%3A0%3Bs%3A5%3A%22_csrf%22%3Bi%3A1%3Bs%3A32%3A%229ZRHaaTc8mmGf1hB5_IGh4RV897wvkrq%22%3B%7D'
        ];
        $request = new APIRequest('GET', 'https://api.repairdesk.co/api/web/v1/problems?api_key='.$key, $headers);
        $response = $client->sendAsync($request)->wait();

        $response_decode = json_decode($response->getBody() , true);

        $data = $response_decode['data'];
        foreach($data as $value){
            $device_name = $value['device_name'];
            $devices = Device::where('device_name' ,  $device_name)->pluck('id')->first();
            if($devices){
                $sync = Defect::updateOrCreate(
                    ['device_id' => $devices, 'defect_name' => $value['name']],
                    [
                        'original_price' => round($value['original_price'], 2),
                        'defect_precentage' => $value['tax_class']['tax_percent'],
                    ]
                );
            }
        }

        if($sync){
            return response()->json([
                'status' => 200,
                'message' => 'Defects API Sync successfully'
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
            'defect_name' =>'required',
        ]);
        $update = Defect::find($request->id)->update($request->all());
        if($update){
            return redirect()->back()->with('success', 'Defect has been updated successfully');
        }else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function destroy(Request $request){
        if($request->id){
            $delete = Defect::find($request->id)->delete();
            return redirect()->back()->with('success', 'Defect has been deleted successfully');
        }else{
            return redirect()->back()->with('error', 'Something went wrong'); 
        }
    }

    public function HitDefectAPi(){
        Defect::truncate();
        $key = 'gcNDIsZ-lYYx-2qGd-uqQq-97dyUCgrK';

        $client = new Client();
        $headers = [
            'Cookie' => '_csrf=5f425a49a77749f067e26c24a6b16e236b54673c42e1c6623d23539ac8157a16a%3A2%3A%7Bi%3A0%3Bs%3A5%3A%22_csrf%22%3Bi%3A1%3Bs%3A32%3A%229ZRHaaTc8mmGf1hB5_IGh4RV897wvkrq%22%3B%7D'
        ];
        $request = new APIRequest('GET', 'https://api.repairdesk.co/api/web/v1/problems?api_key='.$key, $headers);
        $response = $client->sendAsync($request)->wait();

        $response_decode = json_decode($response->getBody() , true);

        $data = $response_decode['data'];
        foreach($data as $value){
            $device_name = $value['device_name'];
            $devices = Device::where('device_name' ,  $device_name)->pluck('id')->first();
            if($devices){
                $store = Defect::create([
                    'device_id' => $devices,
                    'defect_name' => $value['name'],
                    'original_price' => round($value['original_price'] , 2),
                    'defect_precentage' => $value['tax_class']['tax_percent'],
                ]);
            }
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
