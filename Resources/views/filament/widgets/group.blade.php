<x-filament-widgets::widget>
    <x-filament::section collapsible
        description="{{ $title }}"
        >
        @if(count($widgets)==1)
            @livewire($widgets[0]['class'], $widgets[0]['properties'])
        @endif


        @if(count($widgets)==3)
        <x-filament::grid lg='2'>
            <x-filament::grid.column>
                @livewire($widgets[0]['class'], $widgets[0]['properties'])

            </x-filament::grid.column>
            <x-filament::grid.column>
                @livewire($widgets[1]['class'], $widgets[1]['properties'])<br />
                @livewire($widgets[2]['class'], $widgets[2]['properties'])
            </x-filament::grid.column>
        </x-filament::grid>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>