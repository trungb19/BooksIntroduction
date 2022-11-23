<?php

$title="BooksIntroduction"; 
$api_key="AIzaSyD5zWqLZDwy3TGcq6nlcH038aQ6sSGqH4w";

class Request {	
	//Đường dẫn api books của Google
	private $url = 'https://www.googleapis.com/books/v1/volumes?q=';

	//Truy vấn lấy các trường thông tin
	private $query = '&fields=totalItems,items(id,saleInfo/retailPrice,volumeInfo/title,volumeInfo/publishedDate,volumeInfo/subtitle,volumeInfo/industryIdentifiers,volumeInfo/authors,volumeInfo/description,volumeInfo/imageLinks,volumeInfo/pageCount)';

	//Sắp xếp sách theo thứ tự mới nhất
	private $sort='&orderBy=newest'; 
	
	//Phân trang sách
	private $page='&startIndex=';


	/*
	Hàm lấy dữ liệu từ Api nhận vào dữ liệu gồm các tham số:
	$query: một số trường dữ liệu, $page, $api_key lấy từ google, $sort
	*/
	function GetData($query,$page=true,$api_key='AIzaSyD5zWqLZDwy3TGcq6nlcH038aQ6sSGqH4w',$sort=true) {
		
			//Trường truy vấn rỗng => yêu cầu người dùng nhập gì đó
			if($query=='') {
				$query = 'Blockchain';
			}


		//Người dùng yêu cầu sắp xếp theo thứ tự sách mới nhất
		if($sort==true) {	$page===false ? $page=1 : $page=$page;
			$url = $this->url . urlencode($query) . '&key=' . $api_key . '&alt=json' . $this->query.$this->page.$page.$this->sort;
		} elseif($page==true) {
			$url = $this->url . urlencode($query) . '&key=' . $api_key . '&alt=json' . $this->query.$this->page.$page;
		} else {
			$url = $this->url . urlencode($query) . '&key=' . $api_key . '&alt=json' . $this->query;
		} 
		$data = @file_get_contents($url);
		$data === FALSE ? die("<h3>Connection Error! </h3></center>") : $data=json_decode($data);


	//Nếu dữ liệu không tồn tại thông báo không tìm được
		if(false) {
				die("No Results Found!");
		}

		foreach($data->items as $item) {

				$booktitle = (isset($item->volumeInfo->title) ? $item->volumeInfo->title : false);

				if(!empty($item->volumeInfo->description)) {
					$description =implode(' ', array_slice(explode(' ', $item->volumeInfo->description), 0, 130)).'... ';
				}else {
					$description="Description Not Available";
				}
				if(!empty($item->volumeInfo->authors)) {
				$authors = $item->volumeInfo->authors[0];
				$authors=htmlspecialchars($authors,ENT_QUOTES, 'UTF-8');
				}else {
					$authors=false;
				}
				$id=(isset($item->id) ? $item->id : false);
				$image = (isset($item->volumeInfo->imageLinks->thumbnail) ? $item->volumeInfo->imageLinks->thumbnail : false);
				$isbnNum = (isset( $item->volumeInfo->industryIdentifiers) ?  $item->volumeInfo->industryIdentifiers : false);
				$publish_date = (isset($item->volumeInfo->publishedDate) ? $item->volumeInfo->publishedDate : false);
				$pages = (isset( $item->volumeInfo->pageCount) ?  $item->volumeInfo->pageCount : false);
				$isbnVal = false;
				$isbn10 = false;

				if (is_array($isbnNum) || is_object($isbnNum))
				foreach($isbnNum as $isbn) {
					if ($isbn->type == 'ISBN_13') {
						$isbnVal= (isset($isbn->identifier) ? $isbn->identifier : false);

					}else if ($isbn->type == 'ISBN_10') {
						$isbn10= (isset($isbn->identifier) ? $isbn->identifier : false);
					}else {
						$isbnVal=false;
						$isbn10=false;
					}
				}

				$isbnVal=htmlspecialchars($isbnVal, ENT_QUOTES, 'UTF-8');
				$publish_date=htmlspecialchars($publish_date, ENT_QUOTES, 'UTF-8');
				$pages=htmlspecialchars($pages, ENT_QUOTES, 'UTF-8');
				$booktitle=htmlspecialchars($booktitle, ENT_QUOTES, 'UTF-8');
				$description=htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
				$id=htmlspecialchars($id, ENT_QUOTES, 'UTF-8');

				echo '<div class="books well">
						<div class="row">
							<div class="col-2 margin"></div>
							<div class="col-3">
								<img src="' . $image . '" />
								<button style="border: none;" onclick="
								$.ajax ({
									url: \'user/favoriteBook\',
									type: \'post\',
									data: { bookID:\''.$id.'\' ,
											booktitle: \''.$booktitle.'\'},
									success:function(data){
										alert(\'Added to favorites!\');
									}
								  })">
								<div id="demo" class="btn btn-success">Like</div></button>
								<a href="https://www.google.com/search?q='.$booktitle.'" target="_blank" class="btn btn-success">Preview</a>
									<ul id="info">
									<li>Author : '.$authors.'</li></br>
									<li>Release Date: '.$publish_date.'</li></br>
									<li>ISBN : '.$isbnVal.'</li></br>
									<li>ISBN-10 : '.$isbn10.'</li></br>
									<li>Book Pages: '.$pages.'</li></br>
									<li>ID: '.$id.'</li></br>
									</ul>
							</div>
							<div class="col-5">
							<h3><p id="booktitle">' . $booktitle . '</p> </h3>
							<h3> ' . $authors . '</h3>
								<p>' . $description . '</p>
							</div>
							<div class="col-2 margin"></div>
						</div>
					</div>';

		}

	}
}


if(isset($_POST['q'])) {
	if($_POST['p']==''||$_POST['p']==1) {
		$_POST['p']=false;
	}

	if(!isset($_POST['sort'])) {
		$_POST['sort']=false;
	}
	$object = new Request;
	$object->GetData($_POST['q'],$_POST['p'],$api_key,$_POST['sort']);

}


