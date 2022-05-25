<div class='flex flex-row justify-center min-h-screen  py-12 bg-gray-50 sm:px-6 lg:px-8 border-2'>
    <div class='m-4 border-2 min-w-[500px] min-h-[600px] datamap-holder max-h-[800px]'>Data Map UI</div>
    <div class='flex-col max-h-[80vh] overflow-auto min-w-[400px] '>
        <div class='m-4 border-2  min-w-max min-h-[100px] datamap-holder flex fixed justify-end bg-white '>
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

        </div>
        <div class='m-4 border-2  min-w-max min-h-[150px] datamap-holder pl-2 mt-[125px]'>
            <p>World</p>
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
        @foreach ($this->UserCountries as $user_country)
            
            <div class='m-4 border-2  min-w-max min-h-[150px] datamap-holder pl-2'>
                <p><x-button wire:click='deleteCountries({{$user_country}})' label="x" class='mt-6 max-h-[35px] max-w-[35px]' />{{$user_country->name}}</p> 
                <div class='flex justify-center space-x-2 mt-7 ml-4 mr-4 mb-4'>
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
        @endforeach

    </div>
    {{$this->selected_countries_detailed}}
    {{-- Nothing in the world is as soft and yielding as water. --}}
</div>
