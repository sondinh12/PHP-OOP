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
                    <h2>Thêm mới danh mục</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Add Category</a>
                        </li>
                        <li class="active">
                            <strong>Thêm mới</strong>
                        </li>
                    </ol>
                </div>               
            </div>  
            <div class="category_add">
                <h2>Thêm danh mục</h2>
                @if (!empty($errors))
                    <div class="text-red-500">
                        @foreach ($errors as $field => $messages)
                            @foreach ($messages as $message)
                                <p>{{ $message }}</p>
                            @endforeach
                        @endforeach
                    </div>
                @endif
                <form action="<?=$_ENV['BASE_URL']?>admin/category/add" method="post" class="form-group">
                    <h3>Tên danh mục</h3>
                    <input type="text" name="cate_name" class="form-control" value="{{ isset($old['cate_name']) ??  '' }}">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
            @include('component.footer')
        </div>
    </div>
    

    @include('component.script');

</body>
</html>
