<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>

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

</head>
<body>
<?php 
    use App\Models\Account;
    use App\Models\User;
    $id = $_GET['userID'];
    $Account = Account::where('AccountId', $id)->first();
    $User = User::where('UserID', $id)->first();
?>
<!--Form edit user: Bắt đầu-->
<div class="" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header text-center d-block">
                    <button type="button" name="button" class="close" data-dismiss="modal"
                        style="position: absolute; right: 10px;">&times;</button>
                    <h2 class="modal-title"> <i class="fa fa-pencil"></i>Edit user</h2>
                    <h3 style="font-family: monospace;">Book Introduction</h3>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class="" method="POST" action="/admin/saveEditForm">
                        <div class="form-group"> 
                        <input id="id" type="hidden" name="id" value="<?=e($id)?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Name:</label>
                            <input id="name" type="text" name="name" value="<?=e($User->UserName)?>" class="form-control"
                                placeholder="Enter name:...">
                        </div>
                        <div class="form-group">
                            <label for="">Email:</label>
                            <input id="email" type="email" name="mail" value="<?=e($Account->UserEmail)?>" class="form-control"
                                placeholder="Enter email:...">
                        </div>

                        <div class="form-group">
                            <label for="">Password:</label>
                            <input id="pass" type="password" name="pwd" value="" class="form-control"
                                placeholder="If you don't want to change, please leave it blank.">
                        </div>  
                        <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Permission</legend>
                        <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="permission" id="gridRadios1" value="user" checked>
                            <label class="form-check-label" for="gridRadios1">
                            User
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="permission" id="gridRadios2" value="admin">
                            <label class="form-check-label" for="gridRadios2">
                            Admin
                        </div>
                        </div>
                    </fieldset>
                        <div class="form-group">
                            <button type="submit" id="login" name="button" class="btn btn-primary btn-block">Update
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger btn-block" href="/admin">
                        <i class="fa fa-times"> Cancel</i>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<!--Form edit user: Kết thúc-->
</body></html>