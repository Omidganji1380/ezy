<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary w-100" onclick="icons()" data-bs-toggle="modal"
                        data-bs-target="#insertOption" wire:click="clearInputs">+
                </button>
            </div>
            <div class="col-sm-4 my-2">
                <button class="btn btn-primary w-100" data-bs-toggle="modal"
                        data-bs-target="#messengers" wire:click="getOptions('messenger')">پیام رسان ها
                </button>
            </div>
            <div class="col-sm-4 my-2">
                <button class="btn btn-primary w-100" data-bs-toggle="modal"
                        data-bs-target="#messengers" wire:click="getOptions('social')">شبکه اجتماعی
                </button>
            </div>
            <div class="col-sm-4 my-2">
                <button class="btn btn-primary w-100" data-bs-toggle="modal"
                        data-bs-target="#messengers" wire:click="getOptions('call')">تماس و راه های ارتباطی
                </button>
            </div>
            <div class="col-sm-4 my-2">
                <button class="btn btn-primary w-100" data-bs-toggle="modal"
                        data-bs-target="#messengers" wire:click="getOptions('link')"> لینک و سوپر لینک
                </button>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-12">
                <button class="btn btn-primary w-100" onclick="icons()" data-bs-toggle="modal"
                        data-bs-target="#insertProfileOption" wire:click="clearInputs">+
                </button>
            </div>
            <div class="col-sm-4 my-2">
                <button class="btn btn-primary w-100" data-bs-toggle="modal"
                        data-bs-target="#bg_image" wire:click="getProfileOptionsBgImage">تصاویر پس زمینه
                </button>
            </div>
        </div>
    </div>
    <div class="modal fade rounded" wire:ignore.self id="insertOption" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto">افزودن</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 my-2">
                            <input type="text" class="form-control" wire:model.live.debounce="title"
                                   placeholder="عنوان">
                        </div>
                        <div class="col-6 my-2">
                            <select class="form-select" wire:model.live.debounce="for">
                                <option value="">برای ...</option>
                                <hr>
                                <option value="messenger">پیام رسان</option>
                                <option value="social">شبکه اجتماعی</option>
                                <option value="call">تماس و راه های ارتباطی</option>
                                <option value="link">لینک و سوپر لینک</option>
                            </select>
                        </div>
                        <div class="col-6 my-2">
                            <p class="form-label">آیکون</p>
                            <div class="row">
                                <div class="col-8">
                                    <div class="position-relative">
                                        <input type="text" wire:model.live="icon" onkeydown="setIcons()"
                                               wire:keyup="searchIcons"
                                               class="form-control">
                                        @if($iconsFlag)
                                            <div class="position-absolute w-100">
                                                <ul class="list-group">
                                                    @foreach($icons as $i)
                                                        <li wire:click="setIcon('{{$i->icon}}')"
                                                            class="list-group-item text-start">
                                                            {{$i->icon}}
                                                            <i class="{{$i->icon}} float-sm-end"
                                                               style="font-size: 30px !important;">
                                                                {!! $this->getIconPaths() !!}
                                                            </i>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4 text-center">
                                    <i id="selectedIcon" class="selectedIcon {{$icon}}">
                                        {!! $this->getIconPaths() !!}
                                    </i>
                                </div>
                            </div>
                            {{--<div class="position-relative mx-auto rounded-circle"
                                 style="width: 50px;height: 50px;border: 1px solid red">
                                @if($icon)
                                    <img
                                        src="{{$icon->temporaryUrl(),asset('pageBuilder/fontawesome-free-6.5.1-web/svgs/brands/telegram.svg')}}"
                                        class="h-100 w-100 position-absolute" alt="">
                                @endif
                                <input type="file" class="w-100 h-100 position-absolute opacity-0"
                                       wire:model.live="icon">
                            </div>--}}
                        </div>
                        <div class="col-6 my-2">
                            <p class="form-label">رنگ بک گراند</p>
                            <div class="row justify-content-evenly">
                                <input type="color" class="form-control-color w-25" wire:model.live.debounce="color"
                                       placeholder="رنگ | Hex">
                                <input type="text" dir="ltr" class="form-control w-50" wire:model.live.debounce="color"
                                       placeholder="رنگ | Hex">
                            </div>
                        </div>
                        <hr>
                        <div class="col-6 my-2">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" class="form-control" wire:model.live.debounce="linkTitle"
                                           placeholder="عنوان">
                                </div>
                                <div class="col-6 align-self-center">
                                    <span class="">{{$title}}</span>
                                </div>
                            </div>
                            <input type="text" dir="ltr" class="form-control my-1" wire:model.live.debounce="link"
                                   placeholder="لینک">
                            <input type="text" class="form-control my-1 py-0" wire:model.live.debounce="linkDescription"
                                   placeholder="توضیحات">
                        </div>
                        <div class="col-6 my-2">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" class="form-control" wire:model.live.debounce="moreOptionTitle"
                                           placeholder="عنوان بخش اضافه">
                                </div>
                            </div>
                            <input type="text" class="form-control my-1 py-0"
                                   wire:model.live.debounce="moreOptionDescription"
                                   placeholder="توضیحات بخش اضافه">
                        </div>
                        <div class="col-12 my-2">
                            <textarea type="text" class="form-control my-1" wire:model.live.debounce="moreDescription"
                                      placeholder="توضیحات اضافه"></textarea>
                        </div>
                        <div class="col-12 mt-4 text-center">
                            <button class="btn btn-success w-25"
                                    {!! $dismissModal?'data-bs-dismiss="modal"':'' !!}
                                    wire:click="insert">ذخیره
                            </button>
                            <button class="btn btn-outline-warning w-25" data-bs-dismiss="modal"
                                    wire:click="clearInputs">انصراف
                            </button>
                            @if($selectedOption)
                                <button class="btn btn-outline-danger w-25" data-bs-dismiss="modal"
                                        wire:click="delete({{$selectedOption->id}})" wire:confirm="حذف شود؟">حذف
                                </button>
                            @endif
                        </div>
                        <div class="col-12 mt-4 text-center">
                            @if($errors->has(['title','icon','color','for']))
                                <span class="text-danger">{{$errors->first()}}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade rounded" wire:ignore.self id="messengers" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto">{{$title}}</h5>
                </div>
                <div class="modal-body" wire:ignore.self>
                    <div class="row">
                        @foreach($options as $item)
                            <div class="col-3 my-1">
                                <button class="btn w-100" wire:click="edit({{$item->id}})"
                                        data-bs-target="#insertOption" data-bs-toggle="modal"
                                        style="background-color: {{$item->color}};border: 1px solid #c4c4c4">
                                    <div class="row justify-content-between">
                                        <div class="col-auto align-self-center" style="text-align: right">
                                            {{$item->title}}
                                        </div>
                                        <div class="col-auto align-self-center">
                                            <i style="font-size: 25px !important;" class="align-middle {{$item->icon}}">
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
    <div class="modal fade rounded" wire:ignore.self id="insertProfileOption" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto">افزودن</h5>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-6 my-2">
                            <select wire:model="premium" class="form-select">
                                <option value="0">معمولی</option>
                                <option value="1">پریمیوم</option>
                            </select>
                        </div>
                        <div class="col-12 my-2 text-center">
                            <div class="position-relative w-30 rounded text-center py-2 align-middle mx-auto"
                                 style="background-color: #cfffcf;border: 2px dashed green;height: 300px">
                                <div class="position-absolute h-100 w-100 top-50 translate-middle-y">
                                    <img
                                        src="{{$bgImage?$bgImage->temporaryUrl():asset('storage/pb/bgImages/bgImage-'/*.$bg->img*/)}}"
                                        class="position-absolute h-100 py-2 mx-auto start-0" alt=""
                                        style="right: 0" wire:click="removeImg" wire:confirm="حذف شود؟">
                                    <img wire:loading wire:target="bgImage"
                                         src="{{asset('pageBuilder/loading.gif')}}"
                                         class="position-absolute h-100 py-2 mx-auto start-0"
                                         style="right: 0">
{{--                                    @if(!$bgImage)--}}
                                        <input type="file" class="opacity-0 h-100 w-100"
                                               wire:model="bgImage">
{{--                                    @endif--}}
                                </div>
                            </div>
{{--                            <img src="{{asset('pageBuilder/assets/img/pbBackground/ddaf01857fffc185baa4.jpg')}}" class="w-30">--}}
                        </div>
                        <div class="col-12 mt-4 text-center">
                            <button class="btn btn-success w-25"
                                  data-bs-dismiss="modal"
                                    wire:click="insertBgImage">ذخیره
                            </button>
                            <button class="btn btn-outline-warning w-25" data-bs-dismiss="modal"
                                    wire:click="clearInputs">انصراف
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade rounded" wire:ignore.self id="bg_image" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto">تصاویر پس زمینه</h5>
                </div>
                <div class="modal-body" wire:ignore.self>
                    <div class="row">
                        @foreach($bgImgs as $item)
                            <div class="col-2 my-1" wire:click="deleteBgImg({{$item->id}})" wire:confirm="حذف شود؟">
                                <img src="{{asset('storage/pb/bgImages/bgImage-'.$item->id.'/'.$item->img)}}" class="w-100">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            // setInterval(function () {
            //     var icon = $('.ez');
            //
            //     for (var i = 0; i < icon.length; i++) {
            //         var a       = icon[i];
            //         a.innerHTML = null;
            //         for (var ii = 1; ii <= 50; ii++) {
            //             a.innerHTML += "<span class='path" + ii + "'></span>"
            //         }
            //     }
            // }, 2000)
        </script>
    @endpush
</div>
