<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-signin-client_id" content="53973256354-uda7potqlmreidldkup6f898n1kitn3t.apps.googleusercontent.com">

        <title>Connect with Google Calendar</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="submited">
                @if(Session::has('success'))
                    <div class="alert alert-success wid"> {{ Session::get('success') }} </div>
                @endif
            </div>

            <div class="content cen">
                <form action="{{route('submit')}}" method="POST">
                    @csrf
                    @honeypot
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" placeholder="Event name" class="form-control">
                    </div>
                    @error('name')
                        <div class="alert alert-danger wid">{{$message}}</div>
                    @enderror
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" class="form-control" placeholder="xxx-xxxxxxx" required pattern="[0-9]{3}-[0-9]{7}">
                    </div>
                    @error('phone')
                        <div class="alert alert-danger wid">{{$message}}</div>
                    @enderror
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Enter attendee email" class="form-control" required>
                    </div>
                    @error('email')
                        <div class="alert alert-danger wid">{{$message}}</div>
                    @enderror
                    <div class="form-group">
                        <label for="time">Starting</label>
                        <input type="time" name="time" id="" class="form-control">
                    </div>
                    @error('time')
                        <div class="alert alert-danger wid">{{$message}}</div>
                    @enderror
                    <div class="form-group">
                        <label for="time_finish">Finishing</label>
                        <input type="time" name="time_finish" id="" class="form-control">
                    </div>
                    @error('time_finish')
                        <div class="alert alert-danger wid">{{$message}}</div>
                    @enderror
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="" class="form-control">
                    </div>
                    @error('date')
                        <div class="alert alert-danger wid">{{$message}}</div>
                    @enderror

                    <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                            @error('g-recaptcha-response')
                                <div class="alert alert-danger wid">{{$message}}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </body>
</html>
