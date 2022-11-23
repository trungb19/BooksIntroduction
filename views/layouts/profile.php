<?php $this->layout("layouts/default/default", ["title" => APPNAME]) ?>

<?php $this->start("page"); ?>
<?php 
  use App\Models\User;
  $dt = User::where('UserID', $_SESSION['user'])->first();
?>