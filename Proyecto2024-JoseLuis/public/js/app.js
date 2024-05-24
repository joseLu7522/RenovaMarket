const passwordInput = document.getElementById("password");
const showPasswordBtn = document.getElementById("showPasswordBtn");

/*EVENTO DE VER CONTRASEÑA AL CLICKCAR EN EL ICONO*/
showPasswordBtn.addEventListener("click", () => {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        showPasswordBtn.innerHTML = '<i class="bi bi-eye"></i>';
    } else {
        passwordInput.type = "password";
        showPasswordBtn.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }
});

/*PREVISUALIZA LA IMAGEN AL INGRESARLA EN EL CAMPO DE EXAMINAR IMAGEN*/
image.onchange = evt => {
    const [file] = image.files
    if (file) {
        previewimg.src = URL.createObjectURL(file)
    }
}
