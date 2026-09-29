@extends('emails.layout')

@section('title', $heading ?? __('emails.newsletter_subject'))

@section('content')
    <h2>{{ $heading ?? __('emails.newsletter_subject') }}</h2>

    <table class="data-table">
        @if (!empty($letter->name))
            <tr>
                <th>{{ __('emails.letter_name') }}</th>
                <td>{{ $letter->name }}</td>
            </tr>
        @endif
        <tr>
            <th>{{ __('emails.letter_email') }}</th>
            <td>{{ $letter->email }}</td>
        </tr>
        @if (!empty($letter->phone))
            <tr>
                <th>{{ __('emails.letter_phone') }}</th>
                <td>{{ $letter->phone }}</td>
            </tr>
        @endif
        <tr>
            <th>{{ __('emails.letter_date') }}</th>
            <td>{{ optional($letter->created_at)->format('d-m-Y H:i') }}</td>
        </tr>
    </table>

    @if (!empty($letter->message))
        <p><strong>{{ __('emails.letter_message') }}</strong></p>
        <p>{{ $letter->message }}</p>
    @endif
@endsection
