@extends('layouts.app')

@section('content')
<div class="col-lg-4 mx-auto">
    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif
    <!-- Your other content -->
</div>
<div class="row">
    <div class="col-md-6 mx-auto">
        <h1 class="text-center mb-4">URL Shortener</h1>
        
        {{-- Form --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('shorten') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="long_url" class="form-label">Enter Long URL</label>
                        <input type="url" id="long_url" name="long_url" class="form-control @error('long_url') is-invalid @enderror" placeholder="https://example.com" required>
                        @error('long_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Shorten URL</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Table --}}
<div class="row mt-5">
    <div class="col-md-6 mx-auto">
        @if($urls->isEmpty())
            <div class="alert alert-info text-center">No URL found.</div>
        @else
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center mb-3">Shortened URLs</h5>
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Short URL</th>
                                <th>Long URL</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($urls as $url)
                                <tr>
                                    <td>
                                        <a href="{{ url($url->short_url) }}" target="_blank" class="text-decoration-none">
                                            {{ url($url->short_url) }}
                                        </a>
                                    </td>
                                    <td>{{ $url->long_url }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
