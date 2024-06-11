import {hasElementClass, addElementClass, removeElementClass} from './helper'

const Navigation = (() => {
    /* all selectors & constants */
    const hamburger = document.getElementById('menu-primary-btn'),
        bodyTag = document.body,
        headerNavigation = document.querySelector('.navigation--header'),
        headerItems = headerNavigation.querySelectorAll('.navigation__item'),
        headerNavSubListWrap = document.querySelector('.navigation__sublist-wrap'),
        headerSubItems = document.querySelectorAll('.navigation__subitem'),
        headerElement = document.querySelector('.header'),
        elClassNarrow = 'header--narrow',
        isHamburgerViewport = window.matchMedia("(max-width: 1199px)").matches;

    /* all global variables  */
    let elNarrowOffset = 50,
        headerHeight = headerElement.getBoundingClientRect(),
        dHeight = 0,
        wHeight = 0,
        wScrollCurrent = window.pageYOffset,
        wScrollBefore = 0,
        wScrollDiff = 0;

    if (hamburger !== undefined && hamburger !== null) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('is-active')
            bodyTag.classList.toggle('menu-open')
            headerItems.forEach(item => removeElementClass(item, 'is--visible'))
        })

        //Close Menu if clicked outside menu
        document.addEventListener('click', function (e) {

            if (e.target.closest(".menu-primary-btn") === null &&
                hasElementClass(hamburger, "is-active") &&
                e.target.closest(".navigation--header") === null) {
                bodyTag.classList.toggle('menu-open');
                hamburger.classList.toggle('is-active');
            }
        })
    }

//on windows wheel & scroll
    if (wScrollCurrent > elNarrowOffset) {
        // toggles "narrow" classname
        if (!hasElementClass(headerElement, elClassNarrow))
            addElementClass(headerElement, elClassNarrow);
    }

    window.addEventListener('scroll', () => {
        dHeight = bodyTag.offsetHeight;
        wHeight = window.innerHeight;
        wScrollCurrent = window.pageYOffset;
        wScrollDiff = wScrollBefore - wScrollCurrent;

        if (wScrollCurrent > elNarrowOffset) {
            // toggles "narrow" classname
            if (!hasElementClass(headerElement, elClassNarrow))
                addElementClass(headerElement, elClassNarrow);
        } else removeElementClass(headerElement, elClassNarrow);

        wScrollBefore = wScrollCurrent;
    })

//display subnavigation list on click on navigation item 1 level
    if (headerItems !== undefined && headerItems !== null) {
        headerItems.forEach(headerItem => {
            const navBack = headerItem.querySelector('.navigation__back'),
                navClose = headerItem.querySelector('.navigation__close')

            if (navBack !== undefined && navBack !== null && navClose !== undefined && navClose !== null) {
                navBack.addEventListener('click', event => removeElementClass(event.target.closest('.navigation__item'), 'is--visible'))
                navClose.addEventListener('click', event => removeElementClass(event.target.closest('.navigation__item'), 'is--visible'))
            }

            headerItem.addEventListener('click', (event) => {
                event.stopPropagation()

                const clickedNavigationItem = event.currentTarget,
                    clickedNavigationTarget = event.target,
                    clickedNavigationDataTarget = clickedNavigationTarget.dataset.target;

                if (hasElementClass(clickedNavigationTarget, 'navigation__link')) event.preventDefault()

                headerItems.forEach(headerItemInLoop => {
                    if (headerItemInLoop !== clickedNavigationItem)
                        removeElementClass(headerItemInLoop, 'is--visible')
                })

                if (!hasElementClass(clickedNavigationTarget, 'navigation__close') &&
                    !hasElementClass(clickedNavigationItem, 'is--visible') &&
                    !hasElementClass(clickedNavigationTarget, 'navigation__back') &&
                    !hasElementClass(clickedNavigationItem, 'is--visible')) {
                    addElementClass(clickedNavigationItem, 'is--visible')
                } else if (hasElementClass(clickedNavigationItem, 'is--visible') &&
                    clickedNavigationDataTarget === 'parent') {
                    removeElementClass(clickedNavigationItem, 'is--visible')
                }

                return false;
            })
        })
    }

})()

export default Navigation;

