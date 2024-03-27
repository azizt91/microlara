@extends('layout.app')

@section('contents')

<section class="content-pppoe mt-3">
    <div class="container col-md-8">

    <h3>PPPoE User List</h3>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    @if (!is_null($pppoeSecrets) && count($pppoeSecrets) > 0)
    <div class="table-responsive">
        <table id="pppoeTable" class="table table-sm table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Nama') }}</th>
                    <th scope="col">{{ __('Password') }}</th>
                    <th scope="col">{{ __('Remote Address') }}</th>
                    <th scope="col">{{ __('Status') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pppoeSecrets as $pppoeUser)
                    <tr>
                        <td class="small">{{ $loop->iteration }}</td>
                        <td class="small">{{ $pppoeUser['name'] }}</td>
                        <td class="small">{{ $pppoeUser['password'] }}</td>
                        <td class="small">{{ $pppoeUser['remote-address'] }}</td>    
                        <td>
                            @if ($pppoeUser['disabled'] == 'false')
                                <i class="bi bi-check-circle-fill text-success"></i>
                            @else
                                <i class="bi bi-x-circle-fill text-danger"></i>
                            @endif
                        </td>
                        <td class="small">
                            <form action="{{ $pppoeUser['disabled'] == 'false' ? route('pppoe.disable', $pppoeUser['.id']) : route('pppoe.enable', $pppoeUser['.id']) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $pppoeUser['disabled'] == 'false' ? 'btn-danger' : 'btn-success' }}">{{ $pppoeUser['disabled'] == 'false' ? 'Disable' : 'Enable' }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No PPPoE users found.</p>
    @endif
</section>
@endsection

