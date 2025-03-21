<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link href="<?=$_ENV['BASE_URL']?>resources/Views/backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$_ENV['BASE_URL']?>resources/Views/backend/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?=$_ENV['BASE_URL']?>resources/Views/backend/css/animate.css" rel="stylesheet">
    <link href="<?=$_ENV['BASE_URL']?>resources/Views/backend/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Welcome to IN+</h2>

                <p>
                    Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                </p>

                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                </p>

                <p>
                    When an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>

                <p>
                    <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    @if (!empty($errors))
                        <div class="text-red-500">
                            @foreach ($errors as $field => $messages)
                                @foreach ($messages as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            @endforeach
                        </div>
                    @endif

                    @php
                if(isset($_SESSION['error'])){
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                if(isset($_SESSION['message_log'])){
                    echo $_SESSION['message_log'];
                    unset($_SESSION['message_log']);
                }
            @endphp
                    <form class="m-t" role="form" action="<?=$_ENV['BASE_URL'] . 'login'?>" method="post">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ isset($old['email']) ? $old['email'] : '' }}">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" value="">
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                    </form>
                    <p class="m-t">
                        <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright Example Company
            </div>
            <div class="col-md-6 text-right">
               <small>© 2014-2015</small>
            </div>
        </div>
    </div>

</body>

</html>
