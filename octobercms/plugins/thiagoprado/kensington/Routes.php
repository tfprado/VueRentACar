<?php

use ThiagoPrado\Kensington\Models\Vehicle;
use ThiagoPrado\Kensington\Models\Location;

Route::get('vehicles', function() {
    $vehicles = Vehicle::with(['locations', 'image', 'dates'])->get();
    return $vehicles;
});

Route::get('vehicles/filter/{id}', function($id) {
    $vehicles = Vehicle::whereHas('locations', function($query) use($id) {
        $query->where('id', '=', $id);
    })->get();
    return $vehicles;
});

Route::get('locations', function () {
    $locations = Location::all();
    return $locations;
});

Route::get('locations/list', function () {
    $locations = Location::all();

    foreach ($locations as $location) {
        $location['label'] = $location['title'];
        $location['value'] = $location['id'];
        unset($location['title']);
        unset($location['id']);
        unset($location['slug']);
    }

    return $locations;
});
