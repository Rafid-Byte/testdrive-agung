<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate();
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages(['email' => __('auth.failed')]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));
        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
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
                {{ __('Sign in to your account') }}
            </h1>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                {{ __('Welcome back! Please enter your details.') }}
            </p>
        </div>
    </div>

    <!-- Session Status Alert -->
    @if(session('status'))
        <div class="mb-6 p-3.5 bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-200 dark:border-emerald-800/30 rounded-lg">
            <p class="text-sm text-emerald-800 dark:text-emerald-300 font-medium">{{ session('status') }}</p>
        </div>
    @endif

    <!-- Login Form Card -->
    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 shadow-sm">
        <div class="p-6">
            <form method="POST" wire:submit="login" class="space-y-5">
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
                        autofocus
                        autocomplete="email"
                        placeholder="name@company.com"
                        class="h-11"
                    />
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-zinc-900 dark:text-zinc-100">
                            {{ __('Password') }}
                        </label>
                        @if (Route::has('password.request'))
                            <flux:link 
                                class="text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300" 
                                :href="route('password.request')" 
                                wire:navigate
                            >
                                {{ __('Forgot password?') }}
                            </flux:link>
                        @endif
                    </div>
                    <flux:input
                        wire:model="password"
                        id="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        placeholder="Enter your password"
                        viewable
                        class="h-11"
                    />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between pt-1">
                    <div class="flex items-center">
                        <flux:checkbox 
                            wire:model="remember" 
                            id="remember"
                            class="rounded"
                        />
                        <label for="remember" class="ml-2 text-sm text-zinc-700 dark:text-zinc-300 cursor-pointer select-none">
                            {{ __('Remember for 30 days') }}
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-1">
                    <flux:button 
                        variant="primary" 
                        type="submit" 
                        class="w-full h-11 font-medium" 
                        data-test="login-button"
                    >
                        {{ __('Sign in') }}
                    </flux:button>
                </div>
            </form>
        </div>
    </div>

    <!-- Register Link -->
    @if (Route::has('register'))
        <div class="mt-6 text-center">
            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                {{ __('Don\'t have an account?') }}
                <flux:link 
                    :href="route('register')" 
                    wire:navigate
                    class="font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 ml-1"
                >
                    {{ __('Sign up for free') }}
                </flux:link>
            </p>
        </div>
    @endif

    <!-- Footer -->
    <div class="mt-8 pt-6 border-t border-zinc-200 dark:border-zinc-800">
        <p class="text-center text-xs text-zinc-400 dark:text-zinc-600 mt-4">
            {{ __('© 2025 Toyota Paal 10. All rights reserved.') }}
        </p>
    </div>
</div>