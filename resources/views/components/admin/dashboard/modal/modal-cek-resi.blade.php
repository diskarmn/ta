{{-- Modal Cek Resi --}}
<div class="modal fade" id="cekResiModal" tabindex="-1" aria-labelledby="cekResiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="cekResiModalLabel">Input Resi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="d-flex gap-1 justify-content-between">
                            <div class="col-lg-6 my-2">
                                <label for="ukuran" class="col-form-label">Pilih Kurir</label>
                                <div class="dropdown">
                                    <button class="btn d-flex justify-content-between align-items-center bg-white border w-100 border-black rounded rounded-3 dropdown-toggle @error('pilih_kurir') is-invalid @enderror" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="pilih_kurir" data-name="pilih_kurir">
                                        Pilih Kurir
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" data-value="JNE">JNE</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="JNT">JNT</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="Si Cepat">Si Cepat</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="Gojek">Gojek</a></li>
                                        <li><a class="dropdown-item" href="#" data-value="Grab">Grab</a></li>
                                    </ul>
                                </div>                      
                            </div>
                            <div class="col-lg-6 my-2">
                                <label for="isi-paket" class="col-form-label">Isi Paket</label>
                                <input type="number" name="isi-paket" id="isiPaket" class="form-control shadow">                    
                            </div>
                        </div>                        
                        <div class="mb-3 col-lg-12">
                            <label for="no-resi" class="col-form-label">No resi</label>
                            <input type="text" class="form-control shadow">
                        </div>
                        <div class="d-flex gap-1 justify-content-between">
                            <div class="mb-3 col-lg-5">
                                <label for="tgl-kirim" class="col-form-label">Tanggal Kirim</label>
                                <input type="date" class="form-control shadow">
                            </div>
                            <div class="mb-3 col-lg-5">
                                <label for="ongkir" class="col-form-label">Ongkir</label>
                                <input type="text" class="form-control shadow">
                            </div>       
                        </div>                     
                </div>
                <div class="modal-footer justify-content-start gap-2">
                    <button type="submit" class="btn btn-primary modal_btn_width" data-bs-toggle="modal" data-bs-target="confirmPerubahanStatusOrderModal">Simpan</button>
                    <button type="button" class="btn btn-secondary modal_btn_width" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Akhir Modal Cek Resi --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
      const tambahDropdownMenu = document.querySelectorAll('#pilih_kurir + .dropdown-menu a');
      tambahDropdownMenu.forEach(item => {
          item.addEventListener('click', function () {
              const selectedValue = this.getAttribute('data-value');
              document.getElementById('pilih_kurir').innerText = selectedValue;
              document.getElementById('pilih_kurir').value = selectedValue;
          });
      });
    })
  </script>