function expandKeterangan() {
    var myDiv = document.getElementById("keterangan");
    var currentHeight = myDiv.clientHeight;
    var autoHeight = myDiv.scrollHeight;

    // Jika sedang terbuka, tutup
    if (currentHeight === autoHeight) {
        myDiv.style.height = "195px";
        document.getElementById("selengkapnya").style.display = "inline"; // Menampilkan tombol "Selengkapnya" kembali
        document.getElementById("dot").style.display = "inline";
    } else {
        myDiv.style.height = autoHeight + "px";
        document.getElementById("selengkapnya").style.display = "none"; // Menyembunyikan tombol "Selengkapnya"
        document.getElementById("dot").style.display = "none";
    }
}

var modalReq = document.getElementById("modalRequest");
modalReq.addEventListener("shown.bs.modal", function (event) {
    // Hapus kelas 'unread' dari elemen <li>
    document.getElementById("request1").classList.remove("unread");
});

function removeUnreadClass() {
    // Ambil semua elemen dengan kelas 'unread'
    var unreadElements = document.querySelectorAll(".unread");

    // Iterasi melalui setiap elemen dan hapus kelas 'unread'
    unreadElements.forEach(function (element) {
        element.classList.remove("unread");
    });
}

function handleAccept() {
    // Ambil elemen <li> dengan id 'request1'
    var requestElement = document.getElementById("request1");

    // Temukan elemen button di dalam elemen dengan ID 'request1'
    var buttonElement = requestElement.querySelector(".btn-detail");

    // Hapus elemen button dari elemen <li>
    buttonElement.parentNode.removeChild(buttonElement);

    // Buat elemen baru <div class="col-lg-1"> dengan <p class="text-center fw-bold "></p>
    var newElement = document.createElement("div");
    newElement.className = "col-lg-1";
    newElement.innerHTML = '<p class="text-center fw-bold accept"></p>';

    // Tambahkan elemen baru ke dalam elemen <li>
    requestElement.appendChild(newElement);

    // Temukan elemen pertama dalam daftar dengan id 'reqFinished'
    var firstElement = document.getElementById("reqFinished").firstChild;

    // Tambahkan elemen yang diambil ke dalam daftar dengan id 'reqFinished' sebelum elemen pertama
    document
        .getElementById("reqFinished")
        .insertBefore(requestElement, firstElement);
}

function handleDenied() {
    // Ambil elemen <li> dengan id 'request1'
    var requestElement = document.getElementById("request1");

    // Temukan elemen button di dalam elemen dengan ID 'request1'
    var buttonElement = requestElement.querySelector(".btn-detail");

    // Hapus elemen button dari elemen <li>
    buttonElement.parentNode.removeChild(buttonElement);

    // Buat elemen baru <div class="col-lg-1"> dengan <p class="text-center fw-bold "></p>
    var newElement = document.createElement("div");
    newElement.className = "col-lg-1";
    newElement.innerHTML = '<p class="text-center fw-bold denied"></p>';

    // Tambahkan elemen baru ke dalam elemen <li>
    requestElement.appendChild(newElement);

    // Temukan elemen pertama dalam daftar dengan id 'reqFinished'
    var firstElement = document.getElementById("reqFinished").firstChild;

    // Tambahkan elemen yang diambil ke dalam daftar dengan id 'reqFinished' sebelum elemen pertama
    document
        .getElementById("reqFinished")
        .insertBefore(requestElement, firstElement);
}
