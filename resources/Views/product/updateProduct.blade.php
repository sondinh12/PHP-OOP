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
                    <h2>Sửa sản phẩm</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Update Product</a>
                        </li>
                        <li class="active">
                            <strong>Sửa</strong>
                        </li>
                    </ol>
                </div>               
            </div>  
            <div class="update_product">
                <h2>Sửa sản phẩm</h2>
                @if (!empty($errors))
                    <div class="text-red-500">
                        @foreach ($errors as $field => $messages)
                            @foreach ($messages as $message)
                                <p>{{ $message }}</p>
                            @endforeach
                        @endforeach
                    </div>
                @endif
                <form action="<?=$_ENV['BASE_URL'] . 'admin/product/update/' . $proOld['pro_id']?>" method="post" enctype="multipart/form-data" class="form-group">
                    <h3>Tên sản phẩm</h3>
                    <input type="text" name="pro_name" value="<?=$proOld['pro_name']?>" class="form-control">
                    @if($proOld['pro_img'] != null):
                    <h3>Ảnh</h3>
                    <input type="file" name="pro_img" class="form-control">
                    <img src="<?=$_ENV['BASE_URL'] . $proOld['pro_img']?>" alt="Ảnh sản phẩm" width="150">
                    @endif
                    <h3>Giá</h3>
                    <input type="text" name="price" value="<?=$proOld['price']?>" class="form-control">
                    <h3>Mô tả</h3>
                    <input type="text" name="description" value="<?=$proOld['description']?>" class="form-control">
                    <h3>Danh mục</h3>
                    <select name="cate_id" class="form-control">
                        <option value="">Chọn danh mục</option>
                        @foreach ($category as $key)
                            <option value="{{ $key['cate_id'] }}" 
                                {{ $key['cate_id'] == $proOld['cate_id'] ? 'selected' : '' }}>
                                {{ $key['cate_name'] }}
                            </option>
                        @endforeach     
                    </select>
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </form>
            </div>
            @include('component.footer')
        </div>
    </div>
    

    @include('component.script');

</body>
</html>

