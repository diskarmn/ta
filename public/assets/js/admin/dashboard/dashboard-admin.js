function Note(index) {
    const shortNotes = document.querySelector(`#shortNotes${index}`);
    const fullNotes = document.querySelector(`#fullNotes${index}`);
    const textLine = document.querySelector(`#textLine${index}`);

    if (window.innerWidth >= 768 && window.innerWidth <= 1024) {
        shortNotes.style.display = "none";
        fullNotes.style.display = "block";
        textLine.style.display = "none";
    } else if (shortNotes.style.display) {
    }

    if (shortNotes.style.display !== "none") {
        shortNotes.style.display = "none";
        fullNotes.style.display = "block";
        textLine.textContent = "Sembunyikan";
    } else {
        shortNotes.style.display = "block";
        fullNotes.style.display = "none";
        textLine.textContent = "Selengkapnya";
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const pilihJuragan = document.querySelectorAll(
        "#pilihJuragan + .dropdown-menu a"
    );

    pilihJuragan.forEach((item) => {
        item.addEventListener("click", function () {
            const selectedJuragan = this.getAttribute("data-value");
            document.getElementById("pilihJuragan").innerText = selectedJuragan;
        });
    });

    const tambahDropdownMenu = document.querySelectorAll(
        "#tambah-ukuran + .dropdown-menu a"
    );
    tambahDropdownMenu.forEach((item) => {
        item.addEventListener("click", function () {
            const selectedValue = this.getAttribute("data-value");
            document.getElementById("tambah-ukuran").innerText = selectedValue;
            document.getElementById("hidden-tambah-ukuran").value =
                selectedValue;
        });
    });
});

$(document).ready(function () {
    $(".dropdown-item").click(function (e) {
        e.preventDefault(); // Mencegah tautan mengarahkan ke halaman lain

        // Mengambil nilai id juragan dari data-value
        var juraganId = $(this).data("value");

        // Menetapkan nilai id ke input tersembunyi
        $("#juraganId").val(juraganId);

        // Submit form
        $(this).closest("form").submit();
    });
});
