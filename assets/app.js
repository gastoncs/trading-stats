
import './styles/app.scss';

$(window).on('load', function()  {

    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(dayOneCharts);
    google.charts.setOnLoadCallback(dayTwoCharts);
    google.charts.setOnLoadCallback(dayThreeCharts);

    function dayOneCharts() {

        google.charts.load('current', {

            callback: function () {

                var otoH = parseFloat($("#avgOtohGreater0First").text())/100;
                var OtoL = parseFloat($("#avgOtolLower0First").text())/100;
                var EOD = parseFloat($("#avgEodFirst").text())/100;

                var data = google.visualization.arrayToDataTable([
                    ["Element", "Avgerage", { role: "style" } ],
                    ["OtoH",otoH , "#f9cb9c"],
                    ["OtoL", OtoL, "#b6d7a8"],
                    ["EOD", EOD, "#ea9999"]
                ]);

                var view = new google.visualization.DataView(data);

                var formatPercent = new google.visualization.NumberFormat({
                    pattern: '#,##0.0%'
                });

                view.setColumns([0, 1, {
                    calc: function (dt, row) {
                        var percent = formatPercent.formatValue(dt.getValue(row, 1));
                        return percent;
                    },
                    sourceColumn: 1,
                    type: 'string',
                    role: 'annotation'
                },2]);

                var options = {
                    legend: { position: "none" },
                    chart: {
                        title: 'Resumen General',
                        subtitle: 'programados v/s terminados'
                    },
                    series: {},
                    axes: {
                        y: {
                            distance: {label: ''},
                        }
                    },
                    chartArea : {
                        width:"95%",
                        height:"80%"
                    },
                    theme: 'material'
                };
                // var formatPercent = new google.visualization.NumberFormat({
                //     pattern: '#,##0.0%'
                // });

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_ticker_avg_first'));
                chart.draw(view, options);
            },
            packages:['corechart']
        });


        // CHART 2 -------------------------------------------------------

         var data = new google.visualization.DataTable();

        // Add columns
        data.addColumn('date', 'Date');
        data.addColumn('number', 'eod');
        data.addColumn('number', 'otoh');
        data.addColumn('number', 'otol');

        var $rows = $('#ticker-performance tbody tr').length;

        data.addRows($rows);

        var rowNum = 0;

        //run through each row
        $('#ticker-performance tbody tr').each(function (i, row) {

            // reference all the stuff you need first
            var $dateArr = $(this).find('td.date-per').text().split("/");

            var $date = new Date($dateArr[2], $dateArr[1], $dateArr[0]);

            var $eod =  parseFloat($(this).find('td.eod-per').text()) / 100;
            var $otoh = parseFloat($(this).find('td.otoh-per').text()) / 100;
            var $otol = parseFloat($(this).find('td.otol-per').text()) / 100;

            // Add empty rows
            data.setCell(rowNum, 0, $date);
            data.setCell(rowNum, 1, $eod);
            data.setCell(rowNum, 2, $otoh);
            data.setCell(rowNum, 3, $otol);

            rowNum++;
        });

        var options = {
            title: 'Ticker Performance',
            curveType: 'function',
            legend: { position: 'bottom' },
            chartArea : {
                width:"80%",
                height:"80%"
            },
            colors: ['#ea9999','#f9cb9c', '#b6d7a8']
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_ticker_performance_first'));

        chart.draw(data, options);
    }

    function dayTwoCharts() {

        google.charts.load('current', {

            callback: function () {

                var otoH = parseFloat($("#avgOtohGreater0Second").text())/100;
                var OtoL = parseFloat($("#avgOtolLower0Second").text())/100;
                var EOD = parseFloat($("#avgEodSecond").text())/100;

                var data = google.visualization.arrayToDataTable([
                    ["Element", "Avgerage", { role: "style" } ],
                    ["OtoH",otoH , "#f9cb9c"],
                    ["OtoL", OtoL, "#b6d7a8"],
                    ["EOD", EOD, "#ea9999"]
                ]);

                var view = new google.visualization.DataView(data);

                var formatPercent = new google.visualization.NumberFormat({
                    pattern: '#,##0.0%'
                });

                view.setColumns([0, 1, {
                    calc: function (dt, row) {
                        var percent = formatPercent.formatValue(dt.getValue(row, 1));
                        return percent;
                    },
                    sourceColumn: 1,
                    type: 'string',
                    role: 'annotation'
                },2]);

                var options = {
                    legend: { position: "none" },
                    chart: {
                        title: 'Resumen General',
                        subtitle: 'programados v/s terminados'
                    },
                    series: {},
                    axes: {
                        y: {
                            distance: {label: ''},
                        }
                    },
                    chartArea : {
                        width:"95%",
                        height:"80%"
                    },
                    theme: 'material'
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_ticker_avg_second'));
                chart.draw(view, options);
            },
            packages:['corechart']
        });


        // CHART 2 -------------------------------------------------------

        var data = new google.visualization.DataTable();

        // Add columns
        data.addColumn('date', 'Date');
        data.addColumn('number', 'eod');
        data.addColumn('number', 'otoh');
        data.addColumn('number', 'otol');

        var $rows = $('#ticker-performance-second tbody tr').length;

        data.addRows($rows);

        var rowNum = 0;

        //run through each row
        $('#ticker-performance-second tbody tr').each(function (i, row) {

            // reference all the stuff you need first
            var $dateArr = $(this).find('td.date-per-sec').text().split("/");

            var $date = new Date($dateArr[2], $dateArr[1], $dateArr[0]);

            var $eod =  parseFloat($(this).find('td.eod-per-sec').text()) / 100;
            var $otoh = parseFloat($(this).find('td.otoh-per-sec').text()) / 100;
            var $otol = parseFloat($(this).find('td.otol-per-sec').text()) / 100;

            // Add empty rows
            data.setCell(rowNum, 0, $date);
            data.setCell(rowNum, 1, $eod);
            data.setCell(rowNum, 2, $otoh);
            data.setCell(rowNum, 3, $otol);

            rowNum++;
        });

        var options = {
            title: 'Ticker Performance',
            curveType: 'function',
            legend: { position: 'bottom' },
            chartArea : {
                width:"80%",
                height:"80%"
            },
            colors: ['#ea9999','#f9cb9c', '#b6d7a8']
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_ticker_performance_second'));

        chart.draw(data, options);
    }

    function dayThreeCharts() {

        google.charts.load('current', {

            callback: function () {

                var otoH = parseFloat($("#avgOtohGreater0Third").text())/100;
                var OtoL = parseFloat($("#avgOtolLower0Third").text())/100;
                var EOD = parseFloat($("#avgEodThird").text())/100;

                var data = google.visualization.arrayToDataTable([
                    ["Element", "Avgerage", { role: "style" } ],
                    ["OtoH",otoH , "#f9cb9c"],
                    ["OtoL", OtoL, "#b6d7a8"],
                    ["EOD", EOD, "#ea9999"]
                ]);

                var view = new google.visualization.DataView(data);

                var formatPercent = new google.visualization.NumberFormat({
                    pattern: '#,##0.0%'
                });

                view.setColumns([0, 1, {
                    calc: function (dt, row) {
                        var percent = formatPercent.formatValue(dt.getValue(row, 1));
                        return percent;
                    },
                    sourceColumn: 1,
                    type: 'string',
                    role: 'annotation'
                },2]);

                var options = {
                    legend: { position: "none" },
                    chart: {
                        title: 'Resumen General',
                        subtitle: 'programados v/s terminados'
                    },
                    series: {},
                    axes: {
                        y: {
                            distance: {label: ''},
                        }
                    },
                    chartArea : {
                        width:"95%",
                        height:"80%"
                    },
                    theme: 'material'
                };
                // var formatPercent = new google.visualization.NumberFormat({
                //     pattern: '#,##0.0%'
                // });

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_ticker_avg_third'));
                chart.draw(view, options);
            },
            packages:['corechart']
        });


        // CHART 2 -------------------------------------------------------

        var data = new google.visualization.DataTable();

        // Add columns
        data.addColumn('date', 'Date');
        data.addColumn('number', 'eod');
        data.addColumn('number', 'otoh');
        data.addColumn('number', 'otol');

        var $rows = $('#ticker-performance-third tbody tr').length;

        data.addRows($rows);

        var rowNum = 0;

        //run through each row
        $('#ticker-performance-third tbody tr').each(function (i, row) {

            // reference all the stuff you need first
            var $dateArr = $(this).find('td.date-per-third').text().split("/");

            var $date = new Date($dateArr[2], $dateArr[1], $dateArr[0]);

            var $eod =  parseFloat($(this).find('td.eod-per-third').text()) / 100;
            var $otoh = parseFloat($(this).find('td.otoh-per-third').text()) / 100;
            var $otol = parseFloat($(this).find('td.otol-per-third').text()) / 100;

            // Add empty rows
            data.setCell(rowNum, 0, $date);
            data.setCell(rowNum, 1, $eod);
            data.setCell(rowNum, 2, $otoh);
            data.setCell(rowNum, 3, $otol);

            rowNum++;
        });

        var options = {
            title: 'Ticker Performance',
            curveType: 'function',
            legend: { position: 'bottom' },
            chartArea : {
                width:"80%",
                height:"80%"
            },
            colors: ['#ea9999','#f9cb9c', '#b6d7a8']
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_ticker_performance_third'));

        chart.draw(data, options);
    }
});
