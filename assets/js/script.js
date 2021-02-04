const trash = document.querySelectorAll(".delete");

trash.forEach(element => {
  element.addEventListener("click", function (event) {
    var reponse = confirm("Are you sure to delete this element?");
    if (reponse == false) {
      event.preventDefault();
    }
  });
})
