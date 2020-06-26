<!DOCTYPE html>
<html>
<head>
    <title>Hash Link Generator</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />

    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
    <script type="text/javascript">
        $(document).ready(function() {
            $('#hashLinksTable').DataTable();
        } );
    </script>

</head>
<body>
   
<div class="container">
    <h1 align="center">Hash Link Generator</h1>
   
    <div class="card">
      <div class="card-header">
        <form method="POST" action="{{ route('submitLink') }}">
            @csrf
            <div class="input-group mb-3">
              <input type="text" name="link" required="true" class="form-control" placeholder="Enter URL">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Create Hashed Link</button>
              </div>
            </div>
        </form>
      </div>
      <div class="card-body">
   
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if (Session::has('warning'))
                <div class="alert alert-warning" role="alert">
                    {{ Session::get('warning') }}
                </div>
            @endif
   
            <table id="hashLinksTable" class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hashed Link</th>
                        <th>Link</th>
                        <th>Hit(s)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hashLinks as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td><a href="{{ route('shortLink', $row->code) }}" target="_blank">{{ route('shortLink', $row->code) }}</a></td>
                            <td>{{ $row->link }}</td>
                            <td>{{ $row->counter }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
    </div>
   
</div>
    
</body>
</html>