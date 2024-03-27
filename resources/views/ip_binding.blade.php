
@extends('layout.app')

@section('contents')

<section class="content-ipbinding mt-3">
    <div class="container col-md-8">

    <h3>IP Binding List</h3>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    @if ($ipBindings && count($ipBindings) > 0)
    <div class="table-responsive">
        <table id="ipbindingTable" class="table table-sm table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Nama') }}</th>
                    <th scope="col">{{ __('Address') }}</th>
                    <th scope="col">{{ __('Status') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ipBindings as $ipBinding)
                    <tr>
                        <td class="small">{{ $loop->iteration }}</td>
                        <td class="small">{{ $ipBinding['comment'] }}</td>
                        <td class="small">{{ $ipBinding['address'] }}</td>
                        <td>
                            @if ($ipBinding['disabled'] == 'false')
                                <i class="bi bi-check-circle-fill text-success"></i>
                            @else
                                <i class="bi bi-x-circle-fill text-danger"></i>
                            @endif
                        </td>
                        <td class="small">
                            <form action="{{ $ipBinding['disabled'] == 'false' ? route('ip_binding.disable', $ipBinding['.id']) : route('ip_binding.enable', $ipBinding['.id']) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $ipBinding['disabled'] == 'false' ? 'btn-danger' : 'btn-success' }}">{{ $ipBinding['disabled'] == 'false' ? 'Disable' : 'Enable' }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No IP bindings found.</p>
    @endif
</section>
@endsection





