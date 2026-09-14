<?php
    // Get the data from the form
    $product_name      = filter_input(INPUT_POST, 'product_name');
    $list_price        = filter_input(INPUT_POST, 'list_price',        FILTER_VALIDATE_FLOAT);
    $discount_percent  = filter_input(INPUT_POST, 'discount_percent',  FILTER_VALIDATE_FLOAT);

    // Validate the data
    if ($product_name == null || $product_name == false) {
        $error_product_name = "Product name is required.";
    }
    if ($list_price == null || $list_price == false) {
        $error_list_price = "List price must be a valid number.";
    }
    if ($discount_percent == null || $discount_percent == false) {
        $error_discount_percent = "Discount percent must be a valid number.";
    }

    // If valid data, calculate the discount
    if (!isset($error_product_name) && !isset($error_list_price) && !isset($error_discount_percent)) {
        $discount_amount  = $list_price * $discount_percent / 100;
        $discount_price   = $list_price - $discount_amount;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Discount - Result</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>

<main>
    <h1>Product Discount Result</h1>

    <?php if (isset($error_product_name) || isset($error_list_price) || isset($error_discount_percent)): ?>

        <p class="error">Please correct the following errors:</p>
        <ul class="error-list">
            <?php if (isset($error_product_name)): ?>
                <li><?php echo $error_product_name; ?></li>
            <?php endif; ?>
            <?php if (isset($error_list_price)): ?>
                <li><?php echo $error_list_price; ?></li>
            <?php endif; ?>
            <?php if (isset($error_discount_percent)): ?>
                <li><?php echo $error_discount_percent; ?></li>
            <?php endif; ?>
        </ul>
        <p><a href="index.html">Back to form</a></p>

    <?php else: ?>

        <table>
            <tr>
                <th>Product Name:</th>
                <td><?php echo htmlspecialchars($product_name); ?></td>
            </tr>
            <tr>
                <th>List Price:</th>
                <td>$<?php echo number_format($list_price, 2); ?></td>
            </tr>
            <tr>
                <th>Discount Percent:</th>
                <td><?php echo $discount_percent; ?>%</td>
            </tr>
            <tr>
                <th>Discount Amount:</th>
                <td>$<?php echo number_format($discount_amount, 2); ?></td>
            </tr>
            <tr>
                <th>Discount Price:</th>
                <td>$<?php echo number_format($discount_price, 2); ?></td>
            </tr>
        </table>
        <p><a href="index.html">Back to form</a></p>

    <?php endif; ?>

</main>

</body>
</html>
