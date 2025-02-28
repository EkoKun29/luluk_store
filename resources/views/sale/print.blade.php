<html moznomarginboxes mozdisallowselectionprint>

<head>
    <title>
        Nota Penjualan
    </title>
    <style type="text/css">
        html {
            font-family: "Inter";
        }

        .content {
            width: 80mm;
            font-size: 12px;
            padding: 20px;
        }

        .content .title {
            text-align: center;
            padding-bottom: 13px
        }

        .content .separate {
            margin-top: 10px;
            margin-bottom: 15px;
            border-top: 1px dashed #000;
        }

        .content .transaction-table {
            width: 100%;
            font-size: 10px;
        }

        .content .transaction-table .text-right {
            text-align: right;
        }

        .content .transaction-table .text-center {
            text-align: center;
        }


        .content .transaction-table tr td {
            vertical-align: top;
        }

        .content .transaction-table .table-tr td {
            padding-top: 7px;
            padding-bottom: 7px;
        }

        .content .transaction-table .border-line {
            height: 1px;
            border-top: 1px dashed #000;
        }

        .content .closing {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
        }

        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.print();
    
            window.onafterprint = function() {
                let redirectUrl = "{{ $redirectTo }}";
                console.log("Redirecting to: " + redirectUrl);
                window.location.href = redirectUrl; 
            };
        });
    </script>
    
</head>

<body>
    <div class="content">
        <div class="title">
            <div style="text-transform: uppercase;font-size: 15px">
                Toko Luluk
            </div>
            <div>
                Kompleks Ruko Pasar Winong Kidul
            </div>
            <div>
                0822-2096-6451
            </div>
        </div>

        <div style="border-top: 1px dashed #000;height: 1px;margin-bottom: 5px"></div>
        <table class="transaction-table" cellspacing="0" cellpadding="0">
            <tr>
                <td>TANGGAL</td>
                <td>:</td>
                <td>{{ $sale->formatted_date }}</td>
            </tr>
            <tr>
                <td>NOMOR NOTA</td>
                <td>:</td>
                <td>{{ $sale->note_number }}</td>
            </tr>
            <tr>
                <td>CUSTOMER</td>
                <td>:</td>
                <td>{{ $sale->consumer }}</td>
            </tr>
            <tr>
                <td>NAMA KASIR</td>
                <td>:</td>
                <td>{{ $sale->store_name }}</td>
            </tr>
        </table>

        <div class="transaction">
            <table class="transaction-table" cellspacing="0" cellpadding="0">
                <tr class="table-tr">
                    <td colspan="3">
                        <div class="border-line"></div>
                    </td>
                    <td colspan="3">
                        <div class="border-line"></div>
                    </td>
                    <td colspan="3">
                        <div class="border-line"></div>
                    </td>
                </tr>
                @forelse ($sale->saleDetails as $saleDetail)
                    <tr>
                        <td>{{ $saleDetail->productPrice->product->name }}</td>
                        <td style='text-center'>{{ $saleDetail->amount }}</td>
                        <td style='text-center'>
                            {{ 'Rp ' . number_format($saleDetail->productPrice->price, 2, ',', '.') }}</td>
                        <td class='text-right' colspan="5">
                            {{ 'Rp ' . number_format($saleDetail->amount * $saleDetail->productPrice->price, 2, ',', '.') }}
                        </td>
                    </tr>
                @empty
                @endforelse

                <tr class="table-tr">
                    <td colspan="3">
                        <div class="border-line"></div>
                    </td>
                    <td colspan="3">
                        <div class="border-line"></div>
                    </td>
                    <td colspan="3">
                        <div class="border-line"></div>
                    </td>
                </tr>
                @php
                    $total = 0;
                @endphp
                @if ($sale->method->value == 0)
                    @php
                        $total = $sale->total;
                    @endphp
                @endif
                @if ($sale->method->value == 1)
                    @php
                        $total = $sale->total;
                    @endphp
                @elseif ($sale->method->value == 2)
                    @php
                        $total = $sale->total;
                    @endphp
                @endif
                <tr>
                    <td colspan="3" class="text-right">
                        TOTAL
                    </td>
                    <td colspan="3" class="text-right">
                        :
                    </td>
                    <td class="text-right">
                        {{ 'Rp ' . number_format($total, 2, ',', '.') }}
                    </td>
                </tr>
                @if ($sale->method->value == 1)
                    <tr>
                        <td colspan="3" class="text-right">
                            TERHUTANG
                        </td>
                        <td colspan="3" class="text-right">
                            :
                        </td>
                        <td class="text-right">
                            {{ 'Rp ' . number_format($sale->total - $sale->amount_paid, 2, ',', '.') }}
                        </td>
                    </tr>
                @endif
                <tr>
                    <td colspan="3" class="text-right">
                        DIBAYAR
                    </td>
                    <td colspan="3" class="text-right">
                        :
                    </td>
                    <td class="text-right">
                        {{ 'Rp ' . number_format($sale->amount_paid, 2, ',', '.') }}
                    </td>
                </tr>
                @php
                    $kembalian = $sale->amount_paid > $total ? ('Rp ' . number_format($sale->amount_paid - $total, 2, ',', '.')) : '-';
                @endphp
                <tr>
                    <td colspan="3" class="text-right">
                        KEMBALIAN
                    </td>
                    <td colspan="3" class="text-right">
                        :
                    </td>
                    <td class="text-right">
                        {{ $kembalian }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="closing">
            THANK YOU <br>
            SEE YOU LATER
        </div>
    </div>
</body>

</html>
