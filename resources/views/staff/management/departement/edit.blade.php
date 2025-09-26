@extends('partials.layouts.office')

@section('title', 'Edit Department')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen">
        {{-- Include Department Sidebar --}}
        @php
            // Get all departments for sidebar
            $departments = \App\Models\Department::with(['manager', 'staff'])->orderBy('created_at', 'desc')->get();
        @endphp
        @include('partials.sidebar.departemen', ['departments' => $departments])

        {{-- Right Panel - Edit Form --}}
        <div class="flex-1 bg-white flex flex-col overflow-y-auto">
            <div class="max-w-4xl mx-auto px-4 py-8 w-full">
                {{-- Header --}}
                <div class="mb-8">
                    <div class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                        <a href="{{ route('staff.departments.index') }}" class="hover:text-gray-700">Department Management</a>
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span>Edit Department</span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Department: {{ $department->name }}</h1>
                    <p class="mt-2 text-gray-600">Update department information</p>
                </div>

                {{-- Edit Form --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <form id="edit-department-form" action="{{ route('staff.management.department.update', $department->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        {{-- Basic Information --}}
                        <div class="px-6 py-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-6">Basic Information</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Department Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $department->name) }}"
                                           required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <div class="text-red-500 text-sm mt-1 hidden" id="name-error"></div>
                                </div>
                                
                                <div>
                                    <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                        Department Code
                                    </label>
                                    <input type="text" 
                                           id="code" 
                                           name="code" 
                                           value="{{ old('code', $department->code) }}"
                                           maxlength="10"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <div class="text-red-500 text-sm mt-1 hidden" id="code-error"></div>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                        Description
                                    </label>
                                    <textarea id="description" 
                                              name="description" 
                                              rows="4"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description', $department->description) }}</textarea>
                                    <div class="text-red-500 text-sm mt-1 hidden" id="description-error"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Management Information --}}
                        <div class="px-6 py-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-6">Management Information</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="manager_id" class="block text-sm font-medium text-gray-700 mb-2">
                                        Department Manager
                                    </label>
                                    <select id="manager_id" 
                                            name="manager_id" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="">Select Manager</option>
                                        @foreach($managers as $manager)
                                            <option value="{{ $manager->id }}" {{ old('manager_id', $department->manager_id) == $manager->id ? 'selected' : '' }}>
                                                {{ $manager->name }} ({{ ucfirst($manager->role) }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-red-500 text-sm mt-1 hidden" id="manager_id-error"></div>
                                </div>
                                
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                        Status <span class="text-red-500">*</span>
                                    </label>
                                    <select id="status" 
                                            name="status" 
                                            required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="active" {{ old('status', $department->status) === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $department->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <div class="text-red-500 text-sm mt-1 hidden" id="status-error"></div>
                                </div>
                                
                                <div>
                                    <label for="budget" class="block text-sm font-medium text-gray-700 mb-2">
                                        Budget
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">$</span>
                                        </div>
                                        <input type="number" 
                                               id="budget" 
                                               name="budget" 
                                               value="{{ old('budget', $department->budget) }}"
                                               step="0.01" 
                                               min="0"
                                               class="w-full pl-7 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div class="text-red-500 text-sm mt-1 hidden" id="budget-error"></div>
                                </div>
                                
                                <div>
                                    <label for="established_date" class="block text-sm font-medium text-gray-700 mb-2">
                                        Established Date
                                    </label>
                                    <input type="date" 
                                           id="established_date" 
                                           name="established_date"
                                           value="{{ old('established_date', $department->established_date?->format('Y-m-d')) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <div class="text-red-500 text-sm mt-1 hidden" id="established_date-error"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Contact Information --}}
                        <div class="px-6 py-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-6">Contact Information</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                        Location
                                    </label>
                                    <input type="text" 
                                           id="location" 
                                           name="location"
                                           value="{{ old('location', $department->location) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <div class="text-red-500 text-sm mt-1 hidden" id="location-error"></div>
                                </div>
                                
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                        Phone Number
                                    </label>
                                    <input type="tel" 
                                           id="phone" 
                                           name="phone"
                                           value="{{ old('phone', $department->phone) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <div class="text-red-500 text-sm mt-1 hidden" id="phone-error"></div>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email
                                    </label>
                                    <input type="email" 
                                           id="email" 
                                           name="email"
                                           value="{{ old('email', $department->email) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <div class="text-red-500 text-sm mt-1 hidden" id="email-error"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Form Actions --}}
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                            <a href="{{ route('staff.departments.index') }}" 
                               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Cancel
                            </a>
                            <button type="submit" 
                                    id="submit-button"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <span id="submit-text">Update Department</span>
                                <svg class="hidden animate-spin -ml-1 mr-3 h-5 w-5 text-white" id="submit-spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
