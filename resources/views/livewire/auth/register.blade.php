<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="w-full max-w-[480px] mx-auto">
    <!-- Brand Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center shadow-md">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-zinc-900 dark:text-white">Toyota Paal 10 Jambi</h2>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">Test Drive System Portal</p>
            </div>
        </div>

        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white mb-2">
                {{ __('Create your account') }}
            </h1>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                {{ __('Get started with your free account today.') }}
            </p>
        </div>
    </div>

    <!-- Session Status Alert -->
    @if(session('status'))
        <div class="mb-6 p-3.5 bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-200 dark:border-emerald-800/30 rounded-lg">
            <p class="text-sm text-emerald-800 dark:text-emerald-300 font-medium">{{ session('status') }}</p>
        </div>
    @endif

    <!-- Register Form Card -->
    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 shadow-sm">
        <div class="p-6">
            <form method="POST" wire:submit="register" class="space-y-5">
                <!-- Name -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-zinc-900 dark:text-zinc-100">
                        {{ __('Full name') }}
                    </label>
                    <flux:input
                        wire:model="name"
                        id="name"
                        type="text"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="John Doe"
                        class="h-11"
                    />
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-zinc-900 dark:text-zinc-100">
                        {{ __('Email') }}
                    </label>
                    <flux:input
                        wire:model="email"
                        id="email"
                        type="email"
                        required
                        autocomplete="email"
                        placeholder="name@company.com"
                        class="h-11"
                    />
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-zinc-900 dark:text-zinc-100">
                        {{ __('Password') }}
                    </label>
                    <flux:input
                        wire:model="password"
                        id="password"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="Create a strong password"
                        viewable
                        class="h-11"
                    />
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-zinc-900 dark:text-zinc-100">
                        {{ __('Confirm password') }}
                    </label>
                    <flux:input
                        wire:model="password_confirmation"
                        id="password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="Re-enter your password"
                        viewable
                        class="h-11"
                    />
                </div>

                <!-- Submit Button -->
                <div class="pt-1">
                    <flux:button 
                        variant="primary" 
                        type="submit" 
                        class="w-full h-11 font-medium" 
                        data-test="register-user-button"
                    >
                        {{ __('Create account') }}
                    </flux:button>
                </div>
            </form>
        </div>
    </div>

    <!-- Login Link -->
    <div class="mt-6 text-center">
        <p class="text-sm text-zinc-600 dark:text-zinc-400">
            {{ __('Already have an account?') }}
            <flux:link 
                :href="route('login')" 
                wire:navigate
                class="font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 ml-1"
            >
                {{ __('Sign in') }}
            </flux:link>
        </p>
    </div>

    <!-- Footer -->
    <div class="mt-8 pt-6 border-t border-zinc-200 dark:border-zinc-800">
        <p class="text-center text-xs text-zinc-400 dark:text-zinc-600 mt-4">
            {{ __('© 2025 Toyota Paal 10. All rights reserved.') }}
        </p>
    </div>
</div>