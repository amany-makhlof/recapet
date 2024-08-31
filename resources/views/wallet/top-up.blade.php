@extends('layouts.master')

@section('title', 'Top Up')

@section('content')
    <h1>Top Up Wallet</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('wallet.topUp') }}">
        @csrf
        <div class="form-group">
            <label for="balance">Amount</label>
            <input type="number" step="0.01" class="form-control" id="balance" name="balance" value="{{ old('balance') }}"
                required>
        </div>
        <button type="submit" class="btn btn-primary">Top Up</button>
    </form>
@endsection
