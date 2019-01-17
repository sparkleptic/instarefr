<!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
<!-- jQuery -->
    
    <!-- Bootstrap -->
    <script src="<?php echo ADMIN_ASSET; ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
   <!--  <script src="<?php //echo ADMIN_ASSET; ?>vendors/fastclick/lib/fastclick.js"></script> -->
    <!-- NProgress -->
    <script src="<?php echo ADMIN_ASSET; ?>vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
   <!--  <script src="<?php //echo ADMIN_ASSET; ?>vendors/Chart.js/dist/Chart.min.js"></script> -->
    <!-- jQuery Sparklines -->
    <!-- <script src="<?php //echo ADMIN_ASSET; ?>vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script> -->

     <!-- Datatables -->
    <script src="<?php echo ADMIN_ASSET; ?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo ADMIN_ASSET; ?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo ADMIN_ASSET; ?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo ADMIN_ASSET; ?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo ADMIN_ASSET; ?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo ADMIN_ASSET; ?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo ADMIN_ASSET; ?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    
    <script src="<?php echo ADMIN_ASSET; ?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo ADMIN_ASSET; ?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
   <!--  <script src="<?php echo ADMIN_ASSET; ?>vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
     -->
   

    <!-- Flot
    <script src="<?php //echo ADMIN_ASSET; ?>vendors/Flot/jquery.flot.js"></script>
    <script src="<?php //echo ADMIN_ASSET; ?>vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php //echo ADMIN_ASSET; ?>vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php //echo ADMIN_ASSET; ?>vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php //echo ADMIN_ASSET; ?>vendors/Flot/jquery.flot.resize.js"></script> -->
    <!-- Flot plugins 
    <script src="<?php echo ADMIN_ASSET; ?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>-->
   <!--  <script src="<?php //echo ADMIN_ASSET; ?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php //echo ADMIN_ASSET; ?>vendors/flot.curvedlines/curvedLines.js"></script> -->
    <!-- DateJS -->
    <script src="<?php echo ADMIN_ASSET; ?>vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo ADMIN_ASSET; ?>vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo ADMIN_ASSET; ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo ADMIN_ASSET; ?>build/js/custom.min.js"></script>

    <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {
        $('#birthday').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->
    
     <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>

    <!-- Flot -->
    <script>
      $(document).ready(function() {
        //define chart clolors ( you maybe add more colors if you want or flot will add it automatic )
        var chartColours = ['#96CA59', '#3F97EB', '#72c380', '#6f7a8a', '#f7cb38', '#5a8022', '#2c7282'];

        //generate random number for charts
        randNum = function() {
          return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
        };

        var d1 = [];
        //var d2 = [];

        //here we generate data for chart
        for (var i = 0; i < 30; i++) {
          d1.push([new Date(Date.today().add(i).days()).getTime(), randNum() + i + i + 10]);
          //    d2.push([new Date(Date.today().add(i).days()).getTime(), randNum()]);
        }

        var chartMinDate = d1[0][0]; //first day
        var chartMaxDate = d1[20][0]; //last day

        var tickSize = [1, "day"];
        var tformat = "%d/%m/%y";

        //graph options
        var options = {
          grid: {
            show: true,
            aboveData: true,
            color: "#3f3f3f",
            labelMargin: 10,
            axisMargin: 0,
            borderWidth: 0,
            borderColor: null,
            minBorderMargin: 5,
            clickable: true,
            hoverable: true,
            autoHighlight: true,
            mouseActiveRadius: 100
          },
          series: {
            lines: {
              show: true,
              fill: true,
              lineWidth: 2,
              steps: false
            },
            points: {
              show: true,
              radius: 4.5,
              symbol: "circle",
              lineWidth: 3.0
            }
          },
          legend: {
            position: "ne",
            margin: [0, -25],
            noColumns: 0,
            labelBoxBorderColor: null,
            labelFormatter: function(label, series) {
              // just add some space to labes
              return label + '&nbsp;&nbsp;';
            },
            width: 40,
            height: 1
          },
          colors: chartColours,
          shadowSize: 0,
          tooltip: true, //activate tooltip
          tooltipOpts: {
            content: "%s: %y.0",
            xDateFormat: "%d/%m",
            shifts: {
              x: -30,
              y: -50
            },
            defaultTheme: false
          },
          yaxis: {
            min: 0
          },
          xaxis: {
            mode: "time",
            minTickSize: tickSize,
            timeformat: tformat,
            min: chartMinDate,
            max: chartMaxDate
          }
        };
        // var plot = $.plot($("#placeholder33x"), [{
        //   label: "Email Sent",
        //   data: d1,
        //   lines: {
        //     fillColor: "rgba(150, 202, 89, 0.12)"
        //   }, //#96CA59 rgba(150, 202, 89, 0.42)
        //   points: {
        //     fillColor: "#fff"
        //   }
        // }], options);
      });
    </script>
    <!-- /Flot -->

    <!-- jQuery Sparklines -->
    <script>
      $(document).ready(function() {
        // $(".sparkline_one").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 4, 5, 6, 3, 5, 4, 5, 4, 5, 4, 3, 4, 5, 6, 7, 5, 4, 3, 5, 6], {
        //   type: 'bar',
        //   height: '125',
        //   barWidth: 13,
        //   colorMap: {
        //     '7': '#a1a1a1'
        //   },
        //   barSpacing: 2,
        //   barColor: '#26B99A'
        // });

        // $(".sparkline11").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 6, 2, 4, 3, 4, 5, 4, 5, 4, 3], {
        //   type: 'bar',
        //   height: '40',
        //   barWidth: 8,
        //   colorMap: {
        //     '7': '#a1a1a1'
        //   },
        //   barSpacing: 2,
        //   barColor: '#26B99A'
        // });

        // $(".sparkline22").sparkline([2, 4, 3, 4, 7, 5, 4, 3, 5, 6, 2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 6], {
        //   type: 'line',
        //   height: '40',
        //   width: '200',
        //   lineColor: '#26B99A',
        //   fillColor: '#ffffff',
        //   lineWidth: 3,
        //   spotColor: '#34495E',
        //   minSpotColor: '#34495E'
        // });
      });
    </script>
    <!-- /jQuery Sparklines -->

    <!-- Doughnut Chart -->
    <script>
      $(document).ready(function() {
        var canvasDoughnut,
            options = {
              legend: false,
              responsive: false
            };

        
      });
    </script>
    <!-- /Doughnut Chart -->

    <!-- bootstrap-daterangepicker -->
    <script type="text/javascript">
      $(document).ready(function() {

        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->
  </body>
</html>