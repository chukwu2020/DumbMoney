<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{


    // terms$policy 
    public function termsprivacy()
    {
        return view(' dashboard.termsprivacy');
    }
    
    

    public function addPlan()
    {
        return view('admin.plans.add-plan');
    }





    public function planList()
    {
        $plans = Plan::orderBy('created_at', 'DESC')->get();
        return view('admin.plans.index', compact('plans'));
    }

    public function deletePlan($id)
    {
        $data = Plan::find($id);
        $data->delete();

        return redirect()->back()->with('message', 'Plan successfully deleted');
    }


    public function editPlan($id)
    {
        $data = Plan::find($id);
        return view('admin.plans.edit', compact('data'));
    }

    // In app/Http/Controllers/PlanController.php

    // In PlanController.php - update the store method validation rules:

   // In PlanController.php - update the store method validation rules:

public function store(Request $request)
{
    $request->validate([
        'name'               => 'required|string|max:255',
        'minimum_amount'     => 'required|numeric|min:0',
        'maximum_amount'     => 'required|numeric|gte:minimum_amount',
        'interest_rate'      => 'required|numeric|min:0',
        'duration'           => 'required|integer|min:1',
        'duration_unit'      => 'required|in:minutes,hours,days', // ✅ required now
        'status'             => 'required|in:active,inactive',
        'max_participations' => 'nullable|integer|min:0',
    ]);

    $data = $request->only([
        'name', 'minimum_amount', 'maximum_amount', 'interest_rate',
        'duration', 'duration_unit', 'min_duration', 'expected_roi_range',
        'profit_frequency', 'trading_style', 'risk_level', 'recommended_for',
        'strategy', 'management_fee', 'performance_fee', 'min_traders',
        'max_participations', 'status',
    ]);

    // ✅ duration_unit comes directly from the form — no override
    // Only set max_participations default if truly missing
    $data['max_participations'] = $request->input('max_participations') ?? 3;

    // Handle JSON fields
    if ($request->has('assets_traded')) {
        $data['assets_traded'] = $request->assets_traded; // Plan model casts to array
    }

    if ($request->has('features')) {
        $features = array_values(array_filter($request->features, fn($v) => !empty(trim($v))));
        $data['features'] = $features; // Plan model casts to array
    }

    $data['popular_badge'] = $request->boolean('popular_badge');

    Plan::create($data);

    return redirect()->back()->with('success', 'Trading plan created successfully');
}

public function updatePlan(Request $request, $id)
{
    $request->validate([
        'name'               => 'required|string|max:255',
        'minimum_amount'     => 'required|numeric|min:0',
        'maximum_amount'     => 'required|numeric|gte:minimum_amount',
        'interest_rate'      => 'required|numeric|min:0',
        'duration'           => 'required|integer|min:1',
        'duration_unit'      => 'required|in:minutes,hours,days', // ✅ required now
        'status'             => 'required|in:active,inactive',
        'max_participations' => 'nullable|integer|min:0',
    ]);

    $plan = Plan::findOrFail($id);

    $data = $request->only([
        'name', 'minimum_amount', 'maximum_amount', 'interest_rate',
        'duration', 'duration_unit', 'min_duration', 'expected_roi_range',
        'profit_frequency', 'trading_style', 'risk_level', 'recommended_for',
        'strategy', 'management_fee', 'performance_fee', 'min_traders',
        'max_participations', 'status',
    ]);

    $data['max_participations'] = $request->input('max_participations') ?? 3;

    if ($request->has('assets_traded')) {
        $data['assets_traded'] = $request->assets_traded;
    }

    if ($request->has('features')) {
        $features = array_values(array_filter($request->features, fn($v) => !empty(trim($v))));
        $data['features'] = $features;
    }

    $data['popular_badge'] = $request->boolean('popular_badge');

    $plan->update($data);

    return redirect()->route('plan.list')->with('message', 'Plan updated successfully');
}

    public function plan_dashboard()
    {
        $plans = Plan::where('status', 'active')->get();
        return view('dashboard.plans_userdashboard.plan_dashboard', compact('plans'));
    }
}
