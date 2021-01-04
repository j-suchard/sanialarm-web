$(document).ready(function () {
    $('#nextStep').click(function () {
        var currentStep = document.getElementById('setupStep');
        if (currentStep.value == 0) {
            var activationKeyDiv = document.getElementById('activationKey')
            var bsCollapse = new bootstrap.Collapse(activationKeyDiv)
            bsCollapse.hide();
            currentStep.type = "text";
            currentStep.value = 1;
            currentStep.type = "hidden";
            var personalDataText = document.getElementById('labelPD')
            personalDataText.classList.remove('visually-hidden');
            var personalDataDiv = document.getElementById('personalData')
            var collapsePD = new bootstrap.Collapse(personalDataDiv)
            collapsePD.show();
            var activationKeyLabel = document.getElementById('activationKeyLabel')
            activationKeyLabel.classList.add('text-success')
            activationKeyLabel.classList.remove('text-muted')
            activationKeyLabel.innerHTML += '<i class="bi bi-check"></i>'

        }
    })
    $('#inputActivationKey').on('input', function () {
        var activationKeyInput = document.getElementById('inputActivationKey')
        if (activationKeyInput.value.length < 19) {
            activationKeyInput.classList.add('is-invalid')
            var feedback = document.getElementById('keyVaildationFeedback')
            feedback.innerHTML = "Der Aktivierungsschlüssel ist zu kurz"
            var buttonNext = document.getElementById('nextStep')
            buttonNext.setAttribute("disabled", "")
        } else {
            activationKeyInput.classList.remove('is-invalid')
            var activationKeyInput = document.getElementById('inputActivationKey');
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
})

function requestSuccessful(resData, status) {
    console.log(resData)
    var activationKeyInput = document.getElementById('inputActivationKey')
    if (resData.valid === true) {
        activationKeyInput.classList.add('is-valid')
        activationKeyInput.classList.remove('is-invalid')
        var feedback = document.getElementById('keyVaildationFeedback')
        feedback.innerHTML = "Der Aktivierungsschlüssel ist gültig"
        feedback.classList.remove('invalid-feedback')
        feedback.classList.add('valid-feedback')
        var buttonNext = document.getElementById('nextStep')
        buttonNext.removeAttribute("disabled")
    } else {
        activationKeyInput.classList.add('is-invalid')
        var feedback = document.getElementById('keyVaildationFeedback')
        feedback.innerHTML = "Der Aktivierungsschlüssel ist ungültig"
        var buttonNext = document.getElementById('nextStep')
        buttonNext.setAttribute("disabled", "")
    }
}