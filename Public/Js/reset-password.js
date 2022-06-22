(function () {
    const form = document.querySelector('#forgot-password-form');
    const btn = document.querySelector('.aoi-button');
    const email = document.querySelector('input[name="email"]');
    const errorContainer = document.querySelector('.aoi-error-container');

    function emailVerify(e) {
        e.preventDefault();

        const data = new FormData(form);

        const fetchData = {
            method: 'POST',
            body: data,
            headers: new Headers(),
        };

        btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i>';
        btn.disabled = true;

        fetch('/signals/u/forgot-password', fetchData)
            .then((res) => res.json())
            .then((res) => {
                if (res.email_exist) {
                    email.removeEventListener('input', handleChange);

                    const label = email.nextElementSibling;
                    const passwordConfirm =
                        document.querySelector('.confirm_password');

                    errorContainer.classList.add('aoi-hidden');
                    passwordConfirm.classList.remove('aoi-hidden');

                    email.value = null;
                    email.type = 'password';
                    email.name = 'new_password';
                    email.id = 'new_password';

                    label.textContent = 'Nouveau mot de passe';
                    label.for = 'new-password';
                    label.classList.remove('aoi-form-label-focus');

                    btn.textContent = 'Changer mot de passe';
                    btn.disabled = false;
                    btn.removeEventListener('click', arguments.callee);
                    form.addEventListener('submit', handleSubmit);
                } else if (res.error_msg) {
                    errorContainer.classList.remove('aoi-hidden');
                    errorContainer.firstElementChild.textContent =
                        res.error_msg;

                    btn.textContent = 'Continuer';
                    btn.disabled = false;
                }
            });
    }

    function handleSubmit(e) {
        e.preventDefault();

        if (email.value !== confirm_password.value) {
            errorContainer.classList.remove('aoi-hidden');
            errorContainer.firstElementChild.textContent =
                'Les mots de passes sont différents';
            return;
        }

        const data = new FormData(e.target);

        const fetchData = {
            method: 'POST',
            body: data,
            headers: new Headers(),
        };

        fetch('/signals/u/forgot-password', fetchData)
            .then((res) => res.json())
            .then((res) => {
                const formGroups = document.querySelectorAll('.aoi-form-group');
                form.removeEventListener('submit', handleSubmit);

                email.value = null;
                confirm_password.value = null;

                formGroups.forEach((group) => (group.style.display = 'none'));

                errorContainer.classList.remove('aoi-hidden');
                errorContainer.classList.add('aoi-success');
                errorContainer.firstElementChild.textContent = res.msg;

                btn.textContent = 'Se connecter';
                btn.type = 'button';

                const btnParent = btn.parentElement;
                const a = document.createElement('a');

                a.href = '/signals/login';
                a.title = 'Retour à la page de connexion';
                a.appendChild(btn);

                btnParent.appendChild(a);
            });
    }

    function handleChange({ target }) {
        const regex = /^[a-z0-9-._]+@[a-z0-9-._]+\.[a-z]{2,4}/;

        if (target.type === 'email') btn.disabled = true;

        if (!regex.test(target.value)) return;

        // Enable submit button
        btn.disabled = false;
    }

    if (email) email.oninput = handleChange;

    if (btn) {
        btn.disabled = true;
        btn.addEventListener('click', emailVerify);
    }
})();
