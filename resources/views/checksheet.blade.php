<x-layouts.app :title="'Check Sheet Security'">
    <div x-data="checkSheetSecurity" x-init="init()"
        class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 transition-all duration-300">
        <div class="flex">

            {{-- SIDEBAR --}}
            @include('components.checksheet._sidebar')

            {{-- SIDEBAR OVERLAY --}}
            @include('components.checksheet._sidebar-overlay')

            {{-- MAIN AREA --}}
            <div class="flex-1 transition-all duration-300" :class="sidebarOpen ? 'lg:ml-72' : 'lg:ml-0'">

                {{-- TOPBAR --}}
                @include('components.checksheet._navbar')

                <div class="p-6">
                    <div class="max-w-7xl mx-auto">

                        {{-- ALERTS --}}
                        @include('components.checksheet._alerts')

                        {{-- SECTION: DAFTAR BOOKING TEST DRIVE --}}
                        @include('components.checksheet._section-daftar-booking')

                        {{-- SECTION: HISTORY CHECKSHEET --}}
                        @include('components.checksheet._section-history')

                        {{-- MODALS --}}
                        @include('components.checksheet.modals._form-checksheet')
                        @include('components.checksheet.modals._delete-confirm')

                    </div>
                </div>
            </div>
        </div>

        {{-- STYLE & SCRIPT --}}
        @include('components.checksheet._style')
        @include('components.checksheet._script')

    </div>
</x-layouts.app>
