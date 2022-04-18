<div class="flex flex-col min-h-screen">
    <main class="my-auto flex flex-col p-4">
        <div class="flex flex-col justify-center items-center mx-auto mb-12">
            <x-svg.iasd-hymn class="w-32 h-32 text-gray-600" />

            <p class="mt-3 font-mono text-gray-700">
                Hinário Adventista
            </p>
        </div>

        <div class="rounded-md rounded-b-xl bg-indigo-100 p-4 border-b-8 border-indigo-200 shadow">
            <div class="flex">
                <div class="flex-shrink-0">
                    <x-icons.wifi-slash class="h-5 w-5 text-indigo-700" />
                </div>

                <div class="ml-3 flex-1 md:flex md:justify-between">
                    <p class="text-sm text-indigo-700">
                        Você está sem conexão com a internet.
                        Conecte-se novamente para usar este app.
                    </p>
                </div>
            </div>
        </div>
    </main>
</div>

@push('scripts')
    <script>
        console.log(navigator.onLine);
        if (navigator.onLine) {
            window.location.href = '/'
        }

        window.addEventListener('online', () => {
            window.location.href = '/'
        })
    </script>
@endpush
