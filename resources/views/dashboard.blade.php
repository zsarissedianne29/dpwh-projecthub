<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            🚧 DPWH ProjectHub Dashboard
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-blue-600 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold">Total Projects</h3>
                    <p class="text-4xl mt-4">0</p>
                </div>

                <div class="bg-yellow-500 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold">Ongoing Projects</h3>
                    <p class="text-4xl mt-4">0</p>
                </div>

                <div class="bg-green-600 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold">Completed Projects</h3>
                    <p class="text-4xl mt-4">0</p>
                </div>

                <div class="bg-red-600 text-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold">Delayed Projects</h3>
                    <p class="text-4xl mt-4">0</p>
                </div>

            </div>

            <div class="bg-white rounded-lg shadow mt-8 p-6">

                <h2 class="text-2xl font-bold mb-4">
                    Welcome to DPWH ProjectHub
                </h2>

                <p>
                    This system will be used to monitor infrastructure projects,
                    collect field survey data, upload project photos,
                    and generate accomplishment reports.
                </p>

            </div>

        </div>

    </div>

</x-app-layout>