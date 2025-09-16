<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Forgot Password | RJ ENERGY</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/Favicon.png') }}" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" />

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Custom Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'brand-blue': '#29a8df',
                        'brand-dark': '#1e293b',
                    }
                }
            }
        }
    </script>

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .floating-label {
            transition: all 0.3s ease;
        }
        .input-field:focus + .floating-label,
        .input-field:not(:placeholder-shown) + .floating-label {
            transform: translateY(-1.5rem) scale(0.75);
            color: #29a8df;
        }
    </style>
</head>

<body class="font-inter antialiased">
    <div class="min-h-screen gradient-bg flex items-center justify-center p-4">
        <div class="w-full max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">

                <!-- Left Side - Logo and Message -->
                <div class="lg:col-span-6 text-center lg:text-left">
                    <div class="mb-8">
                        <div class="inline-flex items-center justify-center w-32 h-32 mb-8 bg-white/10 rounded-full glass-effect">
                            <img src="{{ asset('assets/img/favicon/Full_Logo.jpg') }}" alt="RJ Energy Logo" class="w-24 h-24 object-contain rounded-lg">
                        </div>
                        <h1 class="text-4xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                            Forgot <br>
                            <span class="text-brand-blue bg-gradient-to-r from-brand-blue to-cyan-400 bg-clip-text text-transparent">
                                Password?
                            </span>
                        </h1>
                        <p class="text-xl text-white/80 mb-8 max-w-md mx-auto lg:mx-0">
                            Enter your e-mail address below to reset your password.
                        </p>
                        <!-- Decorative Elements -->
                        <div class="hidden lg:block">
                            <div class="flex space-x-4 justify-center lg:justify-start">
                                <div class="w-3 h-3 bg-brand-blue rounded-full animate-pulse"></div>
                                <div class="w-3 h-3 bg-cyan-400 rounded-full animate-pulse delay-100"></div>
                                <div class="w-3 h-3 bg-blue-300 rounded-full animate-pulse delay-200"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Forgot Password Form -->
                <div class="lg:col-span-6">
                    <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8 lg:p-12 max-w-md mx-auto w-full">
                        <div class="mb-8">
                            <h2 class="text-3xl font-bold text-gray-800 mb-2">Reset Password</h2>
                            <p class="text-gray-600">We'll send you a link to reset your password</p>
                        </div>
                        <form action="javascript:void(0)" id="commonform" name="commonform"
                            class="space-y-6" method="POST" enctype="multipart/form-data">
                            <div class="relative">
                                <input
                                    type="text"
                                    id="email"
                                    name="email"
                                    placeholder=" "
                                    class="input-field w-full px-4 py-4 text-gray-700 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-brand-blue focus:bg-white focus:outline-none transition-all duration-300 peer"
                                    autofocus
                                />
                                <label for="email" class="floating-label absolute left-4 top-4 text-gray-500 transition-all duration-300 pointer-events-none peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:text-sm peer-focus:text-brand-blue peer-focus:bg-white peer-focus:px-2 peer-focus:-translate-y-1/2">
                                    Email
                                </label>
                                <span class="text-red-500 text-sm mt-1" id="email-error"></span>
                            </div>
                            <button type="submit" class="w-full bg-gradient-to-r from-brand-blue to-cyan-500 text-white font-semibold py-4 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-brand-blue/25">
                                <span class="flex items-center justify-center">
                                    <i class="mdi mdi-email-outline mr-2"></i>
                                    Send Reset Link
                                </span>
                            </button>
                        </form>
                        <div class="text-center mt-6">
                            <a href="{{ Route('login') }}" class="flex items-center justify-center text-brand-blue hover:text-blue-600 text-sm font-medium transition-colors">
                                <i class="mdi mdi-chevron-left mr-1 text-lg"></i>
                                Back to login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Background Decorations -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-brand-blue/10 rounded-full blur-3xl"></div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Form validation (functionality unchanged)
            $("#commonform").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email address.",
                        email: "Please enter a valid email address."
                    }
                },
                errorPlacement: function(error, element) {
                    var errorId = element.attr("name") + "-error";
                    $("#" + errorId).text(error.text());
                    $("#" + errorId).show();
                    element.addClass("border-red-500").removeClass("border-gray-200");
                },
                success: function(label, element) {
                    var errorId = $(element).attr("name") + "-error";
                    $("#" + errorId).text("");
                    $(element).removeClass("border-red-500").addClass("border-gray-200");
                },
                submitHandler: function(form) {
                    var postData = {
                        email: $("#email").val(),
                    };
                    var url = "{{ config('apiConstants.AUTH_URL.FORGOT_PASSWORD') }}";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: postData,
                        success: function(response) {
                            if (response.status === 200) {
                                toastr.success(response.message, "Success", {
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-top-right",
                                });
                            }
                        },
                        error: function(xhr) {
                            // Clear any previous error messages
                            $('.input-field').removeClass('border-red-500').addClass('border-gray-200');
                            $('.text-red-500').text('');

                            var response = xhr.responseJSON;
                            if (response && response.message) {
                                toastr.error(response.message, "Error", {
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-top-right",
                                });
                            }
                            if (response && response.errors) {
                                $.each(response.errors, function(key, value) {
                                    var inputField = $('#' + key);
                                    var errorField = $('#' + key + '-error');
                                    inputField.addClass('border-red-500').removeClass('border-gray-200');
                                    errorField.text(value).removeClass('d-none');
                                });
                            }
                        }
                    });
                }
            });

            // Enhanced floating labels
            $('.input-field').on('focus blur', function() {
                $(this).toggleClass('focused');
            });
        });
    </script>
</body>
</html>
