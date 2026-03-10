<x-layouts.app :title="'Dashboard'">
    <div x-data="bookingDashboard" x-init="init()"
        class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 transition-all duration-300">
        <div class="flex">

            {{-- SIDEBAR --}}
            @include('components.dashboard._sidebar')

            {{-- SIDEBAR OVERLAY --}}
            @include('components.dashboard._sidebar-overlay')

            {{-- MAIN AREA --}}
            <div class="flex-1 transition-all duration-300" :class="sidebarOpen ? 'lg:ml-72' : 'lg:ml-0'">

                {{-- TOPBAR --}}
                @include('components.dashboard._navbar')

                <div class="p-6 lg:p-8">
                    <div class="max-w-7xl mx-auto space-y-6">

                        {{-- ALERTS --}}
                        @include('components.dashboard._alerts')

                        {{-- SECTION: MANAGEMENT BOOKING --}}
                        @include('components.dashboard._section-management')

                        {{-- MODALS INLINE MANAGEMENT --}}
                        @include('components.dashboard.modals._detail-management-testdrive')
                        @include('components.dashboard.modals._detail-management-pameran')

                        {{-- SECTION: DATA BOOKING --}}
                        @include('components.dashboard._section-data-booking')

                    </div>

                    {{-- GLOBAL MODALS --}}
                    @include('components.dashboard.modals._all-global')

                    {{-- STYLE & SCRIPT --}}
                    @include('components.dashboard._style')
                    @include('components.dashboard._script')

                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
