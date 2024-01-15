<div>
    @push('css')
        <style>
            .selected {
                border-bottom: 2px solid blue;
            }

            .btn.b1:focus, .btn.b2:focus {
                box-shadow: unset !important;
            }

            .btnNoFocus {
                box-shadow: unset !important;
            }
        </style>
        <style>
            .userImageDiv {
                width: 22%;
                height: 37%;
                left: 0;
                right: 0;
                bottom: 15%;
            }

            .backgroundImage {
                max-height: 150px;
                color: white;
                position: absolute;
                object-fit: cover;
                object-position: center center;
                z-index: 1;
                width: 100%;
                border-radius: 0px;

            }

            .userImage {
                width: 100px;
                height: 100px;
                color: white;
                z-index: 5;
                border: 1px solid grey;
                object-fit: contain;
                border-radius: 100%;
                margin-top: 95px;
            }

            .userDiv {
                width: 100%;
                display: flex;
                flex-direction: column;
                -webkit-box-align: center;
                align-items: center;
                position: relative;
                z-index: 5;
                margin-bottom: 22px;
                font-family: iransans;
            }

            .user-info-data {
                display: flex;
                flex-direction: column;
                -webkit-box-pack: start;
                justify-content: flex-start;
                -webkit-box-align: center;
                align-items: center;
                margin-left: 0px;
                z-index: 5;
                margin-bottom: 8px;
                width: 100%;

            }

            .MuiTypography-root.title {
                font-weight: bold;
                font-size: 18px;
                margin-top: 5px;
            }

            .MuiTypography-root {
                margin: 0px;
                font-weight: 400;
                line-height: 1.5;
                font-size: 15px;
                color: inherit;
                font-family: inherit;
                padding: 0px 8px;
                z-index: 5;
                white-space: break-spaces;
                overflow: hidden;
                text-overflow: ellipsis;
                text-align: center;
                width: 100%;
                unicode-bidi: plaintext;
                overflow-wrap: break-word;

            }

            .col-12.fixed-bottom.mx-auto {
                border-radius: 20px 20px 0 0;
                background-color: rgba(32, 32, 32, .6);
                max-width: 600px;
                backdrop-filter: blur(5px)
            }

            .row.p-2.justify-content-end {
                background: rgba(0, 0, 0, 0.15);
                border-radius: 8px;
                backdrop-filter: blur(5px)
            }

            .modal-body {
                box-shadow: inset rgb(0 0 0 / 70%) 0px 4px 10px -10px;
            }

            .modal-body > ul > li {
                background-color: #EDEDED !important;
                border-top-width: 1px !important;
                transition: ease-in-out 500ms;
                border-radius: 16px !important;
            }

            .modal-body > ul > li p {
                opacity: 0.6;
                transition: ease-in-out 500ms;
            }

            .modal-body > ul > li:hover {
                background-color: #fff8d4 !important;
                color: #0bad00 !important;
                border-color: #0bad00 !important;
                transition: ease-in-out 500ms;
            }

            .modal-body > ul > li:hover p {
                opacity: 1;
                transition: ease-in-out 500ms;
            }

            .modal-content {
                border-radius: 15px !important;

            }
        </style>
    @endpush

    <div style="max-width: 600px" class="container">
        <div class="row">
            <div class="col-12" style="border-radius: 20px;box-shadow: rgba(0,0,0,0.2) 0 0 20px;">
                <div class="row p-2 justify-content-end flex-nowrap">
                    <div class="col-auto px-1 align-self-center">
                        ezy.company/{{$profile->link}}
                    </div>
                    <div class="col-auto px-1 align-self-center">|</div>
                    <div class="col-auto px-1">
                        <button class="btn p-1 text-info">
                            <i class="icofont-share"></i>
                        </button>
                    </div>
                    <div class="col-auto px-1">
                        <button class="btn p-1 text-info">
                            <i class="icofont-ui-copy"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-12 my-3">
                <div class="row p-2 flex-nowrap">
                    <div class="col-11" data-bs-target="#profileOptions" data-bs-toggle="modal"
                         wire:click="getProfileOptions">
                        <div class="userDiv">
                            <img src="{{asset('storage/pb/profiles/profile-'.$profile->id.'/'.$profile->bg_img)}}"
                                 alt="" class="backgroundImage"
                                 style="border-radius: {{$profile->bg_border==100?'50% / 0 0 100% 100%':''}}">
                            <img
                                src="{{asset($profile->img?'storage/pb/profiles/profile-'.$profile->id.'/'.$profile->img:'userGray.png')}}"
                                alt="" style="border-radius: {{$profile->img_border}}%"
                                class="userImage">
                            <div class="user-info-data">
                                <p class="MuiTypography-root title">{{$profile->title}}</p>
                                <p class="MuiTypography-root">{!! $profile->subtitle !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 text-center w-auto rounded" style="background-color: rgb(239, 239, 239);">
                        <i class="fa fa-thumbtack top-50 position-relative translate-middle-y"></i>
                    </div>
                </div>
            </div>
            <div id="sortable" style="cursor: grab;margin-bottom: 6rem !important;" wire:ignore.self>
                @foreach($blocks as $block)
                    <div class="col-12 my-3">
                        <div class="row p-2 flex-nowrap">
                            <div class="col-11" data-bs-target="#blockOptions" data-bs-toggle="modal"
                                 wire:click="blockOptions({{$block->id}})">
                                <div class="row justify-content-center">
                                    <div class="col-12 text-center">
                                        <p class="text-center">{{$block->blockOption->blockTitle}}</p>
                                    </div>
                                    @foreach($block->pbOption()->get() as $option)
                                        <div class="col-6 text-center p-1">
                                            <button dir="rtl" onload="setPaths();"
                                                    class="btn border-info w-100 rounded-pill overflow-hidden text-truncate px-1">
                                                <i class="{{$option->icon}} text-info mx-2 align-middle iii"
                                                   style="font-size: 25px !important;">
                                                    {!! $this->getIconPaths() !!}
                                                </i>
                                                {{$this->getBlockTitle($option->pivot)}}
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-1 text-center w-auto rounded" style="background-color: rgb(239, 239, 239);">
                                <i class="fa fa-arrows-up-down-left-right top-50 position-relative translate-middle-y"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-12 fixed-bottom mx-auto" style="">
                <div class="row justify-content-around flex-nowrap">
                    <div class="col-auto">
                        <img src="{{asset('pageBuilder/assets/img/setting-2-svgrepo-com.png')}}" alt="" class="p-2">
                    </div>
                    <div class="col-auto">
                        <img src="{{asset('pageBuilder/assets/img/insertPlus.png')}}" wire:click="clearVariables" alt=""
                             class="p-2 position-relative" style="top: -50%"
                             data-bs-toggle="modal"
                             data-bs-target="#insertPlus">
                    </div>
                    <div class="col-auto">
                        <img src="{{asset('pageBuilder/assets/img/preview.png')}}" alt="" class="p-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- insertPlus -->
    <div class="modal fade rounded" wire:ignore.self id="insertPlus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <h5 class="modal-title mx-auto" id="insertPlusAddBlock">افزودن بلوک جدید</h5>
                    <button type="button" style="width: 20px;height: 20px;"
                            class="me-1 close btn border-dark border-2 rounded-circle p-0" data-bs-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true" class="fa fa-close">{{--&times;--}}</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color: rgb(241, 243, 246);">
                    <ul class="list-group pointer">
                        <li
                            data-bs-toggle="modal"
                            data-bs-target="#insertMessengers"
                            wire:click="getOptions('messenger',true)"
                            class="list-group-item my-1 border-dark px-4">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <i class="ez ez-chat-writing"></i>
                                </div>
                                <div class="col-auto">
                                    <h4>پیام رسان ها</h4>
                                    <p class="m-0">اتصال فوری به تمام پیام رسان ها</p>
                                </div>
                            </div>
                        </li>
                        <li
                            class="list-group-item my-1 border-dark px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#insertMessengers"
                            wire:click="getOptions('social',true)">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <i class="ez ez-social-instagram"></i>
                                </div>
                                <div class="col-auto">
                                    <h4>شبکه های اجتماعی</h4>
                                    <p class="m-0">افزودن شبکه های اجتماعی</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#insertMessengers"
                            wire:click="getOptions('call',true)">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <i class="fa fa-phone fs-4"></i>
                                </div>
                                <div class="col-auto">
                                    <h4>تماس و راه های ارتباطی</h4>
                                    <p class="m-0">برقراری ارتباط از طریق شماره موبایل، پیامک، تلفن ثابت و ...</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <i class="ez ez-vcf"></i>
                                </div>
                                <div class="col-auto">
                                    <h4>ساخت ذخیره خودکار مخاطب</h4>
                                    <p class="m-0">فایل vcf خود را بسازید</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <i class="ez ez-video-library"></i>
                                </div>
                                <div class="col-auto">
                                    <h4>ویدئو</h4>
                                    <p class="m-0">امکان افزودن ویدئو</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <i class="ez ez-link"></i>
                                </div>
                                <div class="col-auto">
                                    <h4>لینک</h4>
                                    <p class="m-0">ساخت لینک دلخواه</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <i class="ez ez-location"></i>
                                </div>
                                <div class="col-auto">
                                    <h4>مسیریابی</h4>
                                    <p class="m-0">نمایش آدرس بر روی نقشه</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4">
                            <div class="row">
                                <div class="col-auto align-self-center">
                                    <i class="ez ez-text-align-center"></i>
                                </div>
                                <div class="col-auto">
                                    <h4>متن یا توضیح</h4>
                                    <p class="m-0">متن شامل عنوان، زیر عنوان و توضیحات</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{--massengers--}}
    <div class="modal fade rounded" wire:ignore.self id="insertMessengers" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <h5 class="modal-title mx-auto">{{$title}}</h5>
                    <button type="button" style="width: 20px;height: 20px;"
                            class="me-1 close btn border-dark border-2 rounded-circle p-0"
                            data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-close">{{--&times;--}}</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color: rgb(241, 243, 246);">
                    <div class="row justify-content-center">
                        @foreach($options as $item)
                            <div class="col-4 my-1 px-1">
                                <button class="btn w-100" wire:click="insertBlock({{$item->id}})"
                                        style="background-color: {{$item->color}};border: 1px solid #c4c4c4"
                                        data-bs-toggle="modal"
                                        data-bs-target="#blockOptions"
                                >
                                    <div class="row justify-content-center">
                                        <div class="col-8 align-self-center ps-0" style="text-align: right">
                                            {{$item->title}}
                                        </div>
                                        <div class="col-4 align-self-center pe-0">
                                            <i style="font-size: 25px !important;"
                                               class="align-middle {{$item->icon}}">
                                                {!! $this->getIconPaths() !!}
                                            </i>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--options--}}
    <div class="modal fade rounded" wire:ignore.self id="blockOptions" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" style="width: 20px;height: 20px"
                            class="ms-2 close btn p-0" wire:click="deleteBlock">
                        <span class="fa fa-trash text-danger">{{--&times;--}}</span>
                    </button>
                    <h5 class="modal-title mx-auto">{{$title}}</h5>
                    <button type="button" style="width: 20px;height: 20px;"
                            class="me-1 close btn border-dark border-2 rounded-circle p-0"
                            data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-close">{{--&times;--}}</span>
                    </button>
                </div>

                <div class="modal-body" style="background-color: rgb(241, 243, 246);" wire:ignore.self>
                    <div class="row">
                        <div class="col-6 my-2 my-sm-0 text-center">
                            <button class="btn b1 selected" role="button" data-bs-toggle="collapse"
                                    data-bs-target="#properties"
                                    aria-expanded="false" aria-controls="properties">مشخصات
                            </button>
                        </div>
                        <div class="col-6 my-2 my-sm-0 text-center">
                            <button class="btn b2" role="button" data-bs-toggle="collapse" data-bs-target="#moreOptions"
                                    aria-expanded="false" aria-controls="moreOptions">تنظیمات بیشتر
                            </button>
                        </div>
                        <div class="col-12 my-3 accordion accordion-flush" id="accordionParent123">
                            <div class="collapse text-black accordion-collapse show" id="properties"
                                 data-bs-parent="#accordionParent123" wire:ignore.self>
                                <div class="row">
                                    <div class="col-12">
                                        <button data-bs-target="#insertMessengers" data-bs-toggle="modal"
                                                wire:click="getOptions('{{$title}}',false)"
                                                class="text-success w-100 text-center btn bg-success bg-opacity-10 border-success btnNoFocus"
                                                style="border: 2px dashed">
                                            <i class="icofont-plus"></i>
                                            آیتم دیگری به همین بلوک اضافه کنید
                                        </button>
                                    </div>
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div style="cursor: grab;" id="sortable1">
                                                @foreach($blockItems as $key=>$item)
                                                    <div class="my-1 col-12">
                                                        <div class="row bg-white border border-3 mx-0">
                                                            <div class="col-11">
                                                                <button onclick="removeShow({{$item->id}})"
                                                                        class="btn w-100 bg-white py-3 btnNoFocus"
                                                                        role="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#item{{$item->id}}"
                                                                        aria-expanded="false"
                                                                        aria-controls="item{{$item->id}}">
                                                                    <div class="row">
                                                                        <div class="col-1">
                                                                            <i class="fa fa-arrows-up-down-left-right"></i>
                                                                        </div>
                                                                        <div class="col-auto">
                                                                            {{$item->title}} {{strlen($blockItemConnectionWay[$item->id])>=1?'( '.$blockItemConnectionWay[$item->id].' )':''}}
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </div>
                                                            <div class="col-1 p-1 text-center position-relative">
                                                                <button wire:click="deleteBlockItem({{$item->id}})"
                                                                        type="button"
                                                                        class="btn btnNoFocus p-0 position-absolute start-0 top-0 bottom-0"
                                                                        style="right: 0">
                                                                    <i class="icofont-trash text-danger fs-6"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="accordion accordion-flush"
                                                             id="accordionParent{{$item->id}}">
                                                            <div wire:ignore
                                                                 class="collapse text-black accordion-collapse blockItemAccordion bg-white border border-3 border-top-0"
                                                                 id="item{{$item->id}}"
                                                                 data-bs-parent="#accordionParent{{$item->id}}">
                                                                <div class="row">
                                                                    <div class="col-12 my-3 px-4">
                                                                        <label class="text-black-50">عنوان آیتم
                                                                            {{$item->title}}</label>
                                                                        <input type="text" class="my-2 form-control"
                                                                               wire:model="blockItemTitle.{{$item->id}}"
                                                                               placeholder="عنوان آیتم {{$item->title}} خود را وارد کنید">
                                                                        <p class="text-black-50 small">در صورت تمایل
                                                                            میتوانید
                                                                            برای این آیتم یک عنوان انتخاب کنید</p>
                                                                    </div>
                                                                    <div class="col-12 my-3 px-4">
                                                                        <label
                                                                            class="text-black-50">آیدی {{$item->title}}</label>
                                                                        <input type="text" class="my-2 form-control"
                                                                               value="{{$item->connectionWay}}"
                                                                               wire:model.live="blockItemConnectionWay.{{$item->id}}"
                                                                               placeholder="آیدی {{$item->title}} خود را وارد کنید">
                                                                        <p class="text-black-50 small">فقط
                                                                            آیدی {{$item->title}} خود
                                                                            را
                                                                            وارد کنید. مثلا mimalef70. از وارد کردن لینک
                                                                            تلگرام
                                                                            به صورت t.me خودداری کنید.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse text-black accordion-collapse px-3" id="moreOptions" wire:ignore.self
                                 data-bs-parent="#accordionParent123">
                                <div class="row">
                                    <div class="col-12 my-3">
                                        <div class="row justify-content-around">
                                            <div class="col-6">
                                                نمایش بلوک
                                            </div>
                                            <div class="col-6 text-start">
                                                <input type="checkbox" wire:model="blockVisibility"
                                                       value="{{$blockVisibility}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 my-3">
                                        <label class="text-black-50">عنوان بلوک</label>
                                        <input type="text" class="my-2 form-control"
                                               wire:model="blockTitle"
                                               placeholder="عنوان بلوک خود را وارد کنید">
                                        <p class="text-black-50 small">در صورت تمایل می‌توانید برای این بلوک یک عنوان
                                            انتخاب کنید</p>
                                    </div>
                                    <div class="col-12 my-3">
                                        <label class="text-black-50">عرض آیتم</label>
                                        <div class="row justify-content-center">
                                            <div class="col-3 text-center">
                                                @foreach($options as $item)
                                                    @if($loop->index == 0)
                                                        <label class="btn w-100" for="blockItemWidthFull"
                                                               style="background-color: {{$item->color}};border: 1px solid #c4c4c4"
                                                        >
                                                            <div class="row justify-content-center">
                                                                <div class="col-8 align-self-center ps-0"
                                                                     style="text-align: right">
                                                                    {{$item->title}}
                                                                </div>
                                                                <div class="col-4 align-self-center pe-0">
                                                                    <i style="font-size: 25px !important;"
                                                                       class="align-middle {{$item->icon}}">
                                                                        {!! $this->getIconPaths() !!}
                                                                    </i>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    @endif
                                                @endforeach
                                                <div class="row justify-content-center mt-3">
                                                    <div class="col-auto">
                                                        <input type="radio" name="blockItemWidth"
                                                               id="blockItemWidthFull" class="">
                                                    </div>
                                                    <div class="col-auto">
                                                        <label for="blockItemWidthFull">تمام عرض</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4"
                                                 style="border-left: 1px solid gray;border-right: 1px solid gray;">
                                                <div class="row">
                                                    @foreach($options as $item)
                                                        @if($loop->index < 2)
                                                            <div class="col-6 px-1">
                                                                <label class="btn w-100" for="blockItemWidthHalf"
                                                                       style="background-color: {{$item->color}};border: 1px solid #c4c4c4">
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-8 align-self-center ps-0"
                                                                             style="text-align: right">
                                                                            {{$item->title}}
                                                                        </div>
                                                                        <div class="col-4 align-self-center pe-0">
                                                                            <i style="font-size: 25px !important;"
                                                                               class="align-middle {{$item->icon}}">
                                                                                {!! $this->getIconPaths() !!}
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    <div class="row justify-content-center mt-3">
                                                        <div class="col-auto">
                                                            <input type="radio" name="blockItemWidth"
                                                                   id="blockItemWidthHalf" class="">
                                                        </div>
                                                        <div class="col-auto">
                                                            <label for="blockItemWidthHalf">نصف / نصف</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="row">
                                                    @foreach($options as $item)
                                                        @if($loop->index < 4)
                                                            <div class="col-3 px-1">
                                                                <label class="btn w-100" for="blockItemWidthCompress"
                                                                       style="background-color: {{$item->color}};border: 1px solid #c4c4c4">
                                                                    <i style="font-size: 25px !important;"
                                                                       class="align-middle {{$item->icon}}">
                                                                        {!! $this->getIconPaths() !!}
                                                                    </i>
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    <div class="row justify-content-center mt-3">
                                                        <div class="col-auto">
                                                            <input type="radio" name="blockItemWidth"
                                                                   id="blockItemWidthCompress" class="">
                                                        </div>
                                                        <div class="col-auto">
                                                            <label for="blockItemWidthCompress">فشرده</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 my-3">
                                        <label class="text-black-50">نوع حاشیه بلوک</label>
                                        <div class="row bg-white p-3">

                                            @foreach($options as $item)
                                                @if($loop->index < 4)
                                                    <div class="col-6 my-3">
                                                        <label class="btn w-100"
                                                               for="blockItemBorderRadius{{$item->id}}"
                                                               style="background-color: {{$item->color}};border: 1px solid black;
                                                               border-radius: {{$loop->index==0?'0':''}}{{--{{$loop->index==1?'10px':''}}--}}{{$loop->index==2?'10px':''}}{{$loop->index==3?'100px':''}};
                                                               "
                                                        >
                                                            <div class="row justify-content-around">
                                                                <div class="col-auto align-self-center ps-0"
                                                                     style="text-align: right">
                                                                    {{$item->title}}
                                                                </div>
                                                                <div class="col-auto align-self-center pe-0">
                                                                    <i style="font-size: 25px !important;"
                                                                       class="align-middle {{$item->icon}}">
                                                                        {!! $this->getIconPaths() !!}
                                                                    </i>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <div class="row justify-content-center mt-3">
                                                            <div class="col-auto">
                                                                <input type="radio" name="blockItemBorderRadius"
                                                                       id="blockItemBorderRadius{{$item->id}}" class="">
                                                            </div>
                                                            {{--<div class="col-auto">
                                                                <label for="blockItemWidthFull">تمام عرض</label>
                                                            </div>--}}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-outline-info" data-bs-dismiss="modal" wire:click="clearInputs">
                                انصراف
                            </button>
                            <button class="btn btn-info text-white" data-bs-dismiss="modal" wire:click="submitPbOption">
                                ذخیره
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--profile Options--}}
    <div class="modal fade rounded" wire:ignore.self id="profileOptions" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered {{--modal-lg--}}">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <h5 class="modal-title mx-auto">لوگو و کاور</h5>
                    <button type="button" style="width: 20px;height: 20px;"
                            class="me-1 close btn border-dark border-2 rounded-circle p-0"
                            data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-close">{{--&times;--}}</span>
                    </button>
                </div>

                <div class="modal-body" style="background-color: rgb(241, 243, 246);">
                    <div class="row">
                        <div class="col-6 my-2 my-sm-0 text-center">
                            <button class="btn b1 selected" role="button" data-bs-toggle="collapse"
                                    data-bs-target="#profileProperties"
                                    aria-expanded="false" aria-controls="profileProperties">مشخصات
                            </button>
                        </div>
                        <div class="col-6 my-2 my-sm-0 text-center">
                            <button class="btn b2" role="button" data-bs-toggle="collapse"
                                    data-bs-target="#profileMoreOptions"
                                    aria-expanded="false" aria-controls="profileMoreOptions">تنظیمات بیشتر
                            </button>
                        </div>
                        <div class="col-12 my-3 accordion accordion-flush" id="accordionParentProfile">
                            <div class="collapse text-black accordion-collapse show" id="profileProperties"
                                 data-bs-parent="#accordionParentProfile" wire:ignore.self>
                                <div class="row">
                                    <div class="col-12 my-3">
                                        <label class="text-black-50 my-1">عنوان *</label>
                                        <input class="form-control rounded" wire:model="profileTitle" type="text">
                                    </div>
                                    <div class="col-12 my-3">
                                        <label class="text-black-50 my-1">زیرعنوان</label>
                                        <input class="form-control rounded" wire:model="profileSubtitle"
                                               type="text">
                                    </div>
                                    <div class="col-12 my-3">
                                        <label class="text-black-50 my-1">بارگذاری تصویر پروفایل</label>
                                        <div class="position-relative w-100 rounded text-center py-2 align-middle"
                                             style="background-color: #cfffcf;border: 2px dashed green;height: 150px">
                                            <div class="position-absolute h-100 w-100 top-50 translate-middle-y">
                                                <img
                                                    src="{{$profileImg?$profileImg->temporaryUrl():asset('storage/pb/profiles/profile-'.$profile->id.'/'.$profile->img)}}"
                                                    class="position-absolute h-100 py-2 mx-auto start-0"
                                                    style="right: 0">
                                                <input type="file" class="opacity-0 h-100 w-100"
                                                       wire:model="profileImg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 my-3">
                                        <label class="text-black-50 my-1">بارگذاری تصویر کاور</label>
                                        <div class="position-relative w-100 rounded text-center py-2 align-middle"
                                             style="background-color: #cfffcf;border: 2px dashed green;height: 150px">
                                            <div class="position-absolute h-100 w-100 top-50 translate-middle-y">
                                                <img
                                                    src="{{$profileBgImg?$profileBgImg->temporaryUrl():asset('storage/pb/profiles/profile-'.$profile->id.'/'.$profile->bg_img)}}"
                                                    class="position-absolute h-100 py-2 mx-auto start-0"
                                                    style="right: 0">
                                                <input type="file" class="opacity-0 h-100 w-100"
                                                       wire:model="profileBgImg">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="collapse text-black accordion-collapse" id="profileMoreOptions"
                                 data-bs-parent="#accordionParentProfile">
                                <div class="row">
                                    <div class="col-12 my-3">
                                        <label class="text-black-50 my-1">انتخاب طرح کاور</label>
                                        <div class="row bg-white my-2">
                                            <div class="col-6 my-4 text-center">
                                                <label class="w-100" style="height: 100px;border: 1px solid black"
                                                       for="radioTriangle"></label>
                                                <input type="radio" class="mt-3" id="radioTriangle"
                                                       wire:model="profileBgBorder" value="0"
                                                       {{$profileBgBorder==0?'checked':''}} name="bgStyle">
                                            </div>
                                            <div class="col-6 my-4 text-center">
                                                <label class="w-100"
                                                       style="height: 100px;border: 1px solid black;border-radius: 50% / 0 0 100% 100%"
                                                       for="radioRounded"></label>
                                                <input type="radio" class="mt-3" id="radioRounded"
                                                       wire:model="profileBgBorder"
                                                       {{$profileBgBorder==100?'checked':''}} name="bgStyle"
                                                       value="100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 my-3">
                                        <label class="text-black-50 my-1">انتخاب طرح لوگو</label>
                                        <div class="row bg-white my-2">
                                            <div class="col-3 my-4 text-center">
                                                <label class="w-100" style="height: 100px;border: 1px solid black"
                                                       for="logoTriangle"></label>
                                                <input type="radio" class="mt-3" id="logoTriangle"
                                                       wire:model="profileImgBorder" value="0"
                                                       {{$profileImgBorder==0?'checked':''}} name="imgStyle">
                                            </div>
                                            <div class="col-3 my-4 text-center">
                                                <label class="w-100"
                                                       style="height: 100px;border: 1px solid black;border-radius: 10%"
                                                       for="logo10"></label>
                                                <input type="radio" class="mt-3" id="logo10"
                                                       wire:model="profileImgBorder" value="10"
                                                       {{$profileImgBorder==10?'checked':''}} name="imgStyle">
                                            </div>
                                            <div class="col-3 my-4 text-center">
                                                <label class="w-100"
                                                       style="height: 100px;border: 1px solid black;border-radius: 30%"
                                                       for="logo30"></label>
                                                <input type="radio" class="mt-3" id="logo30"
                                                       wire:model="profileImgBorder" value="30"
                                                       {{$profileImgBorder==30?'checked':''}} name="imgStyle">
                                            </div>
                                            <div class="col-3 my-4 text-center">
                                                <label class="w-100"
                                                       style="height: 100px;border: 1px solid black;border-radius: 100%"
                                                       for="logo100"></label>
                                                <input type="radio" class="mt-3" id="logo100"
                                                       wire:model="profileImgBorder" value="100"
                                                       {{$profileImgBorder==100?'checked':''}} name="imgStyle">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-outline-info" data-bs-dismiss="modal" wire:click="clearInputs">
                                انصراف
                            </button>
                            <button class="btn btn-info text-white" data-bs-dismiss="modal"
                                    wire:click="submitProfileOptions">
                                ذخیره
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>


            $(window).ready(function () {
                $('i').addClass('fs-5')
                // $('button').addClass('fs-5')
                // setInterval(function () {
                //     var icon = $('.ez');
                //
                //     for (var i = 0; i < icon.length; i++) {
                //         var a       = icon[i];
                //         a.innerHTML = null
                //         for (var ii = 1; ii <= 50; ii++) {
                //             a.innerHTML += "<span class='path" + ii + "'></span>"
                //         }
                //     }
                // }, 2000)
            })

            function removeShow(id) {
                var blockItemAccordion = $('.blockItemAccordion')

                if (blockItemAccordion.hasClass('show')) {

                    blockItemAccordion.addClass('collapsing');
                    setTimeout(function () {
                        blockItemAccordion.removeClass('show');
                        // $('#item' + id).removeClass('collapsing')
                    }, 300)
                    $('#item' + id).addClass('show')

                    // blockItemAccordion.addClass('collapsing');
                }
                // console.log('#item'+id)
            }

            $(function () {
                $("#sortable1").sortable();
                $("#sortable").sortable(/*{
                                            update: function (e, u) {
                                                var data = $(this).sortable('serialize');
                                                $.ajax({
                                                           url     : "{{ url('controller/sorting_method') }}",
                                                           type    : 'post',
                                                           data    : data,
                                                           success : function (result) {

                                                           },
                                                           complete: function () {

                                                           }
                                                       });
                                            }

                                        }*/);

            });
        </script>
        <script>
            $(document).ready(function () {

                let button1 = $('.b1');
                let button2 = $('.b2');

                button1.on('click', function () {
                    rc()
                    button1.addClass('selected')
                })
                button2.on('click', function () {
                    rc()
                    button2.addClass('selected')
                })

                function rc() {
                    button1.removeClass('selected')
                    button2.removeClass('selected')
                }
            })
        </script>
    @endpush
</div>
