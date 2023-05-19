<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class SettingController extends Controller
{


    public function __construct()
    {

        $this->middleware(['auth', 'verified']);
    }
    
    public function adminPanelSetting()
    {
        return view('pages.admin-panel-setting');
    }

    public function systemSetting()
    {
        return view('pages.system-setting');
    }

    public function warehouseSetting()
    {
        return view('pages.warehouse');
    }

    public function brandSetting()
    {
        return view('pages.brand');
    }

    public function currencySetting()
    {
        return view('pages.currency');
    }

    public function unitSetting()
    {
        return view('pages.unit');
    }

    public function backupSetting()
    {
        return view('pages.backup');
    }

    public function Group()
    {
        return view('pages.group');
    }

    public function createGroup()
    {
        return view('pages.create-group');
    }

    public function createModule()
    {
        return view('pages.create-module');
    }

    public function Module()
    {
        return view('pages.module');
    }

    public function User()
    {
        return view('pages.user');
    }

    public function createUser()
    {
        return view('pages.create-user');
    }

    public function userProfileSetting()
    {
        return view('pages.user-profile-setting');
    }

    public function Setting()
    {
        return view('pages.setting');
    }

    public function EmailPlaceholder()
    {
        return view('pages.email-placeholder');
    }

    public function EmailTemplate()
    {
        return view('pages.email-template');
    }

    public function createBlog()
    {
        return view('pages.create-blog');
    }

    public function editBlog()
    {
        return view('pages.edit-blog');
    }

    public function Blog()
    {
        return view('pages.blog');
    }


    public function update(Request $request)
    {


        $user = User::find(auth()->id());

        if ($request->has('profileImg')) {

            $image = $request->file('profileImg');
            $path = public_path() . '/images';
            $filename = rand(11111111, 99999999) . $image->getClientOriginalName();

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(80, 80);
            $image_resize->save(public_path('/images/' . $filename));
            $currentAvatar = auth()->user()->picture;
            $userPhoto = $path . '/' . $currentAvatar;
            if (file_exists($userPhoto)) {

                    @unlink($userPhoto);
                }
                $user->picture = $filename;
        }

        if ($request->has('logo')) {

            $image = $request->file('logo');
            $path = public_path() . '/images/';
            $filename = rand(11111111, 99999999) . $image->getClientOriginalName();

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(80, 80);
            $image_resize->save(public_path('/images/' . $filename));
            $currentAvatar = auth()->user()->logo;
            $logo = $path . '/' . $currentAvatar;
            if (file_exists($userPhoto)) {

                    @unlink($userPhoto);
                }
                $user->logo = $filename;
        }


        $user->business_email = $request->business_email??null;
        $user->business_name = $request->business_name??'Inventory System';
        $user->address = $request->address??null;
        $user->postal_code = $request->postal_code??null;
        $user->country = $request->country??'Pakistan';
        $user->business_phone = $request->business_phone??'';
        $user->invoice_template = $request->invoice_template??'view-sale';
        $user->per_page = $request->per_page??10;
        $user->custom_note_heading = $request->custom_note??'NOTICE:';
        $user->custom_note = $request->custom_note_heading??'A finance charge of 1.5% will be made on unpaid balances after 30 days.';
        $user->save();

        $request->session()->flash('success','Profile updated successfully.');
       return redirect()->route('user-profile-setting');
    }


}
