// document.getElementById('submit').onclick = function() {
	document.getElementById('submit').onclick = function() {
		getData();
	};
	$("input").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			getData();
		}
	});
	
	$( window ).load(function() {
		getData();
		sortBook();
	});

	//if ajax url exist load results
	if (window.location.hash !== '') {
		var url = window.location.hash.substr(1);
		$('#search').val(decodeURIComponent(url));
		$.post('Controllers/api', {
			q: url,
			p: 1
		}, function(data) {
			$('#books-well').empty();
			$('#books-well').html(data);
			$('.loader').hide();
			$('#sort,.pagination').show();
			if (data.match("Error :")) {
				$('#sort,.pagination').hide();
			}
		});
	}
	
	function getData(page) {
		if (typeof(page) === 'undefined') page = 1;
		var searchVal = document.getElementById('search').value;
		$('.loader').css({
			"display": "block",
			"margin-bottom": "40px"
		});
		$.post('Controllers/api', {
			q: searchVal,
			p: page
		}, function(data) {
			$('#books-well').empty();
			$('#books-well').html(data);
			$('.loader').hide();
			$('#sort,.pagination').show();
			window.location.hash = searchVal;
			if (data.match("Error :")) {
				$('#sort,.pagination').hide();
			}
		});
	}
	
	
	//Sort Button Handler
	document.getElementById('sort').onclick = function() {
		$('.loader').css({
			"display": "block",
			"margin-bottom": "40px"
		});
		var page = $('.paginate li.active').attr('id');
		var searchVal = document.getElementById('search').value;
		$.post('Controllers/api', {
			q: searchVal,
			p: page,
			sort: true
		}, function(data) {
			$('#books-well').empty();
			$('#books-well').html(data);
			$('.loader,#sort').hide();
			$('.pagination').show();
		});
	};

	$(".pagination li").click(function() {
		var page = this.id;
		getData(page);
		$(".pagination li").removeClass("active");
		$(this).addClass("active");
	});


	google.load("books", "0");
	
	function initialize(isbn) {
		var viewer = new google.books.DefaultViewer(document.getElementById('previewBody'));
		viewer.load('ISBN:' + isbn, alertNotFound);
	}
	
	function alertNotFound() {
		$('#previewModal').modal('hide');
		alert("Book Preview Not Available!");
	}
	