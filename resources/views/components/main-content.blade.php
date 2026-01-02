{{-- File: resources/views/components/main-content.blade.php --}}
{{-- Usage: <x-main-content>...</x-main-content> --}}

<div 
    x-data="{
        get sidebarCollapsed() { return $store.sidebar.collapsed }
    }"
    :class="{
        'lg:ml-20': sidebarCollapsed,
        'lg:ml-64': !sidebarCollapsed
    }"
    class="flex-1 content-transition"
>
    {{ $slot }}
</div>