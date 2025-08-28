<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Banks;
use Illuminate\Support\Facades\Auth;


class DisplayBanks extends Component
{
    public $banks;

    public function mount()
    {
        $this->loadBanks();
    }

    public function loadBanks()
    {
        $company_id = Auth::user()->comp_id;

        $this->banks = Banks::select('id', 'bank_name', 'branch', 'account_holder_name', 
                                     'account_type', 'status')
                       ->whereIn('status', [Banks::STATUS_ACTIVE, Banks::STATUS_INACTIVE])
                       ->where('comp_id', $company_id)
                       ->orderBy('id', 'desc')
                       ->get();
    }

    public function render()
    {
        return view('livewire.display-banks');
    }
}
