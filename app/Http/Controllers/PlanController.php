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
        'name' => 'required|string|max:255',
        'minimum_amount' => 'required|numeric|min:0',
        'maximum_amount' => 'required|numeric|gte:minimum_amount',
        'interest_rate' => 'required|numeric|min:0',
        'duration' => 'required|integer|min:1',
        'duration_unit' => 'nullable|in:minutes,hours,days',
        'status' => 'required|in:active,inactive',
        'max_participations' => 'nullable|integer|min:0',
        // ... other validations
    ]);

    $data = $request->all();
    
    // Set default values
    if (!isset($data['duration_unit'])) {
        $data['duration_unit'] = 'days';
    }
    if (!isset($data['max_participations']) || $data['max_participations'] === null) {
        $data['max_participations'] = 3;
    }
    
    // Handle JSON fields
    if ($request->has('assets_traded')) {
        $data['assets_traded'] = json_encode($request->assets_traded);
    }
    
    if ($request->has('features')) {
        $features = array_filter($request->features, function($value) {
            return !empty(trim($value));
        });
        $data['features'] = json_encode(array_values($features));
    }
    
    $data['popular_badge'] = $request->has('popular_badge') ? true : false;

    Plan::create($data);
    
    return redirect()->back()->with('success', 'Trading plan created successfully');
}

// Update the updatePlan method similarly:

public function updatePlan(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'minimum_amount' => 'required|numeric|min:0',
        'maximum_amount' => 'required|numeric|gte:minimum_amount',
        'interest_rate' => 'required|numeric|min:0',
        'duration' => 'required|integer|min:1',
        'duration_unit' => 'nullable|in:minutes,hours,days',
        'status' => 'required|in:active,inactive',
        'max_participations' => 'nullable|integer|min:0',
        // ... other validations
    ]);

    $plan = Plan::find($id);
    $data = $request->all();
    
    // Set default values
    if (!isset($data['duration_unit'])) {
        $data['duration_unit'] = 'days';
    }
    if (!isset($data['max_participations']) || $data['max_participations'] === null) {
        $data['max_participations'] = 3;
    }
    
    // Handle JSON fields
    if ($request->has('assets_traded')) {
        $data['assets_traded'] = json_encode($request->assets_traded);
    }
    
    if ($request->has('features')) {
        $features = array_filter($request->features, function($value) {
            return !empty(trim($value));
        });
        $data['features'] = json_encode(array_values($features));
    }
    
    $data['popular_badge'] = $request->has('popular_badge') ? true : false;
    
    $plan->update($data);
    
    return redirect()->route('plan.list')->with('message', 'Plan updated successfully');
}


    public function plan_dashboard()
    {
        $plans = Plan::where('status', 'active')->get();
        return view('dashboard.plans_userdashboard.plan_dashboard', compact('plans'));
    }
}
