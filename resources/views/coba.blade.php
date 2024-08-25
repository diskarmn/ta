<form method="POST" id="formongkir" action="{{ route('resia', ['orderNumber' => $resi->order_number]) }}">
    @csrf
    <div class="modal-body">
        <div class="d-flex flex-row">
            <div class="mb-3 col-12">
                <label for="resi" class="col-form-label">No Resi</label>
                <input type="text" class="form-control custom-input" name="resi" value="">
            </div>
        </div>
        <div class="d-flex flex-row justify-content-between">
            <div class="mb-3 col-5">
                <label for="tanggal_kirim" class="col-form-label">Tanggal Kirim</label>
                <input type="date" class="form-control custom-input"  name="tanggal_kirim"
                    value="">
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-start">
        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    </div>
</form>
