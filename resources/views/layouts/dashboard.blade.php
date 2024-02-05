<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-chart-area'></i> Welcome to <span class='fw-300'>Dashboard</span>
    </h1>
</div>

<div class="row">
    <div class="col-sm-6 col-xl-6">
        <div class="p-3 bg-info-400 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    <label for="visitorTotal" id="visitorTotal"></label>
                    <small class="m-0 l-h-n">Total Visitors</small>
                </h3>
            </div>
            <i class="fal fa-eye position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4"
                style="font-size: 6rem;"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-6">
        <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    <label for="articleTotal" id="articleTotal"></label>
                    <small class="m-0 l-h-n">Total Articles</small>
                </h3>
            </div>
            <i class="fal fa-pager position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6"
                style="font-size: 8rem;"></i>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        getdata();
    });
    /* bar & line combine */
    var barlineCombine = function(label, visitor, article, event) {
        var barlineCombineData = {
            labels: label,
            datasets: [{
                    type: 'line',
                    label: 'Event',
                    borderColor: color.success._300,
                    pointBackgroundColor: color.success._500,
                    pointBorderColor: color.success._500,
                    pointBorderWidth: 1,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 5,
                    fill: false,
                    data: event
                },
                {
                    type: 'line',
                    label: 'Article',
                    borderColor: color.warning._300,
                    pointBackgroundColor: color.warning._500,
                    pointBorderColor: color.warning._500,
                    pointBorderWidth: 1,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 5,
                    fill: false,
                    data: article
                },
                {
                    type: 'bar',
                    label: 'Visitor',
                    backgroundColor: color.info._300,
                    borderColor: color.info._500,
                    data: visitor,
                    borderWidth: 1
                }
            ]

        };
        var config = {
            type: 'bar',
            data: barlineCombineData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: false,
                    // text: 'Chart.js Bar Chart'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: '6 months forecast'
                        },
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Profit margin (approx)'
                        },
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }]
                }
            }
        }
        new Chart($("#barlineCombine > canvas").get(0).getContext("2d"), config);
    }
    /* bar & line combine -- end */
    /* bar chart */
    var visitorBarChart = function(label, data) {
        var barChartData = {
            labels: label,
            datasets: [{
                label: "Visitor",
                backgroundColor: color.info._300,
                borderColor: color.info._500,
                borderWidth: 1,
                data: data
            }]

        };
        var config = {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    display: true,
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Bar Chart'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: '6 months forecast'
                        },
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Profit margin (approx)'
                        },
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }]
                }
            }
        }
        new Chart($("#visitorBarChart > canvas").get(0).getContext("2d"), config);
    }
    var articleBarChart = function(label, data) {
        var barChartData = {
            labels: label,
            datasets: [{
                label: "Article",
                backgroundColor: color.warning._300,
                borderColor: color.warning._500,
                borderWidth: 1,
                data: data
            }]

        };
        var config = {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    display: true,
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Bar Chart'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: '6 months forecast'
                        },
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Profit margin (approx)'
                        },
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }]
                }
            }
        }
        new Chart($("#articleBarChart > canvas").get(0).getContext("2d"), config);
    }
    var eventBarChart = function(label, data) {
        var barChartData = {
            labels: label,
            datasets: [{
                label: "Event",
                backgroundColor: color.success._300,
                borderColor: color.success._500,
                borderWidth: 1,
                data: data
            }]

        };
        var config = {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    display: true,
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Bar Chart'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: '6 months forecast'
                        },
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Profit margin (approx)'
                        },
                        gridLines: {
                            display: true,
                            color: "#f2f2f2"
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11
                        }
                    }]
                }
            }
        }
        new Chart($("#eventBarChart > canvas").get(0).getContext("2d"), config);
    }
    /* bar chart -- end */

    function getdata() {
        $.ajax({
            url: "{{ url('api/admin/dashboard-backend') }}",
            type: "GET",
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + AuthToken);
            },
            success: function(response) {
                if (response.status == "error") {
                    sweetToast(response.msg, response.icon);
                    return;
                }
                setValue(response);
                // setChartValue(response);
                // mapAllDataToChart(response);
                // dataListArticle(response.article.data);
                // dataListEvent(response.event.data);
                unblockagePage();
            },
            error: function(e) {
                if (e.status = 401) //unauthenticate not login
                {
                    Msg('Login is Required', 'error');
                }
                unblockagePage();
            }
        });
    }

    function setValue(data) {
        $("#visitorTotal").text(data.visitor.all);
        $("#articleTotal").text(data.article.all);

    }

    function mapAllDataToChart(data) {
        let newArticle = [];
        let newEvent = [];
        for (const i in data.visitor.chart) {
            if (data.article.chart[i]) {
                newArticle.push(data.article.chart[i]);
            } else {
                newArticle.push(0);
            }
            if (data.event.chart[i]) {
                newEvent.push(data.event.chart[i]);
            } else {
                newEvent.push(0);
            }
        }
        let label = Object.keys(data.visitor.chart);
        let visitor = Object.values(data.visitor.chart);
        barlineCombine(label, visitor, newArticle, newEvent);
    }

    // datatable data
    function dataListArticle(data) {
        var cols = [{
                "data": "id",
                "name": "id",
                "searchable": true,
                "orderable": true,
                "visible": true,
            }, //1
            {
                "data": "title_en",
                "name": "title_en",
                "searchable": true,
                "orderable": true,
                "visible": true,
            }, //2
            {
                "data": "title_kh",
                "name": "title_kh",
                "searchable": true,
                "orderable": true,
                "visible": true,
            }, //3

            {
                "data": "created_at",
                "name": "created_at",
                "searchable": true,
                "orderable": true,
                "visible": true,
                render: function(data, type, row) {
                    return moment(data.created_at).format('DD-MMM-YYYY');
                }
            } //4
        ];

        var btn = [
            // {
            //     extend: 'print',
            //     text: 'Print',
            //     titleAttr: 'Print Table',
            //     className: 'btn-outline-primary btn-sm'
            // }
        ];
        if ($.fn.DataTable.isDataTable('#datalistArticle')) {
            $('#datalistArticle').DataTable().clear();
            $('#datalistArticle').DataTable().destroy();
        }
        //////INT TABLE//////
        var table = $('#datalistArticle').DataTable({
            "data": data,
            "columns": cols,
            "buttons": btn,
            "order": [1, 'asc'],
            "rowId": "id",
            "responsive": "true",
            dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        });
        //////INT TABLE//////
    }

    // datatable data
    function dataListEvent(data) {
        var cols = [{
                "data": "id",
                "name": "id",
                "searchable": true,
                "orderable": true,
                "visible": true,
            }, //1
            {
                "data": "title_en",
                "name": "title_en",
                "searchable": true,
                "orderable": true,
                "visible": true,
            }, //2
            {
                "data": "title_kh",
                "name": "title_kh",
                "searchable": true,
                "orderable": true,
                "visible": true,
            }, //3

            {
                "data": "date_en",
                "name": "date_en",
                "searchable": true,
                "orderable": true,
                "visible": true,

            } //4
        ];

        var btn = [
            // {
            //     extend: 'print',
            //     text: 'Print',
            //     titleAttr: 'Print Table',
            //     className: 'btn-outline-primary btn-sm'
            // }
        ];
        if ($.fn.DataTable.isDataTable('#datalistEvent')) {
            $('#datalistEvent').DataTable().clear();
            $('#datalistEvent').DataTable().destroy();
        }
        //////INT TABLE//////
        var table = $('#datalistEvent').DataTable({
            "data": data,
            "columns": cols,
            "buttons": btn,
            "order": [1, 'asc'],
            "rowId": "id",
            "responsive": "true",
            dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        });
        //////INT TABLE//////
    }
</script>
