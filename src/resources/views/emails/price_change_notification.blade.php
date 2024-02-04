<!DOCTYPE html>
<html>

<head>
    <title>Invoice Email</title>
</head>

<body>
    <h2>Price Change Notification</h2>

    <p>Hello,</p>

    <p>We wanted to inform you about changes in the prices of the following products:</p>

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Product Link</th>
                <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Initial Price</th>
                <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">New Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><a href="{{ $product['product_link'] }}">{{ $product['product_link'] }}</a></td>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $product['initial_price'] }}</td>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">{{ $product['new_price'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p>Thank you for using our service!</p>

</body>

</html>
