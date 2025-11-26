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

//scroll do nav--mobile removendo e aparecendo com a rolagem da tela
let ultimoSrollY = 0
const navMobile = document.querySelector('.menu--mobile')
window.addEventListener('scroll', () => {
    const scrollAtualY = window.scrollY
    const fimDaPagina = (window.innerHeight + scrollAtualY) >= document.body.offsetHeight - 10;

    if (scrollAtualY > ultimoSrollY && !fimDaPagina) {
        navMobile.classList.add('menu--mobile--hidden')
    } else {
        navMobile.classList.remove('menu--mobile--hidden')
    }
    ultimoSrollY = scrollAtualY
})

//Scroll suave para liks de navegacao
const navLinks = document.querySelectorAll('.menu ul a.menu__link');
navLinks.forEach(links => {
    links.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {

            if (window.innerWidth >= 768) {
                const headerHeight = document.querySelector('header').offsetHeight;
                const targetPosition = target.offsetTop - headerHeight - 50
                window.scrollTo({ top: targetPosition, behavior: 'smooth' })

            } else {
                const navMobHeight = document.querySelector('.nav--mobile').offsetHeight;

                const targetPositionNav = target.offsetTop - navMobHeight - 20
                window.scrollTo({ top: targetPositionNav, behavior: 'smooth' })
            }

        }
    })
})