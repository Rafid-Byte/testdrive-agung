@props(['on'])

<div
    x-data="{ 
        shown: false, 
        message: '', 
        type: 'success',
        timeout: null,
        show(msg, notifType = 'success') {
            clearTimeout(this.timeout);
            this.message = msg;
            this.type = notifType;
            this.shown = true;
            this.timeout = setTimeout(() => { this.shown = false }, 3000);
        }
    }"
    x-init="
        if (typeof $wire !== 'undefined') {
            $wire.on('{{ $on }}', (data) => { 
                const message = typeof data === 'string' ? data : (data[0]?.message || data[0] || 'Berhasil disimpan!');
                const type = typeof data === 'string' ? 'success' : (data[0]?.type || 'success');
                show(message, type);
            });
        }
    "
    @profile-updated.window="show($event.detail[0]?.message || $event.detail.message || 'Profil berhasil diperbarui!', $event.detail[0]?.type || $event.detail.type || 'success')"
    @password-updated.window="show($event.detail[0]?.message || $event.detail.message || 'Password berhasil diperbarui!', $event.detail[0]?.type || $event.detail.type || 'success')"
    x-show="shown"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-300 transform"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="translate-x-full opacity-0"
    style="display: none"
    class="fixed top-4 right-4 z-50 max-w-md shadow-lg rounded-lg overflow-hidden"
    role="alert"
>
    <div 
        class="p-4 flex items-center gap-3"
        :class="{
            'bg-green-500': type === 'success',
            'bg-blue-500': type === 'info',
            'bg-yellow-500': type === 'warning',
            'bg-red-500': type === 'error'
        }"
    >
        <!-- Icon -->
        <div class="flex-shrink-0">
            <!-- Success Icon -->
            <svg x-show="type === 'success'" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            
            <!-- Info Icon -->
            <svg x-show="type === 'info'" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            
            <!-- Warning Icon -->
            <svg x-show="type === 'warning'" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            
            <!-- Error Icon -->
            <svg x-show="type === 'error'" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        
        <!-- Message -->
        <span class="text-white font-medium flex-1" x-text="message"></span>
        
        <!-- Close Button -->
        <button 
            @click="shown = false"
            class="flex-shrink-0 text-white hover:text-gray-200 transition-colors focus:outline-none"
            aria-label="Close notification"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>