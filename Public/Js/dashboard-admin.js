(function () {
    const navElt = document.querySelectorAll('.aoi-nav-item');
    const sectionElt = document.querySelectorAll('.aoi-section');
    const labelElt = document.querySelectorAll('.aoi-nav-label');
    const adminLogout = document.querySelector('.aoi-admin-logout');
    const fields = document.querySelectorAll('.aoi-form-control');
    const userList = document.querySelectorAll('tbody tr');
    const allUsersBtn = document.querySelector('.aoi-see-all');
    const userImage = document.querySelector('#admin-image');
    const imageForm = document.querySelector('#admin-image-form');

    const debounce = (callback, delay) => {
        let timer = null;

        return () => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                callback();
            }, delay);
        };
    };

    const showTab = (target) => {
        let parent = target.nodeName == 'I' ? target.parentNode : target;
        parent = parent.parentElement;

        if (parent.nodeName == 'TR') {
            const section = document.querySelector('#user');

            sectionElt.forEach((elt) => {
                elt.classList.remove('aoi-section-active');
                elt.classList.add('aoi-section-hidden');

                if (section) {
                    section.classList.add('aoi-section-active');
                    elt.classList.remove('aoi-section-hidden');
                }
            });

            return;
        }

        const section = document.querySelector(parent.getAttribute('href'));

        if (parent.nodeName === 'A') {
            navElt.forEach((nav) => {
                nav.classList.remove('aoi-active');
                parent.firstElementChild.classList.add('aoi-active');
            });

            if (adminLogout.classList.contains('aoi-label-active'))
                adminLogout.classList.remove('aoi-label-active');
        } else {
            if (adminLogout.classList.contains('aoi-label-active'))
                adminLogout.classList.remove('aoi-label-active');
            else adminLogout.classList.add('aoi-label-active');

            return false;
        }

        sectionElt.forEach((elt) => {
            elt.classList.remove('aoi-section-active');
            elt.classList.add('aoi-section-hidden');

            if (section) {
                section.classList.add('aoi-section-active');
                elt.classList.remove('aoi-section-hidden');
            }
        });
    };

    const fetchUser = (target) => {
        const id = target.getAttribute('user-id');

        userList.forEach((user) => user.setAttribute('is-active', false));

        user.setAttribute('is-active', true);
        location.hash = '#user';

        showTab(target.firstElementChild);

        const fetchData = {
            method: 'get',
            headers: new Headers(),
        };

        fetch(`/signals/a/get-user/${id}`, fetchData)
            .then((res) => res.json())
            .then((res) => {
                const img = document.querySelector('.aoi-user-profile-img');
                const name = document.querySelector('.aoi-user-profile-name');
                const items = document.querySelectorAll(
                    '.aoi-user-profile-item'
                );

                content.innerHTML = '';
                img.style.backgroundImage = `url(/signals/Images/Users/${res.profile_image})`;
                name.innerHTML = `<p>${res.name}</p>`;

                items.forEach((item) => {
                    for (let key in res) {
                        if (item.classList.contains(key)) {
                            item.lastElementChild.textContent = res[key];
                        }
                    }
                });
            });
    };

    const fetchAllUsers = () => {
        const tbody = document.querySelector('.all-users');
        tbody.innerHTML = '';

        const fetchData = {
            method: 'get',
            headers: new Headers(),
        };

        fetch('/signals/a/all-users', fetchData)
            .then((res) => res.json())
            .then((res) => {
                res.forEach((user) => {
                    const tr = document.createElement('tr');
                    const tdId = document.createElement('td');
                    const tdName = document.createElement('td');
                    const tdEmail = document.createElement('td');
                    const tdRef = document.createElement('td');
                    const tdPhone = document.createElement('td');
                    const tdPremium = document.createElement('td');

                    tr.setAttribute('user-id', user.id);
                    tr.onclick = ({ target }) =>
                        fetchUser(target.parentElement);

                    tdId.textContent = user.id;
                    tdPhone.textContent = user.phone;
                    tdEmail.textContent = user.email;
                    tdRef.textContent = user.ref;
                    tdName.textContent = user.name;
                    tdPremium.textContent = null;

                    tr.appendChild(tdId);
                    tr.appendChild(tdName);
                    tr.appendChild(tdEmail);
                    tr.appendChild(tdRef);
                    tr.appendChild(tdPhone);
                    tr.appendChild(tdPremium);
                    tbody.appendChild(tr);
                });
            });
    };

    const handleClick = ({ target }) => {
        showTab(target);
    };

    function handleBlur({ target }) {
        if (target.nodeName === 'TEXTAREA') return;

        if (target.value.length === 0) {
            target.nextElementSibling.classList.remove('aoi-form-label-focus');
            target.classList.add('aoi-invalid-form-control');
        } else {
            target.nextElementSibling.classList.add('aoi-form-label-focus');
            target.classList.remove('aoi-invalid-form-control');
        }
    }

    const handleImageChange = (e) => {
        e.preventDefault();

        const data = new FormData(e.target);

        const fetchData = {
            method: 'post',
            body: data,
            headers: new Headers(),
        };

        fetch('/signals/image-upload/admin', fetchData).then((res) =>
            res.blob()
        );
    };

    const handleChange = ({ target }) => {
        const regex = /[.png.jpg.jpeg]$/;

        if (!target.value || !regex.test(target.value)) return;

        const imageBtn = document.querySelector('.user-image-submit');
        const profileImage = document.querySelector('.admin-profile-image');
        const reader = new FileReader();

        reader.onload = () => {
            target.style.backgroundImage = `url(${reader.result})`;
            target.style.backgroundSize = 'cover';

            profileImage.innerHTML = '';
            profileImage.style.backgroundImage = `url(${reader.result})`;
            profileImage.style.backgroundPosition = 'center center';
            profileImage.style.backgroundSize = 'cover';
        };

        reader.readAsDataURL(target.files[0]);

        imageBtn.disabled = false;
    };

    const handleMove = ({ target }) => {
        let parent = target.nodeName == 'I' ? target.parentNode : target;
        parent = parent.parentElement;

        labelElt.forEach((label) => {
            label.classList.remove('aoi-label-active');

            if (parent.classList.contains(`${label.id}`))
                label.classList.add('aoi-label-active');
        });
    };

    const handleQuit = () => {
        labelElt.forEach((label) => {
            if (label.classList.contains('aoi-label-active'))
                label.classList.remove('aoi-label-active');
        });
    };

    navElt.forEach((nav) => {
        nav.addEventListener('click', handleClick);

        nav.addEventListener('mouseover', (e) => debounce(handleMove(e), 500));

        nav.addEventListener('mouseout', debounce(handleQuit, 1200));
    });

    userImage.onchange = handleChange;
    imageForm.onsubmit = handleImageChange;

    fields.forEach((field) => {
        if (field.name === 'author')
            field.nextElementSibling.classList.add('aoi-form-label-focus');
        field.addEventListener('blur', handleBlur);
    });

    let hash = location.hash;
    hash = hash ? hash : '#home';
    const a = document.querySelector(`a[href="${hash}"]`);

    if (a != null && !a.firstElementChild.classList.contains('aoi-active')) {
        let elt = null;

        if (a.querySelector('li')) {
            elt = a.querySelector('li');
            showTab(elt);
        } else if (a.querySelector('button')) {
            elt = a.querySelector('button');
            showTab(elt);
        }
    } else {
        const tr =
            hash == '#user'
                ? document.querySelector('tbody tr[is-active="true"]')
                : null;

        if (tr) {
            showTab(tr.firstElementChild);
            fetchUser(tr);
        }
    }

    allUsersBtn.onclick = fetchAllUsers();

    userList.forEach((user) => {
        user.onclick = () => {
            const id = user.getAttribute('user-id');

            userList.forEach((user) => user.setAttribute('is-active', false));

            user.setAttribute('is-active', true);
            location.hash = '#user';

            fetchUser(user);
        };
    });

    // Chart intrface for
    const ctx = document.querySelector('#chart').getContext('2d');

    const data = {
        labels: ['Utilisateurs', 'Administrateurs', 'Évènements'],
        labelColor: 'white',
        datasets: [
            {
                label: 'My First Dataset',
                data: [
                    document.querySelector('#overview-user').textContent,
                    document.querySelector('#overview-admin').textContent,
                    document.querySelector('#overview-event').textContent,
                ],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                ],
                hoverOffset: 4,
            },
        ],
    };

    const config = {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                },
            },
        },
    };

    const chart = new Chart(ctx, config);

    // Dark mode

    const themeLink = document.querySelector('#theme-link');
    const switchBtn = document.querySelector('#dark-mode');

    if (localStorage.theme != null) {
        themeLink.href = `../Public/Css/${localStorage.theme}-dashboard-admin.style.css`;

        if (localStorage.theme == 'light') switchBtn.checked = false;
        else switchBtn.checked = true;
    }

    switchBtn.addEventListener('click', () => {
        if (localStorage.theme == 'light') localStorage.theme = 'dark';
        else localStorage.theme = 'light';

        themeLink.href = `../Public/Css/${localStorage.theme}-dashboard-admin.style.css`;
    });

    // font style

    const typo = document.querySelector('#typography');
    const Elt = document.querySelector('body').firstElementChild.children;

    if (localStorage.font != null) {
        for (const elt of Elt) elt.style.fontFamily = localStorage.font;
    }

    const handleStyleChange = ({ target }) => {
        if (localStorage.font != undefined) {
            localStorage.font = target.value;
            for (const elt of Elt) elt.style.fontFamily = localStorage.font;
        } else localStorage.font = target.value;
    };

    typo.addEventListener('change', handleStyleChange);

    // font size

    const size = document.querySelector('#font-size');

    if (localStorage.font != null) {
        for (const elt of Elt) elt.style.fontSize = localStorage.size;
    }

    const handleSizeChange = ({ target }) => {
        if (localStorage.size != undefined) {
            localStorage.size = target.value;
            for (const elt of Elt) elt.style.fontSize = localStorage.size;
        } else localStorage.size = target.value;
    };

    size.addEventListener('change', handleSizeChange);
})();
