(function () {
    const bannerNav = document.querySelectorAll('.aoi-banner-nav-items');
    const sectionElt = document.querySelectorAll('.aoi-settings-section');
    const userImage = document.querySelector('#user-image');
    const imageForm = document.querySelector('#user-image-form');

    const handleClick = ({ target }) => {
        showTab(target);
    };

    const handleChange = ({ target }) => {
        const regex = /[.png.jpg.jpeg]$/;

        if (!target.value || !regex.test(target.value)) return;

        const imageBtn = document.querySelector('.user-image-submit');
        const reader = new FileReader();

        reader.onload = () => {
            target.style.backgroundImage = `url(${reader.result})`;
            target.style.backgroundSize = 'cover';
        };

        reader.readAsDataURL(target.files[0]);

        imageBtn.disabled = false;
    };

    const handleImageChange = (e) => {
        e.preventDefault();

        const img = e.target.querySelector('#aoi-image');
        const data = new FormData(e.target);

        const fetchData = {
            method: 'POST',
            body: data,
            headers: new Headers(),
        };

        fetch('/signals/image-upload', fetchData).then((res) => res.blob());
    };

    const showTab = (target) => {
        target = target.getAttribute('href') ? target : target.parentElement;

        const section = document.querySelector(target.getAttribute('href'));

        bannerNav.forEach((nav) => {
            nav.classList.remove('aoi-banner-nav-items-active');

            if (!target.classList.contains('aoi-banner-nav-items-active'))
                target.classList.add('aoi-banner-nav-items-active');

            sectionElt.forEach((elt) => {
                elt.classList.remove('aoi-section-active');
                elt.classList.add('aoi-section-hidden');
            });

            if (section) {
                section.classList.remove('aoi-section-hidden');
                section.classList.add('aoi-section-active');
            }
        });
    };

    bannerNav.forEach((nav) => {
        nav.addEventListener('click', handleClick);
    });

    let hash = location.hash;
    hash = hash ? hash : '#params';
    const a = document.querySelector(`a[href="${hash}"]`);

    if (a != null && !a.classList.contains('aoi-banner-nav-items-active')) {
        showTab(a);
    }

    if (userImage) userImage.addEventListener('change', handleChange);
    if (imageForm) imageForm.addEventListener('submit', handleImageChange);
})();
