<div>
    @push('css')
        <link rel="stylesheet" href="{{asset('pageBuilder/assets/css/style.css')}}">
    @endpush

    <div style="max-width: 600px" class="container">
        <div class="row">
            <div class="col-12" style="border-radius: 20px;box-shadow: rgba(0,0,0,0.2) 0 0 20px;">
                <div class="row p-2 justify-content-end flex-nowrap">
                    <div class="col-auto px-1 align-self-center" dir="ltr">
                        {{--                        {{substr(route('pb.show',$profile->link),strpos(route('pb.show',$profile->link),'http://'))}}--}}
                        {{preg_replace("(^https?://)",'',route('pb.show',$profile->link))}}
                        {{--                        {{route('pb.show',$profile->link)}}--}}
                        <input type="hidden" id="profileLink" value="{{route('pb.show',$profile->link)}}">
                    </div>
                    <div class="col-auto px-1 align-self-center">|</div>
                    <div class="col-auto px-1">
                        <button class="btn p-1 text-info">
                            <i class="icofont-share"></i>
                        </button>
                    </div>
                    <div class="col-auto px-1">
                        <button class="btn p-1 text-info" onclick="copyLink()">
                            <i class="icofont-ui-copy"></i>
                        </button>
                    </div>
                </div>
            </div>
            {{--            <div class="grapick" wire:ignore></div>--}}
            <div class="col-12 my-3">
                <div class="row p-2 flex-nowrap">
                    <div class="col-11" data-bs-target="#profileOptions" data-bs-toggle="modal"
                         wire:click="getProfileOptions" onclick="showFirstTab()">
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
            <div id="sortable" style="cursor: grab;margin-bottom: 9rem !important;" wire:ignore.self>
                @foreach($blocks as $block)
                    <div class="col-12 my-3">
                        <div class="row p-2 flex-nowrap">
                            <div class="col-11" onclick="showFirstTab()" data-bs-target="#blockOptions"
                                 data-bs-toggle="modal"
                                 wire:click="blockOptions({{$block->id}})">
                                <div class="row justify-content-center">
                                    <div class="col-12 text-center">
                                        <p class="text-center">{{$block->blockOption->blockTitle}}</p>
                                    </div>
                                    @foreach($block->pbOption()->get() as $option)
                                        {{--                                                                                @dd($block->blockOption->blockItemColor)--}}
                                        <div
                                            class="{{$this->setBlockWidthHalf($block->blockOption->blockWidth,$loop->last,$loop->index)}} {{$this->setBlockWidth($block->blockOption->blockWidth)}} text-center p-1">
                                            <button dir="rtl" {{--style=""--}}
                                            class="btn border-info w-100 overflow-hidden text-truncate px-1"
                                                    style="border-radius: {{$this->getBlockItemsBorder($block)}};background-{{$block->blockOption->blockItemColor==2?'color':'image'}}: {{$this->getBgBlockItemColor($block,$option->color)}};border-color: {{$this->getBorderBlockItemColor($block)}} !important;color: {{$this->getTextBlockItemColor($block)}}">
                                                <div class="row justify-content-center ez-solid-aparat flex-nowrap"
                                                     style="{{$block->blockOption->blockItemColor==2?'':'background: '.$this->getTextBlockItemColor($block).';-webkit-background-clip: text;-webkit-text-fill-color: transparent;'}}"
                                                >
                                                    <div
                                                        class="col-auto {{$block->blockOption->blockWidth!='compress'?'ps-0':''}}">
                                                        <i class="{{--{{$option->icon}}--}}{{$this->getBlockItemIcon($option->icon,$block->blockOption->blockItemColor)}} {{--text-info--}} mx-2 align-middle iii"
                                                           style="font-size: 25px !important;">
                                                            {!! $this->getIconPaths() !!}
                                                        </i>
                                                    </div>
                                                    @if($block->blockOption->blockWidth!='compress')
                                                        <div
                                                            class="col-auto pe-0">{{$this->getBlockTitle($option->pivot)}}</div>
                                                    @endif
                                                </div>
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
                        <img src="{{asset('pageBuilder/assets/img/setting-2-svgrepo-com.png')}}" alt="" class="p-2"
                             data-bs-toggle="modal"
                             data-bs-target="#globalOptions" onclick="showFirstTab()">
                    </div>
                    <div class="col-auto">
                        <img src="{{asset('pageBuilder/assets/img/insertPlus.png')}}" wire:click="clearVariables" alt=""
                             class="p-2 position-relative" style="top: -50%"
                             data-bs-toggle="modal"
                             data-bs-target="#insertPlus">
                    </div>
                    <div class="col-auto">
                        <img src="{{asset('pageBuilder/assets/img/preview.png')}}" alt="" class="p-2"
                             data-bs-toggle="modal"
                             data-bs-target="#preview"
                             wire:click="previewPB">
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
                <div class="modal-body position-relative" style="background-color: rgb(241, 243, 246);">
                    <div wire:loading class="position-absolute w-100 h-100 bg-white start-0 top-0" style="z-index: 99">
                        <img
                            src="{{asset('pageBuilder/loading.gif')}}"
                            class="position-absolute h-100 py-2 mx-auto start-0 w-100"
                            style="right: 0;max-height: 100%;object-fit: none">
                    </div>
                    <ul class="list-group pointer">
                        <li
                            data-bs-toggle="modal"
                            data-bs-target="#insertMessengers"
                            wire:click="getOptions('messenger',true)"
                            class="list-group-item my-1 border-dark px-4">
                            <div class="row flex-nowrap  justify-content-sm-start">
                                <div class="col-2 text-center pe-0">
                                    <i class="ez ez-chat-writing"></i>
                                </div>
                                <div class="col-10 col-sm-auto px-0 text-truncate" style="max-width: 80%">
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
                            <div class="row flex-nowrap  justify-content-sm-start">
                                <div class="col-2 text-center pe-0">
                                    <i class="ez ez-social-instagram"></i>
                                </div>
                                <div class="col-10 col-sm-auto px-0 text-truncate" style="max-width: 80%">
                                    <h4>شبکه های اجتماعی</h4>
                                    <p class="m-0">افزودن شبکه های اجتماعی</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#insertMessengers"
                            wire:click="getOptions('call',true)">
                            <div class="row flex-nowrap  justify-content-sm-start">
                                <div class="col-2 text-center pe-0">
                                    <i class="ez ez-phone"></i>
                                </div>
                                <div class="col-10 col-sm-auto px-0 text-truncate" style="max-width: 80%">
                                    <h4>تماس و راه های ارتباطی</h4>
                                    <p class="m-0">برقراری ارتباط از طریق شماره موبایل، پیامک، تلفن ثابت و ...</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4">
                            <div class="row flex-nowrap  justify-content-sm-start">
                                <div class="col-2 text-center pe-0">
                                    <i class="ez ez-vcf">
                                        {!! $this->getIconPaths() !!}
                                    </i>
                                </div>
                                <div class="col-10 col-sm-auto px-0 text-truncate" style="max-width: 80%">
                                    <h4>ساخت ذخیره خودکار مخاطب</h4>
                                    <p class="m-0">فایل vcf خود را بسازید</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#blockOptions"
                            wire:click="getOptionsBanner('banner',true)">
                            <div class="row flex-nowrap  justify-content-sm-start">
                                <div class="col-2 text-center pe-0">
                                    <i class="ez ez-photo">
                                        {!! $this->getIconPaths() !!}
                                    </i>
                                </div>
                                <div class="col-10 col-sm-auto px-0 text-truncate" style="max-width: 80%">
                                    <h4>بنر</h4>
                                    <p class="m-0">امکان اضافه کردن بنر و عکس و اسلایدر</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4">
                            <div class="row flex-nowrap  justify-content-sm-start">
                                <div class="col-2 text-center pe-0">
                                    <i class="ez ez-video-library"></i>
                                </div>
                                <div class="col-10 col-sm-auto px-0 text-truncate" style="max-width: 80%">
                                    <h4>ویدئو</h4>
                                    <p class="m-0">امکان افزودن ویدئو</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#insertMessengers"
                            wire:click="getOptions('link',true)">
                            <div class="row flex-nowrap  justify-content-sm-start">
                                <div class="col-2 text-center pe-0">
                                    <i class="ez ez-link"></i>
                                </div>
                                <div class="col-10 col-sm-auto px-0 text-truncate" style="max-width: 80%">
                                    <h4>لینک</h4>
                                    <p class="m-0">ساخت لینک دلخواه</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4">
                            <div class="row flex-nowrap  justify-content-sm-start">
                                <div class="col-2 text-center pe-0">
                                    <i class="ez ez-location"></i>
                                </div>
                                <div class="col-10 col-sm-auto px-0 text-truncate" style="max-width: 80%">
                                    <h4>مسیریابی</h4>
                                    <p class="m-0">نمایش آدرس بر روی نقشه</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4">
                            <div class="row flex-nowrap  justify-content-sm-start">
                                <div class="col-2 text-center pe-0">
                                    <i class="ez ez-text-align-center"></i>
                                </div>
                                <div class="col-10 col-sm-auto px-0 text-truncate" style="max-width: 80%">
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
                <div class="modal-body position-relative" style="background-color: rgb(241, 243, 246);">
                    <div wire:loading class="position-absolute w-100 h-100 bg-white start-0 top-0" style="z-index: 99">
                        <img
                            src="{{asset('pageBuilder/loading.gif')}}"
                            class="position-absolute h-100 py-2 mx-auto start-0 w-100"
                            style="right: 0;max-height: 100%;object-fit: none">
                    </div>
                    <div class="row justify-content-center">
                        @foreach($options as $item)
                            <div class="col-12 col-sm-4 my-1 px-1">
                                <button class="btn w-100" wire:click="insertBlock({{$item->id}})"
                                        style="background-color: {{$item->color}};border: 1px solid #c4c4c4"
                                        data-bs-toggle="modal"
                                        data-bs-target="#blockOptions"
                                >
                                    <div class="row justify-content-center text-truncate">
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
                            class="ms-2 close btn p-0" wire:click="deleteBlock"
                            wire:confirm="آیا از حذف این بلوک مطمئن هستید؟">
                        <span class="fa fa-trash text-danger">{{--&times;--}}</span>
                    </button>
                    <h5 class="modal-title mx-auto">{{$title}}</h5>
                    <button type="button" style="width: 20px;height: 20px;"
                            class="me-1 close btn border-dark border-2 rounded-circle p-0"
                            data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-close">{{--&times;--}}</span>
                    </button>
                </div>

                <div class="modal-body position-relative" style="background-color: rgb(241, 243, 246);"
                     wire:ignore.self>
                    @if(!$blockItems)
                        <div wire:loading class="position-absolute w-100 h-100 bg-white start-0 top-0"
                             style="z-index: 99">
                            <img
                                src="{{asset('pageBuilder/loading.gif')}}"
                                class="position-absolute h-100 py-2 mx-auto start-0 w-100"
                                style="right: 0;max-height: 100%;object-fit: none">
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-pills mb-3 row pills-tab" id="" role="tablist">
                                <li class="nav-item btn b1 selected col-6" role="presentation">
                                    <button class="btn btnNoFocus active w-100" id="properties-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#properties" type="button" role="tab"
                                            aria-controls="properties" aria-selected="true">مشخصات
                                    </button>
                                </li>
                                <li class="nav-item btn b2 col-6" role="presentation">
                                    <button class="btn btnNoFocus w-100 " id="moreOptions-tab" data-bs-toggle="pill"
                                            data-bs-target="#moreOptions" type="button" role="tab"
                                            aria-controls="moreOptions" aria-selected="false">تنظیمات بیشتر
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 my-3 tab-content" id="accordionParent123">
                            <div class="tab-pane fade show active" id="properties" role="tabpanel"
                                 aria-labelledby="properties-tab" wire:ignore.self>
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
                                                        <div
                                                            class="row bg-white border border-3 mx-0 justify-content-between">
                                                            <div class="col-11 position-relative">
                                                                <button onclick="removeShow({{$item->id}})"
                                                                        class="btn w-100 bg-white py-3 btnNoFocus ms-4"
                                                                        role="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#item{{$item->id}}"
                                                                        aria-expanded="false"
                                                                        aria-controls="item{{$item->id}}">
                                                                    <div class="row" style="width: fit-content">

                                                                        <div class="col-auto" dir="rtl">
                                                                            {{$item->title}}
                                                                            <span
                                                                                class="float-start ms-2 blockItemConnectionWay{{$key}}"
                                                                                onchange="">
                                                                            {{strlen($blockItemConnectionWay[$item->id])>=1?'( '.$blockItemConnectionWay[$item->id].' )':''}}

                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                                <div
                                                                    class="position-absolute top-50 translate-middle-y">
                                                                    <i class="fa fa-arrows-up-down-left-right"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-1 p-1 text-center position-relative">
                                                                <button wire:click="deleteBlockItem({{$item->id}})"
                                                                        wire:confirm="آیتم ( {{$item->title}} ) حذف شود؟"
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
                                                                            class="text-black-50">{{$item->pbOption->linkTitle}} {{$item->title}}</label>
                                                                        <input type="text"
                                                                               class="my-2 form-control blockItemConnectionWay{{$key}}"
                                                                               {{--                                                                               onkeyup="document.querySelector('span.blockItemConnectionWay{{$key}}').innerText=('( '+ this.value +' )');--}}
                                                                               {{--                                                                               document.querySelector('span.blockItemConnectionWay{{$key}}').innerText==='( )'?document.querySelector('span.blockItemConnectionWay{{$key}}').innerText='':''"--}}
                                                                               value="{{$item->connectionWay}}"
                                                                               wire:model.blur="blockItemConnectionWay.{{$item->id}}"
                                                                               placeholder="{{$item->pbOption->linkTitle}} {{$item->title}} خود را وارد کنید">
                                                                        <p class="text-black-50 small">{{$item->pbOption->linkDescription}}</p>
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
                            <div class="tab-pane fade" id="moreOptions" role="tabpanel"
                                 wire:ignore.self aria-labelledby="moreOptions-tab">
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
                                        <label class="text-black-50 mb-2">عنوان بلوک</label>
                                        <input type="text" class="my-2 form-control"
                                               wire:model="blockTitle"
                                               placeholder="عنوان بلوک خود را وارد کنید">
                                        <p class="text-black-50 small">در صورت تمایل می‌توانید برای این بلوک یک عنوان
                                            انتخاب کنید</p>
                                    </div>
                                    <div class="col-12 my-3">
                                        <label class="text-black-50 mb-2">عرض آیتم</label>
                                        <div class="row justify-content-center">
                                            <div class="col-3 text-center">
                                                @foreach($constOptions as $item)
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
                                                               wire:model="blockItemsWidth" value="full"
                                                               id="blockItemWidthFull" class="">
                                                    </div>
                                                    <div class="col-auto">
                                                        <label for="blockItemWidthFull">تمام عرض</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4"
                                                {{--style="border-left: 1px solid grey;border-right: 1px solid grey;"--}}>
                                                <div class="row">
                                                    @foreach($constOptions as $item)
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
                                                                   wire:model="blockItemsWidth" value="half"
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
                                                    @foreach($constOptions as $item)
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
                                                                   wire:model="blockItemsWidth" value="compress"
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
                                        <label class="text-black-50 mb-2">رنگ بندی آیتم‌ها</label>
                                        <select class="form-select" wire:model="blockItemColor"
                                                onchange="blockItemColor(this.value)"
                                        >
                                            <option value="1">استفاده از رنگ‌های شخصی‌سازی شده</option>
                                            <option value="2">استفاده از رنگ برندها</option>
                                            <option value="3">انتخاب رنگ دلخواه برای آیتم‌های این بلوک</option>
                                        </select>
                                        <div class="@if($blockItemColor!=3) d-none @endif my-2" id="blockItemColor3">
                                            <button class="btn btnNoFocus w-100 py-2 bg-white"
                                                    style="text-align: right;border: 1px solid lightgrey">
                                                پس‌زمینه بلوک‌ها
                                                <div wire:ignore class="my-4 grapick"></div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <select class="form-select " id="switch-type">
                                                            <option value>- انتخاب کنید -</option>
                                                            <option value="radial">radial</option>
                                                            <option value="linear">linear</option>
                                                            <option value="repeating-radial">repeating-radial</option>
                                                            <option value="repeating-linear">repeating-linear</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <select class="form-select " id="switch-angle">
                                                            <option value>- انتخاب کنید -</option>
                                                            <option value="top">Top</option>
                                                            <option value="right">Right</option>
                                                            <option value="center">Center</option>
                                                            <option value="bottom">Bottom</option>
                                                            <option value="left">Left</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                {{--                                                <span class="float-start" dir="ltr">{{$bgBlockItemColor}}</span>--}}
                                            </button>
                                            <button class="btn btnNoFocus w-100 py-2 bg-white my-2"
                                                    style="text-align: right;border: 1px solid lightgrey">
                                                عناوین آیتم‌ها
                                                <div wire:ignore class="my-4 grapick1"></div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <select class="form-select " id="switch-type1">
                                                            <option value>- انتخاب کنید -</option>
                                                            <option value="radial">radial</option>
                                                            <option value="linear">linear</option>
                                                            <option value="repeating-radial">repeating-radial</option>
                                                            <option value="repeating-linear">repeating-linear</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <select class="form-select " id="switch-angle1">
                                                            <option value>- انتخاب کنید -</option>
                                                            <option value="top">Top</option>
                                                            <option value="right">Right</option>
                                                            <option value="center">Center</option>
                                                            <option value="bottom">Bottom</option>
                                                            <option value="left">Left</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                {{--                                                <input type="color" wire:model.live="textBlockItemColor"--}}
                                                {{--                                                       class="float-start ms-2"--}}
                                                {{--                                                       style="width: 40px;height: 20px;">--}}
                                                {{--                                                <span class="float-start" dir="ltr">{{$textBlockItemColor}}</span>--}}
                                            </button>
                                            <button class="btn btnNoFocus w-100 py-2 bg-white"
                                                    style="text-align: right;border: 1px solid lightgrey">
                                                حاشیه بلوک‌ها
                                                <input type="color" wire:model.live="borderBlockItemColor"
                                                       class="float-start ms-2"
                                                       style="width: 40px;height: 20px;">
                                                <span class="float-start" dir="ltr">{{$borderBlockItemColor}}</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-12 my-3">
                                        <label class="text-black-50 mb-2">نوع حاشیه بلوک</label>
                                        <div class="row bg-white p-3">

                                            @foreach($constOptions as $key=>$item)
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
                                                                       wire:model="blockItemsBorder" value="{{$key}}"
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

                <div class="modal-body position-relative" style="background-color: rgb(241, 243, 246);">
                    <div wire:loading class="position-absolute w-100 h-100 bg-white start-0 top-0" style="z-index: 99">
                        <img
                            src="{{asset('pageBuilder/loading.gif')}}"
                            class="position-absolute h-100 py-2 mx-auto start-0 w-100"
                            style="right: 0;max-height: 100%;object-fit: none">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-pills mb-3 row pills-tab" id="" role="tablist">
                                <li class="nav-item btn b1 selected col-6" role="presentation">
                                    <button class="btn btnNoFocus active w-100" id="profileProperties-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#profileProperties" type="button" role="tab"
                                            aria-controls="profileProperties" aria-selected="true">مشخصات
                                    </button>
                                </li>
                                <li class="nav-item btn b2 col-6" role="presentation">
                                    <button class="btn btnNoFocus w-100 " id="profileMoreOptions-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#profileMoreOptions" type="button" role="tab"
                                            aria-controls="profileMoreOptions" aria-selected="false">تنظیمات بیشتر
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 my-3 tab-content" id="accordionParentProfile">
                            <div class="tab-pane fade show active" id="profileProperties" role="tabpanel"
                                 aria-labelledby="profileProperties-tab" wire:ignore.self>
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
                                                    class="position-absolute h-100 py-2 mx-auto start-0" alt=""
                                                    style="right: 0" wire:click="removeImg" wire:confirm="حذف شود؟">
                                                <img wire:loading wire:target="profileImg"
                                                     src="{{asset('pageBuilder/loading.gif')}}"
                                                     class="position-absolute h-100 py-2 mx-auto start-0"
                                                     style="right: 0">
                                                @if(!$profile->img)
                                                    <input type="file" class="opacity-0 h-100 w-100"
                                                           wire:model="profileImg">
                                                @endif
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
                                                    class="position-absolute h-100 py-2 mx-auto start-0" alt=""
                                                    style="right: 0" wire:click="removeBgImg" wire:confirm="حذف شود؟">
                                                <img wire:loading wire:target="profileBgImg"
                                                     src="{{asset('pageBuilder/loading.gif')}}"
                                                     class="position-absolute h-100 py-2 mx-auto start-0"
                                                     style="right: 0">
                                                @if(!$profile->bg_img)
                                                    <input type="file" class="opacity-0 h-100 w-100"
                                                           wire:model="profileBgImg">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="profileMoreOptions" role="tabpanel"
                                 wire:ignore.self aria-labelledby="profileMoreOptions-tab">
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
    {{--preview--}}
    <div class="modal fade rounded" wire:ignore.self id="preview" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered {{--modal-lg--}}">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <h5 class="modal-title mx-auto">پیش نمایش زنده</h5>
                    <button type="button" style="width: 20px;height: 20px;"
                            class="me-1 close btn border-dark border-2 rounded-circle p-0"
                            data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-close">{{--&times;--}}</span>
                    </button>
                </div>

                <div class="modal-body position-relative" style="background-color: rgb(241, 243, 246);">
                    <div wire:loading class="position-absolute w-100 h-100 bg-white start-0 top-0" style="z-index: 99">
                        <img
                            src="{{asset('pageBuilder/loading.gif')}}"
                            class="position-absolute h-100 py-2 mx-auto start-0 w-100"
                            style="right: 0;max-height: 100%;object-fit: none">
                    </div>
                    @livewire('front.pagebuilder.show',[$link])
                </div>
            </div>
        </div>
    </div>
    {{--global setting--}}
    <div class="modal fade rounded" wire:ignore.self id="globalOptions" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered {{--modal-lg--}}">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <h5 class="modal-title mx-auto">شخصی سازی قالب</h5>
                    <button type="button" style="width: 20px;height: 20px;"
                            class="me-1 close btn border-dark border-2 rounded-circle p-0"
                            data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-close">{{--&times;--}}</span>
                    </button>
                </div>

                <div class="modal-body position-relative" style="background-color: rgb(241, 243, 246);">
                    <div wire:loading class="position-absolute w-100 h-100 bg-white start-0 top-0" style="z-index: 99">
                        <img
                            src="{{asset('pageBuilder/loading.gif')}}"
                            class="position-absolute h-100 py-2 mx-auto start-0 w-100"
                            style="right: 0;max-height: 100%;object-fit: none">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-pills mb-3 row pills-tab" wire:ignore.self id="" role="tablist">
                                <li class="nav-item btn b1 selected col-6" role="presentation">
                                    <button class="btn btnNoFocus active w-100" id="originalOptions-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#originalOptions" type="button" role="tab"
                                            aria-controls="originalOptions" aria-selected="true">تنظیمات اصلی
                                    </button>
                                </li>
                                <li class="nav-item btn b2 col-6" role="presentation">
                                    <button class="btn btnNoFocus w-100 " id="theme-tab" data-bs-toggle="pill"
                                            data-bs-target="#theme" type="button" role="tab"
                                            aria-controls="theme" aria-selected="false">تم
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" wire:ignore.self id="originalOptions"
                                     role="tabpanel"
                                     aria-labelledby="originalOptions-tab">
                                    <div class="row">
                                        <div class="col-12 my-3">
                                            <label class="text-black-50 my-1">فونت نوشته‌ها</label>
                                            <button class="btn btnNoFocus w-100 py-2 bg-white"
                                                    style="text-align: right;border: 1px solid lightgrey">
                                                ایران سنس
                                                <i class="icofont-rounded-down float-start"></i>
                                            </button>
                                        </div>
                                        <div class="col-12 my-3">
                                            <label class="text-black-50 my-1">قالب</label>
                                            <button class="btn btnNoFocus w-100 py-2 bg-white"
                                                    style="text-align: right;border: 1px solid lightgrey">
                                                نوشته‌ها و متون
                                                <span class="float-start rounded-circle ms-2"
                                                      style="width: 20px;height: 20px;background-color: #492525"></span>
                                                <span class="float-start">#492525</span>
                                            </button>
                                        </div>
                                        <div class="col-12 my-3">
                                            <label class="text-black-50 my-1">تنظیمات عمومی رنگ آیتم‌ها /
                                                دکمه‌ها</label>
                                            <button class="btn btnNoFocus w-100 py-2 bg-white"
                                                    style="text-align: right;border: 1px solid lightgrey">
                                                پس‌زمینه بلوک‌ها
                                                <span class="float-start rounded-circle ms-2"
                                                      style="width: 20px;height: 20px;background-color: #492525"></span>
                                                <span class="float-start">#492525</span>
                                            </button>
                                            <button class="btn btnNoFocus w-100 py-2 bg-white my-2"
                                                    style="text-align: right;border: 1px solid lightgrey">
                                                عناوین آیتم‌ها
                                                <span class="float-start rounded-circle ms-2"
                                                      style="width: 20px;height: 20px;background-color: #363636"></span>
                                                <span class="float-start">#363636</span>
                                            </button>
                                            <button class="btn btnNoFocus w-100 py-2 bg-white"
                                                    style="text-align: right;border: 1px solid lightgrey">
                                                حاشیه بلوک‌ها
                                                <span class="float-start rounded-circle ms-2"
                                                      style="width: 20px;height: 20px;background-color: #B1B3B6"></span>
                                                <span class="float-start">#B1B3B6</span>
                                            </button>
                                        </div>
                                        <div class="col-12 my-3">
                                            <div class="row">
                                                <div class="col-12" wire:ignore>
                                                    <ul class="nav nav-pills mb-3 row pills-tab" id="" role="tablist">
                                                        <li class="nav-item btn b3 selected col-6" role="presentation">
                                                            <button class="btn btnNoFocus active w-100" id="colors-tab"
                                                                    data-bs-toggle="pill"
                                                                    data-bs-target="#colors" type="button" role="tab"
                                                                    aria-controls="colors" aria-selected="true">رنگ
                                                            </button>
                                                        </li>
                                                        <li class="nav-item btn b4 col-6" role="presentation">
                                                            <button class="btn btnNoFocus w-100 " id="bgImage-tab"
                                                                    data-bs-toggle="pill"
                                                                    data-bs-target="#bgImage" type="button" role="tab"
                                                                    aria-controls="bgImage" aria-selected="false">تصویر
                                                            </button>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="pills-tabContent">
                                                        <div class="tab-pane fade show active" id="colors"
                                                             role="tabpanel"
                                                             aria-labelledby="colors-tab">
                                                            <div class="row">
                                                                <div class="col-12 my-3">
                                                                    <button class="btn btnNoFocus w-100 py-2 bg-white"
                                                                            style="text-align: right;border: 1px solid lightgrey">
                                                                        رنگ پس‌زمینه
                                                                        <span class="float-start rounded-circle ms-2"
                                                                              style="width: 20px;height: 20px;background-color: #492525"></span>
                                                                        <span class="float-start">#492525</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="bgImage" role="tabpanel"
                                                             aria-labelledby="bgImage-tab">
                                                            <div class="row">
                                                                <div class="col-12 my-3">
                                                                    <label class="text-black-50 my-1">تصویر پس
                                                                        زمینه</label>
                                                                    <div class="row row-cols-md-3">
                                                                        <div class="col-auto mx-auto text-center my-1">
                                                                            <img class="w-100"
                                                                                 src="{{asset('pageBuilder/assets/img/pbBackground/ddaf01857fffc185baa4.jpg')}}"
                                                                                 alt="">
                                                                        </div>
                                                                        <div class="col-auto mx-auto text-center my-1">
                                                                            <img class="w-100"
                                                                                 src="{{asset('pageBuilder/assets/img/pbBackground/ddaf01857fffc185baa4.jpg')}}"
                                                                                 alt="">
                                                                        </div>
                                                                        <div class="col-auto mx-auto text-center my-1">
                                                                            <img class="w-100"
                                                                                 src="{{asset('pageBuilder/assets/img/pbBackground/ddaf01857fffc185baa4.jpg')}}"
                                                                                 alt="">
                                                                        </div>
                                                                        <div class="col-auto mx-auto text-center my-1">
                                                                            <img class="w-100"
                                                                                 src="{{asset('pageBuilder/assets/img/pbBackground/ddaf01857fffc185baa4.jpg')}}"
                                                                                 alt="">
                                                                        </div>
                                                                        <div class="col-auto mx-auto text-center my-1">
                                                                            <img class="w-100"
                                                                                 src="{{asset('pageBuilder/assets/img/pbBackground/ddaf01857fffc185baa4.jpg')}}"
                                                                                 alt="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 my-3">
                                            <label class="text-black-50 mb-2">نوع حاشیه بلوک</label>
                                            <div class="row bg-white p-3">

                                                @foreach($constOptions as $key=>$item)
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
                                                                           wire:model="blockItemsBorder"
                                                                           value="{{$key}}"
                                                                           id="blockItemBorderRadius{{$item->id}}"
                                                                           class="">
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
                                <div class="tab-pane fade" id="theme" wire:ignore.self role="tabpanel"
                                     aria-labelledby="theme-tab">BB
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
        <script type="text/javascript">
            var upType, unAngle, gp;
            // var copyTxt = document.querySelector('.txt-value');
            var swType  = document.getElementById('switch-type');
            var swAngle = document.getElementById('switch-angle');
            // var copyToClipboard = function(str) {
            //     var el = document.createElement('textarea');
            //     el.value = str;
            //     el.setAttribute('readonly', '');
            //     el.style.position = 'absolute';
            //     el.style.left = '-9999px';
            //     document.body.appendChild(el);
            //     el.select();
            //     document.execCommand('copy');
            //     document.body.removeChild(el);
            // };
            swType.addEventListener('change', function (e) {
                gp && gp.setType(this.value || 'linear');
            });

            swAngle.addEventListener('change', function (e) {
                gp && gp.setDirection(this.value || 'right');
            });

            // var copyBtn = document.querySelector('.copy-btn');
            // copyBtn.addEventListener('click', function(e) {
            //     var iconOrig = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 21H8V7h11m0-2H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2m-3-4H4c-1.1 0-2 .9-2 2v14h2V3h12V1z"></path></svg>';
            //     var iconDone = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21 7L9 19l-5.5-5.5 1.41-1.41L9 16.17 19.59 5.59 21 7z"></path></svg>';
            //     copyToClipboard(copyTxt.value);
            //     copyBtn.innerHTML = iconDone;
            //     setTimeout(() => copyBtn.innerHTML = iconOrig, 2000)
            // });

            var createGrapick = function () {
                gp = new Grapick({
                                     el       : '.grapick',
                                     direction: 'right',
                                     min      : 1,
                                     max      : 99,
                                 });
                gp.addHandler(1, '#085078', 1);
                gp.addHandler(99, '#85D8CE', 1, {keepSelect: 1});
                gp.on('change', function (complete) {
                    // const value = gp.getValue();
                    // document.body.style.background = gp.getSafeValue();
                    @this.
                    set('bgBlockItemColor', gp.getSafeValue());
                    // alert(gp.getSafeValue())
                    // copyTxt.value = value;
                })
                gp.emit('change');
            };

            var destroyGrapick = function () {
                gp.destroy();
                gp = 0;
            }

            createGrapick();
            // createGrapick(); destroyGrapick();
        </script>
        <script type="text/javascript">
            var upType1, unAngle1, gp1;
            var swType1  = document.getElementById('switch-type1');
            var swAngle1 = document.getElementById('switch-angle1');
            swType1.addEventListener('change', function (e) {
                gp1 && gp1.setType(this.value || 'linear');
            });

            swAngle1.addEventListener('change', function (e) {
                gp1 && gp1.setDirection(this.value || 'right');
            });

            var createGrapick = function () {
                gp1 = new Grapick({
                                     el       : '.grapick1',
                                     direction: 'right',
                                     min      : 1,
                                     max      : 99,
                                 });
                gp1.addHandler(1, '#085078', 1);
                gp1.addHandler(99, '#85D8CE', 1, {keepSelect: 1});
                gp1.on('change', function (complete) {
                    @this.
                    set('textBlockItemColor', gp1.getSafeValue());
                })
                gp1.emit('change');
            };

            var destroyGrapick = function () {
                gp1.destroy();
                gp1 = 0;
            }

            createGrapick();
        </script>
        <script>
            var blockItemColor3 = $('#blockItemColor3')

            function blockItemColor(value) {
                // alert(value)
                if (value == 3) {
                    blockItemColor3.removeClass('d-none')
                } else {
                    blockItemColor3.addClass('d-none')
                }
            }
        </script>
        <script>
            // $(document).bind('DOMSubtreeModified', function () {


            var modal = $('div.modal')

            function showFirstTab() {
                // const gp = new Grapick({el: '.grapick'});
                //
                // // Handlers are color stops
                // gp.addHandler(0, 'red');
                // gp.addHandler(100, 'blue');
                //
                // // Do stuff on change of the gradient
                // gp.on('change', complete => {
                //     document.body.style.background = gp.getSafeValue();
                // })

                var buttons = modal.find('ul.nav')
                var tabs    = modal.find('div.tab-content')

                buttons.find('li').removeClass('selected')
                buttons.find('li button').removeClass('active')
                tabs.find('div.tab-pane').removeClass('show active')
                // tabs.find('div.tab-pane').removeClass('active')

                buttons.find('li:first').addClass('selected')
                buttons.find('li:first button').addClass('active')
                tabs.find('div.tab-pane:first').addClass('show active')
            }
        </script>
        <script>

            const pillsTab = document.querySelector('.pills-tab');
            const pills    = pillsTab.querySelectorAll('button[data-bs-toggle="pill"]');

            pills.forEach(pill => {
                pill.addEventListener('shown.bs.tab', (event) => {
                    const {target}       = event;
                    const {id: targetId} = target;

                    savePillId(targetId);
                });
            });

            const savePillId = (selector) => {
                localStorage.setItem('activePillId', selector);
            };

            const getPillId = () => {
                const activePillId = localStorage.getItem('activePillId');

                // if local storage item is null, show default tab
                if (!activePillId) return;

                // call 'show' function
                const someTabTriggerEl = document.querySelector(`#${activePillId}`)
                const tab              = new bootstrap.Tab(someTabTriggerEl);

                tab.show();
            };

            // get pill id on load
            getPillId();
        </script>
        <script>
            function copyLink(e) {
                var a = $('#profileLink').val()
                navigator.clipboard.writeText(a);

            }

            $(window).ready(function () {
                $('i').addClass('fs-5')
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
                $("#sortable1").sortable({ axis: 'y' });
                $("#sortable").sortable({ axis: 'y' });

            });
        </script>
        <script>
            $(document).ready(function () {

                let button1 = $('.b1');
                let button2 = $('.b2');

                let button3 = $('.b3');
                let button4 = $('.b4');

                button1.on('click', function () {
                    rc()
                    button1.addClass('selected')
                })
                button2.on('click', function () {
                    rc()
                    button2.addClass('selected')
                })
                button3.on('click', function () {
                    rc2()
                    button3.addClass('selected')
                })
                button4.on('click', function () {
                    rc2()
                    button4.addClass('selected')
                })

                function rc() {
                    button1.removeClass('selected')
                    button2.removeClass('selected')
                }

                function rc2() {
                    button3.removeClass('selected')
                    button4.removeClass('selected')
                }
            })
        </script>
    @endpush
</div>
