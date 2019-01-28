<?php
use ThiagoPrado\Services\Models\Expectation;
use ThiagoPrado\Services\Models\Clinic;

Route::get('seed-expectations', function () {
    $faker = Faker\Factory::create();
    for ($i = 0; $i < 10; $i++) {
        $name = $faker->sentence($nbWords = 3, $variableNbWoeds = true);
        $description = $faker->paragraph($nbSentences = 3, $variableNbSentences = true);

        Expectation::create([
            'name' => $name,
            'description' => $description,
        ]);
    }

    return "Expectations Seeded!";
});

Route::get('seed-clinics', function () {
    $faker = Faker\Factory::create();
    for ($i = 0; $i < 10; $i++) {
        $clinic = $faker->sentence($nbWords = 3, $variableNbWoeds = true);

        Clinic::create([
            'clinic_title' => $clinic,
            'slug' => str_slug($clinic, '-'),
        ]);
    }

    return "Clinics Seeded!";
});

?>