// Verifica se a URL tem "?status=sucesso"
const urlParams = new URLSearchParams(window.location.search);

if (urlParams.get("status") === "sucesso") {
    document.getElementById("modalSucesso").style.display = "flex";

    window.history.replaceState(
        {},
        document.title,
        window.location.pathname
    );
}

function fecharModal() {
    document.getElementById("modalSucesso").style.display = "none";
}

//scroll do banner 
window.addEventListener('scroll', function () {
    let header = document.querySelector('#header')
    header.classList.toggle('roll', window.scrollY > 20)
})