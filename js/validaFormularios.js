window.addEventListener("load", principal);

function principal() {

    var forms = document.getElementsByClassName('needs-validation');
    var validacion = Array.prototype.filter.call(forms,function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
}
