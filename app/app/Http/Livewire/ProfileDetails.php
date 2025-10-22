<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileDetails extends Component
{
    public $user_details, $current_password, $new_password, $confirm_password;


    public function mount()
    {
        $this->loadUserDetails();
    }


    public function loadUserDetails()
    {
        $user_id    = Auth::id();
        $company_id = Auth::user()->comp_id;

        $this->user_details = Users::select('first_name', 'last_name', 'email', 'user_role')
                              ->where('id', $user_id)
                              ->where('comp_id', $company_id)
                              ->get();
    }


    public function changePassword()
    {
        try {
            $this->validate([
                'current_password' => 'required|string|min:10|regex:/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{10,30})/',
                'new_password'     => 'required|string|min:10|string|min:10|regex:/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{10,30})/|different:current_password',
                'confirm_password' => 'required|string|min:10|regex:/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{10,30})/|same:new_password',
            ]);
        } catch (ValidationException $error) {
            $this->loadUserDetails();
            throw $error; 
        }

        $user             = auth()->user();
        $user_id          = $user->id;
        $company_id       = $user->comp_id;
        $password         = $user->password;
        $current_password = $this->current_password;
        $new_password     = $this->new_password;

        if (!Hash::check($current_password, $password)) {
            session()->flash('error', 'Current password is incorrect.');
            $this->loadUserDetails();
            return;
        }

        $hashed_password = Hash::make($new_password);

        $updated_password = Users::where('id', $user_id)
                            ->where('comp_id', $company_id)
                            ->update(['password'=> $hashed_password]);
        
        if ($updated_password) {                     
            session()->flash('success', 'Password updated successfully.');
            $this->clearFields();
        }
        else {
            session()->flash('error', 'Password could not be updated. Try again');
            $this->loadUserDetails();
            return;
        }
    }


    public function clearFields()
    {   
        $this->current_password = '';
        $this->new_password     = '';
        $this->confirm_password = '';

        $this->resetValidation();
        $this->loadUserDetails();
    }


    public function render()
    {
        return view('livewire.profile-details');
    }
}
