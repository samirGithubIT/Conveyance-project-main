<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $department_list = Department::departmentLists();
        $designation_list = Designation::designationList();
        return view('auth.register' , compact('department_list', 'designation_list'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'department_id' => ['required'],
            'designation_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'identity' => ['required'],
            'number' => ['required'],
            'gender' => ['required'],
            'address' => ['required'],
            'image' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        if ( $request->hasfile('image') ){
            $destination = 'files/';
            $file = $request->file('image');
            $fileName = fileUpload($file, $destination );
        }  

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'identity' => $request->identity,
            'number' => $request->number,
            'gender' => $request->gender,
            'address' => $request->address,
            'department_id' => $request->department_id,
            'designation_id' => $request->designation_id,
            'password' => Hash::make($request->password),
            'image' => $fileName
            
            
        ]);
            // for image



        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
