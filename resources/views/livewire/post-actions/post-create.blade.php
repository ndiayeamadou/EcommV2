<div>
    <div class="flex justify-end">
        <a href="/posts" wire:navigate.hover class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Posts</a>
    </div>
    
    <div>
        <form wire:submit="store" class="flex flex-col gap-6 max-w-md mx-auto bg-slate-900 p-4 shadow-2xl rounded-2xl">
            <!-- Title -->
            <flux:input
                wire:model="form.title"
                :label="__('Title')"
                type="text"
                required
                autofocus
                placeholder="Post Title"
            />
    
            <!-- Image -->
            <div class="relative">
                <flux:input
                    wire:model="form.image"
                    :label="__('Image')"
                    type="file"
                />
            </div>

            <div>
                @if ($form->image)
                    <img src="{{ $form->image->temporaryURL() }}" class="w-12 h-12 rounded-2xl" alt="">
                @endif
            </div>

            <flux:textarea
                wire:model="form.content"
                :label="__('Description')"
                placeholder="Post Description"
            />
    
            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full">{{ __('Create') }}</flux:button>
            </div>
        </form>
    </div>

</div>
