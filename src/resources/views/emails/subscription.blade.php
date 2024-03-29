<!DOCTYPE html>
<html>
<head>
    <title>Invoice Email</title>
</head>
<body>
    <h2>Product Subscription Notification</h2>

    <p>Thank you for subscribing to updates on the product!</p>

    <p>Product Details:</p>

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Product Link</th>
                <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Initial Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><a href="{{ $product['product_link'] }}">{{ $product['product_link'] }}</a></td>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $product['initial_price'] }}</td>
            </tr>
        </tbody>
    </table>

    <p>Thank you for using our service!</p>

</body>
</html>
