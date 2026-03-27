@extends('layout.admin')

@section('content')
@if(session('success'))
    <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-300 text-green-700">
        {{ session('success') }}
    </div>
@endif
<div class="rounded-2xl shadow-xl border border-emerald-200 p-6"
     style="border-top:4px solid #8bc905;">

    <h3 class="text-lg font-semibold text-[#0C3A30] mb-6">
        Edit Server
    </h3>

    <form method="POST"
          action="{{ route('admin.feeds.update', $feed->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label>Server Name</label>
                <input type="text" name="server_name"
                       value="{{ $feed->server_name }}"
                       class="border rounded-lg p-2 w-full" required>
            </div>

            <div>
                <label>Active Members</label>
                <input type="number" name="active_members"
                       value="{{ $feed->active_members }}"
                       class="border rounded-lg p-2 w-full" required>
            </div>

            <div>
                <label>Copying Trades</label>
                <input type="number" name="copying_trades"
                       value="{{ $feed->copying_trades }}"
                       class="border rounded-lg p-2 w-full" required>
            </div>
<div>
    <label>Win Rate (%)</label>
    <input type="number" step="0.01" name="win_rate"
           value="{{ $feed->win_rate }}"
           class="border rounded-lg p-2 w-full" min="0" max="100">
</div>

<div class="flex items-center gap-2 mt-4">
    <input type="checkbox" name="copy_trading_enabled" value="1"
        {{ $feed->copy_trading_enabled ? 'checked' : '' }}>
    <label>Enable Copy Trading</label>
</div>
            <div>
                <label>Profit Margin</label>
                <input type="number" step="0.01" name="profit_margin"
                       value="{{ $feed->profit_margin }}"
                       class="border rounded-lg p-2 w-full" required>
            </div>

            <div class="col-span-2">
                <label>Admin Name</label>
                <input type="text" name="admin_name"
                       value="{{ $feed->admin_name }}"
                       class="border rounded-lg p-2 w-full" required>
            </div>

            <div class="col-span-2">
                <label>Server Image</label>
                <input type="file" name="server_profile_image"
                       class="border rounded-lg p-2 w-full">
            </div>

            <div class="col-span-2">
                <label>Admin Image</label>
                <input type="file" name="admin_profile_image"
                       class="border rounded-lg p-2 w-full">
            </div>

        </div>

        <button type="submit"
            class="mt-6 bg-[#9EDD05] hover:bg-[#8bc905] px-6 py-2 rounded-lg font-semibold">
            Update Server
        </button>

    </form>

</div>

@endsection