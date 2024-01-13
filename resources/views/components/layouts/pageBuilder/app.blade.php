<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{\App\Models\Option::query()->where('option','title')->first()->value}}</title>
    <link rel="icon" href="{{asset('storage/favicon/favicon.png')}}" type="image/x-icon"> <!-- Favicon-->

    <!-- plugin css file  -->
    <link rel="stylesheet" href="{{asset('admin/assets/plugin/datatables/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/plugin/datatables/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/plugin/cropper/cropper.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/plugin/dropify/dist/css/dropify.min.css')}}">

    <link href="{{asset('admin/assets/css/persian-datepicker.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/persian-datepicker.min.css')}}" rel="stylesheet" type="text/css">

    <!-- project css file  -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/ebazar.style.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.1-web/css/brands.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.1-web/css/solid.css')}}">--}}
    <link rel="stylesheet" href="{{asset('pageBuilder/fontawesome-free-6.5.1-web/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('pageBuilder/jqueryDragable/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('pageBuilder/assets/css/ezIcon.css')}}">
@stack('css')
    @livewireStyles
</head>
<body class="rtl_mode" style>
<div id="ebazar-layout" class="theme-blue">


    {{--<!-- sidebar -->
    <div class="sidebar px-4 py-4 py-md-5 me-0">
        <div class="d-flex flex-column h-100">
            <a href="{{route('index')}}" target="_blank" class="mb-0 brand-icon">
                    <span class="logo-icon">
                        <i class="icofont-eye-alt fs-4"></i>
                    </span>
                <span class="logo-text">{{\App\Models\Option::query()->where('option','title')->first()->value}}</span>
            </a>
            <!-- Menu: main ul -->
            <ul class="menu-list flex-grow-1 mt-3">
                <li>
                    <a class="m-link {{Route::is('admin.dashboard')?'active':''}}" wire:navigate.hover
                       href="{{route('admin.dashboard')}}">
                        <i class="icofont-home fs-5"></i>
                        <span>داشبورد</span>
                    </a>
                </li>
                <li>
                    <a class="m-link {{Route::is('admin.categories')?'active':''}}" wire:navigate.hover
                       href="{{route('admin.categories')}}">
                        <i class="icofont-network fs-5"></i>
                        <span>دسته بندی ها</span>
                    </a>
                </li>
                <li>
                    <a class="m-link {{Route::is('admin.users')?'active':''}}" wire:navigate.hover
                       href="{{route('admin.users')}}">
                        <i class="icofont-users-alt-2 fs-5"></i>
                        <span>کاربران</span>
                    </a>
                </li>
                <li class="collapsed" wire:ignore.self>
                    <a class="m-link {{Route::is(['admin.sliders','admin.portfolios','admin.about','admin.contact','admin.blogs'])?'active':''}}"
                       data-bs-toggle="collapse" data-bs-target="#menu-index" href="#">
                        <i class="icofont-ui-home fs-5"></i> <span>صفحه اصلی</span> <span
                            class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse {{Route::is(['admin.sliders','admin.portfolios','admin.about','admin.contact','admin.blogs'])?'show':''}}"
                        id="menu-index">
                        <li><a class="ms-link {{Route::is('admin.sliders')?'active':''}}" wire:navigate.hover
                               href="{{route('admin.sliders')}}">اسلایدر</a></li>
                        <li><a class="ms-link {{Route::is('admin.portfolios')?'active':''}}" wire:navigate.hover
                               href="{{route('admin.portfolios')}}">نمونه کار</a></li>
                        <li><a class="ms-link {{Route::is('admin.about')?'active':''}}" wire:navigate.hover
                               href="{{route('admin.about')}}">درباره ما</a></li>
                        <li><a class="ms-link {{Route::is('admin.contact')?'active':''}}" wire:navigate.hover
                               href="{{route('admin.contact')}}">تماس با ما</a></li>
                        <li><a class="ms-link {{Route::is('admin.blogs')?'active':''}}" wire:navigate.hover
                               href="{{route('admin.blogs')}}">وبلاگ</a></li>
                    </ul>
                </li>
                <li class="collapsed" wire:ignore.self>
                    <a class="m-link {{Route::is(['admin.customers.forms'])?'active':''}}"
                       data-bs-toggle="collapse" data-bs-target="#menu-customers" href="#">
                        <i class="icofont-people fs-5"></i> <span>مشتریان</span> <span
                            class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                    <!-- Menu: Sub menu ul -->
                    <ul class="sub-menu collapse {{Route::is(['admin.customers.forms'])?'show':''}}"
                        id="menu-customers">
                        <li><a class="ms-link {{Route::is('admin.customers.forms')?'active':''}}" wire:navigate.hover
                               href="{{route('admin.customers.forms')}}">فرم ها</a></li>
                    </ul>
                </li>
                <li>
                    <a class="m-link {{Route::is('admin.options')?'active':''}}" wire:navigate.hover
                       href="{{route('admin.options')}}">
                        <i class="icofont-options fs-5"></i>
                        <span>تنظیمات</span>
                    </a>
                </li>
                --}}{{-- <li class="collapsed">
                     <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-product" href="#">
                         <i class="icofont-truck-loaded fs-5"></i> <span>محصولات</span> <span
                             class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                     <!-- Menu: Sub menu ul -->
                     <ul class="sub-menu collapse" id="menu-product">
                         <li><a class="ms-link" href="product-grid.html">گرید محصول</a></li>
                         <li><a class="ms-link" href="product-list.html">لیست محصول</a></li>
                         <li><a class="ms-link" href="product-edit.html">ویرایش محصول</a></li>
                         <li><a class="ms-link" href="product-detail.html">جزئیات محصول</a></li>
                         <li><a class="ms-link" href="product-add.html">افزودن محصول</a></li>
                         <li><a class="ms-link" href="product-cart.html">سبد خرید</a></li>
                         <li><a class="ms-link" href="checkout.html">پرداخت</a></li>
                     </ul>
                 </li>--}}{{--

            </ul>
            <!-- Menu: menu collepce btn -->
            <button type="button" class="btn btn-link sidebar-mini-btn text-light">
                <span class="ms-2"><i class="icofont-bubble-right"></i></span>
            </button>
        </div>
    </div>
--}}
    <!-- main body area -->
    <div class="main px-lg-4 px-md-4">

      {{--  <!-- Body: Header -->
        <div class="header" wire:ignore>
            <nav class="navbar py-4">
                <div class="container-xxl">

                    <!-- header rightbar icon -->
                    <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">
                        <div class="dropdown notifications">
                            <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="icofont-alarm fs-5"></i>
                                <span class="pulse-ring"></span>
                            </a>
                            <div id="NotificationsDiv"
                                 class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-md-end p-0 m-0 mt-3">
                                <div class="card border-0 w380">
                                    <div class="card-header border-0 p-3">
                                        <h5 class="mb-0 font-weight-light d-flex justify-content-between">
                                            <span>اعلان های روز</span>
                                            <span
                                                class="badge text-white">{{count(\App\Models\Log::query()->orderByDesc('created_at')->whereDate('created_at',\Carbon\Carbon::today())->get())}}</span>
                                        </h5>
                                    </div>
                                    <div class="tab-content card-body">
                                        <div class="tab-pane fade show active">
                                            <ul class="list-unstyled list mb-0">
                                                @foreach(\App\Models\Log::query()->orderByDesc('created_at')->whereDate('created_at',\Carbon\Carbon::today())->get() as $item)
                                                    <li class="py-2 mb-1 border-bottom">
                                                        <a href="javascript:" class="d-flex">
                                                            <img class="avatar rounded-circle"
                                                                 src="{{asset('storage/users/user-'.$item->user->id.'/'.$item->user->avatar)}}"
                                                                 alt="">
                                                            <div class="flex-fill ms-2">
                                                                <p class="d-flex justify-content-between mb-0 "><span
                                                                        class="font-weight-bold">{{$item->user->name}}</span>
                                                                    <small>{{jdate($item->created_at)->ago()}}</small>
                                                                </p>
                                                                <span class="">{{$item->text}}
                                                                    --}}{{--<span class="badge bg-success">اضاف</span>--}}{{--</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
--}}{{--                                    <a class="card-footer text-center border-top-0" href="#"> مشاهده تمام اعلان ها</a>--}}{{--
                                </div>
                            </div>
                        </div>
                        <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                            <div class="u-info me-2">
                                <p class="mb-0 text-end line-height-sm "><span
                                        class="font-weight-bold">{{Auth::user()->name}}</span></p>
                                <small>مشخصات مدیر</small>
                            </div>
                            <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button"
                               data-bs-toggle="dropdown" data-bs-display="static">
                                <img class="avatar lg rounded-circle img-thumbnail"
                                     src="{{asset('storage/users/user-'.Auth::user()->id.'/'.Auth::user()->avatar)}}"
                                     alt="profile">
                            </a>
                            <div
                                class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                <div class="card border-0 w280">
                                    <div class="card-body pb-0">
                                        <div class="d-flex py-1">
                                            <img class="avatar rounded-circle"
                                                 src="{{asset('storage/users/user-'.Auth::user()->id.'/'.Auth::user()->avatar)}}"
                                                 alt="profile">
                                            <div class="flex-fill ms-3">
                                                <p class="mb-0"><span
                                                        class="font-weight-bold">{{Auth::user()->name}}</span></p>
                                                <small class="">Johnquinn@gmail.com</small>
                                            </div>
                                        </div>

                                        <div>
                                            <hr class="dropdown-divider border-dark">
                                        </div>
                                    </div>
                                    <div class="list-group m-2 ">
                                        <a href="{{route('front.dashboard')}}"
                                           class="list-group-item list-group-item-action border-0 "><i
                                                class="icofont-ui-user fs-5 me-3"></i>داشبورد کاربر</a>
                                        <a href="{{route('logout')}}"
                                           class="list-group-item list-group-item-action border-0 "><i
                                                class="icofont-logout fs-5 me-3"></i>خروج</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="setting ms-2">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#Settingmodal"><i
                                    class="icofont-gear-alt fs-5"></i></a>
                        </div>
                    </div>

                    <!-- menu toggler -->
                    <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button"
                            data-bs-toggle="collapse" data-bs-target="#mainHeader">
                        <i class="icofont-layout"></i>
                    </button>

                    <!-- main menu Search-->
                    <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">
                        <div class="input-group flex-nowrap input-group-lg">
                            <input type="search" class="form-control" placeholder="جستجو" aria-label="search"
                                   aria-describedby="addon-wrapping">
                            <button type="button" class="input-group-text" id="addon-wrapping"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>

                </div>
            </nav>
        </div>
--}}
        <!-- Body: Body -->
        <div class="body d-flex py-3">
            <div class="container-xxl">
                {{$slot}}
            </div>
        </div>

       {{-- <!-- Modal Custom Settings-->
        <div class="modal fade right" id="Settingmodal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog  modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تنظیمات سفارشی</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>
                    <div class="modal-body custom_setting">
                        <!-- Settings: Color -->
                        <div class="setting-theme pb-3">
                            <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i
                                    class="icofont-color-bucket fs-4 me-2 text-primary"></i>تنظیمات رنگ قالب</h6>
                            <ul class="list-unstyled row row-cols-3 g-2 choose-skin mb-2 mt-2">
                                <li data-theme="indigo">
                                    <div class="indigo"></div>
                                </li>
                                <li data-theme="tradewind">
                                    <div class="tradewind"></div>
                                </li>
                                <li data-theme="monalisa">
                                    <div class="monalisa"></div>
                                </li>
                                <li data-theme="blue" class="active">
                                    <div class="blue"></div>
                                </li>
                                <li data-theme="cyan">
                                    <div class="cyan"></div>
                                </li>
                                <li data-theme="green">
                                    <div class="green"></div>
                                </li>
                                <li data-theme="orange">
                                    <div class="orange"></div>
                                </li>
                                <li data-theme="blush">
                                    <div class="blush"></div>
                                </li>
                                <li data-theme="red">
                                    <div class="red"></div>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar-gradient py-3">
                            <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i
                                    class="icofont-paint fs-4 me-2 text-primary"></i>گرادیان نوار کناری</h6>
                            <div class="form-check form-switch gradient-switch pt-2 mb-2">
                                <input class="form-check-input" type="checkbox" id="CheckGradient">
                                <label class="form-check-label" for="CheckGradient">فعال کردن گرادیان! ( نوار کناری
                                    )</label>
                            </div>
                        </div>
                        <!-- Settings: Template dynamics -->
                        <div class="dynamic-block py-3">
                            <ul class="list-unstyled choose-skin mb-2 mt-1">
                                <li data-theme="dynamic">
                                    <div class="dynamic"><i class="icofont-paint me-2"></i> برای تنظیمات پویا کلیک کنید
                                    </div>
                                </li>
                            </ul>
                            <div class="dt-setting">
                                <ul class="list-group list-unstyled mt-1">
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                        <label>رنگ اصلی</label>
                                        <button id="primaryColorPicker"
                                                class="btn bg-primary avatar xs border-0 rounded-0"></button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                        <label>رنگ ثانویه</label>
                                        <button id="secondaryColorPicker"
                                                class="btn bg-secondary avatar xs border-0 rounded-0"></button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                        <label class="text-muted">رنگ نمودار 1</label>
                                        <button id="chartColorPicker1"
                                                class="btn chart-color1 avatar xs border-0 rounded-0"></button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                        <label class="text-muted">رنگ نمودار 2</label>
                                        <button id="chartColorPicker2"
                                                class="btn chart-color2 avatar xs border-0 rounded-0"></button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                        <label class="text-muted">رنگ نمودار 3</label>
                                        <button id="chartColorPicker3"
                                                class="btn chart-color3 avatar xs border-0 rounded-0"></button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                        <label class="text-muted">رنگ نمودار 4</label>
                                        <button id="chartColorPicker4"
                                                class="btn chart-color4 avatar xs border-0 rounded-0"></button>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                        <label class="text-muted">رنگ نمودار 5</label>
                                        <button id="chartColorPicker5"
                                                class="btn chart-color5 avatar xs border-0 rounded-0"></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Settings: Font -->
                        <div class="setting-font py-3">
                            <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i
                                    class="icofont-font fs-4 me-2 text-primary"></i> تنظیمات فونت</h6>
                            <ul class="list-group font_setting mt-1">
                                <li class="list-group-item py-1 px-2">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="radio" name="font" id="font-poppins"
                                               value="font-poppins">
                                        <label class="form-check-label" for="font-poppins">
                                            فونت گوگل پاپینس
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item py-1 px-2">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="radio" name="font" id="font-opensans"
                                               value="font-opensans" checked="">
                                        <label class="form-check-label" for="font-opensans">
                                            فونت گوگل اوپن سانس
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item py-1 px-2">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="radio" name="font" id="font-montserrat"
                                               value="font-montserrat">
                                        <label class="form-check-label" for="font-montserrat">
                                            فونت گوگل مونت
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item py-1 px-2">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="radio" name="font" id="font-mukta"
                                               value="font-mukta">
                                        <label class="form-check-label" for="font-mukta">
                                            فونت گوگل موتکا
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Settings: Light/dark -->
                        <div class="setting-mode py-3">
                            <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i
                                    class="icofont-layout fs-4 me-2 text-primary"></i>چیدمان کنتراست</h6>
                            <ul class="list-group list-unstyled mb-0 mt-1">
                                <li class="list-group-item d-flex align-items-center py-1 px-2">
                                    <div class="form-check form-switch theme-switch mb-0">
                                        <input class="form-check-input" type="checkbox" id="theme-switch">
                                        <label class="form-check-label" for="theme-switch">فعال کردن حالت تاریک!</label>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center py-1 px-2">
                                    <div class="form-check form-switch theme-high-contrast mb-0">
                                        <input class="form-check-input" type="checkbox" id="theme-high-contrast">
                                        <label class="form-check-label" for="theme-high-contrast">فعال کردن کنتراست
                                            بالا</label>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex align-items-center py-1 px-2">
                                    <div class="form-check form-switch theme-rtl mb-0">
                                        <input class="form-check-input" type="checkbox" id="theme-rtl">
                                        <label class="form-check-label" for="theme-rtl">فعال کردن حالت چپ چین!</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-start">
                        <button type="button" class="btn btn-white border lift" data-dismiss="modal">بستن</button>
                        <button type="button" class="btn btn-primary lift">ذخیره تنظبمات</button>
                    </div>
                </div>
            </div>
        </div>
--}}
    </div>

