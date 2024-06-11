import Collapse from 'bootstrap/js/dist/collapse'

function remove_hash_from_url() {
    const uri = window.location.toString();

    if (uri.indexOf("#") > 0) {
        let clean_uri = uri.substring(0, uri.indexOf("#"));
        window.history.replaceState({}, document.title, clean_uri);
    }
}

Array.from(document.querySelectorAll('.accordion'))
    .forEach(accordionNode => new Collapse(accordionNode))

document.addEventListener("DOMContentLoaded", (event) => {
    const sanitizeHash = hash => hash.replace(/%20/g, "-").toLowerCase().replace(/\s+/g, '-').replace(/[^a-zA-Z0-9-]/g, '');

    const getHashUrl = window.location.hash

    if (getHashUrl) {
        const targetSelector = document.querySelector(`[data-accordion-title*="${sanitizeHash(getHashUrl)}"]`);

        if (targetSelector !== null) {
            remove_hash_from_url();
            targetSelector.querySelector('button').classList.remove('collapsed')
            targetSelector.querySelector('.accordion-collapse').classList.add('show')

            let elementPosition = targetSelector.getBoundingClientRect().top;
            let offsetPosition = elementPosition - 130;

            window.scrollTo({
                top: offsetPosition,
                behavior: "smooth"
            });
        }
    }
})

