<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		table {
  border-collapse: collapse;
  width: 100%;
}

table td,
table th {
  border: 1px solid #ddd;
  padding: 8px;
}

table tr:nth-child(even) {
  background-color: #f2f2f2;
}

table tr:hover {
  background-color: #ddd;
}

table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}

	</style>
</head>
<body>
<p><b>Update data dalam: <span id="timer">0</span> Detik</b></p>
<table id="coins">
  <tr>
  	<th>No</th>
    <th>Pairs</th>
    <th>Harga</th>
    <th>Beli</th>
    <th>jual</th>
    <th>Tertinggi 24h</th>
    <th>Terendah 24h</th>
  </tr>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
	var reloadData = 30; // dalam detik

var timer;

function updateDataAPI() {

  $.ajax({
    url: 'https://indodax.com/api/summaries',
    success: function(data) {
      var row;
      var no = 0;
      $('#coins').html('<tr><th>Pairs</th><th>Harga</th> <th>Beli</th> <th>jual</th> <th>Tertinggi 24h</th><th>Terendah 24h</th></tr>')
      for (var key in data.tickers) {
      	no = no + 1;
        row = '<tr><td>'+no+'</td><td><a href="http://localhost/indodax/auth/crypto/'+key.toUpperCase()+'" target=_blank>' + key.toUpperCase() + '</a></td><td>' + formatNumber(data.tickers[key].last) + '</td><td>' + formatNumber(data.tickers[key].buy) + '</td><td>' + formatNumber(data.tickers[key].sell) + '</td><td>' + formatNumber(data.tickers[key].high) + '</td><td>' + formatNumber(data.tickers[key].low) + '</td></tr>'
        $('#coins tr:last').after(row);
      }

      clearTimeout(timer)
      $('#timer').html(reloadData)
      setTimeout(updateDataAPI, reloadData * 1000)
      updateTimer()
    },
    error: function(err) {
      alert("Tidak bisa mengambil data API")
    }
  })
}

function formatNumber(n) {
  if (n.indexOf('.') > -1)
    return parseFloat(n).toFixed(8);
  else
    return parseInt(n).toLocaleString("id-ID")
}

function updateTimer() {
  a = parseInt($('#timer').html())
  $('#timer').html(a - 1)
  if (a > 0)
    timer = setTimeout(updateTimer, 1000)
}
updateDataAPI()

</script>
</body>
</html>