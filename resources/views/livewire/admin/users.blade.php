<div>
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">لیست کاربران</h3>
                <button type="button" wire:click="clearInputs" class="btn btn-primary btn-set-task w-sm-100"
                        data-bs-toggle="modal"
                        data-bs-target="#expadd">
                    <i class="icofont-plus-circle me-2 fs-6"></i>
                    افزودن
                </button>
            </div>
        </div>
    </div> <!-- Row end  -->
    <div class="row g-3 mb-3" wire:ignore.self>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table {{--id="myDataTable"--}} class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>نام</th>
                            <th>شماره</th>
                            <th>تاریخ ایجاد</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $i)
                            <tr>
                                <td>{{$i->id}}</td>
                                <td>{{$i->name}}</td>
                                <td>{{$i->phone}}</td>
                                <td>{{jdate($i->created_at)->format('l, Y/m/d | ساعت H:i')}}</td>
                                <td>
                                    @if($i->role==3)
                                        <span class="badge bg-danger">مدیرکل</span>
                                    @elseif($i->role==2)
                                        <span class="badge bg-info text-dark">مدیر</span>
                                    @elseif($i->role==1)
                                        <span class="badge bg-warning text-dark">کاربر</span>
                                    @elseif($i->role==0)
                                        <span class="badge bg-black">بلاک شده</span>
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
                                        @if($i->role>0)
                                            <button type="button" wire:click="delete({{$i->id}})"
                                                    onclick="confirm('حذف شود؟') || event.stopImmediatePropagation()"
                                                    class="btn btn-outline-secondary"><i
                                                    class="icofont-ui-delete text-danger"></i></button>
                                        @else
                                            <button type="button" wire:click="restoring({{$i->id}})"
                                                    onclick="confirm('بازیابی شود؟') || event.stopImmediatePropagation()"
                                                    class="btn btn-outline-secondary"><i
                                                    class="icofont-upload-alt text-primary"></i></button>
                                        @endif
                                        <button type="button" wire:click="showLogs({{$i->id}})"
                                                data-bs-toggle="modal"
                                                data-bs-target="#history"
                                                class="btn btn-outline-secondary">
                                            <i class="icofont-history text-info"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div> <!-- Row end  -->

     <div class="modal fade" wire:ignore.self id="expadd" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title fw-bold" id="expaddLabel">{{$user?'ویرایش':'افزودن'}}</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                 </div>
                 <div class="modal-body">
                     <div class="deadline-form">
                         <form>
                             <div class="row g-3 mb-3 justify-content-center">
                                 <div class="col-sm-4">
                                     <label for="" class="form-label">نام </label>
                                         <input type="text" class="form-control" wire:model="name">
                                 </div>
                                 <div class="col-sm-4">
                                     <label for="" class="form-label">شماره </label>
                                         <input type="text" class="form-control" wire:model="phone">
                                 </div>
                                 <div class="col-sm-4">
                                     <label for="" class="form-label">رمزعبور </label>
                                         <input type="text" class="form-control" wire:model="password">
                                 </div>
                                 <div class="col-sm-6">
                                     <label for="" class="form-label">ایمیل </label>
                                         <input type="text" class="form-control" wire:model="email">
                                 </div>
                                 <div class="col-sm-6">
                                     <label for="" class="form-label">کدپستی </label>
                                         <input type="text" class="form-control" wire:model="postCode">
                                 </div>
                                 <div class="col-sm-12">
                                     <label for="" class="form-label">آدرس </label>
                                     <textarea type="text" class="form-control" wire:model="address"></textarea>
                                 </div>
                             </div>
                         </form>
                     </div>

                 </div>
                 <div class="modal-footer">
                     <button type="button" wire:click="clearInputs" class="btn btn-secondary" data-bs-dismiss="modal">
                         انصراف
                     </button>
                     <button type="submit" wire:click="submit"
                             class="btn btn-primary">{{$user?'ویرایش':'افزودن'}}</button>
                 </div>
             </div>
         </div>
     </div>
    {{--<div class="modal fade" wire:ignore.self id="history" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="expaddLabel">سابقه</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <div class="deadline-form">
                        <form>
                            <div class="row g-3 mb-3 justify-content-center">
                                <div class="col-sm-6">
                                    @foreach($logs as $i)
                                        <label for="abc"
                                               class="form-label">{{jdate($i->created_at)->format('l, d M Y | ساعت H:i:s')}}</label>
                                        <br>
                                        <label for="abc" class="form-label">{{$i->user->name.' '.$i->text}}</label>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                --}}{{--<div class="modal-footer">
                    <button type="button" wire:click="clearInputs" class="btn btn-secondary" data-bs-dismiss="modal">
                        انصراف
                    </button>
                    <button type="submit" wire:click="addCustomer"
                            class="btn btn-primary">{{$form?'ویرایش':'افزودن'}}</button>
                </div>--}}{{--
            </div>
        </div>
    </div>--}}
    {{--<div class="modal fade" wire:ignore.self id="showLink" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="expaddLabel">لینک فرم</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <div class="deadline-form">
                        <div class="row g-3 mb-3 justify-content-center">
                            <div class="col-sm-8">
                                <input type="text" readonly id="formLink"
                                       class="form-label form-control text-center py-2 px-1 bg-transparent"
                                       style="/*width: fit-content;*/font-size: unset" value="{{$link}}">
                            </div>
                            <div class="col-12 col-sm-2">
                                <button class="btn btn-primary w-100" onclick="copyy()" id="copyButton">کپی</button>
                            </div>
                            <div class="col-sm-10 text-center">
                                <div class="bg-white p-2 mx-auto" style="width: fit-content">
                                    <img
                                        src="data:image/png;base64,{{DNS2D::getBarcodePNG('sms:'.$smsPhone.'&body='.$link, 'QRCODE',10,10)}}"
                                        alt=""/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
    {{--<div class="modal fade" wire:ignore.self id="showProgress" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="expaddLabel">کارها</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <div class="deadline-form">
                        <div class="row">
                            <div class="col-6">
                                <div class="row g-3 mb-3 justify-content-center">
                                    @foreach($works as $i)
                                        <div class="col-12 text-center">
                                            <h3 class="text-center">{{$i->title}}</h3>
                                            <br>
                                            @foreach($i->infoFormProductWorks as $item)
                                                <label class="mx-3 fs-6">{{$item->title}}
                                                    <input type="checkbox"
                                                           class="form-check form-check-input m-auto my-2">
                                                </label>
                                            @endforeach
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row g-3 mb-3 justify-content-center">
                                    @foreach($connectingWays as $i)
                                        <div class="col-12 text-center">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="text-center">{{$i->title}}</h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="text-center">{{$i->text}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
    {{--@push('js')
        <script>
            function copyy() {
                var fl = $('#formLink').val()
                var cb = $('#copyButton')
                // alert(fl)
                navigator.clipboard.writeText(fl).then(function () {
                    cb.html('کپی شد!')
                    setTimeout(function () {
                        cb.html('کپی')
                    }, 5000)
                });
            }
        </script>
    @endpush--}}
</div>
