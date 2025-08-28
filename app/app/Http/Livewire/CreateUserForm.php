<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class CreateUserForm extends Component
{
    public $first_name, $last_name, $email, $password, $user_role;

    public function submit() 
    {
        $this->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'email'      => 'required|email|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,5})+$/',
            'password'   => 'required|string|min:10|regex:/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{10,30})/',
            'user_role'  => 'required|in:1,2,3'
        ]);

        $first_name = $this->first_name;
        $last_name  = $this->last_name;
        $email      = $this->email;
        $user_role  = $this->user_role;
        $password   = $this->password;
        $hashed_password = Hash::make($password);

        $user_exists = Users::where('email', $email)
                       ->whereIn('status', [Users::STATUS_ACTIVE, Users::STATUS_INACTIVE])
                       ->exists();

        if ($user_exists) {
            session()->flash('error', 'User with same email already exists');
        }
        else {
            $company_id = Auth::user()->comp_id;

            $user = Users::create([
                'comp_id'    => $company_id,
                'first_name' => $first_name,
                'last_name'  => $last_name,
                'email'      => $email,
                'password'   => $hashed_password,
                'user_role'  => $user_role
            ]);

            if ($user) {
                session()->flash('success', 'User successfully created');
                $this->reset();
            }
            else {
                session()->flash('error', 'User was not created successfully. Try again');
            }
        }
    }

    public function render()
    {
        return view('livewire.create-user-form');
    }
}
