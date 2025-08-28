<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BankStatements;
use Illuminate\Support\Facades\Auth;

class DisplayBankStatement extends Component
{
    use WithPagination;

    public $bank_id;

    // Ensure pagination state is unique per bank
    protected $paginationTheme = 'bootstrap'; // or 'tailwind' if you're using Tailwind

    public function mount($bank_id)
    {
        $this->bank_id = $bank_id;
    }

    public function updatingBankId()
    {
        // Reset to first page if bank_id changes
        $this->resetPage();
    }

    public function render()
    {
        $company_id = Auth::user()->comp_id;

        $bank_statements = BankStatements::select('id', 'txn_date', 'txn_desc', 'debit', 'credit', 'balance', 'reference_number')
            ->where('bank_id', $this->bank_id)
            ->where('company_id', $company_id)
            ->orderBy('txn_date', 'desc')
            ->paginate(50);

        return view('livewire.display-bank-statement', [
            'bank_statements' => $bank_statements,
        ]);
    }
}
