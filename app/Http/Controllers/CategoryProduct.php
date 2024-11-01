<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Để sử dụng Hash
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class CategoryProduct extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    // Hiển thị form thêm danh mục sản phẩm
    public function add_category_product()
    {
        $this->AuthLogin();

        return view('admin.add_category_product');
    }

    // Hiển thị danh sách tất cả danh mục sản phẩm
    public function all_category_product()
    {
        $this->AuthLogin();

        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')
            ->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
    }

    // Lưu danh mục sản phẩm vào cơ sở dữ liệu
    public function save_category_product(Request $request)
    {
        $this->AuthLogin();

        // Lấy dữ liệu từ form gửi lên và lưu vào mảng $data
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        // Thêm dữ liệu vào bảng 'tbl_category_product'
        DB::table('tbl_category_product')->insert($data);

        // Lưu thông báo thành công vào session
        Session::put('message', 'Thêm danh mục sản phẩm thành công');

        // Điều hướng đến trang danh sách danh mục sản phẩm
        return redirect::to('all-category-product');
    }

    public function unactive_category_product($category_product_id)
    {
        $this->AuthLogin();

        DB::table('tbl_category_product')->where('category_id', $category_product_id)
            ->update(['category_status' => 0]);
        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function active_category_product($category_product_id)
    {
        $this->AuthLogin();

        DB::table('tbl_category_product')->where('category_id', $category_product_id)
            ->update(['category_status' => 1]);
        Session::put('message', 'Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id)
    {
        $this->AuthLogin();

        $edit_category_product = DB::table('tbl_category_product')
            ->where('category_id', $category_product_id)
            ->get();
        $manager_category_product = view('admin.edit_category_product')
            ->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function update_category_product(Request $request, $category_product_id)
    {
        $this->AuthLogin();

        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;

        DB::table('tbl_category_product')
            ->where('category_id', $category_product_id)
            ->update($data);
        Session::put('message', 'Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($category_product_id)
    {
        $this->AuthLogin();

        DB::table('tbl_category_product')
            ->where('category_id', $category_product_id)
            ->delete();
        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    //End Function Admin PAGE


    //HOME
    public function show_category_home($category_id)
    {
        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();

        $category_by_id = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
            ->where('tbl_product.category_id', $category_id)
            ->get();

        $category_name = DB::table('tbl_category_product')
            ->where('tbl_category_product.category_id',$category_id)
            ->limit(1)
            ->get();

        return view('pages.category.show_category')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('category_by_id', $category_by_id)
            ->with('category_name',$category_name);
    }
}
