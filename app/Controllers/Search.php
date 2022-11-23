<?php

namespace App\Controllers;
use App\Models\Bookmark;

Class Search extends Controller {
    function addFavoriteBook() {
        // echo "Chạy tới add favorite nè";
        // $bookmark = new Bookmark;
        // $BookmarkID = $bookmark->getLastBmID() + 1;
        if (!isset($_SESSION['user'])) {
            echo '<script>alert("Vui lòng đăng nhập")</script>';
        } else {
            Bookmark::create([
                'BookmarkID' => $_POST['bookID'],
                'UserID' => $_SESSION['user'] ,
                'BookFavorite' => $_POST['booktitle']
            ]);
            echo "Hello";
        }
    }

    function deleteFavoriteBook() {
        Bookmark::where('BookmarkID', $_POST['BookmarkID'])->delete();
        $this->sendPage('layouts/default/default');
    }
}