// Variables booléennes
let pseudo = false;
let email = false;
let rgpd = false;
let pass = true;

// On charge les éléments du formulaire
document.querySelector('#registration_form_nickname').addEventListener('input', checkPseudo);
document.querySelector('#registration_form_email').addEventListener('input', checkEmail);
document.querySelector('#registration_form_agreeTerms').addEventListener('input', checkRgpd);

function checkPseudo() {
    pseudo = this.value.length > 2;
    checkAll();
}

function checkEmail() {
    let regex = new RegExp('\\S+@\\S+\\.\\S+');
    email = regex.test(this.value);
    checkAll();
}

function checkRgpd() {
    rgpd = this.checked;
    checkAll();
}

function checkAll() {
    document.querySelector('#submit-button').setAttribute('disabled', 'disabled');
    if (email && pseudo && pass && rgpd) {
        document.querySelector('#submit-button').removeAttribute('disabled');
    }
}
