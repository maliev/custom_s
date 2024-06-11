//helper functions
export const hasElementClass = (element, className) => {
    return element.classList ? element.classList.contains(className) : new RegExp('(^| )' + className + '( |$)', 'gi').test(element.className);
};

export const addElementClass = (element, className) => {
    element.classList ? element.classList.add(className) : element.className += ' ' + className;
};

export const removeElementClass = (element, className) => {
    element.classList ? element.classList.remove(className) : element.className = element.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
};

