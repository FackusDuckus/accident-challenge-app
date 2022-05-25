<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Facades\Http;

class CovidMap extends Component
{
    public $user;
    public $user_countries;
    public $country_list;
    public $selected_countries;
    public $selected_countries_detailed;

    public function mount()
    {
        // $this->permissions = Permission::all();
        // $this->roles = Role::all();

        $this->user = Auth::user();
        $this->country_list = Country::all();
        $this->selected_countries = [];
        $this->selected_countries_detailed = $this->queryCountries($this->userCountries);
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
        $countriesQueried = Country::find($this->selected_countries);
        $this->user->countries()->syncWithoutDetaching($countriesQueried);
        $this->selected_countries_detailed = collect($this->selected_countries_detailed)->merge($this->queryCountries(collect($countriesQueried)));
        $this->reset('UserCountries');
    }

    public function deleteCountries($user_country){
        $this->user->countries()->detach($user_country['id']);
        $this->reset('UserCountries');
    }

    public function queryCountry($user_country){
        //dd($user_country);
        $response = Http::get('https://covid19.mathdro.id/api/countries/' . $user_country->country_code);
        if($response->successful()){
            return $response;
        } else {
            return false;
        }
    }

    public function queryCountries($user_countries){

       return $user_countries->map(function($country){
            $country_copy = $country;
            $data = $this->queryCountry($country);
            if($data){
                $country_copy['confirmed'] = $data['confirmed'];
                $country_copy['recovered'] = $data['recovered'];
                $country_copy['deaths'] = $data['deaths'];
            } else {
                $country_copy['confirmed'] = 0;
                $country_copy['recovered'] = 0;
                $country_copy['deaths'] = 0;
            }

            return $country_copy;
       });
        
    }
}
