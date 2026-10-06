{{--
    "My Order" tab of the user profile (website/userProfile.blade.php).
    Renders $orderData (a collection of OrderDetails) grouped by order. Item fields
    live on the per-type detail tables (detail_type: 0 room, 1 tour, 2 transfer, 3 visa);
    totals follow BookingController@SuccessOrder.
--}}
@php
    $isEn = LaravelLocalization::getCurrentLocale() === 'en';
    $OrderGroups = collect($orderData)->sortByDesc('order_id')->groupBy('order_id');

    // statuses table: 1 Pending, 2 Approved, 3 Done, 4 Cancelled, 5 New
    $StatusStyles = [1 => 'pending', 2 => 'approved', 3 => 'done', 4 => 'cancelled', 5 => 'new'];
    $StatusAr = [1 => 'قيد الانتظار', 2 => 'مؤكد', 3 => 'مكتمل', 4 => 'ملغي', 5 => 'جديد'];
    $TypeMeta = [
        0 => ['icon' => 'fa-hotel', 'en' => 'Hotel', 'ar' => 'فندق'],
        1 => ['icon' => 'fa-route', 'en' => 'Tour', 'ar' => 'جولة'],
        2 => ['icon' => 'fa-car', 'en' => 'Transfer', 'ar' => 'انتقالات'],
        3 => ['icon' => 'fa-passport', 'en' => 'Visa', 'ar' => 'تأشيرة'],
    ];
    $fmtDate = function ($value, $withTime = false) use ($isEn) {
        if (!$value) {
            return null;
        }
        try {
            return \Illuminate\Support\Carbon::parse($value)
                ->locale($isEn ? 'en' : 'ar')
                ->translatedFormat($withTime ? 'd M Y, H:i' : 'd M Y');
        } catch (\Throwable $e) {
            return $value;
        }
    };
@endphp

