<!DOCTYPE HTML>

<html>
	<head>
		<title><?= $blog['glava'] ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../config/assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@100;300;400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Miss+Lavanda&display=swap">
	</head>
	<body class="single">


	
<?php require_once 'databases.php'; 
$blog_id = $_GET['id']; 
$query = "SELECT * FROM `tbl_ckeditor` WHERE `id` = '$blog_id'"; 
$blog = mysqli_query($induction, $query); 
$blog = mysqli_fetch_assoc($blog); ?>




				<!-- Main -->
					<div id="main">

						<!-- Post -->
							<article class="post">
								<header>
									<div class="title">
										<h2><a href="#"></a></h2>
										<p><?= $blog['glava'] ?></p>
									</div>
									<div class="meta">
										<time class="published" datetime="2015-11-01"><?= $blog['created_at'] ?></time>
										<a href="#" class="author"><span class="name"></span><img src="upload/cheb3.jpg" alt="" /></a>
									</div>
								</header>
								<br>
								<p><?= $blog['content'] ?></p>
					</div>

				<!-- Footer -->
				<section class="footer">
					<div class="share">
						<a href="https://vk.com/cheburek_sevas" class="fa-brands fa-vk"></a>
						<a href="https://instagram.com/_bezuprechnaya_cheburechnay_?igshid=NTc4MTIwNjQ2YQ=="
							class="fa-brands fa-instagram""></a>
						<a href=" https://ok.ru/group/70000002619640" class="fa-brands fa-odnoklassniki"></a>
						<a href="https://t.me/bezuprechnaya_cheburechnay" class="fa-brands fa-telegram"></a>
					</div>
				</section>


		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>