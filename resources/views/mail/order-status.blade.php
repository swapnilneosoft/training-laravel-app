<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <h1>Order Status changed !</h1>
    order id : {{$order->id}} <br>
    <address>
        address : {{$order->getAddress->address}}
    </address>
    <br>
    <p>
        amount : <b>{{$order->amount}}</b>
    </p>
    <p>
        status : <b>{{$order->status == 0 ? 'Processing' : ($order->status == 1 ? 'Dispatched' : 'Delivered')}}</b>
    </p>
</body>
</html>
