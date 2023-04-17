
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/log.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <title>Feshon Wb Logs</title>
</head>

<body>

</body>

</html>
<h1><span class="black">Logs</span>
</h1>
<table class="container">
    <thead>
        <tr>
            <th>
                <h1>Date</h1>
            </th>
            <th>
                <h1>Title</h1>
            </th>
            <th>
                <h1>Data</h1>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($log_array_data as $one_log_data)
            @if ($one_log_data['type'] == 'denger')
                <tr class="alert alert-danger">
                    <td>{{$one_log_data['date'] }}</td>
                    <td>{{$one_log_data['title'] }}</td>
                    <td>View Data</td>
                </tr>
            @else
                <tr class="alert alert-success">
                    <td>{{ $one_log_data['date'] }}</td>
                    <td>{{ $one_log_data['title'] }}</td>
                    <td>View Data</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
