document.getElementById("bookForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch("/backend/create.php", {
    method: "POST",
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    document.getElementById("response").innerText = data;
  })
  .catch(err => {
    document.getElementById("response").innerText = "Error submitting data.";
  });
});
