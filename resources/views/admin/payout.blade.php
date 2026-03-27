@extends('layout.admin')

@section('content')

<div class="container-fluid">

<div class="card">

<div class="card-header d-flex justify-content-between align-items-center">
<h3>Payouts Management</h3>

<a href="{{ route('admin.payouts.create') }}" class="btn btn-primary btn-sm">
<i class="fas fa-plus"></i> Add New Payout
</a>

</div>

<div class="card-body">

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif


{{-- QUICK ADD FORM --}}
<form action="{{ route('admin.payouts.store') }}" method="POST">
@csrf

<div class="row mb-4">

<div class="col-md-2">
<input type="date" name="pay_date" class="form-control" required>
</div>

<div class="col-md-2">
<input type="text" name="fullname" class="form-control" placeholder="Full Name" required>
</div>

<div class="col-md-2">
<input type="text" name="amount" class="form-control" placeholder="$ Amount" required>
</div>

<div class="col-md-2">
<input type="text" name="processing_time" class="form-control" placeholder="Processing Time" required>
</div>

{{-- PLAN DROPDOWN --}}
<div class="col-md-2">
<select name="plan_id" class="form-control" required>
<option value="">Select Plan</option>

@foreach($plans as $plan)
<option value="{{ $plan->id }}">
{{ $plan->name }}
</option>
@endforeach

</select>
</div>

{{-- ACCOUNT TYPE --}}
<div class="col-md-2">
<select name="account_type" class="form-control" required>
<option value="">Account Type</option>
<option value="Crypto">Crypto</option>
<option value="USDT">USDT</option>
<option value="Bank Transfer">Bank Transfer</option>
</select>
</div>

<div class="col-md-2 mt-2">
<input type="text" name="location" class="form-control" placeholder="Location" required>
</div>

<div class="col-md-12 mt-2">
<button class="btn btn-success">
Add Payout
</button>
</div>

</div>

</form>



<table class="table table-bordered table-striped">

<thead>
<tr>
<th>ID</th>
<th>Date</th>
<th>Name</th>
<th>Amount</th>
<th>Processing</th>
<th>Plan</th>
<th>Location</th>
<th>Status</th>
<th width="150">Actions</th>
</tr>
</thead>

<tbody>

@forelse($payouts as $payout)

<tr>

<td>{{ $payout->id }}</td>

<td>{{ $payout->formatted_date }}</td>

<td>{{ $payout->formatted_name }}</td>

<td>{{ $payout->amount }}</td>

<td>{{ $payout->processing_time }}</td>

<td>{{ $payout->plan->name ?? '-' }}</td>

<td>{{ $payout->location }}</td>

<td>

@if($payout->is_active)
<span class="badge bg-success">Active</span>
@else
<span class="badge bg-secondary">Inactive</span>
@endif

</td>

<td>

<a href="{{ route('admin.payouts.edit',$payout) }}"
class="btn btn-info btn-sm">
Edit
</a>

<form action="{{ route('admin.payouts.destroy',$payout) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Delete payout?')">
Delete
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="9" class="text-center">
No payouts found
</td>
</tr>

@endforelse

</tbody>

</table>


<div class="mt-3">
{{ $payouts->links() }}
</div>

</div>

</div>

</div>

@endsection