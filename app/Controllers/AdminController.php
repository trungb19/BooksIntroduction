<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Account;
use App\Controllers\Auth\RegisterController;

class AdminController extends Controller {
       public function index() {
		$this->sendPage('layouts/default/adminpage');	
       }
       //hàm add user
              public function addUser(){
              // tính userid và accountid;
              $user = new User;
              $account = new Account;
              $rs = new RegisterController;
              $UserID = $user->getLastUserID()+1;
              $AccountId = $account->getLastAccountID() + 1;
              
              // lưu thông tin người dùng nhập ở form -> lưu vào mảng data;
              $data = array();
              $data['UserID'] = $UserID;
              $data['UserName'] = $_POST['name'];
              $data['UserPass'] = password_hash($_POST['pwd'], PASSWORD_DEFAULT); //sử dụng hàm băm để bảo mật mật khẩu.
              $data['UserEmail'] = $_POST['mail'];
              $data['AccountID'] = $AccountId;
              $data['Permission'] = $_POST['permission'];
              $rs->createUser($data);
                     if ($user->getLastUserID() == $UserID){ //kiểm tra lưu thành công chưa.
                            
              
                            redirect('/admin');
                            }
              }
       //hàm delete user
              public function deleteUser($AccountId)
              {
              $data_ID = $AccountId;
              $Account = Account::where('AccountId', $data_ID)->first();
              if (! $Account) {
              echo'Lỗi AccountID';
              }
              else{
              Account::where('AccountId', $data_ID)->delete();
              User::where('UserID', $data_ID)->delete();
              echo "<script>alert('delete successfully');</script>";
              // redirect('/admin');
              }
              }
       //hàm update user
               public function updateUser($AccountId){
                     $data_ID = $AccountId;
                     $Account = Account::where('AccountId', $data_ID)->first();
                     echo $Account;
              }
}