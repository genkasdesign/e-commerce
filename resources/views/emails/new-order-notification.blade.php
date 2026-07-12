<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle commande</title>
</head>
<body>
    <h1>Nouvelle commande #{{ $order->id }}</h1>
    <p>Un client vient de passer une commande.</p>
    <p><strong>Total :</strong> {{ number_format($order->total, 2) }} $</p>
    <p><strong>Client :</strong> {{ $order->user->email }}</p>
    <p><a href="{{ url('/admin/orders') }}">Voir la commande</a></p>
</body>
</html>