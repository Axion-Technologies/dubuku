<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Companies;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class SignupForm extends Component
{
    public $first_name, $last_name, $comp_name, $email;

    protected $rules = [
        'first_name' => 'required|string',
        'last_name'  => 'required|string',
        'comp_name'  => 'required|string',
        'email'      => 'required|email|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,5})+$/|unique:companies,email'
    ];

    public function mount() 
    {

    }

    public function submit()
    {
        $this->validate();

        $first_name = $this->first_name;
        $last_name  = $this->last_name;
        $comp_name  = $this->comp_name;
        $email      = $this->email;

        $comp_data = [
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'comp_name'  => $comp_name,
            'email'      => $email
        ];

        $create_company = Companies::create($comp_data);

        if ($create_company) {

            $company_id       = $create_company->id;
            $default_password = env('DEFAULT_PASSWORD');
            $hashed_password  = Hash::make($default_password);

            $user_data = [
                'comp_id'    => $company_id,
                'first_name' => $first_name,
                'last_name'  => $last_name,
                'email'      => $email,
                'password'   => $hashed_password,
                'user_role'  => Users::ROLE_ADMIN
            ];

            $create_first_user = Users::create($user_data);

            if ($create_first_user) {
                session()->flash('success', 'Signup successful. Please login with the default password.');
                $this->reset();
            }
            else {
                Companies::where('id', $company_id)->delete();

                session()->flash('error', 'Failed to signup. Try again later!');
            }
        }
        else {
            session()->flash('error', 'Failed to signup. Try again later');
        }
    }

    public function render()
    {
        return view('livewire.signup-form');
    }
}
