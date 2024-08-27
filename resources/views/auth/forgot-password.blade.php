<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     {{-- css files --}}
     @include('backEnd.inc.css_file')
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-6 m-auto">
                <div class="card shadow-lg" style="margin-top: 200px">
                    <div class="card-header">
                        <h3>Forgot your password?</h3> <br>
                         <p style="opacity: 50%">No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                    </div>
                    <div class="card-body">
                        <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                            
                                <!-- Email Address -->
                                <div>
                                    <label for="email"> Enter your E-mail </label>
                                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            
                                <div class="flex items-center justify-end mt-4">
                                    <button type="submit" class="btn btn-outline-secondary">
                                        {{ __('Email Password Reset Link') }}
                                    </button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- js file --}}
    @include('backEnd.inc.js_file')
</body>
</html>
