const STORAGE_KEY = "lensart_reservations";

const paketHarga = {
  "Paket Indie": 50000,
  "Paket LensArt": 80000,
  "Paket Kalcer": 120000,
  "Paket Custom": 150000
};

const defaultReservations = [
  {
    kodeBooking: "BK001",
    nama: "Alya Putri",
    email: "alya@gmail.com",
    instagram: "@alyaputri",
    noHp: "081234567890",
    jumlahOrang: 2,
    paket: "Paket Indie",
    harga: 50000,
    tanggal: "2026-05-12",
    jam: "10:00"
  },
  {
    kodeBooking: "BK002",
    nama: "Bima Saputra",
    email: "bima@gmail.com",
    instagram: "@bimasaputra",
    noHp: "081234567891",
    jumlahOrang: 3,
    paket: "Paket LensArt",
    harga: 80000,
    tanggal: "2026-05-13",
    jam: "13:00"
  },
  {
    kodeBooking: "BK003",
    nama: "Citra Lestari",
    email: "citra@gmail.com",
    instagram: "@citralestari",
    noHp: "081234567892",
    jumlahOrang: 4,
    paket: "Paket Kalcer",
    harga: 120000,
    tanggal: "2026-05-14",
    jam: "15:00"
  },
  {
    kodeBooking: "BK004",
    nama: "Doni Pratama",
    email: "doni@gmail.com",
    instagram: "@donipratama",
    noHp: "081234567893",
    jumlahOrang: 2,
    paket: "Paket Indie",
    harga: 50000,
    tanggal: "2026-05-15",
    jam: "09:00"
  },
  {
    kodeBooking: "BK005",
    nama: "Eva Maharani",
    email: "eva@gmail.com",
    instagram: "@evamaharani",
    noHp: "081234567894",
    jumlahOrang: 4,
    paket: "Paket LensArt",
    harga: 80000,
    tanggal: "2026-05-16",
    jam: "11:00"
  }
];

document.addEventListener("DOMContentLoaded", () => {
  setupBurgerMenu();
  setupReservationApp();
});

const formatRupiah = (angka) => {
  return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0
  }).format(angka);
};

const setupBurgerMenu = () => {
  const menuToggle = document.getElementById("menuToggle");
  const navMenu = document.getElementById("navMenu");

  if (!menuToggle || !navMenu) return;

  menuToggle.addEventListener("click", (event) => {
    event.stopPropagation();
    menuToggle.classList.toggle("active");
    navMenu.classList.toggle("show");
  });

  navMenu.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      menuToggle.classList.remove("active");
      navMenu.classList.remove("show");
    });
  });

  document.addEventListener("click", (event) => {
    const isClickInsideMenu = navMenu.contains(event.target);
    const isClickToggle = menuToggle.contains(event.target);

    if (!isClickInsideMenu && !isClickToggle) {
      menuToggle.classList.remove("active");
      navMenu.classList.remove("show");
    }
  });
};

