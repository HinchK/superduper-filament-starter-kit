<x-filament-breezy::grid-section md=2 :title="__('filament-breezy::default.profile.personal_info.heading')" :description="__('filament-breezy::default.profile.personal_info.subheading')">
    <x-filament::card>
        <form wire:submit.prevent="submit" class="space-y-6">

            {{ $this->form }}

            <div class="text-right">
                <x-filament::button type="submit" wire:loading.attr="disabled" wire:target="submit" class="align-right">
                    <span wire:loading.remove wire:target="submit">Update Profile</span>
                    <span wire:loading wire:target="submit">Updating...</span>
                </x-filament::button>
            </div>
        </form>
    </x-filament::card>
</x-filament-breezy::grid-section>
