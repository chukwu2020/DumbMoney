@extends('layout.admin')

@section('content')
<div class="rounded-2xl shadow-xl border border-emerald-200 p-6 mb-6"
     style="border-top:4px solid #8bc905;">
 <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0">active server</h6>
        <ul class="flex items-center gap-[6px]">
            <li class="font-medium">
                <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-primary-600">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="font-medium">SERVERS</li>
        </ul>
    </div>
    <h3 class="text-lg font-semibold text-[#0C3A30] mb-6">
        Add New Server
    </h3>

    <form method="POST"
          action="{{ route('admin.feeds.store') }}"
          enctype="multipart/form-data">
        @csrf

        {{-- ================= SERVER PROFILE SECTION ================= --}}
        <div class="mb-8">

            <h4 class="text-sm font-bold text-[#0C3A30] mb-3 border-b pb-2">
                🖥️ Server Profile
            </h4>

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="text-xs font-semibold text-gray-600">
                        Server Name
                    </label>
                    <input type="text" name="server_name"
                        class="border rounded-lg p-2 text-sm w-full mt-1" required>
                </div>

                <div>
                    <label class="text-xs font-semibold text-gray-600">
                        Active Members
                    </label>
                    <input type="number" name="active_members"
                        class="border rounded-lg p-2 text-sm w-full mt-1" required>
                </div>

                <div>
                    <label class="text-xs font-semibold text-gray-600">
                        Copying Trades
                    </label>
                    <input type="number" name="copying_trades"
                        class="border rounded-lg p-2 text-sm w-full mt-1" required>
                </div>

                <div>
                    <label class="text-xs font-semibold text-gray-600">
                        Profit Margin (%)
                    </label>
                    <input type="number" step="0.01" name="profit_margin"
                        class="border rounded-lg p-2 text-sm w-full mt-1" required>
                </div>

                <div class="col-span-2">
                    <label class="text-xs font-semibold text-gray-600">
                        Server Profile Image
                    </label>
                    <input type="file" name="server_profile_image"
                        class="border rounded-lg p-2 text-sm w-full mt-1">
                </div>

                <!-- <div class="col-span-2">
                    <label class="text-xs font-semibold text-gray-600">
                        Server Description
                    </label>
                    <textarea name="server_description"
                        class="border rounded-lg p-2 text-sm w-full mt-1"
                        rows="3"></textarea>
                </div> -->

            </div>
        </div>


        {{-- ================= ADMIN PROFILE SECTION ================= --}}
        <div class="mb-6">

            <h4 class="text-sm font-bold text-[#0C3A30] mb-3 border-b pb-2">
                👤 Admin Profile
            </h4>

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="text-xs font-semibold text-gray-600">
                        Admin Name
                    </label>
                    <input type="text" name="admin_name"
                        class="border rounded-lg p-2 text-sm w-full mt-1" required>
                </div>

                <div class="col-span-2">
                    <label class="text-xs font-semibold text-gray-600">
                        Admin Profile Image
                    </label>
                    <input type="file" name="admin_profile_image"
                        class="border rounded-lg p-2 text-sm w-full mt-1">
                </div>

                <!-- <div class="col-span-2">
                    <label class="text-xs font-semibold text-gray-600">
                        Admin Bio
                    </label>
                    <textarea name="admin_bio"
                        class="border rounded-lg p-2 text-sm w-full mt-1"
                        rows="3"></textarea>
                </div> -->

            </div>
        </div>

        <button type="submit"
            class="bg-[#9EDD05] hover:bg-[#8bc905] text-[#0C3A30] 
                   px-6 py-2 rounded-lg font-semibold text-sm transition">
            Add Server
        </button>

    </form>




    @if($feeds->count() > 0)

<div class="rounded-2xl shadow-xl border border-gray-200 mt-6 bg-white">

    <div class="p-4 border-b flex justify-between items-center">
        <h3 class="text-sm font-semibold text-[#0C3A30]">
            Server List
        </h3>
        <span class="text-xs text-gray-500">
            {{ $feeds->count() }} Total
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">

            <thead class="bg-gray-50 text-xs uppercase text-gray-600">
                <tr>
                    <th class="px-4 py-3">Server</th>
                    <th class="px-4 py-3">Admin</th>
                    <th class="px-4 py-3">Members</th>
                    <th class="px-4 py-3">Trades</th>
                  
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($feeds as $feed)
                <tr class="border-b hover:bg-gray-50">

                    <!-- Server -->
                    <td class="px-4 py-3 flex items-center gap-3">
<div class="flex-shrink-0">
    @if($feed->server_profile_image)
        <div class="w-11 h-11 rounded-full overflow-hidden border border-gray-200 flex items-center justify-center">
            <img src="{{ asset('storage/servers/'.$feed->server_profile_image) }}"
                 class="min-w-full min-h-full object-cover object-center">
        </div>
    @else
        <div class="w-11 h-11 rounded-full flex items-center justify-center bg-[#9EDD05] text-[#0C3A30] border border-gray-200">
            <i class="fa-solid fa-user text-sm"></i>
        </div>
    @endif
</div>
                    </td>

                    <!-- Admin -->
                    <td class="px-4 py-3 flex items-center gap-2">
<div class="flex-shrink-0">
    @if($feed->server_profile_image)
        <div class="w-11 h-11 rounded-full overflow-hidden border border-gray-200 flex items-center justify-center">
            <img src="{{ asset('storage/servers/'.$feed->server_profile_image) }}"
                 class="min-w-full min-h-full object-cover object-center">
        </div>
    @else
        <div class="w-11 h-11 rounded-full flex items-center justify-center bg-[#9EDD05] text-[#0C3A30] border border-gray-200">
            <i class="fa-solid fa-user text-sm"></i>
        </div>
    @endif
</div>
                    </td>

                    <td class="px-4 py-3">
                        {{ number_format($feed->active_members) }}
                    </td>

                    <td class="px-4 py-3">
                        {{ number_format($feed->copying_trades) }}
                    </td>

                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            {{ $feed->profit_margin >= 0 
                                ? 'bg-green-100 text-green-600' 
                                : 'bg-red-100 text-red-600' }}">
                            {{ number_format($feed->profit_margin, 2) }}%
                        </span>
                    </td>

                    <!-- Actions -->
                    <td class="px-4 py-3 text-center">

                        <div class="flex justify-center gap-2">

                            <!-- Edit Button -->
                         
                            <a href="{{ route('admin.feeds.edit', $feed->id) }}"
   class="px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200">
    Edit
</a>

                            <!-- Delete -->
                            <form method="POST" 
                                  action="{{ route('admin.feeds.delete', $feed->id) }}"
                                  onsubmit="return confirm('Delete this server?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 text-xs bg-red-100 text-red-600 rounded-lg hover:bg-red-200">
                                    Delete
                                </button>
                            </form>

                        </div>

                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>
    </div>

</div>

@endif
</div>
@endsection