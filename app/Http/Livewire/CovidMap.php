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
    public $world_data;
    public $selected_countries;
    public $selected_countries_detailed;

    public function mount()
    {

        $this->user = Auth::user();
        $this->country_list = Country::all();
        $this->selected_countries = [];
        $this->selected_countries_detailed = $this->queryCountries($this->userCountries);
        $this->world_data = $this->queryAndSaveWorldData();
        //dd($this->world_data);
    }

    // Computed Property

    public function getUserCountriesProperty()

    {

        return Auth::user()->countries;

    }

    public function render()
    {
        
        return view('livewire.covid-map');
    
    }


    public function addCountries(){
        $countriesQueried = Country::find($this->selected_countries);
        $this->user->countries()->syncWithoutDetaching($countriesQueried);
        $this->selected_countries_detailed = collect($this->selected_countries_detailed)->merge($this->queryCountries($countriesQueried));
        $this->reset('UserCountries');
    }

    public function deleteCountries(Country $user_country){
        $this->user->countries()->detach($user_country['id']);
        //$this->selected_countries_detailed = $this->selected_countries_detailed->except($user_country['id']);
        $this->selected_countries_detailed = $this->queryCountries($this->userCountries);
        $this->reset('UserCountries');

    }

    public function queryCountry($user_country){
        $response = Http::get('https://covid19.mathdro.id/api/countries/' . $user_country->country_code);
        if($response->successful()){
            return $response;
        } else {
            return false;
        }
    }

    public function queryAndSaveWorldData(){
        $response = Http::get('https://covid19.mathdro.id/api');
        $copy = [];
        if($response->successful()){
            $copy['confirmed'] = $response['confirmed'];
            $copy['recovered'] = $response['recovered'];
            $copy['deaths'] = $response['deaths'];
            $copy['total'] =[
                "value" => $response['confirmed']['value'] + $response['recovered']['value'] + $response['deaths']['value']
            ];
            //dd($copy);
            return $copy;
        } else {
            $copy['confirmed'] = [
                'value' => 'N/A'
            ];
            $copy['recovered'] = [
                'value' => 'N/A'
            ];
            $copy['deaths'] = [
                'value' => 'N/A'
            ];
            $copy['total'] = [
                'value' => 'N/A'
            ];
            return $copy;
        }
    }

    public function renderCountry($user_country){
        $results = $this-queryCountry($user_country);
        $country_copy = $country->toArray();
        if($results){
            $country_copy['confirmed'] = $results['confirmed'];
            $country_copy['recovered'] = $results['recovered'];
            $country_copy['deaths'] = $results['deaths'];
            $country_copy['total'] =[
                "value" => $results['confirmed']['value'] + $results['recovered']['value'] + $results['deaths']['value']
            ];
        } else {
            $country_copy['confirmed'] = [
                'value' => 'N/A'
            ];
            $country_copy['recovered'] = [
                'value' => 'N/A'
            ];
            $country_copy['deaths'] = [
                'value' => 'N/A'
            ];
            $country_copy['total'] = [
                'value' => 'N/A'
            ];
        }
        return $country_copy;
    }

    public function queryCountries($user_countries){
       return $user_countries->map(function($country){
            $country_copy = $country->toArray();
            $data = $this->queryCountry($country);
            if($data){
                $country_copy['confirmed'] = $data['confirmed'];
                $country_copy['recovered'] = $data['recovered'];
                $country_copy['deaths'] = $data['deaths'];
                $country_copy['total'] =[
                    "value" => $data['confirmed']['value'] + $data['recovered']['value'] + $data['deaths']['value']
                ];
            } else {
                $country_copy['confirmed'] = [
                    'value' => 'N/A'
                ];
                $country_copy['recovered'] = [
                    'value' => 'N/A'
                ];
                $country_copy['deaths'] = [
                    'value' => 'N/A'
                ];
                $country_copy['total'] = [
                    'value' => 'N/A'
                ];
            }

            return $country_copy;
       });
        

    }
    public function queryWorld($user_countries){
       return $user_countries->map(function($country){
            $country_copy = $country->toArray();
            $data = $this->queryCountry($country);
            if($data){
                $country_copy['confirmed'] = $data['confirmed'];
                $country_copy['recovered'] = $data['recovered'];
                $country_copy['deaths'] = $data['deaths'];
                $country_copy['total'] =[
                    "value" => $data['confirmed']['value'] + $data['recovered']['value'] + $data['deaths']['value']
                ];
            } else {
                $country_copy['confirmed'] = [
                    'value' => 'N/A'
                ];
                $country_copy['recovered'] = [
                    'value' => 'N/A'
                ];
                $country_copy['deaths'] = [
                    'value' => 'N/A'
                ];
                $country_copy['total'] = [
                    'value' => 'N/A'
                ];
            }

            return $country_copy;
       });
        
    }
}
