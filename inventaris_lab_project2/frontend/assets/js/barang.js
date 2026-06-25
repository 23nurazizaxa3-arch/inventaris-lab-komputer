document.addEventListener("DOMContentLoaded", loadBarang);

function loadBarang() {
  fetch("../backend/api/barang.php")
    .then(res => res.json())
    .then(data => {
      let row = "";
      data.forEach(item => {
        row += `
          <tr>
            <td>${item.id}</td>
            <td>${item.nama}</td>
            <td>${item.stok}</td>
            <td>
              <button onclick="hapus(${item.id})">Hapus</button>
            </td>
          </tr>
        `;
      });

      document.getElementById("tableBarang").innerHTML = row;
    });
}

function openModal() {
  document.getElementById("modal").style.display = "block";
}

function closeModal() {
  document.getElementById("modal").style.display = "none";
}

function saveBarang() {
  const nama = document.getElementById("nama").value;
  const stok = document.getElementById("stok").value;

  fetch("../backend/api/barang.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({ nama, stok })
  })
  .then(res => res.json())
  .then(() => {
    closeModal();
    loadBarang();
  });
}

function hapus(id) {
  fetch(`../backend/api/barang.php?id=${id}`, {
    method: "DELETE"
  })
  .then(() => loadBarang());
}