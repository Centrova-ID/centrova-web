@extends('partials.layouts.office')

@section('title', 'Staff')

@section('content')
@php
    $search = request('search', '');
    $selectedStaffUid = request('uid', null);
    
    // Ensure departments variable exists, if not load it
    if (!isset($departments)) {
        $departments = \App\Models\Department::where('status', 'active')->orderBy('name', 'asc')->get();
    }
    
    // Filter staff berdasarkan search
    $filteredStaff = $staffUsers;
    if (!empty($search)) {
        $filteredStaff = $staffUsers->filter(function($staff) use ($search) {
            $roleLabels = [
                'admin' => 'Administrator',
                'manager' => 'Manager',
                'supervisor' => 'Supervisor',
                'developer' => 'Developer',
                'customer_service' => 'Customer Service',
                'marketing' => 'Marketing'
            ];
            $roleLabel = $roleLabels[$staff->role] ?? str_replace('_', ' ', ucwords($staff->role));
            
            return stripos($staff->name, $search) !== false ||
                   stripos($staff->email, $search) !== false ||
                   stripos($roleLabel, $search) !== false;
        });
    }
    
    // Get selected staff data (passed from controller or find by UID)
    $selectedStaff = $selectedStaff ?? null;
    if (!$selectedStaff && $selectedStaffUid) {
        $selectedStaff = $staffUsers->firstWhere('staff_uid', $selectedStaffUid);
    }
@endphp

