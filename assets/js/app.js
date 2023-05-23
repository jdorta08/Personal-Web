const tracker = document.querySelector(".tracker");

document.addEventListener("mousemove", (event) => {
  let x = (event.clientX * 100) / window.innerWidth + "%";
  let y = (event.clientY * 100) / window.innerHeight + "%";

  tracker.style.left = x;
  tracker.style.top = y;

  console.log(x, y);
});

document.addEventListener("scroll", (event) => {
  let x = event.clientX;
  let y = event.clientY;

  tracker.style.left = x;
  tracker.style.top = y;

  console.log(x, y);
});
