{{-- Department Hierarchy Visualization Component --}}
@props(['department', 'departments'])

@push('styles')
<link rel="stylesheet" href="{{ asset('css/department-hierarchy.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/department-hierarchy.js') }}"></script>
@endpush

{{-- Organizational Chart Container --}}
<div class="w-full h-full bg-gray-50 rounded-lg border" id="org-chart-container">
    {{-- Control Panel --}}
    <div class="bg-white border-b p-4 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            {{-- Search --}}
            <div class="relative">
                <input type="text" 
                       id="org-search" 
                       placeholder="Search employees..." 
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-64">
                <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            
            {{-- View Options --}}
            <div class="flex items-center space-x-2">
                <button id="expand-all-btn" class="px-3 py-1.5 text-sm bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                    Expand All
                </button>
                <button id="collapse-all-btn" class="px-3 py-1.5 text-sm bg-gray-500 text-white rounded hover:bg-gray-600 transition-colors">
                    Collapse All
                </button>
            </div>
        </div>
        
        {{-- Zoom Controls --}}
        <div class="flex items-center space-x-2">
            <button id="zoom-out-btn" class="p-2 border border-gray-300 rounded hover:bg-gray-50">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                </svg>
            </button>
            <span id="zoom-level" class="text-sm text-gray-600 w-12 text-center">100%</span>
            <button id="zoom-in-btn" class="p-2 border border-gray-300 rounded hover:bg-gray-50">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </button>
            <button id="reset-view-btn" class="px-3 py-1.5 text-sm border border-gray-300 rounded hover:bg-gray-50">
                Reset View
            </button>
        </div>
    </div>

    {{-- Canvas Area --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100" style="height: 600px;" id="org-canvas">
        <div class="absolute inset-0" id="org-chart-wrapper">
            <svg id="org-chart-svg" class="w-full h-full">
                <defs>
                    {{-- Gradient definitions --}}
                    <linearGradient id="nodeGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" style="stop-color:#ffffff;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#f8fafc;stop-opacity:1" />
                    </linearGradient>
                    
                    {{-- Shadow filter --}}
                    <filter id="dropshadow" x="-50%" y="-50%" width="200%" height="200%">
                        <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#000000" flood-opacity="0.1"/>
                    </filter>
                    
                    {{-- Connection line markers --}}
                    <marker id="arrowhead" markerWidth="10" markerHeight="7" refX="9" refY="3.5" orient="auto">
                        <polygon points="0 0, 10 3.5, 0 7" fill="#94a3b8" />
                    </marker>
                </defs>
                
                {{-- Connection lines group --}}
                <g id="connections"></g>
                
                {{-- Nodes group --}}
                <g id="nodes"></g>
            </svg>
        </div>
        
        {{-- Loading overlay --}}
        <div id="loading-overlay" class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center hidden">
            <div class="text-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500 mx-auto mb-2"></div>
                <p class="text-gray-600">Loading organization chart...</p>
            </div>
        </div>
    </div>
</div>

{{-- Employee Detail Modal --}}
<div id="employee-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Employee Details</h3>
                    <button id="close-modal" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                
                <div id="modal-content">
                    {{-- Content will be populated by JavaScript --}}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Organization Data (Hidden) --}}
