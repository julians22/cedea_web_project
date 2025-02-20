import { Mark, mergeAttributes } from "@tiptap/core";

const NoBreak = Mark.create({
    name: "no-break",
    group: "block",
    content: "block+",
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
                getAttrs: (element) => element.style.wordBreak,
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
                    console.log(attributes);
                    console.log(commands);
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
