# Seeding

## Seeding with routes
In a plugin you are able to seed a database with a Routes.php file. 

    .octobercms
    |-> plugins
        |-> thiagoprado
            |-> services
                |-> components
                |-> controllers
                |-> formwidgets
                |-> lang
                |-> models
                |-> updates
                |-> Plugin.php
                |-> plugin.yaml
                |-> Routes.php  // Code goes here


The following code uses this demo plugins `Expection` and `Clinic` models to seed 10 clinics and expectations using faker plugin as an example. This does not tear down the current database.

```php
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
```