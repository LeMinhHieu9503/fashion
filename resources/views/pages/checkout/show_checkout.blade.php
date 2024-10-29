@extends('layout')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li class="active">Thanh toán giỏ hàng</li>
                </ol>
            </div>

            <div class="register-req">
                <p
                    style="
            font-size: 20px;
            font-weight: bold;
            color: #333;         
            background-color: #f9f9f9; 
            padding: 15px;
            border-left: 5px solid #4CAF50;
            border-radius: 4px;
            margin: 20px 0;
        ">
                    Vui lòng sử dụng Đăng ký và Thanh toán để dễ dàng truy cập vào lịch sử đơn hàng của bạn hoặc sử dụng
                    Thanh toán với tư cách là Khách
                </p>
            </div><!--/register-req-->

            <div class="shopper-informations">
                <div class="row">

                    <div class="col-sm-max clearfix">
                        <div class="bill-to">
                            <p>Điền thông tin gửi hàng</p>
                            <div class="form-one">
                                <form action="{{ URL::to('/save-checkout-customer') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="text" style="font-size: 20px" name="shipping_email" placeholder="Email">
                                    <input type="text" style="font-size: 20px" name="shipping_name" placeholder="Họ và tên">
                                    <input type="text" style="font-size: 20px" name="shipping_address" placeholder="Địa chỉ">
                                    <input type="text" style="font-size: 20px" name="shipping_phone" placeholder="Số điện thoại">
                                    <textarea name="shipping_notes" placeholder="Ghi chú về đơn hàng của bạn, Ghi chú đặc biệt về giao hàng" style="font-size: 20px" rows="16"></textarea>

                                    <input type="submit" value="Gửi" name="send_order" class="btn btn-default btn-sm">
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="review-payment">
                <h2>Xem lại giỏ hàng</h2>
            </div>

            <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection
