/**
 * Primary Schema
 * This schema defines the "heated seats" preference edited by this preferences
 * editor: its name, type, default value, etc.
 */
fluid.defaults("awesomeCars.prefs.schemas.heatedSeats", {

    // the base grade for the schema;
    // using this grade tells the framework that this is a primary schema
    gradeNames: ["fluid.prefs.schemas"],

    schema: {
        // the actual specification of the preference
        "awesomeCars.prefs.heatedSeats": {
            "type": "boolean",
            "default": false
        }
    }
});

fluid.defaults("awesomeCars.prefs.schemas.radioVolume", {
    gradeNames: ["fluid.prefs.schemas"],
    schema: {
        "awesomeCars.prefs.radioVolume": {
            "type": "number",
            "default": "2",
            "minimum": "1",
            "maximum": "5",
            "divisibleBy": "0.5"
        }
    }
});
