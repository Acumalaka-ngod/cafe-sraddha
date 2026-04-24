// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,\"Segoe UI\",Roboto,\"Helvetica Neue\",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Area Chart Example - Penjualan bulanan (barang keluar value)
var ctxArea = document.getElementById(\"myAreaChart\");

// PHP data will be output here
var areaDataArray = typeof window !== 'undefined' ? window.monthlySalesData || [0,0,0,0,0,0,0,0,0,0,0,0] : [0,0,0,0,0,0,0,0,0,0,0,0];

var allZeroArea = areaDataArray.every(function(val) { return parseFloat(val) === 0; });

var myAreaChart;
if (!allZeroArea) {
  myAreaChart = new Chart(ctxArea, {
    type: 'line',
    data: {
      labels: [\"Jan\", \"Feb\", \"Mar\", \"Apr\", \"May\", \"Jun\", \"Jul\", \"Aug\", \"Sep\", \"Oct\", \"Nov\", \"Dec\"],
      datasets: [{
        label: \"Penjualan\",
        lineTension: 0.3,
        backgroundColor: \"rgba(2,117,216,0.2)\",
        borderColor: \"rgba(2,117,216,1)\",
        pointRadius: 5,
        pointBackgroundColor: \"rgba(2,117,216,1)\",
        pointBorderColor: \"rgba(255,255,255,0.8)\",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: \"rgba(2,117,216,1)\",
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: areaDataArray,
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'month'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 12
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            callback: function(value) {
              return 'Rp ' + value.toLocaleString();
            }
          },
          gridLines: {
            color: \"rgba(0, 0, 0, .125)\",
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });
} else {
  var areaCtx2d = ctxArea.getContext('2d');
  areaCtx2d.fillStyle = '#6c757d';
  areaCtx2d.font = '16px Arial';
  areaCtx2d.textAlign = 'center';
  areaCtx2d.textBaseline = 'middle';
  areaCtx2d.fillText('No data penjualan (barang keluar) tersedia', ctxArea.width / 2, ctxArea.height / 2);
}
