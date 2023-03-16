// alert("Confirmation de la commande");
// const myModal = new bootstrap.Modal(
//   document.getElementsByClassName("modal"),
//   options
// );

// myModal.show(myModal);
const title = document.querySelector("header h1");
const btnSubmit = document.querySelector("form button");

title.addEventListener("mouseover", () => {
  title.style.color = "white";
});

btnSubmit.addEventListener('click', () => {
    setTimeout(() => {
        let h = Math.floor(Math.random() * 360);
        title.style.color = `hsl(${h} 50% 50%)`;
      }, 300);
})

title.addEventListener("mouseleave", () => {
    title.style.color = "#bc9b5d"
});
