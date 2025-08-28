<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DisplayUsers extends Component
{
    public $users, $user_id, $new_password, $confirm_password;

    public function mount()
    {
        $this->loadUsers();
    }


    public function loadUsers()
    {
        $company_id = Auth::user()->comp_id;

        $this->users = Users::select('id', 'first_name', 'last_name', 'email', 'user_role')
                       ->where('status', Users::STATUS_ACTIVE)
                       ->where('comp_id', $company_id)
                       ->get();
    }


    public function changeUserPassword()
    {
        $company_id = Auth::user()->comp_id;

        $user = Users::findOrFail($this->user_id);

        $this->validate([
            'new_password'     => 'required|string|min:10|regex:/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{10,30})/',
            'confirm_password' => 'required|same:new_password',
        ]);

        $new_password     = $this->new_password;
        $confirm_password = $this->confirm_password;

        $user_detail = Users::select('password')
                        ->where('id', $this->user_id)
                        ->first();

        $current_password = $user_detail->password;

        if (Hash::check($new_password, $current_password)) {
            session()->flash('error', 'New and current password cannot be same');
            return;
        }
        
        $hashed_password = Hash::make($new_password);

        $password_updated = Users::where('id', $this->user_id)
                            ->where('comp_id', $company_id)
                            ->update(['password' => $hashed_password]);

        if ($password_updated) {         
            session()->flash('success', 'Password changed successfully.');
        }
        else {
            session()->flash('error', 'Password could not be changed. Try again ');
        }
        
        $this->reset(['new_password', 'confirm_password']);

        $this->loadUsers();
    }   


    public function clearFields()
    {   
        $this->new_password     = '';
        $this->confirm_password = '';
    }


    public function render()
    {
        return view('livewire.display-users');
    }
}
