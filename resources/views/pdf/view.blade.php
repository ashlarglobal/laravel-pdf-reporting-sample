<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Export PDF</title>
        <style>
            /* Add your custom styles for the PDF here */
            body {
                font-family: Arial, sans-serif;
            }

            h1 {
                color: #333;
            }
            
            th, td {
                padding: 2px;
                border: 1px solid #000;
                font-size: 14px;
            }

            th {
                font-weight: bold;
            }

            .table1 {
                width: 100%;
                border-collapse: collapse;
            }

            .table2 {
                width: 100%;
                border-collapse: collapse;
            }

            .table2 thead {
                margin-bottom: 20px;
            }

            .cell {
                border: 1px solid #000;
            }

            .w10 {
                width: 10%;
            }

            .w15 {
                width: 15%;
            }

            .w45 {
                width: 45%;
            }

            .w70 {
                width: 70%
            }

            .text-center {
                text-align: center;
            }

            .text-bold {
                font-weight: bold;
            }
        </style>
    </head>
<body>
    <div style="margin-left: 20px; margin-right: 20px; margin-top: 20px;">
        <table class="table1">
            <thead>
                <tr>
                    <td class="cell w15">
                        Date: {{ $date }} <br>
                        Time: {{ $time }} <br>
                        Page: 1
                    </td>
                    <td class="cell w70 text-center">
                        <h3 style="margin-bottom: -10px; margin-top: 5px;">{{ $data['client_name'] }}</h3>
                        <h3 style="margin-bottom: 5px">Good inventories Summary</h3>
                    </td>
                    <td class="cell w15">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                    </td>
                </tr>
            </thead>
        </table>


        <table class="table1" style="margin-top: 10px">
            <thead>
                <tr>
                    <td class="cell w45 text-center"><p>All Active Stock, Items</p></td>
                    <td class="cell w45 text-center"></td>
                    <td class="cell w10 text-center">User: CJ</td>
                </tr>
            </thead>
        </table>
        
        <table class="table2" style="margin-top: 10px;">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Vendor Part #</th>
                    <th>On Hand</th>
                    <th>Available</th>
                    <th>Allocated</th>
                    <th>Price</th>
                    <th>Tax</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody style="margin-top: 10px">
                @foreach($data['inventories'] as $item)
                <tr>
                    <td>{{ $item['item_number'] ?? '' }}</td>
                    <td>{{ $item['item_description'] ?? '' }}</td>
                    <td>{{ $item['vendor_part'] ?? '' }}</td>
                    <td>{{ $item['on_hand'] ?? ''}}</td>
                    <td>{{ $item['available'] ?? ''}}</td>
                    <td>{{ $item['allocated'] ?? ''}}</td>
                    <td>$0.00</td>
                    <td>{{ $item['not_taxable'] ? 'Y' : 'N'}}</td>
                    <td>$0.00</td>
                </tr>
                @endforeach 
                <tr>
                    <td colspan="3" class="text-bold">Totals</td>
                    <td>{{ $totalOnHand }}</td>
                    <td>{{ $totalAvailable }}</td>
                    <td>{{ $totalAllocated }}</td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
