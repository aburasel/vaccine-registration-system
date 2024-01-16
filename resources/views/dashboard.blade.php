<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <ul class=" sm:rounded-lg p-10">
                    @foreach ($patients as $patient)
                        <li class="pt-3 pb-1 sm:pt-4 border-y-2 border-stone-100">
                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                <div class="flex-shrink-0">
                                    
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ $patient->name }}
                                    </p>
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ $patient->center }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ $patient->email }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                    
                                        
                                        @if ($patient->vaccination_status == 1)
                                            Not vaccinated
                                        @else
                                            @if ($patient->vaccination_status == 2)
                                                Scheduled
                                                @else
                                                Vaccinated
                                            @endif
                                        @endif
                                    
                                    
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-wrap justify-center">
                    {{ $patients->links() }}
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
