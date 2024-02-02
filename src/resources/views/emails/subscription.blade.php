<!DOCTYPE html>
<html>
<head>
    <title>Invoice Email</title>
</head>
<body>
    # Product Subscription Notification

    Thank you for subscribing to updates on the product!

    **Product Details:**
    - Product Link: [{{ $product->product_link }}]({{ $product->product_link }})
    - Initial Price: ${{ $product->initial_price }}

    Stay tuned for further updates!

    Thanks,<br>
    {{ config('app.name') }}
</body>
</html>
