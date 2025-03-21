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
                    <h2>Thêm mới người dùng</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Add User</a>
                        </li>
                        <li class="active">
                            <strong>Thêm mới</strong>
                        </li>
                    </ol>
                </div>               
            </div>  
            <div class="add_user">
                <h2>Thêm mới người dùng</h2>
                @if (!empty($errors))
                    <div class="text-red-500">
                        @foreach ($errors as $field => $messages)
                            @foreach ($messages as $message)
                                <p>{{ $message }}</p>
                            @endforeach
                        @endforeach
                    </div>
                @endif
                <form action="<?=$_ENV['BASE_URL'] . 'admin/user/add'?>" method="post" enctype="multipart/form-data" class="form-group">
                    <h3>Tên người</h3>
                    <input type="text" name="user_name" value="{{ isset($old['user_name']) ??  '' }}" class="form-control"> 
                    <h3>Tuổi</h3>
                    <input type="text" name="age" class="form-control" value="{{ isset($old['age']) ??  '' }}">
                    <h3>Địa chỉ</h3>
                    <input type="text" name="address" class="form-control" value="{{ isset($old['address']) ??  '' }}">
                   <h3>Ảnh</h3>
                    <input type="file" name="user_img" class="form-control" value="{{ isset($old['user_img']) ??  '' }}">
                    <h3>Số điện thoại</h3>
                    <input type="text" name="phone" class="form-control" value="{{ isset($old['phone']) ??  '' }}">
                    <h3>Ngày sinh</h3>
                    <input type="date" name="birthday" class="form-control" value="{{ isset($old['birthday']) ??  '' }}">
                    <h3>Email</h3>
                    <input type="text" name="email" class="form-control" value="{{ isset($old['email']) ??  '' }}">
                    <h3>Password</h3>
                    <input type="text" name="password" class="form-control" value="{{ isset($old['password']) ??  '' }}">                   
                    <button type="submit">Thêm</button>
                </form>
            </div>
            @include('component.footer')
        </div>
    </div>
    

    @include('component.script');

</body>
</html>
