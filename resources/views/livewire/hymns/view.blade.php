<div class="flex flex-col min-h-screen pb-20">
    <x-svg.arabesque class="mt-6 mx-auto w-52 h-auto text-gray-300" />

    <section class="flex flex-col gap-8 mb-8 mt-6 p-4 pt-0 text-gray-600 text-center"
        x-data="{
            size: $persist(2),
            sizes: [
                'text-xs',
                'text-sm',
                'text-base',
                'text-lg',
                'text-xl',
                'text-2xl',
                'text-3xl',
                'text-4xl',
                'text-5xl',
                'text-6xl',
                'text-7xl',
            ],
            get sizeClass() {
                return this.sizes[this.size]
            },
            decrease() {
                this.size = Math.max(0, this.size - 1)
            },
            increase() {
                this.size = Math.min(this.sizes.length - 1, this.size + 1)
            }
        }"
        x-on:size::decrease.window="decrease"
        x-on:size::increase.window="increase">
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

                <span class="whitespace-pre-line transition-all ease-linear duration-200" :class="{ [sizeClass]: true }">{{ $strophe->text }}</span>
            </div>
        @endforeach
    </section>

    <div class="fixed bottom-0 w-full py-3 px-4 gap-x-4 z-10 flex items-center"
        x-data="{
            scroll: 0,
            state: true,

            init() {
                $watch('scroll', (scroll, oldScroll) => {
                    scroll > oldScroll
                        ? this.state = true
                        : this.state = false
                })
            },
            onScroll(event) {
                this.scroll = event.target.documentElement.scrollTop
            }
        }"
        x-on:scroll.window="onScroll"
        x-show="state"
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-y-full"
        x-transition:enter-end="-translate-y-0"
        x-transition:leave="transform transition ease-in duration-300"
        x-transition:leave-start="-translate-y-0"
        x-transition:leave-end="translate-y-full">
        <div class="flex flex-shrink-0 p-1 bg-white text-gray-500 rounded-full shadow-md">
            <a href="{{ route('hymns.index') }}">
                <x-button
                    class="font-bold text-lg bg-white"
                    flat
                    rounded>
                    <x-icon name="home" class="w-6 h-6" />
                </x-button>
            </a>
        </div>

        <div class="w-full flex items-center justify-between p-1 bg-white text-gray-500 rounded-full shadow-md">
            <x-button
                wire:click="previous"
                rounded
                flat
                secondary
                :disabled="$hymn->number === 1">
                <x-icon name="chevron-left" class="w-6 h-6" />
            </x-button>

            <x-button
                x-data="{
                    share() {
                        const shareData = {
                            text: 'Louve o Senhor com o hino {{ $hymn->number }} - {{ $hymn->title }}',
                            url: '{{ route('hymns.view', $hymn) }}',
                        }

                        if (navigator.share) {
                            this.navigatorShare(shareData)
                        }

                        this.copyToClipboard(shareData.url)

                        $wireui.notify({
                            icon: 'success',
                            description: 'URL copiada para a área de transferência',
                            timeout: 3000,
                        })
                    },
                    navigatorShare(shareData) {
                        try {
                            navigator.share(shareData)
                        } catch(e) {}
                    },
                    copyToClipboard(url) {
                        const textarea = document.createElement('textarea')
                        textarea.value = url
                        document.body.appendChild(textarea)
                        textarea.select()
                        document.execCommand('copy')
                        textarea.remove()
                    }
                }"
                x-on:click="share"
                rounded
                flat
                secondary>
                <x-icon name="share" class="w-6 h-6" />
            </x-button>

            <x-button
                rounded
                flat
                secondary
                x-data="{}"
                x-on:click="$dispatch('size::decrease')"
                class="font-bold text-lg">
                A-
            </x-button>

            <x-button
                rounded
                flat
                secondary
                x-data="{}"
                x-on:click="$dispatch('size::increase')"
                class="font-bold text-lg">
                A+
            </x-button>

            <x-button
                wire:click="next"
                rounded
                flat
                secondary
                :disabled="$hymn->number === 610">
                <x-icon name="chevron-right" class="w-6 h-6" />
            </x-button>
        </div>
    </div>

    @include('layouts.guest.footer')

    <x-svg.arabesque class="mt-6 mx-auto w-52 h-auto rotate-180 text-gray-300" />
</div>
