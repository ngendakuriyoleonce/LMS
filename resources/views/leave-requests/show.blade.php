{{-- resources/views/leave-requests/show.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request Details - {{ $leaveRequest->ref_no }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            
            {{-- Header --}}
            <div class="bg-blue-600 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">Leave Request Details</h1>
                <p class="text-blue-100">Reference: {{ $leaveRequest->ref_no }}</p>
            </div>
            
            {{-- Messages --}}
            <div class="px-6 py-4">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            
            {{-- Status Badge --}}
            <div class="px-6">
                @php
                    $statusColors = [
                        'pending_manager' => 'bg-yellow-500',
                        'pending_hr' => 'bg-blue-500',
                        'pending_ceo' => 'bg-purple-500',
                        'approved' => 'bg-green-500',
                        'rejected' => 'bg-red-500',
                        'cancelled' => 'bg-gray-500',
                    ];
                    $statusTexts = [
                        'pending_manager' => 'Pending Manager Approval',
                        'pending_hr' => 'Pending HR Approval',
                        'pending_ceo' => 'Pending CEO Approval',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'cancelled' => 'Cancelled',
                    ];
                    $color = $statusColors[$leaveRequest->status] ?? 'bg-gray-500';
                    $text = $statusTexts[$leaveRequest->status] ?? ucfirst($leaveRequest->status);
                @endphp
                <span class="inline-block px-3 py-1 text-white text-sm font-semibold rounded-full {{ $color }}">
                    {{ $text }}
                </span>
            </div>
            
            {{-- Content --}}
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Employee Information --}}
                    <div class="border rounded-lg p-4">
                        <h2 class="text-lg font-bold mb-3 text-gray-700 border-b pb-2">Employee Information</h2>
                        <div class="space-y-2">
                            <p><span class="font-semibold">Name:</span> {{ $leaveRequest->user->name }}</p>
                            <p><span class="font-semibold">Employee ID:</span> {{ $leaveRequest->user->employee_id }}</p>
                            <p><span class="font-semibold">Designation:</span> {{ $leaveRequest->user->designation }}</p>
                            <p><span class="font-semibold">Department:</span> {{ $leaveRequest->user->department->name ?? 'N/A' }}</p>
                            <p><span class="font-semibold">Email:</span> {{ $leaveRequest->user->email }}</p>
                            <p><span class="font-semibold">Mobile:</span> {{ $leaveRequest->user->mobile_no }}</p>
                        </div>
                    </div>
                    
                    {{-- Leave Information --}}
                    <div class="border rounded-lg p-4">
                        <h2 class="text-lg font-bold mb-3 text-gray-700 border-b pb-2">Leave Information</h2>
                        <div class="space-y-2">
                            <p><span class="font-semibold">Leave Type:</span> 
                                <span class="capitalize">{{ $leaveRequest->leave_type }}</span>
                            </p>
                            <p><span class="font-semibold">From Date:</span> {{ $leaveRequest->from_date->format('d M Y') }}</p>
                            <p><span class="font-semibold">To Date:</span> {{ $leaveRequest->to_date->format('d M Y') }}</p>
                            <p><span class="font-semibold">Total Days:</span> {{ $leaveRequest->total_days }} days</p>
                            @if($leaveRequest->reason)
                                <p><span class="font-semibold">Reason:</span> {{ $leaveRequest->reason }}</p>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Substitute Information --}}
                    @if($leaveRequest->substitute_employee)
                    <div class="border rounded-lg p-4">
                        <h2 class="text-lg font-bold mb-3 text-gray-700 border-b pb-2">Substitute Information</h2>
                        <div class="space-y-2">
                            <p><span class="font-semibold">Name:</span> {{ $leaveRequest->substituteEmployee->name ?? 'N/A' }}</p>
                            <p><span class="font-semibold">Designation:</span> {{ $leaveRequest->substituteEmployee->designation ?? 'N/A' }}</p>
                            <p><span class="font-semibold">Start Date:</span> 
                                {{ $leaveRequest->substitute_date ? \Carbon\Carbon::parse($leaveRequest->substitute_date)->format('d M Y') : 'N/A' }}
                            </p>
                        </div>
                    </div>
                    @endif
                    
                    {{-- HR Validation --}}
                    @if($leaveRequest->leave_eligibility)
                    <div class="border rounded-lg p-4">
                        <h2 class="text-lg font-bold mb-3 text-gray-700 border-b pb-2">HR Validation</h2>
                        <div class="space-y-2">
                            <p><span class="font-semibold">Eligibility:</span> {{ $leaveRequest->leave_eligibility }}</p>
                            @if($leaveRequest->total_leave_balance)
                                <p><span class="font-semibold">Total Balance:</span> {{ $leaveRequest->total_leave_balance }} days</p>
                            @endif
                            @if($leaveRequest->remaining_leave_balance)
                                <p><span class="font-semibold">Remaining Balance:</span> {{ $leaveRequest->remaining_leave_balance }} days</p>
                            @endif
                            @if($leaveRequest->hr_validation_date)
                                <p><span class="font-semibold">Validation Date:</span> {{ \Carbon\Carbon::parse($leaveRequest->hr_validation_date)->format('d M Y') }}</p>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    {{-- Signatures --}}
                    <div class="border rounded-lg p-4">
                        <h2 class="text-lg font-bold mb-3 text-gray-700 border-b pb-2">Signatures & Approvals</h2>
                        <div class="space-y-2">
                            @if($leaveRequest->employee_signed_at)
                                <p><span class="font-semibold">Employee:</span> Signed on {{ \Carbon\Carbon::parse($leaveRequest->employee_signed_at)->format('d M Y H:i') }}</p>
                            @endif
                            @if($leaveRequest->manager_signed_at)
                                <p><span class="font-semibold">Manager:</span> Signed on {{ \Carbon\Carbon::parse($leaveRequest->manager_signed_at)->format('d M Y H:i') }}</p>
                                @if($leaveRequest->manager_comment)
                                    <p><span class="font-semibold">Comment:</span> {{ $leaveRequest->manager_comment }}</p>
                                @endif
                            @endif
                            @if($leaveRequest->hr_signed_at)
                                <p><span class="font-semibold">HR:</span> Signed on {{ \Carbon\Carbon::parse($leaveRequest->hr_signed_at)->format('d M Y H:i') }}</p>
                                @if($leaveRequest->hr_comment)
                                    <p><span class="font-semibold">Comment:</span> {{ $leaveRequest->hr_comment }}</p>
                                @endif
                            @endif
                            @if($leaveRequest->ceo_signed_at)
                                <p><span class="font-semibold">CEO:</span> Signed on {{ \Carbon\Carbon::parse($leaveRequest->ceo_signed_at)->format('d M Y H:i') }}</p>
                                @if($leaveRequest->ceo_comment)
                                    <p><span class="font-semibold">Comment:</span> {{ $leaveRequest->ceo_comment }}</p>
                                @endif
                            @endif
                        </div>
                    </div>
                    
                    {{-- Attachments --}}
                    <div class="border rounded-lg p-4">
                        <h2 class="text-lg font-bold mb-3 text-gray-700 border-b pb-2">Attachments</h2>
                        <div class="space-y-2">
                            @if($leaveRequest->medical_certificate)
                                <p>
                                    <span class="font-semibold">Medical Certificate:</span>
                                    <a href="{{ Storage::url($leaveRequest->medical_certificate) }}" target="_blank" class="text-blue-600 hover:underline">
                                        Download
                                    </a>
                                </p>
                            @endif
                            @if($leaveRequest->handover_paper)
                                <p>
                                    <span class="font-semibold">Handover Paper:</span>
                                    <a href="{{ Storage::url($leaveRequest->handover_paper) }}" target="_blank" class="text-blue-600 hover:underline">
                                        Download
                                    </a>
                                </p>
                            @endif
                            @if(!$leaveRequest->medical_certificate && !$leaveRequest->handover_paper)
                                <p class="text-gray-500">No attachments</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                {{-- Action Buttons --}}
                <div class="mt-6 flex gap-3">
                    <a href="{{ route('leave-requests.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        New Request
                    </a>
                    
                    @if(Auth::user()->id === $leaveRequest->user_id && in_array($leaveRequest->status, ['pending_manager', 'pending_hr']))
                        <form action="{{ route('leave-requests.cancel', $leaveRequest->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this leave request?')">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Cancel Request
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>