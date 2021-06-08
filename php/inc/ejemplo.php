<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>ORDENAR COLUMNAS CON BOOTSTRAP 4.5</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row text-center text-white">
            <div class="d-none d-xs-block">
            <div class="col-sm-12 bg-primary order-1 order-sm-0">
                <h1 class="display-1">1</h1>
                <p>Menu principal</p>
            </div>
            <div class="col-sm-4 bg-warning order-0 order-sm-1">
                <h1 class="display-1">2</h1>
                <p>Menu Secundario</p>
                <ul>
                    <li>menu</li>
                    <li>menu</li>
                    <li>menu</li>
                    <li>menu</li>
                </ul>
            </div>
            <div class="col-sm-8 bg-success order-2 order-sm-2">
                <h1 class="display-1">3</h1>
                <p>Contenido</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa ipsam corrupti aliquam, similique ratione aperiam sequi expedita fugit laboriosam excepturi, vitae magni molestiae laborum unde veritatis illo cum ab tenetur.</p>
            </div>
            <div class="col-sm-12 bg-dark order-3">
                <h1 class="display-1">4</h1>
                <p>Pie de página</p>
            </div>
        </div>
        </div>
    </div>
    
</body>
</html>