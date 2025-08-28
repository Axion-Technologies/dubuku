<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;


class LoginForm extends Component
{
    public $email, $password;

    protected $rules = [
        'email'    => 'required|email|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,5})+$/',
        'password' => 'required|string|min:10|regex:/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{10,30})/'
    ];

    public function mount() 
    {
        if (Auth::check()) {
            return redirect()->to('/home');
        }
    }

    public function submit()
    {
        $this->validate();

        if (Auth::attempt([
            'email'    => $this->email,
            'password' => $this->password,
            'status'   => Users::STATUS_ACTIVE
        ]))
        {
            return redirect('/home');
        }

        session()->flash('error', 'Invalid credentials!');
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}
