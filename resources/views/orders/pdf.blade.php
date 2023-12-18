<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        header {
            text-align: center;
            background-color: #f2f2f2;
            padding: 10px;
        }

        section {
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #f2f2f2;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
    <title>Food Order Invoice</title>
</head>
<body>

    <header>
        <h1>Food Order Invoice</h1>
    </header>

    <section>
        <h2>Order Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <!-- Replace the following rows with dynamic data -->
                <tr>
                    <td>Pizza</td>
                    <td>2</td>
                    <td>$10.00</td>
                    <td>$20.00</td>
                </tr>
                <tr>
                    <td>Burger</td>
                    <td>1</td>
                    <td>$5.00</td>
                    <td>$5.00</td>
                </tr>
                <!-- End of dynamic data -->
            </tbody>
        </table>
    </section>

    <section>
        <h2>Total</h2>
        <p>Total Amount: $25.00</p>
    </section>

    <footer>
        <p>Thank you for choosing our food service!</p>
    </footer>

</body>
</html>
