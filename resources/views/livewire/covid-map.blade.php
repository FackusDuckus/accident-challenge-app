<div class='flex flex-row justify-center min-h-screen  py-12 bg-gray-50 sm:px-6 lg:px-8 border-2'>
    <div class='m-4 border-2 min-w-[500px] min-h-[600px] datamap-holder'>Data Map UI</div>
    <div class='flex-col'>
        <div class='m-4 border-2  min-w-[300px] min-h-[100px] datamap-holder flex justify-end'>
            <div class='flex-col border-2 min-w-[200px] max-h-10 mt-2'>
                <x-select
                    label="Countries"
                    placeholder=""
                    multiselect
                    {{-- :options="['Active', 'Pending', 'Stuck', 'Done']" --}}
                    :async-data="route('countries.index')"
                    option-label="name"
                    option-value="id"
                    wire:model="selected_countries"
                />
            </div>
            <div class='flex-col border-2 mt-2'>
                <x-button wire:click='addCountries()' label="Add" class='mt-6' />
            </div>
            @foreach ($this->UserCountries as $user_country)
                <p>{{$user_country->name}}</p>
            @endforeach
        </div>

        <div class='m-4 border-2  min-w-[300px] min-h-[150px] datamap-holder pl-2'>
            World
            <div class='flex justify-center space-x-2 mt-7 ml-4 mr-4'>
                <div class='border-2 boxes flex-col min-w-[20px] min-h-[75px] align-middle text-center'>
                    <div class='flex-row mt-4'>99</div>
                    <div class='flex-row'><h5>Active</h5></div>
                </div>
                <div class='border-2 boxes flex-col min-w-[20px] min-h-[75px] align-middle text-center'>
                    <div class='flex-row mt-4'>99</div>
                    <div class='flex-row'><h5>Active</h5></div>
                </div>
                <div class='border-2 boxes flex-col min-w-[20px] min-h-[75px] align-middle text-center'>
                    <div class='flex-row mt-4'>99</div>
                    <div class='flex-row'><h5>Active</h5></div>
                </div>
                <div class='border-2 boxes flex-col min-w-[20px] min-h-[75px] align-middle text-center'>
                    <div class='flex-row mt-4'>99</div>
                    <div class='flex-row'><h5>Active</h5></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Nothing in the world is as soft and yielding as water. --}}
</div>
