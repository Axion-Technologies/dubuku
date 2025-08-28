<nav aria-label="breadcrumb">
	<h2>Bank Account Details</h2>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/home">Home</a></li>
		<li class="breadcrumb-item"><a href="/banks">Banks</a></li>
		<li class="breadcrumb-item active" aria-current="page">Bank Details</li>
	</ol>
</nav>
<hr class="mt-4" style="color: #cbcbcb;">
<br>
@livewire('bank-details', ['bank_id' => $bank_id])