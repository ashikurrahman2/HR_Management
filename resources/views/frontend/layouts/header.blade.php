 <!-- Mobile Header -->
    <div class="mobile-header">
        <div class="header-content">
            <div class="header-title">
                <h4>HR Payroll</h4>
                <small>Management System</small>
            </div>
         <div class="header-actions">
    <button class="header-btn relative">
        <i class="fas fa-bell"></i>
        <!-- <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4">3</span> -->
    </button>

    <!-- প্রফেশনাল ইউজার ড্রপডাউন (নো ইমেজ) -->
    <div class="relative" x-data="{ open: false }">
        <button 
            @click="open = !open" 
            class="header-btn w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 
                   flex items-center justify-center text-white font-semibold text-sm 
                   ring-2 ring-white shadow-lg hover:ring-indigo-300 transition-all duration-200">
            {{-- {{ Str::substr(Auth::user()->name, 0, 2) }} --}} AH
        </button>

        <!-- ড্রপডাউন মেনু -->
     
            <!-- ইউজার ইনফো হেডার -->
            {{-- <div class="px-5 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                <div class="font-bold text-base truncate">{{ Auth::user()->name }}</div>
                <div class="text-xs opacity-90 mt-1">{{ Auth::user()->email }}</div>
                <div class="text-xs opacity-75 mt-2">{{ Auth::user()->role ?? 'Employee' }}</div>
            </div> --}}
{{-- 
            <div class="py-2">
                <a href="#" 
                   class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 transition text-sm font-medium">
                    <i class="fas fa-user-circle w-5 text-indigo-600"></i>
                    আমার প্রোফাইল
                </a>

                <a href="#" 
                   class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 transition text-sm font-medium">
                    <i class="fas fa-cog w-5 text-gray-500"></i>
                    সেটিংস
                </a> --}}

                {{-- <div class="h-px bg-gray-200 my-1"></div> --}}

                {{-- <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                        class="w-full flex items-center gap-3 px-5 py-3 text-left text-red-600 
                               hover:bg-red-50 transition text-sm font-medium">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        লগআউট
                    </button>
                </form> --}}
            {{-- </div> --}}
        {{-- </div> --}}
    </div>
</div>
        </div>
    </div>   {{-- <div 
            x-show="open"
            @click.away="open = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
            class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-2xl border border-gray-100 
                   overflow-hidden z-50 origin-top-right"
            style="box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);"> --}}
