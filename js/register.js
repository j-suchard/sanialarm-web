function checkInputCompletion() {
    if ($("#inputFirstName").is(":-webkit-autofill") &&
        $("#inputLastName").is(":-webkit-autofill") &&
        $("#inputEmail").is(":-webkit-autofill") &&
        document.getElementById('inputPassword').value !== '' &&
        document.getElementById('inputPasswordConfirmation').value !== '') {
        document.getElementById('createAccount').removeAttribute('disabled')
    } else {
        document.getElementById('createAccount').setAttribute('disabled', '')
    }
}

$(document).ready(function () {
    $('#inputActivationKey').on('input', function () {
        let activationKeyInput = document.getElementById('inputActivationKey');
        if (activationKeyInput.value.length < 19) {
            activationKeyInput.classList.add('is-invalid')
            activationKeyInput.classList.remove('is-valid')
            let feedback = document.getElementById('keyValidationFeedback');
            feedback.classList.add('invalid-feedback')
            feedback.innerHTML = "Der Aktivierungsschlüssel ist zu kurz"
            /* Add all disabled attributes */
            disableInputs()
        } else {
            activationKeyInput.classList.remove('is-invalid')
            activationKeyInput = document.getElementById('inputActivationKey');
            const Url = '/api/verify/activationKey';
            const body = {
                'key': activationKeyInput.value
            }
            console.log(body)
            $.ajax({
                type: "POST",
                url: Url,
                data: body,
                success: requestSuccessful,
                dataType: 'json'
            })
        }
    })
    $('#inputFirstName').on('input', function () {
        checkInputCompletion()
    })
    $('#inputLastName').on('input', checkInputCompletion())
    $('#inputEmail').on('input', checkInputCompletion())
    $('#inputPasswordConfirmation').on('input', function () {
        let inputPasswordConfirmation = document.getElementById('inputPasswordConfirmation');
        let inputPassword = document.getElementById('inputPassword');
        if (inputPasswordConfirmation.value !== inputPassword.value) {
            inputPasswordConfirmation.classList.add('is-invalid')
            inputPasswordConfirmation.classList.remove('is-valid')
        } else {
            inputPasswordConfirmation.classList.remove('is-invalid')
            inputPasswordConfirmation.classList.add('is-valid')
            checkInputCompletion()
        }
    })
    $('#inputPassword').on('input', function () {
        let inputPassword = document.getElementById('inputPassword');
        if (inputPassword.value.length < 8) {
            inputPassword.classList.add('is-invalid')
            inputPassword.classList.remove('is-valid')
            checkInputCompletion()
        } else {
            inputPassword.classList.remove('is-invalid')
            inputPassword.classList.add('is-valid')
        }
    })
    $('#createAccount').on('click', function () {
        let firstName = document.getElementById('inputFirstName').value
        let lastName = document.getElementById('inputLastName').value
        let email = md5(document.getElementById('inputEmail').value)
        let password = document.getElementById('inputPassword').value
        let accessLevel = document.getElementById('inputUserLevel').value
        let activationKey = document.getElementById('inputActivationKey').value;
        const postData = {
            'firstName': firstName,
            'lastName': lastName,
            'email': email,
            'password': password,
            'activationKey': activationKey,
            'accessLevel': accessLevel
        };
        $.ajax({
            type: "POST",
            url: '/api/create/account',
            data: postData,
            success: accountCreationSuccess,
            dataType: 'json'
        })
    })
})

function disableInputs() {
    document.getElementById('inputFirstName').setAttribute('disabled', '')
    document.getElementById('inputLastName').setAttribute('disabled', '')
    document.getElementById('inputEmail').setAttribute('disabled', '')
    document.getElementById('inputPassword').setAttribute('disabled', '')
    document.getElementById('inputPasswordConfirmation').setAttribute('disabled', '')
}

function accountCreationSuccess(resData, status) {
    console.log(status)
    if (resData.accountCreated === true) {
        window.location.assign('/login/?created=true')
    }
}

function requestSuccessful(resData, status) {
    let feedback;
    console.log(status)
    let activationKeyInput = document.getElementById('inputActivationKey')
    if (resData.valid === true) {
        activationKeyInput.classList.add('is-valid')
        activationKeyInput.classList.remove('is-invalid')
        feedback = document.getElementById('keyValidationFeedback');
        feedback.innerHTML = "Der Aktivierungsschlüssel ist gültig"
        feedback.classList.remove('invalid-feedback')
        feedback.classList.add('valid-feedback')
        /* Remove all disabled attributes */
        document.getElementById('inputFirstName').removeAttribute('disabled')
        document.getElementById('inputLastName').removeAttribute('disabled')
        document.getElementById('inputEmail').removeAttribute('disabled')
        document.getElementById('inputPassword').removeAttribute('disabled')
        document.getElementById('inputPasswordConfirmation').removeAttribute('disabled')
    } else {
        activationKeyInput.classList.add('is-invalid')
        feedback = document.getElementById('keyValidationFeedback');
        feedback.innerHTML = "Der Aktivierungsschlüssel ist ungültig"
        /* Add all disabled attributes */
        disableInputs()
    }
}