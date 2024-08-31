@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <h1>Transaction History</h1>

    @if ($transactions->isEmpty())
        <p>No transactions found.</p>
    @else
        <table id="transactionsTable" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Fee</th>
                    <th>Recipient</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->type }}</td>
                        <td>${{ $transaction->amount }}</td>
                        <td>
                            {{ $transaction->transaction_fee > 0 ? '$' . $transaction->transaction_fee : '' }}
                        </td>
                        <td>{{ $transaction->recipient->name ?? 'N/A' }}</td>
                        <td>{{ $transaction->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Bootstrap 4 Integration -->
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <!-- DataTables Responsive JS -->
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <!-- DataTables Responsive CSS -->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('#transactionsTable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });
    </script>
@endsection
