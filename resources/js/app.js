require("./bootstrap");

import { createApp, h } from "vue";
import { createInertiaApp, Link } from "@inertiajs/vue3";

// Ziggy
import { ZiggyVue } from "ziggy";
import { Ziggy } from "./ziggy";

/* import the fontawesome core */
import { library } from "@fortawesome/fontawesome-svg-core";

/* import font awesome icon component */
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

/* import specific icons */
import {
    fa1,
    fa2,
    fa3,
    faAngleUp,
    faAlignCenter,
    faAlignJustify,
    faAlignLeft,
    faAlignRight,
    faArrowRightLong,
    faBars,
    faBroom,
    faBold,
    faCaretDown,
    faCaretLeft,
    faCaretRight,
    faCaretUp,
    faColumns,
    faCompress,
    faEye,
    faHeading,
    faItalic,
    faLink,
    faListOl,
    faListUl,
    faLocationDot,
    faMoon,
    faParagraph,
    faPenToSquare,
    faPlus,
    faRedoAlt,
    faStrikethrough,
    faSun,
    faTable,
    faTimes,
    faTrash,
    faUnderline,
    faUndoAlt,
    faQuoteLeft,
} from "@fortawesome/free-solid-svg-icons";

/* add icons to the library */
library.add(
    fa1,
    fa2,
    fa3,
    faAngleUp,
    faAlignCenter,
    faAlignJustify,
    faAlignLeft,
    faAlignRight,
    faArrowRightLong,
    faBars,
    faBroom,
    faBold,
    faCaretDown,
    faCaretLeft,
    faCaretRight,
    faCaretUp,
    faColumns,
    faCompress,
    faEye,
    faHeading,
    faItalic,
    faLink,
    faListOl,
    faListUl,
    faLocationDot,
    faMoon,
    faParagraph,
    faPenToSquare,
    faPlus,
    faRedoAlt,
    faStrikethrough,
    faSun,
    faTable,
    faTimes,
    faTrash,
    faUnderline,
    faUndoAlt,
    faQuoteLeft
);

createInertiaApp({
    resolve: async (name) => (await import(`./Pages/${name}`)).default,
    title: (title) => (title === "" ? "SI PHBS" : `${title} | SI PHBS`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component("font-awesome-icon", FontAwesomeIcon)
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
