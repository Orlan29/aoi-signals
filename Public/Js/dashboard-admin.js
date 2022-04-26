'use-strict'

const navElt = document.querySelectorAll('.aoi-nav-item')
const sectionElt = document.querySelectorAll('.aoi-section')
const labelElt = document.querySelectorAll('.aoi-nav-label')
const adminLogout = document.querySelector('.aoi-admin-logout')
const ctx = document.querySelector('#chart').getContext('2d')

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

        if (adminLogout.classList.contains('aoi-label-active'))
            adminLogout.classList.remove('aoi-label-active')
        else
            adminLogout.classList.add('aoi-label-active')

        return false
    }

    navElt.forEach(nav => {
        nav.classList.remove('aoi-active')
        parent.classList.add('aoi-active')

        if (adminLogout.classList.contains('aoi-label-active'))
            adminLogout.classList.remove('aoi-label-active')

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


// Chart intrface for

const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
];

const data = {
    labels: labels,
    datasets: [{
        label: 'My First dataset',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 2, 20],
    }]
};

const config = {
    type: 'line',
    data: data,
    options: {
        response: true
    }
};

const chart = new Chart(ctx, config)


// Dark mode

const themeLink = document.querySelector('#theme-link')
const switchBtn = document.querySelector('#dark-mode')

if (localStorage.theme != null) {
    themeLink.href = `../Public/Css/${localStorage.theme}-dashboard-admin.style.css`

    if (localStorage.theme == 'light')
        switchBtn.checked = false
    else
        switchBtn.checked = true
}

switchBtn.addEventListener('click', () => {
    if (localStorage.theme == 'light')
        localStorage.theme = 'dark'
    else 
        localStorage.theme = 'light'
    
    themeLink.href = `../Public/Css/${localStorage.theme}-dashboard-admin.style.css`
})

// font style

const typo = document.querySelector('#typography')
const Elt = document.querySelector('body').firstElementChild.children

if (localStorage.font != null) {
    for (const elt of Elt)
        elt.style.fontFamily = localStorage.font
}

const handleStyleChange = ({ target }) => {

    if (localStorage.font != undefined) {
        localStorage.font = target.value
        for (const elt of Elt)
            elt.style.fontFamily = localStorage.font
    }
    else localStorage.font = target.value
}

typo.addEventListener('change', handleStyleChange)

// font size

const size = document.querySelector('#font-size')

if (localStorage.font != null) {
    for (const elt of Elt)
        elt.style.fontSize = localStorage.size
}

const handleSizeChange = ({ target }) => {

    if (localStorage.size != undefined) {
        localStorage.size = target.value
        for (const elt of Elt)
            elt.style.fontSize = localStorage.size
    }
    else localStorage.size = target.value
}

size.addEventListener('change', handleSizeChange)