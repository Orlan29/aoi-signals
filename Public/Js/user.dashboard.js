(function () {
    const profileBtn = document.querySelector('.aoi-user-profile-btn');
    const searchBtn = document.querySelector('.aoi-search-icon-content');
    const homeBtn = document.querySelector('.aoi-home-nav-btn');
    const backBtn = document.querySelector('.aoi-back-btn');
    const deleteLink = document.querySelector('.delete-acount-link');

    function handleClick() {
        const navElt = document.querySelector('.aoi-nav');

        if (navElt.classList.contains('aoi-nav-hidden')) {
            navElt.classList.remove('aoi-nav-hidden');
            navElt.classList.add('aoi-nav-visible');
        } else if (navElt.classList.contains('aoi-nav-visible')) {
            navElt.classList.remove('aoi-nav-visible');
            navElt.classList.add('aoi-nav-hidden');
        }
    }

    function homeNavToggle() {
        const homeNav = document.querySelector('.aoi-home-nav');
        const mask = document.querySelector('.aoi-nav-mask');

        if (!mask.classList.contains('aoi-mask-active')) {
            mask.classList.add('aoi-mask-active');
            homeNav.classList.add('aoi-home-nav-active');
        } else {
            homeNav.classList.remove('aoi-home-nav-active');
            mask.classList.remove('aoi-mask-active');
        }
    }

    function searchBtnToggle() {
        const searchBtn = document.querySelector('.aoi-header-search-btn');
        const searchInput = document.querySelector('.aoi-search-container');
        const searchContainer = document.querySelector('.aoi-search-content');
        const searchIcon = document.querySelector('.aoi-search-icon-content');
        const userBtn = document.querySelector('.aoi-menu-btn');

        if (searchInput.classList.contains('aoi-search-hidden')) {
            searchBtn.style.width = '45px';
            userBtn.classList.add('aoi-header-search-active');
            searchInput.classList.remove('aoi-search-hidden');
            searchInput.classList.add('aoi-search-visible');
            searchContainer.classList.add('aoi-search-content-visible');
            searchIcon.classList.add('aoi-search-icon-content-visible');
            searchInput.style.width = '300px';
        } else if (searchInput.classList.contains('aoi-search-visible')) {
            searchBtn.style.width = '170px';
            userBtn.classList.remove('aoi-header-search-active');
            searchInput.classList.remove('aoi-search-visible');
            searchInput.classList.add('aoi-search-hidden');
            searchContainer.classList.remove('aoi-search-content-visible');
            searchIcon.classList.remove('aoi-search-icon-content-visible');
        }
    }

    if (profileBtn) profileBtn.onclick = handleClick;

    if (searchBtn) searchBtn.onclick = searchBtnToggle;

    if (homeBtn) homeBtn.onclick = homeNavToggle;

    if (backBtn) backBtn.onclick = homeNavToggle;

    if (deleteLink)
        deleteLink.onclick = () => {
            const mask = document.querySelector('.aoi-nav-mask');
            const no = document.querySelector('.mask-item-no');
            const yes = document.querySelector('.mask-item-yes');

            mask.classList.remove('aoi-hidden');
            mask.classList.add('aoi-mask-active');

            no.onclick = function () {
                mask.classList.remove('aoi-mask-active');
                mask.classList.add('aoi-hidden');
            };

            yes.onclick = function () {
                const id = location.hash.replace('#', '');

                const fetchData = {
                    method: 'get',
                    headers: new Headers(),
                };

                fetch(`/signals/u/delet/${id}`, fetchData).then((res) =>
                    res.json()
                );
            };
        };
})();
