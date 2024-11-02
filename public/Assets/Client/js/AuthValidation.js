document.getElementById('loginForm').addEventListener("submit", function (e) {
    e.preventDefault(document.getElementById('loginForm').elements);
    console.log()
    if (loginValidate()) {
        this.submit();
    }
});

function loginValidate() {
    let loginForm = document.getElementById('loginForm');
    let input = loginForm.elements;
    let is_valid = 0;

    if(input['username'].value === '' ) {
         document.getElementById('username-required').style.display = 'block';
         is_valid = 1;
    } else {
        document.getElementById('username-required').style.display = 'none';
    }

    if(input['password'].value === '' ) {
        document.getElementById('password-required').style.display = 'block';
        is_valid = 1;
   } else {
       document.getElementById('password-required').style.display = 'none';
   }

   if(is_valid === 1) {
    return false;
   }
   return true;
}