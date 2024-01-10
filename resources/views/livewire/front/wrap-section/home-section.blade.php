<div>
    <div class="page" data-x-pos="0" data-y-pos="0">

        <div class="slider-wrap">

            <!-- Bnner Section -->
            <section class="slider-section">
                <div class="swiper-container section-slider cursor-grab">
                    <div class="swiper-wrapper">
                        @foreach($sliders as $i)
                            <!-- Slide Item -->
                            <div class="swiper-slide"
                                 style="background-image: url({{asset('storage/sliders/slide-'.$i->id.'/'.$i->img)}});">
                                <div class="content-outer">
                                    <div class="content-box">
                                        <div class="inner">
                                            <h1>{{$i->title}}</h1>
                                            <p>{{$i->subtitle}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bottom-panel">
                    <div class="slider-control-wrap">
                        <div class="left-side">
                            <div class="scroll-pagination">
                                <div class="swiper-pagination"></div>
                            </div>
                            <div class="swiper-counter">
                                <div id="current">01</div>
                                <div id="total"></div>
                            </div>
                            <div class="scroll-down">
                                <div class="mouse">
                                    <div class="scroller"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="slider-nav">
                    <div class="slider-control slider-button-next hover magnetic" data-tooltip="بعدی"
                         data-position="top">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             aria-hidden="true">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <rect fill="#000000" opacity="0.3"
                                      transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000) "
                                      x="7.5" y="7.5" width="2" height="9" rx="1"></rect>
                                <path
                                    d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                    fill="#000000" fill-rule="nonzero"
                                    transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "></path>
                            </g>
                        </svg>
                    </div>

                    <div class="slider-control slider-button-prev hover magnetic" data-tooltip="قبلی"
                         data-position="top">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                             aria-hidden="true">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <rect fill="#000000" opacity="0.3"
                                      transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000) "
                                      x="14" y="7" width="2" height="10" rx="1"></rect>
                                <path
                                    d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z"
                                    fill="#000000" fill-rule="nonzero"
                                    transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) "></path>
                            </g>
                        </svg>
                    </div>
                </div>

            </section>
        </div>

        <!-- Menu -->
        <span class="page-nav nav-left-top up left hover">
					<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" class="mr">
    				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        				<polygon points="0 0 24 0 24 24 0 24"></polygon>
        				<path
                            d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.5"></path>
        				<path
                            d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                            fill="#000000" fill-rule="nonzero"></path>
    					</g>
					</svg> درباره
				</span>

        <span class="page-nav nav-left-down down left hover">
					<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" class="mr">
    					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        					<rect x="0" y="0" width="24" height="24"></rect>
        					<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
        					<path
                                d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                fill="#000000" opacity="0.3"></path>
    					</g>
					</svg> وبلاگ
				</span>

        <span class="page-nav nav-right-top up right hover">
					نمونه کار
					<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" class="ml">
    					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        					<rect x="0" y="0" width="24" height="24"></rect>
        					<path
                                d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                fill="#000000" opacity="0.3"></path>
        					<path
                                d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                fill="#000000"></path>
							<rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"></rect>
        					<rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"></rect>
    					</g>
					</svg>
				</span>

        <span class="page-nav nav-right-down down right hover">
					تماس
					<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" class="ml">
    					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        					<rect x="0" y="0" width="24" height="24"></rect>
        					<path
                                d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z"
                                fill="#000000" opacity="0.3"></path>
        					<path
                                d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z"
                                fill="#000000"></path>
    					</g>
					</svg>
				</span>

        <!-- Newsletter -->
        <div class="newsletter hover" id="open-newsletter" wire:click="dashboard">
            @if(Auth::user())
                داشبورد
            @else
                ورود
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <path fill="#000000" d="
  M 15.17 5.69
  C 25.80 4.39 25.68 18.87 16.33 18.39
  Q 15.52 18.35 14.72 18.36
  Q 14.18 18.37 14.05 18.90
  Q 13.69 20.39 12.18 20.43
  Q 7.58 20.55 2.63 20.45
  A 1.92 1.92 0.0 0 1 0.75 18.53
  L 0.75 5.50
  A 2.00 1.99 -89.9 0 1 2.75 3.50
  L 12.26 3.51
  A 1.63 1.63 0.0 0 1 13.79 4.58
  Q 13.93 4.99 14.21 5.32
  Q 14.59 5.76 15.17 5.69
  Z
  M 12.75 5.61
  A 0.67 0.67 0.0 0 0 12.08 4.94
  L 2.80 4.94
  A 0.67 0.67 0.0 0 0 2.13 5.61
  L 2.13 18.39
  A 0.67 0.67 0.0 0 0 2.80 19.06
  L 12.08 19.06
  A 0.67 0.67 0.0 0 0 12.75 18.39
  L 12.75 5.61
  Z
  M 14.09 7.49
  L 14.13 16.53
  A 0.42 0.42 0.0 0 0 14.56 16.95
  L 16.95 16.94
  A 4.95 4.76 -0.3 0 0 21.87 12.15
  L 21.87 11.79
  A 4.95 4.76 -0.3 0 0 16.89 7.06
  L 14.50 7.07
  A 0.42 0.42 0.0 0 0 14.09 7.49
  Z"
                    />
                    <path fill="#000000" d="
  M 5.83 12.77
  Q 5.23 12.76 4.64 12.59
  Q 4.28 12.48 4.25 12.12
  Q 4.18 11.37 4.93 11.36
  Q 6.24 11.34 7.13 10.45
  Q 7.88 9.69 8.93 9.90
  Q 10.28 10.19 10.58 11.64
  A 2.05 2.04 76.7 0 1 9.11 14.02
  Q 7.74 14.40 6.74 13.21
  A 1.21 1.19 -18.8 0 0 5.83 12.77
  Z
  M 7.87 11.60
  A 0.46 0.45 58.3 0 0 7.79 11.96
  Q 7.93 12.59 8.56 12.73
  Q 8.99 12.82 9.12 12.40
  Q 9.30 11.77 8.77 11.43
  Q 8.25 11.09 7.87 11.60
  Z"
                    />
                </g>
            </svg>
            {{--            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0.00 0.00 24.00 24.00" width="24.00" height="24.00">--}}
            {{--               --}}
            {{--            </svg>--}}
        </div>

        <!-- Social -->
        <div class="social">
            <ul>
                <li class="hover magnetic"><a href="#">Ig</a></li>
                <li class="hover magnetic"><a href="#">Fb</a></li>
                <li class="hover magnetic"><a href="#">Tw</a></li>
                <li class="hover magnetic"><a href="#">Db</a></li>
            </ul>
        </div>

        <!-- Logo -->
        <div class="logo hover" style="background-image: url('{{asset('storage/favicon/favicon.png')}}');"></div>

        <!-- Icon "Full Menu" -->
        {{-- <div class="page-zoom zoom--}}{{-- magnetic hover--}}{{--" --}}{{--data-tooltip="نمایش تمام صفحات" data-position="bottom"--}}{{-->
             <span></span>
             <span></span>
             <span></span>
         </div>--}}

        <!-- Page Transition List -->
        <div class="animation-wrap hover" data-tooltip="انتقال صفحه" data-position="right">
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                 class="show-fade magnetic">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <path
                        d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z"
                        fill="#000000" opacity="0.3"></path>
                    <path
                        d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z"
                        fill="#000000"></path>
                </g>
            </svg>

            <ul class="animation-list">
                <li><span class="hover animation" data-animation="animate-one">ورود</span></li>
            </ul>
        </div>

        <!-- Music -->
        <a class="cursor-sound music-bg">
            <div class="sound">
		        <span class="on">
		        	<i class="feather ft-volume-2"></i>
		        </span>
                <span class="off">
			         <i class="feather ft-volume-x"></i>
		         </span>
            </div>
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>

    </div>
</div>
