<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title></title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 card p-0">
                <div class="card-header bg-success text-white">
                    Order has been placed
                </div>
                <div class="card-body">
                    <div class="row p-2">
                        <div class="col-4 text-secondary">Order id :</div>
                        <div class="col-8">{{ $order->id }}</div>
                    </div>
                    <div class="row p-2">
                        <div class="col-4 text-secondary">Order amount :</div>
                        <div class="col-8">{{ $order->amount }}</div>
                    </div>
                    <div class="row p-2">
                        <div class="col-4 text-secondary">Payment mode :</div>
                        <div class="col-8">{{ $order->payment_mode == 1 ? 'Online' : 'Cash on Delivery' }}</div>
                    </div>
                    <div class="row p-2">
                        <div class="col-4 text-secondary">Order Payment :</div>
                        <div class="col-8">{{ $order->payment_status == 1 ? "Paid" : "Unpaid" }}</div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
