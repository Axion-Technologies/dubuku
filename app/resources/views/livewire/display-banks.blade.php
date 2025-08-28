<div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Bank Name</th>
                    <th>Branch</th>
                    <th>Account Holder Name</th>
                    <th>Account Type</th>
                    <th>Status</th>
                    <th>A/C Statments</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banks as $index => $bank)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    @if (auth()->user()->user_role === \App\Models\Users::ROLE_ADMIN)
                    <td><a href="/bank/details/{{ $bank->id }}">{{ $bank->bank_name }}</a></td>
                    @else
                    <td>{{ $bank->bank_name }}</td>
                    @endif

                    <td>{{ $bank->branch }}</td>
                    <td>{{ $bank->account_holder_name }}</td>
                    <td>
                        @if ($bank->account_type === 2)
                            Savings
                        @else
                            Current
                        @endif
                    </td>
                    <td>
                        @if ($bank->status === 1)
                            Active
                        @else
                            Inactive
                        @endif
                    </td>
                    <td><a href="/bank/statements/{{ $bank->id }}" class="logo">View Statments &nbsp<i class="fa-regular fa-file-lines"></i></a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">No bank accounts linked.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
