
        <div class="modal-content">
            <div class="modal-header border-bottom-0 m-3 py-0 ">
                <h5 class="modal-title ms-auto">Edit Data Barang</h5>

            </div>
            <div class="modal-body m-3 mt-0 pt-0 pb-3">
                <form id="updateForm" action="{{ route('barangs.update', $data_brg->id) }}" method="POST">
                    @method('PATCH') <!-- Tambahkan ini untuk menandai metode update -->
                    @csrf
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-4">
                        <label for="kd-produk" class="form-label label-order mb-1">Kode Produk</label>
                        <input type="text"
                            class="form-control form-control-lg  shadow @error('kd_produk') is-invalid @enderror"
                            id="edit-kd-produk" name="kd_produk" placeholder="Kode Produk"
                            value="{{ $data_brg->kd_produk}}" readonly>
                        @error('kd_produk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="nama-produk" class="form-label label-order mb-1">Nama Produk</label>
                        <input type="text"
                            class="form-control form-control-lg  shadow @error('nama') is-invalid @enderror"
                            id="edit-nama-produk" name="nama" placeholder="Nama Produk"
                            value="{{ $data_brg->nama }}" autofocus>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex row gap-4 justify-content-between mb-4">
                        <div class=" col-lg-3 col-md-12 ">
                            <label for="ukuran" class="form-label label-order mb-1">Ukuran</label>
                            <select class="form-select form-select-lg  shadow" id="ukuran" value=' {{ $data_brg->ukuran }}' name="size">
                                <option selected>Pilih Ukuran</option>
                                <option value="1" class="fw-bold ">Atasan</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>

                            </select>
                        </div>
                        <div class=" col-lg-3 col-md-12 ">
                            <label for="harga" class="form-label label-order mb-1">Harga</label>
                            <input type="number"
                                class="form-control form-control-lg  shadow @error('harga_satuan') is-invalid @enderror"
                                id="edit-harga" name="harga_satuan" value="{{ $data_brg->harga }}">
                            @error('harga_satuan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class=" col-lg-3 col-md-12 ">
                            <label for="stok" class="form-label label-order mb-1">Stok</label>
                            <input type="number"
                                class="form-control form-control-lg  shadow @error('stock') is-invalid @enderror"
                                id="edit-stok" name="stock" value="{{ $data_brg->stock }}">
                            @error('stock')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="gambar" class="form-label label-order mb-1">Gambar</label>
                        <input type="text" class="form-control form-control-lg  shadow" id="edit-gambar"
                            placeholder="Link Google Drive" name="img" value="{{ $data_brg->img }}">
                    </div>
                    <div class="mb-4">
                        <label for="video" class="form-label label-order mb-1">Video</label>
                        <input type="text" class="form-control form-control-lg  shadow" id="edit-video"
                            placeholder="Link Google Drive" name="video" value="{{ $data_brg->video }}">
                    </div>
                    <div class="mb-5 col-lg-3">
                        <label for="point_produk" class="form-label label-order mb-1">Point Produk</label>
                        <input type="number"
                            class="form-control form-control-lg  shadow @error('point') is-invalid @enderror"
                            id="edit-point_produk" name="point" value="{{ $data_brg->point }}">
                        @error('point')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex gap-4 justify-content-md-between ">
                        <button type="button" class="btn btn-grey py-2  px-5" data-bs-dismiss="modal" onclick="backTo()">Batal</button>
                        <button type="button" class="btn btn-blue px-5 py-2" onclick="editBarang()">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

