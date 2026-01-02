<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public string $password = '';

    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();
        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="mt-12 pt-10 border-t border-zinc-200 dark:border-zinc-700">
    <div class="mb-6">
        <flux:heading size="lg" class="mb-2 text-zinc-900 dark:text-zinc-100">
            {{ __('Delete account') }}
        </flux:heading>
        <flux:subheading class="text-zinc-600 dark:text-zinc-400">
            {{ __('Permanently delete your account and all of its resources') }}
        </flux:subheading>
    </div>

    <div class="rounded-lg bg-red-50 dark:bg-red-900/20 p-5 ring-1 ring-red-200 dark:ring-red-800">
        <div class="flex gap-3 mb-5">
            <svg class="h-5 w-5 text-red-600 dark:text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div>
                <p class="text-sm font-medium text-red-900 dark:text-red-200">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
                </p>
            </div>
        </div>

        <flux:modal.trigger name="confirm-user-deletion">
            <flux:button 
                variant="danger" 
                x-data="" 
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" 
                data-test="delete-user-button"
                class="transition-all duration-200"
            >
                {{ __('Delete Account') }}
            </flux:button>
        </flux:modal.trigger>
    </div>

    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
        <form method="POST" wire:submit="deleteUser" class="space-y-6">
            <div>
                <flux:heading size="lg" class="mb-3 text-zinc-900 dark:text-zinc-100">
                    {{ __('Are you sure you want to delete your account?') }}
                </flux:heading>

                <flux:subheading class="text-zinc-600 dark:text-zinc-400">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </flux:subheading>
            </div>

            <flux:input 
                wire:model="password" 
                :label="__('Password')" 
                type="password"
                class="transition-all duration-200"
            />

            <div class="flex justify-end gap-3 pt-2">
                <flux:modal.close>
                    <flux:button variant="ghost">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="danger" type="submit" data-test="confirm-delete-user-button">
                    {{ __('Delete Account') }}
                </flux:button>
            </div>
        </form>
    </flux:modal>
</section>