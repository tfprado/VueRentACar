<?php

use ThiagoPrado\Kensington\Models\Vehicle;

Route::get('vehicles', function() {
    $vehicles = Vehicle::all();
    return $vehicles;
});
