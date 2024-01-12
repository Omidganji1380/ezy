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
                    <div class="col-11">
                        <div class="userDiv">
                            <img src="{{asset('admin/assets/images/gallery/10.jpg')}}" alt="" class="backgroundImage">
                            <img src="{{asset('storage/pb/profiles/profile-'.$profile->id.'/'.$profile->img)}}" alt=""
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
            <div id="sortable" style="cursor: grab;margin-bottom: 6rem !important;">
                @foreach($blocks as $block)
                    <div class="col-12 my-3" data-bs-target="#blockOptions" data-bs-toggle="modal"
                         wire:click="blockOptions({{$block->id}})">
                        <div class="row p-2 flex-nowrap">
                            <div class="col-11">
                                <div class="row justify-content-center">
                                    <div class="col-12 text-center">
                                        <p class="text-center">{{$block->blockOption->blockTitle}}</p>
                                    </div>
                                    @foreach($block->pbOption()->get() as $option)
                                        <div class="col-6 text-center p-1">
                                            <button dir="rtl"
                                                    class="btn border-info w-100 rounded-pill overflow-hidden text-truncate px-1">
                                                <i class="{{$option->icon}} text-info mx-2 align-middle"
                                                   style="font-size: 25px !important;"></i>
                                                {{$this->getBlockTitle($option->pivot)}}
                                            </button>
                                        </div>
                                    @endforeach
                                    {{--<div class="col-6 text-center p-1">
                                        <button
                                            class="btn border-info w-100 rounded-pill overflow-hidden text-truncate px-1">
                                            <i class="icofont-telegram text-info mx-2 align-middle"></i>
                                            تلگرام
                                        </button>
                                    </div>--}}
                                </div>
                            </div>
                            <div class="col-1 text-center w-auto rounded" style="background-color: rgb(239, 239, 239);">
                                <i class="fa fa-arrows-up-down-left-right top-50 position-relative translate-middle-y"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-12 my-3">
                     <div class="row p-2 flex-nowrap">
                         <div class="col-11">
                             <div class="row justify-content-center">
                                 <div class="col-12 text-center">
                                     <p class="text-center">راه‌های ارتباطی</p>
                                 </div>
                                 <div class="col-6 text-center p-1">
                                     <button
                                         class="btn border-info w-100 rounded-pill overflow-hidden text-truncate px-1">
                                         <i class="icofont-instagram text-danger mx-2 align-middle"></i>
                                         تلگرام
                                     </button>
                                 </div>
                                 <div class="col-6 text-center p-1">
                                     <button
                                         class="btn border-info w-100 rounded-pill overflow-hidden text-truncate px-1">
                                         <i class="icofont-instagram text-danger mx-2 align-middle"></i>
                                         تلگرام
                                     </button>
                                 </div>
                             </div>
                         </div>
                         <div class="col-1 text-center w-auto rounded" style="background-color: rgb(239, 239, 239);">
                             <i class="fa fa-arrows-up-down-left-right top-50 position-relative translate-middle-y"></i>
                         </div>
                     </div>
                 </div>--}}
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
                            {{--                            onclick="setIcons()"--}}
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
                            {{--                            onclick="setIcons()"--}}
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
                    <div class="row">
                        @foreach($options as $item)
                            <div class="col-4 my-1">
                                <button class="btn w-100" wire:click="insertBlock({{$item->id}})"
                                        style="background-color: {{$item->color}};border: 1px solid #c4c4c4"
                                        data-bs-toggle="modal"
                                        data-bs-target="#blockOptions"
                                >
                                    <div class="row justify-content-center">
                                        <div class="col-8 align-self-center" style="text-align: right">
                                            {{$item->title}}
                                        </div>
                                        <div class="col-4 align-self-center">
                                            <i style="font-size: 25px !important;"
                                               class="align-middle {{$item->icon}}"></i>
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
                        <div class="col-12 my-3 accordion accordion-flush" id="accordionParent">
                            <div class="collapse text-black accordion-collapse show" id="properties"
                                 data-bs-parent="#accordionParent" wire:ignore.self>
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
                                                        <button {{--onclick="removeShow({{$item->id}})"--}}
                                                                class="btn w-100 bg-white py-3 border border-3 btnNoFocus"
                                                                role="button" data-bs-toggle="collapse"
                                                                data-bs-target="#item{{$item->id}}"
                                                                aria-expanded="false" aria-controls="item{{$item->id}}">
                                                            <div class="row">
                                                                <div class="col-1">
                                                                    <i class="fa fa-arrows-up-down-left-right"></i>
                                                                </div>
                                                                <div class="col-auto">
                                                                    {{--                                                                    <span disabled="true" hidden="true">{{$this->getBlockItemTitle($blockItemTitle)}}</span>--}}
                                                                    {{$item->title}} {{$blockItemConnectionWay?'( '.$blockItemConnectionWay[$item->id].' )':''}}
                                                                </div>
                                                            </div>
                                                        </button>
                                                        <div wire:ignore
                                                             class="collapse text-black accordion-collapse blockItemAccordion bg-white border border-3 border-top-0"
                                                             id="item{{$item->id}}"
                                                             data-bs-parent="#accordionParent11">
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
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse text-black accordion-collapse" id="moreOptions"
                                 data-bs-parent="#accordionParent">
                                2222222
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
    @push('js')
        <script>
            /* var accordionId = $('.accordion-collapse')
             if (accordionId.hasClass('show')){

                 console.log(accordionId.id)
             }*/
            $(window).ready(function () {
                $('i').addClass('fs-5')
                // $('button').addClass('fs-5')
                setInterval(function () {
                    var icon = $('.ez');

                    for (var i = 0; i < icon.length; i++) {
                        var a       = icon[i];
                        a.innerHTML = null
                        for (var ii = 1; ii <= 50; ii++) {
                            a.innerHTML += "<span class='path" + ii + "'></span>"
                        }
                    }
                }, 2000)
            })

            //             function removeShow(id) {
            //                 var blockItemAccordion = $('.blockItemAccordion')
            //
            //                 if (blockItemAccordion.hasClass('show')) {
            //
            //                     blockItemAccordion.addClass('collapsing');
            //                     setTimeout(function () {
            //                     blockItemAccordion.removeClass('show');
            //                     // $('#item' + id).removeClass('collapsing')
            //                     }, 300)
            //                     $('#item' + id).addClass('show')
            //
            //                     // blockItemAccordion.addClass('collapsing');
            //                 }
            // // console.log('#item'+id)
            //             }

            // function setIcons() {
            //     setTimeout(function () {
            //         var icon = $('.ez');
            //
            //         for (var i = 0; i < icon.length; i++) {
            //             var a = icon[i];
            //             for (var ii = 1; ii <= 50; ii++) {
            //                 a.innerHTML += "<span class='path" + ii + "'></span>"
            //             }
            //         }
            //     }, 1000)

            // }

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
