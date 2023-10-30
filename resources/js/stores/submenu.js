import { reactive } from "@vue/reactivity";

export default reactive({
    opened: null,
    set(index) {
        this.opened = this.opened == index ? null : index
    },
});
