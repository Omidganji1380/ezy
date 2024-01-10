<div>
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">لیست اسلایدر ها</h3>
                <button type="button" wire:click="clearInputs" class="btn btn-primary btn-set-task w-sm-100"
                        data-bs-toggle="modal"
                        data-bs-target="#expadd">
                    <i class="icofont-plus-circle me-2 fs-6"></i>
                    افزودن
                </button>
            </div>
        </div>
    </div> <!-- Row end  -->
    <div class="row g-3 mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>زیر عنوان</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $i)
                            <tr>
                                <td>
                                    <img src="{{asset('storage/sliders/slide-'.$i->id.'/'.$i->img)}}"
                                         class="avatar lg rounded me-2" style="width: 50%;height: 50%;">
                                </td>
                                <td>{{$i->title}}</td>
                                <td>{{$i->subtitle}}</td>
                                <td>
                                    @if($i->status==0)
                                        <span wire:click="changeStatus({{$i->id}})" class="badge bg-warning">غیر فعال</span>
                                    @else
                                        <span wire:click="changeStatus({{$i->id}})" class="badge bg-primary">فعال</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="مثال اصلی طرح شده">
                                        <button type="button" wire:click="edit({{$i->id}})"
                                                data-bs-toggle="modal"
                                                data-bs-target="#expadd"
                                                class="btn btn-outline-secondary">
                                            <i class="icofont-edit text-success"></i>
                                        </button>
                                        <button type="button" wire:click="delete({{$i->id}})"
                                                onclick="confirm('حذف شود؟') || event.stopImmediatePropagation()"
                                                class="btn btn-outline-secondary deleterow"><i
                                                class="icofont-ui-delete text-danger"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- Row end  -->

    <div class="modal fade" wire:ignore.self id="expadd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="expaddLabel">افزودن اسلایدر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <div class="deadline-form">
                        <form>
                            <div class="row g-3 mb-3 justify-content-center">
                                <div class="col-sm-6">
                                    <label for="taxtno" class="form-label">تصویر</label>
                                    <div class="position-relative" style="height: 200px;width: 400px">
                                        @if($slider)
                                            <img src="{{asset('storage/sliders/slide-'.$slider->id.'/'.$slider->img)}}"
                                                 class="position-absolute w-100 h-100">
                                        @endif
                                        @if($image)
                                            <img src="{{$image->temporaryUrl()}}"
                                                 class="position-absolute w-100 h-100">
                                        @endif
                                        <input type="File" class="position-absolute w-100 h-100 opacity-0" id="taxtno"
                                               wire:model="image">
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label for="abc" class="form-label">عنوان</label>
                                    <input type="text" class="form-control" wire:model="title" id="abc">
                                </div>
                                <div class="col-sm-6">
                                    <label for="depone" class="form-label">زیرعنوان</label>
                                    <input type="text" class="form-control" wire:model="subtitle" id="depone">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="clearInputs" class="btn btn-secondary" data-bs-dismiss="modal">
                        انصراف
                    </button>
                    <button type="submit" wire:click="submit" class="btn btn-primary">{{$slider?'ویرایش':'افزودن'}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
