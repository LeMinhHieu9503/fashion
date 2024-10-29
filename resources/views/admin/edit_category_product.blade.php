@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục sản phẩm
                </header>
                <!-- Hiển thị thông báo từ Session -->
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::forget('message'); // Xóa thông báo sau khi hiển thị
                }
                ?>
                <div class="panel-body">
                    @foreach ($edit_category_product as $key => $edit_value)
                        <div class="position-center">
                            <!-- Form bắt đầu -->
                            <form role="form" method="POST"
                                action="{{ URL::to('/update-category-product/' . $edit_value->category_id) }}">
                                <!-- Thêm token bảo mật -->
                                {{ csrf_field() }}

                                <!-- Nhập tên danh mục -->
                                <div class="form-group">
                                    <label for="categoryProductName">Tên danh mục</label>
                                    <input type="text" name="category_product_name" class="form-control"
                                        id="categoryProductName" value="{{ $edit_value->category_name }}" required>
                                </div>

                                <!-- Mô tả danh mục -->
                                <div class="form-group">
                                    <label for="categoryProductDesc">Mô tả danh mục</label>
                                    <textarea name="category_product_desc" class="form-control" id="categoryProductDesc" cols="30"
                                        placeholder="Mô tả danh mục" rows="10" required>{{ $edit_value->category_desc }}</textarea>
                                </div>

                                <!-- Nút Cập nhật -->
                                <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật danh
                                    mục</button>
                            </form>
                            <!-- Form kết thúc -->
                        </div>
                </div>
                @endforeach
            </section>
        </div>
    </div>
@endsection
