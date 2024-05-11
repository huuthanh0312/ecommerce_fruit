<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SiteSettingController extends Controller
{
    // SiteSetting Methods
    public function ShowSiteSetting(){
        $site_setting = SiteSetting::findOrNew(1);
        return view('backend.site_setting.show_site_setting', compact('site_setting'));
    }//end methods

      // Add Data SiteSetting 
    public function UpdateSiteSetting(Request $request){ 
    
        SiteSetting:: insert([
            'phone'=> $request->phone,
            'email'=> $request->email,
            'address'=> $request->address,
            'short_desc'=> $request->short_desc,
            'facebook'=> $request->facebook,
            'youtube'=> $request->youtube,
            'instagram'=> $request->instagram,
            'copyright'=> $request->copyright,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message'=> ' SiteSetting Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//end methods
}