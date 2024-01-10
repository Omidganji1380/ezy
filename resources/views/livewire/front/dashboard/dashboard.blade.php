<div>
    @push('css')
        <style>
            .selected::after {
                background-color: red;
            }

            .selected:hover::after {
                background-color: red;
            }

            .button:hover {
                color: #2f9064 !important;
            }

            .selected:hover {
                color: #ff3636 !important;
            }
        </style>
    @endpush
    <div class="container bg-dark my-5 p-3">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6 my-2 my-sm-0 col-sm-auto text-center">
                        <button class="button hover" wire:click="gotoPageBuilder">صفحه ساز
                        </button>
                    </div>
                    <div class="col-6 my-2 my-sm-0 col-sm-auto text-center">
                        <button class="button hover b1" role="button" data-toggle="collapse" data-target="#dashboard"
                                aria-expanded="true" aria-controls="dashboard">داشبورد
                        </button>
                    </div>
                    <div class="col-6 my-2 my-sm-0 col-sm-auto text-center">
                        <button class="button hover b2" role="button" data-toggle="collapse" data-target="#orders"
                                aria-expanded="true" aria-controls="orders">سفارشات
                        </button>
                    </div>
                    <div class="col-6 my-2 my-sm-0 col-sm-auto text-center">
                        <button class="button hover b3" role="button" data-toggle="collapse" data-target="#profile"
                                aria-expanded="true" aria-controls="profile">پروفایل
                        </button>
                    </div>
                    <div class="col-6 my-2 my-sm-0 col-sm-auto text-center ml-auto">
                        <a href="{{route('logout')}}" class="button hover b4">خروج
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 my-3" id="accordionParent">
                <div class="collapse" id="dashboard" data-parent="#accordionParent">
                    111111
                </div>
                <div class="collapse" id="orders" data-parent="#accordionParent">
                    2222222
                </div>
                <div class="collapse" id="profile" data-parent="#accordionParent">
                    <form action="" class="box">
                        <div class="row contact-form flex-md-row-reverse">
                            <div class="col-12 col-md-6">
                                <input type="text" class="hover form-control cursor-pen"
                                       placeholder="نام و نام خانوادگی">
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" class="hover form-control cursor-pen" placeholder="ایمیل">
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" class="hover form-control cursor-pen" placeholder="شماره تلفن">
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" class="hover form-control cursor-pen" placeholder="کد پستی">
                            </div>
                            <div class="col-12 col-md-12">
                                <textarea class="hover form-control cursor-pen" placeholder="آدرس"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function () {

                var button1 = $('.b1');
                var button2 = $('.b2');
                var button3 = $('.b3');
                var button4 = $('.b4');

                var dashboard = $('#dashboard');
                var orders    = $('#orders');
                var profile   = $('#profile');
                var close     = $('#close');

                button1.on('click', function () {
                    rc()
                    button1.addClass('selected')
                })
                button2.on('click', function () {
                    rc()
                    button2.addClass('selected')
                })
                button3.on('click', function () {
                    rc()
                    button3.addClass('selected')
                })
                button4.on('click', function () {
                    rc()
                    button4.addClass('selected')
                })

                function rc() {
                    button1.removeClass('selected')
                    button2.removeClass('selected')
                    button3.removeClass('selected')
                    button4.removeClass('selected')

                }
            })
        </script>
    @endpush
</div>
