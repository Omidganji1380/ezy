<div>
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">لیست انتقالات</h3>
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
                            <th>لینک</th>
                            <th>-></th>
                            <th>به</th>
                            <th>عملیات</th>
                            <th>آمار</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($urls as $i)
                            <tr>
                                <td>{{$i->url}}</td>
                                <td>-></td>
                                <td>{{$i->redirectTo}}</td>
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
                                <td>
                                    {{$i->visit}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        {!! $urls->links() !!}
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- Row end  -->

    <div class="modal fade" wire:ignore.self id="expadd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="expaddLabel">افزودن انتقال صفحه</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <div class="deadline-form">
                        <form>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-lg-1 align-self-center">
                                    <button class="btn btn-info" type="button" wire:click="randUrl">رندم</button>
                                </div>
                                <div class="col-sm-5">
                                    <label for="abc" class="form-label">از</label>
                                    <input type="text" class="form-control" wire:model.live="url" id="abc">
                                    @error('url')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    @if(!$errors->get('url') && $url)
                                    <span>{{route('redirectTo',$url)}}</span>
                                    @endif
                                </div>
                                <div class="col-sm-1 d-none d-sm-block text-center align-self-center fs-2">
                                    ->
                                </div>
                                <div class="col-sm-5">
                                    <label for="abc2" class="form-label">به</label>
                                    <input type="text" class="form-control" wire:model.live="redirectTo" id="abc2">
                                    @error('redirectTo')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="clearInputs" class="btn btn-secondary" data-bs-dismiss="modal">
                        انصراف
                    </button>
                    @if($errors->count()==0 && $submitFlag)
                        <button type="submit" wire:click="submit" class="btn btn-primary"
                                data-bs-dismiss="modal">{{$link?'ویرایش':'افزودن'}}</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
