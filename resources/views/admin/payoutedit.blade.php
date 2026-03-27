@extends('layout.admin')

@section('content')

<div class="container-fluid">
<div class="card">

<div class="card-header d-flex justify-content-between align-items-center">
<h3>Edit Payout #{{ $payout->id }}</h3>

<a href="{{ route('admin.payouts.index') }}" class="btn btn-secondary btn-sm">
<i class="fas fa-arrow-left"></i> Back
</a>
</div>

<form action="{{ route('admin.payouts.update',$payout) }}" method="POST">
@csrf
@method('PUT')

<div class="card-body">

@if($errors->any())
<div class="alert alert-danger">
<ul class="mb-0">
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<div class="row">

{{-- DATE --}}
<div class="col-md-4">
<input type="date" name="pay_date" class="form-control"
value="{{ old('pay_date', $payout->pay_date ? \Carbon\Carbon::parse($payout->pay_date)->format('Y-m-d') : '') }}"
required>
</div>

{{-- NAME --}}
<div class="col-md-4">
<input type="text" name="fullname" class="form-control"
value="{{ old('fullname',$payout->fullname) }}" placeholder="Full Name" required>
</div>

{{-- AMOUNT --}}
<div class="col-md-4">
<input type="text" name="amount" class="form-control"
value="{{ old('amount',$payout->amount) }}" placeholder="$ Amount" required>
</div>

{{-- PROCESSING --}}
<div class="col-md-4 mt-2">
<input type="text" name="processing_time" class="form-control"
value="{{ old('processing_time',$payout->processing_time) }}"
placeholder="Processing Time" required>
</div>

{{-- PLAN --}}
<div class="col-md-4 mt-2">
<select name="plan_id" class="form-control" required>
<option value="">Select Plan</option>
@foreach($plans as $plan)
<option value="{{ $plan->id }}"
{{ $payout->plan_id == $plan->id ? 'selected' : '' }}>
{{ $plan->name }}
</option>
@endforeach
</select>
</div>

{{-- ACCOUNT TYPE --}}
<div class="col-md-4 mt-2">
<select name="account_type" class="form-control" required>
<option value="">Account Type</option>
<option value="Crypto" {{ $payout->account_type == 'Crypto' ? 'selected' : '' }}>Crypto</option>
<option value="USDT" {{ $payout->account_type == 'USDT' ? 'selected' : '' }}>USDT</option>
<option value="Bank Transfer" {{ $payout->account_type == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
</select>
</div>

{{-- LOCATION --}}
<div class="col-md-4 mt-2">
<input type="text" name="location" class="form-control"
value="{{ old('location',$payout->location) }}"
placeholder="Location" required>
</div>

{{-- COUNTRY --}}
<div class="col-md-4 mt-2">
<input type="text" name="country" class="form-control"
value="{{ old('country',$payout->country) }}"
placeholder="Country">
</div>

{{-- FLAG --}}
<div class="col-md-4 mt-2">
<input type="text" name="flag_code" class="form-control"
value="{{ old('flag_code',$payout->flag_code) }}"
placeholder="Flag Code">
</div>

{{-- STATUS --}}
<div class="col-md-4 mt-3">
<div class="form-check form-switch">
<input type="checkbox" name="is_active" class="form-check-input"
{{ $payout->is_active ? 'checked' : '' }}>
<label class="form-check-label">Active</label>
</div>
</div>

</div>

</div>

<div class="card-footer">
<button type="submit" class="btn btn-primary">
<i class="fas fa-save"></i> Update Payout
</button>
</div>

</form>

</div>
</div>

@endsection