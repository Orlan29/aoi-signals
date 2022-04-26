(function() {

    const bannerNav = document.querySelectorAll('.aoi-banner-nav-items')
    const sectionElt = document.querySelectorAll('.aoi-settings-section')

    const handleClick = ({ target }) => {
        showTab(target)
    }


    const showTab = (target) => {
        target = target.getAttribute('href') ? target : target.parentElement

        const section = document.querySelector(target.getAttribute('href'))

        bannerNav.forEach(nav => {
            nav.classList.remove('aoi-banner-nav-items-active')
            
            if (!target.classList.contains('aoi-banner-nav-items-active'))
                target.classList.add('aoi-banner-nav-items-active')

            sectionElt.forEach(elt => {
                elt.classList.remove('aoi-section-active')
                elt.classList.add('aoi-section-hidden')
            })

            if (section) {
                section.classList.remove('aoi-section-hidden')
                section.classList.add('aoi-section-active')
            }
        })
    }

    bannerNav.forEach(nav => {
        nav.addEventListener('click', handleClick)
    })


    let hash = location.hash
    hash = hash ? hash : '#params'
    const a = document.querySelector(`a[href="${hash}"]`)

    if (a != null && !a.classList.contains('aoi-banner-nav-items-active')) {
        showTab(a)
    }
})()