<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />
   
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Showroom Cars</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">List Cars</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
            <form enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
            </div>
            <div class="form-group mb-3">
                <label for="exampleInputEmail1" class="form-label">Brand</label>
                <select class="form-select" aria-label="Default select example" id="brand_id" name="brand_id">
                    <option selected>Open this select menu</option>
                    <option value="1">Toyota</option>
                    <option value="2">Honda</option>
                    <option value="3">Mitsubishi</option>
                    <option value="4">Suzuki</option>
                    <option value="5">Nissan</option>
                    <option value="6">Daihatsu</option>
                    <option value="7">Isuzu</option>
                    <option value="8">Mazda</option>
                    <option value="9">Subaru</option>
                    <option value="10">Kia</option>
                    <option value="11">Hyundai</option>
                    <option value="12">BMW</option>
                    <option value="13">Mercedes-Benz</option>
                    <option value="14">Audi</option>
                    <option value="15">Volkswagen</option>
                    <option value="16">Lexus</option>
                    <option value="17">Infiniti</option>
                    <option value="18">Volvo</option>
                    <option value="19">Mitsubishi Fuso</option>
                    <option value="20">Hino</option>
                    <option value="21">Daihatsu Bus</option>
                    <option value="22">Isuzu Bus</option>
                    <option value="23">Suzuki Bus</option>
                    <option value="24">Toyota Bus</option>
                    <option value="25">Hino Bus</option>
                    <option value="26">Mitsubishi Bus</option>
                    <option value="27">Nissan Bus</option>
                    <option value="28">Ford</option>
                    <option value="29">Chevrolet</option>
                    <option value="30">Chrysler</option>
                    <option value="31">Dodge</option>
                    <option value="32">Jeep</option>
                    <option value="33">Cadillac</option>
                    <option value="34">Lincoln</option>
                    <option value="35">Porsche</option>
                    <option value="36">Ferrari</option>
                    <option value="37">Lamborghini</option>
                    <option value="38">Maserati</option>
                    <option value="39">Alfa Romeo</option>
                </select>
               
            </div>
            <div class="form-group mb-3">
                <label for="exampleInputEmail1" class="form-label">Year</label>
                <input type="text" class="form-control" id="year" name="year" aria-describedby="emailHelp">
            </div>
            <div class="form-group mb-3">
                <label for="exampleInputEmail1" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" aria-describedby="emailHelp">
            </div>
            <div class="form-group mb-3">
                <label for="exampleInputEmail1" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image"> 
            </div>
            <div class="form-group mb-3">
                <label for="exampleInputEmail1" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" aria-describedby="emailHelp">
            </div>

            <button type="submit" class="btn btn-primary" id="btn-add">Add</button>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="script-car.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   
    <script>
        $('#btn-add').click(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
      
        url: 'http://127.0.0.1:8000/api/car',
        type: 'POST',
        dataType: 'json',
        data: {
            'name': $('#name').val(),
            'brand_id': $('#brand_id').find(":selected").val(),
            'year': $('#year').val(),
            'description': $('#description').val(),
            'image': $('#image').val().replace(/C:\\fakepath\\/i, ''),
            'price': $('#price').val(),
        },
        success: function(result) {
            console.log("masuk");
            console.log(result);
            // window.location.href = "http://127.0.0.1:8000/";
        },
        error: function(result) {
            console.log(result);
        }
    })
    
}
);
   </script>
</body>

</html>