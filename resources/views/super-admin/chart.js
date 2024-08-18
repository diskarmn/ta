// Get the select element for the year
// Function to update charts based on selected year
function updateCharts(selectedYear) {
  // Make an API request to get the data for the selected year
  fetch(`/api/data?year=${selectedYear}`)
    .then(response => response.json())
    .then(data => {
      // Update the line chart with the new data
      updateLineChart(data.penjualan);

      // Update the donut chart with the new data
      updateDonutChart(data.donut);
    });
}

// Function to update line chart
function updateLineChart(penjualanData) {
  const lineChartOptions = {
    low: 0,
    showArea: true,
    showPoint: false,
    fullWidth: true,
    plugins: [
      Chartist.plugins.ctPointLabels({
        textAnchor: 'middle',
        labelOffset: {
          x: 0,
          y: -20
        }
      })
    ]
  };

  const lineChart = new Chartist.Line('#chart-penjualan', penjualanData, lineChartOptions);
}

// Function to update donut chart
function updateDonutChart(donutData) {
  const donutChartOptions = {
    donut: true,
    donutWidth: 60,
    startAngle: 270,
    total: 100,
    labelInterpolationFnc: value => value + '%'
  };

  const donutChart = new Chartist.Pie('#chart-donut', donutData, donutChartOptions);
}

// Event listener for the select element
const selectYear = document.querySelector('#tahun');

selectYear.addEventListener('change', () => {
  const selectedYear = selectYear.value;
  updateCharts(selectedYear);
});

// Initialize charts with default data
const defaultLineChartData = {
  labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
  series: [
    [1200, 1500, 1000, 2000, 1500, 2400, 2200, 1800, 1500, 2000, 1800, 2100],
    [800, 1200, 700, 1600, 1100, 1900, 1700, 1300, 1000, 1400, 1200, 1500],
    [500, 800, 500, 1200, 800, 1400, 1200, 900, 700, 1000, 800, 1100]
  ]
};

const defaultDonutChartData = {
  series: [5, 3, 4]
};

updateLineChart(defaultLineChartData);
updateDonutChart(defaultDonutChartData);





// dari bs5

$(function () {


  // =====================================
  // Profit
  // =====================================
  var chart = {
    series: [
      { name: "Earnings this month:", data: [355, 390, 300, 350, 390, 180, 355, 390] },
      { name: "Expense this month:", data: [280, 250, 325, 215, 250, 310, 280, 250] },
    ],

    chart: {
      type: "bar",
      height: 345,
      offsetX: -15,
      toolbar: { show: true },
      foreColor: "#adb0bb",
      fontFamily: 'inherit',
      sparkline: { enabled: false },
    },


    colors: ["#5D87FF", "#49BEFF"],


    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "35%",
        borderRadius: [6],
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'all'
      },
    },
    markers: { size: 0 },

    dataLabels: {
      enabled: false,
    },


    legend: {
      show: false,
    },


    grid: {
      borderColor: "rgba(0,0,0,0.1)",
      strokeDashArray: 3,
      xaxis: {
        lines: {
          show: false,
        },
      },
    },

    xaxis: {
      type: "category",
      categories: ["16/08", "17/08", "18/08", "19/08", "20/08", "21/08", "22/08", "23/08"],
      labels: {
        style: { cssClass: "grey--text lighten-2--text fill-color" },
      },
    },


    yaxis: {
      show: true,
      min: 0,
      max: 400,
      tickAmount: 4,
      labels: {
        style: {
          cssClass: "grey--text lighten-2--text fill-color",
        },
      },
    },
    stroke: {
      show: true,
      width: 3,
      lineCap: "butt",
      colors: ["transparent"],
    },


    tooltip: { theme: "light" },

    responsive: [
      {
        breakpoint: 600,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 3,
            }
          },
        }
      }
    ]


  };

  var chart = new ApexCharts(document.querySelector("#chart"), chart);
  chart.render();


  // =====================================
  // Breakup
  // =====================================
  var breakup = {
    color: "#adb5bd",
    series: [38, 40, 25],
    labels: ["2022", "2021", "2020"],
    chart: {
      width: 180,
      type: "donut",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    plotOptions: {
      pie: {
        startAngle: 0,
        endAngle: 360,
        donut: {
          size: '75%',
        },
      },
    },
    stroke: {
      show: false,
    },

    dataLabels: {
      enabled: false,
    },

    legend: {
      show: false,
    },
    colors: ["#5D87FF", "#ecf2ff", "#F9F9FD"],

    responsive: [
      {
        breakpoint: 991,
        options: {
          chart: {
            width: 150,
          },
        },
      },
    ],
    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },
  };

  var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
  chart.render();



  // =====================================
  // Earning
  // =====================================
  var earning = {
    chart: {
      id: "sparkline3",
      type: "area",
      height: 60,
      sparkline: {
        enabled: true,
      },
      group: "sparklines",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        name: "Earnings",
        color: "#49BEFF",
        data: [25, 66, 20, 40, 12, 58, 20],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      colors: ["#f3feff"],
      type: "solid",
      opacity: 0.05,
    },

    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: false,
      },
    },
  };
  new ApexCharts(document.querySelector("#earning"), earning).render();
})