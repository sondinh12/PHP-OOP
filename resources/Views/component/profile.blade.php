<div id="page-wrapper" class="gray-bg">
    @include('component.profile-head')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Trang chủ</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li class="active">
                    <strong>Trang chủ</strong>
                </li>
            </ol>
        </div>
    </div> 
    <div>
        @php
            if(isset($_SESSION['message_log'])){
                echo $_SESSION['message_log'];
                unset($_SESSION['message_log']);
            }
        @endphp
    </div> 
    @include('component.footer')
</div>