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
                    <h2>Sửa người dùng</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Update User</a>
                        </li>
                        <li class="active">
                            <strong>Sửa</strong>
                        </li>
                    </ol>
                </div>               
            </div>  
            <div class="update_user">
                <h2>Sửa người dùng</h2>
                @if (!empty($errors))
                    <div class="text-red-500">
                        @foreach ($errors as $field => $messages)
                            @foreach ($messages as $message)
                                <p>{{ $message }}</p>
                            @endforeach
                        @endforeach
                    </div>
                @endif
                <form action="<?=$_ENV['BASE_URL'] . 'admin/user/update/' . $userOld['user_id']?>" method="post" enctype="multipart/form-data" class="form-group">
                    <h3>Ten</h3>
                    <input type="text" name="user_name" value="<?=$userOld['user_name']?>" class="form-control">
                    <h3>Tuổi</h3>
                    <input type="text" name="age" value="<?=$userOld['age']?>" class="form-control">
                    <h3>Địa chỉ</h3>
                    <input type="text" name="address" value="<?=$userOld['address']?>" class="form-control">
                    @if($userOld['user_img'] != null):
                    <h3>Ảnh</h3>
                    <input type="file" name="user_img">
                    <img src="<?=$_ENV['BASE_URL'] . $userOld['user_img']?>" alt="Ảnh sản phẩm" width="150">
                    @endif
                    <h3>Số điện thoại</h3>
                    <input type="text" name="phone" value="<?=$userOld['phone']?>" class="form-control">
                    <h3>Ngày sinh</h3>
                    <input type="date" name="birthday" value="<?=$userOld['birthday']?>" class="form-control">
                    <h3>Email</h3>
                    <input type="text" name="email" value="<?=$userOld['email']?>" class="form-control">
                    <h3>Password</h3>
                    <input type="text" name="password" value="<?=$userOld['password']?>" class="form-control">                   
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </form>
            </div>
            @include('component.footer')
        </div>
    </div>
    

    @include('component.script');

</body>
</html>
