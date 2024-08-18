{{-- @if ($data->first()->status == 'belum_proses') --}}

@if ($orderan->count())
    @php
        $status1 = $data->where('id_status', 1)->first();
        $status2 = $data->where('id_status', 2)->first();
        $status3 = $data->where('id_status', 3)->first();
        $status4 = $data->where('id_status', 4)->first();
        $status5 = $data->where('id_status', 5)->first();
        $status6 = $data->where('id_status', 6)->first();
        $status7 = $data->where('id_status', 7)->first();
        $status8 = $data->where('id_status', 8)->first();
        $status9 = $data->where('id_status', 9)->first();
        $status10 = $data->where('id_status', 10)->first();
    @endphp



    <div class="col-md-6 d-flex justify-content-end p-md-0 justify-content-end d-flex ">
            <div class=" rounded-3 pt-2 d-flex align-items-center">
                <div class=" d-flex flex-column align-items-center gap-1 ">
                    {{-- icon atas --}}
                    {{-- <span class="d-flex align-items-center gap_custom">
                        <svg width="36" height="35" viewBox="0 0 48 48" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" data-bs-title="Pesanan Ditambahkan"
                            data-bs-custom-class="custom-tooltip" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="Icon=Plus, State=Green">
                                <path id="Vector"
                                    d="M31.7143 25.2857H25.2857V31.7143C25.2857 32.0553 25.1503 32.3823 24.9091 32.6234C24.668 32.8645 24.341 33 24 33C23.659 33 23.332 32.8645 23.0909 32.6234C22.8497 32.3823 22.7143 32.0553 22.7143 31.7143V25.2857H16.2857C15.9447 25.2857 15.6177 25.1503 15.3766 24.9091C15.1355 24.668 15 24.341 15 24C15 23.659 15.1355 23.332 15.3766 23.0909C15.6177 22.8497 15.9447 22.7143 16.2857 22.7143H22.7143V16.2857C22.7143 15.9447 22.8497 15.6177 23.0909 15.3766C23.332 15.1355 23.659 15 24 15C24.341 15 24.668 15.1355 24.9091 15.3766C25.1503 15.6177 25.2857 15.9447 25.2857 16.2857V22.7143H31.7143C32.0553 22.7143 32.3823 22.8497 32.6234 23.0909C32.8645 23.332 33 23.659 33 24C33 24.341 32.8645 24.668 32.6234 24.9091C32.3823 25.1503 32.0553 25.2857 31.7143 25.2857Z"
                                    fill="#24A240" />
                                <circle id="Ellipse 1851" cx="24" cy="24" r="22" stroke="#24A240"
                                    stroke-width="4" />
                            </g>
                        </svg>
                        @if ($status2)
                            <svg width="36" height="35" viewBox="0 0 32 31" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-title="Dibayar Lunas"
                                data-bs-custom-class="custom-tooltip" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="Icon">
                                    <path id="Vector"
                                        d="M27.3646 8.77246H4.64266C2.76032 8.77246 1.23438 10.299 1.23438 12.1821V25.8209C1.23438 27.704 2.76032 29.2306 4.64266 29.2306H27.3646C29.2469 29.2306 30.7728 27.704 30.7728 25.8209V12.1821C30.7728 10.299 29.2469 8.77246 27.3646 8.77246Z"
                                        stroke="{{ $data->first()->paid_amount == 0
                                            ? '#828282'
                                            : ($data->first()->paid_amount < $data->first()->total_amount && $data->first()->paid_amount != 0
                                                ? '#ffd43b'
                                                : '#24A240') }}"
                                        stroke-width="2.46154" stroke-linejoin="round" />
                                    <path id="Vector_2"
                                        d="M27.0351 9.00276V6.43407C27.0349 5.80406 26.9194 5.18186 26.6969 4.61186C26.4744 4.04187 26.1502 3.53813 25.7476 3.13658C25.3451 2.73503 24.8739 2.44557 24.3679 2.28886C23.8619 2.13215 23.3334 2.11204 22.8202 2.22998L4.12006 6.07873C3.30798 6.26535 2.57536 6.78784 2.04856 7.5561C1.52177 8.32437 1.23382 9.29023 1.23438 10.2871V14.4826"
                                        stroke="{{ $data->first()->paid_amount == 0
                                            ? '#828282'
                                            : ($data->first()->paid_amount < $data->first()->total_amount && $data->first()->paid_amount != 0
                                                ? '#ffd43b'
                                                : '#24A240') }}"
                                        stroke-width="2.46154" stroke-linejoin="round" />
                                    <path id="Vector_3"
                                        d="M23.9597 24.0726C23.5103 24.0726 23.071 23.9119 22.6973 23.6109C22.3237 23.3098 22.0324 22.8819 21.8605 22.3812C21.6885 21.8806 21.6435 21.3297 21.7312 20.7982C21.8188 20.2667 22.0352 19.7785 22.353 19.3953C22.6708 19.0121 23.0756 18.7511 23.5164 18.6454C23.9572 18.5397 24.414 18.594 24.8292 18.8013C25.2444 19.0087 25.5993 19.3599 25.8489 19.8105C26.0986 20.2611 26.2319 20.7908 26.2319 21.3327C26.2319 22.0594 25.9925 22.7563 25.5664 23.2701C25.1403 23.784 24.5623 24.0726 23.9597 24.0726Z"
                                        fill="{{ $data->first()->paid_amount == 0
                                            ? '#828282'
                                            : ($data->first()->paid_amount < $data->first()->total_amount && $data->first()->paid_amount != 0
                                                ? '#ffd43b'
                                                : '#24A240') }}" />
                                </g>
                            </svg>
                        @else
                        @endif
                        @if ($status3)
                            <svg width="36" height="35" viewBox="0 0 22 31" fill="none" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-title="Data data Lengkap"
                                data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                <g id="Icon">
                                    <path id="Vector"
                                        d="M13.6959 0.922852H2.92668C2.21264 0.922852 1.52784 1.23406 1.02293 1.78801C0.518028 2.34197 0.234375 3.09329 0.234375 3.8767V27.5075C0.234375 28.2909 0.518028 29.0422 1.02293 29.5962C1.52784 30.1501 2.21264 30.4613 2.92668 30.4613H19.0805C19.7946 30.4613 20.4794 30.1501 20.9843 29.5962C21.4892 29.0422 21.7728 28.2909 21.7728 27.5075V9.78439L13.6959 0.922852ZM19.0805 27.5075H2.92668V3.8767H12.3498V11.2613H19.0805V27.5075Z"
                                        fill="{{ $status3 ? '#24A240' : '#828282' }}" />
                                    <path id="Vector 1480" d="M5.77344 15.0771H15.9273"
                                        stroke="{{ $status3 ? '#24A240' : '#828282' }}" stroke-width="1.23077"
                                        stroke-linecap="round" />
                                    <path id="Vector 1481" d="M5.77344 18.1533H15.9273"
                                        stroke="{{ $status3 ? '#24A240' : '#828282' }}" stroke-width="1.23077"
                                        stroke-linecap="round" />
                                    <path id="Vector 1482" d="M5.77344 21.2305H15.9273"
                                        stroke="{{ $status3 ? '#24A240' : '#828282' }}" stroke-width="1.23077"
                                        stroke-linecap="round" />
                                </g>
                            </svg>
                        @else
                        @endif
                        @if ($status4)
                            <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="2.0846" width="18.6116" height="18.6116" rx="4.92308"
                                    transform="matrix(0.846868 -0.531803 0.846868 0.531803 0.475469 27.2478)" fill="white"
                                    stroke="{{ $status4 ? '#24A240' : '#828282' }}" stroke-width="2.46154" />
                                <rect x="2.0846" width="18.6116" height="18.6116" rx="4.92308"
                                    transform="matrix(0.846868 -0.531803 0.846868 0.531803 0.475469 21.2238)" fill="white"
                                    stroke="{{ $status4 ? '#24A240' : '#828282' }}" stroke-width="2.46154" />
                                <rect x="2.0846" width="18.6116" height="18.6116" rx="4.92308"
                                    transform="matrix(0.846868 -0.531803 0.846868 0.531803 0.475469 15.1994)" fill="white"
                                    stroke="{{ $status4 ? '#24A240' : '#828282' }}" stroke-width="2.46154" />
                            </svg>
                        @else
                        @endif
                        @if ($status5)
                            <svg width="36" height="36" viewBox="0 0 36 36" fill="none" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-title="Sablon Lengkap"
                                data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 15.6924C9.68483 15.6924 9.37274 15.7545 9.08156 15.8751C8.79038 15.9957 8.5258 16.1725 8.30294 16.3953C8.08008 16.6182 7.9033 16.8828 7.78269 17.1739C7.66208 17.4651 7.6 17.7772 7.6 18.0924C7.6 18.4076 7.66208 18.7196 7.78269 19.0108C7.9033 19.302 8.08008 19.5666 8.30294 19.7894C8.5258 20.0123 8.79038 20.1891 9.08156 20.3097C9.37274 20.4303 9.68483 20.4924 10 20.4924C10.6365 20.4924 11.247 20.2395 11.6971 19.7894C12.1471 19.3394 12.4 18.7289 12.4 18.0924C12.4 17.4559 12.1471 16.8454 11.6971 16.3953C11.247 15.9452 10.6365 15.6924 10 15.6924ZM10 18.8924C9.78783 18.8924 9.58434 18.8081 9.43431 18.6581C9.28429 18.508 9.2 18.3046 9.2 18.0924C9.2 17.8802 9.28429 17.6767 9.43431 17.5267C9.58434 17.3767 9.78783 17.2924 10 17.2924C10.2122 17.2924 10.4157 17.3767 10.5657 17.5267C10.7157 17.6767 10.8 17.8802 10.8 18.0924C10.8 18.3046 10.7157 18.508 10.5657 18.6581C10.4157 18.8081 10.2122 18.8924 10 18.8924ZM30 10.0924H27.6V4.49238C27.6 4.28021 27.5157 4.07673 27.3657 3.9267C27.2157 3.77667 27.0122 3.69238 26.8 3.69238H9.2C8.98783 3.69238 8.78434 3.77667 8.63432 3.9267C8.48429 4.07673 8.4 4.28021 8.4 4.49238V10.0924H6C4.93939 10.0932 3.92247 10.5149 3.17251 11.2649C2.42255 12.0149 2.00085 13.0318 2 14.0924V24.4924C2.00127 25.765 2.50739 26.9852 3.40729 27.8851C4.30719 28.785 5.52735 29.2911 6.8 29.2924H8.4V34.8924C8.4 35.1046 8.48429 35.308 8.63432 35.4581C8.78434 35.6081 8.98783 35.6924 9.2 35.6924H26.8C27.0122 35.6924 27.2157 35.6081 27.3657 35.4581C27.5157 35.308 27.6 35.1046 27.6 34.8924V29.2924H29.2C30.4727 29.2911 31.6928 28.785 32.5927 27.8851C33.4926 26.9852 33.9987 25.765 34 24.4924V14.0924C33.9992 13.0318 33.5775 12.0149 32.8275 11.2649C32.0775 10.5149 31.0606 10.0932 30 10.0924ZM10 5.29238H26V10.0924H10V5.29238ZM26 34.0924H10V24.4924H26V34.0924ZM32.4 24.4924C32.3987 25.3407 32.0612 26.1539 31.4613 26.7537C30.8615 27.3536 30.0483 27.6911 29.2 27.6924H27.6V23.6924C27.6 23.4802 27.5157 23.2767 27.3657 23.1267C27.2157 22.9767 27.0122 22.8924 26.8 22.8924H9.2C8.98783 22.8924 8.78434 22.9767 8.63432 23.1267C8.48429 23.2767 8.4 23.4802 8.4 23.6924V27.6924H6.8C5.9517 27.6911 5.1385 27.3536 4.53866 26.7537C3.93882 26.1539 3.60127 25.3407 3.6 24.4924V14.0924C3.6 13.4559 3.85286 12.8454 4.30294 12.3953C4.75303 11.9452 5.36348 11.6924 6 11.6924H30C30.6365 11.6924 31.247 11.9452 31.6971 12.3953C32.1471 12.8454 32.4 13.4559 32.4 14.0924V24.4924Z"
                                    fill="{{ $status5 ? '#24A240' : '#828282' }}" />
                            </svg>
                        @else
                        @endif
                        @if ($status6)
                            <svg width="36" height="37" viewBox="0 0 36 37" fill="none"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Bordir Lengkap"
                                data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.3644 4.36947L2.67751 18.0566C1.77416 18.96 1.77416 20.4233 2.67751 21.3267L16.3644 35.015C17.2677 35.9184 18.731 35.9184 19.6344 35.015L33.3225 21.3279C34.2258 20.4246 34.2258 18.9612 33.3225 18.0578L19.6356 4.36947C18.7323 3.46734 17.2677 3.46734 16.3644 4.36947Z"
                                    stroke="{{ $status6 ? '#24A240' : '#828282' }}" stroke-width="2"
                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M24.1562 13.5382L30.3099 8.61523" stroke="{{ $status6 ? '#24A240' : '#828282' }}"
                                    stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M20.4609 9.84632L26.6145 4.92334" stroke="{{ $status6 ? '#24A240' : '#828282' }}"
                                    stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M27.8438 17.2306L33.9974 12.3076" stroke="{{ $status6 ? '#24A240' : '#828282' }}"
                                    stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M11.8448 13.5385L6.92188 7.38477" stroke="{{ $status6 ? '#24A240' : '#828282' }}"
                                    stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M15.5401 9.84611L10.6172 3.69238" stroke="{{ $status6 ? '#24A240' : '#828282' }}"
                                    stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M8.15726 17.2304L3.23438 11.0767" stroke="{{ $status6 ? '#24A240' : '#828282' }}"
                                    stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M24.1562 25.8457L29.0791 31.9994" stroke="{{ $status6 ? '#24A240' : '#828282' }}"
                                    stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M20.4609 29.5381L25.3838 35.6918" stroke="{{ $status6 ? '#24A240' : '#828282' }}"
                                    stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M27.8438 22.1538L32.7666 28.3075" stroke="{{ $status6 ? '#24A240' : '#828282' }}"
                                    stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M11.8489 25.8457L5.69531 30.7687" stroke="{{ $status6 ? '#24A240' : '#828282' }}"
                                    stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M15.5364 29.5381L9.38281 34.4611" stroke="{{ $status6 ? '#24A240' : '#828282' }}"
                                    stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M8.15361 22.1538L2 27.0768" stroke="{{ $status6 ? '#24A240' : '#828282' }}"
                                    stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        @else
                        @endif
                        @if ($status7)
                            <svg width="36" height="35" viewBox="0 0 36 35" fill="none"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Penjahit Lengkap"
                                data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.1582 5.34647C3.895 5.39653 3.65796 5.538 3.48895 5.74588C3.31994 5.95376 3.22983 6.21469 3.23455 6.48257V33.7488C3.23455 34.0501 3.35425 34.3391 3.56731 34.5522C3.78036 34.7652 4.06934 34.8849 4.37065 34.8849H22.5482C22.8495 34.8849 23.1384 34.7652 23.3515 34.5522C23.5646 34.3391 23.6843 34.0501 23.6843 33.7488V30.3406C23.6859 30.305 23.6859 30.2693 23.6843 30.2338V28.0684L21.4121 25.7962V30.1633C21.4075 30.2223 21.4075 30.2816 21.4121 30.3406V32.6127H5.50674V23.524H8.91503V21.2518H5.50674V7.61866H21.4121V9.89085C21.4104 9.92643 21.4104 9.96206 21.4121 9.99764V16.7074L22.5482 17.8435L23.6843 16.7074V10.0681C23.6889 10.0091 23.6889 9.94984 23.6843 9.89085V6.48257C23.6843 6.18125 23.5646 5.89228 23.3515 5.67922C23.1384 5.46617 22.8495 5.34647 22.5482 5.34647H4.37065C4.33507 5.3448 4.29943 5.3448 4.26385 5.34647C4.22828 5.3448 4.19264 5.3448 4.15706 5.34647H4.1582ZM10.0511 12.163L19.1399 21.2518H18.0038V23.524H21.4121L26.1337 28.2456C26.0405 28.5557 25.9564 28.8659 25.9564 29.2045C25.9564 31.0733 27.4959 32.6127 29.3647 32.6127C31.2336 32.6127 32.773 31.0733 32.773 29.2045C32.773 27.3356 31.2336 25.7962 29.3647 25.7962C29.0262 25.7962 28.716 25.8802 28.4059 25.9734L24.7499 22.3527L28.3706 18.8024C28.6899 18.9024 29.0148 18.9796 29.3647 18.9796C31.2336 18.9796 32.773 17.4402 32.773 15.5713C32.773 13.7024 31.2336 12.163 29.3647 12.163C27.4959 12.163 25.9564 13.7024 25.9564 15.5713C25.9564 15.9099 26.0405 16.22 26.1337 16.5302L22.5141 20.1498L16.0872 13.7593C15.0636 12.7379 13.6866 12.163 12.3233 12.163H10.0511ZM29.3647 14.4352C30.0055 14.4352 30.5008 14.9306 30.5008 15.5713C30.5008 16.2121 30.0055 16.7074 29.3647 16.7074C28.724 16.7074 28.2286 16.2121 28.2286 15.5713C28.2286 14.9306 28.724 14.4352 29.3647 14.4352ZM11.1872 21.2518V23.524H15.7316V21.2518H11.1872ZM29.3647 28.0684C30.0055 28.0684 30.5008 28.5637 30.5008 29.2045C30.5008 29.8452 30.0055 30.3406 29.3647 30.3406C28.724 30.3406 28.2286 29.8452 28.2286 29.2045C28.2286 28.5637 28.724 28.0684 29.3647 28.0684Z"
                                    fill="{{ $status7 ? '#24A240' : '#828282' }}" />
                            </svg>
                        @else
                        @endif
                        @if ($status8)
                            <svg width="36" height="35" viewBox="0 0 36 35" fill="none"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="QC Lengkap"
                                data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.69531 9.25526L7.63863 11.8616L11.5253 6.64893M5.69531 21.4182L7.63863 24.0245L11.5253 18.8118M5.69531 33.5811H10.3107M16.0597 21.4182H30.3107M16.0597 33.5811H30.3107M16.0597 9.25526H30.3107"
                                    stroke="{{ $status8 ? '#24A240' : '#828282' }}" stroke-width="2.46154"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        @else
                        @endif
                        @if ($status9)
                            <svg width="36" height="35" viewBox="0 0 30 33" fill="none"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Sudah Dipacking"
                                data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                <g id="Logo Packing">
                                    <path id="Vector"
                                        d="M9.03771 2.9781L2.28571 10.6947V30.4067H29.7143V10.6947L22.9623 2.9781H9.03771ZM8.51886 0.692383H23.4811C23.6438 0.692264 23.8046 0.726865 23.9528 0.793875C24.101 0.860884 24.2332 0.958758 24.3406 1.08095L31.7166 9.51296C31.899 9.72104 31.9997 9.98824 32 10.265V31.5495C32 31.8526 31.8796 32.1433 31.6653 32.3577C31.4509 32.572 31.1602 32.6924 30.8571 32.6924H1.14286C0.839753 32.6924 0.549063 32.572 0.334735 32.3577C0.120408 32.1433 4.00252e-07 31.8526 4.00252e-07 31.5495V10.265C-0.000231727 9.98745 0.100511 9.71935 0.283429 9.51067L7.65714 1.08553C7.76433 0.962206 7.89671 0.863302 8.04536 0.795483C8.19401 0.727664 8.35547 0.692507 8.51886 0.692383Z"
                                        fill="{{ $status9 ? '#24A240' : '#828282' }}" />
                                    <path id="Vector_2" d="M0 9.83496H32V12.1207H0V9.83496Z"
                                        fill="{{ $status9 ? '#24A240' : '#828282' }}" />
                                    <path id="Vector_3"
                                        d="M13.7154 10.1164V21.2638H18.2868V10.1164L16.504 2.9781H15.4983L13.7154 10.1164ZM13.7154 0.692383H18.2868L20.5725 9.83524V22.4067C20.5725 22.7098 20.4521 23.0005 20.2378 23.2148C20.0235 23.4291 19.7328 23.5495 19.4297 23.5495H12.5725C12.2694 23.5495 11.9788 23.4291 11.7644 23.2148C11.5501 23.0005 11.4297 22.7098 11.4297 22.4067V9.83524L13.7154 0.692383Z"
                                        fill="{{ $status9 ? '#24A240' : '#828282' }}" />
                                </g>
                            </svg>
                        @else
                        @endif
                        @if ($status10)
                            <svg width="36" height="35" viewBox="0 0 42 33" fill="none"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Diantar"
                                data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                <g id="Logo Diantar">
                                    <rect id="Box" x="7.4375" y="1.69238" width="19.7476" height="25"
                                        stroke="{{ $status10 ? '#24A240' : '#828282' }}" stroke-width="2" />
                                    <path id="Head"
                                        d="M35.1755 11.6924H27.7969V19.1924M35.1755 11.6924L41.0008 19.1924M35.1755 11.6924V19.1924M41.0008 19.1924V27.1924H27.7969V19.1924M41.0008 19.1924H35.1755M27.7969 19.1924H35.1755"
                                        stroke="{{ $status10 ? '#24A240' : '#828282' }}" stroke-width="2" />
                                    <path id="Ellipse 1973"
                                        d="M34.9493 29.6924C34.9493 31.0468 34.1333 31.6924 33.6192 31.6924C33.105 31.6924 32.2891 31.0468 32.2891 29.6924C32.2891 28.338 33.105 27.6924 33.6192 27.6924C34.1333 27.6924 34.9493 28.338 34.9493 29.6924Z"
                                        stroke="{{ $status10 ? '#24A240' : '#828282' }}" stroke-width="2" />
                                    <path id="Ellipse 1974"
                                        d="M12.4258 29.6924C12.4258 31.0468 11.6099 31.6924 11.0957 31.6924C10.5816 31.6924 9.76562 31.0468 9.76562 29.6924C9.76562 28.338 10.5816 27.6924 11.0957 27.6924C11.6099 27.6924 12.4258 28.338 12.4258 29.6924Z"
                                        stroke="{{ $status10 ? '#24A240' : '#828282' }}" stroke-width="2" />
                                    <path id="Vector 1483"
                                        d="M1 8.69238C0.447715 8.69238 0 9.1401 0 9.69238C0 10.2447 0.447715 10.6924 1 10.6924V8.69238ZM1 10.6924H23.5243V8.69238H1V10.6924Z"
                                        fill="{{ $status10 ? '#24A240' : '#828282' }}" />
                                    <path id="Vector 1484"
                                        d="M4.88281 12.6924C4.33053 12.6924 3.88281 13.1401 3.88281 13.6924C3.88281 14.2447 4.33053 14.6924 4.88281 14.6924V12.6924ZM4.88281 14.6924H23.5236V12.6924H4.88281V14.6924Z"
                                        fill="{{ $status10 ? '#24A240' : '#828282' }}" />
                                    <path id="Vector 1485"
                                        d="M1 17.6924C0.447715 17.6924 2.89661e-0 justify-content-center d-flex 8 18.1401 0 18.6924C-2.89661e-0 justify-content-center d-flex 8 19.2447 0.447715 19.6924 1 19.6924L1 17.6924ZM1 19.6924L23.5243 19.6924L23.5243 17.6924L1 17.6924L1 19.6924Z"
                                        fill="{{ $status10 ? '#24A240' : '#828282' }}" />
                                </g>
                            </svg>
                        @else
                        @endif
                    </span> --}}
                    {{-- garisnya --}}
                    {{-- <span class="d-flex align-items-center">

                        <span class="d-flex align-items-center line_bayar">
                            @if ($status2)
                                <svg width="52" height="9" viewBox="0 0 29 9" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-title="Pesanan Ditambahkan"
                                    data-bs-custom-class="custom-tooltip" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="Line">
                                        <circle id="Ellipse 1852" cx="4.99519" cy="4.69051" r="4.30769"
                                            fill="#24A240" />

                                        <line id="Line 31" x1="1.3125" y1="4.69111" x2="29.0048"
                                            y2="4.69111" stroke="{{ $status1 ? '#24A240' : '#828282' }}"
                                            stroke-width="2.46154" />

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
                        @if ($status2)
                            <svg width="48" height="9" viewBox="0 0 48 9" fill="none"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Dibayar Lunas"
                                data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                <g id="Line">
                                    <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                                        fill="{{ $data->first()->paid_amount == 0
                                            ? '#828282'
                                            : ($data->first()->paid_amount < $data->first()->total_amount && $data->first()->paid_amount != 0
                                                ? '#ffd43b'
                                                : '#24A240') }}" />
                                    @if ($status3)
                                        <line id="Line 31" x1="20.3125" y1="4.69111" x2="48.0048"
                                            y2="4.69111"
                                            stroke="{{ $data->first()->paid_amount == 0
                                                ? '#828282'
                                                : ($data->first()->paid_amount < $data->first()->total_amount && $data->first()->paid_amount != 0
                                                    ? '#ffd43b'
                                                    : '#24A240') }}"
                                            stroke-width="2.46154" />
                                    @else
                                    @endif
                                    <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                                        stroke="{{ $data->first()->paid_amount == 0
                                            ? '#828282'
                                            : ($data->first()->paid_amount < $data->first()->total_amount && $data->first()->paid_amount != 0
                                                ? '#ffd43b'
                                                : '#24A240') }}"
                                        stroke-width="2.46154" />
                                </g>
                            </svg>
                        @else
                        @endif
                        @if ($status3)
                            <svg width="48" height="9" viewBox="0 0 48 9" fill="none"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Data data Lengkap"
                                data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                <g id="Line">
                                    <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                                        fill="{{ $status3 ? '#24A240' : '#828282' }}" />
                                    @if ($status4)
                                        <line id="Line 31" x1="20.3125" y1="4.69111" x2="48.0048"
                                            y2="4.69111" stroke="{{ $status3 ? '#24A240' : '#828282' }}"
                                            stroke-width="2.46154" />
                                    @else
                                    @endif
                                    <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                                        stroke="{{ $status3 ? '#24A240' : '#828282' }}" stroke-width="2.46154" />
                                </g>
                            </svg>
                        @else
                        @endif
                        @if ($status4)
                            <svg width="48" height="9" viewBox="0 0 48 9" fill="none"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Bahan Lengkap"
                                data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                <g id="Line">
                                    <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                                        fill="{{ $status4 ? '#24A240' : '#828282' }}" />
                                    @if ($status5)
                                        <line id="Line 31" x1="20.3125" y1="4.69111" x2="48.0048"
                                            y2="4.69111" stroke="{{ $status4 ? '#24A240' : '#828282' }}"
                                            stroke-width="2.46154" />
                                    @else
                                    @endif
                                    <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                                        stroke="{{ $status4 ? '#24A240' : '#828282' }}" stroke-width="2.46154" />
                                </g>
                            </svg>
                        @else
                        @endif
                        @if ($status5)
                            <svg width="48" height="9" viewBox="0 0 48 9" fill="none"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Sablon Lengkap"
                                data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                <g id="Line">
                                    <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                                        fill="{{ $status5 ? '#24A240' : '#828282' }}" />
                                    @if ($status6)
                                        <line id="Line 31" x1="20.3125" y1="4.69111" x2="48.0048"
                                            y2="4.69111" stroke="{{ $status5 ? '#24A240' : '#828282' }}"
                                            stroke-width="2.46154" />
                                    @else
                                    @endif
                                    <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                                        stroke="{{ $status5 ? '#24A240' : '#828282' }}" stroke-width="2.46154" />
                                </g>
                            </svg>
                        @else
                        @endif
                        @if ($status6)
                            <svg width="48" height="9" viewBox="0 0 48 9" fill="none"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Bordir Lengkap"
                                data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                <g id="Line">
                                    <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                                        fill="{{ $status6 ? '#24A240' : '#828282' }}" />
                                    @if ($status7)
                                        <line id="Line 31" x1="20.3125" y1="4.69111" x2="48.0048"
                                            y2="4.69111" stroke="{{ $status6 ? '#24A240' : '#828282' }}"
                                            stroke-width="2.46154" />
                                    @else
                                    @endif
                                    <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                                        stroke="{{ $status6 ? '#24A240' : '#828282' }}" stroke-width="2.46154" />
                                </g>
                            </svg>
                        @else
                        @endif
                        @if ($status7)
                            <svg width="48" height="9" viewBox="0 0 48 9" fill="none"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Penjahit Lengkap"
                                data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                <g id="Line">
                                    <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                                        fill="{{ $status7 ? '#24A240' : '#828282' }}" />
                                    @if ($status8)
                                        <line id="Line 31" x1="20.3125" y1="4.69111" x2="48.0048"
                                            y2="4.69111" stroke="{{ $status7 ? '#24A240' : '#828282' }}"
                                            stroke-width="2.46154" />
                                    @else
                                    @endif
                                    <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                                        stroke="{{ $status7 ? '#24A240' : '#828282' }}" stroke-width="2.46154" />
                                </g>
                            </svg>
                        @else
                        @endif
                        @if ($status8)
                            <svg width="48" height="9" viewBox="0 0 48 9" fill="none"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="QC Lengkap"
                                data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                <g id="Line">
                                    <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                                        fill="{{ $status8 ? '#24A240' : '#828282' }}" />
                                    @if ($status9)
                                        <line id="Line 31" x1="20.3125" y1="4.69111" x2="48.0048"
                                            y2="4.69111" stroke="{{ $status8 ? '#24A240' : '#828282' }}"
                                            stroke-width="2.46154" />
                                    @else
                                    @endif
                                    <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                                        stroke="{{ $status8 ? '#24A240' : '#828282' }}" stroke-width="2.46154" />
                                </g>
                            </svg>
                        @else
                        @endif
                        @if ($status9)
                            <svg width="48" height="9" viewBox="0 0 48 9" fill="none"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Sudah Dipacking"
                                data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                <g id="Line">
                                    <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                                        fill="{{ $status9 ? '#24A240' : '#828282' }}" />
                                    @if ($status10)
                                        <line id="Line 31" x1="20.3125" y1="4.69111" x2="48.0048"
                                            y2="4.69111" stroke="{{ $status9 ? '#24A240' : '#828282' }}"
                                            stroke-width="2.46154" />
                                    @else
                                    @endif
                                    <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                                        stroke="{{ $status9 ? '#24A240' : '#828282' }}" stroke-width="2.46154" />
                                </g>
                            </svg>
                        @else
                        @endif
                        @if ($status10)
                            <span class="d-flex align-items-center line_right">
                                <svg width="29" height="9" viewBox="0 0 29 9" fill="none"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Diantar"
                                    data-bs-custom-class="custom-tooltip" xmlns="http://www.w3.org/2000/svg">
                                    <g id="Line">
                                        <circle id="Ellipse 1852" cx="23.9952" cy="4.69051" r="4.30769"
                                            fill="{{ $status10 ? '#24A240' : '#828282' }}" />
                                        <line id="Line 32" y1="4.69111" x2="27.6923" y2="4.69111"
                                            stroke="{{ $status10 ? '#24A240' : '#828282' }}" stroke-width="2.46154" />
                                    </g>
                                </svg>
                            </span>
                        @else
                        @endif
                    </span> --}}
                    {{-- tanggal --}}
                    <div class="d-flex justify-content-between  gap-1" style="width: max-content !important;">


                        @foreach ($data as $item)
                            <p>ID Status: {{ $item->id_status }}, Tanggal Status: {{ $item->tanggal_status }}</p>
                        @endforeach


                    </div>
                </div>
            </div>
    </div>
@endif
