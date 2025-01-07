import { Mark, mergeAttributes } from "@tiptap/core";

const NoBreak = Mark.create({
    name: "no-break",

    addOptions() {
        return {
            HTMLAttributes: {},
        };
    },

    addAttributes() {
        return {
            color: {
                default: null,
                parseHTML: (element) => element.style.wordBreak,
                renderHTML: (attributes) => {
                    if (!attributes.style.wordBreak) {
                        return {};
                    }
                    return {
                        style: "word-break: keep-all;",
                    };
                },
            },
        };
    },

    parseHTML() {
        return [
            {
                tag: "span",
            },
        ];
    },

    renderHTML({ HTMLAttributes }) {
        return [
            "span",
            mergeAttributes(this.options.HTMLAttributes, HTMLAttributes),
            0,
        ];
    },

    addCommands() {
        return {
            setNoBreak:
                (attributes) =>
                ({ commands }) => {
                    return commands.setMark(this.name, attributes);
                },
            toggleNoBreak:
                (attributes) =>
                ({ commands }) => {
                    return commands.toggleMark(this.name, attributes);
                },
            unsetNoBreak:
                () =>
                ({ commands }) => {
                    return commands.unsetMark(this.name);
                },
        };
    },
});

export default NoBreak;
