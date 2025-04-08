import focus from "@alpinejs/focus";
import resize from "@alpinejs/resize";
import dialog from "@fylgja/alpinejs-dialog";
import { defineElement } from "@lordicon/element";
import lottie from "lottie-web";
import { animate, stagger } from "motion";
import { Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm";
import "./bootstrap";

window.Motion = { animate, stagger };

Alpine.plugin(focus);
Alpine.plugin(resize);
Alpine.plugin(dialog);

document.addEventListener("alpine:init", () => {
    Alpine.data("modal", () => ({ modalOpen: false }));
});

Livewire.start();

// define "lord-icon" custom element with default properties
defineElement(lottie.loadAnimation);
