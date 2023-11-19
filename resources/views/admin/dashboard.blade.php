@extends('layouts.admin')

@section('title', $title)
@section('breadcrumb', $breadcrumb)

@push('css')
  <style>
    .data .bx-devices:before {
      padding: 4px;
      background-color: rgb(255, 254, 234);
      border-radius: 10px;
      color: rgb(244, 248, 0);
    }

    .data .bx-task {
      padding: 3px;
      background-color: rgb(224, 255, 243);
      border-radius: 10px;
      color: rgb(42, 255, 184);
    }

    .data .bx-collection {
      padding: 3px;
      background-color: rgb(255, 227, 226);
      border-radius: 10px;
      color: rgb(255, 51, 51);
    }

    .data .bx-user-plus {
      padding: 2px;
      background-color: rgb(255, 234, 214);
      border-radius: 10px;
      color: rgb(255, 131, 49);
    }
  </style>
@endpush
@section('content')
  <div class="row">
    <!--/ Total Revenue -->
    <div class="col-12">
      <div class="row data">
        <div class="col-lg-3 col-xs-12 col-sm-12 col-md-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-4 my-auto">

                  <i class="menu-icon tf-icons  bx bx-user-plus" style="font-size:50px;text-align:center;height:100%"></i>
                </div>
                <div class="col-8">
                  <span class="d-block">Users</span>
                  <h3 class="card-title text-nowrap mb-2">0 People</h3>
                  <h3 class="card-title text-nowrap mb-2">0 New</h3>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="col-lg-3 col-xs-12 col-sm-12 col-md-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-4 my-auto">
                  <i class="menu-icon tf-icons bx bx-task bg-transparent-blue"
                    style="font-size:50px;text-align:center;height:100%"></i>
                </div>
                <div class="col-8">
                  <span class="d-block">Show Article</span>
                  <h3 class="card-title text-nowrap mb-2">0 Activity</h3>
                  <h3 class="card-title text-nowrap mb-2">0 User</h3>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="col-lg-3 col-xs-12 col-sm-12 col-md-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-4 my-auto">
                  <i class="menu-icon tf-icons bx bx-task bg-transparent-blue"
                    style="font-size:50px;text-align:center;height:100%"></i>
                </div>
                <div class="col-8">
                  <span class="d-block">Show Ads</span>
                  <h3 class="card-title text-nowrap mb-2">0 Activity</h3>
                  <h3 class="card-title text-nowrap mb-2">0 User</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-12 col-sm-12 col-md-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-4 my-auto">
                  <i class="menu-icon tf-icons bx bx-task bg-transparent-blue"
                    style="font-size:50px;text-align:center;height:100%"></i>
                </div>
                <div class="col-8">
                  <span class="d-block">Test</span>
                  <h3 class="card-title text-nowrap mb-2">0 Activity</h3>
                  <h3 class="card-title text-nowrap mb-2">0 User</h3>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
    <!-- Total Revenue -->
    <div class="col-lg-6 col-12 col-xs-12  mb-4">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-12">
            <h4 class="card-header m-0 me-2 pb-3">User Activity</h4>
            <div id="totalRevenueChart" class="px-2"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-12 col-xs-12  mb-4">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-12">
            <h4 class="card-header m-0 me-2 pb-3">Recently Users Active</h4>
          
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-12 col-xs-12  mb-4">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-12">
            <h4 class="card-header m-0 me-2 pb-3">Best Player</h4>
            <div class="mx-4">
              <select name="" id="category-question2" class="form-control" style="width:200px">
               
              </select>
            </div>

            <div id="best-player" class="my-4">
              <div class="text-center">No Data</div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-12 col-xs-12  mb-4">
        <div class="card">
          <div class="row row-bordered g-0">
            <div class="col-12">
              <h4 class="card-header m-0 me-2 pb-3">Leaderboard</h4>
              <div class="mx-4">
                <select name="" id="category-question" class="form-control" style="width:200px">
                 
                </select>
              </div>

              <div id="leaderboard" class="my-4">
                <div class="text-center">No Data</div>
              </div>

            </div>
          </div>
        </div>
      </div>
  </div>
@endsection

@push('script')
  <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush

