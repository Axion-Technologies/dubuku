<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Banks;
use Illuminate\Support\Facades\Auth;


class CreateBankForm extends Component
{
    public $bank_name, $branch, $account_holder_name, $account_number, $ifsc_code, $account_type, $phone_number;

    public function submit()
    {
        $this->validate([
            'bank_name'           => 'required|string',
            'branch'              => 'required|string',
            'account_holder_name' => 'required|string',
            'account_number'      => 'required|string',
            'ifsc_code'           => 'required|string',
            'account_type'        => 'required|in:1,2',
            'phone_number'        => 'nullable|regex:/^[0-9]{10}$/'
        ]);

        $user_id             = Auth::id();
        $bank_name           = $this->bank_name;
        $branch              = $this->branch;
        $account_holder_name = $this->account_holder_name;
        $account_number      = $this->account_number;
        $ifsc_code           = $this->ifsc_code;
        $account_type        = $this->account_type;
        $phone_number        = $this->phone_number;

        $company_id = Auth::user()->comp_id;

        $bank = Banks::create([
            'comp_id'             => $company_id,
            'user_id'             => $user_id,
            'bank_name'           => $bank_name,
            'branch'              => $branch,
            'account_holder_name' => $account_holder_name,
            'account_number'      => $account_number,
            'ifsc_code'           => $ifsc_code,
            'account_type'        => $account_type,
            'phone_number'        => $phone_number
        ]);

        if ($bank) {
            session()->flash('success', 'Bank account added successfully');
            $this->reset();
        }
        else {
            session()->flash('error', 'Bank account was not added successfully');
        }
    }

    public function render()
    {
        return view('livewire.create-bank-form');
    }
}
