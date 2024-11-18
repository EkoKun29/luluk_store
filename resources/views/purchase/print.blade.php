<html moznomarginboxes mozdisallowselectionprint>

<head>
    <title>
        Nota Pembelian
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
        window.print();
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
                <td>{{ $purchase->formatted_date }}</td>
            </tr>
            <tr>
                <td>NOMOR NOTA</td>
                <td>:</td>
                <td>{{ $purchase->note_number }}</td>
            </tr>
            <tr>
                <td>SUPPLIER</td>
                <td>:</td>
                <td>{{ $purchase->supplier }}</td>
            </tr>
            <tr>
                <td>NAMA KASIR<</td>
                <td>:</td>
                <td>{{ $purchase->store_name }}</td>
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
                @forelse ($purchase->purchaseDetails as $purchaseDetail)
                    <tr>
                        <td>{{ $purchaseDetail->product->name }}</td>
                        <td class='text-right'>{{ $purchaseDetail->amount }}</td>
                        <td class='text-right'>{{ 'Rp ' . number_format($purchaseDetail->price, 2, ',', '.') }}</td>
                        <td class='text-right' colspan="5">
                            {{ 'Rp ' . number_format($purchaseDetail->amount * $purchaseDetail->price, 2, ',', '.') }}
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
                <tr>
                    <td colspan="3" class="text-right">
                        TOTAL
                    </td>
                    <td colspan="3" class="text-right">
                        :
                    </td>
                    <td class="text-right">
                        {{ 'Rp ' . number_format($purchase->total, 2, ',', '.') }}
                    </td>
                </tr>

                <tr>
                    <td colspan="3" class="text-right">
                        DIBAYAR
                    </td>
                    <td colspan="3" class="text-right">
                        :
                    </td>
                    <td class="text-right">
                        {{ 'Rp ' . number_format($purchase->amount_paid, 2, ',', '.') }}
                    </td>
                </tr>
                {{-- <tr>
                    <td colspan="3" class="text-right">
                        KEMBALIAN
                    </td>
                    <td colspan="3" class="text-right">
                        :
                    </td>
                    <td class="text-right">
                        Rp 5.000
                    </td>
                </tr> --}}
            </table>
        </div>
        <div class="closing">
            THANK YOU <br>
            SEE YOU LATER
        </div>
    </div>
</body>

</html>
