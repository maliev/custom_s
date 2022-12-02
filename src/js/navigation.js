export let hamburger = function () {
    // Hamburger
    let hamburgerID = document.getElementById('menu-primary-btn'),
        bodyTag = document.body;

    hamburgerID.addEventListener('click', () => {
        hamburgerID.classList.toggle('is-active')
        bodyTag.classList.toggle('menu-open')
    })

    //Close Menu if clicked outside menu
    document.addEventListener('click', function (e) {

        if (e.target.closest(".menu-primary-btn") === null &&
            hamburgerID.classList.contains("is-active") &&
            e.target.closest(".navigation--header") === null) {
            bodyTag.classList.toggle('menu-open');
            hamburgerID.classList.toggle('is-active');
        }
    })
}

export let navigation = function () {
    /*
       Hide header on scroll down and display on scroll up
    */

    let elSelector = '.header',
        elClassNarrow = 'header--narrow',
        elNarrowOffset = 50,
        element = document.querySelector(elSelector),
        dHeight = 0,
        wHeight = 0,
        wScrollCurrent = window.pageYOffset,
        wScrollBefore = 0,
        wScrollDiff = 0,
        menuItems = document.querySelectorAll('.header a[href^="#"'),
        sections = document.querySelectorAll('section'),
        current = window.location.pathname,
        hamburgerID = document.getElementById('menu-primary-btn'),
        bodyTag = document.body;


    //functions
    let hasElementClass = (element, className) => {
        return element.classList ? element.classList.contains(className) : new RegExp('(^| )' + className + '( |$)', 'gi').test(element.className);
    };

    let addElementClass = (element, className) => {
        element.classList ? element.classList.add(className) : element.className += ' ' + className;
    };

    let removeElementClass = (element, className) => {
        element.classList ? element.classList.remove(className) : element.className = element.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
    };

    //on windows wheel & scroll
    if (wScrollCurrent > elNarrowOffset) {
        // toggles "narrow" classname
        if (!hasElementClass(element, elClassNarrow))
            addElementClass(element, elClassNarrow);
    }

    window.addEventListener('scroll', () => {
        dHeight = document.body.offsetHeight;
        wHeight = window.innerHeight;
        wScrollCurrent = window.pageYOffset;
        wScrollDiff = wScrollBefore - wScrollCurrent;

        if (wScrollCurrent > elNarrowOffset) {
            // toggles "narrow" classname
            if (!hasElementClass(element, elClassNarrow))
                addElementClass(element, elClassNarrow);
        } else removeElementClass(element, elClassNarrow);

        wScrollBefore = wScrollCurrent;
    })

}


