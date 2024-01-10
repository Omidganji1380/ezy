<div>
    <div class="container p-2 contact-form" dir="rtl">
        <div class="row justify-content-center">
            <div class="col-12 text-center my-4">
                <img src="{{asset('storage/favicon/logo.png')}}" alt="">
            </div>
            <div class="col-12 my-4">
                <h2 class="text-center">{{$submitted?session('submitted'):'اطلاعات مشتریان ایزی کانکت'}}</h2>
            </div>
            @if(!$submitted)
                <div class="col-12 my-4 box text-right">
                    <div class="row justify-content-evenly">
                        <div class="col-md-4 my-2">
                            <label for="">شماره تلفن </label>
                            <input type="text" class="hover form-control text-left" dir="ltr" value="{{$userPhone}}">
                        </div>
                        <div class="col-md-4 my-2">
                            <label for="">نام و نام خانوادگی <span class="text-danger">*</span></label>
                            <input type="text" class="hover form-control" wire:model="name"
                                   wire:keyup.debounce.1000ms="updateTexts">
                        </div>
                        <div class="col-md-4 my-2">
                            <label for="">کد پستی</label>
                            <input type="text" class="hover form-control" wire:model="postCode"
                                   wire:keyup.debounce.1000ms="updateTexts">
                        </div>
                        <div class="col-sm-12 my-2">
                            <label for="">آدرس دقیق <span class="text-danger">*</span></label>
                            <textarea type="text" class="hover form-control m-0" wire:model="address"
                                      wire:keyup.debounce.1000ms="updateTexts"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12 my-4 box text-right">
                    <label for="">محصولات</label>
                    <div class="row">
                        @foreach($products as $i)
                            <div class="col-auto my-2">
                                <label class="btn btn-outline-success">{{$i->title}}
                                    <u style="text-decoration: underline !important;">{{$i->qty}}</u> عدد</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 my-4 box text-right">
                    <div class="row">
                        <div class="col-12 my-2">
                            <label for="">اطلاعات و راه های ارتباطی</label>
                        </div>
                        <div class="col-12 my-2">
                            <table class="table table-dark table-striped text-center">
                                <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>مقدار</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($options as $i)
                                    <tr>
                                        <td>
                                            {{$i->title}}
                                        </td>
                                        <td>
                                            {{$i->text}}
                                        </td>
                                        <td>
                                            @if($option && $option->id==$i->id)

                                            @else
                                                <button class="btn btn-danger"
                                                        onclick="confirm('حذف شود؟' || event.stopImmediatePropagation())"
                                                        wire:click="deleteOption({{$i->id}})">
                                                    <i class="fa fa-recycle"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3">
                                        @if($option==null)
                                            <button type="button" class="btn btn-primary rounded w-100"
                                                    wire:click="addOption"
                                                    data-toggle="modal" data-backdrop="false"
                                                    data-target="#addOption">
                                                +
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="modal fade box" style="overflow: unset" wire:ignore.self id="addOption"
                                 tabindex="-1" role="dialog"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable"
                                     role="document">
                                    <div class="modal-content bg-dark" dir="rtl">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold" id="expaddLabel">افزودن اطلاعات و راه های
                                                ارتباطی</h5>
                                            <button type="button" class="btn btn-outline-danger rounded-circle"
                                                    data-dismiss="modal">X
                                            </button>
                                        </div>
                                        <form wire:submit.prevent="submitOption">
                                            <div class="modal-body">
                                                <div class="deadline-form">
                                                    <div class="row text-right">
                                                        <div class="col-sm-6">
                                                            {{--<label>
                                                                پیام رسان ها
                                                            </label>--}}
                                                            <select class="form-control hover" id="messengers"
                                                                    wire:model="title">
                                                                <option value="">انتخاب کنید</option>
                                                                <optgroup label="پیام رسان ها">
                                                                    <option value="تلگرام" data-rc="id">تلگرام</option>
                                                                    <option value="واتساپ" data-rc="num">واتساپ</option>
                                                                    <option value="بله" data-rc="id">بله</option>
                                                                    <option value="سروش" data-rc="id">سروش</option>
                                                                    <option value="دیسکورد" data-rc="join">دیسکورد
                                                                    </option>
                                                                    <option value="اسکایپ" data-rc="username">اسکایپ
                                                                    </option>
                                                                    <option value="مسنجر" data-rc="id">مسنجر</option>
                                                                    <option value="کیک" data-rc="id">کیک</option>
                                                                    <option value="وایبر" data-rc="num">وایبر</option>
                                                                    <option value="لاین" data-rc="id">لاین</option>
                                                                    <option value="ایتا" data-rc="id">ایتا</option>
                                                                    <option value="گپ" data-rc="id">گپ</option>
                                                                </optgroup>
                                                                <optgroup label="شبکه‌های اجتماعی">
                                                                    <option value="کانال تلگرام" data-rc="idJoin">کانال
                                                                        تلگرام
                                                                    </option>
                                                                    <option value="اینستاگرام" data-rc="id">اینستاگرام
                                                                    </option>
                                                                    <option value="یوتیوب" data-rc="channelLink">
                                                                        یوتیوب
                                                                    </option>
                                                                    <option data-rc="link" value="آپارات">آپارات
                                                                    </option>
                                                                    <option data-rc="id" value="توییتر">توییتر</option>
                                                                    <option data-rc="link" value="لینکدین">لینکدین
                                                                    </option>
                                                                    <option data-rc="link" value="فیسبوک">فیسبوک
                                                                    </option>
                                                                    <option data-rc="link" value="کلاب هاوس">کلاب هاوس
                                                                    </option>
                                                                    <option data-rc="link" value="توییچ">توییچ</option>
                                                                    <option data-rc="id" value="روبیکا">روبیکا</option>
                                                                    <option data-rc="id" value="تیک تاک">تیک تاک
                                                                    </option>
                                                                    <option data-rc="link" value="کافه بازار">کافه
                                                                        بازار
                                                                    </option>
                                                                    <option data-rc="link" value="گوگل پلی">گوگل پلی
                                                                    </option>
                                                                    <option data-rc="link" value="اپل استور">اپل استور
                                                                    </option>
                                                                    <option data-rc="link" value="مایکت">مایکت</option>
                                                                    <option data-rc="link" value="آی‌آپس">آی‌آپس
                                                                    </option>
                                                                    <option data-rc="link" value="سیب اپ">سیب اپ
                                                                    </option>
                                                                    <option data-rc="link" value="پینترست">پینترست
                                                                    </option>
                                                                </optgroup>
                                                                <optgroup label="تماس و راه‌های ارتباطی">
                                                                    <option data-rc="nothing" value="شماره موبایل">شماره
                                                                        موبایل
                                                                    </option>
                                                                    <option data-rc="nothing" value="شماره تلفن ثابت">
                                                                        شماره تلفن ثابت
                                                                    </option>
                                                                    <option data-rc="nothing" value="ایمیل">ایمیل
                                                                    </option>
                                                                    <option data-rc="nothing" value="شماره‌ی پیامک">
                                                                        شماره‌ی پیامک
                                                                    </option>
                                                                </optgroup>
                                                                <optgroup label="مسیریابی">
                                                                    <option data-rc="link" value="نشان">لینک نشان
                                                                    </option>
                                                                    <option data-rc="link" value="بلد">لینک بلد</option>
                                                                    <option data-rc="link" value="گوگل مپ">لینک گوگل
                                                                        مپ
                                                                    </option>
                                                                    <option data-rc="link" value="ویز">لینک ویز</option>
                                                                </optgroup>
                                                                <optgroup label="عکس">
                                                                    <option data-rc="image" data-fl="file" value="عکس">
                                                                        عکس
                                                                    </option>
                                                                </optgroup>
                                                                <optgroup label="ویدئو">
                                                                    <option data-rc="link" {{--data-fl="file"--}} value="ویدئو">
                                                                        ویدئو
                                                                    </option>
                                                                </optgroup>
                                                            </select>
                                                            @error('title')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-6">
                                                            {{--<label id="messengerLabel">
                                                                یک پیام رسان انتخاب کنید
                                                            </label>--}}
                                                            <input type="text" id="messengerInput" wire:model="text"
                                                                   class="form-control hover text-white"
                                                                   placeholder="یکی انتخاب کنید" disabled>

                                                            <input type="file" id="fileInput" wire:model="file"
                                                                   class="form-control hover text-white"
                                                                   style="display: none"
                                                                   placeholder="یکی انتخاب کنید">
                                                            @error('text')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-success mx-2 rounded" type="submit"
                                                        wire:click="submitOption" id="submitOptionButton" disabled>ذخیره
                                                </button>
                                                <button class="btn btn-warning mx-2 rounded" wire:click="cancelOption"
                                                        data-dismiss="modal">انصراف
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 my-4 text-right">
                    <div class="row">
                        <div class="col-12 my-2">
                            <button class="btn btn-outline-success rounded w-100 h-100" wire:click="submit"
                                    wire:confirm="فرم ثبت شده دیگر قابل تغییر نمی باشد. ثبت شود؟">ثبت
                                اطلاعات
                            </button>
                        </div>
                        @if($errors->any())
                            @if(!$errors->has('text'))
                                <div class="col-12 my-2 p-0 box border-danger border">
                                    @foreach($errors->all() as $e)
                                        <p class="text-danger text-center my-3">{{$e}}</p>
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
    @push('js')
        <script>
            $(window).ready(function () {
                $('#bodyTag').css('overflow', 'unset')
                $('div.wrap').css({overflow: 'unset', position: 'relative'})
                $('input').addClass('bg-transparent text-white-50')
                $('textarea').addClass('bg-transparent text-white-50')
                $('select').addClass('bg-dark text-white-50')
            })

            var messengers         = $('#messengers')
            var messengerLabel     = $('#messengerLabel')
            var messengerInput     = $('#messengerInput')
            var fileInput          = $('#fileInput')
            var submitOptionButton = $('#submitOptionButton')

            messengerInput.on('keyup', function () {
                if (!$(this).val()) {
                    submitOptionButton.attr({'disabled': true})
                } else {
                    submitOptionButton.attr({'disabled': false})
                }
            })

            fileInput.on('change', function () {
                if ($(this).files.length == 0) {
                    submitOptionButton.attr({'disabled': true})
                } else {
                    submitOptionButton.attr({'disabled': false})
                }
            })


            messengers.on('change', function () {
                var data_rc = $(this).find("option:selected").attr('data-rc')
                var data_fl = $(this).find("option:selected").attr('data-fl')
                if (data_fl == 'file') {
                    messengerInput.hide()
                    fileInput.show()
                } else {
                    messengerInput.show()
                    fileInput.hide()
                }
                if (data_rc == 'nothing') {
                    messengerLabel.html(messengers.val() + ' خود را وارد کنید')
                    messengerInput.attr({'placeholder': messengers.val() + ' خود را وارد کنید', 'disabled': false})
                } else if (data_rc == 'image') {
                    messengerLabel.html(messengers.val() + ' مورد نظر خود را آپلود کنید')
                    messengerInput.attr({
                                            'placeholder': messengers.val() + ' مورد نظر خود را آپلود کنید',
                                            'disabled'   : false
                                        })
                } else if (data_rc == 'id') {
                    messengerLabel.html('آی دی ' + messengers.val() + ' خود را وارد کنید')
                    messengerInput.attr({
                                            'placeholder': 'آی دی ' + messengers.val() + ' خود را وارد کنید',
                                            'disabled'   : false
                                        })
                } else if (data_rc == 'num') {
                    messengerLabel.html('شماره ' + messengers.val() + ' خود را وارد کنید')
                    messengerInput.attr({
                                            'placeholder': 'شماره ' + messengers.val() + ' خود را وارد کنید',
                                            'disabled'   : false
                                        })
                } else if (data_rc == 'channelLink') {
                    messengerLabel.html('لینک کانال ' + messengers.val() + ' خود را وارد کنید')
                    messengerInput.attr({
                                            'placeholder': 'لینک کانال ' + messengers.val() + ' خود را وارد کنید',
                                            'disabled'   : false
                                        })
                } else if (data_rc == 'link') {
                    messengerLabel.html('لینک ' + messengers.val() + ' خود را وارد کنید')
                    messengerInput.attr({
                                            'placeholder': 'لینک ' + messengers.val() + ' خود را وارد کنید',
                                            'disabled'   : false
                                        })
                } else if (data_rc == 'join') {
                    messengerLabel.html('لینک join ' + messengers.val() + ' خود را وارد کنید')
                    messengerInput.attr({
                                            'placeholder': 'لینک join ' + messengers.val() + ' خود را وارد کنید',
                                            'disabled'   : false
                                        })
                } else if (data_rc == 'idJoin') {
                    messengerLabel.html('آی دی یا لینک joinchat ' + messengers.val() + ' خود را وارد کنید')
                    messengerInput.attr({
                                            'placeholder': 'آی دی یا لینک joinchat ' + messengers.val() + ' خود را وارد کنید',
                                            'disabled'   : false
                                        })
                } else if (data_rc == 'username') {
                    messengerLabel.html('نام کاربری ' + messengers.val() + ' خود را وارد کنید')
                    messengerInput.attr({
                                            'placeholder': 'نام کاربری ' + messengers.val() + ' خود را وارد کنید',
                                            'disabled'   : false
                                        })
                } else {
                    messengerLabel.html('یکی انتخاب کنید')
                    messengerInput.attr({'placeholder': 'یکی انتخاب کنید', 'disabled': true})
                }

            })
        </script>
    @endpush
</div>
