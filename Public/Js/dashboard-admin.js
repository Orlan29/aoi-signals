'use-strict'

const navElt = document.querySelectorAll('.aoi-nav-item')
const sectionElt = document.querySelectorAll('.aoi-section')
const labelElt = document.querySelectorAll('.aoi-nav-label')

const debounce = (callback, delay) => {
    let timer = null;

    return () => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            callback();
        }, delay);
    };
};

const handleClick = ({ target }) => {

    const parent = target.nodeName == 'I' ?
        target.parentNode :
        target
    
    if (parent.nodeName == 'DIV') {
        navElt.forEach(nav => {
            nav.classList.remove('aoi-active')
            parent.classList.add('aoi-active')
        })

        return false
    }

    navElt.forEach(nav => {
        nav.classList.remove('aoi-active')
        parent.classList.add('aoi-active')

        sectionElt.forEach(section => {
            section.classList.remove('aoi-section-active')
            if (parent.classList.contains(section.id)) {
                section.classList.add('aoi-section-active')
                return false
            } else {
                return false
            }
        })
    })
}

const handleMove = ({ target }) => {
    const parent = target.nodeName == 'I' ?
        target.parentNode :
        target

    labelElt.forEach(label => {
        label.classList.remove('aoi-label-active')

        if (parent.classList.contains(label.id))
            label.classList.add('aoi-label-active')
    })
}

const handleQuit = () => {
    labelElt.forEach(label => {
        if (label.classList.contains('aoi-label-active'))
            label.classList.remove('aoi-label-active')
    })
}

navElt.forEach(nav => {
    nav.addEventListener('click', handleClick)

    nav.addEventListener('mouseover', (e => debounce(handleMove(e), 200)))

    nav.addEventListener('mouseout', debounce(handleQuit, 1200))
})