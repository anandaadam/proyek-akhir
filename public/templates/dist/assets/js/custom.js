/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";
// -------------------- Modal Konfirmasi Penghapusan --------------------
const allRemoveButtons = document.querySelectorAll(".btn-remove-data");
let data;

allRemoveButtons.forEach((button) => {
  button.addEventListener("click", () => {
    data = button.dataset.remove;
    const removes = document.querySelectorAll(".btn-for-remove");

    removes.forEach((remove) => {
      remove.addEventListener("click", () => {
        const form = document.querySelector(`.form${data}`);
        form.submit();
      });
    });
  });
});

// -------------------- Trim pada form update master data --------------------
document.querySelectorAll(".form-update-master-data").forEach((element) => {
  element.value = element.value.trim();
});

// -------------------- Transaksi Pembelian (Detail Pembelian) --------------------
let totalPembelian = 0;

function hapusItemPembelian() {
  document.querySelectorAll(".btn-hapus-item").forEach((btn) => {
    btn.addEventListener("click", () => {
      $.ajax({
        method: "DELETE",
        url: `${window.location.origin}/DetailPembelian/cancel/${btn.dataset.item}`,
        success: function (response) {
          ambilDataDetailPembelian();
        },
      });
    });
  });
}

function setTotalPembelian() {
  const nilaiTotalPembelian = document.querySelector(
    ".jumlah_total_pembelian"
  ).value;
  document.querySelector(
    ".total-pembelian"
  ).textContent = `Total pembelian: ${nilaiTotalPembelian}`;
}

function initPembelian() {
  document.querySelector(".harga-pembelian").value = "0";
  document.querySelector(".jumlah-pembelian").value = 0;
}

function ambilDataDetailPembelian() {
  $.ajax({
    method: "GET",
    url: `${window.location.origin}/DetailPembelian/item`,
    dataType: "json",
    success: function (response) {
      $(".tabel-pembelian").html(response.data);
      hapusItemPembelian();
      setTotalPembelian();
    },
  });
}

$(".btn-tambah-bahan").click(function () {
  var idBahan = $(".id-bahan option:selected").val();
  var namaBahan = $(".id-bahan option:selected").text();
  var hargaPembelian = $(".harga-pembelian").val();
  var jumlahPembelian = $(".jumlah-pembelian").val();

  if (!hargaPembelian || !jumlahPembelian)
    return swal(
      "Data Pembelian Tidak Lengkap",
      "Silahkan lengkapai data pembelian",
      "warning"
    );

  $.ajax({
    type: "POST",
    url: `${window.location.origin}/DetailPembelian/store`,
    data: {
      id_bahan: idBahan,
      harga_pembelian: hargaPembelian,
      jumlah_pembelian: jumlahPembelian,
    },
    cache: false,
    success: function (response) {
      ambilDataDetailPembelian();
      initPembelian();
    },
  });
});

// -------------------- Transaksi Retur Pembelian (Detail Pembelian) --------------------
// function setTotalPembelian() {
//   const nilaiTotalPembelian = document.querySelector(
//     ".jumlah_total_pembelian"
//   ).value;
//   document.querySelector(
//     ".total-pembelian"
//   ).textContent = `Total pembelian: ${nilaiTotalPembelian}`;
// }

function hapusItemReturPembelian() {
  document.querySelectorAll(".btn-hapus-retur-item").forEach((btn) => {
    btn.addEventListener("click", () => {
      $.ajax({
        method: "DELETE",
        url: `${window.location.origin}/DetailReturPembelian/cancel/${btn.dataset.item}`,
        success: function (response) {
          ambilDataDetailReturPembelian();
        },
      });
    });
  });
}

function initReturPembelian() {
  document.querySelector(".jumlah-retur-pembelian").value = 0;
}

function ambilDataDetailReturPembelian() {
  $.ajax({
    method: "GET",
    url: `${window.location.origin}/DetailReturPembelian/item`,
    dataType: "json",
    success: function (response) {
      $(".tabel-retur-pembelian").html(response.data);
      hapusItemReturPembelian();
      // setTotalPembelian();
    },
  });
}

$(".btn-tambah-retur-bahan").click(function () {
  var idBahan = $(".id-retur-bahan option:selected").val();
  var jumlahReturPembelian = $(".jumlah-retur-pembelian").val();

  const dataItemBahan = idBahan.split("-");

  if (!idBahan || !jumlahReturPembelian)
    return swal(
      "Data Retur Pembelian Tidak Lengkap",
      "Silahkan lengkapai data retur pembelian",
      "warning"
    );

  $.ajax({
    type: "POST",
    url: `${window.location.origin}/DetailReturPembelian/store`,
    data: {
      id_bahan: dataItemBahan[0],
      harga_retur_pembelian: dataItemBahan[1],
      jumlah_retur_pembelian: jumlahReturPembelian,
    },
    cache: false,
    success: function (response) {
      ambilDataDetailReturPembelian();
      initReturPembelian();
    },
  });
});

// -------------------- Jurnal Umum --------------------
$(".btn-jurnal-umum").click(function () {
  var periodeTahun = $(".periode-tahun option:selected").val();
  var periodeBulan = $(".periode-bulan option:selected").val().split("-");

  document.querySelector(
    ".periode-jurnal-umum"
  ).textContent = `Periode ${periodeBulan[1]} ${periodeTahun}`;

  if (!periodeTahun || !periodeBulan) {
    return swal(
      "Data Jurnal Tidak Lengkap",
      "Silahkan lengkapai data jurnal",
      "warning"
    );
  }

  $.ajax({
    method: "GET",
    url: `${window.location.origin}/JurnalUmum/show/${periodeTahun}/${periodeBulan[0]}`,
    dataType: "json",
    success: function (response) {
      $(".tabel-jurnal-umum").html(response.data);
    },
    error: function (xmlHttpRequest, textStatus, errorThrown) {
      alert(errorThrown);
    },
  });
});

