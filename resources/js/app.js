require('./bootstrap');
import Alpine from 'alpinejs';
// import Datamap from 'datamaps';
import DataMap from '../../node_modules/datamaps/dist/datamaps.all.min.js';
window.Alpine = Alpine;
Alpine.start();

// TODO : Refactor into separate files, would implement @entangle to have state management going forward
//  was having fun using only livewire to try and update a ui and do api calls since it's my first time :)
// var map = new DataMap({element: document.getElementById('container')});

function getIndiaDataAndRender() {
    var indiaData;
    let mappedData = new Object();
    fetch('https://data.covid19india.org/state_district_wise.json')
        .then(response => response.json())
        .then(
            data => {


                Object.keys(data).map(function(key, index) {
                    let sum = new Object();
                    sum.active = 0;
                    sum.confirmed = 0;
                    sum.deceased = 0;
                    sum.recovered = 0;
                    sum.total = 0;

                    sum.active = Object.keys(data[key]['districtData']).map(el => data[key]['districtData'][el]['active']).reduce(function(previous, current){
                        return current + previous;

                    })
                    sum.confirmed = Object.keys(data[key]['districtData']).map(el => data[key]['districtData'][el]['confirmed']).reduce(function(previous, current){
                        return current + previous;
                    })
                    sum.deceased = Object.keys(data[key]['districtData']).map(el => data[key]['districtData'][el]['deceased']).reduce(function(previous, current){
                        return current + previous;
                    })
                    sum.recovered = Object.keys(data[key]['districtData']).map(el => data[key]['districtData'][el]['recovered']).reduce(function(previous, current){
                        return current + previous;
                    })
                    sum.total = sum.active + sum.confirmed + sum.deceased + sum.recovered;
                    if(sum.active > 1000){
                        sum.fillKey = 'MAJOR'
                    } else {
                        sum.fillKey = 'MINOR'
                    }
                    mappedData[data[key]['statecode']] = sum;

                })
                
                var map = new DataMap({
                    element: document.getElementById('container'),
                    scope: 'india',

                    geographyConfig: {
                        popupOnHover: true,
                        highlightOnHover: true,
                        borderColor: '#444',
                        borderWidth: 0.5,
                        dataUrl: 'https://rawgit.com/Anujarya300/bubble_maps/master/data/geography-data/india.topo.json',

                        popupTemplate: function(geography, data) { //this function should just return a string
                            return '<div class="hoverinfo"><strong>' +
                            '<ul>' +
                                '<li>' + 'Active: ' + data.active + '</li>' +
                                '<li>' + 'Confirmed: ' + data.confirmed + '</li>' +
                                '<li>' + 'Deceased: ' + data.deceased + '</li>' + 
                                '<li>' + 'Recovered: ' + data.recovered + '</li>' +
                                '<li>' + 'Total: ' + data.recovered + '</li>' +
                            '</ul>' +
                            '</strong></div>';
                          },
                    },

                    fills: {
                        'MAJOR': '#306596',
                        'MEDIUM': '#0fa0fa',
                        'MINOR': '#bada55',
                        defaultFill: '#dddddd'
                    },
                    data: mappedData,
                    setProjection: function (element) {
                        var projection = d3.geo.mercator()
                            .center([90.9629, 23.5937]) // always in [East Latitude, North Longitude]
                            .scale(1000);
                        var path = d3.geo.path().projection(projection);
                        return { path: path, projection: projection };
                    }
                });
            }
        );
    return mappedData;
}


getIndiaDataAndRender();
