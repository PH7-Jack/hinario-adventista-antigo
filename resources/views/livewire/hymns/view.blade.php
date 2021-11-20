<div class="flex flex-col min-h-screen pb-20">
    <x-svg.arabesque class="mt-6 mx-auto w-52 h-auto text-gray-300" />

    <section class="flex flex-col gap-8 mb-8 mt-6 p-4 pt-0 text-gray-600 text-center">
        <div>
            <h4 class="text-xl">
                {{ $hymn->number }}
            </h4>

            <h3 class="text-2xl">
                {{ $hymn->title }}
            </h3>
        </div>

        @foreach ($hymn->strophes as $strophe)
            <div wire:key="strophes.{{ $strophe->id }}" class="flex flex-col gap-8">
                <h5 class="text-lg">
                    {{ $strophe->title }}
                </h5>

                <span class="whitespace-pre-line">{{ $strophe->text }}</span>
            </div>
        @endforeach
    </section>

    <div class="fixed bottom-0 w-full p-3 z-10">
        <div class="flex items-center justify-between mx-4 p-1 bg-white text-gray-500 rounded-full shadow-md">
            <x-button rounded flat secondary>
                <x-icon name="chevron-left" class="w-6 h-6" />
            </x-button>

            <x-button rounded flat secondary>
                <x-icon name="share" class="w-6 h-6" />
            </x-button>

            <x-button rounded flat secondary class="font-bold text-lg">
                A+
            </x-button>

            <x-button rounded flat secondary class="font-bold text-lg">
                A-
            </x-button>

            <x-button rounded flat secondary>
                <x-icon name="chevron-right" class="w-6 h-6" />
            </x-button>
        </div>
    </div>

    @include('layouts.guest.footer')

    <x-svg.arabesque class="mt-6 mx-auto w-52 h-auto rotate-180 text-gray-300" />
</div>
