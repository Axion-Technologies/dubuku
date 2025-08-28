<div>
    <div class="row">
        <div class="col-md-10" style="max-height: 80vh; overflow-y: auto;">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Reference</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bank_statements as $index => $statement)
                        <tr>
                            <td>{{ ($bank_statements->currentPage() - 1) * $bank_statements->perPage() + $index + 1 }}</td>
                            <td>{{ $statement->txn_date }}</td>
                            <td>{{ $statement->txn_desc }}</td>
                            <td>{{ $statement->reference_number }}</td>
                            <td>{{ $statement->debit }}</td>
                            <td>{{ $statement->credit }}</td>
                            <td>{{ $statement->balance }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">No statements found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $bank_statements->links() }}
            </div>
        </div>
        <div class="col-md-2">
            <h3>Filters</h3>
            Filter options will come here, from to date filter, like csv download, pdf download, excel download etc.
        </div>
    </div>
</div>
