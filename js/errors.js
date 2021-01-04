$(document).ready(function () {
    let footerYears = document.getElementById('footer-years')
    const currentYear = new Date().getFullYear();
    footerYears.innerText = currentYear === 2020 ? "2020" : "2020-".concat(currentYear);
})