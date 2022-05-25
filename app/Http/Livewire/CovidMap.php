<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Country;

class CovidMap extends Component
{
    public $user;
    public $user_countries;
    public $country_list;
    public $selected_countries;

    public function mount()
    {
        // $this->permissions = Permission::all();
        // $this->roles = Role::all();
        $this->user = Auth::user();
        $this->country_list = Country::all();
        $this->selected_countries = [];

    }

    // Computed Property

    public function getUserCountriesProperty()

    {

        return Auth::user()->countries;

    }

    public function render()
    {
        
        return view('livewire.covid-map');
        // return <<<'blade'

        //     <div>
        //         <div>
        

        //     </div>

        // blade;
    

    }

    public function addCountries(){
        $this->user->countries()->syncWithoutDetaching(Country::find($this->selected_countries));
        $this->reset('UserCountries');
    }

    public function deleteCountries($user_country){
        $this->user->countries()->detach($user_country['id']);
        $this->reset('UserCountries');
    }
}