<script type="application/json" id="org-data">
{
    "ceo": {
        "id": "ceo",
        "name": "Arthur D. Levinson",
        "position": "Chairman",
        "department": "Executive",
        "avatar": "/images/avatars/ceo.jpg",
        "email": "arthur.levinson@company.com",
        "phone": "+1 (555) 123-4567",
        "reports": ["coo", "ceo-fellow"]
    },
    "coo": {
        "id": "coo", 
        "name": "Tim Cook",
        "position": "Chief Executive Officer",
        "department": "Executive",
        "avatar": "/images/avatars/coo.jpg",
        "email": "tim.cook@company.com",
        "phone": "+1 (555) 123-4568",
        "reports": ["cto", "marketing", "engineering", "finance", "operations", "china"]
    },
    "ceo-fellow": {
        "id": "ceo-fellow",
        "name": "Phil Schiller", 
        "position": "Apple Fellow",
        "department": "Executive",
        "avatar": "/images/avatars/phil.jpg",
        "email": "phil.schiller@company.com",
        "phone": "+1 (555) 123-4569",
        "reports": []
    },
    "cto": {
        "id": "cto",
        "name": "Jeff Williams",
        "position": "Chief Operating Officer", 
        "department": "Operations",
        "avatar": "/images/avatars/cto.jpg",
        "email": "jeff.williams@company.com",
        "phone": "+1 (555) 123-4570",
        "reports": []
    },
    "marketing": {
        "id": "marketing",
        "name": "Marketing Department",
        "position": "Marketing",
        "department": "Marketing", 
        "avatar": null,
        "isDepartment": true,
        "reports": ["marketing-svp1", "marketing-svp2", "marketing-vp"]
    },
    "marketing-svp1": {
        "id": "marketing-svp1",
        "name": "Deirdre O'Brien",
        "position": "SVP Retail + People",
        "department": "Marketing",
        "avatar": "/images/avatars/deirdre.jpg",
        "email": "deirdre.obrien@company.com",
        "phone": "+1 (555) 123-4571",
        "reports": []
    },
    "marketing-svp2": {
        "id": "marketing-svp2", 
        "name": "Greg Joswiak",
        "position": "SVP Worldwide Marketing",
        "department": "Marketing",
        "avatar": "/images/avatars/greg.jpg",
        "email": "greg.joswiak@company.com", 
        "phone": "+1 (555) 123-4572",
        "reports": []
    },
    "marketing-vp": {
        "id": "marketing-vp",
        "name": "Tor Myhren",
        "position": "Vice-President, Marketing Communications",
        "department": "Marketing",
        "avatar": "/images/avatars/tor.jpg",
        "email": "tor.myhren@company.com",
        "phone": "+1 (555) 123-4573", 
        "reports": []
    },
    "engineering": {
        "id": "engineering",
        "name": "Engineering Department", 
        "position": "Engineering",
        "department": "Engineering",
        "avatar": null,
        "isDepartment": true,
        "reports": ["eng-svp1", "eng-svp2", "eng-svp3", "eng-svp4"]
    },
    "eng-svp1": {
        "id": "eng-svp1",
        "name": "Eddie Cue",
        "position": "SVP Internet Software and Services",
        "department": "Engineering",
        "avatar": "/images/avatars/eddie.jpg", 
        "email": "eddie.cue@company.com",
        "phone": "+1 (555) 123-4574",
        "reports": []
    },
    "eng-svp2": {
        "id": "eng-svp2",
        "name": "Johny Srouji", 
        "position": "SVP Hardware Technologies",
        "department": "Engineering",
        "avatar": "/images/avatars/johny.jpg",
        "email": "johny.srouji@company.com",
        "phone": "+1 (555) 123-4575",
        "reports": []
    },
    "eng-svp3": {
        "id": "eng-svp3",
        "name": "Craig Federighi",
        "position": "SVP Software Engineering", 
        "department": "Engineering",
        "avatar": "/images/avatars/craig.jpg",
        "email": "craig.federighi@company.com",
        "phone": "+1 (555) 123-4576",
        "reports": []
    },
    "eng-svp4": {
        "id": "eng-svp4",
        "name": "Dan Riccio",
        "position": "SVP Hardware Engineering",
        "department": "Engineering", 
        "avatar": "/images/avatars/dan.jpg",
        "email": "dan.riccio@company.com",
        "phone": "+1 (555) 123-4577",
        "reports": []
    },
    "finance": {
        "id": "finance",
        "name": "Finance and Admin Department",
        "position": "Finance and Admin", 
        "department": "Finance",
        "avatar": null,
        "isDepartment": true,
        "reports": ["finance-svp1", "finance-vp1", "finance-vp2"]
    },
    "finance-svp1": {
        "id": "finance-svp1",
        "name": "Luca Maestri",
        "position": "SVP and CFO",
        "department": "Finance", 
        "avatar": "/images/avatars/luca.jpg",
        "email": "luca.maestri@company.com", 
        "phone": "+1 (555) 123-4578",
        "reports": []
    },
    "finance-vp1": {
        "id": "finance-vp1",
        "name": "Katherine Adams",
        "position": "SVP and General Counsel",
        "department": "Finance",
        "avatar": "/images/avatars/katherine.jpg",
        "email": "katherine.adams@company.com",
        "phone": "+1 (555) 123-4579", 
        "reports": []
    },
    "finance-vp2": {
        "id": "finance-vp2",
        "name": "Adrian Perica",
        "position": "Vice-President, Corporate Development", 
        "department": "Finance",
        "avatar": "/images/avatars/adrian.jpg",
        "email": "adrian.perica@company.com",
        "phone": "+1 (555) 123-4580",
        "reports": []
    },
    "operations": {
        "id": "operations",
        "name": "Operations Department",
        "position": "Operations",
        "department": "Operations",
        "avatar": null,
        "isDepartment": true,
        "reports": ["ops-svp1", "ops-vp1"]
    },
    "ops-svp1": {
        "id": "ops-svp1", 
        "name": "Sabih Khan",
        "position": "SVP Operations",
        "department": "Operations",
        "avatar": "/images/avatars/sabih.jpg",
        "email": "sabih.khan@company.com",
        "phone": "+1 (555) 123-4581",
        "reports": []
    },
    "ops-vp1": {
        "id": "ops-vp1",
        "name": "Lisa Jackson",
        "position": "VP Environment, Policy & Social Initiatives",
        "department": "Operations", 
        "avatar": "/images/avatars/lisa.jpg",
        "email": "lisa.jackson@company.com",
        "phone": "+1 (555) 123-4582",
        "reports": []
    },
    "china": {
        "id": "china",
        "name": "China Department",
        "position": "China",
        "department": "China", 
        "avatar": null,
        "isDepartment": true,
        "reports": ["china-vp1"]
    },
    "china-vp1": {
        "id": "china-vp1",
        "name": "Isabel Ge Mahe",
        "position": "Vice President and Managing Director, China",
        "department": "China",
        "avatar": "/images/avatars/isabel.jpg", 
        "email": "isabel.gemahe@company.com",
        "phone": "+86 (555) 123-4583",
        "reports": []
    }
}
</script>

    {{-- Parent Department (if exists) --}}
    @if($department->parent_id)
        <div class="text-center">
            <div class="text-xs text-gray-500 mb-2">Reports to</div>
            <div class="inline-block hierarchy-line">
                <div class="w-32 h-16 bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center hierarchy-node"
                     data-node-id="parent"
                     data-department-id="{{ $department->parent_id }}"
                     data-type="parent">
                    <div class="text-sm font-medium text-gray-800">{{ $department->parent->name ?? 'Corporate' }}</div>
                    <div class="text-xs text-gray-600">{{ $department->parent->code ?? 'CORP' }}</div>
                </div>
            </div>
        </div>
    @endif

    {{-- Sub-departments (if exists) --}}
    @php
        $subDepartments = $departments->where('parent_id', $department->id);
    @endphp
    
    @if($subDepartments->count() > 0)
        <div class="text-center">
            <div class="text-xs text-gray-500 mb-4">Sub-departments</div>
            <div class="flex flex-wrap justify-center gap-4 hierarchy-connector">
                @foreach($subDepartments as $index => $subDept)
                    <div class="flex flex-col items-center">
                        <div class="w-28 h-16 bg-green-100 border-2 border-green-300 rounded-lg flex flex-col items-center justify-center mb-1 hierarchy-node"
                             data-node-id="sub-{{ $subDept->id }}"
                             data-department-id="{{ $subDept->id }}"
                             data-parent-id="current"
                             data-staff-count="{{ $subDept->staff_count ?? 0 }}"
                             data-has-children="{{ $departments->where('parent_id', $subDept->id)->count() > 0 ? 'true' : 'false' }}"
                             data-type="subdepartment">
                            <div class="text-xs font-medium text-green-800">{{ $subDept->name }}</div>
                            <div class="text-xs text-green-600">{{ $subDept->code }}</div>
                        </div>
                        @if($subDept->manager)
                            <div class="text-xs text-gray-500">{{ $subDept->manager->name }}</div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Staff Hierarchy --}}
    @if($department->staff->count() > 0)
        <div>
            <div class="text-sm font-medium text-gray-700 mb-4 text-center">Department Staff Structure</div>
            
            {{-- Manager --}}
            @if($department->manager)
                <div class="text-center mb-6">
                    <div class="inline-flex flex-col items-center">
                        <div class="w-40 h-16 bg-purple-100 border-2 border-purple-300 rounded-lg flex items-center justify-center mb-2 hierarchy-node"
                             data-node-id="manager"
                             data-staff-id="{{ $department->manager->id }}"
                             data-parent-id="current"
                             data-type="manager">
                            <div class="text-center">
                                <div class="text-sm font-medium text-purple-800">{{ $department->manager->name }}</div>
                                <div class="text-xs text-purple-600">Department Manager</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Staff by Role --}}
            @php
                $staffByRole = $department->staff->groupBy('role');
            @endphp

            <div class="space-y-4">
                @foreach($staffByRole as $role => $staffMembers)
                    @if($role !== 'manager' || !$department->manager)
                        <div class="text-center">
                            <div class="text-xs text-gray-500 mb-2">{{ ucfirst($role) }}s ({{ $staffMembers->count() }})</div>
                            <div class="flex flex-wrap justify-center gap-2 hierarchy-connector">
                                @foreach($staffMembers as $staffIndex => $staff)
                                    @if($staff->id !== $department->manager_id)
                                        <div class="w-32 h-12 bg-yellow-100 border border-yellow-300 rounded-lg flex items-center justify-center hierarchy-node"
                                             data-node-id="staff-{{ $staff->id }}"
                                             data-staff-id="{{ $staff->id }}"
                                             data-parent-id="manager"
                                             data-role="{{ $role }}"
                                             data-type="staff">
                                            <div class="text-center">
                                                <div class="text-xs font-medium text-yellow-800">{{ $staff->name }}</div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @else
        <div class="text-center py-8">
            <svg class="mx-auto aspect-square text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No organizational structure</h3>
            <p class="mt-1 text-sm text-gray-500">This department doesn't have any staff or sub-departments yet.</p>
        </div>
    @endif

    {{-- Department Statistics --}}
    <x-department.statistics :department="$department" :subDepartments="$subDepartments" />
</div>
