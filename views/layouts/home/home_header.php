<!--
    Thành phần HEADER của trang web
    Chứa thanh điều hướng gồm các thông tin như đăng nhập, đăng xuất,...
    Chứa thanh tìm kiếm sách
-->
<div class="row header">
    <div class="col-1"></div>
    <div class="col-2">
        <a style="" href="/">Book Introduction</a>
    </div>
    <div class="col-8">
        <div class="row">
        <div class="col-7">
        <input type="text" id="search" class="span10 search-query" placeholder="Search" required="required"> <input type="button" value="Search" id="submit" class="btn btn-primary">
        </div>
        <div class="col-5 topbar">
            <?php if(isset($_SESSION['user'])&&($_SESSION['permission']=="admin")){ ?>
                <p><a style="" href="/profile"><?php echo $_SESSION['name']?></a></p>
                <p><a style="" href="/admin">Admin page</a></p>
                <p id="logout">Log out</p>
            <?php }else if(isset($_SESSION['user'])&&$_SESSION['permission']=="user")  { ?>
                <p><a style="" href="/profile"><?php echo $_SESSION['name']?></a></p>
                <p data-toggle="modal" data-target="#signUpModal">Log out</p>
            <?php }else { ?>
                <p data-toggle="modal" data-target="#myModal">Sign in</p>
                <p data-toggle="modal" data-target="#signUpModal">Sign up</p>
            <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-1"></div>
</div>

<script>
    // Nút đăng xuất
    $('#logout').on('click', function(){
        window.location.href = "/user/logout";
    })
</script>