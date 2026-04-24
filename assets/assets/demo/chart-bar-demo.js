var canvas = document.getElementById("myBarChart");
var ctx = canvas.getContext("2d");

var dataArray = <?php echo json_encode(array_column($monthly_purchases, 'count') ?: [0,0,0,0,0,0,0,0,0,0,0,0]); ?>;

var allZero = dataArray.every(val => parseFloat(val) === 0);

if (!allZero) {
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
      datasets: [{
        label: "Barang Keluar",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data: dataArray,
      }],
    },
    options: {
      scales: {
        x: { grid: { display: false } },
        y: { beginAtZero: true }
      },
      plugins: {
        legend: { display: false }
      }
    }
  });
} else {
  ctx.fillStyle = '#6c757d';
  ctx.font = '16px Arial';
  ctx.textAlign = 'center';
  ctx.textBaseline = 'middle';
  ctx.fillText('No data barang keluar tersedia', canvas.width / 2, canvas.height / 2);
}