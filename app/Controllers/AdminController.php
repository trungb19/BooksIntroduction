<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Account;
use App\Models\Bookmark;
use App\Controllers\Auth\RegisterController;


class AdminController extends Controller {
       public function index() {
              if (!isset($_SESSION['permission'])) {
                     $this->sendPage('errors/404');
              }
              else if ($_SESSION['permission']=='admin') {
                     $this->sendPage('layouts/default/adminpage');	
              } else {
                     $this->sendPage('errors/404');
              }
		
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
                     echo ' <div style="color:green;text-align:center;><p">Added user successfully</p>
                            <button><a style="text-decoration: none;" href="/admin">Back</a></button></div>';       
              // redirect('/admin'); }
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
              Bookmark::where('UserID', $data_ID)->delete();
              Account::where('AccountId', $data_ID)->delete();
              User::where('UserID', $data_ID)->delete();
              echo ' <div style="color:green;text-align:center;><p">Delete user successfully</p>
                            <button><a style="text-decoration: none;" href="/admin">Back</a></button></div>';  
              }
              }

       //Hàm show user cần edit
              public function showEditPage(){
                     $this->sendPage('layouts/default/edit', );	
                     
              }
       //hàm update user
               public function updateUser(){
                     $data = array();
                     $data['UserName'] = $_POST['name'];
                     $data['UserEmail'] = $_POST['mail'];
                     $data['Permission'] = $_POST['permission'];
                     // kiểm tra mật khẩu có thay đổi không
                     if($_POST['pwd']!='')
                     $data['UserPass']=password_hash($_POST['pwd'], PASSWORD_DEFAULT);
                     else
                     {$rs=Account::where('AccountId',$_POST['id'])->first();
                      $data['UserPass']=$rs->UserPass;    
                     }
                     //update
                     Account::where('AccountId',$_POST['id'])->update([
                            'UserEmail'=>$data['UserEmail'],
                            'UserPass'=>$data['UserPass'],
                     ]);
                     User::where('UserID',$_POST['id'])->update([
                            'UserName'=>$data['UserName'],
                            'Permission'=>$data['Permission'],
                     ]);
                     echo ' <div style="color:green;text-align:center;><p">User update successful</p>
                            <button><a style="text-decoration: none;" href="/admin">Back</a></button></div>';   

              }
}