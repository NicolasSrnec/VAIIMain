window.onload = function () {
    let name = document.getElementById("nameInput");
    let password = document.getElementById('passwordInput');
    let button = document.getElementById('registerButton');
    let form =  document.getElementById('registrationForm');
    let x = false;
    let y = false;
    let passed = 0;
    let passwordError = "";
    button.style.visibility = 'hidden';
    form.addEventListener("input",formCheck );

    function formCheck(e) {
        passed = 0;
        x = false;
        y = false;
        passwordError = "";
        let passwordValue = password.value;
        if (name.validity.tooShort) {
            name.setCustomValidity("Name must be between 5 to 10 characters long");
            name.reportValidity();
            x = false;
        } else {
            x = true;
            name.setCustomValidity("");
        }

        if (password.validity.tooShort) {
            passwordError = passwordError.concat("Too short") ;
            y = false;
        } else {
            password.setCustomValidity("");
        }
        if (passwordCheck(passwordValue) < 4) {
            passwordError = passwordError.concat(" ,too simple, use capital letters, special chars and numbers") ;

        } else {
            y = true;
        }
        if  (document.activeElement == password) {
            password.setCustomValidity(passwordError);
            password.reportValidity();
        }

        if (x == true && y == true) {
            button.style.visibility = 'visible';
        } else {
            button.style.visibility = 'hidden';
        }



    }
    function passwordCheck(passwordValue) {

        if((new RegExp ("[A-Z]").test(passwordValue))) {
           passed++;
        }
        if((new RegExp ("[a-z]").test(passwordValue))) {
           passed++;
        }
        if((new RegExp ("[0-9]").test(passwordValue))) {
            passed++;
        }
        if((new RegExp ("[$@$!%*#?&]").test(passwordValue))) {
            passed++;
        }
        return passed;
    }
}