</div>

<!-- Jquery Core Js -->
<script src="{{asset('admin/assets/bundles/libscripts.bundle.js')}}"></script>
{{--<script src="{{asset('admin/ckeditorDocument/ckeditor.js')}}"></script>--}}
{{--<script src="{{asset('admin/assets/plugin/cropper/cropper.min.js')}}"></script>--}}
{{--<script src="{{asset('admin/assets/plugin/cropper/cropper-init.js')}}"></script>--}}
<script src="{{asset('admin/assets/bundles/dropify.bundle.js')}}"></script>

<!-- Plugin Js -->
<script src="{{asset('admin/assets/bundles/apexcharts.bundle.js')}}"></script>
<script src="{{asset('admin/assets/bundles/dataTables.bundle.js')}}"></script>


<script src="{{asset('admin/assets/plugin/date-persian/jquery.persiandatepicker.js')}}"></script>
<script src="{{asset('admin/assets/plugin/date-persian/jquery.Bootstrap-PersianDateTimePicker.js')}}"></script>
<script src="{{asset('admin/assets/plugin/date-persian/persian-date.min.js')}}"></script>
<script src="{{asset('admin/assets/plugin/date-persian/persian-datepicker.js')}}"></script>
<script src="{{asset('admin/assets/plugin/date-persian/persian-datepicker.min.js')}}"></script>

<!-- Jquery Page Js -->
{{--<script src="{{asset('admin/js/template.js')}}"></script>--}}
<script src="{{asset('admin/js/page/index.js')}}"></script>
<script src="{{asset('pageBuilder/fontawesome-free-6.5.1-web/js/all.js')}}"></script>
<script src="{{asset('pageBuilder/jqueryDragable/jquery-ui.js')}}"></script>
<script src="{{asset('pageBuilder/jqueryDragable/jquery.ui.touch-punch.js')}}"></script>
{{--<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>--}}

<script>
    // $(window).ready(function () {
    //     var icon = $('.ez');
    //
    //     for (var i = 0; i < icon.length; i++) {
    //         var a = icon[i];
    //         for (var ii = 1; ii <= 50; ii++) {
    //             a.innerHTML += "<span class='path" + ii + "'></span>"
    //         }
    //     }
    // })
</script>

@stack('js')
@livewireScripts
</body>

</html>
