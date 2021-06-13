<!-- nav bar -->
<section id="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand logo" href="/"><img src="{{ asset('frontend/img/Group 395.png')}}" alt=""
                style="width: 180px; height: 180px; object-fit: contain;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item ">
                    <a class="nav-link" href="/about">About </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/courses">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pricing">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact Us</a>
                </li>

            </ul>
            <!-- <ul class="sign-in">
                <a class="btn  my-2 my-sm-0">Register</a>
            </ul> -->
        </div>
        <button type="button" class="btn sign-in" data-toggle="modal" data-target="#registerModal">
            Register
        </button>
        <button type="button" class="btn sign-in" data-toggle="modal" data-target="#signInModal">
            Sign In
        </button>

    </nav>


    <!-- Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="mod-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h1>SIKAAI Welcomes You Back</h1>
                            <hr style=" border-top: 8px solid #F3F3F3;
                            border-radius: 5px;
                            width: 105px;">
                            <p>Sign in to continue to your account.</p>
                        </div>
                        <div class="col-md-8" style="background-color: #fff">
                            <form class="p-4" method="POST" action="{{ route('register') }}" name="register">
                                @csrf
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Full Name <span
                                            style="color: red;">*</span></label>
                                    <input type="text"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        id="formGroupExampleInput" name="name" placeholder="Full Name" required>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Email <span style="color: red;">*</span></label>
                                    <input type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        id="formGroupExampleInput2" name="email" placeholder="example@domain.com"
                                        required>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Password <span
                                            style="color: red;">*</span></label>
                                    <input type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        id="formGroupExampleInput2" name="password" required>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label
                                        for="password-confirm formGroupExampleInput2">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Phone Number <span
                                            style="color: red;">*</span></label>
                                    <input type="number"
                                        class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}"
                                        id="formGroupExampleInput2" name="contact" required>
                                    @if ($errors->has('contact'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Address <span style="color: red;">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                        id="formGroupExampleInput2" name="address" required>
                                    @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">College Name (+2) <span
                                            style="color: red;">*</span></label>
                                    <input type="text"
                                        class="form-control{{ $errors->has('passed') ? ' is-invalid' : '' }}"
                                        id="formGroupExampleInput2" name="passed" required>
                                    @if ($errors->has('passed'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('passed') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">After +2 which program do you want to study?
                                        <span style="color: red;">*</span></label>
                                    <input type="text"
                                        class="form-control{{ $errors->has('school') ? ' is-invalid' : '' }}"
                                        id="formGroupExampleInput2" name="school" required>
                                    @if ($errors->has('school'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('school') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class=" modal-footer justify-content-start">
                                    <button type="submit" value="submit" class="btn " data-ref-label="Register"
                                        id="button-register">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="signInModal" tabindex="-1" aria-labelledby="signInModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="mod-body">
                    <div class="row">
                        <div class="col-md-4 py-5">
                            <h1 class="mt-0">SIKAAI Welcomes You Back</h1>
                            <hr style=" border-top: 8px solid #F3F3F3;
                            border-radius: 5px;
                            width: 105px;">
                            <p>Sign in to continue to your account.</p>
                        </div>
                        <div class="col-md-8 my-auto">
                            <form class="p-4" method="POST" action="{{ route('login') }}" name="login">
                                @csrf
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Email <span style="color: red;">*</span></label>
                                    <input type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        id="formGroupExampleInput2" name="email" placeholder="example@domain.com"
                                        required>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Password <span
                                            style="color: red;">*</span></label>
                                    <input type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        id="formGroupExampleInput2" name="password" required>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class=" modal-footer justify-content-start">
                                    <button type="submit" value="submit" class="btn mx-auto" data-ref-label="Register"
                                        id="button-register">Sign In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
