<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Resources\AdminsResource;
use Illuminate\Support\Facades\Hash;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AdminsResource::collection(Admin::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        // get image from request    
        $image = $request->file('photo');
        // save image in admins folder
        $imageName = $this->saveImage($image,'admins');

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $imageName,
            'phone' => $request->phone,
        ]);
        return new AdminsResource($admin); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        return new AdminsResource($admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        if($request->file('photo')){
            $oldImage = $admin->photo;
            // get image from request    
            $newImage = $request->file('photo');
            // save image in admins folder
            $imageName = $this->updateImage($oldImage ,$newImage,'admins');
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'photo' => $imageName,
                'phone' => $request->phone,    
            ]);
        }
        if(!$request->file('photo')){
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,  
            ]);
        }   

        return new AdminsResource($admin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response(null, 204);
    }

    public function changePassword(Admin $admin, Request $request)
    {
        $validateData = $request->validate([ 
            'old_password' => 'required',
            'password'=> 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8|same:password',
        ],
         [
            'old_password.required' => 'The current password field is required!',
            'password.confirmed' => 'Password confirmation failed!',
            'password_confirmation.same' => 'Password confirmation failed!',
        ]);

         $hashedPassword = $admin->password;
         
         if(Hash::check($request->old_password, $hashedPassword)){
             $admin->password = Hash::make($request->password);
             $admin->save();
             Auth::guard('admins')->logout();
             return response(null, 204);
        } else{
            return response("Wrong password!");
        }
    }
}
