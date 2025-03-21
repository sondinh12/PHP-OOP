<!DOCTYPE html>
<html>
@include('component.header')
<body>
    <div id="wrapper">
        @include('component.side-bar')
        <div id="page-wrapper" class="gray-bg">
            @include('component.profile-head')
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Danh sách Account</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Account</a>
                        </li>
                        <li class="active">
                            <strong>Danh sách</strong>
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
            <form action="<?= $_ENV['BASE_URL'] . 'admin/user' ?>" method="GET" class="mb-4 d-flex">
                <input type="text" name="user_name" value="{{ $keyword }}" class="form-control me-2" placeholder="Nhập tên user...">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </form>
            <div class="table-responsive">
                <p>
                    <a href="<?=$_ENV['BASE_URL'] . 'admin/user/add'?> "><button class="btn btn-primary">Thêm</button></a>
                </p>
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Hình ảnh</th>
                            <th>Email</th>
                            <th>Tuổi</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Ngày sinh</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($user) && count($user) > 0)
                            @foreach($user as $key)
                                <tr>
                                    <td>{{ $key['user_id'] }}</td>
                                    <td>{{ $key['user_name'] }}</td>
                                    <td>
                                        <img src="{{ $_ENV['BASE_URL'] . $key['user_img'] }}" alt="Ảnh sản phẩm" width="80" class="rounded">
                                    </td>
                                    <td>{{ $key['email'] }}</td>
                                    <td>{{ $key['age'] }}</td>
                                    <td>{{ $key['address'] }}</td>
                                    <td>{{ $key['phone'] }}</td>
                                    <td>{{ $key['birthday'] }}</td>
                                    <td>{{ $key['create_at'] }}</td>
                                    <td>{{ $key['update_at'] }}</td>
                                    <td>
                                        <a href="{{ $_ENV['BASE_URL'] . 'admin/user/update/' . $key['user_id'] }}" class="btn btn-warning btn-sm">Sửa</a>
                                        <a href="{{ $_ENV['BASE_URL'] . 'admin/user/delete/' . $key['user_id'] }}" 
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