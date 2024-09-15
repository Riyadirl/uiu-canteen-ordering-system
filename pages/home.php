<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            img{
                height: 100%;
                width: 100%;
                margin: 0px;
            }
            .col-3{
                margin-bottom: 10px;
            }
            td{
                text-align: left;
            }
        </style>
</head>

<body>
    <div class="container text-center">
        <div class="row">
            <?php for ($i = 0; $i < 5; $i++) {

                ?>
                <div class="col-3">
                    <form action="order.php" method="post">
                        <table class="table">
                            <tr>
                                <td colspan="2"><img src="image/food/3.jpg" alt="Food Image"></td>
                            </tr>
                            <tr>
                                <td>Name: </td>
                                <td>Burger</td>
                            </tr>
                            <!-- <tr>
                                <td>Des: </td>
                                <td style="text-align:justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio harum quis dolor perferendis omnis animi laborum tenetur officiis, sit id.</td>
                            </tr> -->
                            <tr>
                                <td>Price: </td>
                                <td>500 tk</td>
                            </tr>
                            <tr>
                                <td><input type="submit" value="Add to cart" class="btn btn-primary" name="cbtn"></td>
                                <td><input type="submit" value="Order Now" class="btn btn-primary" name="obtn"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            <?php
            } ?>
        </div>
    </div>
</body>

</html>