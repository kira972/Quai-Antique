
// myModal.show(myModal);
const title = document.querySelector("header h1");
const btnSubmit = document.querySelector("form button");

title.addEventListener("mouseover", () => {
  title.style.color = "white";
});

btnSubmit.addEventListener("click", () => {
  handleAjax();
  setTimeout(() => {
    let h = Math.floor(Math.random() * 360);
    title.style.color = `hsl(${h} 50% 50%)`;
  }, 300);
});

title.addEventListener("mouseleave", () => {
  title.style.color = "#bc9b5d";
});

/// AJAX

const handleAjax = () => {
  const reservationData = {
    date: "2023-03-17",
    time: "19:00",
    num_guests: 4,
    reservation_name: "John Doe",
    allergies: ["peanuts", "shellfish"],
  };
  const formData = new FormData();
  formData.append("time", "19:00");

  alert("fetch");
  fetch("/reservation-info", {
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      // "X-Requested-With": "XMLHttpRequest",
    },
    // body: JSON.stringify(reservationData),
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => console.log(data))
    .catch((error) => console.error(error));
};
