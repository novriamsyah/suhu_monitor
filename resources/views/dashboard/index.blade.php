@extends('layouts.horizontal_dashboard.app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/custom_indikator_temperature.css') }}">
<style>
  .icon-snow {
    color: #87ceeb;
  }
</style>
@endpush

@section('content')

<div class="container-xxl flex-grow-1 container-p-y bg-custom">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light"> </span> Dashboard Monitoring </h4>

  <!-- card mini banner -->
  <div class="row mb-4">
    <div class="col-md-6">
      <div class="card p-4 card-border-shadow-white">
        <div class="row">
          <div class="col-6">
            <h5 class="card-title">Temperature</h5>
            <h1 class="display-4">26.00 °C</h1>
            <p class="text-muted">Cuaca Normal !!</p>
            <i class="fas fa-snowflake fa-3x icon-snow"></i>
          </div>
          <div class="col-6">
            <div class="d-flex h-100 justify-content-center align-items-center pt-2">
              <div id="termometer">
                <div id="temperature" style="height: 67%;" data-value="26°C"></div>
                <div id="graduations">
                  <div></div>
                  <div></div>
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
          <small><i class="far fa-calendar-alt"></i> 04/07/2022</small>
          <p class="card-text"><strong>14:00:25</strong></p>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card p-4 card-border-shadow-white">
        <div class="row">
          <div class="col-6">
            <h5 class="card-title">Humidity</h5>
            <h1 class="display-4" id="humidity-percent">95.00%</h1>
            <p class="text-muted" id="humidity-status">Cuaca Normal !!</p>
            <i class="fas fa-snowflake fa-3x icon-snow mb-3"></i>
          </div>
          <div class="col-6">
            <div class="d-flex h-100 justify-content-center align-items-center pt-2">

              <div class="fu-progress">
                <div class="fu-inner">
                  <!-- <div class="fu-percent percent"><span>50</span>%</div> -->
                  <div class="water"></div>
                  <div class="glare"></div>
                </div>
              </div>

            </div>
          </div>

          <hr>
          <div class="d-flex justify-content-between">
            <small><i class="far fa-calendar-alt"></i> 04/07/2022</small>
            <p class="card-text"><strong>14:00:25</strong></p>
          </div>
        </div>
      </div>
      <!-- <div class="col-sm-6 col-lg-3 mb-4">
      <div class="card card-border-shadow-warning">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2 pb-1">
            <div class="avatar me-2">
              <span class="avatar-initial rounded bg-label-warning"><i class="ti ti-plug-connected ti-md"></i></span>
            </div>
            <h4 class="ms-1 mb-0" id="teganganCard">NaN</h4>
          </div>
          <p class="mb-1">Tegangan Listrik</p>
          <p class="mb-0">
            <small class="text-muted">Tegangan realtime sistem</small>
          </p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="card card-border-shadow-danger">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2 pb-1">
            <div class="avatar me-2">
              <span class="avatar-initial rounded bg-label-danger"><i class="ti ti-bolt ti-md"></i></span>
            </div>
            <h4 class="ms-1 mb-0" id="arusCard">NaN</h4>
          </div>
          <p class="mb-1">Arus Listrik</p>
          <p class="mb-0">
            <small class="text-muted">Arus realtime sistem</small>
          </p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="card card-border-shadow-primary">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2 pb-1">
            <div class="avatar me-2">
              <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-currency-dollar ti-md"></i></span>
            </div>
            <h4 class="ms-1 mb-0" id="sisaCard">NaN</h4>
          </div>
          <p class="mb-1">Sisa Token</p>
          <p class="mb-0">
            <small class="text-muted">Realtime token listrik</small>
          </p>
        </div>
      </div>
    </div> -->
    </div>
    <!-- end card mini banner  -->
  </div>

  @endsection

  @push('plugin-script')
  <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
  @endpush

  @push('script')
  <script>
    function updateTemperature(value) {
      const temperature = document.getElementById('temperature');
      temperature.style.height = `${value}%`;
      temperature.setAttribute('data-value', `${value}°C`);

      // Adjust color dynamically based on temperature
      const color = value > 70 ? '#ff5e57' : value > 40 ? '#f7d794' : '#3dcadf';
      temperature.style.background = `linear-gradient(to top, ${color}, #f7d794)`;
    }

    // Example: Set temperature to 65%
    updateTemperature(40);
  </script>

  <script>
    const humidityValue = 95; // Nilai kelembapan (ganti sesuai kebutuhan)
    const circle = document.querySelector(".progress");
    const labelElement = document.querySelector(".label");

    // Hitung nilai spidometer
    const radius = 80; // Sesuai dengan `r` pada elemen lingkaran
    const circumference = 2 * Math.PI * radius;
    const offset = circumference * ((100 - humidityValue) / 100); // Nilai invers untuk stroke-dasharray

    // Set properti SVG
    circle.setAttribute("r", radius);
    circle.setAttribute("cx", 100);
    circle.setAttribute("cy", 100);
    circle.setAttribute("stroke-dasharray", circumference);
    circle.setAttribute("stroke-dashoffset", offset);

    // Perbarui label
    labelElement.textContent = `${humidityValue.toFixed(2)}%`;
  </script>

  <!-- <script>
  'use strict';

  (function() {
    Chart.register(ChartDataLabels);
    // Color Variables
    const yellowColor = '#ffe800',
      cyanColor = '#28dac6',
      orangeColor = '#FF8132',
      orangeLightColor = '#FDAC34',
      oceanBlueColor = '#299AFF',
      greyColor = '#4F5D70',
      greyLightColor = '#EDF1F4';

    let cardColor, headingColor, labelColor, borderColor, legendColor, blueColor, blueLightColor;
    let redColor, redLightColor, amberColor, amberLightColor, greenLightColor, greenColor, purpleColor, purpleLightColor;

    if (isDarkStyle) {
      cardColor = '#2f3349';
      legendColor = '#b6bee3';
      headingColor = '#cfd3ec';
      labelColor = '#cbd5e1';
      borderColor = '#434968';
      blueColor = '#4d7cff';
      blueLightColor = '#96b9ff';
      redColor = '#f87171';
      redLightColor = '#fecaca';
      amberColor = '#f59e0b';
      amberLightColor = '#fed7aa';
      greenLightColor = '#7CC674';
      greenColor = '#38812F';
      purpleColor = '#8481DD';
      purpleLightColor = '#B2B0EA';

    } else {
      cardColor = '#fff';
      legendColor = '#6f6b7d';
      headingColor = '#5d596c';
      labelColor = '#a5a3ae';
      borderColor = '#dbdade';
      blueColor = '#007bff';
      blueLightColor = '#cce5ff';
      redColor = '#dc3545';
      redLightColor = '#f8d7da';
      amberColor = '#F0AB00';
      amberLightColor = '#F9E0A2';
      greenLightColor = '#BDE2B9';
      greenColor = '#38812F';
      purpleColor = '#5752D1';
      purpleLightColor = '#B2B0EA';
    }

    // Set height according to their data-height
    // --------------------------------------------------------------------
    const chartList = document.querySelectorAll('.chartjs');
    chartList.forEach(function(chartListItem) {
      chartListItem.height = chartListItem.dataset.height;
    });

    // Pie Chart
    // --------------------------------------------------------------------
    // const dayaListrikChart = document.getElementById('dayaListrikChart');
    // dayaListrikChart.height = 450;
    // if (dayaListrikChart) {
    //   const dayaListrikChartVar = new Chart(dayaListrikChart, {
    //     type: 'pie',
    //     data: {
    //       labels: ['Daya Aktif', 'Daya reaktif', 'Daya Semu'],
    //       datasets: [{
    //         data: [],
    //         backgroundColor: [
    //           // '#06C',
    //           // '#002F5D',
    //           // '#8BC1F7',
    //           '#6CA0DC',
    //           '#77DD77',
    //           '#FF6961',
    //         ],
    //         borderWidth: 1
    //       }],
    //     },
    //     options: {
    //       responsive: true,
    //       maintainAspectRatio: false,
    //       plugins: {
    //         legend: {
    //           display: true,
    //           labels: {
    //             usePointStyle: true,
    //             padding: 35,
    //             boxWidth: 6,
    //             boxHeight: 6,
    //             color: labelColor // Ganti dengan variabel `legendColor` sesuai kebutuhan
    //           }
    //         },
    //         datalabels: {
    //           display: true,
    //           align: 'bottom',
    //           backgroundColor: '#F0F0F0',
    //           borderRadius: 3,
    //           font: {
    //             size: 12,
    //           },
    //           formatter: (value, context) => {
    //             const units = ['Watt', 'Var', 'VA'];
    //             const labelIndex = context.dataIndex;
    //             const unit = units[labelIndex];

    //             return value + ' ' + unit;
    //           },
    //         },
    //       },
    //     },
    //   });

    //   let updateChartDayaListrik = function() {
    //     $.ajax({
    //       type: "GET",
    //       dataType: "json",
    //       url: "{{ route('collection.data.sensor.daya') }}",
    //       headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //       },
    //       success: function(data) {
    //         //  console.log(data);
    //         dayaListrikChartVar.data.datasets[0].data = [data.dayaAktif, data.dayaReaktif, data.dayaSemu];
    //         dayaListrikChartVar.update();
    //       },
    //       error: function(data) {
    //         //  console.log(data);
    //       }
    //     });
    //   }
    //   updateChartDayaListrik();
    //   setInterval(() => {
    //     updateChartDayaListrik();
    //   }, 5000);
    // }


    // LineArea Chart
    // --------------------------------------------------------------------

    const energiListrikChart = document.getElementById('energiListrikChart');
    if (energiListrikChart) {
      const energiListrikChartVar = new Chart(energiListrikChart, {
        type: 'line',
        data: {
          labels: [],
          datasets: [{
            label: 'Energi Listrik ( kWh )',
            data: [],
            tension: 0,
            fill: 'start',
            backgroundColor: blueLightColor,
            pointStyle: 'circle',
            borderColor: blueColor,
            pointRadius: 0.5,
            pointHoverRadius: 5,
            pointHoverBorderWidth: 5,
            pointBorderColor: 'transparent',
            pointHoverBackgroundColor: blueLightColor,
            pointHoverBorderColor: cardColor,
            datalabels: {
              align: 'start',
              anchor: 'start',
              color: '#000',
              backgroundColor: '#f5f5f5',
              borderColor: '#000',
              borderRadius: 32,
              borderWidth: 1,
              font: {
                weight: 'bold',
                size: 8
              },
              offset: 1,
              padding: 5,
              textAlign: 'center'
            }
          }, ]
        },
        // plugins: [ChartDataLabels],
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'top',
              rtl: isRtl,
              align: 'start',
              labels: {
                usePointStyle: true,
                padding: 35,
                boxWidth: 6,
                boxHeight: 6,
                color: legendColor
              }
            },
            tooltip: {
              // Updated default tooltip UI
              rtl: isRtl,
              backgroundColor: cardColor,
              titleColor: headingColor,
              bodyColor: legendColor,
              borderWidth: 1,
              borderColor: borderColor
            }
          },
          scales: {
            x: {
              grid: {
                color: 'transparent',
                borderColor: borderColor
              },
              ticks: {
                color: labelColor
              }
            },
            y: {
              grid: {
                color: 'transparent',
                borderColor: borderColor
              },
              ticks: {
                stepSize: 100,
                color: labelColor
              }
            }
          }
        }
      });

      let updateChartEnergiListrik = function() {
        $.ajax({
          type: "GET",
          dataType: "json",
          url: "{{ route('collection.data.sensor') }}",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(data) {
            //  console.log(data);
            energiListrikChartVar.data.labels = data.waktu;
            energiListrikChartVar.data.datasets[0].data = data.energi;
            energiListrikChartVar.update();
          },
          error: function(data) {
            //  console.log(data);
          }
        });
      }
      updateChartEnergiListrik();
      setInterval(() => {
        updateChartEnergiListrik();
      }, 5000);
    }

    const teganganListrikChart = document.getElementById('teganganListrikChart');
    if (teganganListrikChart) {
      const teganganListrikChartVar = new Chart(teganganListrikChart, {
        type: 'line',
        data: {
          labels: [],
          datasets: [{
            label: 'Tegangan Listrik ( V )',
            labelColor: amberColor,
            data: [],
            tension: 0,
            fill: 'start',
            backgroundColor: amberLightColor,
            pointStyle: 'circle',
            borderColor: amberColor,
            pointRadius: 0.5,
            pointHoverRadius: 5,
            pointHoverBorderWidth: 5,
            pointBorderColor: 'transparent',
            pointHoverBackgroundColor: blueColor,
            pointHoverBorderColor: cardColor,
            datalabels: {
              align: 'start',
              anchor: 'start',
              color: '#000',
              backgroundColor: '#f5f5f5',
              borderColor: '#000',
              borderRadius: 32,
              borderWidth: 1,
              font: {
                weight: 'bold',
                size: 8
              },
              offset: 1,
              padding: 5,
              textAlign: 'center'
            }
          }, ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'top',
              rtl: isRtl,
              align: 'start',
              labels: {
                usePointStyle: true,
                padding: 35,
                boxWidth: 6,
                boxHeight: 6,
                color: legendColor
              }
            },
            tooltip: {
              // Updated default tooltip UI
              rtl: isRtl,
              backgroundColor: cardColor,
              titleColor: headingColor,
              bodyColor: legendColor,
              borderWidth: 1,
              borderColor: borderColor
            }
          },
          scales: {
            x: {
              grid: {
                color: 'transparent',
                borderColor: borderColor
              },
              ticks: {
                color: labelColor
              }
            },
            y: {
              min: 150,
              max: 300,
              grid: {
                color: 'transparent',
                borderColor: borderColor
              },
              ticks: {
                color: labelColor
              }
            }
          }
        }
      });

      let updateChartTeganganListrik = function() {
        $.ajax({
          type: "GET",
          dataType: "json",
          url: "{{ route('collection.data.sensor') }}",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(data) {
            //  console.log(data);
            teganganListrikChartVar.data.labels = data.waktu;
            teganganListrikChartVar.data.datasets[0].data = data.tegangan;
            teganganListrikChartVar.update();
          },
          error: function(data) {
            //  console.log(data);
          }
        });
      }
      updateChartTeganganListrik();
      setInterval(() => {
        updateChartTeganganListrik();
      }, 5000);
    }

    const arusListrikChart = document.getElementById('arusListrikChart');
    if (arusListrikChart) {
      const arusListrikChartVar = new Chart(arusListrikChart, {
        type: 'line',
        data: {
          labels: [],
          datasets: [{
            label: 'Arus Listrik ( A )',
            data: [],
            tension: 0,
            fill: 'start',
            backgroundColor: redLightColor,
            pointStyle: 'circle',
            borderColor: redColor,
            pointRadius: 0.5,
            pointHoverRadius: 5,
            pointHoverBorderWidth: 5,
            pointBorderColor: 'transparent',
            pointHoverBackgroundColor: greyLightColor,
            pointHoverBorderColor: cardColor,
            datalabels: {
              align: 'start',
              anchor: 'start',
              color: '#000',
              backgroundColor: '#f5f5f5',
              borderColor: '#000',
              borderRadius: 32,
              borderWidth: 1,
              font: {
                weight: 'bold',
                size: 8
              },
              offset: 1,
              padding: 5,
              textAlign: 'center'
            }
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'top',
              rtl: isRtl,
              align: 'start',
              labels: {
                usePointStyle: true,
                padding: 35,
                boxWidth: 6,
                boxHeight: 6,
                color: legendColor
              }
            },
            tooltip: {
              // Updated default tooltip UI
              rtl: isRtl,
              backgroundColor: cardColor,
              titleColor: headingColor,
              bodyColor: legendColor,
              borderWidth: 1,
              borderColor: borderColor
            }
          },
          scales: {
            x: {
              grid: {
                color: 'transparent',
                borderColor: borderColor
              },
              ticks: {
                color: labelColor
              }
            },
            y: {
              // min: 0,
              // max: 20,
              grid: {
                color: 'transparent',
                borderColor: borderColor
              },
              ticks: {
                color: labelColor
              }
            }
          }
        }
      });
      let updateChartArusListrik = function() {
        $.ajax({
          type: "GET",
          dataType: "json",
          url: "{{ route('collection.data.sensor') }}",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(data) {
            //  console.log(data);
            arusListrikChartVar.data.labels = data.waktu;
            arusListrikChartVar.data.datasets[0].data = data.arus;
            arusListrikChartVar.update();
          },
          error: function(data) {
            //  console.log(data);
          }
        });
      }
      updateChartArusListrik();
      setInterval(() => {
        updateChartArusListrik();
      }, 5000);
    }

    //daya aktif
    const dayaAktifChart = document.getElementById('dayaAktifChart');
    if (dayaAktifChart) {
      const dayaAktifChartVar = new Chart(dayaAktifChart, {
        type: 'line',
        data: {
          labels: [],
          datasets: [{
            label: 'Daya Aktif ( Watt )',
            data: [],
            tension: 0,
            fill: 'start',
            backgroundColor: greenLightColor,
            pointStyle: 'circle',
            borderColor: greenColor,
            pointRadius: 0.5,
            pointHoverRadius: 5,
            pointHoverBorderWidth: 5,
            pointBorderColor: 'transparent',
            pointHoverBackgroundColor: greyLightColor,
            pointHoverBorderColor: cardColor,
            datalabels: {
              align: 'start',
              anchor: 'start',
              color: '#000',
              backgroundColor: '#f5f5f5',
              borderColor: '#000',
              borderRadius: 32,
              borderWidth: 1,
              font: {
                weight: 'bold',
                size: 8
              },
              offset: 1,
              padding: 5,
              textAlign: 'center'
            }
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'top',
              rtl: isRtl,
              align: 'start',
              labels: {
                usePointStyle: true,
                padding: 35,
                boxWidth: 6,
                boxHeight: 6,
                color: legendColor
              }
            },
            tooltip: {
              // Updated default tooltip UI
              rtl: isRtl,
              backgroundColor: cardColor,
              titleColor: headingColor,
              bodyColor: legendColor,
              borderWidth: 1,
              borderColor: borderColor
            }
          },
          scales: {
            x: {
              grid: {
                color: 'transparent',
                borderColor: borderColor
              },
              ticks: {
                color: labelColor
              }
            },
            y: {
              // min: 0,
              // max: 20,
              grid: {
                color: 'transparent',
                borderColor: borderColor
              },
              ticks: {
                color: labelColor
              }
            }
          }
        }
      });
      let updateChartDayaAktif = function() {
        $.ajax({
          type: "GET",
          dataType: "json",
          url: "{{ route('collection.data.sensor') }}",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(data) {
            //  console.log(data);
            dayaAktifChartVar.data.labels = data.waktu;
            dayaAktifChartVar.data.datasets[0].data = data.dayaAktif;
            dayaAktifChartVar.update();
          },
          error: function(data) {
            //  console.log(data);
          }
        });
      }
      updateChartDayaAktif();
      setInterval(() => {
        updateChartDayaAktif();
      }, 5000);
    }

    //frekuensi
    // const frekuensiListrikChart = document.getElementById('frekuensiListrikChart');
    // if (frekuensiListrikChart) {
    //   const frekuensiListrikChartVar = new Chart(frekuensiListrikChart, {
    //     type: 'line',
    //     data: {
    //       labels: [],
    //       datasets: [{
    //         label: 'Frekuensi ( Hz )',
    //         data: [],
    //         tension: 0,
    //         fill: 'start',
    //         backgroundColor: purpleLightColor,
    //         pointStyle: 'circle',
    //         borderColor: purpleColor,
    //         pointRadius: 0.5,
    //         pointHoverRadius: 5,
    //         pointHoverBorderWidth: 5,
    //         pointBorderColor: 'transparent',
    //         pointHoverBackgroundColor: greyLightColor,
    //         pointHoverBorderColor: cardColor,
    //         datalabels: {
    //           align: 'start',
    //           anchor: 'start',
    //           color: '#000',
    //           backgroundColor: '#f5f5f5',
    //           borderColor: '#000',
    //           borderRadius: 32,
    //           borderWidth: 1,
    //           font: {
    //             weight: 'bold',
    //             size: 8
    //           },
    //           offset: 1,
    //           padding: 5,
    //           textAlign: 'center'
    //         }
    //       }]
    //     },
    //     options: {
    //       responsive: true,
    //       maintainAspectRatio: false,
    //       plugins: {
    //         legend: {
    //           position: 'top',
    //           rtl: isRtl,
    //           align: 'start',
    //           labels: {
    //             usePointStyle: true,
    //             padding: 35,
    //             boxWidth: 6,
    //             boxHeight: 6,
    //             color: legendColor,
    //           }
    //         },
    //         tooltip: {
    //           // Updated default tooltip UI
    //           rtl: isRtl,
    //           backgroundColor: cardColor,
    //           titleColor: headingColor,
    //           bodyColor: legendColor,
    //           borderWidth: 1,
    //           borderColor: borderColor
    //         }
    //       },
    //       scales: {
    //         x: {
    //           grid: {
    //             color: 'transparent',
    //             borderColor: borderColor
    //           },
    //           ticks: {
    //             color: labelColor
    //           }
    //         },
    //         y: {
    //           min: 0,
    //           max: 100,
    //           grid: {
    //             color: 'transparent',
    //             borderColor: borderColor
    //           },
    //           ticks: {
    //             color: labelColor
    //           }
    //         }
    //       }
    //     }
    //   });
    //   let updateChartFrekuensiListrik = function() {
    //     $.ajax({
    //       type: "GET",
    //       dataType: "json",
    //       url: "{{ route('collection.data.sensor') }}",
    //       headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //       },
    //       success: function(data) {
    //         //  console.log(data);
    //         frekuensiListrikChartVar.data.labels = data.waktu;
    //         frekuensiListrikChartVar.data.datasets[0].data = data.frekuensi;
    //         frekuensiListrikChartVar.update();
    //       },
    //       error: function(data) {
    //          console.log(data);
    //       }
    //     });
    //   }
    //   updateChartFrekuensiListrik();
    //   setInterval(() => {
    //     updateChartFrekuensiListrik();
    //   }, 5000);
    // }

  })();
