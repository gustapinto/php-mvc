<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Products
    </title>
</head>
<body>
    <div>
        <div>
            Create New Product

            <form method="POST" action="/products/new">
                <input type="text" name="name" placeholder="Name" required>
                <input type="number" name="value" placeholder="Value" required>

                <button type="submmit">
                    Save
                </button>
            </form>
        </div>
    </div>
</body>
</html>
