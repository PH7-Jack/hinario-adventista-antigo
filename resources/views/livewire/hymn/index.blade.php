<div class="flex flex-col min-h-screen">
    <div class="flex flex-col p-4"
        x-data="{
            keyboard: true,
            hymn: '',

            init() {
                $watch('keyboard', (keyboard) => {
                    this.hymn = ''

                    if (keyboard) {
                        $nextTick(() => {
                            this.$refs.keyboard.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            })
                        })
                    }
                })
            },
            addNumber(number) {
                if (this.hymn.length === 3) {
                    return $wireui.notify({
                        title: 'Você só pode digitar até 3 digitos',
                        timeout: 3000,
                        icon: 'info'
                    })
                }

                this.hymn += number
            },
            backspace() {
                this.hymn = this.hymn.slice(0, -1)
            },
            open() {
                if (this.hymn < 1 || this.hymn > 610) {
                    return $wireui.notify({
                        title: 'Você só pode digitar números entre 1 e 610',
                        timeout: 3000,
                        icon: 'info'
                    })
                }

                // todo: redirect to hymn page
            }
        }">
        <div class="flex flex-col justify-center items-center mx-auto mt-20 mb-12">
            <x-svg.iasd-hymn class="w-32 h-32 text-gray-600" />

            <p class="mt-3 font-mono text-gray-700">
                Hinário Adventista
            </p>
        </div>

        <x-input
            class="pr-12"
            x-bind:class="{
                'text-center': keyboard
            }"
            icon="search"
            x-model="hymn">
            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                    <x-button
                        x-on:click="keyboard = !keyboard"
                        class="rounded-r-md h-full"
                        primary
                        flat
                        squared
                        x-cloak>
                        <x-svg.alpha x-show="keyboard" class="w-6 h-6 text-gray-400" />
                        <x-svg.numeric x-show="!keyboard" class="w-6 h-6 text-gray-400" />
                    </x-button>
                </div>
            </x-slot>
        </x-input>

        <div class="mx-auto grid grid-cols-3 gap-x-8 gap-y-4 my-8"
            x-show="keyboard"
            x-ref="keyboard"
            x-transition>
            @for ($i = 1; $i <= 9; $i++)
                <x-keyboard-button x-on:click="addNumber({{ $i }})" :label="$i" />
            @endfor

            <x-keyboard-button x-on:click="open">
                <x-icon class="w-8 h-8" name="check" style="solid" />
            </x-keyboard-button>

            <x-keyboard-button x-on:click="addNumber(0)" label="0" />

            <button
                class="mx-auto focus:outline-none text-gray-400 hover:text-gray-500 transition-all ease-in-out duration-200"
                x-on:click="backspace"
                type="button">
                <x-icon class="w-10 h-10" name="backspace" style="solid" />
            </button>
        </div>
    </div>

    <span class="text-xs text-gray-400 text-center mt-auto mb-4">
        Open Source Project
    </span>
</div>
