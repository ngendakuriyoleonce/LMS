{{-- resources/views/leave-requests/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leave Request Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
    <div class="max-w-6xl mx-auto px-4 py-8">
                
                {{-- Info Card at the top --}}
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-800">
                                <strong>Important Information:</strong>
                            </p>
                            <ul class="mt-1 text-sm text-blue-700 list-disc list-inside space-y-0.5">
                                <li>Leave requests must be submitted at least 7 days in advance for annual leave</li>
                                <li>Medical certificate is required for sick leave of more than 3 days</li>
                                <li>You will be notified by email of your request approval</li>
                                <li>Please ensure all documents are clear and readable</li>
                                <li>For emergency leave, please also inform your supervisor by phone</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                   
                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    {{-- Error Message --}}
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    {{-- Validation Errors --}}
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('leave-requests.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Leave Type -->
                        <div class="mb-4">
                            <label class="block font-bold mb-2">Leave Type <span class="text-red-500">*</span></label>
                            <select name="leave_type" id="leave_type" class="w-full border rounded px-3 py-2 @error('leave_type') border-red-500 @enderror" >
                                <option value="">Select Leave Type</option>
                                <option value="annual" {{ old('leave_type') == 'annual' ? 'selected' : '' }}>Annual Leave</option>
                                <option value="emergency" {{ old('leave_type') == 'emergency' ? 'selected' : '' }}>Emergency Leave</option>
                                <option value="sick" {{ old('leave_type') == 'sick' ? 'selected' : '' }}>Sick Leave</option>
                                <option value="maternity" {{ old('leave_type') == 'maternity' ? 'selected' : '' }}>Maternity Leave</option>
                                <option value="unpaid" {{ old('leave_type') == 'unpaid' ? 'selected' : '' }}>Unpaid Leave</option>
                                <option value="other" {{ old('leave_type') == 'other' ? 'selected' : '' }}>Other Leave</option>
                            </select>
                            @error('leave_type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- From Date -->
                        <div class="mb-4">
                            <label class="block font-bold mb-2">From Date <span class="text-red-500">*</span></label>
                            <input type="date" name="from_date" value="{{ old('from_date') }}" class="w-full border rounded px-3 py-2 @error('from_date') border-red-500 @enderror" >
                            @error('from_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- To Date -->
                        <div class="mb-4">
                            <label class="block font-bold mb-2">To Date <span class="text-red-500">*</span></label>
                            <input type="date" name="to_date" value="{{ old('to_date') }}" class="w-full border rounded px-3 py-2 @error('to_date') border-red-500 @enderror">
                            @error('to_date')
                                <p class="mt-2 text-sm text-red-600">
    {{ $message }}
</p>
                            @enderror
                        </div>
                        
                        <!-- Total Days (auto-calculated by backend) -->
                        <div class="mb-4">
                            <label class="block font-bold mb-2">Total Days <span class="text-red-500">*</span></label>
                            <input type="number" name="total_days" value="{{ old('total_days') }}" class="w-full border rounded px-3 py-2 @error('total_days') border-red-500 @enderror" min="1"  readonly style="background-color: #f3f4f6;">
                            <p class="text-gray-500 text-sm mt-1">Total days will be calculated automatically</p>
                           
                        </div>
                        
                        <!-- Reason -->
                        <div class="mb-4">
                            <label class="block font-bold mb-2">Reason</label>
                            <textarea name="reason" rows="3" class="w-full border rounded px-3 py-2 @error('reason') border-red-500 @enderror">{{ old('reason') }}</textarea>
                            @error('reason')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Medical Certificate (Sick Leave) -->
                        <div class="mb-4 sick-field hidden">
                            <label class="block font-bold mb-2">Medical Certificate <span class="text-red-500">*</span></label>
                            <input type="file" name="medical_certificate" class="w-full border rounded px-3 py-2 @error('medical_certificate') border-red-500 @enderror">
                            <p class="text-gray-500 text-sm mt-1">PDF, JPG, JPEG, PNG (Max 2MB)</p>
                            @error('medical_certificate')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Handover Paper (Annual Leave) -->
                        <div class="mb-4 annual-field hidden">
                            <label class="block font-bold mb-2">Handover Paper <span class="text-red-500">*</span></label>
                            <input type="file" name="handover_paper" class="w-full border rounded px-3 py-2 @error('handover_paper') border-red-500 @enderror">
                            <p class="text-gray-500 text-sm mt-1">PDF, JPG, JPEG, WORD or PNG (Max 2MB)</p>
                            @error('handover_paper')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Substitute Employee -->
                        <div class="mb-4">
                            <label class="block font-bold mb-2">Substitute Employee</label>
                            <select name="substitute_employee" class="w-full border rounded px-3 py-2 @error('substitute_employee') border-red-500 @enderror">
                                <option value="">Select Substitute</option>
                                @foreach($substitutes as $sub)
                                    <option value="{{ $sub->id }}" {{ old('substitute_employee') == $sub->id ? 'selected' : '' }}>
                                        {{ $sub->name }} ({{ $sub->designation }})
                                    </option>
                                @endforeach
                            </select>
                            @error('substitute_employee')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Substitute Date -->
                        <div class="mb-4">
                            <label class="block font-bold mb-2">Substitute Start Date</label>
                            <input type="date" name="substitute_date" value="{{ old('substitute_date') }}" class="w-full border rounded px-3 py-2 @error('substitute_date') border-red-500 @enderror">
                            @error('substitute_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
         <x-primary-button>{{ __('Submit Leave Request') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const leaveType = document.getElementById('leave_type');
        const sickField = document.querySelector('.sick-field');
        const annualField = document.querySelector('.annual-field');
        
        
        function toggleFields() {
            sickField.classList.add('hidden');
            annualField.classList.add('hidden');
            
            if (leaveType.value === 'sick') {
                sickField.classList.remove('hidden');
            } else if (leaveType.value === 'annual') {
                annualField.classList.remove('hidden');
            }
        }
        
        leaveType.addEventListener('change', toggleFields);
        toggleFields();
                // Auto-calculate total days
        const fromDate = document.querySelector('input[name="from_date"]');
        const toDate = document.querySelector('input[name="to_date"]');
        const totalDaysInput = document.querySelector('input[name="total_days"]');
        
        function calculateDays() {
            if (fromDate.value && toDate.value) {
                const start = new Date(fromDate.value);
                const end = new Date(toDate.value);
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                if (!isNaN(diffDays) && diffDays > 0) {
                    totalDaysInput.value = diffDays;
                }
            }
        }
        
        if (fromDate && toDate) {
            fromDate.addEventListener('change', calculateDays);
            toDate.addEventListener('change', calculateDays);
        }

    </script>
</x-app-layout>