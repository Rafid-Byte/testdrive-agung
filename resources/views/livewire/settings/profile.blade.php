<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';
    public string $email = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', 
            message: 'Profil berhasil diperbarui!', 
            type: 'success'
        );
    }

    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="w-full max-w-4xl mx-auto">
    {{-- Back to Dashboard Button --}}
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 shadow-sm hover:shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Settings Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-2">
            <div class="p-3 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Settings</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Kelola profil dan pengaturan akun Anda</p>
            </div>
        </div>
        <div class="mt-6 h-px bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 dark:from-gray-700 dark:via-gray-600 dark:to-gray-700"></div>
    </div>

    {{-- Navigation Tabs --}}
    <div class="mb-8">
        <nav class="flex gap-2 p-1 bg-gray-100 dark:bg-gray-800 rounded-xl">
            <a href="{{ route('profile.edit') }}" 
               class="flex-1 flex items-center justify-center gap-2 px-4 py-3 text-sm font-semibold rounded-lg transition-all duration-200 bg-white dark:bg-gray-700 text-blue-600 dark:text-blue-400 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profile
            </a>
            <a href="{{ route('password.edit') }}" 
               class="flex-1 flex items-center justify-center gap-2 px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-white/50 dark:hover:bg-gray-700/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Password
            </a>
            <a href="{{ route('appearance.edit') }}" 
               class="flex-1 flex items-center justify-center gap-2 px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-white/50 dark:hover:bg-gray-700/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                </svg>
                Appearance
            </a>
        </nav>
    </div>

    {{-- Main Content Card --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="p-8">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Informasi Profile</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Perbarui nama dan alamat email Anda</p>
            </div>

            <form wire:submit="updateProfileInformation" class="space-y-6">
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Nama Lengkap
                        </label>
                        <flux:input 
                            wire:model="name" 
                            type="text" 
                            required 
                            autofocus 
                            autocomplete="name"
                            class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200"
                            placeholder="Masukkan nama lengkap"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Alamat Email
                        </label>
                        <flux:input 
                            wire:model="email" 
                            type="email" 
                            required 
                            autocomplete="email"
                            class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-200"
                            placeholder="nama@email.com"
                        />

                        @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                            <div class="mt-4 rounded-xl bg-amber-50 dark:bg-amber-900/20 p-4 border-l-4 border-amber-500">
                                <div class="flex gap-3">
                                    <svg class="h-5 w-5 text-amber-600 dark:text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-amber-800 dark:text-amber-200">
                                            {{ __('Email belum diverifikasi') }}
                                        </p>
                                        <button 
                                            type="button"
                                            wire:click.prevent="resendVerificationNotification"
                                            class="text-sm font-medium text-amber-700 dark:text-amber-400 hover:text-amber-900 dark:hover:text-amber-300 underline mt-1 inline-block"
                                        >
                                            {{ __('Klik di sini untuk mengirim ulang email verifikasi') }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                            @if (session('status') === 'verification-link-sent')
                                <div class="mt-3 rounded-xl bg-green-50 dark:bg-green-900/20 p-4 border-l-4 border-green-500">
                                    <div class="flex gap-3">
                                        <svg class="h-5 w-5 text-green-600 dark:text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-sm font-medium text-green-800 dark:text-green-200">
                                            {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <button 
                        type="submit" 
                        data-test="update-profile-button"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 shadow-lg hover:shadow-xl"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>

                    <x-toast-notification on="profile-updated" />
                </div>
            </form>
        </div>

        {{-- Delete Account Section --}}
        <div class="border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 p-8">
            <livewire:settings.delete-user-form />
        </div>
    </div>
</section>