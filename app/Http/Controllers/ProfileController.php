<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Symfony\Component\Intl\Languages;
use Symfony\Component\Intl\Countries;


class ProfileController extends Controller
{


    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        $user = Auth::user();
        return view('profile.edit', [
            'user' => $user,
            'countries' => Countries::getNames('ar'),
            'locales' => Languages::getNames('ar'),

        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
       
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday'=>['nullable','date', 'before:today'],
            'gender'=>['in:male,female'],
            'street_address'=>['required', 'string'],
            'city'=>['required', 'string'],
            'state'=>['required', 'string'],
            'postal_code'=>['required', 'string'],
            'country'=>['required', 'string', 'size:2'],
            'locale'=>['required', 'string', 'size:2'],
        ]);

       
        $user = $request->user();
       
        $profile = $user->profile;
       
        // if($profile->user_id){
        //     $profile->update($request->all());
        // }else{
        //     // $request->merge([
        //     //     'user_id'=> $user->id,
        //     // ]);
        //     // Profile::create($request->all());
        //     /////////////////// another way///
        //     $user->profile()->create($request->all());
        // }

          /////////////////// another way///
        $user->profile->fill($request->all())->save();
           
        return redirect()->route('/')->with('success','profile updated successfully');

    }



    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {

        
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
