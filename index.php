<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カレンダー</title>
    <link rel="stylesheet" href="style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>

<body class="container">
	<?php
	include 'calendar.php';
	$calendar = new Calendar();
 
	echo $calendar->show();
	?>
	
	<!-- <table>
		<caption>
            <div class="caption">
                <a class="prev-btn" href=""><</a> 
                <h3 class="year-month">January 2021</h3>
                <a class="next-btn" href="">></a> 
            </div>
        </caption>

		<thead>
			<tr>
				<th class="sundays">Sun</th>
				<th>Mon</th>
				<th>Tue</th>
				<th>Wed</th>
				<th>Thu</th>
				<th>Fri</th>
				<th class="saturdays">Sat</th>
			</tr>
		</thead>
		
		<tbody>
			<tr>
				<td class="sundays"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>1</td>
				<td class="saturdays">2</td>
			</tr>
			<tr>
				<td class="sundays">3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td>
				<td>8</td>
				<td class="saturdays">9</td>
			</tr>
			<tr>
				<td class="sundays">10</td>
				<td>11</td>
				<td>12</td>
				<td>13</td>
				<td>14</td>
				<td>15</td>
				<td class="saturdays">16</td>
			</tr>
			<tr>
				<td class="sundays">17</td>
				<td>18</td>
				<td>19</td>
				<td>20</td>
				<td>21</td>
				<td>22</td>
				<td class="saturdays">23</td>
			</tr>
			<tr>
				<td class="sundays">24</td>
				<td>25</td>
				<td>26</td>
				<td>27</td>
				<td>28</td>
				<td>29</td>
				<td class="saturdays">30</td>
			</tr>
			<tr>
				<td class="sundays">31</td>
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td class="saturdays">6</td>
			</tr>
		</tbody>
	</table> -->

</body>

</html>
