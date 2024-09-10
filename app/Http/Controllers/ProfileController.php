<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
   
    public function edit(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        
        // $profile = Profile::where('user_id',$id)->get();
        // return $user->profile->about;
        
       return view('profile.edit',compact('user'));
    }

    
    public function update(ProfileUpdateRequest $request)
    {
       
        $id = Auth::user()->id;
        $user = User::find($id);
        if($user){
            $update = $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'address' => $request->address,
                'country' => $request->country,
                'city' => $request->city,
                'company' => $request->company,
            ]);
     
            if($update){
                Toastr()->success("Profile has Been Updated Successfully");
                
                // making Logic For profile Table Update or Create Records
                $profile = Profile::where('user_id',$id)->first();
                if(empty($profile)){
                    if($request->file('image')){
                        $image = $request->image;
                        $image_ext = $image->getClientOriginalExtension();
                        $imageName = time().'.'.$image_ext;
                        $path = $image->storeAs("user_profile",$imageName,'public');

                        Profile::create([
                            'user_id' => $id,
                            'about' => $request->about,
                            'profile' => $imageName
                        ]);
                    }else{
                        Profile::create([
                            'user_id' => $id,
                            'about' => $request->about,
                        ]);
                    }

                }else{

                    // Profile Update Logic 
                    $profile = Profile::where('user_id',$id)->first();
                    if($request->file('image')){
                        
                    // Check if new image is uploaded and delete old one if it is
                     $old_path = public_path("storage/user_profile/").$profile->profile;
                     if(file_exists($old_path)){
                         unlink($old_path);
                    }

                    $image = $request->image;
                    $image_ext = $image->getClientOriginalExtension();
                    $imageName = time(). '.' . $image_ext; 

                    $path = $image->storeAs("user_profile/",$imageName,'public');
                    $profile->update([
                        'user_id' => $id,
                        'about' => $request->about,
                        'profile' => $imageName
                    ]);
                   }else{
                    $profile->update([
                        'user_id' => $id,
                        'about' => $request->about,
                    ]);

                   }
                }
            }else{
                Toastr()->error("Error Occured While Updating Profile");
            }
        }else{
            Toastr()->error("User Not Found");
        }
        
       
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}
