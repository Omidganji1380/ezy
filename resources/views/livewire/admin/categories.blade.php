<div>
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">لیست دسته بندی ها</h3>
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
                            <th>عنوان</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $i)
                            <tr>
                                <td>{{$i->name}}</td>
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
                    <h5 class="modal-title fw-bold" id="expaddLabel">افزودن دسته بندی</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <div class="deadline-form">
                        <form>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label for="abc" class="form-label">عنوان</label>
                                    <input type="text" class="form-control" wire:model="name" id="abc">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="clearInputs" class="btn btn-secondary" data-bs-dismiss="modal">
                        انصراف
                    </button>
                    <button type="submit" wire:click="submit" class="btn btn-primary">{{$category?'ویرایش':'افزودن'}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
