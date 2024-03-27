{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"  type="image/png" sizes="500x500" href="{{ asset('template') }}/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('template') }}/css/style.css" rel="stylesheet">
    <title>Netwatch</title>  
</head>
<body> --}}

@extends('layout.app')

@section('contents')

    {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                <img src="{{ asset('template') }}/img/logo2.png" alt="Netwatch Logo" width="30" height="30" >
                {{ $model }}
            </a>
            <div>
                Online: <span class="badge text-bg-success">{{ $statusUpCount }}</span><br>
                Offline: <span class="badge text-bg-danger">{{ $statusDownCount }}</span>
            </div>
        </div>
    </nav> --}}

<section class="content-netwatch mt-3">
<div class="container col-md-8">
    
    <div class="mb-3">
        Online: <span class="badge text-bg-success">{{ $statusUpCount }}</span>
        Offline: <span class="badge text-bg-danger">{{ $statusDownCount }}</span>
    </div>
    
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search By Nama or Status">
    </div>

    

    <div class="table-responsive">
        <table id="netwatchTable" class="table table-sm table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Nama') }}</th>
                    <th scope="col">{{ __('Status') }}</th>
                    <th scope="col">{{ __('Host') }}</th>
                    <th scope="col">{{ __('Since') }}</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($netwatchData) && count($netwatchData) > 0)
                    @foreach ($netwatchData as $data)
                        <tr>
                            <td class="small">{{ $loop->iteration }}</td>
                            <td class="small">{{ $data['comment'] ?? 'N/A' }}</td>
                            <td>
                                @if ($data['status'] == 'up')
                                    <div class="online-indicator">
                                        <span class="blink"></span>
                                    </div>
                                @else
                                    <div class="offline-indicator">
                                        <span class="blink"></span>
                                    </div>
                                @endif
                                <span class="small">{{ $data['status'] ?? 'N/A' }}</span>
                            </td>
                            <td class="small">{{ $data['host'] ?? 'N/A' }}</td>
                            <td class="small">{{ $data['since'] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">
                            <p>Tidak ada data netwatch.</p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>    
</div>
</div>


    



</section>
@endsection


{{-- </body>
</html> --}}