@push('js')
  <script>
    (function() {
      let cardColor, headingColor, axisColor, shadeColor, borderColor;

      cardColor = config.colors.white;
      headingColor = config.colors.headingColor;
      axisColor = config.colors.axisColor;
      borderColor = config.colors.borderColor;

      // Total Revenue Report Chart - Bar Chart
      // --------------------------------------------------------------------
      const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
        totalRevenueChartOptions = {
          series: [{
              name: '{{ date('F') }}',
              data: [
                
              ]
            },

          ],
          chart: {
            height: 300,
            stacked: true,
            type: 'bar',
            toolbar: {
              show: false
            }
          },
          plotOptions: {
            bar: {
              horizontal: false,
              columnWidth: '33%',
              borderRadius: 12,
              startingShape: 'rounded',
              endingShape: 'rounded'
            }
          },
          colors: [config.colors.primary, config.colors.info],
          dataLabels: {
            enabled: false
          },
          stroke: {
            curve: 'smooth',
            width: 7,
            lineCap: 'round',
            colors: [cardColor]
          },
          legend: {
            show: true,
            horizontalAlign: 'left',
            position: 'top',
            markers: {
              height: 8,
              width: 8,
              radius: 12,
              offsetX: -3
            },
            labels: {
              colors: axisColor
            },
            itemMargin: {
              horizontal: 10
            }
          },
          grid: {
            borderColor: borderColor,
            padding: {
              top: 0,
              bottom: -8,
              left: 20,
              right: 20
            }
          },
          xaxis: {
            categories: [
              
            ],
            labels: {
              style: {
                fontSize: '13px',
                colors: axisColor
              }
            },
            axisTicks: {
              show: false
            },
            axisBorder: {
              show: false
            }
          },
          yaxis: {
            labels: {
              style: {
                fontSize: '13px',
                colors: axisColor
              }
            }
          },
          responsive: [{
              breakpoint: 1700,
              options: {
                plotOptions: {
                  bar: {
                    borderRadius: 10,
                    columnWidth: '32%'
                  }
                }
              }
            },
            {
              breakpoint: 1580,
              options: {
                plotOptions: {
                  bar: {
                    borderRadius: 10,
                    columnWidth: '35%'
                  }
                }
              }
            },
            {
              breakpoint: 1440,
              options: {
                plotOptions: {
                  bar: {
                    borderRadius: 10,
                    columnWidth: '42%'
                  }
                }
              }
            },
            {
              breakpoint: 1300,
              options: {
                plotOptions: {
                  bar: {
                    borderRadius: 10,
                    columnWidth: '48%'
                  }
                }
              }
            },
            {
              breakpoint: 1200,
              options: {
                plotOptions: {
                  bar: {
                    borderRadius: 10,
                    columnWidth: '40%'
                  }
                }
              }
            },
            {
              breakpoint: 1040,
              options: {
                plotOptions: {
                  bar: {
                    borderRadius: 11,
                    columnWidth: '48%'
                  }
                }
              }
            },
            {
              breakpoint: 991,
              options: {
                plotOptions: {
                  bar: {
                    borderRadius: 10,
                    columnWidth: '30%'
                  }
                }
              }
            },
            {
              breakpoint: 840,
              options: {
                plotOptions: {
                  bar: {
                    borderRadius: 10,
                    columnWidth: '35%'
                  }
                }
              }
            },
            {
              breakpoint: 768,
              options: {
                plotOptions: {
                  bar: {
                    borderRadius: 10,
                    columnWidth: '28%'
                  }
                }
              }
            },
            {
              breakpoint: 640,
              options: {
                plotOptions: {
                  bar: {
                    borderRadius: 10,
                    columnWidth: '32%'
                  }
                }
              }
            },
            {
              breakpoint: 576,
              options: {
                plotOptions: {
                  bar: {
                    borderRadius: 10,
                    columnWidth: '37%'
                  }
                }
              }
            },
            {
              breakpoint: 480,
              options: {
                plotOptions: {
                  bar: {
                    borderRadius: 10,
                    columnWidth: '45%'
                  }
                }
              }
            },
            {
              breakpoint: 420,
              options: {
                plotOptions: {
                  bar: {
                    borderRadius: 10,
                    columnWidth: '52%'
                  }
                }
              }
            },
            {
              breakpoint: 380,
              options: {
                plotOptions: {
                  bar: {
                    borderRadius: 10,
                    columnWidth: '60%'
                  }
                }
              }
            }
          ],
          states: {
            hover: {
              filter: {
                type: 'none'
              }
            },
            active: {
              filter: {
                type: 'none'
              }
            }
          }
        };
      if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
        const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
        totalRevenueChart.render();
      }

      const incomeChartEl = document.querySelector('#incomeChart'),
        incomeChartConfig = {
          series: [{
            name: '{{ date('Y') }}',
            data: []
          }],
          chart: {
            height: 215,
            parentHeightOffset: 0,
            parentWidthOffset: 0,
            toolbar: {
              show: false
            },
            type: 'area'
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            width: 2,
            curve: 'smooth'
          },
          legend: {
            show: false
          },
          //   markers: {
          //     size: 6,
          //     colors: 'transparent',
          //     strokeColors: 'transparent',
          //     strokeWidth: 4,
          //     discrete: [{
          //       fillColor: config.colors.white,
          //       seriesIndex: 0,
          //       dataPointIndex: 3,
          //       strokeColor: config.colors.primary,
          //       strokeWidth: 2,
          //       size: 6,
          //       radius: 8
          //     }],
          //     hover: {
          //       size: 7
          //     }
          //   },
          colors: [config.colors.primary],
          fill: {
            type: 'gradient',
            gradient: {
              shade: shadeColor,
              shadeIntensity: 0.6,
              opacityFrom: 0.5,
              opacityTo: 0.25,
              stops: [0, 95, 100]
            }
          },
          grid: {
            borderColor: borderColor,
            strokeDashArray: 3,
            padding: {
              top: -20,
              bottom: -8,
              left: -10,
              right: 8
            }
          },
          xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            axisBorder: {
              show: false
            },
            axisTicks: {
              show: false
            },
            labels: {
              show: true,
              style: {
                fontSize: '13px',
                colors: axisColor
              }
            }
          },
          yaxis: {
            labels: {
              //   show: false
            },
            // min: 10,
            // max: 50,
            // tickAmount: 4
          }
        };
      if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
        const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
        incomeChart.render();
      }

      // Expenses Mini Chart - Radial Chart
      // --------------------------------------------------------------------

      $('#category-question').on('change', function() {
        $.ajax({
          url: "/leaderboard?category_id=" + $(this).val(),
          type: "GET",
          success: function(data) {
            if (data.data.length < 0) {
              $('#leaderboard').empty();
              $('#leaderboard').append('<div class="text-center">No Data</div>');
            } else {
              $('#leaderboard').empty();
              let html = '';
              $.each(data.data, function(index, item) {
                html += '<div class="my-3 mx-4">';
                html += '<div class="card p-2">';
                html += '<div class="row">';
                html += '<div class="col-1 my-auto" style="font-size:20px;margin-left:10px">';
                html += (index + 1);
                html += '</div>';
                html += '<div class="col-2">';
                html += '<img src="' + item.image_url + '" alt="user" class="rounded-circle" width="50">';
                html += '</div>';
                html += '<div class="col-4 my-auto">' + item.name + '</div>';
                html += '<div class="col-4 my-auto text-end">' + item.score + ' | ' + item.duration + 'S</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
              });
              $('#leaderboard').append(html);
            }
          }
        })
      })

      $('#category-question2').on('change', function() {
        $.ajax({
          url: "/api/best-player/" + $(this).val(),
          type: "GET",
          success: function(data) {
            if (data.data.length < 0) {
              $('#best-player').empty();
              $('#best-player').append('<div class="text-center">No Data</div>');
            } else {
              $('#best-player').empty();
              let html = '';
              $.each(data.data, function(index, item) {
                html += '<div class="my-3 mx-4">';
                html += '<div class="card p-2">';
                html += '<div class="row">';
                html += '<div class="col-1 my-auto" style="font-size:20px;margin-left:10px">';
                html += (index + 1);
                html += '</div>';
                html += '<div class="col-2">';
                html += '<img src="' + item.image_url + '" alt="user" class="rounded-circle" width="50">';
                html += '</div>';
                html += '<div class="col-4 my-auto">' + item.name + '</div>';
                let category = item.group_category.filter(function(item) {
                  return item.id ==  ($('#category-question2').val());
                });

                console.log(category)
                //rounded
                let total = category[0].correct/category[0].total_question*100;
                let rounded = Math.round(total);
                html += '<div class="col-4 my-auto text-end">' + rounded + '%</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
              });
              $('#best-player').append(html);
            }
          }
        })
      })
    })();

    $(document).ready(function() {
      $('#category-question').trigger('change');
      $('#category-question2').trigger('change');
    })
  </script>
@endpush
