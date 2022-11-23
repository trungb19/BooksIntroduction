<?php

namespace App\Controllers\Auth;
use App\Models\Account;
use App\Models\User;
use App\Controllers\Controller;


class LoginController extends Controller {

    //Hàm xử lý đăng nhập
    public function login() {
        if (isset($_POST['mail']) && isset($_POST['pwd'])) {
            $info = Account::where('UserEmail', $_POST['mail'])->first();
            if ($info) {
            $info_user = User::where('UserID', $info->UserID)->first();
            $has_pwd = $info->UserPass;
            echo ' <div style="color:red;text-align:center;><p">Incorrect password</p>
                <button><a style="text-decoration: none;" href="/">Home</a></button></div>';  
                if (password_verify($_POST['pwd'], $has_pwd)) {
                    $_SESSION['user'] = $info->UserID;
                    $_SESSION['permission'] = $info_user->Permission;
                    $_SESSION['email'] = $info->UserEmail;
                    $_SESSION['name'] = $info_user->UserName;
                    if($info_user->Permission == 'admin')
                    redirect("/admin");
                    else
                    redirect("/");
                }
            }
            else {
                echo ' <div style="color:red;text-align:center;><p">Account does not exist</p>
                <button><a style="text-decoration: none;" href="/">Home</a></button></div>';  
                //redirect("/");
            }
        }

    }

    //Hàm xử lý đăng xuất bằng cách kết thúc session
    public function logout() {
		if (isset($_SESSION['user'])){
			session_unset();
			session_destroy();
		}
		redirect('/');
	}
}


