$(document).ready(function() {
    var table = $('#report-guide-table').DataTable(
        {
            dom: 'rtB',
            responsive: false,
            ordering: true,
            paging: false,
            language: {
                search: "Поиск",
                processing: "Пожалуйста, подождите",
                emptyTable: "Записи отсутствуют",
                zeroRecords: "К сожалению, подходящие записи не найдены",
                paginate: {
                    first:      "Первая",
                    previous:   "Предыдущая",
                    next:       "Следующая",
                    last:       "Последняя"
                },
            },
            columnDefs: [ {
                targets: [ 0 ],
                orderData: [ 0, 1 ]
            }, {
                targets: [ 1 ],
                orderData: [ 1, 0 ]
            }, {
                targets: [ 1 ],
                orderData: [ 1, 0 ]
            } ],
            buttons: {
                buttons: [
                    {
                        extend: 'print',
                        className: 'btn-outline-success',
                        text: 'Печать'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-outline-success',
                        text: 'PDF'
                    },
                    {
                        extend: 'excel',
                        className: 'btn-outline-success',
                        text: 'Excel'
                    },
                ]
            },
            /* "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                // Total over all pages
                total = api
                    .column( 1 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                totalPurchases = api
                    .column( 2 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                totalAdServices = api
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                totalGuide = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Total over this page
                pageTotal = api
                    .column( 1, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                pageTotalPurchases = api
                    .column( 2, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                pageTotalAdServices = api
                    .column( 3, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                pageTotalGuide = api
                    .column( 4, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api.column( 1 ).footer() ).html(
                    pageTotal+'руб.'
                );

                $( api.column( 2 ).footer() ).html(
                    pageTotalPurchases+'руб.'
                );

                $( api.column( 3 ).footer() ).html(
                    pageTotalAdServices+'руб.'
                );

                $( api.column( 4 ).footer() ).html(
                    pageTotalGuide+'руб.'
                );
            }, */
        }
    );
} );
