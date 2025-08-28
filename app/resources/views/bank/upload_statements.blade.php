<nav aria-label="breadcrumb">
	<h2>Bank Account Statements</h2>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/home">Home</a></li>
		<li class="breadcrumb-item"><a href="/banks">Banks</a></li>
		<li class="breadcrumb-item"><a href="/bank/statements/{{ $bank_id }}">Statements</a></li>
		<li class="breadcrumb-item active" aria-current="page">Upload</li>
	</ol>
</nav>
<hr class="mt-4" style="color: #cbcbcb;">
<br>
@livewire('upload-bank-statement', ['bank_id' => $bank_id])
