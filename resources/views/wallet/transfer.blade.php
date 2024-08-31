@extends('layouts.master')

@section('title', 'Transfer Funds')

@section('content')
    <h1>Transfer Funds</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('wallet.transfer') }}">
        @csrf

        <div class="form-group">
            <label for="recipient_id">Recipient</label>
            <select class="form-control" id="recipient_id" name="recipient_id" required>
                <option value="" disabled selected>Select recipient</option>
                @foreach ($users as $user)
                    <option value="{{ Crypt::encryptString($user->id) }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="balance">Amount</label>
            <input type="number" class="form-control" id="balance" name="balance" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Transfer</button>
    </form>
@endsection
