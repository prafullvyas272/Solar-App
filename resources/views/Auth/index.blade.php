<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Login | RJ Energy</title>
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

                <!-- Left Side - Logo and Welcome Message (6 cols on desktop) -->
                <div class="lg:col-span-6 text-center lg:text-left">
                    <div class="mb-8">
                        <div class="inline-flex items-center justify-center w-32 h-32 mb-8 bg-white/10 rounded-full glass-effect">
                            <img src="{{ asset('assets/img/favicon/Full_Logo.jpg') }}" alt="RJ Energy Logo" class="w-24 h-24 object-contain rounded-lg">
                        </div>
                        <h1 class="text-4xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                            Welcome to <br>
                            <span class="text-brand-blue bg-gradient-to-r from-brand-blue to-cyan-400 bg-clip-text text-transparent">
                                RJ Energy
                            </span>
                        </h1>
                        <p class="text-xl text-white/80 mb-8 max-w-md mx-auto lg:mx-0">
                            Sign-in to access your dashboard and manage your energy solutions
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

                <!-- Right Side - Login Form (6 cols on desktop) -->
                <div class="lg:col-span-6">
                    <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8 lg:p-12 max-w-md mx-auto w-full">
                        <div class="mb-8">
                            <h2 class="text-3xl font-bold text-gray-800 mb-2">Sign In</h2>
                            <p class="text-gray-600">Enter your credentials to access your account</p>
                        </div>

                        <form id="formAuthentication" method="POST" action="{{ route('loginPost') }}" class="space-y-6">
                            @csrf

                            <!-- Email/Username Field -->
                            <div class="relative">
                                <input
                                    type="text"
                                    id="email"
                                    name="email"
                                    placeholder=" "
                                    value="{{ old('email') }}"
                                    class="input-field w-full px-4 py-4 text-gray-700 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-brand-blue focus:bg-white focus:outline-none transition-all duration-300 peer @error('email') border-red-500 @enderror"
                                    autofocus
                                />
                                <label for="email" class="floating-label absolute left-4 top-4 text-gray-500 transition-all duration-300 pointer-events-none peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:text-sm peer-focus:text-brand-blue peer-focus:bg-white peer-focus:px-2 peer-focus:-translate-y-1/2">
                                    Email or Username
                                </label>
                                <span class="text-red-500 text-sm mt-1" id="email-error"></span>
                                @error('email')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="relative">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder=" "
                                    value="{{ old('password') }}"
                                    class="input-field w-full px-4 py-4 pr-12 text-gray-700 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-brand-blue focus:bg-white focus:outline-none transition-all duration-300 peer @error('password') border-red-500 @enderror"
                                />
                                <label for="password" class="floating-label absolute left-4 top-4 text-gray-500 transition-all duration-300 pointer-events-none peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:text-sm peer-focus:text-brand-blue peer-focus:bg-white peer-focus:px-2 peer-focus:-translate-y-1/2">
                                    Password
                                </label>
                                <button type="button" class="toggle-password absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-brand-blue transition-colors">
                                    <i class="mdi mdi-eye-off-outline text-xl"></i>
                                </button>
                                <span class="text-red-500 text-sm mt-1" id="password-error"></span>
                                @error('password')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" id="remember-me" class="sr-only">
                                    <div class="relative">
                                        <div class="w-5 h-5 bg-gray-200 border-2 border-gray-300 rounded transition-all duration-200 peer-checked:bg-brand-blue peer-checked:border-brand-blue"></div>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <i class="mdi mdi-check text-white text-sm opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                        </div>
                                    </div>
                                    <span class="ml-3 text-gray-600 text-sm">Remember Me</span>
                                </label>
                                <a href="{{ Route('forgotPassword') }}" class="text-brand-blue hover:text-blue-600 text-sm font-medium transition-colors">
                                    Forgot Password?
                                </a>
                            </div>

                            <!-- Sign In Button -->
                            <button type="submit" class="w-full bg-gradient-to-r from-brand-blue to-cyan-500 text-white font-semibold py-4 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-brand-blue/25">
                                <span class="flex items-center justify-center">
                                    <i class="mdi mdi-login mr-2"></i>
                                    Sign In
                                </span>
                            </button>

                            <!-- Divider -->
                            <div class="relative my-6">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-4 bg-white text-gray-500">Secure Login</span>
                                </div>
                            </div>

                            <!-- Footer Text -->
                            <div class="text-center">
                                <p class="text-gray-500 text-sm">
                                    Protected by enterprise-grade security
                                </p>
                            </div>
                        </form>
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

    @if (session()->has('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif

    <script>
        $(document).ready(function() {
            // Password toggle functionality
            $('.toggle-password').click(function() {
                var passwordField = $('#password');
                var icon = $(this).find('i');

                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('mdi-eye-off-outline').addClass('mdi-eye-outline');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('mdi-eye-outline').addClass('mdi-eye-off-outline');
                }
            });

            // Custom checkbox functionality
            $('#remember-me').change(function() {
                $(this).next('.relative').find('div').first().toggleClass('peer-checked:bg-brand-blue peer-checked:border-brand-blue');
                $(this).next('.relative').find('i').toggleClass('peer-checked:opacity-100');
            });

            // Form validation
            $("#formAuthentication").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        maxlength: 50,
                    },
                    password: {
                        required: true,
                        maxlength: 50,
                    },
                },
                messages: {
                    email: {
                        required: "Email is required",
                        email: "Please enter a valid email address",
                        maxlength: "Email cannot be more than 50 characters",
                    },
                    password: {
                        required: "Password is required",
                        maxlength: "Password cannot be more than 50 characters",
                    },
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
                    form.submit();
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
