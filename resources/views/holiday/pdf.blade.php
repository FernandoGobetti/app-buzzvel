<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style type="text/css">
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<body>
<h2 style="text-align: center">Holiday Plan</h2>

<table style="width: 300px">
    <tbody>

    <tr>
        <td>Title :</td>
        <td>{{ $holiday->title }}</td>
    </tr>
    <tr>
        <td>Description :</td>
        <td>{{ $holiday->description }}</td>
    </tr>
    <tr>
        <td>Location :</td>
        <td>{{ $holiday->location }}</td>
    </tr>
    <tr style="border: 1px solid black">
        <td>Participants :</td>
        <td>
            <ul>
                @foreach($holiday->participants as $item)
                    <li>{{ $item->name }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