const setupReservationApp = () => {
  const reservationBody = document.getElementById("reservationBody");
  const reservationForm = document.getElementById("reservationForm");

  if (!reservationBody || !reservationForm) return;

  let reservations = [];
  let filteredReservations = [];

  const searchInput = document.getElementById("searchInput");
  const filterCheckboxes = document.querySelectorAll(".filter-paket");
  const formMessage = document.getElementById("formMessage");
  const submitBtn = document.getElementById("submitBtn");
  const cancelEditBtn = document.getElementById("cancelEditBtn");
  const formTitle = document.getElementById("formTitle");
  const editIndexInput = document.getElementById("editIndex");

  const kodeBookingInput = document.getElementById("kodeBooking");
  const namaPelangganInput = document.getElementById("namaPelanggan");
  const emailInput = document.getElementById("email");
  const usernameInstagramInput = document.getElementById("usernameInstagram");
  const noHpInput = document.getElementById("noHp");
  const jumlahOrangInput = document.getElementById("jumlahOrang");
  const paketFotoInput = document.getElementById("paketFoto");
  const hargaDisplayInput = document.getElementById("hargaDisplay");
  const tanggalReservasiInput = document.getElementById("tanggalReservasi");
  const jamReservasiInput = document.getElementById("jamReservasi");

  const totalReservasiEl = document.getElementById("totalReservasi");
  const totalPendapatanEl = document.getElementById("totalPendapatan");
  const paketTerpopulerEl = document.getElementById("paketTerpopuler");
  const jadwalTersediaEl = document.getElementById("jadwalTersedia");
  const statusSlotEl = document.getElementById("statusSlot");
  const tableTotalReservasiEl = document.getElementById("tableTotalReservasi");

  const fieldMap = {
    kodeBooking: {
      input: kodeBookingInput,
      error: document.getElementById("errorKodeBooking")
    },
    namaPelanggan: {
      input: namaPelangganInput,
      error: document.getElementById("errorNamaPelanggan")
    },
    email: {
      input: emailInput,
      error: document.getElementById("errorEmail")
    },
    usernameInstagram: {
      input: usernameInstagramInput,
      error: document.getElementById("errorUsernameInstagram")
    },
    noHp: {
      input: noHpInput,
      error: document.getElementById("errorNoHp")
    },
    jumlahOrang: {
      input: jumlahOrangInput,
      error: document.getElementById("errorJumlahOrang")
    },
    paketFoto: {
      input: paketFotoInput,
      error: document.getElementById("errorPaketFoto")
    },
    tanggalReservasi: {
      input: tanggalReservasiInput,
      error: document.getElementById("errorTanggalReservasi")
    },
    jamReservasi: {
      input: jamReservasiInput,
      error: document.getElementById("errorJamReservasi")
    }
  };

  const saveToLocalStorage = () => {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(reservations));
  };

  const loadFromLocalStorage = () => {
    const savedData = JSON.parse(localStorage.getItem(STORAGE_KEY));

    if (savedData && Array.isArray(savedData) && savedData.length > 0) {
      reservations = savedData.map((item) => ({
        instagram: "",
        ...item
      }));
    } else {
      reservations = [...defaultReservations];
      saveToLocalStorage();
    }
  };

  const resetErrors = () => {
    Object.values(fieldMap).forEach(({ input, error }) => {
      input.classList.remove("input-error");
      error.textContent = "";
    });
  };

  const showFieldError = (fieldName, message) => {
    const field = fieldMap[fieldName];
    if (!field) return;

    field.input.classList.add("input-error");
    field.error.textContent = message;
  };

  const showFormMessage = (message, type) => {
    formMessage.textContent = message;
    formMessage.className = `form-message ${type}`;
  };

  const clearFormMessage = () => {
    formMessage.textContent = "";
    formMessage.className = "form-message";
  };

  const clearForm = () => {
    reservationForm.reset();
    editIndexInput.value = "-1";
    submitBtn.textContent = "Simpan Reservasi";
    formTitle.textContent = "Daftar Reservasi";
    cancelEditBtn.classList.add("hidden");
    hargaDisplayInput.value = "";
    resetErrors();
    clearFormMessage();
  };

  const getTodayDate = () => {
    const now = new Date();
    return now.toISOString().split("T")[0];
  };

  const validateForm = () => {
    resetErrors();
    clearFormMessage();

    const kodeBooking = kodeBookingInput.value.trim();
    const nama = namaPelangganInput.value.trim();
    const email = emailInput.value.trim();
    const instagram = usernameInstagramInput.value.trim();
    const noHp = noHpInput.value.trim();
    const jumlahOrang = Number(jumlahOrangInput.value);
    const paket = paketFotoInput.value;
    const tanggal = tanggalReservasiInput.value;
    const jam = jamReservasiInput.value;
    const editIndex = Number(editIndexInput.value);

    let isValid = true;

    if (kodeBooking === "") {
      showFieldError("kodeBooking", "Kode booking wajib diisi.");
      isValid = false;
    } else {
      const isDuplicate = reservations.some((item, index) => {
        return item.kodeBooking.toLowerCase() === kodeBooking.toLowerCase() && index !== editIndex;
      });

      if (isDuplicate) {
        showFieldError("kodeBooking", "Kode booking harus unik.");
        isValid = false;
      }
    }

    if (nama === "") {
      showFieldError("namaPelanggan", "Nama pelanggan wajib diisi.");
      isValid = false;
    } else if (nama.length < 3) {
      showFieldError("namaPelanggan", "Nama pelanggan minimal 3 karakter.");
      isValid = false;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "") {
      showFieldError("email", "Email wajib diisi.");
      isValid = false;
    } else if (!emailPattern.test(email)) {
      showFieldError("email", "Format email tidak valid.");
      isValid = false;
    }

    if (instagram === "") {
      showFieldError("usernameInstagram", "Username Instagram wajib diisi.");
      isValid = false;
    } else if (instagram.length < 3) {
      showFieldError("usernameInstagram", "Username Instagram minimal 3 karakter.");
      isValid = false;
    }

    const phonePattern = /^\d+$/;
    if (noHp === "") {
      showFieldError("noHp", "No. HP wajib diisi.");
      isValid = false;
    } else if (!phonePattern.test(noHp)) {
      showFieldError("noHp", "No. HP hanya boleh angka.");
      isValid = false;
    }

    if (!jumlahOrangInput.value.trim()) {
      showFieldError("jumlahOrang", "Jumlah orang wajib diisi.");
      isValid = false;
    } else if (jumlahOrang < 1) {
      showFieldError("jumlahOrang", "Jumlah orang minimal 1.");
      isValid = false;
    }

    if (paket === "") {
      showFieldError("paketFoto", "Paket foto wajib dipilih.");
      isValid = false;
    }

    if (tanggal === "") {
      showFieldError("tanggalReservasi", "Tanggal reservasi wajib diisi.");
      isValid = false;
    }

    if (jam === "") {
      showFieldError("jamReservasi", "Jam reservasi wajib dipilih.");
      isValid = false;
    }

    if (!isValid) {
      showFormMessage("Data belum valid. Periksa kembali input yang ditandai.", "error");
    }

    return isValid;
  };

  const getFormData = () => {
    const paket = paketFotoInput.value;
    const harga = paketHarga[paket] || 0;

    return {
      kodeBooking: kodeBookingInput.value.trim(),
      nama: namaPelangganInput.value.trim(),
      email: emailInput.value.trim(),
      instagram: usernameInstagramInput.value.trim(),
      noHp: noHpInput.value.trim(),
      jumlahOrang: Number(jumlahOrangInput.value),
      paket,
      harga,
      tanggal: tanggalReservasiInput.value,
      jam: jamReservasiInput.value
    };
  };

  const getActiveFilters = () => {
    return [...filterCheckboxes]
      .filter((checkbox) => checkbox.checked)
      .map((checkbox) => checkbox.value);
  };

  const getFilteredReservations = () => {
    const keyword = searchInput.value.trim().toLowerCase();
    const activeFilters = getActiveFilters();

    return reservations.filter((item) => {
      const cocokSearch =
        item.nama.toLowerCase().includes(keyword) ||
        item.kodeBooking.toLowerCase().includes(keyword);

      const cocokFilter =
        activeFilters.length === 0 || activeFilters.includes(item.paket);

      return cocokSearch && cocokFilter;
    });
  };

  const renderTable = () => {
    filteredReservations = getFilteredReservations();

    if (filteredReservations.length === 0) {
      reservationBody.innerHTML = `
        <tr>
          <td colspan="12" class="empty-state">Data reservasi tidak ditemukan.</td>
        </tr>
      `;
      tableTotalReservasiEl.textContent = "0";
      return;
    }

    reservationBody.innerHTML = filteredReservations
      .map((item, index) => {
        const originalIndex = reservations.findIndex((data) => data.kodeBooking === item.kodeBooking);

        return `
          <tr>
            <td>${index + 1}</td>
            <td>${item.kodeBooking}</td>
            <td>${item.nama}</td>
            <td>${item.email}</td>
            <td>${item.instagram || "-"}</td>
            <td>${item.noHp}</td>
            <td>${item.jumlahOrang}</td>
            <td>${item.paket}</td>
            <td>${formatRupiah(item.harga)}</td>
            <td>${item.tanggal}</td>
            <td>${item.jam}</td>
            <td>
              <div class="action-buttons">
                <button type="button" class="btn-edit" data-action="edit" data-index="${originalIndex}">Edit</button>
                <button type="button" class="btn-delete" data-action="delete" data-index="${originalIndex}">Hapus</button>
              </div>
            </td>
          </tr>
        `;
      })
      .join("");

    tableTotalReservasiEl.textContent = filteredReservations.length;
  };

  const renderStatistics = () => {
    const totalReservasi = reservations.length;
    const totalPendapatan = reservations.reduce((total, item) => total + item.harga, 0);

    const paketCount = reservations.reduce((acc, item) => {
      acc[item.paket] = (acc[item.paket] || 0) + 1;
      return acc;
    }, {});

    let paketTerpopuler = "-";
    let jumlahTerbesar = 0;

    Object.entries(paketCount).forEach(([paket, jumlah]) => {
      if (jumlah > jumlahTerbesar) {
        jumlahTerbesar = jumlah;
        paketTerpopuler = paket;
      }
    });

    const maxSlotHarian = 14;
    const hariIni = getTodayDate();
    const bookingHariIni = reservations.filter((item) => item.tanggal === hariIni).length;
    const jadwalTersedia = Math.max(0, maxSlotHarian - bookingHariIni);

    totalReservasiEl.textContent = totalReservasi;
    totalPendapatanEl.textContent = formatRupiah(totalPendapatan);
    paketTerpopulerEl.textContent = paketTerpopuler;
    jadwalTersediaEl.textContent = jadwalTersedia;

    if (jadwalTersedia < 5) {
      statusSlotEl.textContent = "Slot menipis (<5)";
      statusSlotEl.className = "status-warning";
    } else {
      statusSlotEl.textContent = "Slot aman";
      statusSlotEl.className = "status-safe";
    }
  };

  const renderAll = () => {
    renderTable();
    renderStatistics();
  };

  const fillFormForEdit = (index) => {
    const data = reservations[index];
    if (!data) return;

    kodeBookingInput.value = data.kodeBooking;
    namaPelangganInput.value = data.nama;
    emailInput.value = data.email;
    usernameInstagramInput.value = data.instagram || "";
    noHpInput.value = data.noHp;
    jumlahOrangInput.value = data.jumlahOrang;
    paketFotoInput.value = data.paket;
    hargaDisplayInput.value = formatRupiah(data.harga);
    tanggalReservasiInput.value = data.tanggal;
    jamReservasiInput.value = data.jam;

    editIndexInput.value = index;
    submitBtn.textContent = "Update Reservasi";
    formTitle.textContent = "Edit Reservasi";
    cancelEditBtn.classList.remove("hidden");
    clearFormMessage();
    resetErrors();

    window.scrollTo({
      top: reservationForm.offsetTop - 120,
      behavior: "smooth"
    });
  };

  const handleSubmit = (event) => {
    event.preventDefault();

    const isValid = validateForm();
    if (!isValid) return;

    const formData = getFormData();
    const editIndex = Number(editIndexInput.value);

    if (editIndex >= 0) {
      reservations[editIndex] = formData;
      showFormMessage("Data reservasi berhasil diperbarui.", "success");
    } else {
      reservations.push(formData);
      showFormMessage("Data reservasi berhasil ditambahkan.", "success");
    }

    saveToLocalStorage();
    renderAll();
    clearForm();
  };

  const handleTableClick = (event) => {
    const target = event.target;

    if (!target.matches("button[data-action]")) return;

    const action = target.dataset.action;
    const index = Number(target.dataset.index);

    if (action === "edit") {
      fillFormForEdit(index);
    }

    if (action === "delete") {
      const isConfirmed = confirm("Yakin ingin menghapus reservasi ini?");
      if (!isConfirmed) return;

      reservations.splice(index, 1);
      saveToLocalStorage();
      renderAll();
      clearForm();
      showFormMessage("Data reservasi berhasil dihapus.", "success");
    }
  };

  const handleSearch = () => {
    renderTable();
  };

  const handleFilter = () => {
    renderTable();
  };

  const handlePaketChange = () => {
    const selectedPaket = paketFotoInput.value;
    if (selectedPaket && paketHarga[selectedPaket]) {
      hargaDisplayInput.value = formatRupiah(paketHarga[selectedPaket]);
    } else {
      hargaDisplayInput.value = "";
    }
  };

  reservationForm.addEventListener("submit", handleSubmit);
  reservationBody.addEventListener("click", handleTableClick);
  searchInput.addEventListener("input", handleSearch);
  cancelEditBtn.addEventListener("click", clearForm);
  paketFotoInput.addEventListener("change", handlePaketChange);

  filterCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", handleFilter);
  });

  loadFromLocalStorage();
  renderAll();
};
