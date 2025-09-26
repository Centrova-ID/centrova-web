{{-- Language Switcher Component --}}
<div class="relative inline-block">
    <div class="dropdown">
        <button class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors duration-200 px-3 py-2 rounded-lg hover:bg-gray-100" 
                type="button" 
                data-bs-toggle="dropdown" 
                aria-expanded="false">
            <i class="fas fa-globe"></i>
            <span class="hidden sm:inline">
                @if(getCurrentLocale() === 'id')
                    ID
                @else
                    EN
                @endif
            </span>
            <i class="fas fa-chevron-down text-xs"></i>
        </button>
        
        <ul class="dropdown-menu min-w-[120px] shadow-lg border-0 rounded-lg">
            @if(!isCurrentLocale('id'))
                <li>
                    <a class="dropdown-item flex items-center space-x-3 px-4 py-2 hover:bg-blue-50" 
                       href="{{ switchLanguageUrl('id') }}">
                        <img src="{{ asset('assets/images/flags/id.png') }}" 
                             alt="Indonesia" 
                             class="w-4 h-4 rounded-sm"
                             onerror="this.style.display='none'">
                        <span>Indonesia</span>
                    </a>
                </li>
            @endif
            
            @if(!isCurrentLocale('en'))
                <li>
                    <a class="dropdown-item flex items-center space-x-3 px-4 py-2 hover:bg-blue-50" 
                       href="{{ switchLanguageUrl('en') }}">
                        <img src="{{ asset('assets/images/flags/en.png') }}" 
                             alt="English" 
                             class="w-4 h-4 rounded-sm"
                             onerror="this.style.display='none'">
                        <span>English</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
