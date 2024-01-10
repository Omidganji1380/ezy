<div>
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">لیست فرم ها</h3>
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
                        @foreach($forms as $i)
                            <tr class="{{$i->status==0?'text-decoration-line-through opacity-75':''}}">
                                <td>{{$i->id}}</td>
                                <td>{{$i->user->name}}</td>
                                <td>{{$i->user->phone}}</td>
                                <td>{{jdate($i->created_at)->format('l, Y/m/d | ساعت H:i')}}</td>
                                <td>
                                    @if($i->status==1)
                                        <span class="badge bg-success">فعال</span>
                                    @else
                                        <span class="badge bg-danger">غیر فعال</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="مثال اصلی طرح شده">
                                        <button type="button" wire:click="showProgress({{$i->id}})"
                                                data-bs-toggle="modal"
                                                data-bs-target="#showProgress"
                                                class="btn btn-outline-secondary"><i
                                                    class="icofont-eye-alt text-secondary"></i></button>
                                        <button type="button" wire:click="showLink({{$i->id}})"
                                                data-bs-toggle="modal"
                                                data-bs-target="#showLink"
                                                class="btn btn-outline-secondary"><i
                                                    class="icofont-share text-primary"></i></button>
                                        <button type="button" wire:click="edit({{$i->id}})"
                                                data-bs-toggle="modal"
                                                data-bs-target="#expadd"
                                                class="btn btn-outline-secondary">
                                            <i class="icofont-edit text-success"></i>
                                        </button>
                                        @if($i->status==1)
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
                    {{$forms->links()}}
                </div>
            </div>
        </div>
    </div> <!-- Row end  -->

    <div class="modal fade" wire:ignore.self id="expadd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="expaddLabel">{{$form?'ویرایش':'افزودن'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <div class="deadline-form">
                        <form>
                            <div class="row g-3 mb-3 justify-content-center">
                                <div class="col-sm-6">
                                    <label for="abc" class="form-label">شماره</label>
                                    @if($this->canEditPhone())
                                        <input type="text" class="form-control" dir="ltr" wire:model="phone" id="abc">
                                    @else
                                        <label type="text"
                                               class="form-label form-control text-center">{{$phone}}</label>
                                    @endif
                                    @error('phone')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <label for="abc" class="form-label">محصولات</label>
                                    <button type="button" wire:click="addProduct"
                                            class="float-end btn btn-primary btn-set-task w-sm-100">
                                        <i class="icofont-plus-circle fs-6"></i>
                                    </button>
                                    <table class="table table-hover align-middle mb-0 text-center">
                                        <thead>
                                        <tr>
                                            <th>عنوان</th>
                                            <th>تعداد</th>
                                            <th>کار ها</th>
                                            <th>فایل</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $i)
                                            <tr>
                                                <td>
                                                    @if($product && $product->id==$i->id)
                                                        <select class="form-select" wire:model="title">
                                                            <option value="">انتخاب کنید</option>
                                                            <option value="کارت ویزیت هوشمند (معمولی)">کارت ویزیت هوشمند
                                                                (معمولی)
                                                            </option>
                                                            <option value="کارت ویزیت هوشمند (اختصاصی)">کارت ویزیت
                                                                هوشمند (اختصاصی)
                                                            </option>
                                                            <option value="تگ هوشمند (معمولی)">تگ هوشمند (معمولی)
                                                            </option>
                                                            <option value="تگ هوشمند (اختصاصی)">تگ هوشمند (اختصاصی)
                                                            </option>
                                                            <option value="استند هوشمند(a4)(اختصاصی)">استند
                                                                هوشمند(a4)(اختصاصی)
                                                            </option>
                                                            <option value="استند هوشمند(a5)(اختصاصی)">استند
                                                                هوشمند(a5)(اختصاصی)
                                                            </option>
                                                            <option value="استند هوشمند(a6)(اختصاصی)">استند
                                                                هوشمند(a6)(اختصاصی)
                                                            </option>
                                                            <option value="استند هوشمند(a4)(معمولی)">استند
                                                                هوشمند(a4)(معمولی)
                                                            </option>
                                                            <option value="استند هوشمند(a5)(معمولی)">استند
                                                                هوشمند(a5)(معمولی)
                                                            </option>
                                                            <option value="استند هوشمند(a6)(معمولی)">استند
                                                                هوشمند(a6)(معمولی)
                                                            </option>
                                                            <option value="منوی دیجیتال تک صفحه ای">منوی دیجیتال تک صفحه
                                                                ای
                                                            </option>
                                                            <option value="منوی دیجیتال چند صفحه ای">منوی دیجیتال چند
                                                                صفحه ای
                                                            </option>
                                                            <option value="لیبل هوشمند">لیبل هوشمند</option>
                                                        </select>
                                                    @else
                                                        {{$i->title}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($product && $product->id==$i->id)
                                                        <input class="form-control" min="1" type="number"
                                                               wire:model="qty"
                                                               wire:keyup.enter="productSubmit({{$i->id}})">
                                                    @else
                                                        {{number_format($i->qty)}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($product && $product->id==$i->id)
                                                        <div class="row justify-content-center">
                                                            <div class="col-4">
                                                                <input class="form-control" type="text"
                                                                       wire:model="productWorkTitle"
                                                                       wire:keyup.enter="addProductWork({{$i->id}})">
                                                                <select class="form-select"
                                                                        wire:model="productWorkTitle"
                                                                        wire:change="addProductWork({{$i->id}})">
                                                                    <option value="">انتخاب کنید</option>
                                                                    @foreach($allWorks as $key=>$item)
                                                                        <option value="{{$item}}">{{$item}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-5">
                                                                <div class="row">
                                                                    @foreach($i->infoFormProductWorks()->orderBy('created_at')->get() as $item)
                                                                        <div class="col-6">
                                                                            <span>{{$item->title}}
                                                                            <i wire:click="deleteProductWork({{$item->id}},{{$i->id}})"
                                                                               class="icofont-close text-danger"></i>
                                                                            </span>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        @foreach($i->infoFormProductWorks()->orderBy('created_at')->get() as $item)
                                                            <span class="btn btn-primary">{{$item->title}}</span>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>فایل</td>
                                                <td>
                                                    @if($product && $product->id==$i->id)
                                                        <button type="button" wire:click="productSubmit({{$i->id}})"
                                                                class="btn btn-outline-secondary">
                                                            <i class="icofont-tick-boxed text-success"></i>
                                                        </button>
                                                        <button type="button" wire:click="productCancel"
                                                                wire:confirm="انصراف؟"
                                                                class="btn btn-outline-secondary"><i
                                                                    class="icofont-logout text-danger"></i></button>
                                                    @else
                                                        <button type="button" wire:click="productEdit({{$i->id}})"
                                                                class="btn btn-outline-secondary">
                                                            <i class="icofont-edit text-success"></i>
                                                        </button>
                                                        <button type="button" wire:click="productDelete({{$i->id}})"
                                                                wire:confirm="حذف شود؟"
                                                                class="btn btn-outline-secondary"><i
                                                                    class="icofont-ui-delete text-danger"></i></button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="clearInputs" class="btn btn-secondary" data-bs-dismiss="modal">
                        انصراف
                    </button>
                    <button type="submit" wire:click="addCustomer"
                            class="btn btn-primary">{{$form?'ویرایش':'افزودن'}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" wire:ignore.self id="history" tabindex="-1" aria-hidden="true">
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
                {{--<div class="modal-footer">
                    <button type="button" wire:click="clearInputs" class="btn btn-secondary" data-bs-dismiss="modal">
                        انصراف
                    </button>
                    <button type="submit" wire:click="addCustomer"
                            class="btn btn-primary">{{$form?'ویرایش':'افزودن'}}</button>
                </div>--}}
            </div>
        </div>
    </div>
    <div class="modal fade" wire:ignore.self id="showLink" tabindex="-1" aria-hidden="true">
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
    </div>
    <div class="modal fade" wire:ignore.self id="showProgress" tabindex="-1" aria-hidden="true">
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
                                            <div class="row">
                                                @foreach($i->infoFormProductWorks()->orderBy('created_at')->get() as $item)
                                                    <div class="col-4 border-top border-bottom py-2">
                                                        <label class="">{{$item->title}}
                                                            <input type="checkbox"
                                                                   {{$item->worker?'checked':''}}
                                                                   {{$item->worker==null||$item->worker==Auth::id()?'':'disabled'}}
                                                                   wire:click="addWrokerForWork('{{$item->id}}','{{$i->title}}')"
                                                                   class="form-check form-check-input m-auto my-2">
                                                        </label>
                                                        <br>
                                                        <span class="">{{$item->worker?$item->worker()->first()->name:''}}</span>
                                                    </div>
                                                @endforeach
                                            </div>
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
    </div>
    @push('js')
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
    @endpush
</div>