<div class="orders po">
    <h6 class="profile_heading"><i class="fa-regular fa-file-lines"></i>{{ __('links.myOrder') }}</h6>

    @forelse ($OrderGroups as $OrderId => $Details)
        @php
            $Order = $Details->first()->order;
            $Items = [];
            $OrderCost = 0;

            foreach ($Details as $Detail) {
                $type = (int) $Detail->detail_type;
                $item = [
                    'type' => $type,
                    'title' => null,
                    'subtitle' => null,
                    'facts' => [],
                    'cost' => 0,
                    'status_id' => $Detail->status_id,
                    'status' => optional($Detail->status)->status,
                ];

                if ($type === 0 && ($r = $Detail->room_details->first())) {
                    $hotel = $r->hotel;
                    $item['title'] = $hotel ? ($isEn ? $hotel->hotel_enname : $hotel->hotel_arname ?? $hotel->hotel_enname) : null;
                    $item['subtitle'] = trim(implode(' · ', array_filter([$r->room_type, $r->room_view, $r->food_bev_type])));
                    $item['facts'] = [
                        [$isEn ? 'Check-in' : 'الوصول', $fmtDate($r->from_date)],
                        [$isEn ? 'Check-out' : 'المغادرة', $fmtDate($r->to_date)],
                        [$isEn ? 'Nights' : 'الليالي', $r->nights],
                        [$isEn ? 'Rooms' : 'الغرف', $r->rooms_count],
                        [$isEn ? 'Adults' : 'البالغين', $r->adults_count],
                        [$isEn ? 'Children' : 'الأطفال', $r->children_count],
                    ];
                    $item['cost'] = (float) $r->total_cost;
                } elseif ($type === 1 && ($t = $Detail->tours_details->first())) {
                    $tour = $t->tour;
                    $item['title'] = (!$isEn && $tour && $tour->ar_name) ? $tour->ar_name : $t->tour_name;
                    $item['subtitle'] = $Detail->pickup_point ? ($isEn ? 'Pickup: ' : 'نقطة الالتقاء: ') . $Detail->pickup_point : null;
                    $item['facts'] = [
                        [$isEn ? 'Tour date' : 'تاريخ الجولة', $fmtDate($t->tour_date)],
                        [$isEn ? 'Adults' : 'البالغين', $t->adults_count],
                        [$isEn ? 'Children' : 'الأطفال', $t->children_count],
                    ];
                    $item['cost'] = (float) $t->total_cost;
                } elseif ($type === 2 && ($tr = $Detail->transfer_details->first())) {
                    $item['title'] = trim($tr->transfer_from) . ' → ' . trim($tr->transfer_to);
                    $item['subtitle'] = trim(implode(' · ', array_filter([trim($tr->car_model), trim($tr->car_class)])));
                    $item['facts'] = [
                        [$isEn ? 'Pickup date' : 'تاريخ الانتقال', $fmtDate($tr->transfer_date, true)],
                        [$isEn ? 'Return' : 'العودة', $tr->is_return ? $fmtDate($tr->return_date, true) : ($isEn ? 'One way' : 'ذهاب فقط')],
                        [$isEn ? 'Capacity' : 'السعة', $tr->car_capacity],
                        [$isEn ? 'Hotel' : 'الفندق', $tr->hotel_name],
                    ];
                    $item['cost'] = (float) $tr->transfer_total_cost;
                } elseif ($type === 3 && ($v = $Detail->visa_details->first())) {
                    $visa = $v->visa;
                    $visaType = optional(optional($visa)->type);
                    // Country may be stored on the visa or only on its visa type
                    $visaCountry = optional(optional($visa)->country ?? $visaType->country);
                    $item['title'] = trim(($isEn ? $visaCountry->en_country : $visaCountry->ar_country) . ' – ' . ($isEn ? $visaType->en_type : $visaType->ar_type), ' –');
                    $item['subtitle'] = ($isEn ? 'Applicant: ' : 'مقدم الطلب: ') . $Detail->holder_name;
                    $item['facts'] = [
                        [$isEn ? 'Applied on' : 'تاريخ الطلب', $fmtDate($v->visa_date)],
                        [$isEn ? 'Email' : 'البريد الإلكتروني', $Detail->holder_email],
                        [$isEn ? 'Mobile' : 'الهاتف', $Detail->holder_mobile],
                    ];
                    $item['cost'] = (float) $v->visa_cost;
                }

                if ($type !== 3 && $Detail->holder_name) {
                    $item['facts'][] = [$isEn ? 'Holder' : 'مسئول الحجز', trim($Detail->holder_name . ' ' . ($Detail->holder_mobile ? '· ' . $Detail->holder_mobile : ''))];
                }
                // Drop empty values instead of rendering blank cells
                $item['facts'] = array_values(array_filter($item['facts'], fn ($f) => $f[1] !== null && trim((string) $f[1]) !== ''));
                $item['title'] = $item['title'] ?: ($isEn ? $TypeMeta[$type]['en'] ?? 'Item' : $TypeMeta[$type]['ar'] ?? 'عنصر');

                $OrderCost += $item['cost'];
                $Items[] = $item;
            }

            $TaxRate = (float) optional($Order)->tax_percentage / 100;
            $OrderTotal = $OrderCost * (1 + $TaxRate);
        @endphp

        <article class="po-order">
            <div class="po-order__head">
                <div>
                    <span class="po-order__no">{{ $isEn ? 'Order' : 'طلب' }} #{{ $OrderId }}</span>
                    @if ($Order && $Order->created_at)
                        <span class="po-muted d-block">
                            {{ $isEn ? 'Placed on' : 'بتاريخ' }} {{ $fmtDate($Order->created_at) }}
                            · {{ count($Items) }} {{ $isEn ? (count($Items) == 1 ? 'item' : 'items') : 'عنصر' }}
                        </span>
                    @endif
                </div>
                <div class="po-order__total">
                    <span class="po-muted">{{ $isEn ? 'Total (incl. VAT)' : 'الإجمالي (شامل الضريبة)' }}</span>
                    <strong>{{ money($OrderTotal) }}</strong>
                </div>
            </div>

            <ul class="po-items">
                @foreach ($Items as $item)
                    @php
                        $meta = $TypeMeta[$item['type']] ?? ['icon' => 'fa-receipt', 'en' => 'Item', 'ar' => 'عنصر'];
                        $statusKey = $StatusStyles[$item['status_id']] ?? 'new';
                        $statusLabel = $isEn ? ($item['status'] ?? 'New') : ($StatusAr[$item['status_id']] ?? ($item['status'] ?? 'جديد'));
                    @endphp
                    <li class="po-item">
                        <div class="po-item__head">
                            <span class="po-item__icon"><i class="fa-solid {{ $meta['icon'] }}"></i></span>
                            <div class="po-item__text">
                                <span class="po-item__type">{{ $isEn ? $meta['en'] : $meta['ar'] }}</span>
                                <span class="po-item__title">{{ $item['title'] }}</span>
                                @if ($item['subtitle'])
                                    <span class="po-muted">{{ $item['subtitle'] }}</span>
                                @endif
                            </div>
                            <div class="po-item__aside">
                                <span class="po-badge po-badge--{{ $statusKey }}">{{ $statusLabel }}</span>
                                <span class="po-item__cost">{{ money($item['cost']) }}</span>
                            </div>
                        </div>
                        @if (count($item['facts']))
                            <dl class="po-facts">
                                @foreach ($item['facts'] as [$label, $value])
                                    <div>
                                        <dt>{{ $label }}</dt>
                                        <dd>{{ $value }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        @endif
                    </li>
                @endforeach
            </ul>

            <div class="po-order__foot">
                <div><span>{{ $isEn ? 'Subtotal' : 'المجموع الفرعي' }}</span><span>{{ money($OrderCost) }}</span></div>
                <div><span>{{ $isEn ? 'VAT' : 'الضريبة' }} ({{ (float) optional($Order)->tax_percentage }}%)</span><span>{{ money($OrderCost * $TaxRate) }}</span></div>
            </div>
        </article>
    @empty
        <div class="po-empty">
            <i class="fa-regular fa-file-lines"></i>
            <p>{{ $isEn ? 'You have no orders yet.' : 'لا توجد طلبات حتى الآن.' }}</p>
            <a href="{{ LaravelLocalization::localizeUrl('/tours') }}" class="po-empty__cta">
                {{ $isEn ? 'Explore Tours' : 'تصفح الجولات' }}
            </a>
        </div>
    @endforelse
</div>
