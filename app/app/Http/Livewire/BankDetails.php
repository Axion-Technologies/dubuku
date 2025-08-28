<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Banks;
use Illuminate\Support\Facades\Auth;


class BankDetails extends Component
{
    public $bank_id, $bank_details;

    public function mount($bank_id) 
    {
        $this->bank_id = $bank_id;
        $this->loadBankDetails();
    }

    public function loadBankDetails()
    {
        $company_id = Auth::user()->comp_id;

        $this->bank_details = Banks::select('banks.bank_name', 'banks.branch', 'banks.account_holder_name', 
                                            'banks.account_number', 'banks.ifsc_code', 'banks.account_type', 
                                            'banks.phone_number', 'banks.status', 'banks.created_at', 
                                            'users.first_name', 'users.last_name')
                              ->join('users', 'banks.user_id', '=', 'users.id')
                              ->where('banks.id', $this->bank_id)
                              ->where('banks.comp_id', $company_id)
                              ->get();
    }

    public function render()
    {
        return view('livewire.bank-details');
    }
}
