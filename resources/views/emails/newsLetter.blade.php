@extends('emails.layout')

@section('title', $heading ?? 'New Newsletter Subscription')

@section('content')
    <h2>{{ $heading ?? 'New Newsletter Subscription' }}</h2>

    <table class="data-table">
        @if (!empty($letter->name))
            <tr>
                <th>Name</th>
                <td>{{ $letter->name }}</td>
            </tr>
        @endif
        <tr>
            <th>Email</th>
            <td>{{ $letter->email }}</td>
        </tr>
        @if (!empty($letter->phone))
            <tr>
                <th>Phone</th>
                <td>{{ $letter->phone }}</td>
            </tr>
        @endif
        <tr>
            <th>Date</th>
            <td>{{ optional($letter->created_at)->format('d-m-Y H:i') }}</td>
        </tr>
    </table>

    @if (!empty($letter->message))
        <p><strong>Message:</strong></p>
        <p>{{ $letter->message }}</p>
    @endif
@endsection
