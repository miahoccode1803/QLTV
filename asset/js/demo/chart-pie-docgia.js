// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

var trangthai = [];
var soLuong = [];


$.ajax({
  url: 'index.php?controller=thongkesach&action=datadgpie',
  type: 'GET',
  success: function(data) {
      // Parse dữ liệu JSON
      var result = JSON.parse(data);


      // In dữ liệu ra console
      trangthai = result.map(function(item) {
        return item.TrangThai;
      });
      soLuong = result.map(function(item) {
          return item.SoLuong;
      });

      console.log(trangthai);
      console.log(soLuong);

      // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: trangthai,
            datasets: [{
            data: soLuong,
            backgroundColor: ['#e74a3b', '#1cc88a',  '#36b9cc'],
            hoverBackgroundColor: ['#c82f21', '#17a673',  '#2c9faf'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            },
            legend: {
            display: false
            },
            cutoutPercentage: 80,
        },
        });

    }
});