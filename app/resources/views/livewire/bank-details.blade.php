<div>
    @forelse($bank_details as $bank)
    <div class="row">
        <div class="col-md-6 vertical-right">
            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Bank Name :</b></div>
                <div class="col-6 col-md-8">{{ $bank->bank_name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Branch :</b></div>
                <div class="col-6 col-md-8">{{ $bank->branch }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Account Holder Name :</b></div>
                <div class="col-6 col-md-8">{{ $bank->account_holder_name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Account Number :</b></div>
                <div class="col-6 col-md-8">{{ $bank->account_number }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>IFSC Code :</b></div>
                <div class="col-6 col-md-8">{{ $bank->ifsc_code }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Account Type :</b></div>
                <div class="col-6 col-md-8">
                    @if ($bank->account_type === 2)
                        Savings
                    @else
                        Current
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                @if ($bank->phone_number)
                    <div class="col-6 col-md-4"><b>Phone Number :</b></div>
                    <div class="col-6 col-md-8">{{ $bank->phone_number}}</div>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Status :</b></div>
                <div class="col-6 col-md-8">
                    @if ($bank->status === 1)
                        Active
                    @elseif ($bank->status === 2)
                        Deleted
                    @else 
                        Inactive
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Created On :</b></div>
                <div class="col-6 col-md-8">{{ $bank->created_at}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Created By :</b></div>
                <div class="col-6 col-md-8">{{ $bank->first_name }} {{ $bank->last_name }}</div>
            </div>            
        </div>
    </div>
    @empty
    <p>Bank Details not found</p>
    @endforelse
</div>
