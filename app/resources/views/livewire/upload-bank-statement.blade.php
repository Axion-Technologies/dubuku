<div>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <input type="file" wire:model="csv_file" accept=".csv" class="form-control mb-3">

    @error('csv_file') <span class="text-danger">{{ $message }}</span> @enderror

    @if (!empty($headers))
        <h5>Map CSV Columns to DB Columns:</h5>
        <div class="mb-3">
            @foreach ($headers as $header)
                <div class="row mb-2">
                    <div class="col-md-4">
                        <strong>{{ $header }}</strong>
                    </div>
                    <div class="col-md-8">
                        <select wire:model="selectedMapping.{{ $header }}" class="form-control">
                            <option value="">-- Skip --</option>
                            @foreach ($dbColumns as $col)
                                @php
                                    $alreadyMapped = in_array($col, array_values($selectedMapping));
                                    $currentValue = $selectedMapping[$header] ?? null;
                                @endphp

                                @if (
                                    !in_array($col, ['id', 'company_id', 'bank_id', 'created_at', 'updated_at', 'uploaded_by']) &&
                                    (!$alreadyMapped || $currentValue === $col)
                                )
                                    <option value="{{ $col }}">{{ $col }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            @endforeach
        </div>

        <h5>Preview:</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    @foreach ($headers as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($previewData as $row)
                    <tr>
                        @foreach ($row as $cell)
                            <td>{{ $cell }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button 
            wire:click="import" 
            wire:loading.attr="disabled" 
            wire:target="import"
            class="btn btn-primary">
            <span wire:loading.remove wire:target="import">Import</span>
            <span wire:loading wire:target="import">Importing...</span>
        </button>

    @endif
</div>
