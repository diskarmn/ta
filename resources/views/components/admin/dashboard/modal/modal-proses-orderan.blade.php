@php
    $status = $order->status ?? 'belum_proses';
@endphp

{{-- Modal Proses Orderan --}}
<div class="modal fade" id="prosesOrderanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="prosesOrderanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="prosesOrderanModalLabel">Status Proses Orderan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="bg-warning text-secondary rounded-1 text-center fs-6 fw-medium font-family-Montserrat m-0 px-3 py-2">Perlu diingat, penambahan status orderan ini tidak bisa diubah!</p>
                    <!-- Add your form or content for Tambah Pembayaran inside this div -->
                    <!-- Example Form -->
                        <div class="d-flex gap-1 justify-content-between">
                            <div class="col-lg-6 my-2">
                                <label for="ukuran" class="col-form-label">Pilih Status</label>
                                <div class="dropdown">
                                    <button class="btn d-flex justify-content-between align-items-center bg-white border w-100 border-black rounded rounded-3 dropdown-toggle @error('pilih_status') is-invalid @enderror" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="pilih_status" data-name="pilih_status" name="pilih_status">
                                        Pilih Status
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item status-option" href="#" data-value="Data Pesanan">Data Pesanan</a></li>
                                        <li><a class="dropdown-item status-option" href="#" data-value="Bahan Produk">Bahan Produk</a></li>
                                        <li><a class="dropdown-item status-option" href="#" data-value="Sablon">Sablon</a></li>
                                        <li><a class="dropdown-item status-option" href="#" data-value="Bordir">Bordir</a></li>
                                        <li><a class="dropdown-item status-option" href="#" data-value="Penjahit">Penjahit</a></li>
                                        <li><a class="dropdown-item status-option" href="#" data-value="QC">QC</a></li>
                                        <li><a class="dropdown-item status-option" href="#" data-value="Packing">Packing</a></li>
                                    </ul>
                                    <input type="hidden" name="status" id="modalStatus" value="{{ $status }}">
                                {{-- @error('size')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror --}}
                                </div>                      
                            </div>
                            <div class="col-lg-6 my-2">
                                <label for="pilih" class="col-form-label text-white">Pilih</label>
                                <div class="dropdown">
                                    <button class="btn d-flex justify-content-between align-items-center bg-white border w-100 border-black rounded rounded-3 dropdown-toggle @error('kelengkapan') is-invalid @enderror" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="kelengkapan" data-name="kelengkapan">
                                        Pilih
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" data-value="Lengkap">Lengkap</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="Belum Lengkap">Belum Lengkap</a></li>
                                    </ul>
                                    <input type="hidden" name="kelengkapan" id="checkKelengkapan" value="{{ old('kelengkapan') }}">
                                {{-- @error('size')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror --}}
                                </div>                      
                            </div>
                        </div>
                        
                            <div class="mb-3 col-lg-12">
                                <label for="jumlah-dana" class="col-form-label">Note / Keterangan</label>
                                <input type="text" class="form-control shadow" placeholder="Opsional">
                            </div>
                            
                            <!-- Add more form fields as needed -->

                            <!-- Add your form submit button or any other content here -->
                </div>
                <div class="modal-footer justify-content-start gap-2">
                    <button type="submit" class="btn btn-primary modal_btn_width" data-bs-toggle="modal" data-bs-target="#confirmPerubahanStatusOrderModal">Simpan</button>
                    <button type="button" class="btn btn-secondary modal_btn_width" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Akhir Modal Proses Orderan --}}

{{-- Modal Confirm Perubahan Status Order Modal --}}
{{-- <x-confirm-modal-status /> --}}
<div class="modal fade" id="confirmPerubahanStatusOrderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmPerubahanStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="confirmPerubahanStatusModalLabel">Ubah Status Orderan</h5>
                </div>
                <div class="modal-body text-center">
                    <p>Setelah data status yang diubah disimpan, data tersebut <span class="text-danger">tidak bisa diubah kembali</span><br>Apakah Anda yakin menyimpan data ini?</p>                        
                </div>                            
                <div class="modal-footer justify-content-center gap-2">
                    <button type="button" class="btn btn-secondary modal_btn_width" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary modal_btn_width" data-bs-toggle="modal" data-bs-target="confirmPerubahanStatusOrderModal">Simpan</button>
                </div>
        </div>
    </div>
</div>
{{-- Akhir Modal Confirm Perubahan Status Order Modal --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const status = "{{ $status }}";
        const dropdownItems = document.querySelectorAll('.status-option');

        if (status === 'belum_proses') {
            dropdownItems.forEach(item => {
                if (item.getAttribute('data-value') === 'Data Pesanan') {
                    item.classList.remove('disabled');
                } else {
                    item.classList.add('disabled');
                }
            });
        }

        if (status === 'cek_pembayaran') {
            dropdownItems.forEach(item => {
                if (item.getAttribute('data-value') !== 'Data Pesanan') {
                    item.classList.remove('disabled');
                } else {
                    item.classList.add('disabled');
                }
            });
        }

        const tambahDropdownMenu = document.querySelectorAll('#pilih_status + .dropdown-menu a');
        tambahDropdownMenu.forEach(item => {
            item.addEventListener('click', function () {
                const selectedValue = this.getAttribute('data-value');
                document.getElementById('pilih_status').innerText = selectedValue;
                document.getElementById('pilih_status').value = selectedValue;
            });
        });

        const kelengkapanDropdownMenu = document.querySelectorAll('#kelengkapan + .dropdown-menu a');
        kelengkapanDropdownMenu.forEach(item => {
            item.addEventListener('click', function () {
                const selectedValue = this.getAttribute('data-value');
                document.getElementById('kelengkapan').innerText = selectedValue;
                document.getElementById('kelengkapan').value = selectedValue;
            });
        });

        const simpanButton = document.querySelector('#confirmPerubahanStatusOrderModal .btn-primary');
        simpanButton.addEventListener('click', handleSimpanClick);

        function handleSimpanClick() {
            // Check if kelengkapan is 'Lengkap'
            const kelengkapanValue = document.getElementById('kelengkapan').innerText.trim();
            if (kelengkapanValue === 'Lengkap') {
                // Show confirm-modal-status
                const confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmPerubahanStatusOrderModal'));
                confirmModal.show();

                // Hide modal-proses-orderan
                const modalProsesOrderan = bootstrap.Modal.getInstance(document.getElementById('prosesOrderanModal'));
                modalProsesOrderan.hide();
            } else {
                // Proceed with the regular saving logic
                // ...

                // Close modal-proses-orderan
                const modalProsesOrderan = bootstrap.Modal.getInstance(document.getElementById('prosesOrderanModal'));
                modalProsesOrderan.hide();
            }
        }
    });
</script>
