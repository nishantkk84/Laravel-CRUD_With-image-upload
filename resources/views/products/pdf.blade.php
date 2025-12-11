<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Products PDF</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: #333333;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 8px;
            vertical-align: top;
            border: 1px solid #dddddd;
        }

        .image-cell img {
            width: 60px;
            height: auto;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<h2>Product List</h2>

<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Product Name</th>
            <th>Price (¥)</th>
            <th>Description</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($products as $product)
            <tr>
                <td class="image-cell">
                    @if($product->image)
                        <img src="{{ public_path('uploads/' . $product->image) }}">
                    @endif
                </td>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td style="width: 280px;">{{ $product->description }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
