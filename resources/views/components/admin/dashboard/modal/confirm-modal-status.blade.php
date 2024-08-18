{{-- Confirm Modal Proses Orderan --}}
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
{{-- Akhir Confirm Modal Proses Orderan --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
      const simpanButton = document.querySelector('#confirmPerubahanStatusOrderModal .btn-primary');
      simpanButton.addEventListener('click', handleSimpanClick);
  
      function handleSimpanClick() {
        // Tutup modal-proses-orderan
        const modalProsesOrderan = bootstrap.Modal.getInstance(document.getElementById('prosesOrderanModal'));
        modalProsesOrderan.hide();
  
        // Tutup confirmPerubahanStatusOrderModal
        const confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmPerubahanStatusOrderModal'));
        confirmModal.hide();
  
        // Tampilkan console.log
        console.log('Data disimpan!');
  
        // Tampilkan alert bootstrap success
        const alertPlaceholder = document.getElementById('liveAlertPlaceholder');
        const alert = document.createElement('div');
        alert.classList.add('alert');
        alert.classList.add('alert-success');
        alert.setAttribute('role', 'alert');
        alert.textContent = 'Data disimpan!';
        alertPlaceholder.append(alert);
  
        // Hapus alert setelah 3 detik
        setTimeout(() => {
          alert.remove();
        }, 3000);
      }
    });
  </script>
