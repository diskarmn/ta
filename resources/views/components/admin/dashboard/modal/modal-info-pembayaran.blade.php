{{-- Modal Info Pembayaran --}}
<div class="modal fade" id="infoPembayaranModal" tabindex="-1" aria-labelledby="infoPembayaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="{{ route('update.on.process', ['orderId' => $order->id]) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="infoPembayaranModalLabel">Info Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="bg-warning text-secondary rounded-1 text-center fs-6 fw-medium font-family-Montserrat m-0 px-3 py-2">Detail Pembayaran tidak bisa diganti atau dirubah</p>
                        <div class="d-flex gap-4 align-items-center justify-content-between border border-1 my-2 px-3 rounded-1 border-secondary shadow">
                            <div class="col-lg-2 d-flex align-items-center">
                                <p class="fw-bold gap-1 d-flex align-items-center my-1">
                                    <span>
                                        <svg width="35" height="31" viewBox="0 0 35 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Icon">
                                            <path id="Vector" d="M29.4231 8.23779H5.57692C3.60144 8.23779 2 9.83989 2 11.8162V26.1298C2 28.1061 3.60144 29.7082 5.57692 29.7082H29.4231C31.3986 29.7082 33 28.1061 33 26.1298V11.8162C33 9.83989 31.3986 8.23779 29.4231 8.23779Z" stroke="#0091FF" stroke-width="2.58333" stroke-linejoin="round"/>
                                            <path id="Vector_2" d="M29.0773 8.47931V5.78352C29.0771 5.12234 28.9559 4.46936 28.7224 3.87116C28.4888 3.27296 28.1487 2.74429 27.7262 2.32287C27.3037 1.90146 26.8092 1.59768 26.2782 1.43321C25.7471 1.26875 25.1925 1.24765 24.6538 1.37142L5.02846 5.4106C4.1762 5.60645 3.40734 6.1548 2.85447 6.96108C2.30161 7.76735 1.99941 8.781 2 9.8272V14.2303" stroke="#0091FF" stroke-width="2.58333" stroke-linejoin="round"/>
                                            <path id="Vector_3" d="M25.8456 24.295C25.3739 24.295 24.9129 24.1263 24.5207 23.8103C24.1286 23.4944 23.8229 23.0453 23.6425 22.5199C23.462 21.9944 23.4147 21.4163 23.5068 20.8585C23.5988 20.3007 23.8259 19.7883 24.1594 19.3862C24.4929 18.984 24.9178 18.7102 25.3803 18.5992C25.8429 18.4882 26.3224 18.5452 26.7581 18.7628C27.1938 18.9805 27.5663 19.349 27.8283 19.8219C28.0903 20.2948 28.2302 20.8507 28.2302 21.4195C28.2302 22.1821 27.9789 22.9135 27.5317 23.4527C27.0845 23.992 26.478 24.295 25.8456 24.295Z" fill="#0091FF"/>
                                            </g>
                                        </svg>
                                    </span>
                                    BRI
                                </p>
                            </div>
                            <div class="col-lg-3 my-2">
                                <p class="text-black fs-6 fw-medium font-family-Poppins  m-0">Rp 300.000,00</p>
                            </div>
                            <div class="col-lg-3 my-2 mx-3">
                                <p class="text-black fs-6 fw-medium font-family-Poppins  m-0">(23/09/2023)</p>
                            </div>
                            <div class="col-lg-3 my-2">
                                <div class="btn-group dropend">
                                    <button type="button" class="btn border border-black dropdown rounded-2" data-bs-toggle="dropdown" aria-expanded="false" id="statusDropdown">
                                        <span>
                                            <svg width="11" height="3" viewBox="0 0 11 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path id="Vector 1489" d="M1.5 1.5H9.5" stroke="black" stroke-width="2" stroke-linecap="round"/>
                                            </svg>                                        
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="#">Ada</a></li>
                                      <li><a class="dropdown-item" href="#">Tidak Ada</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <p class="fw-bold text_success">Status: Dana Ada </p>
                            <input type="text" class="form-control" placeholder="Inputan link gambar bukti pembayaran disini!">                       
                        </div>
                </div>
                <div class="modal-footer justify-content-start gap-2">
                    <button type="submit" class="btn btn-primary modal_btn_width">Simpan</button>
                    <button type="button" class="btn btn-secondary modal_btn_width" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Akhir Modal Info Pembayaran --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusDropdown = document.getElementById('statusDropdown');
        const statusInput = document.querySelector('.modal-body input.form-control');

        statusDropdown.addEventListener('click', function () {
            const selectedValue = this.nextElementSibling.querySelector('.show').textContent.trim();

            if (selectedValue === 'Ada') {
                statusInput.placeholder = 'Inputan link gambar bukti pembayaran disini!';
            } else {
                statusInput.placeholder = 'Status Dana Tidak Ada';
            }
        });
    });
</script>
