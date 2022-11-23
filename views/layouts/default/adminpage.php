<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

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
<section class="pt-5 pb-5 bg-dark inner-header">
<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<h1 class="mt-0 mb-3 text-white">Account Management</h1>
			<div class="breadcrumbs">
				<p class="mb-0 text-white"><a class="text-white" href="/">Home</a>  /  <span class="text-success">Users</span></p>
			</div>
		</div>
	</div>
</div>
</section>   
<div class="container">
    <section id="inner" class="inner-section section">
            <!-- SECTION HEADING -->
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <p class="wow fadeIn" data-wow-duration="2s">View your all Users here.</p>
                </div>
            </div>

            <div class="inner-wrapper row">
                <div class="col-md-12 offset-2">
                
                    <!-- FLASH MESSAGES HERE -->
                    <a data-toggle="modal" data-target="#addModal" class="btn btn-info" style="margin-bottom: 20px;">
                        <i class="fa fa-plus"></i> New User</a>
                    
                    <!-- Table Starts Here -->
                    <table id="table_user" class="table table-dark table-striped table-bordered table-responsive w-75">
                        <thead>
                            <tr>
                                <th>Account ID</th>
                                <th>User ID</th>
                                <th>User Email</th>
                                <th>User Name</th>
                                <th>Permission</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                    use App\Models\Account;
                    $AccountID_User = Account::leftJoin('user', 'account.UserID', '=', 'user.UserID')->get();
                    foreach ($AccountID_User as $account): ?>
                    <tr>
                    <td><?=$this->e($account->AccountId)?></td>
                    <td><?=$this->e($account->UserID)?></td>
                    <td><?=$this->e($account->UserEmail)?></td>
                    <td><?=$this->e($account->UserName)?></td>
                    <td><?=$this->e($account->Permission)?></td>
                    <td>
                    <form action="/admin/edit/<?=$account->AccountId?>" method="GET" style="display: inline;" >
                    <input type="hidden" name="userID" value="<?=$this->e($account->AccountId)?>">
                    <button type="submit" class="btn btn-xs btn-warning"><i alt="Edit" class="fa fa-pencil"> Edit</i>
                    </button></form>
                    <form class="delete" action="/admin/delete/<?=$account->AccountId?>" method="POST" style="display: inline;">
                        <button type="submit" class="btn btn-xs btn-danger" name="delete-user">
                             <i alt="Delete" class="fa fa-trash"> Delete</i>
                        </button>
                    </form>
                    </td>
                    </tr>
                    <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
</div>

<!-- modal confirm delete -->
<div id="delete-confirm" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body1">Do you want to delete this user?</div>
                <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Delete</button>
                        <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
                </div>
            </div>
        </div>
</div>



<!--Form add user: Bắt đầu-->
<div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header text-center d-block">
                    <button type="button" name="button" class="close" data-dismiss="modal"
                        style="position: absolute; right: 10px;">&times;</button>
                    <h2 class="modal-title"> <i class="fa fa-plus"></i> Add user</h2>
                    <h3 style="font-family: monospace;">Book Introduction</h3>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class="" method="POST" action="/admin/adduser">
                        <div class="form-group">
                            <p>

                            </p>
                        </div>
                        <div class="form-group">
                            <label for="">Name:</label>
                            <input id="name" type="text" name="name" value="" class="form-control"
                                placeholder="Enter name:..." required>
                        </div>
                        <div class="form-group">
                            <label for="">Email:</label>
                            <input id="email" type="email" name="mail" value="" class="form-control"
                                placeholder="Enter email:..." required>
                        </div>

                        <div class="form-group">
                            <label for="">Password:</label>
                            <input id="pass" type="password" name="pwd" value="" class="form-control"
                                placeholder="Enter password:..." required>
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
                            <button type="submit" id="login" name="button" class="btn btn-primary btn-block">Add
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-block" data-dismiss="modal">
                        <i class="fa fa-times"> Cancel</i>
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<!--Form add user: Kết thúc-->
</body>
<script>
    $(document).ready(function(){
    $('button[name="delete-user"]').on('click', function(e){
    e.preventDefault();
    const form = $(this).closest('form');
    const nameTd = $(this).closest('tr').find('td:first');
    if (nameTd.length > 0) {
    $('.modal-body1').html(`Do you want to delete
    "${nameTd.text()}"?`);
    }
    $('#delete-confirm').modal({
    backdrop: 'static',
    keyboard: false})
    .one('click', '#delete', function() {
    form.trigger('submit');
        });
    });
});
</script>
</html>