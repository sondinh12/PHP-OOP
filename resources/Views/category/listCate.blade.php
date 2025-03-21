<!DOCTYPE html>
<html lang="en">
@include('component.header')
<body>
    <div id="wrapper">
        @include('component.side-bar')
        <div id="page-wrapper" class="gray-bg">
            @include('component.profile-head')
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Danh sách danh mục</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Category</a>
                        </li>
                        <li class="active">
                            <strong>Danh mục</strong>
                        </li>
                    </ol>
                </div>               
            </div>  
            @php
                if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
            @endphp

            {{-- form tìm kiếm --}}
            <form action="<?= $_ENV['BASE_URL'] . 'admin/category' ?>" method="GET" class="mb-4 d-flex">
                <input type="text" name="cate_name" value="{{ $keyword }}" class="form-control me-2" placeholder="Nhập tên danh mục...">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </form>
            <div class="table-responsive">
                <p>
                    <a href="<?=$_ENV['BASE_URL'] . 'admin/category/add'?> "><button class="btn btn-primary">Thêm</button></a>
                </p>
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($cate) && count($cate) > 0)
                        @foreach($cate as $key)
                                <tr>
                                    <td>{{ $key['cate_id'] }}</td>
                                    <td>{{ $key['cate_name'] }}</td>
                                    <td>{{ $key['create_at'] }}</td>
                                    <td>{{ $key['update_at'] }}</td>
                                    <td>
                                        <a href="{{ $_ENV['BASE_URL'] . 'admin/category/update/' . $key['cate_id'] }}" class="btn btn-warning btn-sm">Sửa</a>
                                        <a href="{{ $_ENV['BASE_URL'] . 'admin/category/delete/' . $key['cate_id'] }}" 
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" 
                                           class="btn btn-danger btn-sm">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center text-danger">Không tìm thấy sản phẩm nào.</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
            @include('component.footer')
        </div>
    </div>
    

    @include('component.script');

</body>
</html>