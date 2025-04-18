import preset from "../../../../vendor/filament/filament/tailwind.config.preset";

export default {
    presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./vendor/awcodes/filament-table-repeater/resources/**/*.blade.php",
        "./vendor/awcodes/matinee/resources/views/**/*.blade.php",
        "./vendor/awcodes/filament-tiptap-editor/resources/**/*.blade.php",
    ],
};
