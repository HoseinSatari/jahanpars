@extends('home.layout.header')


@section('content')
    <script>
        function changeQuantity(event, id) {
            //
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })

            //
            $.ajax({
                type: 'POST',
                url: '/cart/quantity/change',
                data: JSON.stringify({
                    id: id,
                    quantity: event.target.value,
                    _method: 'patch'
                }),
                success: function (res) {
                    location.reload();
                }
            });
        }

        function code() {
            if (!$("#code").val()){

                if (!$("#alert-empty").length) {
                    $('#alert').html("<div class='alert alert-danger'>"+'فیلد کد تخفیف خالی میباشد'+"</div>");
                    $('#alert').show();
                    setTimeout(function(){
                        $('#alert').hide();
                    }, 3000);
                }

            }else{
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                })
                $.ajax({
                    type: 'POST',
                    url: '/check_discount/'+ $("#code").val(),
                    data: JSON.stringify('send'),
                    success: function (item) {
                          if (item['error']){
                              $('#alert').html("<div class='alert alert-danger'>"+item['error']+"</div>");
                              $('#alert').show();
                              setTimeout(function(){
                                  $('#alert').hide();
                              }, 3000);
                          }
                          if (item['success']){
                                  $("#total").text(item['total']+' تومان');
                              $('#alert').html("<div class='alert alert-success'>"+item['success']+"</div>");
                              $('#alert').show();
                              setTimeout(function(){
                                  $('#alert').hide();
                              }, 5000);

                          }


                    }
                })
            }


        }
    </script>
    <section class="page-title">
        <div class="pattern-layer-one" style="background-image: url(/images/background/pattern-16.png)"></div>
        <div class="auto-container">
            <h2>سبد خرید </h2>
        </div>
    </section>
    <!--End Page Title-->

    <!--Cart Section-->
    <section class="cart-section">
        <div class="auto-container">

            <!--Cart Outer-->
            <div class="cart-outer">
                <div class="table-outer">
                    <table class="cart-table">
                        <thead class="cart-header">
                        <tr>
                            <th class="prod-column">محصول</th>
                            <th class="price">قیمت</th>
                            <th>تعداد</th>
                            <th>مجموع</th>
                            <th>پاک کردن</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach(auth()->user()->cart as $cart)
                               @php $product = \App\Product::where('id' , $cart->product_id)->first()  @endphp
                            <tr>
                                <td class="prod-column">
                                    <div class="column-box">
                                        <figure class="prod-thumb"><a href="{{route('single' , $product->slug)}}"><img
                                                    src="{{$product->image}}" alt="{{$product->title}}"></a></figure>
                                        <h6 class="prod-title">{{$product->title}}  </h6>
                                    </div>
                                </td>
                                <td class="price">{{number_format($product->price)}} تومان</td>
                                <td class="qty"><input type="number" id="qty" name="qty" class="form-control"
                                                       value="{{$cart->qty}}" min="1"
                                                       max="{{$product->inventory}}"
                                                       step="1" data-decimals="1" required
                                                       onchange="changeQuantity(event , {{$cart->id}})">
                                </td>
                                <td class="sub-total">{{auth()->user()->total()}} تومان</td>
                                <td class="remove">
                                    <form action="{{route('cartdelete' , $cart->id)}}"
                                          method="post">@csrf @method('delete')
                                        <button type="submit" class="remove-btn"><span class="flaticon-multiply"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="coupon-outer clearfix">

                    <div class="pull-left">
                        <div id='alert' class="hide"></div>
                        <div class="apply-coupon clearfix">
                            <div class="form-group clearfix">
                                <form action="{{route('order.store')}}" method="post" id="order">
                                    @csrf

                                    <input type="text" name="discount" id="code" value="" placeholder="ک تخفیف">
                                </form>
                            </div>
                            <div class="form-group clearfix">
                                <button type="button" class="theme-btn coupon-btn btn-style-three" onclick="code()">
                                    <span class="txt"> برسی کد </span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <!--Cart Total Box-->
                <div class="cart-total-box">
                    <h4>مجموع سبد خرید</h4>
                    <!--Totals Table-->
                    <ul class="totals-table">
                        <li class="clearfix"><span class="col col-title">مجموع کامل</span><span class="col" id="total">{{number_format(auth()->user()->total())}} تومان</span>
                        </li>

                    </ul>
                </div>
                <div class="text-left">
                    <button type="submit" class="theme-btn checkout-btn"
                            onclick="document.getElementById('order').submit()">ثبت سفارش و نهایی کردن خرید
                    </button>
                </div>
            </div>

        </div>
    </section>

@endsection
