const text = document.querySelector(".sec-text");
const textLoad = () => {
    setTimeout(() => {
        text.textContent = "Web Developer";
    }, 0);
    setTimeout(() => {
        text.textContent = "Graphic Designer";
    }, 4000);
    setTimeout(() => {
        text.textContent = "Software Engineer";
    }, 8000);
}
textLoad();
setInterval(textLoad, 12000);