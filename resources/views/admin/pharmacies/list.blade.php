@extends('layouts.admin')

@section('content')

<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">
            Pharmacies List
        </h5>
        <div class="card-body">
            <form>
                <div class="input-group">
                    <input type="text" class="form-control" name="term" value="{{ request('term') }}">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="main-card mb-3 card">
    <div class="card-body">
        <table class="mb-0 table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Logo</th>
                    <th>Phone</th>
                    <th>Mobile</th>
                    <th>Fax</th>
                    <th>State</th>
                    <th>City</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pharmacies as $pharmacy)
                    <tr id="model-{{ $pharmacy->id }}">
                        <td>{{ $pharmacy->name }}</td>
                        <td><img src="{{ asset($pharmacy->logo) }}" width="80px" class="img img-responsive"/></td>
                        <td>{{ $pharmacy->phone }}</td>
                        <td>{{ $pharmacy->mobile }}</td>
                        <td>{{ $pharmacy->fax }}</td>
                        <td>{{ $pharmacy->state }}</td>
                        <td>{{ $pharmacy->city }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        @isset($pharmacies)
        <div class="col">
            {{ $pharmacies->links() }}
        </div>
        @endisset
    </div>
</div>
@endsection
