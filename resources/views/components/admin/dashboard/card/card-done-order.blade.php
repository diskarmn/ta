{{-- CARD ORDERAN SELESAI DASHBOARD ADMIN --}}

{{-- @if (isset($orders))
    @foreach ($orders as $order)
        <article class="pt-4 d-flex justify-content-center align-items-center">
            <div class="mx-5 my-4 px-4 rounded-4 shadow border border-1 border-black bg-white w-100">
                <div class="d-flex align-items-center justify-content-between py-2 header_dashboard row">
                    <div class="id_produk w-fit px-5 py-3 rounded-1 col-lg-2 flex text-center">
                        <p class="fs-6 fw-bold m-0">
                            #{{ $order['order_number'] }}
                        </p>
                    </div>
                    <div class="rounded-3 d-flex date_produk flex-column col-lg-4 col-md-6 p-md-0">
                        <p class="fs-6 m-0 px-lg-3">{{ $order['order_date'] }}</p>
                        <p class="fs-6 m-0 px-lg-3">{{ $order['juragan'] }}</p>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end p-md-0" style="overflow: hidden;">
                        <div class="rounded-3 d-flex align-items-center pt-2">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <span class="d-flex align-items-center gap_custom">
                                    <svg width="36" height="35" viewBox="0 0 48 48" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Icon=Plus, State=Green">
                                            <path id="Vector"
                                                d="M31.7143 25.2857H25.2857V31.7143C25.2857 32.0553 25.1503 32.3823 24.9091 32.6234C24.668 32.8645 24.341 33 24 33C23.659 33 23.332 32.8645 23.0909 32.6234C22.8497 32.3823 22.7143 32.0553 22.7143 31.7143V25.2857H16.2857C15.9447 25.2857 15.6177 25.1503 15.3766 24.9091C15.1355 24.668 15 24.341 15 24C15 23.659 15.1355 23.332 15.3766 23.0909C15.6177 22.8497 15.9447 22.7143 16.2857 22.7143H22.7143V16.2857C22.7143 15.9447 22.8497 15.6177 23.0909 15.3766C23.332 15.1355 23.659 15 24 15C24.341 15 24.668 15.1355 24.9091 15.3766C25.1503 15.6177 25.2857 15.9447 25.2857 16.2857V22.7143H31.7143C32.0553 22.7143 32.3823 22.8497 32.6234 23.0909C32.8645 23.332 33 23.659 33 24C33 24.341 32.8645 24.668 32.6234 24.9091C32.3823 25.1503 32.0553 25.2857 31.7143 25.2857Z"
                                                fill="#24A240" />
                                            <circle id="Ellipse 1851" cx="24" cy="24" r="22"
                                                stroke="#24A240" stroke-width="4" />
                                        </g>
                                    </svg>
                                    <svg width="36" height="35" viewBox="0 0 32 31" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Icon">
                                            <path id="Vector"
                                                d="M27.3646 8.77246H4.64266C2.76032 8.77246 1.23438 10.299 1.23438 12.1821V25.8209C1.23438 27.704 2.76032 29.2306 4.64266 29.2306H27.3646C29.2469 29.2306 30.7728 27.704 30.7728 25.8209V12.1821C30.7728 10.299 29.2469 8.77246 27.3646 8.77246Z"
                                                stroke="#24A240" stroke-width="2.46154" stroke-linejoin="round" />
                                            <path id="Vector_2"
                                                d="M27.0351 9.00276V6.43407C27.0349 5.80406 26.9194 5.18186 26.6969 4.61186C26.4744 4.04187 26.1502 3.53813 25.7476 3.13658C25.3451 2.73503 24.8739 2.44557 24.3679 2.28886C23.8619 2.13215 23.3334 2.11204 22.8202 2.22998L4.12006 6.07873C3.30798 6.26535 2.57536 6.78784 2.04856 7.5561C1.52177 8.32437 1.23382 9.29023 1.23438 10.2871V14.4826"
                                                stroke="#24A240" stroke-width="2.46154" stroke-linejoin="round" />
                                            <path id="Vector_3"
                                                d="M23.9597 24.0726C23.5103 24.0726 23.071 23.9119 22.6973 23.6109C22.3237 23.3098 22.0324 22.8819 21.8605 22.3812C21.6885 21.8806 21.6435 21.3297 21.7312 20.7982C21.8188 20.2667 22.0352 19.7785 22.353 19.3953C22.6708 19.0121 23.0756 18.7511 23.5164 18.6454C23.9572 18.5397 24.414 18.594 24.8292 18.8013C25.2444 19.0087 25.5993 19.3599 25.8489 19.8105C26.0986 20.2611 26.2319 20.7908 26.2319 21.3327C26.2319 22.0594 25.9925 22.7563 25.5664 23.2701C25.1403 23.784 24.5623 24.0726 23.9597 24.0726Z"
                                                fill="#24A240" />
                                        </g>
                                    </svg>
                                    <svg width="36" height="35" viewBox="0 0 22 31" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Icon">
                                            <path id="Vector"
                                                d="M13.6959 0.922852H2.92668C2.21264 0.922852 1.52784 1.23406 1.02293 1.78801C0.518028 2.34197 0.234375 3.09329 0.234375 3.8767V27.5075C0.234375 28.2909 0.518028 29.0422 1.02293 29.5962C1.52784 30.1501 2.21264 30.4613 2.92668 30.4613H19.0805C19.7946 30.4613 20.4794 30.1501 20.9843 29.5962C21.4892 29.0422 21.7728 28.2909 21.7728 27.5075V9.78439L13.6959 0.922852ZM19.0805 27.5075H2.92668V3.8767H12.3498V11.2613H19.0805V27.5075Z"
                                                fill="#24A240" />
                                            <path id="Vector 1480" d="M5.77344 15.0771H15.9273" stroke="#24A240"
                                                stroke-width="1.23077" stroke-linecap="round" />
                                            <path id="Vector 1481" d="M5.77344 18.1533H15.9273" stroke="#24A240"
                                                stroke-width="1.23077" stroke-linecap="round" />
                                            <path id="Vector 1482" d="M5.77344 21.2305H15.9273" stroke="#24A240"
                                                stroke-width="1.23077" stroke-linecap="round" />
                                        </g>
                                    </svg>
                                    <svg width="36" height="35" viewBox="0 0 36 35" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Icon">
                                            <rect id="Rectangle 2973" x="2.0846" width="18.6116" height="18.6116"
                                                rx="4.92308"
                                                transform="matrix(0.846868 -0.531803 0.846868 0.531803 0.475469 24.8254)"
                                                fill="white" stroke="#24A240" stroke-width="2.46154" />
                                            <rect id="Rectangle 2974" x="2.0846" width="18.6116" height="18.6116"
                                                rx="4.92308"
                                                transform="matrix(0.846868 -0.531803 0.846868 0.531803 0.475469 18.801)"
                                                fill="white" stroke="#24A240" stroke-width="2.46154" />
                                            <rect id="Rectangle 2975" x="2.0846" width="18.6116" height="18.6116"
                                                rx="4.92308"
                                                transform="matrix(0.846868 -0.531803 0.846868 0.531803 0.475469 12.7775)"
                                                fill="white" stroke="#24A240" stroke-width="2.46154" />
                                        </g>
                                    </svg>
                                    <svg width="36" height="35" viewBox="0 0 32 33" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Logo Packing">
                                            <path id="Vector"
                                                d="M9.03771 2.9781L2.28571 10.6947V30.4067H29.7143V10.6947L22.9623 2.9781H9.03771ZM8.51886 0.692383H23.4811C23.6438 0.692264 23.8046 0.726865 23.9528 0.793875C24.101 0.860884 24.2332 0.958758 24.3406 1.08095L31.7166 9.51296C31.899 9.72104 31.9997 9.98824 32 10.265V31.5495C32 31.8526 31.8796 32.1433 31.6653 32.3577C31.4509 32.572 31.1602 32.6924 30.8571 32.6924H1.14286C0.839753 32.6924 0.549063 32.572 0.334735 32.3577C0.120408 32.1433 4.00252e-07 31.8526 4.00252e-07 31.5495V10.265C-0.000231727 9.98745 0.100511 9.71935 0.283429 9.51067L7.65714 1.08553C7.76433 0.962206 7.89671 0.863302 8.04536 0.795483C8.19401 0.727664 8.35547 0.692507 8.51886 0.692383Z"
                                                fill="#24A240" />
                                            <path id="Vector_2" d="M0 9.83496H32V12.1207H0V9.83496Z"
                                                fill="#24A240" />
                                            <path id="Vector_3"
                                                d="M13.7154 10.1164V21.2638H18.2868V10.1164L16.504 2.9781H15.4983L13.7154 10.1164ZM13.7154 0.692383H18.2868L20.5725 9.83524V22.4067C20.5725 22.7098 20.4521 23.0005 20.2378 23.2148C20.0235 23.4291 19.7328 23.5495 19.4297 23.5495H12.5725C12.2694 23.5495 11.9788 23.4291 11.7644 23.2148C11.5501 23.0005 11.4297 22.7098 11.4297 22.4067V9.83524L13.7154 0.692383Z"
                                                fill="#24A240" />
                                        </g>
                                    </svg>
                                    <svg width="36" height="35" viewBox="0 0 42 33" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Logo Diantar">
                                            <rect id="Box" x="7.4375" y="1.69238" width="19.7476"
                                                height="25" stroke="#24A240" stroke-width="2" />
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
                                                d="M1 17.6924C0.447715 17.6924 2.89661e-08 18.1401 0 18.6924C-2.89661e-08 19.2447 0.447715 19.6924 1 19.6924L1 17.6924ZM1 19.6924L23.5243 19.6924L23.5243 17.6924L1 17.6924L1 19.6924Z"
                                                fill="#24A240" />
                                        </g>
                                    </svg>
                                </span>
                                <span class="d-flex align-items-center">
                                    <span class="d-flex align-items-center line_bayar">
                                        <svg width="52" height="9" viewBox="0 0 29 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="Line">
                                                <circle id="Ellipse 1852" cx="4.99519" cy="4.69051" r="4.30769"
                                                    fill="#24A240" />
                                                <line id="Line 31" x1="1.3125" y1="4.69111" x2="29.0048"
                                                    y2="4.69111" stroke="#24A240" stroke-width="2.46154" />
                                            </g>
                                        </svg>
                                    </span>
                                    <svg width="48" height="9" viewBox="0 0 48 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Line">
                                            <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                                                fill="#24A240" />
                                            <line id="Line 31" x1="20.3125" y1="4.69111" x2="48.0048"
                                                y2="4.69111" stroke="#24A240" stroke-width="2.46154" />
                                            <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                                                stroke="#24A240" stroke-width="2.46154" />
                                        </g>
                                    </svg>
                                    <svg width="48" height="9" viewBox="0 0 48 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Line">
                                            <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                                                fill="#24A240" />
                                            <line id="Line 31" x1="20.3125" y1="4.69111" x2="48.0048"
                                                y2="4.69111" stroke="#24A240" stroke-width="2.46154" />
                                            <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                                                stroke="#24A240" stroke-width="2.46154" />
                                        </g>
                                    </svg>
                                    <svg width="48" height="9" viewBox="0 0 48 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Line">
                                            <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                                                fill="#24A240" />
                                            <line id="Line 31" x1="20.3125" y1="4.69111" x2="48.0048"
                                                y2="4.69111" stroke="#24A240" stroke-width="2.46154" />
                                            <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                                                stroke="#24A240" stroke-width="2.46154" />
                                        </g>
                                    </svg>
                                    <svg width="48" height="9" viewBox="0 0 48 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Line">
                                            <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                                                fill="#24A240" />
                                            <line id="Line 31" x1="20.3125" y1="4.69111" x2="48.0048"
                                                y2="4.69111" stroke="#24A240" stroke-width="2.46154" />
                                            <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                                                stroke="#24A240" stroke-width="2.46154" />
                                        </g>
                                    </svg>
                                    <span class="d-flex align-items-center line_right">
                                        <svg width="29" height="9" viewBox="0 0 29 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="Line">
                                                <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                                                    fill="#24A240" />
                                                <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                                                    stroke="#24A240" stroke-width="2.46154" />
                                            </g>
                                        </svg>
                                    </span>
                                </span>
                                <div class="d-flex align-items-center gap_date">
                                    <p class="text-success d-flex justify-content-center date_text m-0 p-0">
                                        @if($order['deadline'])
                                        {{ date('d/n', strtotime($order['deadline'])) }}
                                    @else
                                    @endif

                                    <p class="text-success d-flex justify-content-center date_text m-0 p-0">
                                        @if($order['deadline'])
                                        {{ date('d/n', strtotime($order['deadline'])) }}
                                    @else
                                    @endif
                                    <p class="text-success d-flex justify-content-center date_text m-0 p-0">
                                        @if($order['deadline'])
                                        {{ date('d/n', strtotime($order['deadline'])) }}
                                    @else
                                    @endif
                                    <p class="text-success d-flex justify-content-center date_text m-0 p-0">
                                        @if($order['deadline'])
                                        {{ date('d/n', strtotime($order['deadline'])) }}
                                    @else
                                    @endif
                                    <p class="text-success d-flex justify-content-center date_text m-0 p-0">
                                        @if($order['deadline'])
                                        {{ date('d/n', strtotime($order['deadline'])) }}
                                    @else
                                    @endif
                                    <p class="text-success d-flex justify-content-center date_text m-0 p-0">
                                        @if($order['deadline'])
                                        {{ date('d/n', strtotime($order['deadline'])) }}
                                    @else
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-lg-3 col-md-6 row pt-4">
                        <p class="text-secondary fs-6 fw-semibold m-0 py-0">Pemesan / Kirim Kepada</p>
                        <p class="fs-6 fzt7 fw-semibold col-12 mb-0 color_text m-0 py-0">{{ $order['customer_name'] }}
                        </p>
                        <p class="fs-6  fzt7 fw-semibold col-12 mb-0 color_text">{{ $order['customer_phone'] }}</p>
                        <p class="fs-6 fzt7  fw-semibold col-12 mb-0 color_text">{{ $order['payment_method'] }}</p>
                        <p class="text-secondary fzt7  fs-6 fw-semibold col-12 m-0 py-0">Asal Orderan</p>
                        <p class="fs-6 fw-semibold fzt7  col-12 mb-0 letter_spacing">{{ $order['source'] }}</p>
                        <p class="text-secondary fs-6  fzt7 fw-semibold col-12 m-0 py-0">Dilayani</p>
                        <p class="fs-6 fw-semibold col-12 mb-0 fzt7  letter_spacing">{{ $order['served_by'] }}</p>
                    </div>
                    <div class="col-lg-3 col-md-6 row pt-4">
                        <p class="text-secondary fs-6 fw-semibold fzt7  col-12 p-0">
                            Produk
                            <span class="px-0">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="Ikon Hover Detail Admin">
                                        <path id="Vector" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.28043 0.691406C4.08868 0.691406 0.69043 4.08966 0.69043 8.28141C0.69043 12.4732 4.08868 15.8714 8.28043 15.8714C12.4722 15.8714 15.8704 12.4732 15.8704 8.28141C15.8704 4.08966 12.4722 0.691406 8.28043 0.691406ZM7.93543 4.14141C7.75243 4.14141 7.57693 4.2141 7.44753 4.3435C7.31813 4.4729 7.24543 4.64841 7.24543 4.83141C7.24543 5.01441 7.31813 5.18991 7.44753 5.31931C7.57693 5.44871 7.75243 5.52141 7.93543 5.52141H8.28043C8.46343 5.52141 8.63893 5.44871 8.76833 5.31931C8.89773 5.18991 8.97043 5.01441 8.97043 4.83141C8.97043 4.64841 8.89773 4.4729 8.76833 4.3435C8.63893 4.2141 8.46343 4.14141 8.28043 4.14141H7.93543ZM6.90043 6.90141C6.71743 6.90141 6.54193 6.9741 6.41253 7.1035C6.28313 7.2329 6.21043 7.40841 6.21043 7.59141C6.21043 7.77441 6.28313 7.94991 6.41253 8.07931C6.54193 8.20871 6.71743 8.28141 6.90043 8.28141H7.59043V10.3514H6.90043C6.71743 10.3514 6.54193 10.4241 6.41253 10.5535C6.28313 10.6829 6.21043 10.8584 6.21043 11.0414C6.21043 11.2244 6.28313 11.3999 6.41253 11.5293C6.54193 11.6587 6.71743 11.7314 6.90043 11.7314H9.66043C9.84343 11.7314 10.0189 11.6587 10.1483 11.5293C10.2777 11.3999 10.3504 11.2244 10.3504 11.0414C10.3504 10.8584 10.2777 10.6829 10.1483 10.5535C10.0189 10.4241 9.84343 10.3514 9.66043 10.3514H8.97043V7.59141C8.97043 7.40841 8.89773 7.2329 8.76833 7.1035C8.63893 6.9741 8.46343 6.90141 8.28043 6.90141H6.90043Z"
                                            fill="#202B46" />
                                    </g>
                                </svg>
                            </span>
                        </p>
                        @php $totalQuantity = 0; @endphp
                        @foreach ($order['barangs'] as $item)
                            <div class="d-flex m-0 p-0 kd_produk">
                                <ul class="m-0 p-0 font_small fw-normal col-lg-4 list-unstyled">
                                    <li class="color_text fzt7  m-0 p-0">{{ $item['kd_produk'] }}</li>
                                    <li class="text-secondary fzt7  m-0 p-0">{{ $item['size'] }}</li>
                                </ul>
                                <ul
                                    class="px-5 py-0 m-0 d-flex font_small col-lg-9 fw-normal flex-column justify-content-between list-unstyled">
                                    <li class="color_text fzt7  m-0 p-0">x {{ $item['quantity'] }}</li>
                                    @php $totalQuantity += $item['quantity']; @endphp
                                </ul>
                            </div>
                        @endforeach
                        <div class="d-flex m-0 p-0 pt-3 gap-4 justify-content-between">
                            <ul class="m-0 p-0 fzt7  fs-6 fw-normal col-lg-5 list-unstyled">
                                <li>Total</li>
                            </ul>


                            <ul class="m-0 d-flex fs-6 col-lg-9 fw-normal list-unstyled">
                                <li class="fzt7">= {{ $totalQuantity }} pcs</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 pt-4 h-100" style="overflow: hidden;">
                        <div class="cost_header_success d-flex align-items-center justify-content-center py-md-3">
                            <h2 class="fs-5 fzt7 fw-bold">Wajib Bayar RP
                                {{ number_format($order['total_amount'], 2, ',', '.') }}</h2>
                        </div>
                        <div class="cost_body_success px-4 py-3">
                            <div class="cost_body_produk d-flex justify-content-between">
                                <p class="fzt7">Harga Produk</p><span class="fzt7">RP
                                    {{ number_format($order['total_amount'], 2, ',', '.') }}</span>
                            </div>
                            <hr>
                            <div class="cost_body_produk d-flex justify-content-between">
                                <p class="fzt7">Terbayar</p><span class="fzt7">RP
                                    {{ number_format($order['paid_amount'], 2, ',', '.') }}</span>
                            </div>
                            <div class="cost_body_produk d-flex justify-content-between">
                                <p class="fzt7">Kekurangan</p><span class="fzt7">-RP
                                    {{ number_format($order['remaining_amount'], 2, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 pt-4 ket_order_admin text-start">
                        <p class="text-secondary fs-6 fw-semibold  p-0 m-0">
                            Keterangan
                        </p>
                        <div class="d-flex flex-column align-items-start m-0 p-0">
                            <p class="fs-6 fw-semibold col-12 mb-0 color_text m-0 p-0">PESANAN SELESAI DI PROSES</p>
                            <p class="fs-6 fw-semibold col-12 mb-0 color_text m-0 p-0">SEDANG PROSES PENGIRIMAN</p>
                            <br>
                            <div class="">
                                <p class="text-secondary fs-6 fw-semibold col-12 p-0 m-0">
                                    Resi
                                </p>
                                <p class="fs-6 fw-bold col-12 mb-0">
                                    JNT
                                    <span class="px-2">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#cekResiModal">
                                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="Button Edit Resi / New">
                                                    <path id="Vector"
                                                        d="M9.07692 1H3.30769C3.00167 1 2.70819 1.12157 2.4918 1.33795C2.27541 1.55434 2.15385 1.84783 2.15385 2.15385V12.5385L1 16L5.61538 14.8462H14.8462C15.1522 14.8462 15.4457 14.7246 15.662 14.5082C15.8784 14.2918 16 13.9983 16 13.6923V7.92308"
                                                        stroke="#3A6BE8" stroke-width="1.15385"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path id="Vector_2"
                                                        d="M10.0709 9.81141L6.60938 10.4345L7.1863 6.9268L12.644 1.49218C12.7512 1.38389 12.8788 1.29793 13.0194 1.23926C13.16 1.1806 13.3109 1.15039 13.4632 1.15039C13.6156 1.15039 13.7664 1.1806 13.9071 1.23926C14.0477 1.29793 14.1753 1.38389 14.2825 1.49218L15.5055 2.71526C15.6135 2.8226 15.6993 2.95024 15.7577 3.09084C15.8162 3.23144 15.8464 3.38221 15.8464 3.53449C15.8464 3.68677 15.8162 3.83754 15.7577 3.97814C15.6993 4.11874 15.6135 4.24638 15.5055 4.35372L10.0709 9.81141Z"
                                                        stroke="#3A6BE8" stroke-width="1.15385"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </g>
                                            </svg>
                                        </a>
                                    </span>
                                </p>
                                <p class="fs-6 fw-normal col-12 mb-0">JNT23092023</p>
                                <p class="fs-6 fw-normal col-12 mb-0">Sabtu, 23 September 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-3 d-flex align-items-center gap_btn">
                    <a href="{{ route('admin.data-pelanggan.invoice', ['orderNumber' => $order['order_number']]) }}"
                        class="d-flex justify-content-between align-items-center btn border-black color_text bg-white fs-6 fw-semibold col-lg-12 cetak_invoice pl-custom">
                        Cetak Invoice
                        <span class="d-flex align-items-center status-order p-2 justify-content-end">
                            <svg width="22" height="24" viewBox="0 0 18 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="Download">
                                    <path id="Vector"
                                        d="M9 13.5L3.375 7.875L4.95 6.24375L7.875 9.16875V0H10.125V9.16875L13.05 6.24375L14.625 7.875L9 13.5ZM2.25 18C1.63125 18 1.10138 17.7795 0.660377 17.3385C0.219377 16.8975 -0.00074809 16.368 1.91002e-06 15.75V12.375H2.25V15.75H15.75V12.375H18V15.75C18 16.3687 17.7795 16.8986 17.3385 17.3396C16.8975 17.7806 16.368 18.0007 15.75 18H2.25Z"
                                        fill="white" />
                                </g>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
            </div>
            </div>
        </article>
    @endforeach
@else
    <p class="fs-6 fw-bold text-center">No orders available.</p>
@endif --}}
@if ($orderan->count())
@foreach ($orderan as $orderNumber => $data)
    <div id="maincard" class="card  mt-5 rounded-3 custom-input w-100">
        <!--atas-->

        <div class="card-header dashed-line d-flex flex-row justify-content-between"
            style="box-sizing: border-box;">
            <!--kiri-->
            <div class="card-atas-kiri d-flex flex-row">
                <input style="width: 180px; height:50px; font-weight:bold; font-size:20px"
                    class="rounded ms-3 text-center mt-3 fzt6 card-atas-satu" type="text"
                    value="{{ $orderNumber }}" readonly>
                <div style="margin-left: 100px; font-size:16px" class="mt-1">
                    <input style="width: 180px" type="text"
                        class="form-control-plaintext fzt6" readonly
                        value="{{ $data->first()->order_date }}">
                    <input style="width: 180px" type="text"
                        class="form-control-plaintext fzt6" readonly
                        value="{{ $data->first()->juragan }}">
                </div>
            </div>
            <!--kanan-->
            @include('super-admin.dashboard-invoice.icon.proses-icon')
        </div>
        <!--bawah-->
        {{-- info pemesan --}}
        <div class="card-body d-flex">
            <!--satu-->
            <div class="col-3 p-0 ">
                <div class="card-body">
                    <div class="mb-2">

                        <label for="pemesan" class="form-label fzt7">Pemesan / Dikirim
                            kepada</label>
                        <input class="fzt7"
                            style="border: none;background-color:white;font-weight:bold; font-size:20px"
                            type="text" class="form-control" id="pemesan" readonly
                            value="{{ $data->first()->customer_name }}">
                        <label for="nohp" class="form-label"></label>
                        <input class="fzt7"
                            style="border: none; background-color:white; font-weight:bold; font-size:20px"
                            type="number" class="form-control" id="nohp" readonly
                            value="{{ $data->first()->customer_phone }}">
                        <label for="metode" class="form-label"></label>

                        <input class="fzt7"
                            style="border: none; background-color:white; font-weight:bold; font-size:20px"
                            type="text" class="form-control" id="metode" readonly
                            value="{{ $data->first()->payment_method }}">
                    </div>
                    <div class="mb-2">
                        <label for="asalorderan" class="fzt7">Asal Orderan</label>
                        <input
                            style="border: none; background-color:white; font-weight:bold; font-size:20px"
                            class="form-control fzt7" type="text" id="asalorderan"
                            readonly value="{{ $data->first()->source }}">
                    </div>
                    <div class="mb-4">
                        <label for="cs" class="fzt7">Dilayani</label>
                        <div class="p-scroll">
                            <p class="fzt7"><b>{{ $data->first()->served_by }}</b></p>
                        </div>
                    </div>

                    {{-- cetak invoice muncul apabila orderan sudah selesai dan terbayar lunas --}}
                    @if ($data->first()->total_amount == $data->first()->paid_amount && $data->first()->status == 'orderan_selesai')
                        <div class="d-flex justify-content-between align-items-center   p-0"
                            onclick="goToInvoice()"
                            style="background-color: white;   font-weight:bold; border:2px solid #202B46; border-radius:10px;">
                            <a href="{{ route('super-admin.dashboard-invoice.invoice', ['orderNumber' => $orderNumber]) }}"
                                class="btn rounded p-1 text-start fzt7"
                                style="color: #202B46;">Cetak
                                Invoice </a>
                            <div class=" fzt6 "
                                style="background-color: #202B46; border-radius: 0 5px 5px 0; padding:9px">
                                <a
                                    href="{{ route('super-admin.dashboard-invoice.invoice', ['orderNumber' => $orderNumber]) }}">
                                    <i class="fa-solid fa-download  " style="color: white"></i></a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            <!--dua-->
            <div class=" col-2 p-0 ">
                <div class="card-body " style="font-size: 15px; position: relative;">
                    <p class=" fzt7">Produk <i class="fa-solid fa-circle-info"></i></p>
                    <div>
                        @php
                            $orderData = DB::table('orders')
                                ->join('barangs', 'orders.id_produk', '=', 'barangs.id')
                                ->select('orders.quantity', 'orders.size','orders.subtotal', 'barangs.kd_produk')
                                ->where('orders.order_number', $data->first()->order_number)
                                ->get();

                            $totalSubtotal = $orderData->sum('subtotal');
                            $totalqty = $orderData->sum('quantity');
                        @endphp

                        @foreach ($orderData as $item)
                            <div class="d-flex flex-row">
                                <div class="col-6">
                                    <p class="hoverjs"><b>{{ $item->kd_produk }}</b></p>
                                    <p class="hoverjs">{{ $item->size }}</p>
                                </div>
                                <div class="col-6">
                                    <p class="hoverjs">X <b> {{ $item->quantity }}</b></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr style="height: 2px; border:none; color:black; background-color:black">
                    <div class="d-flex flex-row">
                        <div class="col-6">
                            <p class="hoverjs"><b>total</b></p>
                        </div>
                        <div class="col-6">
                            <p class="hoverjs"><b>= {{ $totalqty }} pcs</b></p>
                        </div>
                    </div>

                    <div class="hasilhover p-2 rounded">
                            <div class="d-flex">
                                <table>
                                     @foreach ($orderData as $hvr)
                                    <tr>
                                        <td><p style="font-size: 70%"><b>{{ $hvr->kd_produk }}</b></p></td>
                                        <td><p style="font-size: 70%">{{ $hvr->size }}</p></td>
                                        <td><p style="font-size: 70%">X</p></td>
                                        <td><p style="font-size: 70%">{{ $hvr->quantity }}</p></td>
                                        <td><p style="font-size: 70%">=</p></td>
                                        <td><p style="font-size: 70%">Rp. {{ number_format($hvr->subtotal, 2) }}</p></td>
                                    </tr>
                                     @endforeach
                                </table>
                            </div>

                        <hr style="height: 2px; border:none; color:black; background-color:black">
                        <table>
                            <tr>
                                <td><p style="font-size: 80%"><b>total</b></p></td>
                                <td><p style="font-size: 80%"><b>=</b></p></td>
                                <td><p style="font-size: 80%"><b>Rp. {{ number_format($totalSubtotal, 2) }}</b></p></td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
            <!--tiga-->
            <div class=" col-4 p-0">
                <div class="card rounded-3">
                    {{-- header berwarna merah apabila belum dibayar --}}
                    @if ($data->first()->paid_amount == 0)
                        <div class="card-header P-4 wajib-bayar custom-input"
                            style="display: absolute; z-index:1; background : linear-gradient(to bottom, #FF8E8E, #FFFFFF)">
                            <h5 class="text-center fs-4 fzt7" style="font-weight: bold">Wajib
                                Bayar RP
                                {{ number_format($data->first()->total_amount, 0, ',', '.') }}
                            </h5>
                        </div>
                    @endif

                    {{-- header berwarna kuning apabila dibayar sebagian --}}
                    @if ($data->first()->paid_amount < $data->first()->total_amount && $data->first()->paid_amount > 0)
                        <div class="card-header P-4 wajib-bayar custom-input"
                            style="display: absolute; z-index:1; background : linear-gradient(to bottom, #FDF771, #FFFFFF)">
                            <h5 class="text-center fs-4" fzt7 style="font-weight: bold">Wajib
                                Bayar RP
                                {{ number_format($data->first()->total_amount, 0, ',', '.') }}
                            </h5>
                        </div>
                    @endif

                    {{-- header berwarna hijau apabila terbayar lunas --}}
                    @if ($data->first()->paid_amount == $data->first()->total_amount)
                        <div class="card-header P-4 wajib-bayar custom-input"
                            style="display: absolute; z-index: 1; background: linear-gradient(to bottom, #4FDF6F, #FFFFFF);">
                            <h5 class="text-center fs-4 fzt7 " style="font-weight: bold">Lunas
                                {{ number_format($data->first()->total_amount, 0, ',', '.') }}
                            </h5>
                        </div>
                    @endif

                    {{-- isi card body --}}
                    <div class="card-body fs-5 " style="background-color: #EDEDED">
                        <table class="table table-borderless fw-bold fs-5 ">
                            <tr>
                                <td class="fzt7" style="background-color: #EDEDED">Harga
                                    Produk
                                </td>
                                <td class="fzt7" id="total"
                                    style="background-color: #EDEDED">RP
                                    {{ number_format($data->first()->total_amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        </table>
                        <hr style="border-bottom: 3px solid black">
                        <table class="table table-borderless fw-bold">
                            <tr>
                                <td class="fzt7" style="background-color: #EDEDED">Terbayar
                                </td>
                                <td class="fzt7" id="terbayar"
                                    style="background-color: #EDEDED">RP
                                    {{ number_format($data->first()->paid_amount, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fzt7" style="background-color: #EDEDED">
                                    Kekurangan
                                </td>
                                <td class="fzt7" id="kekurangan"
                                    style="background-color: #EDEDED">RP
                                    {{ number_format(max(0, $data->first()->total_amount - $data->first()->paid_amount), 0, ',', '.') }}
                                </td>
                            </tr>
                        </table>
                        {{-- keterangan lunas akan muncul apabila sudah terbayar penuh --}}
                        @if ($data->first()->total_amount == $data->first()->paid_amount)
                            <div id="status-lunas"
                                class="border border-secondary p-2 mb-2 text-center rounded-3 custom-input fzt7"
                                style="font-weight: bold; color:#ccc;">LUNAS</div>
                        @endif
                    </div>
                </div>
            </div>
            <!--emat-->
            {{-- note keterangan --}}
            <div class=" col-3 p-0 ">
                <div class="card-body" style="font-size: 18px">
                    <p class="fzt7" style="font-weight: 900; color:#ccc">Keterangan</p>
                    @php
                        // Ubah jumlah kata yang diinginkan sesuai kebutuhan
                        $limitedNote = Str::limit(
                            $data->first()->notes,
                            $limit = 50,
                            $end = '...',
                        );
                    @endphp
                    <div class="note-section">
                        <div class="limited-note">
                            <p class="fzt6">{{ $limitedNote }}</p>
                        </div>
                        <div class="full-note"
                            style="display: none; margin-top: 0; padding-top: 0;">
                            @foreach (explode("\n", $data->first()->notes) as $noteLine)
                                <p style="margin: 0; padding: 0;" class="fzt7">
                                    {{ $noteLine }}</p>
                            @endforeach
                        </div>
                        <a href="#" class="show-more fzt7"
                            onclick="toggleNoteVisibility(this); return false;">Selengkapnya</a>
                    </div>
                    @php
                        $resi = DB::table('resi')
                            ->where('order_number', $data->first()->order_number)
                            ->first();
                    @endphp

                    @if($resi)
                    <table>
                        <tr>
                            <th style="font-size: 70%;">Kurir</th>
                            <td style="font-size: 70%;">:{{ $resi->kurir }}</td>
                        </tr>
                        <tr>
                            <th style="font-size: 70%;">Ongkos</th>
                            <td style="font-size: 70%;">:{{ $resi->ongkos }}</td>
                        </tr>
                        <tr>
                            <th style="font-size: 70%;">Lainnya</th>
                            <td style="font-size: 70%;">:{{ $resi->lainnya }}</td>
                        </tr>
                        <tr>
                            <th style="font-size: 70%;">No Resi</th>
                            <td style="font-size: 70%;">:{{ $resi->no_resi }}</td>
                        </tr>
                    </table>
                    @else
                        <p>No matching resi found.</p>
                    @endif
                </div>
            </div>




        </div>



    </div>
@endforeach
@else
<h3 class="text-center">orderan belum ada</h3>
@endif
{{-- Modal Cek Resi --}}
<x-admin.dashboard.modal.modal-cek-resi />
<script>
    $(document).ready(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });

</script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
                    const hoverElements = document.querySelectorAll('.hoverjs');
                    const hasilHover = document.querySelector('.hasilhover');

                    hoverElements.forEach(element => {
                        element.addEventListener('mouseover', () => {
                            hasilHover.style.display = 'block';
                        });

                        element.addEventListener('mouseleave', () => {
                            hasilHover.style.display = 'none';
                        });
                    });
        });

        document.getElementById('searchForm').onsubmit = function(e) {
            e.preventDefault();

            var form = this;
            var url = form.getAttribute('action') || window.location.href;
            var queryParams = [];

            Array.from(form.elements).forEach(function(element) {
                var name = element.name;
                var value = element.value;
                if (name && value && value !== "Pilih Pembayaran" && value !== "Pilih opsi order" && value !==
                    "Pilih opsi pengiriman" && value !== "Nama Pelanggan") {
                    queryParams.push(encodeURIComponent(name) + "=" + encodeURIComponent(value));
                }
            });

            var queryString = queryParams.join('&');
            if (queryString.length > 0) {
                window.location.href = url + '?' + queryString;
            } else {
                window.location.href = url;
            }
        };

        const toastTrigger = document.getElementById('liveToastBtn');
        const toastLiveExample = document.getElementById('pembayaranberhasil');
        const toastLiveExample2 = document.getElementById('pembayarangagal');

        if (toastTrigger) {

            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample2);

            toastTrigger.addEventListener('click', () => {
                toastBootstrap.show();
                setTimeout(() => {
                    toastBootstrap.hide();
                }, 1000);
            });
        }

        function toggleNoteVisibility(link) {
            var noteSection = link.closest('.note-section');
            var limitedNote = noteSection.querySelector('.limited-note');
            var fullNote = noteSection.querySelector('.full-note');
            var showMoreLink = noteSection.querySelector('.show-more');

            if (limitedNote.style.display === 'none') {
                limitedNote.style.display = 'block';
                fullNote.style.display = 'none';
                showMoreLink.innerHTML = 'Selengkapnya';
            } else {
                limitedNote.style.display = 'none';
                fullNote.style.display = 'block';
                showMoreLink.innerHTML = 'Tutup';
            }
        }
    </script>
{{-- Akhir Modal Cek Resi --}}
