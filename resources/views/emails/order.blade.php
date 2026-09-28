@extends('emails.layout')

@section('title', 'New Order Confirmation')

@section('content')
    <h2>Thank You For Your Order!</h2>
    <p>Dear {{ $customer->name ?? $customer->first_name ?? 'Customer' }},</p>
    <p>Your order has been received successfully, and our team will get in touch with you shortly to complete the process.</p>

    <table class="data-table">
        <tr>
            <th>Order Number</th>
            <td>#{{ $order->id }}</td>
        </tr>
        <tr>
            <th>Customer Name</th>
            <td>{{ $customer->name ?? $customer->first_name ?? '-' }}</td>
        </tr>
        <tr>
            <th>Customer Email</th>
            <td>{{ $customer->email ?? '-' }}</td>
        </tr>
        @if (!empty($customer->phone))
            <tr>
                <th>Customer Phone</th>
                <td>{{ $customer->phone }}</td>
            </tr>
        @endif
        <tr>
            <th>Order Date</th>
            <td>{{ optional($order->created_at)->format('d-m-Y H:i') }}</td>
        </tr>
    </table>

    @if ($order->order_details->count())
        <table class="data-table">
            <tr>
                <th>Item</th>
                <th>Details</th>
                <th>Cost</th>
            </tr>
            @foreach ($order->order_details as $item)
                @php
                    $label = 'Booking';
                    $details = '';
                    $itemCost = 0;

                    switch ($item->detail_type) {
                        case 0: // Room
                            $room = $item->room_details->first();
                            $label = 'Hotel Room';
                            $details = $room->room_type ?? '';
                            $itemCost = $room->total_cost ?? 0;
                            break;
                        case 1: // Tour
                            $tour = $item->tours_details->first();
                            $label = 'Tour';
                            $details = $tour->tour_name ?? '';
                            $itemCost = $tour->total_cost ?? 0;
                            break;
                        case 2: // Transfer
                            $transfer = $item->transfer_details->first();
                            $label = 'Transfer';
                            $details = ($transfer->transfer_from ?? '') . ' → ' . ($transfer->transfer_to ?? '');
                            $itemCost = $transfer->transfer_total_cost ?? 0;
                            break;
                        case 3: // Visa
                            $visa = $item->visa_details->first();
                            $label = 'Visa';
                            $details = $item->holder_name ?? '';
                            $itemCost = $visa->visa_cost ?? 0;
                            break;
                    }
                @endphp
                <tr>
                    <td>{{ $label }}</td>
                    <td>{{ $details }}</td>
                    <td>{{ number_format((float) $itemCost, 2) }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    <p style="font-size: 17px; font-weight: bold; color: #1C4482;">
        Total Cost: {{ number_format($cost * (1 + (float) $order->tax_percentage / 100), 2) }}
    </p>

    <p>If you have any questions, feel free to contact us at {{ config('mail.admin_address', 'info@safer.travel') }}.</p>
    <p>Best regards,<br>The Customer Service Team at Safer Travel</p>
@endsection
