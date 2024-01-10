<div>
    <div class="body d-flex py-3">
        <div class="container-xxl">

            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">تنظیمات</h3>
                        {{--                        <button type="submit" class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">ذخیره</button>--}}
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row g-3 mb-3">
                @foreach($options as $i=>$item)
                    @if(is_numeric($item->value))
                        <div class="col-xl-4 col-lg-4">
                            <div class="card mb-3" style="height: 100px">
                                <div
                                    class="h-100 card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                    <h6 class="m-0 fw-bold">{{$item->option}}</h6>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" value="1"
                                                   wire:model="value.{{$i}}.{{$item->id}}"
                                                   wire:click="updateOptions({{$i}},{{$item->id}})" type="radio"
                                                   name="name{{$item->id}}">
                                            فعال
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" value="0"
                                                   wire:model="value.{{$i}}.{{$item->id}}"
                                                   wire:click="updateOptions({{$i}},{{$item->id}})" type="radio"
                                                   name="name{{$item->id}}">
                                            غیرفعال
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-xl-4 col-lg-4">
                            <div class="card mb-3" style="height: 100px">
                                <div
                                    class="h-100 card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                    <h6 class="m-0 fw-bold">{{$item->option}}</h6>
                                    <div class="form-check">
                                        <input class="form-control"
                                               wire:model="value.{{$i}}.{{$item->id}}"
                                               wire:keyup="updateOptions({{$i}},{{$item->id}})" type="text"
                                               name="name{{$item->id}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="col-xl-4 col-lg-4">
                    <div class="card mb-3" style="@if($favicon=='') border: 1px solid lawngreen; @endif height: 100px">
                        <div
                            class="h-100 card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                            <h6 class="m-0 fw-bold">favicon</h6>
                            <div class="form-check position-relative" style="height: 100%;width: auto;">
                                <input type="file" accept="image/png" class="position-absolute w-100 h-100"
                                       wire:model="favicon"
                                       style="left: 0;opacity: 0;min-width: 50px;min-height: 50px; border: 1px solid black">
                                <img src="{{asset('storage/favicon/favicon.png')}}" class="w-100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="card mb-3" style="@if($logo=='') border: 1px solid lawngreen; @endif height:100px">
                        <div
                            class="h-100 card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                            <h6 class="m-0 fw-bold">logo</h6>
                            <div class="form-check position-relative" style="height: 100%;width: auto;">
                                <input type="file" accept="image/png" class="position-absolute w-100 h-100"
                                       wire:model="logo"
                                       style="left: 0;opacity: 0;min-width: 50px;min-height: 50px; border: 1px solid black">
                                <img src="{{asset('storage/favicon/logo.png')}}" class="w-100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="card mb-3" style="@if($music=='') border: 1px solid lawngreen; @endif height:100px">
                        <div
                            class="h-100 card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                            <h6 class="m-0 fw-bold">Music</h6>
                            <button class="icofont-play-alt-2 btn btn-primary" id="playButton"
                                    onclick="playSong()"></button>
                            <button class="icofont-pause btn btn-primary d-none" id="pauseButton"
                                    onclick="pauseSong()"></button>
                            <div class="form-check position-relative" style="height: 100%;width: auto;">
                                <input type="file" accept="audio/mpeg" class="position-absolute w-100 h-100"
                                       wire:model="music"
                                       style="left: 0;opacity: 0;min-width: 50px;min-height: 50px; border: 1px solid black">
                                <audio class="w-100" id="song">
                                    <source type="audio/mpeg" src="{{asset('storage/favicon/music.mp3')}}">
                                </audio>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 align-self-center">
                    <div class="card mb-3">
                        <button class="btn btn-info" onclick="location.href='{{route('admin.options')}}'"
                                wire:click="opt">Optimize
                        </button>
                    </div>
                </div>
            </div><!-- Row end  -->

        </div>
    </div>
    <script>
        var playButton = document.getElementById('playButton')
        var pauseButton = document.getElementById('pauseButton')
        // var playButton = document.getElementsByClassName('icofont-play-alt-2')
        // var pauseButton = document.getElementsByClassName('icofont-pause')
        var song = document.getElementById('song')

        function playSong() {
            pauseButton.classList.remove('d-none')
            playButton.classList.add('d-none')
            song.play()
        }

        function pauseSong() {
            pauseButton.classList.add('d-none')
            playButton.classList.remove('d-none')
            song.pause()

        }
    </script>
</div>
