<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreLeaveRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\LeaveRequest;
use Illuminate\Foundation\auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    use AuthorizesRequests;
    public function create()
    {
        $user = Auth::user();
        
        $substitutes = User::where('department_id', $user->department_id)
            ->where('id', '!=', $user->id)
            ->get();
        return view('leave-requests.create', compact('substitutes'));

    }

    public function store(StoreLeaveRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $user = Auth::user();  
     if ($request->hasFile('medical_certificate')) {
    $file = $request->file('medical_certificate');

    $fileName = time().'_'.$file->getClientOriginalName();

    $file->move(public_path('files'), $fileName);

    $medicalPath = 'files/'.$fileName;
} else {
    $medicalPath = null;
}

if ($request->hasFile('handover_paper')) {
    $file = $request->file('handover_paper');

    $fileName = time().'_'.$file->getClientOriginalName();

    $file->move(public_path('files'), $fileName);

    $handoverPath = 'files/'.$fileName;
} else {
    $handoverPath = null;
}
$refNo = LeaveRequest::generateRefNo();
 $leaveRequest = LeaveRequest::create([
                'ref_no' => $refNo,
                'user_id' => $user->id,
                'leave_type' => $request->leave_type,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'total_days' => $request->total_days,
                'reason' => $request->reason,
                'status' => 'pending_manager',
                'substitute_employee' => $request->substitute_employee,
                'substitute_date' => $request->substitute_date,
                'medical_certificate' => $medicalPath,
                'handover_paper' => $handoverPath,
                ]);
            
            DB::commit();
           return redirect()->route('leave-requests.create')
                ->with('success', "Leave request {$refNo} submitted successfully!");
    }
     catch (\Exception $e) {
            DB::rollBack();
           return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    //single leave request details
      public function show(leaveRequest $leaveRequest)
    {
        $this->authorize('view', $leaveRequest);
        
        return view('leave-requests.show', compact('leaveRequest'));
    }
    public function cancel(LeaveRequest $leaveRequest)
    {
      try {
        DB::beginTransaction();
        $this->authorize('cancel', $leaveRequest);
        
        if (!in_array($leaveRequest->status, ['pending_manager', 'pending_hr'])) {
            return back()->with('error', 'Only pending requests can be cancelled.');
        }
        $leaveRequest->update([
                'status' => 'cancelled'
            ]);

        db::commit();
        return back()->with('success', "Leave request {$leaveRequest->ref_no} has been cancelled.");
    }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
    }