// -------------------- Buku Besar --------------------
$(".btn-buku-besar").click(function () {
  var periodeTahun = $(".periode-tahun option:selected").val();
  var periodeBulan = $(".periode-bulan option:selected").val().split("-");
  var kodeAkun = $(".kode-akun option:selected").val().split("-");

  document.querySelector(
    ".periode-buku-besar"
  ).textContent = `Periode ${periodeBulan[1]} ${periodeTahun}`;

  if (!periodeTahun || !periodeBulan) {
    return swal(
      "Data Jurnal Tidak Lengkap",
      "Silahkan lengkapai data jurnal",
      "warning"
    );
  }

  $.ajax({
    method: "GET",
    url: `${window.location.origin}/BukuBesar/show/${kodeAkun[0]}/${periodeTahun}/${periodeBulan[0]}`,
    dataType: "json",
    success: function (response) {
      $(".tabel-buku-besar").html(response.data);
    },
    error: function (errorThrown) {
      alert(errorThrown);
    },
  });
});

// -------------------- Bill Of Material --------------------
const btnTambahBahanBom = document.querySelector(".btn-tambah-bahan-bom");
const initJumlahBahanBom = document.querySelector(".jumlah-bahan-bom");
const jumlahBom = document.querySelector(".jumlah-bom");
let currentNumber = 1;

btnTambahBahanBom.addEventListener("click", () => {
  const idBahan = $(".bahan-bom option:selected").val();
  const namaBahan = $(".bahan-bom option:selected").text();
  const jumlahBahan = document.querySelector(".jumlah-bahan-bom").value;

  if (!idBahan || !namaBahan || !jumlahBahan) {
    return swal(
      "Data BOM Tidak Lengkap",
      "Silahkan lengkapai data BOM",
      "warning"
    );
  }

  const tabelBom = document.querySelector(".tabel-bom");
  const jumlahBom = document.querySelector(".jumlah-bom");
  const containerInputBom = document.querySelector(".container-input-bom");
  const html = `
                <tr class="tr-bom-${currentNumber}">
                  <td class="number-row-${currentNumber}">${currentNumber}</td>
                  <td>${namaBahan}</td>
                  <td>${jumlahBahan}</td>
                  <td><button class="btn btn-danger btn-hapus-item-bom" data-item="${currentNumber}" type="button"><i class="fa fa-trash fa-xl"></i></button></td>
                </tr>
  `;
  const htmlInput = `
                <input type="hidden" name="bahan-bom-${currentNumber}" class="bahan-bom-${currentNumber}" value="${namaBahan}">
                <input type="hidden" name="kuantitas-bom-${currentNumber}" class="kuantitas-bom-${currentNumber}" value="${jumlahBahan}">
  `;

  tabelBom.insertAdjacentHTML("beforeend", html);
  containerInputBom.insertAdjacentHTML("beforeend", htmlInput);
  jumlahBom.value = currentNumber;
  initJumlahBahanBom.value = 0;

  currentNumber++;
});

// Delete item on Bill of Material
const tabelBom = document.querySelector(".tabel-bom");
tabelBom.addEventListener("click", (event) => {
  const btnHapusItemBom = event.target.closest(".btn-hapus-item-bom");
  if (!btnHapusItemBom) return;

  const currentRow = btnHapusItemBom.dataset.item;
  const deleteRow = document.querySelector(`.tr-bom-${currentRow}`);
  const inputBahanBom = document.querySelector(`.bahan-bom-${currentRow}`);
  const inputQtyBom = document.querySelector(`.kuantitas-bom-${currentRow}`);

  document.querySelector(".jumlah-bom").value = currentNumber - 2;
  deleteRow.remove();
  inputBahanBom.remove();
  inputQtyBom.remove();
  currentNumber--;

  if (currentRow < currentNumber) {
    const sisaBarisDiatas = currentNumber - +currentRow;
    for (let i = 1; i <= sisaBarisDiatas; i++) {
      const lastOrderNumber = +currentRow + i;
      const sisaElementDiatas = document.querySelector(
        `[data-item="${lastOrderNumber}"]`
      );
      const parentElement = sisaElementDiatas.closest(
        `.tr-bom-${lastOrderNumber}`
      );
      const numberRow = document.querySelector(
        `.number-row-${lastOrderNumber}`
      );

      sisaElementDiatas.dataset.item = lastOrderNumber - 1;
      parentElement.classList.replace(
        `tr-bom-${lastOrderNumber}`,
        `tr-bom-${lastOrderNumber - 1}`
      );
      numberRow.classList.replace(
        `number-row-${lastOrderNumber}`,
        `number-row-${lastOrderNumber - 1}`
      );
      numberRow.textContent = lastOrderNumber - 1;

      const sisaInputBahanBom = document.querySelector(
        `.bahan-bom-${lastOrderNumber}`
      );
      const sisaInputQtyBahanBom = document.querySelector(
        `.kuantitas-bom-${lastOrderNumber}`
      );

      sisaInputBahanBom.setAttribute(
        "name",
        `bahan-bom-${lastOrderNumber - 1}`
      );
      sisaInputQtyBahanBom.setAttribute(
        "name",
        `kuantitas-bom-${lastOrderNumber - 1}`
      );

      sisaInputBahanBom.classList.replace(
        `bahan-bom-${lastOrderNumber}`,
        `bahan-bom-${lastOrderNumber - 1}`
      );
      sisaInputQtyBahanBom.classList.replace(
        `kuantitas-bom-${lastOrderNumber}`,
        `kuantitas-bom-${lastOrderNumber - 1}`
      );
    }
  }
});
