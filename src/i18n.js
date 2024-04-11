import {createI18n} from 'vue-i18n'

const i18n = createI18n({
                            locale  : 'en',
                            messages: {
                                en: {
                                    LoginView: {
                                        header        : {
                                            header1: 'Welcome to',
                                            header2: 'Ezy Connect',
                                        },
                                        enterYourPhone: 'Enter your phone number to enter the application.',
                                        enterDigits   : 'Enter the 5-digit SMS code.',
                                        rules         : {
                                            rule1: 'By registering and logging in, I accept Easy Connect\'s',
                                            rule2: 'rules and regulations.',
                                        },
                                        registerButton: 'Register & Login',
                                        submitButton  : 'Submit',
                                        resentCode  : 'Send again',
                                        countDown  : ' after ',
                                    },
                                },
                                fa: {
                                    LoginView: {
                                        header        : {
                                            header1: 'به',
                                            header2: 'ایزی کانکت ',
                                            header3: 'خوش اومدی',
                                        },
                                        enterYourPhone: 'برای ورود به اپلیکیشن، شماره موبایلت را وارد کن.',
                                        enterDigits   : 'کد 5 رقمی ارسال شده به شماره زیر را وارد کن.',
                                        rules         : {
                                            rule1: 'با ثبت نام و ورود',
                                            rule2: 'قوانین و مقررات ',
                                            rule3: 'ایزی کانکت را می‌پذیرم.',
                                        },
                                        registerButton: 'ثبت نام و ورود',
                                        submitButton  : 'تائید',
                                        resentCode  : 'ارسال مجدد کد',
                                        countDown  : ' بعد از ',
                                    },
                                },
                            },
                        });
export default i18n;
