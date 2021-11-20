<div class="flex flex-col min-h-screen">
    <main class="my-auto flex flex-col p-4"
        x-data="{
            keyboard: @entangle('keyboard'),
            search:   @entangle('search').defer,

            init() {
                $watch('keyboard', (keyboard) => {
                    this.search = null

                    if (keyboard) {
                        $nextTick(() => {
                            this.$refs.keyboard.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            })
                        })
                    }
                })

                $watch('search', (search) => {
                    if (!this.keyboard) {
                        $wire.call('$refresh')
                    }
                })
            },
            addNumber(number) {
                if (this.search === null) this.search = ''

                if (this.search.length === 3) {
                    return $wireui.notify({
                        title: 'Você só pode digitar até 3 digitos',
                        timeout: 3000,
                        icon: 'info'
                    })
                }

                this.search += number
            },
            backspace() {
                this.search = this.search?.slice(0, -1)
            },
            open() {
                if (this.search < 1 || this.search > 610) {
                    return $wireui.notify({
                        title: 'Você só pode digitar números entre 1 e 610',
                        timeout: 3000,
                        icon: 'info'
                    })
                }

                $wire.open()
            }
        }">
        <div class="flex flex-col justify-center items-center mx-auto mt-20 mb-12">
            <x-svg.iasd-hymn class="w-32 h-32 text-gray-600" />

            <p class="mt-3 font-mono text-gray-700">
                Hinário Adventista
            </p>
        </div>

        <div class="mx-auto">
            <x-input
                class="pr-12 rounded-full"
                x-bind:class="{
                    'text-center': keyboard
                }"
                x-bind:type="keyboard ? 'number':'text'"
                icon="search"
                x-model.debounce.750ms="search">
                <x-slot name="append">
                    <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                        <x-button
                            x-on:click="keyboard = !keyboard"
                            class="!rounded-l-sm h-full"
                            spinner
                            primary
                            flat
                            rounded
                            x-cloak>
                            <x-svg.alpha   wire:loading.remove x-show="keyboard" class="w-6 h-6 text-gray-400" />
                            <x-svg.numeric wire:loading.remove x-show="!keyboard" class="w-6 h-6 text-gray-400" />
                        </x-button>
                    </div>
                </x-slot>
            </x-input>
        </div>

        <div class="mx-auto grid grid-cols-3 gap-x-8 gap-y-4 my-8"
            x-show="keyboard"
            x-ref="keyboard"
            x-transition>
            @for ($i = 1; $i <= 9; $i++)
                <x-keyboard-button x-on:click="addNumber({{ $i }})" :label="$i" />
            @endfor

            <button
                class="mx-auto focus:outline-none rotate-180 text-gray-400 hover:text-gray-500 transition-all ease-in-out duration-200"
                x-on:click="backspace"
                type="button">
                <x-icon class="w-10 h-10" name="backspace" style="solid" />
            </button>

            <x-keyboard-button x-on:click="addNumber(0)" label="0" />

            <x-keyboard-button x-on:click="open">
                <x-icon class="w-8 h-8" name="check" style="solid" />
            </x-keyboard-button>
        </div>

        @if (!$keyboard)
            <ul class="mt-4 sm:mx-auto space-y-4"
                x-show="!keyboard">
                @forelse ($this->hymns as $hymn)
                    <li wire:key="hymns.{{ $hymn->number }}.{{ $loop->index }}">
                        <a class="
                                flex items-center border rounded-lg shadow hover:shadow-md bg-white text-gray-600
                                transition-all ease-in-out duration-200 overflow-ellipsis-overflow-hidden
                                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500
                            "
                            href="{{ route('hymns.view', $hymn) }}">
                            <div class="w-16 p-4 text-xl font-semibold flex items-center justify-center flex-shrink-0 bg-gray-100">
                                {{ $hymn->number }}
                            </div>

                            <div class="truncate px-3">
                                <p class="text-sm font-semibold break-all">
                                    {{ $hymn->title }}
                                </p>

                                <span title="{{ $hymn->authors_names }}" class="text-xs text-gray-500">
                                    {{ $hymn->authors_names }}
                                </span>
                            </div>
                        </a>
                    </li>
                @empty
                    <li wire:key="hymns.empty"
                        class="flex flex-col justify-center items-center">
                        <x-svg.search-x class="w-24 h-24 text-gray-300" />

                        <p class="text-sm text-gray-400 underline">
                            Hino não encontrado
                        </p>
                    </li>
                @endforelse
            </ul>
        @endif
    </main>

    @include('layouts.guest.footer')
</div>
