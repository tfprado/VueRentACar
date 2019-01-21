(function () {
    "use strict";

    /**
     * Auxiliary Schema
     */
    fluid.defaults("awesomeCars.prefs.auxSchema", {

        // the base grade for the schema
        gradeNames: ["fluid.prefs.auxSchema"],

        auxiliarySchema: {

            // the loaderGrade identifies the "base" form of preference editor desired
            loaderGrades: ["fluid.prefs.fullNoPreview"],

            // 'terms' are strings that can be re-used elsewhere in this schema;
            terms: {
                templatePrefix: "http://localhost:8000/themes/demo/assets/infusion/html"
            },

            // the main template for the preference editor itself
            template: "%templatePrefix/prefsEditorTemplate.html",

            heatedSeats: {
                // this 'type' must match the name of the pref in the primary schema
                type: "awesomeCars.prefs.heatedSeats",
                panel: {
                    // this 'type' must match the name of the panel grade created for this pref
                    type: "awesomeCars.prefs.panels.heatedSeats",

                    // selector indicating where, in the main template, to place this panel
                    container: ".awec-heatedSeats",

                    // the template for this panel
                    template: "%templatePrefix/heatedSeats.html"
                }
            },

            radioVolume: {
                type: "awesomeCars.prefs.radioVolume",
                panel: {
                    type: "awesomeCars.prefs.panels.radioVolume",
                    container: ".awec-radioVolume",
                    template: "%templatePrefix/radioVolume.html"
                }
            }

        }
    });


})();
