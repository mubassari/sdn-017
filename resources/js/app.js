require("./bootstrap");

import { createApp, h } from "vue";
import { createInertiaApp, Link } from "@inertiajs/vue3";

// Ziggy
import { ZiggyVue } from "ziggy";
import { Ziggy } from "./ziggy";

import { FontAwesome } from "~Components/core";

createInertiaApp({
    resolve: async (name) => (await import(`./Pages/${name}`)).default,
    title: (title) => (title === "" ? "SI PHBS" : `${title} | SI PHBS`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component("font-awesome-icon", FontAwesome)
            .component("Link", Link)
            .mount(el);
    },
    progress: {
        delay: 250,
        color: "#007bff",
        includeCSS: true,
        showSpinner: false,
    },
});
