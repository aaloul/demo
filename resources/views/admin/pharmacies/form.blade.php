@extends ('layouts.admin')

@section('styles')
<link href="{{ asset('css/form-validation.css') }}" rel="stylesheet">
<link href="{{ asset('css/progressbar.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 order-md-1">
        @include('admin._partials.progressbar')
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('pharmacies.store', [$step]) }}" method="POST" enctype="multipart/form-data"
            class="needs-validation" novalidate>
            @csrf            
            @include('admin.pharmacies.wizard.' . $step)
            <hr class="mb-4">
            @if ($step != 'contact')
            <button class="btn btn-primary btn-lg btn-block" type="submit">Next</button>
            @else
            <button class="btn btn-primary btn-lg btn-block" type="submit">Finish</button>
            @endif
            <hr class="mb-4">
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/form-validation.js') }}"></script>
@endsection