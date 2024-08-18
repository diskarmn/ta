@php
    $status = isset($order) ? $order->status : 'belum_proses';    
@endphp


{{-- Modal Tambah Pembayaran --}}
@if(isset($order))
<div class="modal fade" id="tambahPembayaranModal" tabindex="-1" aria-labelledby="tambahPembayaranModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('update.order.status', ['orderId' => $order->id]) }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="tambahPembayaranModalLabel">Tambah Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="bg-warning text-secondary rounded-1 text-center fs-6 fw-medium font-family-Montserrat m-0 px-3 py-2">Detail Pembayaran tidak bisa diganti atau diubah</p>
                    <!-- Add your form or content for Tambah Pembayaran inside this div -->
                    <!-- Example Form -->
                        <div class="d-flex gap-4 justify-content-between">
                            <div class="col-lg-5 my-2">
                                <label for="ukuran" class="col-form-label">Tujuan Pembayaran</label>
                                <div class="dropdown">
                                    <button class="btn d-flex justify-content-between align-items-center bg-white border w-100 border-black rounded rounded-3 dropdown-toggle @error('tujuan_bayar') is-invalid @enderror" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="tujuan_bayar" data-name="tujuan_bayar">
                                        Pilih Tujuan
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" data-value="BRI (Nama CS)">BRI (Nama CS)</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="Tunggu Konfirmasi Pembayaran">Tunggu Konfirmasi Pembayaran</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="Cicilan / Kredit">Cicilan / Kredit</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="Ada kelebihan">Ada kelebihan</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="Sudah Lunas">Sudah Lunas</a></li>
                                    </ul>
                                    <input type="hidden" name="status" id="modalBayar" value="{{ $status }}">
                                {{-- @error('size')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror --}}
                                </div>                      
                            </div>
                            <div class="my-2 col-lg-5">
                                <label for="tgl-bayar" class="col-form-label">Tanggal Bayar</label>
                                <input type="date" name="tgl_bayar" class="form-control shadow">
                            </div>
                        </div>
                        
                            <div class="mb-3 col-lg-12">
                                <label for="jumlah-dana" class="col-form-label">Jumlah Dana</label>
                                <input type="text" name="jumlah_dana" class="form-control shadow">
                            </div>
                            
                            <!-- Add more form fields as needed -->

                            <!-- Add your form submit button or any other content here -->
                </div>
                <div class="modal-footer justify-content-start gap-2">
                    <button type="submit" class="btn btn-primary modal_btn_width" id="btnSimpanBayar">Simpan</button>
                    <button type="button" class="btn btn-secondary modal_btn_width" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
{{-- Akhir Modal Tambah Pembayaran --}}

<script>
  document.addEventListener('DOMContentLoaded', function () {
  const status = "{{ $status }}";
    const tambahBayarDropdownMenu = document.querySelectorAll('#tujuan_bayar + .dropdown-menu a');
    tambahBayarDropdownMenu.forEach(item => {
        item.addEventListener('click', function () {
            const selectedValue = this.getAttribute('data-value');
            document.getElementById('tujuan_bayar').innerText = selectedValue;
            document.getElementById('tujuan_bayar').value = selectedValue;
        });
    });

    const simpanBtn = document.getElementById('btnSimpanBayar');
    simpanBtn.addEventListener('click', function () {
        document.getElementById('modalBayar').value = 'cek_pembayaran';
    })
  })
</script>