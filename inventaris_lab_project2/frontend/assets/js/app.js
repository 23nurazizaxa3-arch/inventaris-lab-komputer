document.addEventListener("DOMContentLoaded", () => {

  fetch("../backend/api/dashboard.php")
    .then(res => res.json())
    .then(data => {

      document.getElementById("barang").innerText = data.barang;
      document.getElementById("kategori").innerText = data.kategori;
      document.getElementById("laboratorium").innerText = data.laboratorium;
      document.getElementById("peminjaman").innerText = data.peminjaman;
      document.getElementById("maintenance").innerText = data.maintenance;
      document.getElementById("users").innerText = data.users;

    })
    .catch(err => console.log("Error:", err));

});