@php
    $pelanggan = App\Models\Customer::all();
@endphp
{{-- Modal Search Dashboard Admin --}}
<div class="modal fade" id="inputSearchModal" tabindex="-1" aria-labelledby="inputSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Menambahkan class modal-lg -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="searchForm" method="GET" action="{{ route('dashboard.search') }}">
                    <div class="d-flex">
                        <div class="mb-3 me-3">
                            <label for="opsi-pembayaran" class="col-form-label">Opsi Pembayaran 1</label>
                            <select class="form-select custom-input" name="payment_method"
                                aria-label="Default select example" id="opsi-pembayaran" style="width: 200px">
                                <option selected value="">Pilih Pembayaran</option>
                                <option value="BRI">BRI</option>
                                <option value="BCA">BCA</option>
                                <option value="BNI">BNI</option>
                                <option value="Mandiri">Mandiri</option>
                                <option value="BSI">BSI</option>
                                <option value="COD">COD</option>
                            </select>
                        </div>

                        <div class="mb-3 me-3 ms-3">
                            <label for="opsi-orderan" class="col-form-label">Opsi Orderan</label>
                            <select class="form-select custom-input" name="status" aria-label="Default select example"
                                id="opsi-orderan" style="width: 200px">
                                <option selected value="">Pilih opsi order</option>
                                <option value="dalam_proses">Sedang Diproses</option>
                                <option value="belum_proses">Belum Diproses</option>
                                <option value="cek_pembayaran">Cek Pembayaran</option>
                                <option value="orderan_selesai">Orderan Selesai</option>
                            </select>
                        </div>

                        <div class="mb-3 me-3 ms-3">
                            <label for="opsi-pengiriman" class="col-form-label">Opsi Pengiriman</label>
                            <select class="form-select custom-input" name="opsi_pengiriman"
                                aria-label="Default select example" id="opsi-pengiriman" style="width: 25  0px">
                                <option selected value="">Pilih opsi pengiriman</option>
                                <option value="dalam_proses">Belum Dikirim</option>
                                <option value="orderan_selesai">Sudah Dikirim</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="mb-3 me-3">
                            <label for="opsi-pencarian" class="col-form-label">Opsi Pencarian</label>
                            <select class="form-select custom-input" name="customer_name"
                                aria-label="Default select example" id="opsi-pencarian" style="width: 200px">
                                <option selected value="">Nama Pelanggan</option>
                                @foreach ($pelanggan as $customer)
                                    <option value="{{ $customer->name }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 me-3 mt-4 ms-3">
                            <label for="tanggal-pencarian" class="col-form-label"></label>
                            <input type="date" class="form-control custom-input" name="order_date"
                                id="tanggal-pencarian">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-start">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#filter-select').change(function() {
            $(this).closest('form').submit();
        });
    });
</script>