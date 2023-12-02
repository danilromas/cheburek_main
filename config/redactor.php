<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CKEditor 5 – Classic editor</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
</head>
<body>
<style>
            #container {
                width: 1000px;
                margin: 20px auto;
            }
            .ck-editor__editable[role="textbox"] {
                /* editing area */
                min-height: 200px;
            }
            .error{
                color: red;
            }
        </style>
    <h1>Classic editor</h1>
    <?php
include('databases.php');

if (isset($_POST['submit'])) {
    // Обработка изображения
    $targetDir = "../config/upload/";
    $targetFile = $targetDir . basename($_FILES["itemImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Перемещение загруженного файла в нужную директорию
    if (move_uploaded_file($_FILES["itemImage"]["tmp_name"], $targetFile)) {
        // Получение данных из других полей формы
        $itemName = $_POST['itemName'];
        $itemPrice = $_POST['itemPrice'];
        $content = $_POST['content'];
        $imageUrl = $targetFile;

        // SQL-запрос
        $insert_query = mysqli_query($induction, "INSERT INTO tbl_ckeditor (glava, kratko, content, image_url) VALUES ('$itemName', '$itemPrice', '$content', '$imageUrl')");

        if ($insert_query) {
            $msg = "Данные вставлены успешно.";
        } else {
            $msg = 'Ошибка: ' . mysqli_error($induction);
        }
    } else {
        $msg = "Ошибка при перемещении файла в директорию upload.";
    }
}
?>
<div class="container"> 
    
    <h3 align="center">CKEditor</h3> 
    <br> 
    <div class="box"> 
    <form method="post" enctype="multipart/form-data">
    <!-- ... остальные поля ... -->
    <input type="file" id="itemImageInput" name="itemImage" accept="upload/*">
    <input type="hidden" id="imageUrl" name="imageUrl">
    <img id="itemImage" src="" alt="">
    <p>НОВОЕ ИЗОБРАЖЕНИЕ В СПИСКЕ ТОВАРОВ ПОЯВИТСЯ ТОЛЬКО ПОСЛЕ ПЕРЕЗАГРУЗКИ СТРАНИЦЫ</p>
    <!-- ... остальные поля ... -->
                <div class="input-container">
                    <label for="itemName">Название Статьи</label>
                    <input type="text" id="itemName" name="itemName" required>
                </div>
                <div class="input-container">
                    <label for="itemPrice">Краткий текст</label>
                    <input type="text" id="itemPrice" name="itemPrice" required>
                </div>
                <div id="categoryError" class="error-message"></div>
            <div class="form-group"> 
                <textarea id="content" name="content" class="form-control"></textarea> 
            </div> 
            <div class="form-group"> 
                <input type="submit" name="submit" value="Save" class="btn btn-primary"> 
            </div> 
        </form>
        <div class = 'error'><?php if(!empty($msg)){ echo $msg; } ?></div>
    </div> 
</div>
</body>
</html> 
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script> 
<script> 
ClassicEditor.create(document.querySelector('#content'), {
 ckfinder: {
    uploadUrl: 'fileupload.php'
 }
})
 .then(editor => {
    console.log(editor);
 })
 .catch(error => {
    console.error(error);
 });
</script>
