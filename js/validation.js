const form = document.getElementById("contact-form");
const nameInput = document.querySelector("#name");
const emailInput = document.querySelector("#email");
const messageInput = document.querySelector("#message");

form.addEventListener("submit", (event) => {
  event.preventDefault();
  validateForm();
});

function validateForm() {
  if (nameInput.value.trim() === "") {
    setError(nameInput, "Please enter your name");
  } else if (nameInput.value.trim().length < 5) {
    setError(nameInput, "Your full name must be at least 5 characters long");
  }
  if (emailInput.value.trim() === "") {
    setError(emailInput, "Please enter your email");
  } else if (!validateEmail(emailInput.value)) {
    setError(emailInput, "Please enter a valid email address");
  }
  if (messageInput.value.trim() === "") {
    setError(messageInput, "Please enter your message");
  }
}

function setError(input, message) {
  const formControl = input.parentElement;
  formControl.classList.add("error");
  const paragraph = formControl.querySelector("p");
  paragraph.textContent = message;
}

function validateEmail(emailInput) {
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  return mailformat.test(emailInput);
}
