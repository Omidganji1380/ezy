<div>
    @push('css')
        <link rel="stylesheet" href="{{asset('pageBuilder/assets/css/style.css')}}">
        <style>
            .textareaTextBlock {
                font: inherit;
                letter-spacing: inherit;
                color: currentcolor;
                margin: 0;
                -webkit-tap-highlight-color: transparent;
                display: block;
                min-width: 0;
                width: 100%;
                animation-name: mui-auto-fill-cancel;
                animation-duration: 10ms;
                resize: none;
                border: 0;
                unicode-bidi: plaintext;
            }

            .form-control, .form-select {
                border: 0 !important;
            }

            .blockText {
                margin: 0 0 22px;
                width: 100%;
                white-space: pre-wrap;
                word-break: break-word;
                unicode-bidi: plaintext;
                font-family: inherit;
            }

            .bgImgSelected {
                border: 0.13rem solid red;
                padding: 0.3rem;
                border-radius: 0.3rem;
            }
            .menuTitle::before{
                content:'';
                background: repeating-linear-gradient(to right, currentColor, currentColor 1px, transparent 2px, transparent 4px);
                height: 1px;
                flex-grow: 1;
                display: inline-block;
                margin-top: 1em;
            }
        </style>
    @endpush
    <div style="{{$this->getBackgroundImage()}};max-width: 600px" class="container">
        <div class="row" style="height: 100%;overflow-y: auto">
            <div class="col-12" style="border-radius: 20px;box-shadow: rgba(0,0,0,0.2) 0 0 20px;">
                <div class="row p-2 justify-content-end flex-nowrap text-white">
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
            <div id="sortable" style="cursor: grab;margin-bottom: 9rem !important;" {{--wire:ignore--}}>
                @foreach($blocks as $key=>$block)
                    <div class="col-12 my-3" id="sortKey-{{$block->id}}">
                        <div class="row p-2 flex-nowrap">
                            {{--                            <input type="text" class="form-control" value="{{count($block->banner)}}">--}}
                            <div class="col-11" onclick="showFirstTab()"
                                 data-bs-toggle="modal"
                                 @if(count($block->banner))
                                     data-bs-target="#blockBannerOptions"
                                 wire:click="blockBannerOptions({{$block->id}})"
                                 @elseif(count($block->text))
                                     data-bs-target="#blockTextOptions"
                                 wire:click="blockTextOptionsTrait({{$block->id}})"
                                 @elseif(count($block->fair))
                                     data-bs-target="#blockFairOptions"
                                 wire:click="blockFailOptions({{$block->id}})"
                                 @elseif(count($block->menu))
                                     data-bs-target="#blockMenuOptions"
                                 wire:click="blockMenuOptions({{$block->id}})"
                                 @else
                                     data-bs-target="#blockOptions"
                                 wire:click="blockOptions({{$block->id}})"
                                @endif
                            >
                                <div class="row justify-content-center">
                                    @if(!count($block->text))
                                        <div class="col-12 text-center">
                                            <p class="text-center">{{$block->blockOption->blockTitle}}</p>
                                        </div>
                                    @endif
                                    @foreach($block->pbOption()->get() as $option)
                                        {{--                                                                                @dd($block->blockOption->blockItemColor)--}}
                                        <div
                                            class="{{$this->setBlockWidthHalf($block->blockOption->blockWidth,$loop->last,$loop->index)}} {{$this->setBlockWidth($block->blockOption->blockWidth)}} text-center p-1">
                                            <button dir="rtl" {{--style=""--}}
                                            class="btn border-info w-100 overflow-hidden text-truncate px-1"
                                                    style="border-radius: {{$this->getBlockItemsBorder($block)}};
                                                    background-{{$block->blockOption->blockItemColor==2?'color':'image'}}: {{$this->getBgBlockItemColor($block,$option->color)}};
                                                    border-color: {{$this->getBorderBlockItemColor($block)}} !important;
                                                    color: {{$this->getTextBlockItemColor($block)}}"
                                            >
                                                <div
                                                    class="row justify-content-center {{--ez-solid-aparat--}} flex-nowrap"
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
                                    @if(count($block->banner))
                                        <div class="col-12 text-center p-1">
                                            <div id="myCarousel{{$key}}" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach($block->banner as $key=>$banner)
                                                        {{--                                                        <div class="carousel-caption">--}}
                                                        <div class="carousel-item {{$loop->first?'active':''}}">
                                                            <button dir="rtl" style=""
                                                                    class="btn w-100 overflow-hidden text-truncate px-1"
                                                                    style="border-radius: {{$this->getBlockItemsBorder($block)}};
                                                                            background-{{$block->blockOption->blockItemColor==2?'color':'image'}}: {{$this->getBgBlockItemColor($block)}};
                                                                            border-color: {{$this->getBorderBlockItemColor($block)}} !important;
                                                                            color: {{$this->getTextBlockItemColor($block)}}"
                                                            >
                                                                <img class="w-100"
                                                                     src="{{asset('storage/pb/profiles/profile-'.$profile->id.'/banners/banner-'.$banner->id.'/'.$banner->image)}}"
                                                                     alt="">
                                                            </button>
                                                        </div>
                                                        {{--                                                        </div>--}}
                                                    @endforeach
                                                </div>
                                                @if(count($block->banner)>1)
                                                    <button class="carousel-control-prev" type="button"
                                                            data-bs-target="#myCarousel{{$key}}" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon"
                                                              aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button"
                                                            data-bs-target="#myCarousel{{$key}}" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon"
                                                              aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    @if(count($block->fair))
                                        @foreach($block->fair as $item)
                                            {{--                                            @dd($block->pbOption()->get())--}}
                                            <div
                                                class="{{$this->setBlockWidthHalf($block->blockOption->blockWidth,$loop->last,$loop->index)}} {{$this->setBlockWidth($block->blockOption->blockWidth)}} text-center p-1">
                                                <button dir="rtl" {{--style=""--}}
                                                class="btn border-info w-100 overflow-hidden text-truncate px-1"
                                                        style="border-radius: {{$this->getBlockItemsBorder($block)}};
                                                    background-{{$block->blockOption->blockItemColor==2?'color':'image'}}: {{$this->getBgBlockItemColor($block)}};
                                                    border-color: {{$this->getBorderBlockItemColor($block)}} !important;
                                                    color: {{$this->getTextBlockItemColor($block)}}"
                                                >
                                                    <div class="row flex-nowrap"
                                                         style="{{$block->blockOption->blockItemColor==2?'':'background: '.$this->getTextBlockItemColor($block).';-webkit-background-clip: text;-webkit-text-fill-color: transparent;'}}"
                                                    >
                                                        <div
                                                            class="col-auto align-self-center {{$block->blockOption->blockWidth!='compress'?'ps-0':''}}">
                                                            <img class="mx-2 align-middle iii object-cover"
                                                                 style="width: 60px;height: 60px;border-radius: 50%"
                                                                 src="{{asset('storage/pb/profiles/profile-'.$profile->id.'/fairs/fair-'.$item->id.'/'.$item->img)}}"
                                                                 alt="">
                                                        </div>
                                                        @if($block->blockOption->blockWidth!='compress')
                                                            <div
                                                                class="col-auto pe-0 align-self-center"
                                                                style="text-align: right">
                                                                @if($item->title)
                                                                    <p class="fs-6 font-weight-bold m-0">
                                                                        {{$item->title}}
                                                                    </p>
                                                                @endif
                                                                @if($item->description)
                                                                    <p class="m-0">
                                                                        {{$item->description}}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                            <div
                                                                class="col-auto pe-4 icofont-download align-self-center ms-auto fs-4"></div>
                                                        @endif
                                                    </div>
                                                </button>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if(count($block->menu))
                                        @foreach($block->menu as $item)
                                            <ul class="w-100">
                                                <li>
                                                    <h5 class="d-flex w-100">
                                                    {{$item->title}}
                                                    <span class="text-start d-flex flex-grow-1 menuTitle">{{$item->price}}</span>
                                                    </h5>
                                                    <p>{{$item->description}}</p>
                                                </li>
                                            </ul>
                                        @endforeach
                                    @endif
                                    @if(count($block->text))
                                        <div class="col-12 text-center p-1 blockTex"
                                             style="margin: -40px 0;{{$block->text()->where('block_id',$block->id)->first()->textSize}}{{$block->text()->where('block_id',$block->id)->first()->textAlign}}color:{{$block->text()->where('block_id',$block->id)->first()->textColor}}">
                                            {!! $block->text()->where('block_id',$block->id)->first()->text !!}
                                        </div>
                                    @endif
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
                        <li class="list-group-item my-1 border-dark px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#blockMenuOptions"
                            wire:click="getOptionsMenu('menu',true)">
                            <div class="row flex-nowrap  justify-content-sm-start">
                                <div class="col-2 text-center pe-0 align-self-center">
                                    <i class="icofont-restaurant-menu" style="font-size: 50px !important;"></i>
                                </div>
                                <div class="col-10 col-sm-auto px-0 text-truncate ps-3" style="max-width: 80%">
                                    <h4>منو</h4>
                                    <p class="m-0">امکان اضافه کردن منوی رستوران</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#blockFairOptions"
                            wire:click="getOptionsFair('fair',true)">
                            <div class="row flex-nowrap  justify-content-sm-start">
                                <div class="col-2 text-center pe-0 align-self-center">
                                    <i class="icofont-building-alt" style="font-size: 50px !important;"></i>
                                </div>
                                <div class="col-10 col-sm-auto px-0 text-truncate ps-3" style="max-width: 80%">
                                    <h4>نمایشگاه</h4>
                                    <p class="m-0">امکان اضافه کردن غرفه های سالن نمایشگاه</p>
                                </div>
                            </div>
                        </li>
                        <li
                            data-bs-toggle="modal"
                            data-bs-target="#insertMessengers"
                            wire:click="getOptions('messenger',true)"
                            class="list-group-item my-1 border-dark px-4">
                            <div class="row flex-nowrap  justify-content-sm-start">
                                <div class="col-2 text-center pe-0">
                                    <i class="ez ez-chat-writing"></i>
                                </div>
                                <div class="col-10 col-sm-auto px-0 text-truncate ps-3" style="max-width: 80%">
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
                                <div class="col-10 col-sm-auto px-0 text-truncate ps-3" style="max-width: 80%">
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
                                <div class="col-10 col-sm-auto px-0 text-truncate ps-3" style="max-width: 80%">
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
                                <div class="col-10 col-sm-auto px-0 text-truncate ps-3" style="max-width: 80%">
                                    <h4>ساخت ذخیره خودکار مخاطب</h4>
                                    <p class="m-0">فایل vcf خود را بسازید</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#blockBannerOptions"
                            wire:click="getOptionsBanner('banner',true)">
                            <div class="row flex-nowrap  justify-content-sm-start">
                                <div class="col-2 text-center pe-0">
                                    <i class="ez ez-photo">
                                        {!! $this->getIconPaths() !!}
                                    </i>
                                </div>
                                <div class="col-10 col-sm-auto px-0 text-truncate ps-3" style="max-width: 80%">
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
                                <div class="col-10 col-sm-auto px-0 text-truncate ps-3" style="max-width: 80%">
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
                                <div class="col-10 col-sm-auto px-0 text-truncate ps-3" style="max-width: 80%">
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
                                <div class="col-10 col-sm-auto px-0 text-truncate ps-3" style="max-width: 80%">
                                    <h4>مسیریابی</h4>
                                    <p class="m-0">نمایش آدرس بر روی نقشه</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item my-1 border-dark px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#blockTextOptions"
                            wire:click="getOptionsText('text',true)">
                            <div class="row flex-nowrap  justify-content-sm-start">
                                <div class="col-2 text-center pe-0">
                                    <i class="ez ez-text-align-center"></i>
                                </div>
                                <div class="col-10 col-sm-auto px-0 text-truncate ps-3" style="max-width: 80%">
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
                                <button class="btn w-100"
                                        data-bs-toggle="modal"
                                        data-bs-target="#blockOptions"
                                        wire:click="insertBlock({{$item->id}})"
                                        style="background-color: {{$item->color}};border: 1px solid #c4c4c4"
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
                            <ul class="nav nav-pills mb-3 row pills-tab" id="" role="tablist" wire:ignore>
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
                        <div class="col-12 my-3 tab-content">
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
                                        <p class="text-black-50 small">در صورت تمایل می‌توانید برای این بلوک یک
                                            عنوان
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
                                                                <label class="btn w-100"
                                                                       for="blockItemWidthCompress"
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
                                        <div class="@if($blockItemColor!=3) d-none @endif my-2"
                                             id="blockItemColor3">
                                            <div class="btn btnNoFocus w-100 py-2 bg-white"
                                                 style="text-align: right;border: 1px solid lightgrey">
                                                پس‌زمینه بلوک‌ها
                                                <div wire:ignore class="my-4 grapick"></div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <select class="form-select"
                                                                {{--wire:model="bgBlockItemColor"--}}
                                                                id="switch-type">
                                                            <option value>- انتخاب کنید -</option>
                                                            <option value="radial">radial</option>
                                                            <option value="linear">linear</option>
                                                            <option value="repeating-radial">repeating-radial
                                                            </option>
                                                            <option value="repeating-linear">repeating-linear
                                                            </option>
                                                        </select>
                                                        {{--                                                        @endif--}}
                                                    </div>
                                                    <div class="col-6">
                                                        <select class="form-select" id="switch-angle">
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
                                            </div>
                                            <div class="btn btnNoFocus w-100 py-2 bg-white my-2"
                                                 style="text-align: right;border: 1px solid lightgrey">
                                                عناوین آیتم‌ها
                                                <div wire:ignore class="my-4 grapick1"></div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <select class="form-select " id="switch-type1">
                                                            <option value>- انتخاب کنید -</option>
                                                            <option value="radial">radial</option>
                                                            <option value="linear">linear</option>
                                                            <option value="repeating-radial">repeating-radial
                                                            </option>
                                                            <option value="repeating-linear">repeating-linear
                                                            </option>
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
                                            </div>
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
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-outline-info" data-bs-dismiss="modal" wire:click="clearInputs">
                                انصراف
                            </button>
                            <button class="btn btn-info text-white" data-bs-dismiss="modal"
                                    wire:click="submitPbOption">
                                ذخیره
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--banner options--}}
    <div class="modal fade rounded" wire:ignore.self id="blockBannerOptions" tabindex="-1" aria-hidden="true">
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
                    @if(!$blockBannerItems)
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
                            <ul class="nav nav-pills mb-3 row pills-tab" id="" role="tablist" wire:ignore>
                                <li class="nav-item btn b1 selected col-6" role="presentation">
                                    <button class="btn btnNoFocus active w-100" id="properties1-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#properties1" type="button" role="tab"
                                            aria-controls="properties1" aria-selected="true">مشخصات
                                    </button>
                                </li>
                                <li class="nav-item btn b2 col-6" role="presentation">
                                    <button class="btn btnNoFocus w-100 " id="moreOptions1-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#moreOptions1" type="button" role="tab"
                                            aria-controls="moreOptions1" aria-selected="false">تنظیمات بیشتر
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 my-3 tab-content">
                            <div class="tab-pane fade show active" id="properties1" role="tabpanel"
                                 aria-labelledby="properties1-tab" wire:ignore.self>
                                <div class="row">
                                    <div class="col-12">
                                        <button {{--data-bs-target="#insertMessengers" data-bs-toggle="modal"--}}
                                                wire:click="getOptionsBanner('{{$title}}',false)"
                                                class="text-success w-100 text-center btn bg-success bg-opacity-10 border-success btnNoFocus"
                                                style="border: 2px dashed">
                                            <i class="icofont-plus"></i>
                                            آیتم دیگری به همین بلوک اضافه کنید
                                        </button>
                                    </div>
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div style="cursor: grab;" id="sortable2">
                                                @foreach($blockBannerItems as $key=>$item)
                                                    <div class="my-1 col-12">
                                                        <div
                                                            class="row bg-white border border-3 mx-0 justify-content-between">
                                                            <div class="col-11 position-relative">
                                                                <button onclick="removeShow({{$item->id}})"
                                                                        class="btn w-100 bg-white py-3 btnNoFocus ms-4"
                                                                        role="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#itemBanner{{$item->id}}"
                                                                        aria-expanded="false"
                                                                        aria-controls="itemBanner{{$item->id}}">
                                                                    <div class="row" style="width: fit-content">

                                                                        <div class="col-auto" dir="rtl">
                                                                            آیتم {{$key+1}}
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                                <div
                                                                    class="position-absolute top-50 translate-middle-y">
                                                                    <i class="fa fa-arrows-up-down-left-right"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-1 p-1 text-center position-relative">
                                                                <button
                                                                    wire:click="deleteBlockBannerItem({{$item->id}})"
                                                                    wire:confirm="آیتم ( {{$item->title}} ) حذف شود؟"
                                                                    type="button"
                                                                    class="btn btnNoFocus p-0 position-absolute start-0 top-0 bottom-0"
                                                                    style="right: 0">
                                                                    <i class="icofont-trash text-danger fs-6"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="accordion accordion-flush"
                                                             id="accordionParentBanner{{$item->id}}">
                                                            <div wire:ignore.self
                                                                 class="collapse text-black accordion-collapse blockItemAccordion bg-white border border-3 border-top-0"
                                                                 id="itemBanner{{$item->id}}"
                                                                 data-bs-parent="#accordionParentBanner{{$item->id}}">
                                                                <div class="row">
                                                                    <div class="col-12 my-3 px-4">
                                                                        <label class="text-black-50 my-1">بارگذاری
                                                                            عکس</label>
                                                                        {{--                                                                        <input value="{{$bannerImageUpload&&isset($bannerImageUpload[$item->id])}}">--}}
                                                                        <div
                                                                            class="position-relative w-100 rounded text-center py-2 align-middle"
                                                                            style="background-color: #cfffcf;border: 2px dashed green;height: 150px">
                                                                            <div
                                                                                class="position-absolute h-100 w-100 top-50 translate-middle-y">
                                                                                <img
                                                                                    src="{{isset($bannerImageUpload[$item->id])?$bannerImageUpload[$item->id]->temporaryUrl():asset('storage/pb/profiles/profile-'.$profile->id.'/banners/banner-'.$item->id.'/'.$item->image)}}"
                                                                                    class="position-absolute h-100 py-2 mx-auto start-0"
                                                                                    alt=""
                                                                                    style="right: 0"
                                                                                    wire:click="removeBannerImg({{$item->id}})"
                                                                                    wire:confirm="حذف شود؟">
                                                                                <img wire:loading
                                                                                     wire:target="bannerImageUpload.{{$item->id}}"
                                                                                     src="{{asset('pageBuilder/loading.gif')}}"
                                                                                     class="position-absolute h-100 py-2 mx-auto start-0"
                                                                                     style="right: 0">
                                                                                @if(!$item->image)
                                                                                    <input type="file"
                                                                                           class="opacity-0 h-100 w-100"
                                                                                           wire:model="bannerImageUpload.{{$item->id}}">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 my-3 px-4">
                                                                        <label
                                                                            class="text-black-50">عنوان
                                                                            (اختیاری)</label>
                                                                        <input type="text"
                                                                               class="my-2 form-control"
                                                                               {{--                                                                               onkeyup="document.querySelector('span.blockItemConnectionWay{{$key}}').innerText=('( '+ this.value +' )');--}}
                                                                               {{--                                                                               document.querySelector('span.blockItemConnectionWay{{$key}}').innerText==='( )'?document.querySelector('span.blockItemConnectionWay{{$key}}').innerText='':''"--}}
                                                                               value="{{$item->title}}"
                                                                               wire:model="bannerTitle.{{$item->id}}"
                                                                               placeholder="عنوان تصویر خود را وارد کنید">
                                                                        <p class="text-black-50 small">برای مثال:
                                                                            میزچوبی</p>
                                                                    </div>
                                                                    <div class="col-12 my-3 px-4">
                                                                        <label
                                                                            class="text-black-50">توضیحات
                                                                            (اختیاری)</label>
                                                                        <input type="text"
                                                                               class="my-2 form-control"
                                                                               {{--                                                                               onkeyup="document.querySelector('span.blockItemConnectionWay{{$key}}').innerText=('( '+ this.value +' )');--}}
                                                                               {{--                                                                               document.querySelector('span.blockItemConnectionWay{{$key}}').innerText==='( )'?document.querySelector('span.blockItemConnectionWay{{$key}}').innerText='':''"--}}
                                                                               value="{{$item->description}}"
                                                                               wire:model="bannerDescription.{{$item->id}}"
                                                                               placeholder="توضیحات خود را وارد کنید">
                                                                        <p class="text-black-50 small">برای مثال:
                                                                            میز
                                                                            چوبی چهار نفره با چوب گردو</p>
                                                                    </div>
                                                                    <div class="col-12 my-3 px-4">
                                                                        <label
                                                                            class="text-black-50">متن دکمه
                                                                            لینک</label>
                                                                        <input type="text"
                                                                               class="my-2 form-control"
                                                                               {{--                                                                               onkeyup="document.querySelector('span.blockItemConnectionWay{{$key}}').innerText=('( '+ this.value +' )');--}}
                                                                               {{--                                                                               document.querySelector('span.blockItemConnectionWay{{$key}}').innerText==='( )'?document.querySelector('span.blockItemConnectionWay{{$key}}').innerText='':''"--}}
                                                                               value="{{$item->description}}"
                                                                               wire:model="bannerButton.{{$item->id}}"
                                                                               placeholder="متن دکمه لینک خود را وارد کنید">
                                                                        <p class="text-black-50 small">برای مثال:
                                                                            همین
                                                                            حالا کلیک کنید</p>
                                                                    </div>
                                                                    <div class="col-12 my-3 px-4">
                                                                        <label
                                                                            class="text-black-50">لینک و آدرس
                                                                            وب‌سایت</label>
                                                                        <input type="text"
                                                                               class="my-2 form-control"
                                                                               {{--                                                                               onkeyup="document.querySelector('span.blockItemConnectionWay{{$key}}').innerText=('( '+ this.value +' )');--}}
                                                                               {{--                                                                               document.querySelector('span.blockItemConnectionWay{{$key}}').innerText==='( )'?document.querySelector('span.blockItemConnectionWay{{$key}}').innerText='':''"--}}
                                                                               value="{{$item->description}}"
                                                                               wire:model="bannerLink.{{$item->id}}"
                                                                               placeholder="لینک وبسایت خود را وارد کنید">
                                                                        <p class="text-black-50 small">برای مثال:
                                                                            https://yoursite.com</p>
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
                            <div class="tab-pane fade" id="moreOptions1" role="tabpanel"
                                 wire:ignore.self aria-labelledby="moreOptions1-tab">
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
                                        <p class="text-black-50 small">در صورت تمایل می‌توانید برای این بلوک یک
                                            عنوان
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
                                                                <label class="btn w-100"
                                                                       for="blockItemWidthCompress"
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
                                        <div class="@if($blockItemColor!=3) d-none @endif my-2"
                                             id="blockItemColor3">
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
                                                            <option value="repeating-radial">repeating-radial
                                                            </option>
                                                            <option value="repeating-linear">repeating-linear
                                                            </option>
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
                                                            <option value="repeating-radial">repeating-radial
                                                            </option>
                                                            <option value="repeating-linear">repeating-linear
                                                            </option>
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
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-outline-info" data-bs-dismiss="modal" wire:click="clearInputs">
                                انصراف
                            </button>
                            <button class="btn btn-info text-white" data-bs-dismiss="modal"
                                    wire:click="submitBanner">
                                ذخیره
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--fair options--}}
    <div class="modal fade rounded" wire:ignore.self id="blockFairOptions" tabindex="-1" aria-hidden="true">
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
                    @if(!$blockFairItems)
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
                            <ul class="nav nav-pills mb-3 row pills-tab" id="" role="tablist" wire:ignore>
                                <li class="nav-item btn b1 selected col-6" role="presentation">
                                    <button class="btn btnNoFocus active w-100" id="properties12-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#properties12" type="button" role="tab"
                                            aria-controls="properties12" aria-selected="true">مشخصات
                                    </button>
                                </li>
                                <li class="nav-item btn b2 col-6" role="presentation">
                                    <button class="btn btnNoFocus w-100 " id="moreOptions12-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#moreOptions12" type="button" role="tab"
                                            aria-controls="moreOptions12" aria-selected="false">تنظیمات بیشتر
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 my-3 tab-content">
                            <div class="tab-pane fade show active" id="properties12" role="tabpanel"
                                 aria-labelledby="properties12-tab" wire:ignore.self>
                                <div class="row">
                                    <div class="col-12">
                                        <button {{--data-bs-target="#insertMessengers" data-bs-toggle="modal"--}}
                                                wire:click="getOptionsFair('{{$title}}',false)"
                                                class="text-success w-100 text-center btn bg-success bg-opacity-10 border-success btnNoFocus"
                                                style="border: 2px dashed">
                                            <i class="icofont-plus"></i>
                                            آیتم دیگری به همین بلوک اضافه کنید
                                        </button>
                                    </div>
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div style="cursor: grab;" id="sortable3">
                                                @foreach($blockFairItems as $key=>$item)
                                                    <div class="my-1 col-12">
                                                        <div
                                                            class="row bg-white border border-3 mx-0 justify-content-between">
                                                            <div class="col-11 position-relative">
                                                                <button onclick="removeShow({{$item->id}})"
                                                                        class="btn w-100 bg-white py-3 btnNoFocus ms-4"
                                                                        role="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#itemFair{{$item->id}}"
                                                                        aria-expanded="false"
                                                                        aria-controls="itemFair{{$item->id}}">
                                                                    <div class="row" style="width: fit-content">
                                                                        <div class="col-auto" dir="rtl">
                                                                            آیتم {{$key+1}}
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                                <div
                                                                    class="position-absolute top-50 translate-middle-y">
                                                                    <i class="fa fa-arrows-up-down-left-right"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-1 p-1 text-center position-relative">
                                                                <button
                                                                    wire:click="deleteBlockFairItem({{$item->id}})"
                                                                    wire:confirm="آیتم ( {{$item->title}} ) حذف شود؟"
                                                                    type="button"
                                                                    class="btn btnNoFocus p-0 position-absolute start-0 top-0 bottom-0"
                                                                    style="right: 0">
                                                                    <i class="icofont-trash text-danger fs-6"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="accordion accordion-flush"
                                                             id="accordionParentFair{{$item->id}}">
                                                            <div wire:ignore.self
                                                                 class="collapse text-black accordion-collapse blockItemAccordion bg-white border border-3 border-top-0"
                                                                 id="itemFair{{$item->id}}"
                                                                 data-bs-parent="#accordionParentFair{{$item->id}}">
                                                                <div class="row">
                                                                    <div class="col-12 my-3 px-4">
                                                                        <label class="text-black-50 my-1">بارگذاری
                                                                            عکس</label>
                                                                        {{--                                                                        <input value="{{$bannerImageUpload&&isset($bannerImageUpload[$item->id])}}">--}}
                                                                        <div
                                                                            class="position-relative w-100 rounded text-center py-2 align-middle"
                                                                            style="background-color: #cfffcf;border: 2px dashed green;height: 150px">
                                                                            <div
                                                                                class="position-absolute h-100 w-100 top-50 translate-middle-y">
                                                                                <img
                                                                                    src="{{isset($fairImageUpload[$item->id])?$fairImageUpload[$item->id]->temporaryUrl():asset('storage/pb/profiles/profile-'.$profile->id.'/fairs/fair-'.$item->id.'/'.$item->img)}}"
                                                                                    class="position-absolute h-100 py-2 mx-auto start-0"
                                                                                    alt=""
                                                                                    style="right: 0"
                                                                                    wire:click="removeFairImg({{$item->id}})"
                                                                                    wire:confirm="حذف شود؟">
                                                                                <img wire:loading
                                                                                     wire:target="fairImageUpload.{{$item->id}}"
                                                                                     src="{{asset('pageBuilder/loading.gif')}}"
                                                                                     class="position-absolute h-100 py-2 mx-auto start-0"
                                                                                     style="right: 0">
                                                                                @if(!$item->img)
                                                                                    <input type="file"
                                                                                           class="opacity-0 h-100 w-100"
                                                                                           wire:model="fairImageUpload.{{$item->id}}">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 my-3 px-4">
                                                                        <label
                                                                            class="text-black-50">عنوان
                                                                            (اختیاری)</label>
                                                                        <input type="text"
                                                                               class="my-2 form-control"
                                                                               value="{{$item->title}}"
                                                                               wire:model="fairTitle.{{$item->id}}"
                                                                               placeholder="عنوان غرفه خود را وارد کنید">
                                                                        <p class="text-black-50 small">برای مثال:
                                                                            غرفه ظروف سفالی</p>
                                                                    </div>
                                                                    <div class="col-12 my-3 px-4">
                                                                        <label
                                                                            class="text-black-50">توضیحات
                                                                            (اختیاری)</label>
                                                                        <input type="text"
                                                                               class="my-2 form-control"
                                                                               {{--                                                                               onkeyup="document.querySelector('span.blockItemConnectionWay{{$key}}').innerText=('( '+ this.value +' )');--}}
                                                                               {{--                                                                               document.querySelector('span.blockItemConnectionWay{{$key}}').innerText==='( )'?document.querySelector('span.blockItemConnectionWay{{$key}}').innerText='':''"--}}
                                                                               value="{{$item->description}}"
                                                                               wire:model="fairDescription.{{$item->id}}"
                                                                               placeholder="توضیحات غرفه خود را وارد کنید">
                                                                        <p class="text-black-50 small">برای مثال: غرفه
                                                                            شماره 3501</p>
                                                                    </div>
                                                                    <div class="col-12 my-3 px-4">
                                                                        <label
                                                                            class="text-black-50">لینک فایل</label>
                                                                        <input type="text"
                                                                               class="my-2 form-control"
                                                                               {{--                                                                               onkeyup="document.querySelector('span.blockItemConnectionWay{{$key}}').innerText=('( '+ this.value +' )');--}}
                                                                               {{--                                                                               document.querySelector('span.blockItemConnectionWay{{$key}}').innerText==='( )'?document.querySelector('span.blockItemConnectionWay{{$key}}').innerText='':''"--}}
                                                                               value="{{$item->link}}"
                                                                               wire:model="fairLink.{{$item->id}}"
                                                                               placeholder="لینک PDF غرفه خود را وارد کنید">
                                                                        <p class="text-black-50 small">برای مثال:
                                                                            Https://ezy.company/dl/3501.pdf</p>
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
                            <div class="tab-pane fade" id="moreOptions12" role="tabpanel"
                                 wire:ignore.self aria-labelledby="moreOptions12-tab">
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
                                        <p class="text-black-50 small">در صورت تمایل می‌توانید برای این بلوک یک
                                            عنوان
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
                                                                <label class="btn w-100"
                                                                       for="blockItemWidthCompress"
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
                                                onchange="blockItemColor33(this.value)"
                                        >
                                            <option value="1">استفاده از رنگ‌های شخصی‌سازی شده</option>
                                            <option value="2">استفاده از رنگ برندها</option>
                                            <option value="3">انتخاب رنگ دلخواه برای آیتم‌های این بلوک</option>
                                        </select>
                                        <div class="@if($blockItemColor!=3) {{--d-none--}} @endif my-2"
                                             id="blockItemColor33">
                                            <button class="btn btnNoFocus w-100 py-2 bg-white"
                                                    style="text-align: right;border: 1px solid lightgrey">
                                                پس‌زمینه بلوک‌ها
                                                <div wire:ignore class="my-4 grapick2"></div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <select class="form-select " id="switch-type2">
                                                            <option value>- انتخاب کنید -</option>
                                                            <option value="radial">radial</option>
                                                            <option value="linear">linear</option>
                                                            <option value="repeating-radial">repeating-radial
                                                            </option>
                                                            <option value="repeating-linear">repeating-linear
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <select class="form-select " id="switch-angle2">
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
                                                <div wire:ignore class="my-4 grapick3"></div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <select class="form-select " id="switch-type3">
                                                            <option value>- انتخاب کنید -</option>
                                                            <option value="radial">radial</option>
                                                            <option value="linear">linear</option>
                                                            <option value="repeating-radial">repeating-radial
                                                            </option>
                                                            <option value="repeating-linear">repeating-linear
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <select class="form-select " id="switch-angle3">
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
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-outline-info" data-bs-dismiss="modal" wire:click="clearInputs">
                                انصراف
                            </button>
                            <button class="btn btn-info text-white" data-bs-dismiss="modal"
                                    wire:click="submitFair">
                                ذخیره
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--text Options--}}
    <div class="modal fade rounded" wire:ignore.self id="blockTextOptions" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered {{--modal-lg--}}">
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

                <div class="modal-body position-relative" style="background-color: rgb(241, 243, 246);">
                    {{--<div wire:loading class="position-absolute w-100 h-100 bg-white start-0 top-0" style="z-index: 99">
                        <img
                            src="{{asset('pageBuilder/loading.gif')}}"
                            class="position-absolute h-100 py-2 mx-auto start-0 w-100"
                            style="right: 0;max-height: 100%;object-fit: none">
                    </div>--}}
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-pills mb-3 row pills-tab" id="" role="tablist" wire:ignore>
                                <li class="nav-item btn b1 selected col-6" role="presentation">
                                    <button class="btn btnNoFocus active w-100" id="profileProperties112-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#profileProperties112" type="button" role="tab"
                                            aria-controls="profileProperties112" aria-selected="true">مشخصات
                                    </button>
                                </li>
                                <li class="nav-item btn b2 col-6" role="presentation">
                                    <button class="btn btnNoFocus w-100 " id="profileMoreOptions112-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#profileMoreOptions112" type="button" role="tab"
                                            aria-controls="profileMoreOptions112" aria-selected="false">تنظیمات بیشتر
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 my-3 tab-content" id="accordionParentProfile112">
                            <div class="tab-pane fade show active" id="profileProperties112" role="tabpanel"
                                 aria-labelledby="profileProperties112-tab" wire:ignore.self>
                                <div class="row">
                                    <div class="col-12 my-3" {{--wire:ignore--}}>
                                        <label class="text-black-50 my-1">متن *</label>
                                        <textarea class="form-control rounded textareaTextBlock"
                                                  wire:model="blockTextText" rows="5" {{--id="editor"--}}>
                                            {!! $blockTextText !!}
                                        </textarea>
                                    </div>
                                    <div class="col-12 my-3">
                                        <label class="text-black-50 my-1">اندازه متن</label>
                                        <select class="form-select rounded" wire:model="blockTextSize">
                                            <option value="font-size: 14px !important;font-weight: 400 !important;">متن
                                                کوچک
                                            </option>
                                            <option value="font-size: 16px !important;font-weight: 400 !important;">متن
                                                متوسط
                                            </option>
                                            <option value="font-size: 18px !important;font-weight: 400 !important;">متن
                                                بزرگ
                                            </option>
                                            <option value="font-size: 18px !important;font-weight: 700 !important;">
                                                عنوان کوچک
                                            </option>
                                            <option value="font-size: 20px !important;font-weight: 700 !important;">
                                                عنوان متوسط
                                            </option>
                                            <option value="font-size: 22px !important;font-weight: 700 !important;">
                                                عنوان بزرگ
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-12 my-3">
                                        <label class="text-black-50 my-1">جهت متن</label>
                                        <select class="form-select rounded" wire:model="blockTextAlign">
                                            <option value="text-align: right !important;">راست چین</option>
                                            <option value="text-align: left !important;">چپ چین</option>
                                            <option value="text-align: center !important;">وسط چین</option>
                                            <option value="text-align: justify !important;">جاستیفای</option>
                                        </select>
                                    </div>
                                    <div class="col-12 my-3">
                                        <label class="text-black-50 my-1">رنگ متن</label>
                                        <input class="form-control rounded" type="color" wire:model="blockTextColor">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profileMoreOptions112" role="tabpanel"
                                 wire:ignore.self aria-labelledby="profileMoreOptions112-tab">
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
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-outline-info" data-bs-dismiss="modal" wire:click="clearInputs">
                                انصراف
                            </button>
                            <button class="btn btn-info text-white" data-bs-dismiss="modal"
                                    wire:click="submitTextOption">
                                ذخیره
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Menu Options--}}
    <div class="modal fade rounded" wire:ignore.self id="blockMenuOptions" tabindex="-1" aria-hidden="true">
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
                    @if(!$blockFairItems)
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
                            <ul class="nav nav-pills mb-3 row pills-tab" id="" role="tablist" wire:ignore>
                                <li class="nav-item btn b1 selected col-6" role="presentation">
                                    <button class="btn btnNoFocus active w-100" id="properties1222-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#properties1222" type="button" role="tab"
                                            aria-controls="properties1222" aria-selected="true">مشخصات
                                    </button>
                                </li>
                                <li class="nav-item btn b2 col-6" role="presentation">
                                    <button class="btn btnNoFocus w-100 " id="moreOptions1222-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#moreOptions1222" type="button" role="tab"
                                            aria-controls="moreOptions1222" aria-selected="false">تنظیمات بیشتر
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 my-3 tab-content">
                            <div class="tab-pane fade show active" id="properties1222" role="tabpanel"
                                 aria-labelledby="properties1222-tab" wire:ignore.self>
                                <div class="row">
                                    <div class="col-12">
                                        <button {{--data-bs-target="#insertMessengers" data-bs-toggle="modal"--}}
                                                wire:click="getOptionsMenu('{{$title}}',false)"
                                                class="text-success w-100 text-center btn bg-success bg-opacity-10 border-success btnNoFocus"
                                                style="border: 2px dashed">
                                            <i class="icofont-plus"></i>
                                            آیتم دیگری به همین بلوک اضافه کنید
                                        </button>
                                    </div>
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div style="cursor: grab;" {{--id="sortable3"--}}>
                                                @foreach($blockMenuItems as $key=>$item)
                                                    <div class="my-1 col-12">
                                                        <div
                                                            class="row bg-white border border-3 mx-0 justify-content-between">
                                                            <div class="col-11 position-relative">
                                                                <button onclick="removeShow({{$item->id}})"
                                                                        class="btn w-100 bg-white py-3 btnNoFocus ms-4"
                                                                        role="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#itemMenu{{$item->id}}"
                                                                        aria-expanded="false"
                                                                        aria-controls="itemMenu{{$item->id}}">
                                                                    <div class="row" style="width: fit-content">
                                                                        <div class="col-auto" dir="rtl">
                                                                            آیتم {{$key+1}}
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                                <div
                                                                    class="position-absolute top-50 translate-middle-y">
                                                                    <i class="fa fa-arrows-up-down-left-right"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-1 p-1 text-center position-relative">
                                                                <button
                                                                    wire:click="deleteBlockMenuItem({{$item->id}})"
                                                                    wire:confirm="آیتم ( {{$item->title}} ) حذف شود؟"
                                                                    type="button"
                                                                    class="btn btnNoFocus p-0 position-absolute start-0 top-0 bottom-0"
                                                                    style="right: 0">
                                                                    <i class="icofont-trash text-danger fs-6"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="accordion accordion-flush"
                                                             id="accordionParentMenu{{$item->id}}">
                                                            <div wire:ignore.self
                                                                 class="collapse text-black accordion-collapse blockItemAccordion bg-white border border-3 border-top-0"
                                                                 id="itemMenu{{$item->id}}"
                                                                 data-bs-parent="#accordionParentMenu{{$item->id}}">
                                                                <div class="row">
                                                                    <div class="col-6 my-3 px-4">
                                                                        <label
                                                                            class="text-black-50">عنوان</label>
                                                                        <input type="text"
                                                                               class="my-2 form-control"
                                                                               value="{{$item->title}}"
                                                                               wire:model="MenuTitle.{{$item->id}}"
                                                                               placeholder="عنوان را وارد کنید">
                                                                        <p class="text-black-50 small">برای مثال پیتزا ایتالیایی</p>
                                                                    </div>
                                                                    <div class="col-6 my-3 px-4">
                                                                        <label
                                                                            class="text-black-50">قیمت</label>
                                                                        <input type="text"
                                                                               class="my-2 form-control"
                                                                               value="{{$item->price}}"
                                                                               wire:model="MenuPrice.{{$item->id}}"
                                                                               placeholder="قیمت را وارد کنید">
                                                                        <p class="text-black-50 small">برای مثال:
                                                                            50T | 50 هزار تومان</p>
                                                                    </div>
                                                                    <div class="col-12 my-3 px-4">
                                                                        <label
                                                                            class="text-black-50">توضیحات
                                                                            (اختیاری)</label>
                                                                        <input type="text"
                                                                               class="my-2 form-control"
                                                                               value="{{$item->description}}"
                                                                               wire:model="MenuDescription.{{$item->id}}"
                                                                               placeholder="توضیحات غذا را وارد کنید">
                                                                        <p class="text-black-50 small">برای مثال: پنیر، سس، قارچ، گوشت</p>
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
                            <div class="tab-pane fade" id="moreOptions1222" role="tabpanel"
                                 wire:ignore.self aria-labelledby="moreOptions1222-tab">
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
                                        <p class="text-black-50 small">در صورت تمایل می‌توانید برای این بلوک یک
                                            عنوان
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
                                                                <label class="btn w-100"
                                                                       for="blockItemWidthCompress"
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
                                                onchange="blockItemColor33(this.value)"
                                        >
                                            <option value="1">استفاده از رنگ‌های شخصی‌سازی شده</option>
                                            <option value="2">استفاده از رنگ برندها</option>
                                            <option value="3">انتخاب رنگ دلخواه برای آیتم‌های این بلوک</option>
                                        </select>
                                        <div class="@if($blockItemColor!=3) {{--d-none--}} @endif my-2"
                                             id="blockItemColor33">
                                            <button class="btn btnNoFocus w-100 py-2 bg-white"
                                                    style="text-align: right;border: 1px solid lightgrey">
                                                پس‌زمینه بلوک‌ها
                                                <div wire:ignore class="my-4 grapick2"></div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <select class="form-select " id="switch-type2">
                                                            <option value>- انتخاب کنید -</option>
                                                            <option value="radial">radial</option>
                                                            <option value="linear">linear</option>
                                                            <option value="repeating-radial">repeating-radial
                                                            </option>
                                                            <option value="repeating-linear">repeating-linear
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <select class="form-select " id="switch-angle2">
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
                                                <div wire:ignore class="my-4 grapick3"></div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <select class="form-select " id="switch-type3">
                                                            <option value>- انتخاب کنید -</option>
                                                            <option value="radial">radial</option>
                                                            <option value="linear">linear</option>
                                                            <option value="repeating-radial">repeating-radial
                                                            </option>
                                                            <option value="repeating-linear">repeating-linear
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <select class="form-select " id="switch-angle3">
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
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-outline-info" data-bs-dismiss="modal" wire:click="clearInputs">
                                انصراف
                            </button>
                            <button class="btn btn-info text-white" data-bs-dismiss="modal"
                                    wire:click="submitMenu">
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
                            <ul class="nav nav-pills mb-3 row pills-tab" id="" role="tablist" wire:ignore>
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
                    {{--                    <div wire:loading class="position-absolute w-100 h-100 bg-white start-0 top-0" style="z-index: 99">--}}
                    {{--                        <img--}}
                    {{--                            src="{{asset('pageBuilder/loading.gif')}}"--}}
                    {{--                            class="position-absolute h-100 py-2 mx-auto start-0 w-100"--}}
                    {{--                            style="right: 0;max-height: 100%;object-fit: none">--}}
                    {{--                    </div>--}}
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-pills mb-3 row pills-tab" wire:ignore id="" role="tablist">
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
                                            {{--                                            <button class="btn btnNoFocus w-100 py-2 bg-white"--}}
                                            {{--                                                    style="text-align: right;border: 1px solid lightgrey">--}}
                                            {{--                                                ایران سنس--}}
                                            {{--                                                <i class="icofont-rounded-down float-start"></i>--}}
                                            {{--                                            </button>--}}
                                            <select class="form-select">
                                                <option value="ایران سنس">ایران سنس</option>
                                                @foreach($fonts as $font)
                                                    <option value="{{$font->title}}">{{$font->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 my-3">
                                            <label class="text-black-50 my-1">قالب</label>
                                            <button class="btn btnNoFocus w-100 py-2 bg-white"
                                                    style="text-align: right;border: 1px solid lightgrey">
                                                نوشته‌ها و متون
                                                <span class="float-start rounded-circle ms-2"
                                                      style="width: 20px;height: 20px;background-color: #492525"></span>
                                                <span class="float-start" dir="ltr">#492525</span>
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
                                                <span class="float-start" dir="ltr">#492525</span>
                                            </button>
                                            <button class="btn btnNoFocus w-100 py-2 bg-white my-2"
                                                    style="text-align: right;border: 1px solid lightgrey">
                                                عناوین آیتم‌ها
                                                <span class="float-start rounded-circle ms-2"
                                                      style="width: 20px;height: 20px;background-color: #363636"></span>
                                                <span class="float-start" dir="ltr">#363636</span>
                                            </button>
                                            <button class="btn btnNoFocus w-100 py-2 bg-white"
                                                    style="text-align: right;border: 1px solid lightgrey">
                                                حاشیه بلوک‌ها
                                                <span class="float-start rounded-circle ms-2"
                                                      style="width: 20px;height: 20px;background-color: #B1B3B6"></span>
                                                <span class="float-start" dir="ltr">#B1B3B6</span>
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
                                                                        <span class="float-start"
                                                                              dir="ltr">#492525</span>
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
                                                                    <div class="row {{--row-cols-md-3--}}" wire:ignore>
                                                                        @foreach($backgroundImages as $item)
                                                                            <div
                                                                                class="col-4 text-center my-1 align-self-center">
                                                                                <img
                                                                                    class="w-100 bgImgs {{$this->getSelectedBgImg($item->id)}}"
                                                                                    {{--onload="getBgImgSelect({{$item->id}})"--}}
                                                                                    id="bgImgSelect{{$item->id}}"
                                                                                    onclick="bgImgSelect({{$item->id}})"
                                                                                    src="{{asset('storage/pb/bgImages/bgImage-'.$item->id.'/'.$item->img)}}"
                                                                                    alt="">
                                                                            </div>
                                                                        @endforeach
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
                                    wire:click="submitProfileGlobalOptions">
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
            {{--function getBgImgSelect(id){--}}
            {{--    alert($(this).hasClass("bgImgSelected").toString())--}}
            {{--    if($(this).hasClass("bgImgSelected")){--}}
            {{--    @this.--}}
            {{--    set('bgImgSelected', id);--}}
            {{--}--}}
            {{--}--}}
            function bgImgSelect(id) {
                // alert(id)
                $('.bgImgs').removeClass("bgImgSelected");
                $('#bgImgSelect' + id).addClass("bgImgSelected");
                @this.
                set('bgImgSelected', id);
            }
        </script>
        <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/super-build/ckeditor.js"></script>
        <script>
            $(document).ready(function () {

                // This sample still does not showcase all CKEditor 5 features (!)
                // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
                CKEDITOR.ClassicEditor
                        .create(document.getElementById('editor'), {
                            placeholder: 'متن خود را بنویسید',
                        })
                        .then(editor => {
                            $(document).keyup(function () {
                                // setInterval(function (){
                                @this.
                                set('blockTextText', editor.getData());
                                {{--@this.
                                updateTexts();--}}
                                // },5000)
                            });
                        })
                        .catch(error => {
                            console.error(error);
                        });
            });
        </script>
        <script type="text/javascript">
            var upType, unAngle, gp;
            var swType  = document.getElementById('switch-type');
            var swAngle = document.getElementById('switch-angle');

            swType.addEventListener('change', function (e) {
                gp && gp.setType(this.value || 'linear');
            });

            swAngle.addEventListener('change', function (e) {
                gp && gp.setDirection(this.value || 'right');
            });

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
                    @this.
                    set('bgBlockItemColor', gp.getSafeValue());
                })
                gp.emit('change');
            };

            var destroyGrapick = function () {
                gp.destroy();
                gp = 0;
            }

            createGrapick();
            // createGrapick();destroyGrapick();
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
        <script type="text/javascript">
            var upType2, unAngle2, gp2;
            var swType2  = document.getElementById('switch-type2');
            var swAngle2 = document.getElementById('switch-angle2');
            swType2.addEventListener('change', function (e) {
                gp2 && gp2.setType(this.value || 'linear');
            });

            swAngle2.addEventListener('change', function (e) {
                gp2 && gp2.setDirection(this.value || 'right');
            });

            var createGrapick = function () {
                gp2 = new Grapick({
                                      el       : '.grapick2',
                                      direction: 'right',
                                      min      : 1,
                                      max      : 99,
                                  });
                gp2.addHandler(1, '#085078', 1);
                gp2.addHandler(99, '#85D8CE', 1, {keepSelect: 1});
                gp2.on('change', function (complete) {
                    @this.
                    set('bgBlockItemColor', gp2.getSafeValue());
                })
                gp2.emit('change');
            };

            var destroyGrapick = function () {
                gp2.destroy();
                gp2 = 0;
            }

            createGrapick();
        </script>
        <script type="text/javascript">
            var upType3, unAngle3, gp3;
            var swType3  = document.getElementById('switch-type3');
            var swAngle3 = document.getElementById('switch-angle3');
            swType3.addEventListener('change', function (e) {
                gp3 && gp3.setType(this.value || 'linear');
            });

            swAngle3.addEventListener('change', function (e) {
                gp3 && gp3.setDirection(this.value || 'right');
            });

            var createGrapick = function () {
                gp3 = new Grapick({
                                      el       : '.grapick3',
                                      direction: 'right',
                                      min      : 1,
                                      max      : 99,
                                  });
                gp3.addHandler(1, '#085078', 1);
                gp3.addHandler(99, '#85D8CE', 1, {keepSelect: 1});
                gp3.on('change', function (complete) {
                    @this.
                    set('textBlockItemColor', gp3.getSafeValue());
                })
                gp3.emit('change');
            };

            var destroyGrapick = function () {
                gp3.destroy();
                gp3 = 0;
            }

            createGrapick();
        </script>
        <script>
            var blockItemColor3  = $('#blockItemColor3')
            var blockItemColor33 = $('#blockItemColor33')

            function blockItemColor(value) {
                // alert(value)
                if (value == 3) {
                    blockItemColor3.removeClass('d-none')
                } else {
                    blockItemColor3.addClass('d-none')
                }
            }

            function blockItemColor33(value) {
                // alert(value)
                if (value == 3) {
                    blockItemColor33.removeClass('d-none')
                } else {
                    blockItemColor33.addClass('d-none')
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

            $(document).bind('DOMSubtreeModified', function () {
                $('div.modal-backdrop').not(':last').remove()
            });

            $(function () {
                // $("#sortable2").sortable({axis: 'y'});
                // $("#sortable1").sortable({axis: 'y'});
                $("#sortable").sortable({
                                            axis  : 'y',
                                            update: function (event, ui) {
                                                var data = $(this).sortable('serialize');
                                                // alert(data)

                                                // setTimeout(function (){
                                                @this.
                                                updateSort(data);
                                                // },1000)
                                            }
                                        });

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
