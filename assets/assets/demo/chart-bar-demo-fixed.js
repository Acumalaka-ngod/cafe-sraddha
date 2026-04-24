// Bar Chart Example - Jumlah Barang Keluar bulanan
var ctxBar = document.getElementById(\"myBarChart\");

// PHP data will be output here
var barDataArray = typeof window !== 'undefined' ? window.monthlyPurchasesData || [0,0,0,0,0,0,0,0,0,0,0,0] : [0,0,0,0,0,0,0,0,0,0,0,0];

var allZeroBar = barDataArray.every(function(val) { return parseFloat(val) === 0; });

var myBarChart;
if (!allZeroBar) {
  myBarChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
      labels: [\"Jan\", \"Feb\", \"Mar\", \"Apr\", \"May\", \"Jun\", \"Jul\", \"Aug\", \"Sep\", \"Oct\", \"Nov\", \"Dec\"],
      datasets: [{
        label: \"Barang Keluar\",
        backgroundColor: \"rgba(2,117,216,1)\",
        borderColor: \"rgba(2,117,216,1)\",
        data: barDataArray,
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
            maxTicksLimit: 5
          },
          gridLines: {
            display: true
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });
} else {
  var barCtx2d = ctxBar.getContext('2d');
  barCtx2d.fillStyle = '#6c757d';
  barCtx2d.font = '16px Arial';
  barCtx2d.textAlign = 'center';
  barCtx2d.textBaseline = 'middle';
  barCtx2d.fillText('No data barang keluar tersedia', ctxBar.width / 2, ctxBar.height / 2);
}
