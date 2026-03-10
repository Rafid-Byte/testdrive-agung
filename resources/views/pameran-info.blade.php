<x-layouts.app :title="'Pameran Info'">
    <div x-data="pameranInfoData()" x-init="init()"
        class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 transition-all duration-300">
        <div class="flex">

            {{-- SIDEBAR --}}
            @include('components.pameraninfo._sidebar')

            {{-- SIDEBAR OVERLAY --}}
            @include('components.pameraninfo._sidebar-overlay')

            {{-- MAIN AREA --}}
            <div class="flex-1 transition-all duration-300" :class="sidebarOpen ? 'lg:ml-72' : 'lg:ml-0'">

                {{-- TOPBAR --}}
                @include('components.pameraninfo._navbar')

                {{-- SECTION: TABEL PAMERAN BOOKING --}}
                @include('components.pameraninfo._section-tabel')

            </div>
        </div>

        {{-- MODALS --}}
        @include('components.pameraninfo.modals._detail')
        @include('components.pameraninfo.modals._status')

        {{-- SCRIPT & STYLE --}}
        @include('components.pameraninfo._script')
        @include('components.pameraninfo._style')

    </div>
</x-layouts.app>
