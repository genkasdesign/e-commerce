<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de commande</title>
</head>
<body>
    <h1>Merci pour votre commande #{{ $order->id }}</h1>
    <p>Bonjour {{ $order->user->name }},</p>
    <p>Votre commande a bien été enregistrée.</p>
    <p><strong>Total :</strong> {{ number_format($order->total, 2) }} $</p>
    <p><strong>Statut :</strong> {{ __('status.' . $order->status) }}</p>
    <p>Vous pouvez suivre votre commande sur votre espace client.</p>
    <p>À bientôt,<br>L'équipe GenShop</p>
</body>
</html>