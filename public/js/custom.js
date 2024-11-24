$(document).ready(function () {
    $(document).on('click', '.btn-delete', function (e) {
        // console.log('oke');
        e.preventDefault();

        $(document).find('#modalDelete').modal('show');

        const url = $(this).data('url');
        // console.log(url);

        $('#modalDelete form').attr('action', url);
    });
});

function handleErrorException(err) {
    const responseJSON = err.responseJSON;

    if (err.status === 422) {
        const errors = responseJSON?.errors;
        handleValidationErrors(errors);
    } else if (err.status === 401) {
        const message = responseJSON?.message;
        showSwalErrorMessage(message);
    } else {
        const message = responseJSON?.message;
        showSwalErrorMessage(message);
    }
}

function handleValidationErrors(errors) {
    for (const [key, value] of Object.entries(errors)) {
        $(document).find(`[id="${key}"]`).addClass("is-invalid");
        $(document)
            .find(`[id='${key}']`)
            .parent()
            .append(`<div class="invalid-feedback">${value[0]}</div>`);
    }
}

function handleBeforeSubmitForm(formId) {
    $(document).find(`${formId} .form-control`).removeClass("is-invalid");
    $(document).find(`${formId} .invalid-feedback`).remove();

    const buttonSubmit = $(document).find(`${formId} button[type="submit"]`);

    buttonSubmit.addClass("btn-load disabled").html(`
        <span class="d-flex align-items-center">
            <span class="spinner-border flex-shrink-0" role="status">
                <span class="visually-hidden">Loading...</span>
            </span>
            <span class="flex-grow-1 ms-2">
                Loading...
            </span>
        </span>
    `);
}

function handleSubmitCompleted(formId, buttonText = "Submit") {
    $(document)
        .find(`${formId} button[type=submit]`)
        .removeClass("btn-load disabled");
    $(document).find(`${formId} button[type="submit"]`).html(buttonText);
}

function showSwalSuccessMessage(message) {
    Swal.fire({
        title: 'Sukses!',
        text: message,
        icon: 'success',
        customClass: {
            confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
    });
}

function showSwalErrorMessage(message) {
    Swal.fire({
        title: 'Terjadi Kesalahan!',
        text: message,
        icon: 'error',
        customClass: {
            confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
    });
}

function resetInputFormClass() {
    $(document).find('input,select').removeClass('is-invalid');
    $(document).find('div.invalid-feedback').remove();
}
