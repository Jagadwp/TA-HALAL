@extends('../layout/' . $layout)

@section('head')
    <title>Web Kesiapan Sertifikasi Halal</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Icewall Tailwind HTML Admin Template" class="w-8" src="{{ asset('dist/images/halal-white-ok.png') }}">
                    <span class="text-white text-lg ml-3">
                        Web Kesiapan Sertifikasi Halal
                    </span>
                </a>
                <div class="my-auto">
                    <img alt="Icewall Tailwind HTML Admin Template" class="-intro-x -mt-16" src="{{ asset('dist/images/halal-new.png') }}" style="height: 18rem; width: 11rem; margin-left: 4rem">
                    <div class="-intro-x text-white font-medium text-2xl leading-tight mt-14" style="">Web penilaian mandiri produk <br> UMKM bidang makanan <br> & minuman</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Login</h2>
                    <div class="intro-x mt-8">
                        <form id="login-form">
                            <input id="email" type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="Email" value="">
                            <div id="error-email" class="login__input-error text-danger mt-2"></div>
                            <input id="password" type="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password" value="">
                            <div id="error-password" class="login__input-error text-danger mt-2"></div>
                        </form>
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button id="btn-login" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
                        <a href="{{ route('user.create') }}" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Registrasi</a>
                    </div>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        (function () {
            async function login() {
                // Reset state
                $('#login-form').find('.login__input').removeClass('border-danger')
                $('#login-form').find('.login__input-error').html('')

                // Post form
                let email = $('#email').val()
                let password = $('#password').val()

                // Loading state
                $('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
                tailwind.svgLoader()
                await helper.delay(1500)

                axios.post(`login`, {
                    email: email,
                    password: password
                }).then(res => {
                    location.href = '/'
                }).catch(err => {
                    $('#btn-login').html('Login')
                    if (err.response.data.message != 'Email atau password salah. Silahkan registrasi jika belum mempunyai akun.') {
                        for (const [key, val] of Object.entries(err.response.data.errors)) {
                            $(`#${key}`).addClass('border-danger')
                            $(`#error-${key}`).html(val)
                        }
                    } else {
                        $(`#password`).addClass('border-danger')
                        $(`#error-password`).html(err.response.data.message)
                    }
                })
            }

            $('#login-form').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    login()
                }
            })

            $('#btn-login').on('click', function() {
                login()
            })
        })()
    </script>
@endsection
