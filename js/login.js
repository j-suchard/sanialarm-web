function triggerTimeSelect() {
    $('#selectLoginSaveDuration').collapse('toggle')
    let periodDropdown = document.getElementById('dropdown');
    periodDropdown.removeAttribute("disabled");
}

function tryLogin() {
    let emailField = document.getElementById('emailInput');
    emailField.setAttribute("disabled", "");
    let passwordField = document.getElementById('passwordInput');
    passwordField.setAttribute("disabled", "")
    let loginButton = document.getElementById('btnLogin');
    loginButton.innerHTML = '<span class="spinner-border" role="status" aria-hidden="true"></span>';
    let emailAddress = emailField.value
    let password = passwordField.value
    postData = {
        'email': md5(emailAddress),
        'password': password
    }
    $.ajax({
        url: '/api/verify/login',
        type: "POST",
        data: postData,
        dataType: 'json',
        success: success
    })
}

function success(response, status) {
    console.log(Math.floor(Date.now() / 1000), status)
}
