(function() {
    
    const form = document.querySelector('.aoi-form')

    function handleSubmit(e) {

        const labelErrors = document.querySelectorAll('.aoi-label-error')
        const fields = document.querySelectorAll('.aoi-form-control')

        fields.forEach(field => {

            if (field.value.length <= 0) {
                if (field.type === 'text' && field.id === 'userRef')
                    return false;

                e.preventDefault()
                
                field.classList.add('aoi-invalid-form-control')

                labelErrors.forEach(labelError => {
                    if (labelError.classList.contains(`aoi-${field.id}-error`)) {
                        labelError.classList.remove('aoi-error-desable')
                        labelError.classList.add('aoi-error-enable')
                    }
                })
            }
        })
    }

    form.addEventListener('submit', handleSubmit)
})()