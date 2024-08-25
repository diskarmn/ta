
@php
$status = DB::table('update_proses')
    ->where('order_number', $data->order_number)
    ->get();

@endphp

<div class="col-md-6 d-flex justify-content-end p-md-0 justify-content-end d-flex ">
<div class=" rounded-3 pt-2 d-flex align-items-center">
    <div class=" d-flex flex-column align-items-center gap-1 ">


        <span class="d-flex align-items-center gap_custom">
            <svg width="36" height="35" viewBox="0 0 48 48" data-bs-toggle="tooltip"
            data-bs-placement="bottom" data-bs-title="pesanan Ditambahkan"
            data-bs-custom-class="custom-tooltip" fill="none" xmlns="http://www.w3.org/2000/svg">

                <g id="Icon=Plus, State=Green">
                    <path id="Vector"
                        d="M31.7143 25.2857H25.2857V31.7143C25.2857 32.0553 25.1503 32.3823 24.9091 32.6234C24.668 32.8645 24.341 33 24 33C23.659 33 23.332 32.8645 23.0909 32.6234C22.8497 32.3823 22.7143 32.0553 22.7143 31.7143V25.2857H16.2857C15.9447 25.2857 15.6177 25.1503 15.3766 24.9091C15.1355 24.668 15 24.341 15 24C15 23.659 15.1355 23.332 15.3766 23.0909C15.6177 22.8497 15.9447 22.7143 16.2857 22.7143H22.7143V16.2857C22.7143 15.9447 22.8497 15.6177 23.0909 15.3766C23.332 15.1355 23.659 15 24 15C24.341 15 24.668 15.1355 24.9091 15.3766C25.1503 15.6177 25.2857 15.9447 25.2857 16.2857V22.7143H31.7143C32.0553 22.7143 32.3823 22.8497 32.6234 23.0909C32.8645 23.332 33 23.659 33 24C33 24.341 32.8645 24.668 32.6234 24.9091C32.3823 25.1503 32.0553 25.2857 31.7143 25.2857Z"
                        fill="#24A240" />
                    <circle id="Ellipse 1851" cx="24" cy="24" r="22" stroke="#24A240"
                        stroke-width="4" />

                </g>
            </svg>
            @if ($status->contains('nama_proses','pembayaran'))
                @php
                    $order = DB::table('orders')
                        ->where('order_number', $data->order_number)
                        ->first();

                        $fillColor = '#828282';
                        $titleText = '';

                        if ($order->paid_amount == 0) {
                            $fillColor = '#828282';
                            $titleText = 'Belum Bayar';
                        } elseif ($order->paid_amount > 0 && $order->paid_amount < $order->total_amount) {
                            $fillColor = '#ffd43b';
                            $titleText = 'Belum Lunas';
                        } elseif ($order->paid_amount == $order->total_amount || $order->paid_amount > $order->total_amount) {
                            $fillColor = '#24A240';
                            $titleText = 'Sudah Lunas';
                        }
                @endphp
                <svg width="36" height="35" viewBox="0 0 32 31" data-bs-toggle="tooltip"
                    data-bs-placement="bottom" data-bs-title="{{ $titleText }}"
                    data-bs-custom-class="custom-tooltip" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="Icon">
                        <path id="Vector"
                            d="M27.3646 8.77246H4.64266C2.76032 8.77246 1.23438 10.299 1.23438 12.1821V25.8209C1.23438 27.704 2.76032 29.2306 4.64266 29.2306H27.3646C29.2469 29.2306 30.7728 27.704 30.7728 25.8209V12.1821C30.7728 10.299 29.2469 8.77246 27.3646 8.77246Z"
                            stroke="{{ $fillColor }}"
                            stroke-width="2.46154" stroke-linejoin="round" />
                        <path id="Vector_2"
                            d="M27.0351 9.00276V6.43407C27.0349 5.80406 26.9194 5.18186 26.6969 4.61186C26.4744 4.04187 26.1502 3.53813 25.7476 3.13658C25.3451 2.73503 24.8739 2.44557 24.3679 2.28886C23.8619 2.13215 23.3334 2.11204 22.8202 2.22998L4.12006 6.07873C3.30798 6.26535 2.57536 6.78784 2.04856 7.5561C1.52177 8.32437 1.23382 9.29023 1.23438 10.2871V14.4826"
                            stroke="{{ $fillColor }}"
                            stroke-width="2.46154" stroke-linejoin="round" />
                        <path id="Vector_3"
                            d="M23.9597 24.0726C23.5103 24.0726 23.071 23.9119 22.6973 23.6109C22.3237 23.3098 22.0324 22.8819 21.8605 22.3812C21.6885 21.8806 21.6435 21.3297 21.7312 20.7982C21.8188 20.2667 22.0352 19.7785 22.353 19.3953C22.6708 19.0121 23.0756 18.7511 23.5164 18.6454C23.9572 18.5397 24.414 18.594 24.8292 18.8013C25.2444 19.0087 25.5993 19.3599 25.8489 19.8105C26.0986 20.2611 26.2319 20.7908 26.2319 21.3327C26.2319 22.0594 25.9925 22.7563 25.5664 23.2701C25.1403 23.784 24.5623 24.0726 23.9597 24.0726Z"
                            fill="{{ $fillColor }}" />
                    </g>
                </svg>
            @else
            @endif


            @if ($status->contains('nama_proses', 'packing'))
                @php
                    $status9 = DB::table('update_proses')
                        ->where('order_number', $data->order_number)
                        ->where('nama_proses', 'packing')
                        ->get();

                    $warna = $status9->where('kelengkapan', 'selesai')->isNotEmpty() ? '#24A240' : '#828282';
                    $text = $status9->where('kelengkapan', 'selesai')->isNotEmpty() ? 'Sudah Dipacking' : 'Belum Dipacking';
                @endphp
                <svg width="36" height="35" viewBox="0 0 30 33" fill="none"
                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ $text }}"
                    data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                    <g id="Logo Packing">
                        <path id="Vector"
                            d="M9.03771 2.9781L2.28571 10.6947V30.4067H29.7143V10.6947L22.9623 2.9781H9.03771ZM8.51886 0.692383H23.4811C23.6438 0.692264 23.8046 0.726865 23.9528 0.793875C24.101 0.860884 24.2332 0.958758 24.3406 1.08095L31.7166 9.51296C31.899 9.72104 31.9997 9.98824 32 10.265V31.5495C32 31.8526 31.8796 32.1433 31.6653 32.3577C31.4509 32.572 31.1602 32.6924 30.8571 32.6924H1.14286C0.839753 32.6924 0.549063 32.572 0.334735 32.3577C0.120408 32.1433 4.00252e-07 31.8526 4.00252e-07 31.5495V10.265C-0.000231727 9.98745 0.100511 9.71935 0.283429 9.51067L7.65714 1.08553C7.76433 0.962206 7.89671 0.863302 8.04536 0.795483C8.19401 0.727664 8.35547 0.692507 8.51886 0.692383Z"
                            fill="{{ $warna }}" />
                        <path id="Vector_2" d="M0 9.83496H32V12.1207H0V9.83496Z"
                            fill="{{ $warna }}" />
                        <path id="Vector_3"
                            d="M13.7154 10.1164V21.2638H18.2868V10.1164L16.504 2.9781H15.4983L13.7154 10.1164ZM13.7154 0.692383H18.2868L20.5725 9.83524V22.4067C20.5725 22.7098 20.4521 23.0005 20.2378 23.2148C20.0235 23.4291 19.7328 23.5495 19.4297 23.5495H12.5725C12.2694 23.5495 11.9788 23.4291 11.7644 23.2148C11.5501 23.0005 11.4297 22.7098 11.4297 22.4067V9.83524L13.7154 0.692383Z"
                            fill="{{ $warna }}" />
                    </g>
                </svg>
            @else
            @endif
            @if ($status->contains('nama_proses', 'diantar'))
                <svg width="36" height="35" viewBox="0 0 42 33" fill="none"
                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Diantar"
                    data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                    <g id="Logo Diantar">
                        <rect id="Box" x="7.4375" y="1.69238" width="19.7476" height="25"
                            stroke="#24A240" stroke-width="2" />
                        <path id="Head"
                            d="M35.1755 11.6924H27.7969V19.1924M35.1755 11.6924L41.0008 19.1924M35.1755 11.6924V19.1924M41.0008 19.1924V27.1924H27.7969V19.1924M41.0008 19.1924H35.1755M27.7969 19.1924H35.1755"
                            stroke="#24A240" stroke-width="2" />
                        <path id="Ellipse 1973"
                            d="M34.9493 29.6924C34.9493 31.0468 34.1333 31.6924 33.6192 31.6924C33.105 31.6924 32.2891 31.0468 32.2891 29.6924C32.2891 28.338 33.105 27.6924 33.6192 27.6924C34.1333 27.6924 34.9493 28.338 34.9493 29.6924Z"
                            stroke="#24A240" stroke-width="2" />
                        <path id="Ellipse 1974"
                            d="M12.4258 29.6924C12.4258 31.0468 11.6099 31.6924 11.0957 31.6924C10.5816 31.6924 9.76562 31.0468 9.76562 29.6924C9.76562 28.338 10.5816 27.6924 11.0957 27.6924C11.6099 27.6924 12.4258 28.338 12.4258 29.6924Z"
                            stroke="#24A240" stroke-width="2" />
                        <path id="Vector 1483"
                            d="M1 8.69238C0.447715 8.69238 0 9.1401 0 9.69238C0 10.2447 0.447715 10.6924 1 10.6924V8.69238ZM1 10.6924H23.5243V8.69238H1V10.6924Z"
                            fill="#24A240" />
                        <path id="Vector 1484"
                            d="M4.88281 12.6924C4.33053 12.6924 3.88281 13.1401 3.88281 13.6924C3.88281 14.2447 4.33053 14.6924 4.88281 14.6924V12.6924ZM4.88281 14.6924H23.5236V12.6924H4.88281V14.6924Z"
                            fill="#24A240" />
                        <path id="Vector 1485"
                            d="M1 17.6924C0.447715 17.6924 2.89661e-0 justify-content-center d-flex 8 18.1401 0 18.6924C-2.89661e-0 justify-content-center d-flex 8 19.2447 0.447715 19.6924 1 19.6924L1 17.6924ZM1 19.6924L23.5243 19.6924L23.5243 17.6924L1 17.6924L1 19.6924Z"
                            fill="#24A240" />
                    </g>
                </svg>
            @else
            @endif
        </span>





        <span class="d-flex align-items-center">
            <span class="d-flex align-items-center line_bayar">
                @if ($status->contains('nama_proses','pembayaran') || $status->contains('nama_proses', 'packing'))
                    <svg width="52" height="9" viewBox="0 0 29 9" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" data-bs-title="Pesanan Ditambahkan"
                        data-bs-custom-class="custom-tooltip" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="Line">
                            <circle id="Ellipse 1852" cx="4.99519" cy="4.69051" r="4.30769"
                                fill="#24A240" />

                            <line id="Line 31" x1="1.3125" y1="4.69111" x2="29.0048"
                                y2="4.69111" stroke="#24A240" stroke-width="2.46154" />

                        </g>
                    </svg>
                @else
                    <svg width="52" height="9" viewBox="0 0 23 9" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" data-bs-title="Pesanan Ditambahkan"
                        data-bs-custom-class="custom-tooltip" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="Line">
                            <circle id="Ellipse 1852" cx="4.99519" cy="4.69051" r="4.30769"
                                fill="#24A240" />



                        </g>
                    </svg>
                @endif
            </span>
            @if ($status->contains('nama_proses','pembayaran'))
                @php
                    $order = DB::table('orders')
                        ->where('order_number', $data->order_number)
                        ->first();

                        $fillColor = '#828282';
                        $titleText = '';

                        if ($order->paid_amount == 0) {
                            $fillColor = '#828282';
                            $titleText = 'Belum Bayar';
                        } elseif ($order->paid_amount > 0 && $order->paid_amount < $order->total_amount) {
                            $fillColor = '#ffd43b';
                            $titleText = 'Belum Lunas';
                        } elseif ($order->paid_amount == $order->total_amount || $order->paid_amount > $order->total_amount) {
                            $fillColor = '#24A240';
                            $titleText = 'Sudah Lunas';
                        }
                @endphp
                <svg width="48" height="9" viewBox="0 0 48 9" fill="none"
                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ $titleText }}"
                    data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                    <g id="Line">
                        <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                            fill="{{ $fillColor }}" />
                        @if ($status->contains('nama_proses', 'packing'))
                            <line id="Line 31" x1="20.3125" y1="4.69111" x2="48.0048"
                                y2="4.69111"
                                stroke="{{ $fillColor }}"
                                stroke-width="2.46154" />
                        @else
                        @endif
                        <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                            stroke="{{ $fillColor }}"
                            stroke-width="2.46154" />
                    </g>
                </svg>
            @else
            @endif

            @if ($status->contains('nama_proses', 'packing'))
                @php
                    $status9 = DB::table('update_proses')
                        ->where('order_number', $data->order_number)
                        ->where('nama_proses', 'packing')
                        ->get();

                    $warna = $status9->where('kelengkapan', 'selesai')->isNotEmpty() ? '#24A240' : '#828282';
                    $text = $status9->where('kelengkapan', 'selesai')->isNotEmpty() ? 'Sudah Dipacking' : 'Belum Dipacking';
                @endphp
                <svg width="48" height="9" viewBox="0 0 48 9" fill="none"
                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ $text }}"
                    data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                    <g id="Line">
                        <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                            fill="{{ $warna }}" />
                        @if ($status->contains('nama_proses', 'diantar'))
                            <line id="Line 31" x1="20.3125" y1="4.69111" x2="48.0048"
                                y2="4.69111" stroke="{{ $warna }}"
                                stroke-width="2.46154" />
                        @else
                        @endif
                        <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                            stroke="{{ $warna }}" stroke-width="2.46154" />
                    </g>
                </svg>
            @else
            @endif
            @if ($status->contains('nama_proses', 'diantar'))
                <span class="d-flex align-items-center line_right">
                    <svg width="29" height="9" viewBox="0 0 29 9" fill="none"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Diantar"
                        data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                        <g id="Line">
                            <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                                fill="#24A240" />
                            <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                                stroke="#24A240" stroke-width="2.46154" />
                        </g>
                    </svg>
                </span>
            @else
            @endif

        </span>

    </div>
</div>
</div>
