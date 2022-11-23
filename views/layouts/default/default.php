<!--Đăng nhập thành công chuyển hướng đến đây--->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap css & js -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./CSS/home.css">
    <link rel="stylesheet" href="./css/content.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/profile.css" rel="stylesheet">

</head>

<body>
    <!-- <h1>Đây là trang Profile</h1> -->
    <?php 
    require '../vendor/autoload.php';
    ?>
    <!--Header: Bắt đầu-->
    <?php include('home_header.php') ?>
    <!--Header: Kết thúc-->

    <!--Body: Bắt đầu-->
    <div class="row">
        <div class="col-1">

        </div>
        <div class="col-3">
            <a href="" style="color: inherit;">
                <h4>General</h4>
            </a>
            <a href="" style="color: inherit;">
                <h4>Edit Password</h4>
            </a>
        </div>
        <div class="col-7">
            <!--Phần hiển thị thông tin cá nhân-->
            <div class="row">
                <div class="col-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1oyt9166XWnxUIF4AgPIJSA2AfNh1ebiRig&usqp=CAU"
                        alt="">
                </div>
                <div class="col-5">
                    <div class="row">
                        <div class="col-3">Name: </div>
                        <div class="col-9"><?php echo($_SESSION['name'])?></div>
                    </div>
                    <div class="row">
                        <div class="col-3">Email: </div>
                        <div class="col-9"><?php echo($_SESSION['email'])?></div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>

            <!--Phần hiển thị sách yêu thích-->
            <div class="example">
                <div class="container">
                    <div class="row">
                        <h2>Table Striped</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>ID</th>
                                    <th>Tên sách</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                use App\Models\Bookmark;
                                $books = Bookmark::where('UserID', $_SESSION['user'])->get();
                                $i = 1;
                                    foreach ($books as $book) {
                                        echo "<tr>";
                                        echo "<td> " . $i . " </td>";
                                        echo "<td> " . $book["BookmarkID"] . " </td>";
                                        echo "<td> " . $book["BookFavorite"] . " </td>";
                                        echo "<td> 
                                        <form class=\"delete\" action=\"/deleteFavoriteBook\" method=\"POST\" style=\"display: inline;\">
                                        <input name=\"BookmarkID\" type=\"hidden\" value=\"{$book["BookmarkID"]}\">
                                        <button type=\"submit\" class=\"btn btn-xs btn-danger\" name=\"delete-user\">
                                             <i alt=\"Delete\" class=\"fa fa-trash\"> Delete</i>
                                        </button> </td>";
                                        echo "</tr>";
                                        $i = $i + 1;
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-1">

        </div>
    </div>
    <!--Body: Kết thúc-->
</body>

</html>