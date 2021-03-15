<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Role;
use App\TempMedia;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $role = Role::where('name', config('default_role_on_registration'))->get();
        if ($role->isNotEmpty())
            $user->assignRole($role->first());

        if (request()->image){
            $tempFile = TempMedia::where('folder', request()->image)->get();
            if ($tempFile->isNotEmpty()){
                $filePath = storage_path("app/temp/".$tempFile->first()->folder.'/'.$tempFile->first()->filename);
                $fileCoptyToDir = 'images/user/'.$user->id;

                if (!is_dir($fileCoptyToDir))
                    mkdir($fileCoptyToDir,0777);

                $fileCopyTo = $fileCoptyToDir.'/'.$tempFile->first()->filename;
                copy($filePath, public_path($fileCopyTo));
                $user->update(['image' => $fileCopyTo]);

                if (file_exists($filePath)) {
                    unlink($filePath);
                    rmdir(storage_path("app/temp/" . $tempFile->first()->folder));
                }

                $tempFile->first()->delete();
            }
        }

        return $user;
    }
}
