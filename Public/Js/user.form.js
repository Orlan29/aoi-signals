(function () {
    const fields = document.querySelectorAll('.aoi-form-control');
    const termsConditions = document.querySelector(
        'label[for="terms-and-conditions"]'
    );

    const submitBtn = document.querySelector('.aoi-button-submit');

    function handleBlur({ target }) {
        const labelError = document.querySelector(`.aoi-${target.id}-error`);

        if (target.value.length === 0) {
            target.nextElementSibling.classList.remove('aoi-form-label-focus');
            target.classList.add('aoi-invalid-form-control');

            if (labelError && typeof labelError === 'object') {
                labelError.classList.remove('aoi-error-desable');
                labelError.classList.add('aoi-error-enable');
            }
        } else {
            target.nextElementSibling.classList.add('aoi-form-label-focus');
            target.classList.remove('aoi-invalid-form-control');

            if (labelError) {
                labelError.classList.remove('aoi-error-enable');
                labelError.classList.add('aoi-error-desable');
            }
        }

        if (target.type === 'email') {
            emailControl(target);
        }

        if (target.type === 'text' && target.id === 'userRef') {
            target.classList.remove('aoi-invalid-form-control');
        }
    }

    function handleCheck({ target }) {
        const termsCheck = target.previousElementSibling;

        if (termsCheck.checked) submitBtn.disabled = true;
        else submitBtn.disabled = false;
    }

    function emailControl(target) {
        const labelError = document.querySelector(`.aoi-${target.id}-error`);
        const regex = /^[a-z0-9-._]+@[a-z0-9-._]+\.[a-z]{2,4}/;

        if (!regex.test(target.value)) {
            labelError.textContent = 'Cette adresse e-mail est invalide';
            labelError.classList.remove('aoi-error-desable');
            labelError.classList.add('aoi-error-enable');
        }
    }

    window.addEventListener('load', function () {
        fields.forEach((field) => (field.value = ''));

        if (termsConditions)
            termsConditions.previousElementSibling.checked = false;

        if (submitBtn) submitBtn.disabled = true;
    });

    fields.forEach((field) => {
        field.addEventListener('blur', handleBlur);

        if (field.type === 'email') {
            if (field.classList.contains('aoi-invalid-form-control')) {
                field.addEventListener('input', emailControl);
            }
        }
    });

    if (termsConditions) termsConditions.addEventListener('click', handleCheck);
})();
