@extends('partials.layouts.office')

@section('title', 'Department Management')

@section('content')
@php
    $selectedDepartmentId = request('id', null);
    
    // Get selected department data
    $selectedDepartment = $selectedDepartment ?? null;
    if (!$selectedDepartment && $selectedDepartmentId) {
        $selectedDepartment = $departments->firstWhere('id', $selectedDepartmentId);
    }
@endphp

<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen">
        {{-- Include Department Sidebar --}}
        @include('partials.sidebar.departemen', ['departments' => $departments])

        {{-- Right Panel - Department Details --}}
        <div class="flex-1 bg-white flex flex-col overflow-y-auto">
            @if($selectedDepartment)
                {{-- Profile Section --}}
                <div class="px-6 pt-16 pb-8 bg-gray-50">
                    <div class="flex flex-col items-center text-center w-full max-w-5xl mx-auto">
                        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mb-5">
                            <svg class="h-10 w-10 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-1">{{ $selectedDepartment->name }}</h3>
                        <p class="text-gray-600 mb-2">{{ $selectedDepartment->code }}</p>
                        <div class="flex items-center space-x-2 mb-5">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $selectedDepartment->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $selectedDepartment->status === 'active' ? 'Active' : 'Inactive' }}
                            </span>
                            <span class="text-gray-500 text-sm">{{ $selectedDepartment->staff_count }} staff members</span>
                        </div>

                        {{-- Actions --}}
                        <div id="view-actions" class="flex justify-center items-center gap-x-3 w-full max-w-md">
                            <button type="button" 
                                    id="edit-button"
                                    class="rounded-xl px-6 py-3 border border-gray-200/60 bg-white hover:bg-white/60 pb-2.5 border-b-gray-300/80 flex flex-col justify-center items-center w-full whitespace-nowrap duration-100">
                                <svg class="h-[18px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 7.24002C22.0008 7.10841 21.9756 6.97795 21.9258 6.85611C21.876 6.73427 21.8027 6.62346 21.71 6.53002L17.47 2.29002C17.3766 2.19734 17.2658 2.12401 17.1439 2.07425C17.0221 2.02448 16.8916 1.99926 16.76 2.00002C16.6284 1.99926 16.4979 2.02448 16.3761 2.07425C16.2543 2.12401 16.1435 2.19734 16.05 2.29002L13.22 5.12002L2.29002 16.05C2.19734 16.1435 2.12401 16.2543 2.07425 16.3761C2.02448 16.4979 1.99926 16.6284 2.00002 16.76V21C2.00002 21.2652 2.10537 21.5196 2.29291 21.7071C2.48045 21.8947 2.7348 22 3.00002 22H7.24002C7.37994 22.0076 7.51991 21.9857 7.65084 21.9358C7.78176 21.8858 7.90073 21.8089 8.00002 21.71L18.87 10.78L21.71 8.00002C21.8013 7.9031 21.8757 7.79155 21.93 7.67002C21.9397 7.59031 21.9397 7.50973 21.93 7.43002C21.9347 7.38347 21.9347 7.33657 21.93 7.29002L22 7.24002ZM6.83002 20H4.00002V17.17L13.93 7.24002L16.76 10.07L6.83002 20ZM18.17 8.66002L15.34 5.83002L16.76 4.42002L19.58 7.24002L18.17 8.66002Z" fill="#128AEB"/>
                                </svg>
                                <span class="text-[#128aeb] mt-1 text-[15px]">Edit</span>
                            </button>

                            <button type="button" 
                                    id="status-toggle-button"
                                    data-status="{{ $selectedDepartment->status }}"
                                    data-code="{{ $selectedDepartment->code }}"
                                    class="rounded-xl px-6 py-3 border border-gray-200/60 bg-white hover:bg-white/60 pb-2.5 border-b-gray-300/80 flex flex-col justify-center items-center w-full whitespace-nowrap duration-100">
                                @if($selectedDepartment->status === 'active')
                                    <svg class="h-[18px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM12 20c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="#EF4444"/>
                                        <path d="M15.5 8.5L8.5 15.5" stroke="#EF4444" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    <span class="text-red-500 mt-1 text-[15px]">Deactivate</span>
                                @else
                                    <svg class="h-[18px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM10 17l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="#10B981"/>
                                    </svg>
                                    <span class="text-green-500 mt-1 text-[15px]">Activate</span>
                                @endif
                            </button>

                            <button type="button" 
                                    id="delete-button"
                                    data-code="{{ $selectedDepartment->code }}"
                                    class="rounded-xl px-6 py-3 border border-gray-200/60 bg-white hover:bg-white/60 pb-2.5 border-b-gray-300/80 flex flex-col justify-center items-center w-full whitespace-nowrap duration-100">
                                <svg class="h-[18px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" fill="#EF4444"/>
                                </svg>
                                <span class="text-red-500 mt-1 text-[15px]">Delete</span>
                            </button>
                        </div>

                        {{-- Edit Mode Actions --}}
                        <div id="edit-actions" class="hidden w-full max-w-xs">
                            <div class="flex justify-center items-center gap-x-3 w-full">
                                <button type="button" 
                                        id="cancel-button"
                                        class="rounded-xl px-6 py-3 border border-gray-200/60 bg-white hover:bg-white/60 pb-2.5 border-b-gray-300/80 flex flex-col justify-center items-center w-full whitespace-nowrap duration-100">
                                    <span class="text-gray-600 text-[15px]">Cancel</span>
                                </button>
                                <button type="button" 
                                        id="save-button"
                                        class="rounded-xl px-6 py-3 border border-blue-200/60 bg-blue-500 hover:bg-blue-600 pb-2.5 border-b-blue-600/80 flex flex-col justify-center items-center w-full whitespace-nowrap duration-100">
                                    <span class="text-white text-[15px]">Save Changes</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Information Details --}}
                <div class="w-full bg-white">
                    <div class="flex-1 overflow-y-auto w-full max-w-4xl mx-auto">
                        {{-- Tabs --}}
                        <div class="w-full grid grid-cols-2" id="department-tabs">
                            <button type="button" class="tab-button w-full h-[44px] flex justify-center items-center text-center border-b-2 border-b-[#128aeb] text-[#128aeb] font-medium transition-all duration-200" data-tab="overview">Overview</button>
                            <button type="button" class="tab-button w-full h-[44px] flex justify-center items-center text-center border-b-2 border-b-transparent text-gray-500 hover:bg-neutral-100 hover:text-gray-700 transition-all duration-200" data-tab="staff">Staff</button>
                        </div>

                        {{-- Edit Form (Hidden by default) --}}
                        <div id="edit-form" class="hidden py-5">
                            <form id="department-edit-form" action="{{ route('staff.departments.update', $selectedDepartment->code) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                {{-- Basic Information --}}
                                <div class="bg-white w-full mb-6">
                                    <div class="px-6 pt-4 pb-2">
                                        <h4 class="text-base font-medium text-slate-800">Basic Information</h4>
                                    </div>
                                    <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Department Name</label>
                                            <input type="text" id="name" name="name" value="{{ $selectedDepartment->name }}" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        </div>
                                        <div>
                                            <label for="code" class="block text-sm font-medium text-gray-700 mb-2">Department Code</label>
                                            <input type="text" id="code" name="code" value="{{ $selectedDepartment->code }}" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                            <textarea id="description" name="description" rows="3" 
                                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $selectedDepartment->description }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                {{-- Management Information --}}
                                <div class="bg-white w-full mb-6">
                                    <div class="px-6 pt-4 pb-2">
                                        <h4 class="text-base font-medium text-slate-800">Management Information</h4>
                                    </div>
                                    <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="manager_id" class="block text-sm font-medium text-gray-700 mb-2">Manager</label>
                                            <select id="manager_id" name="manager_id" 
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="">Select Manager</option>
                                                @foreach(App\Models\User::whereNotNull('role')->where('role', '!=', 'customer')->whereIn('role', ['admin', 'manager', 'supervisor'])->get() as $manager)
                                                    <option value="{{ $manager->id }}" {{ $selectedDepartment->manager_id == $manager->id ? 'selected' : '' }}>
                                                        {{ $manager->name }} ({{ ucfirst($manager->role) }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                            <select id="status" name="status" 
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                                <option value="active" {{ $selectedDepartment->status === 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $selectedDepartment->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="budget" class="block text-sm font-medium text-gray-700 mb-2">Budget</label>
                                            <input type="number" id="budget" name="budget" value="{{ $selectedDepartment->budget }}" step="0.01" min="0"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                        <div>
                                            <label for="established_date" class="block text-sm font-medium text-gray-700 mb-2">Established Date</label>
                                            <input type="date" id="established_date" name="established_date" value="{{ $selectedDepartment->established_date?->format('Y-m-d') }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                    </div>
                                </div>

                                {{-- Contact Information --}}
                                <div class="bg-white w-full mb-6">
                                    <div class="px-6 pt-4 pb-2">
                                        <h4 class="text-base font-medium text-slate-800">Contact Information</h4>
                                    </div>
                                    <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                                            <input type="text" id="location" name="location" value="{{ $selectedDepartment->location }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                        <div>
                                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                            <input type="text" id="phone" name="phone" value="{{ $selectedDepartment->phone }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                            <input type="email" id="email" name="email" value="{{ $selectedDepartment->email }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- Tab Content --}}
                        <div class="tab-content min-h-[400px]" id="overview-content">
                            <div class="p-6">
                                {{-- Description Section --}}
                                @if(!empty($selectedDepartment->description))
                                <div class="bg-white w-full mb-6">
                                    <div class="mb-4">
                                        <h4 class="text-base font-semibold text-slate-800 mb-2">Description</h4>
                                        <p class="text-slate-600 text-base leading-relaxed">
                                            {{ $selectedDepartment->description }}
                                        </p>
                                    </div>
                                </div>
                                @endif

                                {{-- Management Information --}}
                                <div class="bg-white w-full mb-6">
                                    <h4 class="text-base font-semibold text-slate-800 mb-4">Management Information</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="flex flex-col">
                                            <span class="text-slate-500 text-sm mb-1">Manager</span>
                                            <span class="text-slate-900 font-medium">
                                                @if($selectedDepartment->manager)
                                                    {{ $selectedDepartment->manager->name }}
                                                @else
                                                    <span class="text-gray-400">Not assigned</span>
                                                @endif
                                            </span>
                                        </div>
                                        
                                        <div class="flex flex-col">
                                            <span class="text-slate-500 text-sm mb-1">Staff Count</span>
                                            <span class="text-slate-900 font-medium">{{ $selectedDepartment->staff_count }} members</span>
                                        </div>
                                        
                                        @if($selectedDepartment->budget)
                                        <div class="flex flex-col">
                                            <span class="text-slate-500 text-sm mb-1">Budget</span>
                                            <span class="text-slate-900 font-medium">${{ number_format($selectedDepartment->budget, 2) }}</span>
                                        </div>
                                        @endif
                                        
                                        @if($selectedDepartment->established_date)
                                        <div class="flex flex-col">
                                            <span class="text-slate-500 text-sm mb-1">Established</span>
                                            <span class="text-slate-900 font-medium">{{ $selectedDepartment->established_date->format('M d, Y') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Contact Information --}}
                                @php
                                    $hasLocation = !empty($selectedDepartment->location);
                                    $hasPhone = !empty($selectedDepartment->phone);
                                    $hasEmail = !empty($selectedDepartment->email);
                                @endphp
                                
                                @if($hasLocation || $hasPhone || $hasEmail)
                                <div class="bg-white w-full mb-6">
                                    <h4 class="text-base font-semibold text-slate-800 mb-4">Contact Information</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        @if($hasLocation)
                                        <div class="flex flex-col">
                                            <span class="text-slate-500 text-sm mb-1">Location</span>
                                            <span class="text-slate-900 font-medium">{{ $selectedDepartment->location }}</span>
                                        </div>
                                        @endif
                                        
                                        @if($hasPhone)
                                        <div class="flex flex-col">
                                            <span class="text-slate-500 text-sm mb-1">Phone</span>
                                            <span class="text-slate-900 font-medium">{{ $selectedDepartment->phone }}</span>
                                        </div>
                                        @endif
                                        
                                        @if($hasEmail)
                                        <div class="flex flex-col md:col-span-2">
                                            <span class="text-slate-500 text-sm mb-1">Email</span>
                                            <span class="text-slate-900 font-medium">{{ $selectedDepartment->email }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                {{-- System Information --}}
                                <div class="bg-white w-full">
                                    <h4 class="text-base font-semibold text-slate-800 mb-4">System Information</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="flex flex-col">
                                            <span class="text-slate-500 text-sm mb-1">Department ID</span>
                                            <span class="text-slate-900 font-medium">{{ $selectedDepartment->id }}</span>
                                        </div>
                                        
                                        <div class="flex flex-col">
                                            <span class="text-slate-500 text-sm mb-1">Created</span>
                                            <span class="text-slate-900 font-medium">{{ $selectedDepartment->created_at->format('M d, Y') }}</span>
                                        </div>
                                        
                                        <div class="flex flex-col">
                                            <span class="text-slate-500 text-sm mb-1">Last Updated</span>
                                            <span class="text-slate-900 font-medium">{{ $selectedDepartment->updated_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Staff Tab Content --}}
                        <div class="tab-content hidden min-h-[400px]" id="staff-content">
                            <div class="p-6">
                                <div class="bg-white w-full">
                                    <div class="flex items-center justify-between mb-6">
                                        <h4 class="text-base font-semibold text-slate-800">Staff Members ({{ $selectedDepartment->staff->count() }})</h4>
                                    </div>

                                    {{-- Staff List --}}
                                    @if($selectedDepartment->staff->count() > 0)
                                        <div class="space-y-3">
                                            @foreach($selectedDepartment->staff as $staff)
                                                <div class="flex items-center p-4 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                                                    <x-user-avatar :user="$staff" size="sm" class="mr-3" />
                                                    <div class="flex-1">
                                                        <div class="text-sm font-medium text-gray-900">{{ $staff->name }}</div>
                                                        <div class="text-sm text-gray-500">{{ $staff->email }}</div>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="text-sm font-medium text-gray-900">{{ ucfirst($staff->role) }}</div>
                                                        <div class="text-xs text-gray-500">
                                                            @if($staff->status === 'active')
                                                                <span class="text-green-600">Active</span>
                                                            @else
                                                                <span class="text-red-600">Inactive</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-12">
                                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            <h3 class="mt-4 text-sm font-medium text-gray-900">No staff members</h3>
                                            <p class="mt-2 text-sm text-gray-500">This department doesn't have any staff members assigned yet.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- JavaScript for interactions --}}
                <style>
                    .tab-content {
                        opacity: 1;
                        transition: opacity 0.2s ease-in-out;
                    }
                    
                    .tab-content.hidden {
                        opacity: 0;
                        display: none !important;
                    }
                    
                    .tab-button {
                        transition: all 0.2s ease-in-out;
                    }
                    
                    .tab-button:hover {
                        background-color: rgba(0, 0, 0, 0.05);
                    }
                    
                    #edit-form {
                        opacity: 1;
                        transition: opacity 0.2s ease-in-out;
                    }
                    
                    #edit-form.hidden {
                        opacity: 0;
                        display: none !important;
                    }
                    
                    #department-tabs {
                        transition: all 0.2s ease-in-out;
                    }
                </style>
                
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Tab functionality
                        const tabButtons = document.querySelectorAll('.tab-button');
                        const tabContents = document.querySelectorAll('.tab-content');
                        
                        tabButtons.forEach(button => {
                            button.addEventListener('click', function() {
                                const targetTab = this.getAttribute('data-tab');
                                
                                // Remove active state from all tabs
                                tabButtons.forEach(btn => {
                                    btn.classList.remove('border-b-[#128aeb]', 'text-[#128aeb]', 'font-medium');
                                    btn.classList.add('border-b-transparent', 'text-gray-500');
                                });
                                
                                // Hide all tab contents
                                tabContents.forEach(content => {
                                    content.classList.add('hidden');
                                });
                                
                                // Activate clicked tab
                                this.classList.remove('border-b-transparent', 'text-gray-500');
                                this.classList.add('border-b-[#128aeb]', 'text-[#128aeb]', 'font-medium');
                                
                                // Show target content
                                const targetContent = document.getElementById(targetTab + '-content');
                                if (targetContent) {
                                    targetContent.classList.remove('hidden');
                                }
                            });
                        });

                        // Edit functionality
                        const editButton = document.getElementById('edit-button');
                        const cancelButton = document.getElementById('cancel-button');
                        const saveButton = document.getElementById('save-button');
                        const viewActions = document.getElementById('view-actions');
                        const editActions = document.getElementById('edit-actions');
                        const editForm = document.getElementById('edit-form');
                        const departmentTabs = document.getElementById('department-tabs');

                        if (editButton) {
                            editButton.addEventListener('click', function() {
                                // Store current active tab
                                const activeTab = document.querySelector('.tab-button.border-b-\\[\\#128aeb\\]');
                                if (activeTab) {
                                    activeTab.setAttribute('data-was-active', 'true');
                                }
                                
                                // Hide view actions and show edit actions
                                viewActions.classList.add('hidden');
                                editActions.classList.remove('hidden');
                                
                                // Hide tabs and tab content, show edit form
                                departmentTabs.style.display = 'none';
                                tabContents.forEach(content => {
                                    content.style.display = 'none';
                                });
                                editForm.classList.remove('hidden');
                            });
                        }

                        if (cancelButton) {
                            cancelButton.addEventListener('click', function() {
                                // Show view actions and hide edit actions
                                viewActions.classList.remove('hidden');
                                editActions.classList.add('hidden');
                                
                                // Show tabs and hide edit form
                                departmentTabs.style.display = 'grid';
                                editForm.classList.add('hidden');
                                
                                // Restore previously active tab or default to overview
                                const wasActiveTab = document.querySelector('.tab-button[data-was-active="true"]') || 
                                                   document.querySelector('.tab-button[data-tab="overview"]');
                                
                                if (wasActiveTab) {
                                    // Clear all tab states first
                                    tabButtons.forEach(btn => {
                                        btn.classList.remove('border-b-[#128aeb]', 'text-[#128aeb]', 'font-medium');
                                        btn.classList.add('border-b-transparent', 'text-gray-500');
                                        btn.removeAttribute('data-was-active');
                                    });
                                    
                                    // Hide all tab contents
                                    tabContents.forEach(content => {
                                        content.classList.add('hidden');
                                        content.style.display = '';
                                    });
                                    
                                    // Activate the correct tab
                                    wasActiveTab.classList.remove('border-b-transparent', 'text-gray-500');
                                    wasActiveTab.classList.add('border-b-[#128aeb]', 'text-[#128aeb]', 'font-medium');
                                    
                                    // Show corresponding content
                                    const targetTab = wasActiveTab.getAttribute('data-tab');
                                    const targetContent = document.getElementById(targetTab + '-content');
                                    if (targetContent) {
                                        targetContent.classList.remove('hidden');
                                    }
                                }
                            });
                        }

                        if (saveButton) {
                            saveButton.addEventListener('click', function(e) {
                                e.preventDefault();
                                
                                const form = document.getElementById('department-edit-form');
                                const formData = new FormData(form);
                                
                                // Show loading state
                                const originalText = this.querySelector('span').innerText;
                                this.disabled = true;
                                this.querySelector('span').innerText = 'Saving...';
                                
                                fetch(form.action, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Instead of reload, restore normal view
                                        viewActions.classList.remove('hidden');
                                        editActions.classList.add('hidden');
                                        departmentTabs.style.display = 'grid';
                                        editForm.classList.add('hidden');
                                        
                                        // Restore overview tab as active
                                        tabButtons.forEach(btn => {
                                            btn.classList.remove('border-b-[#128aeb]', 'text-[#128aeb]', 'font-medium');
                                            btn.classList.add('border-b-transparent', 'text-gray-500');
                                        });
                                        
                                        tabContents.forEach(content => {
                                            content.classList.add('hidden');
                                            content.style.display = '';
                                        });
                                        
                                        const overviewTab = document.querySelector('.tab-button[data-tab="overview"]');
                                        const overviewContent = document.getElementById('overview-content');
                                        
                                        if (overviewTab) {
                                            overviewTab.classList.remove('border-b-transparent', 'text-gray-500');
                                            overviewTab.classList.add('border-b-[#128aeb]', 'text-[#128aeb]', 'font-medium');
                                        }
                                        
                                        if (overviewContent) {
                                            overviewContent.classList.remove('hidden');
                                        }
                                        
                                        // Show success message
                                        alert(data.message || 'Department updated successfully!');
                                        
                                        // Optionally reload to get fresh data
                                        setTimeout(() => {
                                            window.location.reload();
                                        }, 1000);
                                    } else {
                                        alert(data.message || 'Failed to update department.');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('An error occurred while updating the department.');
                                })
                                .finally(() => {
                                    this.disabled = false;
                                    this.querySelector('span').innerText = originalText;
                                });
                            });
                        }

                        // Status toggle functionality
                        const statusToggleButton = document.getElementById('status-toggle-button');
                        if (statusToggleButton) {
                            statusToggleButton.addEventListener('click', function() {
                                const currentStatus = this.getAttribute('data-status');
                                const departmentCode = this.getAttribute('data-code');
                                const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
                                const action = newStatus === 'active' ? 'activate' : 'deactivate';
                                
                                if (!confirm(`Are you sure you want to ${action} this department?`)) {
                                    return;
                                }
                                
                                // Show loading state
                                const originalHTML = this.innerHTML;
                                this.disabled = true;
                                this.innerHTML = `
                                    <svg class="h-[18px] animate-spin" viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" stroke-opacity="0.3"/>
                                        <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                                    </svg>
                                    <span class="text-gray-500 mt-1 text-[15px]">Processing...</span>
                                `;
                                
                                const formData = new FormData();
                                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                                formData.append('_method', 'PATCH');
                                formData.append('status', newStatus);
                                
                                fetch(`/departments/${departmentCode}/status`, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        window.location.reload();
                                    } else {
                                        alert(data.message || 'Failed to update department status.');
                                        this.disabled = false;
                                        this.innerHTML = originalHTML;
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('An error occurred while updating the department status.');
                                    this.disabled = false;
                                    this.innerHTML = originalHTML;
                                });
                            });
                        }

                        // Delete functionality
                        const deleteButton = document.getElementById('delete-button');
                        if (deleteButton) {
                            deleteButton.addEventListener('click', function() {
                                const departmentCode = this.getAttribute('data-code');
                                
                                if (!confirm('Are you sure you want to delete this department? This action cannot be undone.')) {
                                    return;
                                }
                                
                                // Show loading state
                                const originalHTML = this.innerHTML;
                                this.disabled = true;
                                this.innerHTML = `
                                    <svg class="h-[18px] animate-spin" viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" stroke-opacity="0.3"/>
                                        <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                                    </svg>
                                    <span class="text-gray-500 mt-1 text-[15px]">Deleting...</span>
                                `;
                                
                                const formData = new FormData();
                                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                                formData.append('_method', 'DELETE');
                                
                                fetch(`/departments/${departmentCode}`, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        window.location.href = '{{ route("staff.departments.index") }}';
                                    } else {
                                        alert(data.message || 'Failed to delete department.');
                                        this.disabled = false;
                                        this.innerHTML = originalHTML;
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('An error occurred while deleting the department.');
                                    this.disabled = false;
                                    this.innerHTML = originalHTML;
                                });
                            });
                        }
                    });
                </script>
            @else
                {{-- Default State --}}
                <div class="flex-1 flex items-center justify-center text-gray-500">
                    <div class="text-center">
                        <svg class="mx-auto h-20 mb-4 text-gray-300" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.5758 15.0067C15.1561 14.3836 15.4829 13.5664 15.4925 12.715C15.4925 11.796 15.1274 10.9147 14.4776 10.2649C13.8278 9.61506 12.9465 9.25 12.0275 9.25C11.1085 9.25 10.2272 9.61506 9.57738 10.2649C8.92756 10.9147 8.5625 11.796 8.5625 12.715C8.57207 13.5664 8.89894 14.3836 9.47917 15.0067C8.67127 15.409 7.97604 16.0058 7.45601 16.7434C6.93598 17.4811 6.60746 18.3364 6.5 19.2325C6.47326 19.4756 6.54419 19.7194 6.69719 19.9102C6.85018 20.101 7.07272 20.2233 7.31583 20.25C7.55895 20.2767 7.80273 20.2058 7.99355 20.0528C8.18437 19.8998 8.30659 19.6773 8.33333 19.4342C8.44272 18.546 8.87311 17.7286 9.54341 17.1358C10.2137 16.543 11.0777 16.2157 11.9725 16.2157C12.8673 16.2157 13.7313 16.543 14.4016 17.1358C15.0719 17.7286 15.5023 18.546 15.6117 19.4342C15.6372 19.6692 15.7525 19.8853 15.9336 20.0373C16.1146 20.1894 16.3474 20.2656 16.5833 20.25H16.6842C16.9245 20.2224 17.1441 20.1009 17.2952 19.912C17.4463 19.7231 17.5166 19.4822 17.4908 19.2417C17.3913 18.3503 17.0732 17.4973 16.5646 16.7585C16.0561 16.0196 15.3729 15.4179 14.5758 15.0067ZM12 14.3467C11.6773 14.3467 11.3618 14.251 11.0935 14.0717C10.8252 13.8924 10.616 13.6376 10.4925 13.3394C10.369 13.0413 10.3367 12.7132 10.3997 12.3967C10.4626 12.0802 10.618 11.7894 10.8462 11.5612C11.0744 11.333 11.3652 11.1776 11.6817 11.1147C11.9982 11.0517 12.3263 11.084 12.6244 11.2075C12.9226 11.331 13.1774 11.5402 13.3567 11.8085C13.536 12.0768 13.6317 12.3923 13.6317 12.715C13.6317 13.1477 13.4598 13.5628 13.1538 13.8688C12.8478 14.1748 12.4327 14.3467 12 14.3467ZM20.25 6.5H3.75C3.02065 6.5 2.32118 6.78973 1.80546 7.30546C1.28973 7.82118 1 8.52065 1 9.25V20.25C1 20.9793 1.28973 21.6788 1.80546 22.1945C2.32118 22.7103 3.02065 23 3.75 23H20.25C20.9793 23 21.6788 22.7103 22.1945 22.1945C22.7103 21.6788 23 20.9793 23 20.25V9.25C23 8.52065 22.7103 7.82118 22.1945 7.30546C21.6788 6.78973 20.9793 6.5 20.25 6.5ZM21.1667 20.25C21.1667 20.4931 21.0701 20.7263 20.8982 20.8982C20.7263 21.0701 20.4931 21.1667 20.25 21.1667H3.75C3.50688 21.1667 3.27373 21.0701 3.10182 20.8982C2.92991 20.7263 2.83333 20.4931 2.83333 20.25V9.25C2.83333 9.00689 2.92991 8.77373 3.10182 8.60182C3.27373 8.42991 3.50688 8.33333 3.75 8.33333H20.25C20.4931 8.33333 20.7263 8.42991 20.8982 8.60182C21.0701 8.77373 21.1667 9.00689 21.1667 9.25V20.25Z" fill="currentColor"/>
                        <path d="M2.83333 4.66667C2.83333 4.16041 3.24374 3.75 3.75 3.75H20.25C20.7563 3.75 21.1667 4.16041 21.1667 4.66667C21.1667 5.17293 20.7563 5.58333 20.25 5.58333H3.75C3.24374 5.58333 2.83333 5.17293 2.83333 4.66667Z" fill="currentColor"/>
                        <path d="M4.66667 1.91667C4.66667 1.41041 5.07707 1 5.58333 1H18.4167C18.9229 1 19.3333 1.41041 19.3333 1.91667C19.3333 2.42293 18.9229 2.83333 18.4167 2.83333H5.58333C5.07707 2.83333 4.66667 2.42293 4.66667 1.91667Z" fill="currentColor"/>
                        </svg>
                        <h3 class="text-lg font-medium text-slate-800 mb-2">Select a Department</h3>
                        <p class="text-gray-500">Choose a department from the list to view its details</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
