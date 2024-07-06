(function ($) {
  "use strict";
  $(function () {
    if ($("#dashboard-guage-chart").length) {
      var g3 = new JustGage({
        id: "dashboard-guage-chart",
        value: 0, // Initial value
        min: -100,
        max: 100,
        symbol: "°C",
        pointer: true,
        gaugeWidthScale: 1,
        customSectors: [
          {
            color: "#00ff00", // Green
            lo: 30,
            hi: 35,
          },
          {
            color: "#ffff00", // Yellow
            lo: 35,
            hi: 45,
          },
          {
            color: "#ff0000", // Red
            lo: 45,
            hi: 100,
          },
        ],
        counter: true,
      });

      // Function to update the gauge value
      function updateGauge(newValue) {
        g3.refresh(newValue);
      }

      // Function to fetch temperature from API
      function fetchTemperature() {
        $.ajax({
          url: "http://192.168.71.39/tugasakhir/next/src/insert_temperature.php", // Update with the correct path to your PHP script
          method: "GET",
          dataType: "json",
          success: function (data) {
            if (data && data.temperature !== null) {
              updateGauge(data.temperature);
            }
          },
          error: function (xhr, status, error) {
            console.error("Error fetching temperature data:", error);
          },
        });
      }

      // Fetch temperature every 2 seconds
      setInterval(fetchTemperature, 1000);
    }
  });
})(jQuery);