<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen">
        {{-- Left Panel - Staff List --}}
        <div class="w-[24rem] bg-white border-r border-gray-200 flex flex-col">
            {{-- Header --}}
            <div class="px-4 pt-4">
                <form method="GET" action="{{ url()->current() }}" class="flex items-center justify-between space-x-2">
                    @if($selectedStaffUid)
                        <input type="hidden" name="uid" value="{{ $selectedStaffUid }}">
                    @endif
                    {{-- Search --}}
                    <div class="relative w-full">
                        <input type="text" 
                               name="search"
                               value="{{ $search }}"
                               placeholder="Search staff..." 
                               class="w-full pl-8 pr-3 border border-neutral-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent h-[32px]"
                               autocomplete="off"
                               onchange="this.form.submit()">
                        <svg class="absolute left-2.5 top-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <button type="button" class="h-[32px] flex justify-center items-center aspect-square rounded-lg hover:bg-neutral-100">
                        <svg class="h-[24px] text-neutral-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C10.0222 2 8.08879 2.58649 6.4443 3.6853C4.79981 4.78412 3.51809 6.3459 2.76121 8.17317C2.00433 10.0004 1.8063 12.0111 2.19215 13.9509C2.578 15.8907 3.53041 17.6725 4.92894 19.0711C6.32746 20.4696 8.10929 21.422 10.0491 21.8079C11.9889 22.1937 13.9996 21.9957 15.8268 21.2388C17.6541 20.4819 19.2159 19.2002 20.3147 17.5557C21.4135 15.9112 22 13.9778 22 12C22 10.6868 21.7413 9.38642 21.2388 8.17317C20.7363 6.95991 19.9997 5.85752 19.0711 4.92893C18.1425 4.00035 17.0401 3.26375 15.8268 2.7612C14.6136 2.25866 13.3132 2 12 2ZM12 20C10.4178 20 8.87104 19.5308 7.55544 18.6518C6.23985 17.7727 5.21447 16.5233 4.60897 15.0615C4.00347 13.5997 3.84504 11.9911 4.15372 10.4393C4.4624 8.88743 5.22433 7.46197 6.34315 6.34315C7.46197 5.22433 8.88743 4.4624 10.4393 4.15372C11.9911 3.84504 13.5997 4.00346 15.0615 4.60896C16.5233 5.21447 17.7727 6.23984 18.6518 7.55544C19.5308 8.87103 20 10.4177 20 12C20 14.1217 19.1572 16.1566 17.6569 17.6569C16.1566 19.1571 14.1217 20 12 20Z" fill="currentColor"/>
                        <path d="M11 13H9C8.73479 13 8.48043 12.8946 8.2929 12.7071C8.10536 12.5196 8 12.2652 8 12C8 11.7348 8.10536 11.4804 8.2929 11.2929C8.48043 11.1054 8.73479 11 9 11H11V9C11 8.73478 11.1054 8.48043 11.2929 8.29289C11.4804 8.10536 11.7348 8 12 8C12.2652 8 12.5196 8.10536 12.7071 8.29289C12.8946 8.48043 13 8.73478 13 9V11H15C15.2652 11 15.5196 11.1054 15.7071 11.2929C15.8946 11.4804 16 11.7348 16 12C16 12.2652 15.8946 12.5196 15.7071 12.7071C15.5196 12.8946 15.2652 13 15 13H13V15C13 15.2652 12.8946 15.5196 12.7071 15.7071C12.5196 15.8946 12.2652 16 12 16C11.7348 16 11.4804 15.8946 11.2929 15.7071C11.1054 15.5196 11 15.2652 11 15V13Z" fill="currentColor"/>
                        </svg>
                    </button>
                </form>
            </div>

            {{-- Staff List --}}
            <div class="flex-1 overflow-y-auto px-4 py-2">
                @if($filteredStaff->count() > 0)
                    @foreach($filteredStaff as $index => $staff)
                        @php
                            $isSelected = $selectedStaffUid == $staff->staff_uid;
                            $itemClass = $isSelected 
                                ? 'staff-item block p-3 rounded-xl cursor-pointer bg-blue-500 text-white' 
                                : 'staff-item block p-3 rounded-xl cursor-pointer hover:bg-neutral-100';
                            $nameClass = $isSelected 
                                ? 'staff-name text-base font-medium text-white truncate' 
                                : 'staff-name text-base font-medium text-slate-800 truncate';
                            $roleClass = $isSelected 
                                ? 'staff-role text-[13px] font-medium text-white mt-0.5' 
                                : 'staff-role text-[13px] font-medium text-slate-600 mt-0.5';
                        @endphp
                        
                        <a href="{{ url()->current() }}?{{ http_build_query(array_filter(array_merge(request()->except(['staff_id']), ['uid' => $staff->staff_uid]))) }}" 
                           class="{{ $itemClass }}">
                            <div class="flex items-center space-x-3">
                                <x-user-avatar :user="$staff" size="base" class="flex-shrink-0" />
                                
                                <div class="flex-1 min-w-0 -space-y-0.5">
                                    <div class="flex items-center justify-between">
                                        <p class="{{ $nameClass }}">{{ $staff->name }}</p>
                                    </div>
                                    <p class="{{ $roleClass }}">
                                        @php
                                            $roleLabels = [
                                                'admin' => 'Administrator',
                                                'manager' => 'Manager',
                                                'supervisor' => 'Supervisor',
                                                'developer' => 'Developer',
                                                'customer_service' => 'Customer Service',
                                                'marketing' => 'Marketing'
                                            ];
                                            echo $roleLabels[$staff->role] ?? str_replace('_', ' ', ucwords($staff->role));
                                        @endphp
                                    </p>
                                </div>
                            </div>
                        </a>
                        
                        {{-- Add separator between items (not after the last item) --}}
                        @if($index < $filteredStaff->count() - 1)
                            <hr class="border-0.5 w-[77.75%] border-neutral-100 ml-auto mr-3.5">
                        @endif
                    @endforeach
                @else
                    <div class="flex flex-col items-center justify-center h-64 text-gray-500">
                        <svg class="h-12 w-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <p class="font-medium">
                            @if(!empty($search))
                                No staff members found for "{{ $search }}"
                            @else
                                No staff members available
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Right Panel - Staff Details --}}
        <div class="flex-1 bg-white flex flex-col overflow-y-auto">
            @if($selectedStaff)
                {{-- Profile Section --}}
                <div class="px-6 pt-16 pb-8 bg-gray-50">
                    <div class="flex flex-col items-center text-center w-full max-w-5xl mx-auto">
                        @if($selectedStaff->id === auth()->id())
                            <x-user-avatar 
                                :user="$selectedStaff" 
                                size="3xl" 
                                class="mb-5" 
                                clickable
                                :href="route('profile.index')"
                                showEditIcon
                            />
                        @else
                            <x-user-avatar 
                                :user="$selectedStaff" 
                                size="3xl" 
                                class="mb-5" 
                            />
                        @endif
                        <h3 class="text-2xl font-semibold text-gray-900 mb-1">{{ $selectedStaff->name }}</h3>
                        <p class="text-gray-600 mb-5">{{ $selectedStaff->email }}</p>
                        @if($selectedStaff->id === auth()->id())
                        @else
                            {{-- View Mode Actions --}}
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
                                        id="reset-password-button"
                                        class="rounded-xl px-6 py-3 border border-gray-200/60 bg-white hover:bg-white/60 pb-2.5 border-b-gray-300/80 flex flex-col justify-center items-center w-full whitespace-nowrap duration-100">
                                    <svg class="h-[18px]" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.7101 4.52994L18.2901 3.11994L19.7101 1.70994C19.8984 1.52164 20.0042 1.26624 20.0042 0.999941C20.0042 0.73364 19.8984 0.478245 19.7101 0.289941C19.5218 0.101637 19.2664 -0.00415039 19.0001 -0.00415039C18.7338 -0.00415039 18.4784 0.101637 18.2901 0.289941L7.7501 10.8299C6.71614 10.1478 5.46577 9.87371 4.24126 10.0608C3.01676 10.248 1.90532 10.883 1.12228 11.8428C0.33925 12.8026 -0.0596152 14.0189 0.00297313 15.2561C0.0655615 16.4932 0.585148 17.6631 1.46105 18.539C2.33696 19.4149 3.50682 19.9345 4.74395 19.9971C5.98109 20.0597 7.19741 19.6608 8.15725 18.8778C9.11708 18.0947 9.75208 16.9833 9.93921 15.7588C10.1263 14.5343 9.85226 13.2839 9.1701 12.2499L14.0501 7.35994L15.4601 8.77994C15.5535 8.87262 15.6644 8.94595 15.7862 8.99571C15.908 9.04548 16.0385 9.0707 16.1701 9.06994C16.3017 9.0707 16.4322 9.04548 16.554 8.99571C16.6758 8.94595 16.7867 8.87262 16.8801 8.77994C16.9738 8.68698 17.0482 8.57638 17.099 8.45452C17.1498 8.33266 17.1759 8.20195 17.1759 8.06994C17.1759 7.93793 17.1498 7.80722 17.099 7.68537C17.0482 7.56351 16.9738 7.4529 16.8801 7.35994L15.4601 5.99994L16.8801 4.57994L18.2901 5.99994C18.3835 6.09262 18.4944 6.16595 18.6162 6.21571C18.738 6.26548 18.8685 6.2907 19.0001 6.28994C19.1317 6.2907 19.2622 6.26548 19.384 6.21571C19.5058 6.16595 19.6167 6.09262 19.7101 5.99994C19.8116 5.9063 19.8926 5.79265 19.948 5.66615C20.0034 5.53965 20.032 5.40304 20.032 5.26494C20.032 5.12684 20.0034 4.99023 19.948 4.86374C19.8926 4.73724 19.8116 4.62358 19.7101 4.52994V4.52994ZM5.0001 17.9999C4.40675 17.9999 3.82673 17.824 3.33339 17.4944C2.84004 17.1647 2.45552 16.6962 2.22846 16.148C2.0014 15.5998 1.94199 14.9966 2.05774 14.4147C2.1735 13.8327 2.45922 13.2982 2.87878 12.8786C3.29833 12.4591 3.83288 12.1733 4.41483 12.0576C4.99677 11.9418 5.59997 12.0012 6.14815 12.2283C6.69632 12.4554 7.16486 12.8399 7.4945 13.3332C7.82415 13.8266 8.0001 14.4066 8.0001 14.9999C8.0001 15.7956 7.68403 16.5587 7.12142 17.1213C6.55881 17.6839 5.79575 17.9999 5.0001 17.9999Z" fill="#EF4444"/>
                                    </svg>
                                    <span class="text-red-500 mt-1 text-[15px]">Reset Password</span>
                                </button>

                                <button type="button" 
                                        id="suspend-toggle-button"
                                        data-status="{{ ($selectedStaff->status ?? 'active') }}"
                                        data-uid="{{ $selectedStaff->staff_uid }}"
                                        class="rounded-xl px-6 py-3 border border-gray-200/60 bg-white hover:bg-white/60 pb-2.5 border-b-gray-300/80 flex flex-col justify-center items-center w-full whitespace-nowrap duration-100">
                                    @if(($selectedStaff->status ?? 'active') === 'active')
                                        <svg class="h-[18px]" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 0C8.02219 0 6.08879 0.58649 4.4443 1.6853C2.79981 2.78412 1.51809 4.3459 0.761209 6.17317C0.00433284 8.00043 -0.193701 10.0111 0.192152 11.9509C0.578004 13.8907 1.53041 15.6725 2.92894 17.0711C4.32746 18.4696 6.10929 19.422 8.0491 19.8079C9.98891 20.1937 11.9996 19.9957 13.8268 19.2388C15.6541 18.4819 17.2159 17.2002 18.3147 15.5557C19.4135 13.9112 20 11.9778 20 10C20 8.68678 19.7413 7.38642 19.2388 6.17317C18.7363 4.95991 17.9997 3.85752 17.0711 2.92893C16.1425 2.00035 15.0401 1.26375 13.8268 0.761205C12.6136 0.258658 11.3132 0 10 0V0ZM10 18C7.87827 18 5.84344 17.1571 4.34315 15.6569C2.84286 14.1566 2 12.1217 2 10C1.9978 8.22334 2.59302 6.49755 3.69 5.1L14.9 16.31C13.5025 17.407 11.7767 18.0022 10 18V18ZM16.31 14.9L5.1 3.69C6.49755 2.59302 8.22335 1.99779 10 2C12.1217 2 14.1566 2.84285 15.6569 4.34315C17.1572 5.84344 18 7.87827 18 10C18.0022 11.7767 17.407 13.5025 16.31 14.9Z" fill="#EF4444"/>
                                        </svg>
                                        <span class="text-red-500 mt-1 text-[15px]">Suspend</span>
                                    @else
                                        <svg class="h-[20px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span class="text-green-500 mt-1 text-[15px]">Activate</span>
                                    @endif
                                </button>
                            </div>

                            {{-- Edit Mode Actions --}}
                            <div id="edit-actions" class="hidden w-full max-w-xs">
                                <div class="flex justify-center items-center gap-x-3 w-full">
                                    <button type="button" 
                                            id="save-button"
                                            class="rounded-xl px-6 py-3 border border-blue-200/60 bg-[#128AEB] hover:bg-[#0f75c6] pb-2.5 border-b-blue-600/80 flex flex-col justify-center items-center w-full whitespace-nowrap duration-100">
                                        <svg class="h-[18px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 21H5C4.73478 21 4.48043 20.8946 4.29289 20.7071C4.10536 20.5196 4 20.2652 4 20V4C4 3.73478 4.10536 3.48043 4.29289 3.29289C4.48043 3.10536 4.73478 3 5 3H16L20 7V20C20 20.2652 19.8946 20.5196 19.7071 20.7071C19.5196 20.8946 19.2652 21 19 21ZM17 19V10H7V19H17ZM15 19V12H9V19H15ZM6 5V8H15V5H6Z" fill="white"/>
                                        </svg>
                                        <span class="text-white mt-1 text-[15px]">Save</span>
                                    </button>
                                    <button type="button" 
                                            id="cancel-button"
                                            class="rounded-xl px-6 py-3 border border-gray-200/60 bg-white hover:bg-white/60 pb-2.5 border-b-gray-300/80 flex flex-col justify-center items-center w-full whitespace-nowrap duration-100">
                                        <svg class="h-[18px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.22566 4.81096C5.83514 4.42044 5.20197 4.42044 4.81145 4.81096C4.42092 5.20148 4.42092 5.83465 4.81145 6.22517L10.5862 11.9999L4.81151 17.7746C4.42098 18.1651 4.42098 18.7983 4.81151 19.1888C5.20203 19.5793 5.8352 19.5793 6.22572 19.1888L12.0004 13.4141L17.7751 19.1888C18.1656 19.5793 18.7988 19.5793 19.1893 19.1888C19.5798 18.7983 19.5798 18.1651 19.1893 17.7746L13.4146 11.9999L19.1893 6.22517C19.5798 5.83465 19.5798 5.20148 19.1893 4.81096C18.7988 4.42044 18.1656 4.42044 17.7751 4.81096L12.0004 10.5857L6.22566 4.81096Z" fill="#6B7280"/>
                                        </svg>
                                        <span class="text-gray-600 mt-1 text-[15px]">Cancel</span>
                                    </button>
                                </div>
                            </div>

                            {{-- Reset Password Mode Actions --}}
                            <div id="reset-password-actions" class="hidden w-full max-w-xs">
                                <div class="flex justify-center items-center gap-x-3 w-full">
                                    <button type="button" 
                                            id="reset-password-save-button"
                                            class="rounded-xl px-6 py-3 border border-red-200/60 bg-red-500 hover:bg-red-600 pb-2.5 border-b-red-600/80 flex flex-col justify-center items-center w-full whitespace-nowrap duration-100">
                                        <svg class="h-[18px]" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.7101 4.52994L18.2901 3.11994L19.7101 1.70994C19.8984 1.52164 20.0042 1.26624 20.0042 0.999941C20.0042 0.73364 19.8984 0.478245 19.7101 0.289941C19.5218 0.101637 19.2664 -0.00415039 19.0001 -0.00415039C18.7338 -0.00415039 18.4784 0.101637 18.2901 0.289941L7.7501 10.8299C6.71614 10.1478 5.46577 9.87371 4.24126 10.0608C3.01676 10.248 1.90532 10.883 1.12228 11.8428C0.33925 12.8026 -0.0596152 14.0189 0.00297313 15.2561C0.0655615 16.4932 0.585148 17.6631 1.46105 18.539C2.33696 19.4149 3.50682 19.9345 4.74395 19.9971C5.98109 20.0597 7.19741 19.6608 8.15725 18.8778C9.11708 18.0947 9.75208 16.9833 9.93921 15.7588C10.1263 14.5343 9.85226 13.2839 9.1701 12.2499L14.0501 7.35994L15.4601 8.77994C15.5535 8.87262 15.6644 8.94595 15.7862 8.99571C15.908 9.04548 16.0385 9.0707 16.1701 9.06994C16.3017 9.0707 16.4322 9.04548 16.554 8.99571C16.6758 8.94595 16.7867 8.87262 16.8801 8.77994C16.9738 8.68698 17.0482 8.57638 17.099 8.45452C17.1498 8.33266 17.1759 8.20195 17.1759 8.06994C17.1759 7.93793 17.1498 7.80722 17.099 7.68537C17.0482 7.56351 16.9738 7.4529 16.8801 7.35994L15.4601 5.99994L16.8801 4.57994L18.2901 5.99994C18.3835 6.09262 18.4944 6.16595 18.6162 6.21571C18.738 6.26548 18.8685 6.2907 19.0001 6.28994C19.1317 6.2907 19.2622 6.26548 19.384 6.21571C19.5058 6.16595 19.6167 6.09262 19.7101 5.99994C19.8116 5.9063 19.8926 5.79265 19.948 5.66615C20.0034 5.53965 20.032 5.40304 20.032 5.26494C20.032 5.12684 20.0034 4.99023 19.948 4.86374C19.8926 4.73724 19.8116 4.62358 19.7101 4.52994V4.52994ZM5.0001 17.9999C4.40675 17.9999 3.82673 17.824 3.33339 17.4944C2.84004 17.1647 2.45552 16.6962 2.22846 16.148C2.0014 15.5998 1.94199 14.9966 2.05774 14.4147C2.1735 13.8327 2.45922 13.2982 2.87878 12.8786C3.29833 12.4591 3.83288 12.1733 4.41483 12.0576C4.99677 11.9418 5.59997 12.0012 6.14815 12.2283C6.69632 12.4554 7.16486 12.8399 7.4945 13.3332C7.82415 13.8266 8.0001 14.4066 8.0001 14.9999C8.0001 15.7956 7.68403 16.5587 7.12142 17.1213C6.55881 17.6839 5.79575 17.9999 5.0001 17.9999Z" fill="white"/>
                                        </svg>
                                        <span class="text-white mt-1 text-[15px]">Reset Password</span>
                                    </button>
                                    <button type="button" 
                                            id="reset-password-cancel-button"
                                            class="rounded-xl px-6 py-3 border border-gray-200/60 bg-white hover:bg-white/60 pb-2.5 border-b-gray-300/80 flex flex-col justify-center items-center w-full whitespace-nowrap duration-100">
                                        <svg class="h-[18px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.22566 4.81096C5.83514 4.42044 5.20197 4.42044 4.81145 4.81096C4.42092 5.20148 4.42092 5.83465 4.81145 6.22517L10.5862 11.9999L4.81151 17.7746C4.42098 18.1651 4.42098 18.7983 4.81151 19.1888C5.20203 19.5793 5.8352 19.5793 6.22572 19.1888L12.0004 13.4141L17.7751 19.1888C18.1656 19.5793 18.7988 19.5793 19.1893 19.1888C19.5798 18.7983 19.5798 18.1651 19.1893 17.7746L13.4146 11.9999L19.1893 6.22517C19.5798 5.83465 19.5798 5.20148 19.1893 4.81096C18.7988 4.42044 18.1656 4.42044 17.7751 4.81096L12.0004 10.5857L6.22566 4.81096Z" fill="#6B7280"/>
                                        </svg>
                                        <span class="text-gray-600 mt-1 text-[15px]">Cancel</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Information Details --}}
                <div class="w-full bg-white">
                    <div class="flex-1 overflow-y-auto w-full max-w-4xl mx-auto">
                        {{-- Tabs --}}
                        <div class="w-full grid grid-cols-2" id="staff-tabs">
                            <button type="button" class="tab-button w-full h-[44px] flex justify-center items-center text-center border-b-2 border-b-[#128aeb] text-[#128aeb] font-medium" data-tab="overview">Overview</button>
                            <button type="button" class="tab-button w-full h-[44px] flex justify-center items-center text-center border-b-2 border-b-transparent text-gray-500 hover:bg-neutral-100 hover:text-gray-700" data-tab="details">Details</button>
                        </div>

                        {{-- Edit Form (Hidden by default) --}}
                        <div id="edit-form" class="hidden py-5">
                            <form id="staff-edit-form" action="{{ route('staff.management.staff.update', $selectedStaff->staff_uid) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                {{-- Basic Information --}}
                                <div class="bg-white w-full mb-6">
                                    <div class="px-6 pt-4 pb-2">
                                        <h4 class="text-base font-semibold text-slate-900">Basic Information</h4>
                                    </div>
                                    <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                                        {{-- Name --}}
                                        <div>
                                            <label for="edit-name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                            <input type="text" 
                                                   id="edit-name" 
                                                   name="name" 
                                                   value="{{ $selectedStaff->name }}"
                                                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>

                                        {{-- Email (Disabled) --}}
                                        <div>
                                            <label for="edit-email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                            <input type="email" 
                                                   id="edit-email" 
                                                   name="email" 
                                                   value="{{ $selectedStaff->email }}"
                                                   disabled
                                                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 text-gray-500 cursor-not-allowed">
                                            <p class="text-xs text-gray-500 mt-1">Email cannot be changed</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Work Information --}}
                                <div class="bg-white w-full mb-6">
                                    <div class="px-6 pt-4 pb-2">
                                        <h4 class="text-base font-semibold text-slate-900">Work Information</h4>
                                    </div>
                                    <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                                        {{-- Department --}}
                                        @php
                                            // Debug values
                                            $debugDeptId = $selectedStaff->department_id ?? 'NULL';
                                            $debugDeptName = $selectedStaff->department ? $selectedStaff->department->name : 'NO_DEPARTMENT';
                                        @endphp
                                        {{-- DEBUG: Dept ID: {{ $debugDeptId }}, Dept Name: {{ $debugDeptName }} --}}
                                        <div x-data="{ 
                                            departmentDropdownOpen: false, 
                                            selectedDepartment: '{{ $selectedStaff->department_id ?? '' }}',
                                            selectedDepartmentLabel: '{{ $selectedStaff->department ? $selectedStaff->department->name : 'Belum Ada Departemen Terpilih' }}',
                                            departmentOptions: [
                                                @foreach($departments as $dept)
                                                { value: '{{ $dept->id }}', label: '{{ $dept->name }}' },
                                                @endforeach
                                            ],
                                            selectDepartment(option) {
                                                this.selectedDepartment = option.value;
                                                this.selectedDepartmentLabel = option.label;
                                                this.departmentDropdownOpen = false;
                                            }
                                        }">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                                            <input type="hidden" name="department_id" :value="selectedDepartment">
                                            <div class="relative">
                                                <div @click="departmentDropdownOpen = !departmentDropdownOpen" 
                                                     class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white cursor-pointer flex items-center justify-between">
                                                    <span x-text="selectedDepartmentLabel" class="text-gray-900" :class="{ 'text-gray-500': !selectedDepartment }"></span>
                                                    <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': departmentDropdownOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </div>
                                                <div x-show="departmentDropdownOpen" @click.away="departmentDropdownOpen = false" x-transition 
                                                     class="absolute z-10 w-full mt-1 bg-white border border-gray-300 px-1 rounded-md shadow-lg max-h-60 overflow-auto">
                                                    <div class="py-1 space-y-1">
                                                        <div @click="selectDepartment({ value: '', label: 'Belum Ada Departemen Terpilih' })" 
                                                             class="px-3 py-2 hover:bg-neutral-100 cursor-pointer rounded-md"
                                                             :class="{ 'bg-[#128AEB] text-white hover:bg-[#128AEB]': selectedDepartment === '' }">
                                                            <span>Tidak Ada Departemen</span>
                                                        </div>
                                                        <template x-for="option in departmentOptions" :key="option.value">
                                                            <div @click="selectDepartment(option)" 
                                                                 class="px-3 py-2 hover:bg-neutral-100 cursor-pointer rounded-md" 
                                                                 :class="{ 'bg-[#128AEB] text-white hover:bg-[#128AEB]': selectedDepartment == option.value }">
                                                                <span x-text="option.label"></span>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Role --}}
                                        <div x-data="{ 
                                            roleDropdownOpen: false, 
                                            selectedRole: '{{ $selectedStaff->role }}',
                                            selectedRoleLabel: '{{ $selectedStaff->role ? ucfirst(str_replace('_', ' ', $selectedStaff->role)) : 'Select Role' }}',
                                            roleOptions: [
                                                { value: 'admin', label: 'Administrator' },
                                                { value: 'manager', label: 'Manager' },
                                                { value: 'supervisor', label: 'Supervisor' },
                                                { value: 'developer', label: 'Developer' },
                                                { value: 'customer_service', label: 'Customer Service' },
                                                { value: 'marketing', label: 'Marketing' }
                                            ],
                                            selectRole(option) {
                                                this.selectedRole = option.value;
                                                this.selectedRoleLabel = option.label;
                                                this.roleDropdownOpen = false;
                                            }
                                        }">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Position/Role</label>
                                            <input type="hidden" name="role" :value="selectedRole">
                                            <div class="relative">
                                                <div @click="roleDropdownOpen = !roleDropdownOpen" 
                                                     class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white cursor-pointer flex items-center justify-between">
                                                    <span x-text="selectedRoleLabel" class="text-gray-900" :class="{ 'text-gray-500': !selectedRole }"></span>
                                                    <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': roleDropdownOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </div>
                                                <div x-show="roleDropdownOpen" @click.away="roleDropdownOpen = false" x-transition 
                                                     class="absolute z-10 w-full mt-1 bg-white border border-gray-300 px-1 rounded-md shadow-lg max-h-60 overflow-auto">
                                                    <div class="py-1 space-y-1">
                                                        <div @click="selectedRole ? null : selectRole({ value: '', label: 'Select Role' })" 
                                                             class="px-3 py-2 rounded-md"
                                                             :class="selectedRole ? 'text-gray-400 cursor-not-allowed' : 'hover:bg-neutral-100 cursor-pointer'">
                                                            <span>Select Role</span>
                                                        </div>
                                                        <template x-for="option in roleOptions" :key="option.value">
                                                            <div @click="selectRole(option)" 
                                                                 class="px-3 py-2 hover:bg-neutral-100 cursor-pointer rounded-md" 
                                                                 :class="{ 'bg-[#128AEB] text-white hover:bg-[#128AEB]': selectedRole === option.value }">
                                                                <span x-text="option.label"></span>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Username --}}
                                        <div>
                                            <label for="edit-username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                                            <input type="text" 
                                                   id="edit-username" 
                                                   name="username" 
                                                   value="{{ $selectedStaff->username ?? '' }}"
                                                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>

                                        {{-- Work Location --}}
                                        <div>
                                            <label for="edit-location" class="block text-sm font-medium text-gray-700 mb-2">Work Location</label>
                                            <input type="text" 
                                                   id="edit-location" 
                                                   name="location" 
                                                   value="{{ $selectedStaff->location ?? '' }}"
                                                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </div>

                                {{-- Additional Information --}}
                                <div class="bg-white w-full mb-6">
                                    <div class="px-6 pt-4 pb-2">
                                        <h4 class="text-base font-semibold text-slate-900">Additional Information</h4>
                                    </div>
                                    <div class="px-6 py-4 grid grid-cols-1 gap-6">
                                        {{-- Bio --}}
                                        <div>
                                            <label for="edit-bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                                            <textarea id="edit-bio" 
                                                      name="bio" 
                                                      rows="4"
                                                      class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                      placeholder="Enter staff bio/description">{{ $selectedStaff->bio ?? $selectedStaff->about ?? $selectedStaff->description ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- Reset Password Form (Hidden by default) --}}
                        <div id="reset-password-form" class="hidden py-5">
                            <form id="staff-reset-password-form" action="{{ route('staff.management.staff.reset-password', $selectedStaff->staff_uid) }}" method="POST">
                                @csrf
                                
                                {{-- Reset Password Section --}}
                                <div class="bg-white w-full mb-6">
                                    <div class="px-6 pt-4 pb-2">
                                        <h4 class="text-base font-semibold text-slate-900">Reset Password</h4>
                                        <p class="text-sm text-gray-600 mt-1">Enter a new password for this staff member</p>
                                    </div>
                                    <div class="px-6 py-4 space-y-6">
                                        {{-- New Password --}}
                                        <div>
                                            <label for="new-password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                            <input type="password" 
                                                   id="new-password" 
                                                   name="password" 
                                                   required
                                                   minlength="8"
                                                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="Enter new password (minimum 8 characters)">
                                        </div>

                                        {{-- Confirm Password --}}
                                        <div>
                                            <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                                            <input type="password" 
                                                   id="confirm-password" 
                                                   name="password_confirmation" 
                                                   required
                                                   minlength="8"
                                                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="Confirm new password">
                                        </div>

                                        {{-- Password Requirements --}}
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <h5 class="text-sm font-medium text-gray-700 mb-2">Password Requirements:</h5>
                                            <ul class="text-xs text-gray-600 space-y-1">
                                                <li>• Minimum 8 characters</li>
                                                <li>• Mix of uppercase and lowercase letters</li>
                                                <li>• At least one number</li>
                                                <li>• At least one special character</li>
                                            </ul>
                                        </div>

                                        {{-- Send Notification Option --}}
                                        <div class="flex items-center">
                                            <input type="checkbox" 
                                                   id="send-notification" 
                                                   name="send_notification" 
                                                   value="1"
                                                   checked
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="send-notification" class="ml-2 block text-sm text-gray-700">
                                                Send password reset notification to staff member
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- Tab Content --}}
                        <div class="tab-content" id="overview-content">
                            {{-- About Section --}}
                            @if(!empty($selectedStaff->about) || !empty($selectedStaff->bio) || !empty($selectedStaff->description))
                            <div class="bg-white w-full mb-2">
                                <div class="px-6 pt-2">
                                    <h4 class="text-base font-normal text-slate-500">About</h4>
                                </div>
                                <div class="px-6 py-2">
                                    <p class="text-slate-900 text-base leading-relaxed">
                                        {{ $selectedStaff->about ?? $selectedStaff->bio ?? $selectedStaff->description }}
                                    </p>
                                </div>
                            </div>
                            @endif

                            {{-- Contact Information --}}
                            @php
                                $hasEmail = !empty($selectedStaff->email);
                                $hasPhone = !empty($selectedStaff->phone) || !empty($selectedStaff->phone_number) || !empty($selectedStaff->mobile) || !empty($selectedStaff->contact_number);
                                $phoneNumber = $selectedStaff->phone ?? $selectedStaff->phone_number ?? $selectedStaff->mobile ?? $selectedStaff->contact_number ?? null;
                                
                                // Debug: uncomment to see available data
                                // dd($selectedStaff->toArray());
                            @endphp
                            
                            @if($hasEmail || $hasPhone)
                            <div class="bg-white w-full mb-2">
                                <div class="px-6 py-2 grid grid-cols-1 @if($hasEmail && $hasPhone) md:grid-cols-2 @endif gap-6">
                                    @if($hasEmail)
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Email</p>
                                            <p class="text-slate-900 text-base leading-relaxed">{{ $selectedStaff->email }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($hasPhone)
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Phone number</p>
                                            <p class="text-slate-900 text-base leading-relaxed">{{ $phoneNumber }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            {{-- Account Details --}}
                            @php
                                $hasCreatedDate = !empty($selectedStaff->created_at);
                                $hasUpdatedDate = !empty($selectedStaff->updated_at);
                                $hasStaffUID = !empty($selectedStaff->staff_uid);
                            @endphp
                            
                            @if($hasCreatedDate || $hasUpdatedDate || $hasStaffUID)
                            <div class="bg-white w-full mb-2">
                                <div class="px-6 py-2 grid grid-cols-1 @if(($hasCreatedDate && $hasUpdatedDate) || ($hasStaffUID && ($hasCreatedDate || $hasUpdatedDate))) md:grid-cols-2 @endif gap-6">
                                    @if($hasStaffUID)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div>
                                                <p class="text-sm text-gray-500">Staff ID</p>
                                                <p class="text-slate-900 text-base leading-relaxed font-mono">
                                                    {{ $selectedStaff->staff_uid }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($hasCreatedDate)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div>
                                                <p class="text-sm text-gray-500">Account created</p>
                                                <p class="text-slate-900 text-base leading-relaxed">
                                                    {{ $selectedStaff->created_at->format('M j, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($hasUpdatedDate)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div>
                                                <p class="text-sm text-gray-500">Last updated</p>
                                                <p class="text-slate-900 text-base leading-relaxed">
                                                    {{ $selectedStaff->updated_at->format('M j, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            {{-- Role Information --}}
                            @if(!empty($selectedStaff->role))
                            <div class="bg-white w-full mb-2">
                                <div class="px-6 py-2">
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Role</p>
                                            <p class="text-slate-900 text-base leading-relaxed">
                                                @php
                                                    $roleLabels = [
                                                        'admin' => 'Administrator',
                                                        'manager' => 'Manager',
                                                        'supervisor' => 'Supervisor',
                                                        'developer' => 'Developer',
                                                        'customer_service' => 'Customer Service',
                                                        'marketing' => 'Marketing'
                                                    ];
                                                @endphp
                                                {{ $roleLabels[$selectedStaff->role] ?? str_replace('_', ' ', ucwords($selectedStaff->role)) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            {{-- Additional Information Sections --}}
                            {{-- Department Display --}}
                            @if($selectedStaff->department_id && $selectedStaff->department)
                            <div class="bg-white w-full mb-2">
                                <div class="px-6 py-2">
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Department</p>
                                            <p class="text-slate-900 text-base leading-relaxed">
                                                {{ $selectedStaff->department->name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            @php
                                $additionalFields = [
                                    'position' => 'Position',
                                    'employee_id' => 'Employee ID',
                                    'join_date' => 'Join Date',
                                    'location' => 'Location',
                                    'address' => 'Address',
                                    'city' => 'City',
                                    'postal_code' => 'Postal Code',
                                    'emergency_contact' => 'Emergency Contact',
                                    'birth_date' => 'Birth Date',
                                    'gender' => 'Gender',
                                    'nationality' => 'Nationality',
                                    'username' => 'Username'
                                ];
                            @endphp

                            @foreach($additionalFields as $field => $label)
                                @if(!empty($selectedStaff->$field))
                                <div class="bg-white w-full mb-2">
                                    <div class="px-6 py-2">
                                        <div class="flex items-center">
                                            <div>
                                                <p class="text-sm text-gray-500">{{ $label }}</p>
                                                <p class="text-slate-900 text-base leading-relaxed">
                                                    @if(in_array($field, ['join_date', 'birth_date']) && $selectedStaff->$field instanceof \Carbon\Carbon)
                                                        {{ $selectedStaff->$field->format('M j, Y') }}
                                                    @elseif(in_array($field, ['join_date', 'birth_date']) && !empty($selectedStaff->$field))
                                                        {{ \Carbon\Carbon::parse($selectedStaff->$field)->format('M j, Y') }}
                                                    @elseif($field === 'gender')
                                                        {{ ucfirst($selectedStaff->$field) }}
                                                    @else
                                                        {{ $selectedStaff->$field }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>

                        {{-- Details Tab Content --}}
                        <div class="tab-content hidden" id="details-content">
                            {{-- Personal Information --}}
                            @if(!empty($selectedStaff->full_name) || !empty($selectedStaff->username) || !empty($selectedStaff->birth_date) || !empty($selectedStaff->gender) || !empty($selectedStaff->country))
                            <div class="bg-white w-full mb-2">
                                <div class="px-6 pt-2">
                                    <h4 class="text-base font-normal text-slate-500">Personal Information</h4>
                                </div>
                                <div class="px-6 py-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @if(!empty($selectedStaff->full_name))
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Full Legal Name</p>
                                            <p class="text-slate-900 text-base leading-relaxed">{{ $selectedStaff->full_name }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if(!empty($selectedStaff->username))
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Username</p>
                                            <p class="text-slate-900 text-base leading-relaxed font-mono">{{ $selectedStaff->username }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if(!empty($selectedStaff->birth_date))
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Date of Birth</p>
                                            <p class="text-slate-900 text-base leading-relaxed">
                                                @if($selectedStaff->birth_date instanceof \Carbon\Carbon)
                                                    {{ $selectedStaff->birth_date->format('M j, Y') }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($selectedStaff->birth_date)->format('M j, Y') }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if(!empty($selectedStaff->gender))
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Gender</p>
                                            <p class="text-slate-900 text-base leading-relaxed">{{ ucfirst($selectedStaff->gender) }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if(!empty($selectedStaff->country))
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Country</p>
                                            <p class="text-slate-900 text-base leading-relaxed">{{ $selectedStaff->country }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            {{-- Address Information --}}
                            @if(!empty($selectedStaff->address) || !empty($selectedStaff->city) || !empty($selectedStaff->postal_code))
                            <div class="bg-white w-full mb-2">
                                <div class="px-6 pt-2">
                                    <h4 class="text-base font-normal text-slate-500">Address Information</h4>
                                </div>
                                <div class="px-6 py-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @if(!empty($selectedStaff->address))
                                    <div class="flex items-center md:col-span-2">
                                        <div>
                                            <p class="text-sm text-gray-500">Street Address</p>
                                            <p class="text-slate-900 text-base leading-relaxed">{{ $selectedStaff->address }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if(!empty($selectedStaff->city))
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">City</p>
                                            <p class="text-slate-900 text-base leading-relaxed">{{ $selectedStaff->city }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if(!empty($selectedStaff->postal_code))
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Postal Code</p>
                                            <p class="text-slate-900 text-base leading-relaxed">{{ $selectedStaff->postal_code }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            {{-- Account Security --}}
                            @if($selectedStaff->email_verified_at || $selectedStaff->two_factor_confirmed_at || $selectedStaff->password_updated_at || $selectedStaff->last_login_at)
                            <div class="bg-white w-full mb-2">
                                <div class="px-6 pt-2">
                                    <h4 class="text-base font-normal text-slate-500">Account Security</h4>
                                </div>
                                <div class="px-6 py-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Email Verification Status</p>
                                            <p class="text-slate-900 text-base leading-relaxed">
                                                @if($selectedStaff->email_verified_at)
                                                    Verified
                                                @else
                                                    Pending
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Two-Factor Authentication</p>
                                            <p class="text-slate-900 text-base leading-relaxed">
                                                @if($selectedStaff->two_factor_confirmed_at)
                                                    Enabled
                                                @else
                                                    Disabled
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    
                                    @if($selectedStaff->password_updated_at)
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Last Password Update</p>
                                            <p class="text-slate-900 text-base leading-relaxed">
                                                {{ \Carbon\Carbon::parse($selectedStaff->password_updated_at)->format('M j, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($selectedStaff->last_login_at)
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Last Login</p>
                                            <p class="text-slate-900 text-base leading-relaxed">
                                                {{ \Carbon\Carbon::parse($selectedStaff->last_login_at)->format('M j, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            {{-- Notification Preferences --}}
                            <div class="bg-white w-full mb-2">
                                <div class="px-6 pt-2">
                                    <h4 class="text-base font-normal text-slate-500">Notification Preferences</h4>
                                </div>
                                <div class="px-6 py-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Email Notifications</p>
                                            <p class="text-slate-900 text-base leading-relaxed">
                                                @if($selectedStaff->email_notifications ?? true)
                                                    Enabled
                                                @else
                                                    Disabled
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Marketing Emails</p>
                                            <p class="text-slate-900 text-base leading-relaxed">
                                                @if($selectedStaff->marketing_emails ?? false)
                                                    Enabled
                                                @else
                                                    Disabled
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Security Alerts</p>
                                            <p class="text-slate-900 text-base leading-relaxed">
                                                @if($selectedStaff->security_alerts ?? true)
                                                    Enabled
                                                @else
                                                    Disabled
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Staff Updates</p>
                                            <p class="text-slate-900 text-base leading-relaxed">
                                                @if($selectedStaff->staff_updates ?? true)
                                                    Enabled
                                                @else
                                                    Disabled
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- App Preferences --}}
                            <div class="bg-white w-full mb-2">
                                <div class="px-6 pt-2">
                                    <h4 class="text-base font-normal text-slate-500">App Preferences</h4>
                                </div>
                                <div class="px-6 py-2">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 mb-1">Theme Preference</p>
                                            <div class="flex items-center">
                                                @if($selectedStaff->dark_mode ?? false)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-900 text-white">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                                        </svg>
                                                        Dark Mode
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        Light Mode
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        @if(!empty($selectedStaff->messenger_color))
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 mb-1">Messenger Color</p>
                                            <div class="flex items-center">
                                                <div class="w-4 h-4 rounded-full mr-2" style="background-color: {{ $selectedStaff->messenger_color }}"></div>
                                                <span class="text-slate-900 text-base font-mono">{{ $selectedStaff->messenger_color }}</span>
                                            </div>
                                        </div>
                                        @endif
                                        
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 mb-1">Account Status</p>
                                            <div class="flex items-center">
                                                @if(($selectedStaff->status ?? 'active') === 'active')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        Active
                                                    </span>
                                                @elseif(($selectedStaff->status ?? 'active') === 'suspended')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        Suspended
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        {{ ucfirst($selectedStaff->status ?? 'Unknown') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 mb-1">Online Status</p>
                                            <div class="flex items-center">
                                                @if(($selectedStaff->active_status ?? 0) == 1)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <span class="w-2 h-2 mr-1 bg-green-400 rounded-full"></span>
                                                        Online
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        <span class="w-2 h-2 mr-1 bg-gray-400 rounded-full"></span>
                                                        Offline
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Technical Information --}}
                            <div class="bg-white w-full mb-2">
                                <div class="px-6 pt-2">
                                    <h4 class="text-base font-normal text-slate-500">Technical Information</h4>
                                </div>
                                <div class="px-6 py-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">User ID</p>
                                            <p class="text-slate-900 text-base leading-relaxed font-mono">{{ $selectedStaff->id }}</p>
                                        </div>
                                    </div>
                                    
                                    @if(!empty($selectedStaff->staff_uid))
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Staff UID</p>
                                            <p class="text-slate-900 text-base leading-relaxed font-mono">{{ $selectedStaff->staff_uid }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if(!empty($selectedStaff->google_id))
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Google ID</p>
                                            <p class="text-slate-900 text-base leading-relaxed font-mono">{{ $selectedStaff->google_id }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Account Created</p>
                                            <p class="text-slate-900 text-base leading-relaxed">
                                                {{ $selectedStaff->created_at->format('M j, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Last Updated</p>
                                            <p class="text-slate-900 text-base leading-relaxed">
                                                {{ $selectedStaff->updated_at->format('M j, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    @if($selectedStaff->email_verified_at)
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Email Verified At</p>
                                            <p class="text-slate-900 text-base leading-relaxed">
                                                {{ \Carbon\Carbon::parse($selectedStaff->email_verified_at)->format('M j, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tab Switching JavaScript --}}
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
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
                    });

                    // Staff Edit Form Handling
                    function enableEditMode() {
                        // Hide view actions and show edit actions
                        document.getElementById('view-actions').classList.add('hidden');
                        document.getElementById('edit-actions').classList.remove('hidden');
                        
                        // Hide tabs and show edit form
                        document.getElementById('staff-tabs').style.display = 'none';
                        document.querySelector('.tab-content').style.display = 'none';
                        document.getElementById('details-content').style.display = 'none';
                        document.getElementById('edit-form').classList.remove('hidden');
                        document.getElementById('form-actions').classList.remove('hidden');
                    }

                    function cancelEdit() {
                        // Show view actions and hide edit actions
                        document.getElementById('view-actions').classList.remove('hidden');
                        document.getElementById('edit-actions').classList.add('hidden');
                        
                        // Show tabs and hide edit form
                        document.getElementById('staff-tabs').style.display = 'grid';
                        document.querySelector('.tab-content:not(.hidden)').style.display = 'block';
                        document.getElementById('edit-form').classList.add('hidden');
                        document.getElementById('form-actions').classList.add('hidden');
                        
                        // Reset form to original values
                        const form = document.getElementById('staff-edit-form');
                        if (form) {
                            form.reset();
                        }
                    }

                    // Staff Reset Password Form Handling
                    function enableResetPasswordMode() {
                        // Hide view actions and show reset password actions
                        document.getElementById('view-actions').classList.add('hidden');
                        document.getElementById('reset-password-actions').classList.remove('hidden');
                        
                        // Hide tabs and show reset password form
                        document.getElementById('staff-tabs').style.display = 'none';
                        document.querySelector('.tab-content').style.display = 'none';
                        document.getElementById('details-content').style.display = 'none';
                        document.getElementById('reset-password-form').classList.remove('hidden');
                    }

                    function cancelResetPassword() {
                        // Show view actions and hide reset password actions
                        document.getElementById('view-actions').classList.remove('hidden');
                        document.getElementById('reset-password-actions').classList.add('hidden');
                        
                        // Show tabs and hide reset password form
                        document.getElementById('staff-tabs').style.display = 'grid';
                        document.querySelector('.tab-content:not(.hidden)').style.display = 'block';
                        document.getElementById('reset-password-form').classList.add('hidden');
                        
                        // Reset form to original values
                        const form = document.getElementById('staff-reset-password-form');
                        if (form) {
                            form.reset();
                        }
                    }

                    function validatePasswords() {
                        const password = document.getElementById('new-password').value;
                        const confirmPassword = document.getElementById('confirm-password').value;
                        
                        if (password.length < 8) {
                            alert('Password must be at least 8 characters long');
                            return false;
                        }
                        
                        if (password !== confirmPassword) {
                            alert('Passwords do not match');
                            return false;
                        }
                        
                        return true;
                    }

                    function resetPassword() {
                        if (!validatePasswords()) {
                            return;
                        }

                        const form = document.getElementById('staff-reset-password-form');
                        const saveButton = document.getElementById('reset-password-save-button');
                        const formData = new FormData(form);

                        // Show loading state
                        const originalText = saveButton.querySelector('span').innerText;
                        saveButton.disabled = true;
                        saveButton.querySelector('span').innerText = 'Resetting...';

                        for (let [key, value] of formData.entries()) {
                        }

                        fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            
                            if (data.success) {
                                window.location.reload();
                            } else {
                                alert(data.message || 'Failed to reset password. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            alert('An error occurred while resetting the password. Please check the console for details.');
                        })
                        .finally(() => {
                            // Reset button state
                            saveButton.disabled = false;
                            saveButton.querySelector('span').innerText = originalText;
                        });
                    }

                    // Add event listeners
                    document.addEventListener('DOMContentLoaded', function() {
                        // Edit button
                        const editButton = document.getElementById('edit-button');
                        if (editButton) {
                            editButton.addEventListener('click', enableEditMode);
                        }

                        // Cancel button
                        const cancelButton = document.getElementById('cancel-button');
                        if (cancelButton) {
                            cancelButton.addEventListener('click', cancelEdit);
                        }

                        // Save button
                        const saveButton = document.getElementById('save-button');
                        if (saveButton) {
                            saveButton.addEventListener('click', function(e) {
                                e.preventDefault();
                                saveChanges();
                            });
                        }

                        // Handle form submission
                        const editForm = document.getElementById('staff-edit-form');
                        if (editForm) {
                            editForm.addEventListener('submit', function(e) {
                                e.preventDefault();
                                saveChanges();
                            });
                        }

                        // Reset Password button
                        const resetPasswordButton = document.getElementById('reset-password-button');
                        if (resetPasswordButton) {
                            resetPasswordButton.addEventListener('click', function() {
                                enableResetPasswordMode();
                            });
                        }

                        // Reset Password Cancel button
                        const resetPasswordCancelButton = document.getElementById('reset-password-cancel-button');
                        if (resetPasswordCancelButton) {
                            resetPasswordCancelButton.addEventListener('click', cancelResetPassword);
                        }

                        // Reset Password Save button
                        const resetPasswordSaveButton = document.getElementById('reset-password-save-button');
                        if (resetPasswordSaveButton) {
                            resetPasswordSaveButton.addEventListener('click', function(e) {
                                e.preventDefault();
                                resetPassword();
                            });
                        }

                        // Handle reset password form submission
                        const resetPasswordForm = document.getElementById('staff-reset-password-form');
                        if (resetPasswordForm) {
                            resetPasswordForm.addEventListener('submit', function(e) {
                                e.preventDefault();
                                resetPassword();
                            });
                        }

                        // Real-time password validation
                        const newPasswordInput = document.getElementById('new-password');
                        const confirmPasswordInput = document.getElementById('confirm-password');
                        if (confirmPasswordInput && newPasswordInput) {
                            confirmPasswordInput.addEventListener('input', function() {
                                const password = newPasswordInput.value;
                                const confirmPassword = this.value;
                                
                                if (confirmPassword && password !== confirmPassword) {
                                    this.setCustomValidity('Passwords do not match');
                                    this.style.borderColor = '#ef4444';
                                } else {
                                    this.setCustomValidity('');
                                    this.style.borderColor = '';
                                }
                            });
                            
                            newPasswordInput.addEventListener('input', function() {
                                const password = this.value;
                                const confirmPassword = confirmPasswordInput.value;
                                
                                if (confirmPassword && password !== confirmPassword) {
                                    confirmPasswordInput.setCustomValidity('Passwords do not match');
                                    confirmPasswordInput.style.borderColor = '#ef4444';
                                } else {
                                    confirmPasswordInput.setCustomValidity('');
                                    confirmPasswordInput.style.borderColor = '';
                                }
                            });
                        }

                        // Suspend/Activate Toggle button
                        const suspendToggleButton = document.getElementById('suspend-toggle-button');
                        if (suspendToggleButton) {
                            suspendToggleButton.addEventListener('click', function() {
                                const currentStatus = this.getAttribute('data-status');
                                const staffUid = this.getAttribute('data-uid');
                                const newStatus = currentStatus === 'active' ? 'suspended' : 'active';
                                
                                // Confirm action
                                const action = newStatus === 'suspended' ? 'suspend' : 'activate';
                                if (!confirm(`Are you sure you want to ${action} this staff member?`)) {
                                    return;
                                }
                                
                                toggleStaffStatus(staffUid, newStatus, this);
                            });
                        }
                    });

                    function saveChanges() {
                        const form = document.getElementById('staff-edit-form');
                        const saveButton = document.getElementById('save-button');
                        const formData = new FormData(form);

                        // Show loading state
                        const originalText = saveButton.querySelector('span').innerText;
                        saveButton.disabled = true;
                        saveButton.querySelector('span').innerText = 'Saving...';

                        // Add CSRF token
                        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                        for (let [key, value] of formData.entries()) {
                        }

                        fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.text().then(text => {
                                    console.error('Response text:', text);
                                    throw new Error(`HTTP ${response.status}: ${text}`);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            
                            if (data.success) {
                                // Refresh page to show updated data
                                window.location.reload();
                            } else {
                                console.error('Server returned success=false:', data);
                                alert(data.message || 'An error occurred while saving.');
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            alert('An error occurred while saving the changes. Please check the console for details.');
                        })
                        .finally(() => {
                            // Reset button state
                            saveButton.disabled = false;
                            saveButton.querySelector('span').innerText = originalText;
                        });
                    }

                    function toggleStaffStatus(staffUid, newStatus, button) {
                        // Show loading state
                        const originalHTML = button.innerHTML;
                        button.disabled = true;
                        button.innerHTML = `
                            <svg class="h-[18px] animate-spin" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" stroke-opacity="0.3"/>
                                <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                            </svg>
                            <span class="text-gray-500 mt-1 text-[15px]">Processing...</span>
                        `;

                        // Prepare form data
                        const formData = new FormData();
                        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                        formData.append('_method', 'PATCH');
                        formData.append('status', newStatus);

                        // Make request to update status
                        const url = `{{ route('staff.management.staff.status', ':uid') }}`.replace(':uid', staffUid);
                        
                        fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.text().then(text => {
                                    console.error('Response text:', text);
                                    throw new Error(`HTTP ${response.status}: ${text}`);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            
                            if (data.success) {
                                // Refresh page to show updated status
                                window.location.reload();
                            } else {
                                console.error('Server returned success=false:', data);
                                alert(data.message || 'An error occurred while updating status.');
                                
                                // Reset button state
                                button.disabled = false;
                                button.innerHTML = originalHTML;
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            alert('An error occurred while updating the status. Please check the console for details.');
                            
                            // Reset button state
                            button.disabled = false;
                            button.innerHTML = originalHTML;
                        });
                    }
                </script>
            @else
                {{-- Default State --}}
                <div class="flex-1 flex items-center justify-center text-gray-500">
                    <div class="text-center">
                        <svg class="mx-auto h-20 mb-4 text-gray-300" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 0C8.06053 0.00368503 6.16393 0.571311 4.54128 1.63374C2.91862 2.69617 1.63994 4.20754 0.86099 5.98377C0.0820354 7.76 -0.163575 9.72442 0.154075 11.6378C0.471725 13.5511 1.33893 15.3308 2.65005 16.76C3.58647 17.775 4.72299 18.5851 5.98799 19.1392C7.25298 19.6933 8.61903 19.9793 10 19.9793C11.3811 19.9793 12.7471 19.6933 14.0121 19.1392C15.2771 18.5851 16.4136 17.775 17.35 16.76C18.6612 15.3308 19.5284 13.5511 19.846 11.6378C20.1637 9.72442 19.9181 7.76 19.1391 5.98377C18.3602 4.20754 17.0815 2.69617 15.4588 1.63374C13.8362 0.571311 11.9396 0.00368503 10 0ZM10 18C7.92851 17.9969 5.93896 17.1903 4.45005 15.75C4.90209 14.6495 5.67108 13.7083 6.6593 13.0459C7.64752 12.3835 8.81036 12.0298 10 12.0298C11.1897 12.0298 12.3526 12.3835 13.3408 13.0459C14.329 13.7083 15.098 14.6495 15.55 15.75C14.0611 17.1903 12.0716 17.9969 10 18ZM8.00005 8C8.00005 7.60444 8.11735 7.21776 8.33711 6.88886C8.55687 6.55996 8.86923 6.30362 9.23468 6.15224C9.60013 6.00087 10.0023 5.96126 10.3902 6.03843C10.7782 6.1156 11.1346 6.30608 11.4143 6.58579C11.694 6.86549 11.8844 7.22186 11.9616 7.60982C12.0388 7.99778 11.9992 8.39991 11.8478 8.76537C11.6964 9.13082 11.4401 9.44318 11.1112 9.66294C10.7823 9.8827 10.3956 10 10 10C9.46962 10 8.96091 9.78929 8.58584 9.41421C8.21076 9.03914 8.00005 8.53043 8.00005 8ZM16.91 14C16.0166 12.4718 14.6415 11.283 13 10.62C13.5092 10.0427 13.841 9.33066 13.9555 8.56944C14.0701 7.80822 13.9625 7.03011 13.6458 6.3285C13.3291 5.62688 12.8166 5.03156 12.17 4.61397C11.5233 4.19637 10.7698 3.97425 10 3.97425C9.23026 3.97425 8.47682 4.19637 7.83014 4.61397C7.18346 5.03156 6.67102 5.62688 6.3543 6.3285C6.03758 7.03011 5.93004 7.80822 6.04458 8.56944C6.15912 9.33066 6.49088 10.0427 7.00005 10.62C5.35865 11.283 3.98352 12.4718 3.09005 14C2.37799 12.7871 2.00177 11.4065 2.00005 10C2.00005 7.87827 2.8429 5.84344 4.34319 4.34315C5.84349 2.84285 7.87832 2 10 2C12.1218 2 14.1566 2.84285 15.6569 4.34315C17.1572 5.84344 18 7.87827 18 10C17.9983 11.4065 17.6221 12.7871 16.91 14Z" fill="currentColor"/>
                        </svg>

                        <h3 class="text-lg font-medium text-slate-800 mb-2">Select a Staff Member</h3>
                        <p class="text-gray-500">Choose a staff member from the list to view their details</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
