<div style="width: 80%; margin: auto;" class="report">
    <h1 style="text-align: center;">Report</h1>
    <div style="display: flex; justify-content: space-between;" class="report-info">
        <p>Date: <?php echo date('Y-m-d'); ?></p>
        <p>Generated For: {{ Auth::user()->firstName . ' ' . Auth::user()->lastName }}</p>
    </div>
    <div class="report-section stock" style="width: 100%;">
        <h2>Stock</h2>
        <table style="width: 100%; text-align: start">
            <thead style="text-align: start;">
                <tr>
                    <th style="text-align: start;">Book Name</th>
                    <th style="text-align: start;">Author</th>
                    <th style="text-align: start;">Price</th>
                    <th style="text-align: start;">Stock</th>
                    <th style="text-align: start;">Sold</th>
                    <th style="text-align: start;">Sales</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr @if ($book['quantity'] == 0) style="background-color: #FFEBEE;" @endif>
                        <td>{{ $book['book_name'] }}</td>
                        <td>{{ $book['author'] }}</td>
                        <td>£{{ $book['price'] }}</td>
                        <td>{{ $book['quantity'] }}</td>
                        <td>{{ $book['orders_count'] }}</td>
                        <td>£{{ $book['orders_count'] * $book['price'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="report-section orders" style="width: 100%;">
        <h2>Orders</h2>
        <table style="width: 100%;" class="table-auto">
            <thead>
                <tr>
                    <th style="text-align: start;">Order ID</th>
                    <th style="text-align: start;">Ordered By</th>
                    <th style="text-align: start;">Date Ordered</th>
                    <th style="text-align: start;">Last Updated</th>
                    <th style="text-align: start;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr @if ($order['status'] == 'pending') style="background-color: #fff1c8;"
                        @elseif ($order['status'] == 'cancelled') style="background-color: #FFEBEE;" 
                        @endif>
                        <td>{{ $order['id'] }}</td>
                        <td>{{ $order['user'] }}</td>
                        <td>{{ $order['created_at'] }}</td>
                        <td>{{ $order['updated_at'] }}</td>
                        <td>{{ $order['status'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
