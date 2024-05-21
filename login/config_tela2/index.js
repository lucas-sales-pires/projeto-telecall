document.getElementById('formularioLogin').addEventListener('submit', function (e) {
    e.preventDefault();

    let perfil = parseInt(document.getElementById('tipo').value);

    if (perfil == 2) {
        this.action = '../php/login.php';
    } else {
        this.action = '../php/loginMaster.php';
    }

    this.submit();
});
const mostrarSenhaCheckbox = document.getElementById('mostrarSenha');
const senhaInput = document.querySelector('input[type="password"]');

function mostraSenha() {
    const senhaInput = document.querySelector('input[type="password"]');
    senhaInput.type = (senhaInput.type === "password") ? "text" : "password";
}



mostrarSenhaCheckbox.addEventListener('change', function () {
    senhaInput.type = (mostrarSenhaCheckbox.checked) ? "text" : "password";
});

document.querySelector('form').addEventListener("submit", () => {
    senhaInput.type = "password";
})
