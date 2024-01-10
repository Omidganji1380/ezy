<div>
    <div class="newsletter-block" wire:ignore.self>
        <div class="main">
            {{--            <h3>مشترک شدن در خبرنامه ما</h3>--}}
            <div class="hover news-close">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                           fill="#000000">
                            <rect x="0" y="7" width="16" height="2" rx="1"></rect>
                            <rect opacity="0.3"
                                  transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) "
                                  x="0" y="7" width="16" height="2" rx="1"></rect>
                        </g>
                    </g>
                </svg>
                بستن
            </div>
            <div id="show_subscriber_msg"></div>
            <div class="mt-50" id="subscribe">
                @if($loginFlag)
                        <div class="row justify-content-evenly flex-md-row-reverse">
                            <div class="col-12 col-md-4">
                                <input class="hover cursor-pen subscribe-email w-75" id="subscriberemail"
                                       name="subscriberemail"
                                       placeholder="رمز عبور" type="password" wire:keyup.enter="loginPassword" wire:model="password" required autocomplete="false" wire:loading.attr="disabled" wire:target="loginPassword">
                            </div>
                            @error('password')
                            <div class="col-12 mb-3">
                                <span class="text-danger small">{{$message}}</span>
                            </div>
                            @enderror
                            <div class="col-12">
                                <div class="row justify-content-center flex-row-reverse">
                                    <div class="col-auto">
                                        <button class="hover btn button" type="button" wire:click="loginPassword" data-text="ورود">
                                            <b></b>
                                            <b></b>
                                            <span>ورود</span>
                                        </button>
                                    </div>
                                    <div class="col-auto">
                                        <button class="hover btn button" wire:click="showSmsForm" type="button"
                                                data-text="ارسال کد">
                                            <b></b>
                                            <b></b>
                                            <span>کد</span>
                                            <span>ارسال</span>
                                        </button>
                                    </div>
                                    <div class="col-auto">
                                        <button class="hover btn button" wire:click="returnToPhone" type="button"
                                                data-text="بازگشت">
                                            <b></b>
                                            <b></b>
                                            <span>بازگشت</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
                @if($smsFlag)
                    <div class="row justify-content-evenly flex-md-row-reverse">
                        <div class="col-12 mb-3">
                            <span class="text-success small">کد ارسال شده را وارد کنید</span>
                        </div>
                        <div class="col-12 col-md-4">
                            <input class="hover cursor-pen subscribe-email w-75"
                                   placeholder="کد" type="text" wire:model="smsCode" wire:keyup.enter="smsSubmit" wire:loading.attr="disabled" wire:target="smsSubmit">
                        </div>
                        @error('smsCode')
                        <div class="col-12 mb-3">
                            <span class="text-danger small">{{$message}}</span>
                        </div>
                        @enderror
                        <div class="col-12">
                            <div class="row justify-content-center flex-row-reverse">
                                <div class="col-auto">
                                    <button class="hover btn button" type="button" wire:click="smsSubmit"
                                            data-text="تایید">
                                        <b></b>
                                        <b></b>
                                        <span>تایید</span>
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <button class="hover btn button" type="button" wire:click="sendSms"
                                            data-text="ارسال مجدد">
                                        <b></b>
                                        <b></b>
                                        <span>مجدد</span>
                                        <span>ارسال</span>
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <button class="hover btn button" wire:click="returnToPhone" type="button"
                                            data-text="بازگشت">
                                        <b></b>
                                        <b></b>
                                        <span>بازگشت</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{--@if($smsFlag)
                        <div class="row justify-content-evenly flex-md-row-reverse">
                            <div class="col-12 col-md-4">
                                <input wire:model="email" class="hover cursor-pen subscribe-email w-75"
                                       id="subscriberemail"
                                       name="subscriberemail"
                                       placeholder="کد" type="email" required autocomplete="false">
                            </div>
                            <div class="col-12">
                                <div class="row justify-content-center flex-row-reverse">
                                    <div class="col-auto">
                                        <button class="hover btn button" type="submit" data-text="فراموشی">
                                            <b></b>
                                            <b></b>
                                            <span>فراموشی</span>
                                        </button>
                                    </div>
                                    <div class="col-auto">
                                        <button class="hover btn button" wire:click="returnToPhone" type="button"
                                                data-text="بازگشت">
                                            <b></b>
                                            <b></b>
                                            <span>بازگشت</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif--}}
                @if($phoneFlag)
                    <div class="row justify-content-evenly flex-md-row-reverse">
                        <div class="col-12 col-md-4">
                            <input wire:model.live="phone" wire:keyup.enter="showLoginForm" wire:loading.attr="disabled" wire:target="showLoginForm" class="hover cursor-pen subscribe-email w-75"
                                   id="subscriberemail"
                                   name="subscriberemail"
                                   placeholder="شماره موبایل" type="text">
                            @error('phone')
                            <div class="col-12 mb-3">
                                <span class="text-danger small">{{$message}}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="row flex-row-reverse justify-content-center mt-5">
                                <div class="col-auto col-md-auto">
                                    <button class="hover btn button" wire:click="showLoginForm" type="button"
                                            data-text="ورود | عضویت">
                                        <b></b>
                                        <b></b>
                                        <span>عضویت</span>
                                        <span>|</span>
                                        <span>ورود</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @push('js')
        <script>
            var a = $('.newsletter-block')
            $(document).ready(function () {
                a.addClass('open')
                setTimeout(function () {
                    a.removeClass('open')
                }, 1000)
            })
        </script>
    @endpush
</div>
