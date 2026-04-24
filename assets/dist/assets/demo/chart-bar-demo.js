// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.font.family = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji';
Chart.defaults.color = '#212529';


// Bar Chart Example
var ctx = document.getElementById('myBarChart');
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June'],
    datasets: [{
      label: 'Earnings',
      backgroundColor: '#4e73df',
      hoverBackgroundColor: '#2e59d9',
      borderColor: '#4e73df',
      data: [10000, 15000, 12500, 20000, 17500, 22500],
    }],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
