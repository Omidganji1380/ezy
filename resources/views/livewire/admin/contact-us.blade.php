<div>
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0"><input type="text" class="form-control" wire:model="topTitle"
                                                wire:keyup="updateTexts"></h3>
                <button type="button" wire:click="clearInputs" class="btn btn-primary btn-set-task w-sm-100"
                        data-bs-toggle="modal"
                        data-bs-target="#info">
                    <i class="icofont-gear me-2 fs-6"></i>
                    تنظیمات
                </button>
            </div>
        </div>
    </div> <!-- Row end  -->

    <div class="row g-3 mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-6 mb-4">
                            <input type="text" class="form-control" wire:model="formTopTitle" wire:keyup="updateTexts">
                        </div>
                    </div>
                    <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>شماره</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $i)
                            <tr>
                                <td>
                                    {{$i->name}}
                                </td>
                                <td>
                                    {{$i->email}}
                                </td>
                                <td>
                                    {{$i->phone}}
                                </td>
                                <td>
                                    @if($i->status==0)
                                        <span class="badge bg-warning" wire:click="changeStatus({{$i->id}})">خوانده نشده</span>
                                    @else
                                        <span class="badge bg-info" wire:click="changeStatus({{$i->id}})">خوانده شده</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="مثال اصلی طرح شده">
                                        <button type="button" wire:click="contactSee({{$i->id}})"
                                                class="btn btn-outline-secondary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#contact">
                                            <i class="icofont-eye-alt text-success"></i>
                                        </button>
                                        <button type="button" wire:click="contactDelete({{$i->id}})"
                                                onclick="confirm('حذف شود؟') || event.stopImmediatePropagation()"
                                                class="btn btn-outline-secondary deleterow"><i
                                                class="icofont-ui-delete text-danger"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2">
                    {{$contacts->links()}}
                </div>
                </div>
            </div>
        </div>
    </div> <!-- Row end  -->

    <div class="modal fade" wire:ignore.self id="info" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <div class="deadline-form">
                        <form disabled="">
                            <div class="row g-3 mb-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row justify-content-between">
                                                <div class="col-6">
                                                    <input type="text" class="form-control" wire:model="infoTopTitle" wire:keyup="updateTexts">
                                                </div>
                                                <div class="col-6 text-start">
                                                    <button type="button" class="btn btn-primary" wire:click="infoAdd">+</button>
                                                </div>
                                            </div>
                                            <table class="table table-hover align-middle mb-0" style="width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>ایکون</th>
                                                    <th>عنوان</th>
                                                    <th>زیرعنوان</th>
                                                    <th>عملیات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($infos as $i)
                                                    <tr>
                                                        <td>
                                                            {{--@if($info && $info->id==$i->id)
                                                                <div class="position-relative">
                                                                    @if($infoImage)
                                                                        <img src="{{$infoImage->temporaryUrl()}}"
                                                                             class="avatar lg me-2">
                                                                    @else
                                                                        <img src="{{asset('storage/about/info-'.$i->id.'/'.$i->midImg)}}"
                                                                             class="avatar lg me-2">
                                                                    @endif
                                                                    <input type="file"
                                                                           class="form-control position-absolute top-0 bottom-0 opacity-0"
                                                                           wire:model="infoImage">
                                                                </div>
                                                            @else
                                                                <img src="{{asset('storage/about/info-'.$i->id.'/'.$i->midImg)}}"
                                                                     class="avatar lg rounded me-2">
                                                            @endif--}}
                                                        </td>
                                                        <td>
                                                            @if($info && $info->id==$i->id)
                                                                <input type="text" class="form-control" wire:model="title">
                                                            @else
                                                                {{$i->title}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($info && $info->id==$i->id)
                                                                <input type="text" class="form-control" wire:model="subtitle">
                                                            @else
                                                                {{$i->subtitle}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="مثال اصلی طرح شده">
                                                                @if($info && $info->id==$i->id)
                                                                    <button type="button" wire:click="infoSubmit"
                                                                            class="btn btn-outline-secondary text-success">
                                                                        ذخیره
                                                                    </button>
                                                                    <button type="button" wire:click="clearInputs"
                                                                            class="btn btn-outline-secondary deleterow text-danger">
                                                                        انصراف
                                                                    </button>
                                                                @else
                                                                    <button type="button" wire:click="infoEdit({{$i->id}})"
                                                                            class="btn btn-outline-secondary">
                                                                        <i class="icofont-edit text-success"></i>
                                                                    </button>
                                                                    <button type="button" wire:click="infoDelete({{$i->id}})"
                                                                            onclick="confirm('حذف شود؟') || event.stopImmediatePropagation()"
                                                                            class="btn btn-outline-secondary deleterow"><i
                                                                            class="icofont-ui-delete text-danger"></i></button>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="contact" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <div class="deadline-form">
                        <form disabled="">
                            <div class="row g-3 mb-3">
                                <div class="col-sm-4">
                                    <label for="abc" class="form-label">نام</label>
                                    <input type="text" class="form-control" wire:model="name" id="abc">
                                </div>
                                <div class="col-sm-4">
                                    <label for="abc1" class="form-label">ایمیل</label>
                                    <input type="text" class="form-control" wire:model="email" id="abc1">
                                </div>
                                <div class="col-sm-4">
                                    <label for="depo2ne2" class="form-label">شماره</label>
                                    <input type="text" class="form-control" wire:model="phone" id="depo2ne2">
                                </div>
                                <div class="col-sm-12">
                                    <label for="depo2ne22" class="form-label">متن</label>
                                    <textarea class="form-control" id="depo2ne22" rows="4">{!! $text !!}</textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="clearInputs" class="btn btn-secondary" data-bs-dismiss="modal">
                        انصراف
                    </button>
                    <button type="submit" wire:click="submit" class="btn btn-primary">{{1?'ویرایش':'افزودن'}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
