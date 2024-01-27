document.addEventListener("DOMContentLoaded", function () {
  const links = document.querySelectorAll(".navBar a");
  links.forEach(link => {
    link.addEventListener("click", function (event) {
      event.preventDefault(); // Prevent default link behavior
      const studentDivs = document.querySelectorAll(".student-div");
      studentDivs.forEach(div => {
        div.style.display = "none";
      });
      
    });
  });
});