</script> -->

  <!-- update data table dashboard -->
  <!-- <script>
  // update table energi listrik
  let updateTableEnergiListrik = function() {
    $.ajax({
      type: "GET",
      dataType: "json",
      url: "{{ route('table.data.sensor') }}",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        let html = '';
        let count = 1;

        if (response.datas != null && response.datas.length > 0) {

          for (let i = 0; i < response.datas.length; i++) {
            let energi = response.datas[i].energi;
            let waktu = response.datas[i].waktu;



            html += '<tr style="font-size:13px;">' +
              '<td>' + count++ + '</td>' +
              '<td>' + energi + ' kWh' + '</td>' +
              '<td>' + waktu + '</td>' +
              '</tr>';
          }
          $('#showTabelEnergi').html(html);
        } else {
          // Opsi untuk menangani jika response.datas kosong atau null
          $('#showTabelEnergi').html('<tr><td colspan="3" align="center">No data available</td></tr>');
        }

        // console.log(html);
      },
      error: function(data) {
        console.log(data);
      }
    })
  }

  updateTableEnergiListrik();
  setInterval(() => {
    updateTableEnergiListrik();
  }, 5000);

  // update table daya listrik
  // let updateTableDayaListrik = function() {
  //   $.ajax({
  //     type: "GET",
  //     dataType: "json",
  //     url: "{{ route('table.data.sensor') }}",
  //     headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     },
  //     success: function(response) {
  //       let html = '';
  //       let count = 1;

  //       if (response.datas != null && response.datas.length > 0) {

  //         for (let i = 0; i < response.datas.length; i++) {
  //           let dy_aktif = response.datas[i].dy_aktif;
  //           let dy_reaktif = response.datas[i].dy_reaktif;
  //           let dy_semu = response.datas[i].dy_semu;
  //           let waktu = response.datas[i].waktu;



  //           html += '<tr style="font-size:12px;">' +
  //             '<td>' + dy_aktif + ' Watt' + '</td>' +
  //             '<td>' + dy_reaktif + ' Var' + '</td>' +
  //             '<td>' + dy_semu + ' VA' + '</td>' +
  //             '<td>' + waktu + '</td>' +
  //             '</tr>';
  //         }
  //         $('#showTabelDaya').html(html);
  //       } else {
  //         // Opsi untuk menangani jika response.datas kosong atau null
  //         $('#showTabelDaya').html('<tr><td colspan="3" align="center">No data available</td></tr>');
  //       }

  //       // console.log(html);
  //     },
  //     error: function(data) {
  //       console.log(data);
  //     }
  //   })
  // }
  // updateTableDayaListrik();
  // setInterval(() => {
  //   updateTableDayaListrik();
  // }, 5000);


  //Update Card Value sensor
  let updateCardValue = function() {
    $.ajax({
      type: "GET",
      dataType: "json",
      url: "{{ route('card.data.sensor') }}",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {

        function formatNumber(value) {
          // Mengubah angka menjadi string dan memotong trailing zeros
          let formattedValue = parseFloat(value).toString();
          return formattedValue;
        }

        $('#energiCard').text(formatNumber(response.data[0].energi) + ' kWh');
        $('#sisaCard').text(formatNumber(response.sisa_token) + ' kWh');
        $('#teganganCard').text(response.data[0].tegangan + ' Volt');
        $('#arusCard').text(response.data[0].arus + ' Ampere');
        $('#biayaCard').text('Rp. ' + response.data[0].biaya);
        $('#valueV').text(response.data[0].tegangan);
        $('#valueI').text(response.data[0].arus);
        $('#valueP').text(response.data[0].dy_aktif);
        $('#valueF').text(response.data[0].frekuensi);
      },
      error: function(error) {
        console.log(error);
      }
    })
  }

  updateCardValue();
  setInterval(() => {
    updateCardValue();
  }, 5000);
</script> -->
  @endpush