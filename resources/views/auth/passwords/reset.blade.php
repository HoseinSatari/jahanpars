@extends('home.layout.header')

@section('content')
    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(/images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2>تایید کد</h2>

        </div>
    </section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class=" mt-4">
                        </div>
                        <div class="alert alert-primary text-right mt-4">کلمه عبور جدید خود را وارد کنید</div>
                        <form action="{{ route('user.reset') }}" method="post" class="mt-5 mb-15">
                            @csrf
                            <div class="form-group">
                                <label for="singin-email-2"> کلمه عبور جدید</label>
                                <input type="password"  class="form-control @error('password') is-invalid @enderror"  id="singin-email-2"
                                       name="password" required>
                                @error('password')
                                <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><!-- End .form-group -->
                            <div class="form-group">
                                <label for="singin-email-2">تکرار کلمه عبور جدید</label>
                                <input type="password"  class="form-control @error('password_confirmation') is-invalid @enderror"  id="singin-email-2"
                                       name="password_confirmation" required>
                                @error('password_confirmation')
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
