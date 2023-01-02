import { Collapse } from 'bootstrap'

Array.from(document.querySelectorAll('.accordion'))
    .forEach(accordionNode => new Collapse(accordionNode))
