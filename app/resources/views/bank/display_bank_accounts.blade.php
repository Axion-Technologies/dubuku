<nav aria-label="breadcrumb">
	<h2>Bank Accounts</h2>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/home">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Banks</li>
	</ol>
</nav>
<hr class="mt-4" style="color: #cbcbcb;">
<br>
@if (auth()->user()->user_role === \App\Models\Users::ROLE_ADMIN)
<p align="right"><a href="/bank/create"><button class="btn custom-btn"><i class="fa fa-plus me-2" aria-hidden="true"></i>Add Bank Account</button></a></p>
<br>
@endif

@livewire('display-banks')