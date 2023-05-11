<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>All Clients</title>
</head>
<body>
    <div class="mx-5 mt-5">
        <h2>List of All Clients</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $index => $client)
                <tr>
                    <td>{{ $index++ }}</td>
                    <td>{{ $client['client_name'] }}</td>
                    <td><a href="/test/{{ $client['client_id'] }}" class="btn btn-success">Export Report</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>