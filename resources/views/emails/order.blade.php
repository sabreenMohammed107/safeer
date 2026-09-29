@extends('emails.layout')

@section('title', __('emails.order_title'))

@section('content')
    <h2>{{ __('emails.order_title') }}</h2>
    <p>{{ __('emails.order_greeting', ['name' => $customer->name ?? $customer->first_name ?? 'Customer']) }}</p>
    <p>{{ __('emails.order_intro') }}</p>

    <table class="data-table">
        <tr>
            <th>{{ __('emails.order_number') }}</th>
            <td>#{{ $order->id }}</td>
        </tr>
        <tr>
            <th>{{ __('emails.order_customer_name') }}</th>
            <td>{{ $customer->name ?? $customer->first_name ?? '-' }}</td>
        </tr>
        <tr>
            <th>{{ __('emails.order_customer_email') }}</th>
            <td>{{ $customer->email ?? '-' }}</td>
        </tr>
        @if (!empty($customer->phone))
            <tr>
                <th>{{ __('emails.order_customer_phone') }}</th>
                <td>{{ $customer->phone }}</td>
            </tr>
        @endif
        <tr>
            <th>{{ __('emails.order_date') }}</th>
            <td>{{ optional($order->created_at)->format('d-m-Y H:i') }}</td>
        </tr>
    </table>

    @if ($order->order_details->count())
        <table class="data-table">
            <tr>
                <th>{{ __('emails.order_item') }}</th>
                <th>{{ __('emails.order_details') }}</th>
                <th>{{ __('emails.order_cost') }}</th>
            </tr>
            @foreach ($order->order_details as $item)
                @php
                    $label = 'Booking';
                    $details = '';
                    $itemCost = 0;

                    switch ($item->detail_type) {
                        case 0: // Room
                            $room = $item->room_details->first();
                            $label = __('emails.order_type_room');
                            $details = $room->room_type ?? '';
                            $itemCost = $room->total_cost ?? 0;
                            break;
                        case 1: // Tour
                            $tour = $item->tours_details->first();
                            $label = __('emails.order_type_tour');
                            $details = $tour->tour_name ?? '';
                            $itemCost = $tour->total_cost ?? 0;
                            break;
                        case 2: // Transfer
                            $transfer = $item->transfer_details->first();
                            $label = __('emails.order_type_transfer');
                            $details = ($transfer->transfer_from ?? '') . ' → ' . ($transfer->transfer_to ?? '');
                            $itemCost = $transfer->transfer_total_cost ?? 0;
                            break;
                        case 3: // Visa
                            $visa = $item->visa_details->first();
                            $label = __('emails.order_type_visa');
                            $details = $item->holder_name ?? '';
                            $itemCost = $visa->visa_cost ?? 0;
                            break;
                    }
                @endphp
                <tr>
                    <td>{{ $label }}</td>
                    <td>{{ $details }}</td>
                    <td>{{ money($itemCost) }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    <p style="font-size: 17px; font-weight: bold; color: #1C4482;">
        {{ __('emails.order_total') }}: {{ money($cost * (1 + (float) $order->tax_percentage / 100)) }}
    </p>

    <p>{{ __('emails.order_contact', ['email' => config('mail.admin_address', 'info@safer.travel')]) }}</p>
    <p>{{ __('emails.order_regards') }}<br>{{ __('emails.order_team') }}</p>
@endsection
