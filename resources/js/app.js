import focus from "@alpinejs/focus";
import resize from "@alpinejs/resize";

import {
    Alpine,
    Livewire,
} from "../../vendor/livewire/livewire/dist/livewire.esm";
import "./bootstrap";

Alpine.plugin(focus);
Alpine.plugin(resize);

document.addEventListener("alpine:init", () => {
    Alpine.data("modal", () => ({ modalOpen: false }));
});

Livewire.start();
