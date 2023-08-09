<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Uredi Izdelek</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline w-50 m-auto mb-4">
                <label for="productTitle" class="form-label">Ime Izdelka</label>
                <input type="text" id="productTitle" name="productTitle" class="form-control" required="required">
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="productPrice" class="form-label">Cena Izdelka</label>
                <input type="text" id="productPrice" name="productPrice" class="form-control" required="required">
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="productPer" class="form-label">Znižanja Izdelka</label>
                <input type="text" id="productPer" name="productPer" class="form-control" required="required">
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="productCat" class="form-label">Kategorija Izdelka</label>
                <input type="text" id="productCat" name="productCat" class="form-control" required="required">
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="productDesc" class="form-label">Opis Izdelka</label>
                <input type="text" id="productDesc" name="productDesc" class="form-control" required="required">
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="productPic" class="form-label">Slika Izdelka</label>
                <input type="text" id="productPic" name="productPic" class="form-control" required="required">
            </div>
        </form>
    </div>
</body>
</html>