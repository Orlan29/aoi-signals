const form = document.querySelector('.aoi-form');
const inputs = document.querySelectorAll('.form-control');

const handleBlur = ({ target }) => {
    const inputError = `aoi-${target.id}-error`;

    console.log(inputError);

    formControl(target, inputError);
};

const handleSubmit = (e) => {
    e.preventDefault();
};

const formControl = (target, label) => {
    const inputLabel = document.querySelector(`.${label}`);

    if (inputLabel.classList.contains('aoi-error-active')) {
        inputLabel.classList.remove('aoi-error-active');
        target.classList.remove('aoi-form-error');
    }

    if (target.value.length == 0) {
        inputLabel.classList.add('aoi-error-active');
        target.classList.add('aoi-form-error');

        return 0;
    }
};

inputs.forEach((input) => {
    input.addEventListener('blur', handleBlur);
});

//form.addEventListener('submit', handleSubmit)
