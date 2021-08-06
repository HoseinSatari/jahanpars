@extends('home.layout.header')

@section('content')
    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2>بازیابی کلمه عبور</h2>

        </div>
    </section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class=" mt-4">
                        </div>
                        <div class="alert alert-primary text-right mt-4">جهت بازیابی کلمه عبور لطفا ایمیل یا شماره همراه خود را وارد کنید</div>
                        <form action="{{ route('user.resetpassword') }}" method="post" class="mt-5 mb-15">
                            @csrf
                            <div class="form-group">
                                <label for="singin-email-2"> ایمیل یا شماره همراه</label>
                                <input type="text"  class="form-control @error('email') is-invalid @enderror" placeholder="ایمیل یا شماره تلفن" id="singin-email-2"
                                       name="email" required>
                                @error('email')
                                <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>ارسال</span>
                                    <i class="icon-long-arrow-left"></i>
                                </button>
                            </div><!-- End .form-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
