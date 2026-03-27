@extends('layout.user')

@section('content')
<div class="min-h-screen bg-cover bg-center bg-no-repeat px-4 py-10"
     style="background-image: url(assets/images/hero/hero-image-1.svg);">

    <div class="container mx-auto">

        {{-- Breadcrumb --}}
        <div class="flex  items-center justify-between gap-2 mb-6">
            <h5 class="font-semibold text-lg mb-0" style="color: #0C3A30;">Withdrawn Investments</h5>
            <ul class="flex items-center gap-[4px] text-sm font-medium" style="color:#0C3A30;">
                <li>
                    <a href="{{ route('user_dashboard') }}"
                       class="flex items-center gap-1.5 transition-colors"
                       onmouseover="this.style.color='#9EDD05';"
                       onmouseout="this.style.color='#0C3A30';">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="text-lg"></iconify-icon>
                        Dashboard
                    </a>
                </li>
                <li class="text-gray-400">-</li>
                <li style="color:#9EDD05;">Withdrawn</li>
            </ul>
        </div>

        {{-- Back link --}}
        <div class="mb-6 flex justify-end">
            <a href="{{ route('user.investments') }}"
               class="inline-flex items-center gap-1.5 text-sm font-medium hover:underline transition"
               style="color: #0C3A30;">
                <iconify-icon icon="solar:arrow-left-linear" class="text-lg"></iconify-icon>
                Return Back
            </a>
        </div>

        @if($withdrawnInvestments->isEmpty())
        {{-- Empty state --}}
        <div class="text-center py-16 rounded-2xl border border-white/60 shadow"
             style="background: rgba(255,255,255,0.88); backdrop-filter: blur(4px);">
            <div class="w-20 h-20 mx-auto mb-4 rounded-full flex items-center justify-center"
                 style="background: linear-gradient(135deg, #f0fde4, #e4f7cc);">
                <iconify-icon icon="ph:archive-fill" style="font-size:40px; color:#8AC304;"></iconify-icon>
            </div>
            <p class="text-gray-600 font-semibold text-lg mb-1">No Withdrawn Investments</p>
            <p class="text-gray-400 text-sm">You haven't withdrawn any investments yet.</p>
        </div>

        @else

        <div class="space-y-6">
            @foreach($withdrawnInvestments as $investment)
            @php
                $plan = $investment->plan;
                $totalProfit         = ($investment->amount_invested * $plan->interest_rate) / 100;
                $alreadyTakenProfit  = $investment->withdrawals()->where('type', 'profit')->sum('amount');
                $remainingProfit     = max($totalProfit - $alreadyTakenProfit, 0);
                $grossReturn         = $investment->amount_invested + $remainingProfit;
                $managementFee       = floatval($investment->management_fee_deducted  ?? 0);
                $performanceFee      = floatval($investment->performance_fee_deducted ?? 0);
                $totalFees           = $managementFee + $performanceFee;
                $netCredited         = round($grossReturn - $totalFees, 2);
                $withdrawnAt         = $investment->withdrawn_at
                                        ? \Carbon\Carbon::parse($investment->withdrawn_at)
                                        : $investment->updated_at;
            @endphp

            {{-- Investment card --}}
            <div class="relative rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">

                {{-- Background + overlay --}}
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                     style="background-image: url(assets/images/hero/hero-image-1.svg);"></div>
                <div class="absolute inset-0 bg-white/88 backdrop-blur-[2px]"></div>

                {{-- Content --}}
                <div class="relative z-10">

                    {{-- Card top bar --}}
                    <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200/60"
                         style="border-top: 4px solid #9EDD05;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-sm"
                                 style="background: linear-gradient(135deg, #f0fde4, #d9f5a0);">
                                <iconify-icon icon="ph:chart-pie-bold" style="font-size:18px; color:#5a8a00;"></iconify-icon>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-medium leading-tight">Investment Plan</p>
                                <h3 class="text-base font-bold leading-tight" style="color: #0C3A30;">
                                    {{ $plan->name ?? 'N/A' }}
                                </h3>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-500 shadow-sm">
                                <iconify-icon icon="ph:calendar-fill" style="font-size:12px;"></iconify-icon>
                                {{ $withdrawnAt->format('d M, Y') }}
                            </span>
                        </div>
                    </div>

                    {{-- Table content --}}
                    <div class="px-6 py-5">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm border-collapse">
                                <tbody>

                                    {{-- Capital --}}
                                    <tr class="border-b border-gray-100/80">
                                        <th class="py-3 text-left font-medium w-1/2" style="color:#6b7280;">
                                            <span class="flex items-center gap-1.5">
                                                <iconify-icon icon="ph:coins-fill" style="font-size:13px; color:#8AC304;"></iconify-icon>
                                                Amount Invested
                                            </span>
                                        </th>
                                        <td class="py-3 font-semibold text-right" style="color:#0C3A30;">
                                            ${{ number_format($investment->amount_invested, 2) }}
                                        </td>
                                    </tr>

                                    {{-- Interest rate --}}
                                    <tr class="border-b border-gray-100/80">
                                        <th class="py-3 text-left font-medium" style="color:#6b7280;">
                                            <span class="flex items-center gap-1.5">
                                                <iconify-icon icon="ph:percent-fill" style="font-size:13px; color:#8AC304;"></iconify-icon>
                                                Interest Rate
                                            </span>
                                        </th>
                                        <td class="py-3 font-semibold text-right" style="color:#0C3A30;">
                                            {{ $plan->interest_rate }}%
                                        </td>
                                    </tr>

                                    {{-- Total profit --}}
                                    <tr class="border-b border-gray-100/80">
                                        <th class="py-3 text-left font-medium" style="color:#6b7280;">
                                            <span class="flex items-center gap-1.5">
                                                <iconify-icon icon="ph:trend-up-fill" style="font-size:13px; color:#16a34a;"></iconify-icon>
                                                Total Profit
                                            </span>
                                        </th>
                                        <td class="py-3 font-semibold text-right text-green-600">
                                            ${{ number_format($totalProfit, 2) }}
                                        </td>
                                    </tr>

                                    {{-- Profit already taken mid-investment --}}
                                    @if($alreadyTakenProfit > 0)
                                    <tr class="border-b border-gray-100/80">
                                        <th class="py-3 text-left font-medium" style="color:#6b7280;">
                                            <span class="flex items-center gap-1.5">
                                                <iconify-icon icon="ph:clock-counter-clockwise-fill" style="font-size:13px; color:#d97706;"></iconify-icon>
                                                Profit Taken Early
                                            </span>
                                        </th>
                                        <td class="py-3 font-semibold text-right text-amber-600">
                                            -${{ number_format($alreadyTakenProfit, 2) }}
                                        </td>
                                    </tr>
                                    @endif

                                    {{-- Gross return --}}
                                    <tr class="border-b border-gray-100/80">
                                        <th class="py-3 text-left font-medium" style="color:#6b7280;">
                                            <span class="flex items-center gap-1.5">
                                                <iconify-icon icon="ph:arrow-up-right-fill" style="font-size:13px; color:#0C3A30;"></iconify-icon>
                                                Gross Return
                                            </span>
                                        </th>
                                        <td class="py-3 font-semibold text-right" style="color:#0C3A30;">
                                            ${{ number_format($grossReturn, 2) }}
                                        </td>
                                    </tr>

                                    {{-- Fee breakdown --}}
                                    @if($totalFees > 0)
                                    <tr>
                                        <td colspan="2" class="pt-4 pb-2">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Platform Fees</span>
                                                <div class="flex-1 border-t border-dashed border-gray-200"></div>
                                            </div>
                                        </td>
                                    </tr>

                                    @if($managementFee > 0)
                                    <tr class="border-b border-gray-100/80">
                                        <th class="py-2.5 text-left font-medium text-sm" style="color:#6b7280;">
                                            <span class="flex items-center gap-1.5">
                                                <iconify-icon icon="ph:percent-fill" style="font-size:12px; color:#ef4444;"></iconify-icon>
                                                Management Fee
                                                @if($plan->management_fee)
                                                <span class="text-xs text-gray-400">({{ $plan->management_fee }}%)</span>
                                                @endif
                                            </span>
                                        </th>
                                        <td class="py-2.5 font-semibold text-right text-red-500">
                                            -${{ number_format($managementFee, 2) }}
                                        </td>
                                    </tr>
                                    @endif

                                    @if($performanceFee > 0)
                                    <tr class="border-b border-gray-100/80">
                                        <th class="py-2.5 text-left font-medium text-sm" style="color:#6b7280;">
                                            <span class="flex items-center gap-1.5">
                                                <iconify-icon icon="ph:chart-line-up-fill" style="font-size:12px; color:#ef4444;"></iconify-icon>
                                                Performance Fee
                                                @if($plan->performance_fee)
                                                <span class="text-xs text-gray-400">({{ $plan->performance_fee }}%)</span>
                                                @endif
                                            </span>
                                        </th>
                                        <td class="py-2.5 font-semibold text-right text-red-500">
                                            -${{ number_format($performanceFee, 2) }}
                                        </td>
                                    </tr>
                                    @endif

                                    <tr class="border-b border-gray-100/80">
                                        <th class="py-2.5 text-left font-bold text-sm" style="color:#6b7280;">Total Fees</th>
                                        <td class="py-2.5 font-bold text-right text-red-600">
                                            -${{ number_format($totalFees, 2) }}
                                        </td>
                                    </tr>
                                    @endif

                                    {{-- Net credited --}}
                                    <tr>
                                        <td colspan="2" class="pt-4 pb-1">
                                            <div class="flex items-center justify-between px-4 py-3.5 rounded-xl shadow-sm"
                                                 style="background: linear-gradient(135deg, #75fc27, #1a5c46);">
                                                <span class="font-bold text-sm flex items-center gap-2 text-white">
                                                    <iconify-icon icon="ph:check-circle-fill" style="font-size:16px; color:#9EDD05;"></iconify-icon>
                                                    Credited to Balance
                                                </span>
                                                <span class="font-bold text-lg font-mono text-white" style="color: #75fc27 !important;">
                                                    ${{ number_format($netCredited, 2) }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Withdrawal date --}}
                                    <tr>
                                        <th class="pt-4 pb-1 text-left font-medium text-sm" style="color:#6b7280;">
                                            <span class="flex items-center gap-1.5">
                                                <iconify-icon icon="ph:calendar-fill" style="font-size:12px;"></iconify-icon>
                                                Withdrawal Date
                                            </span>
                                        </th>
                                        <td class="pt-4 pb-1 font-semibold text-right text-sm" style="color:#0C3A30;">
                                            {{ $withdrawnAt->format('d M Y, h:i A') }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Footer link --}}
                    <div class="px-6 py-3 border-t border-gray-200/60 text-center"
                         style="background: rgba(240,253,228,0.5);">
                        <a href="{{ route('user.withdrawals.list') }}"
                           class="inline-flex items-center gap-1.5 text-sm font-semibold hover:underline transition"
                           style="color:#5a8a00;">
                            View Full Withdrawal History
                            <iconify-icon icon="ph:arrow-right-bold" style="font-size:13px;"></iconify-icon>
                        </a>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        @endif
    </div>
</div>
@endsection