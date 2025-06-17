document.addEventListener("DOMContentLoaded", function () {
    renderMathInElement(document.body, {
        delimiters: [{
            left: "$$",
            right: "$$",
            display: true
        }, {
            left: "$",
            right: "$",
            display: false
        }],
        ignoredTags: ["script", "noscript", "style", "textarea", "pre", "code"],
        ignoredClasses: ["nokatex"]
    });
});