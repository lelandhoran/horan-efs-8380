@extends('app')
@section('content')
    <h1>Customer </h1>

    <div class="container">
        <table class="table table-striped table-bordered table-hover">
            <tbody>
            <tr class="bg-info">
            <tr>
                <td>Name</td>
                <td><?php echo ($customer['name']); ?></td>
            </tr>
            <tr>
                <td>Customer ID</td>
                <td><?php echo ($customer['cust_number']); ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo ($customer['address']); ?></td>
            </tr>
            <tr>
                <td>City </td>
                <td><?php echo ($customer['city']); ?></td>
            </tr>
            <tr>
                <td>State</td>
                <td><?php echo ($customer['state']); ?></td>
            </tr>
            <tr>
                <td>Zip </td>
                <td><?php echo ($customer['zip']); ?></td>
            </tr>
            <tr>
                <td>Home Phone</td>
                <td><?php echo ($customer['home_phone']); ?></td>
            </tr>
            <tr>
                <td>Cell Phone</td>
                <td><?php echo ($customer['cell_phone']); ?></td>
            </tr>


            </tbody>
      </table>
    </div>


            <?php
    $stockprice=null;
    $stotal = 0;
    $svalue=0;
    $itotal = 0;
    $ivalue=0;
    $iportfolio = 0;
    $cportfolio = 0;
	$quote = 0;
    ?>
    <br>
    <h2>Stocks </h2>
    <div class="container">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr class="bg-info">
                <th> Symbol </th>
                <th>Stock Name</th>
                <th>No. of Shares</th>
                <th>Purchase Price</th>
                <th>Purchase Date</th>
                <th>Original Value</th>
                <th>Current Price</th>
                <th>Current Value</th>
            </tr>
            </thead>

            <tbody>


        @foreach($customer->stocks as $stock)
                <tr>
                <td>{{ $stock->symbol }}</td>
                <td>{{ $stock->name }}</td>
                <td>{{ $stock->shares }}</td>
                <td>${{ number_format($stock->purchase_price, 2) }}</td>
                <td>{{ $stock->purchased }}</td>
                <td>$<?php $original_value = ($stock['shares']*$stock['purchase_price']);
					echo number_format($original_value, 2);
					$stotal+=$original_value;
					?>
				</td>
				<td>$<?php
					require_once('nusoap.php');

					$c = new nusoap_client('http://loki.ist.unomaha.edu/~groyce/ws/stockquoteservice.php');

					$current_price = $c->call('getStockQuote',
						array('symbol' => $quote));
					echo number_format($current_price, 2);
					?>
				</td>
				<td>$<?php
					$current_value = ($stock['shares']*$current_price);
					echo number_format($current_value, 2); 
					$svalue+=$current_value;
					?>
				</td>
                </tr>
        @endforeach
		
          </tbody>
        </table>
			<?php 
			echo "Total of Initial Stock Portfolio $";
			echo number_format($stotal, 2);
			?>
		<br>
			<?php
			echo "Total of Current Stock Portfolio $";
			echo number_format($svalue, 2);
			?>

    </div>
	<br><br>
	<h2>Investments </h2>
    <div class="container">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr class="bg-info">
                <th>Category</th>
                <th>Description</th>
                <th>Acquired Value</th>
                <th>Acquired Date</th>
                <th>Recent Value</th>
                <th>Recent Date</th>
            </tr>
            </thead>

            <tbody>


        @foreach($customer->investments as $investment)
                <tr>
                <td>{{ $investment->category }}</td>
                <td>{{ $investment->description }}</td>
                <td>${{ number_format($investment->acquired_value, 2) }}</td>
				<?php $itotal+=$investment->acquired_value ?>
                <td>{{ $investment->acquired_date }}</td>
                <td>${{ number_format($investment->recent_value, 2) }}</td>
				<?php $ivalue+=$investment->recent_value ?>
                <td>{{ $investment->recent_date }}</td>
                </tr>
        @endforeach
		
          </tbody>
        </table>
			<?php 
			echo "Total of Initial Investment Portfolio $";
			echo number_format($itotal, 2);
			?>
		<br>
			<?php
			echo "Total of Current Investment Portfolio $";
			echo number_format($ivalue, 2);
			?>

    </div>
	<br><br>
	<h2>Summary of Portfolio </h2>
		<?php 
		echo "Total of Initial Portfolio Value $";
		$iportfolio = $stotal + $itotal;
		echo number_format($iportfolio, 2);
		?>
	<br>
		<?php
		echo "Total of Current Portfolio Value $";
		$cportfolio = $svalue + $ivalue;		
		echo number_format($cportfolio, 2);
		?>
	<br><br><br>
@stop