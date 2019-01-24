/**
 * Panel for the heated seats preference
 */
fluid.defaults("awesomeCars.prefs.panels.heatedSeats", {
    gradeNames: ["fluid.prefs.panel"],

    // the Preference Map maps the information in the primary schema to this panel
    preferenceMap: {
        // the key must match the name of the pref in the primary schema
        "awesomeCars.prefs.heatedSeats": {
            // this key, "model.heatedSeats", is the path into the panel's model
            // where this preference is stored
            "model.heatedSeats": "default"
        }
    },

    // selectors identify elements in the DOM that need to be accessed by the code;
    // in this case, the Renderer will render data into these particular elements
    selectors: {
        heatedSeats: ".awec-heatedSeats"
    },

    // the ProtoTree is basically instructions to the Renderer
    // the keys in the protoTree match the selectors above
    protoTree: {
        // "${heatedSeats}" is a reference to the last part of the model path in the preferenceMap
        heatedSeats: "${heatedSeats}"
    }
});


fluid.defaults("awesomeCars.prefs.panels.radioVolume", {
    gradeNames: ["fluid.prefs.panel"],

    preferenceMap: {
        "awesomeCars.prefs.radioVolume": {
            "model.radioVolume": "default",
            "range.min": "minimum",
            "range.max": "maximum",
            "range.step": "divisibleBy"
        }
    },

    range: {
        min: 1,
        max: 10,
        step: 1
    },

    selectors: {
        radioVolume: ".awec-radioVolume"
    },

    protoTree: {
        radioVolume: {
            value: "${radioVolume}",
            decorators: [{
                type: "attrs",
                attributes: {
                    min: "{that}.options.range.min",
                    max: "{that}.options.range.max",
                    step: "{that}.options.range.step"
                }
            }]
        }
    }
});
