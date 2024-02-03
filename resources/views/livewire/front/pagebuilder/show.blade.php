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
                /*border: 1px solid grey;*/
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
        </style>
    @endpush

        <div style="max-width: 600px" class="container px-0">
            <div class="row">
                {{--<div class="col-12" style="border-radius: 20px;box-shadow: rgba(0,0,0,0.2) 0 0 20px;">
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
                </div>--}}
                <div class="col-12 mb-3 px-0">
{{--                    <div class="row p-2 flex-nowrap">--}}
{{--                        <div class="col-11">--}}
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
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
{{--                <div id="sortable" style="cursor: grab;margin-bottom: 6rem !important;" wire:ignore.self>--}}
                    @foreach($blocks as $block)
                        <div class="col-12 my-0 px-4">
{{--                            <div class="row p-2 flex-nowrap">--}}
{{--                                <div class="col-11">--}}

                                    <div class="row justify-content-center">
                                        @if($block->blockOption->blockTitle)
                                        <div class="col-12 text-center mt-3">
                                            <p class="text-center">{{$block->blockOption->blockTitle}}</p>
                                        </div>
                                        @endif
                                        @foreach($block->pbOption()->get() as $option)
                                            <div
                                                class="{{$this->setBlockWidthHalf($block->blockOption->blockWidth,$loop->last,$loop->index)}} {{$this->setBlockWidth($block->blockOption->blockWidth)}} text-center p-1">
                                                <a dir="rtl" href="{{$option->link}}{{$this->getBlockLink($option->pivot)}}" target="_blank"
                                                class="btn border-info w-100 overflow-hidden text-truncate px-1"
                                                        style="border-radius: {{$this->getBlockItemsBorder($block)}};background-{{$block->blockOption->blockItemColor==2?'color':'image'}}: {{$this->getBgBlockItemColor($block,$option->color)}};border-color: {{$this->getBorderBlockItemColor($block)}} !important;color: {{$this->getTextBlockItemColor($block)}}">
                                                    <div class="row justify-content-center ez-solid-aparat"
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
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    @endforeach
{{--                </div>--}}

            </div>
        </div>

    @push('js')

        <script>
            $(window).ready(function () {
                {{--alert('refresh.{{$profile->link}}')--}}
                $('div.body').removeClass('py-3')
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
            {{--window.Echo.channel('refresh.{{$profile->link}}')--}}
            {{--      .listen('UpdateShowPbPage', (e) => {--}}
            {{--          @this.pageRefresh();--}}
            {{--      })--}}
        </script>
    @endpush
</div>
