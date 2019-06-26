/* Custom filtering function which will search data in column five between two values */
$.fn.dataTable.ext.search.push(
    function( oSettings, aData, iDataIndex ) {
        var min = document.getElementById('report_from').value;

        var max = document.getElementById('report_till').value;
        var iDateCol = 5;

        min=min.substring(0,4) + min.substring(5,7)+ min.substring(8,10);
        max=max.substring(0,4) + max.substring(5,7)+ max.substring(8,10);

        var datofini=aData[iDateCol].substring(6,10) + aData[iDateCol].substring(3,5)+ aData[iDateCol].substring(0,2);

        if ( ( isNaN( min ) && isNaN( max ) ) ||
            ( isNaN( min ) && datofini <= max ) ||
            ( min <= datofini   && isNaN( max ) ) ||
            ( min <= datofini   && datofini <= max ) )
        {
            return true;
        }
        return false;
    }
);

$(document).ready(function() {
    var table = $('#report-table').DataTable(
        {
            dom: 'frtB',
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
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                // Total over all pages
                totalPurchases = api
                    .column( 6 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                totalAdServices = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                totalGuide = api
                    .column( 8 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                total = api
                    .column( 9 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );


                // Total over this page
                pageTotalPurchases = api
                    .column( 6, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                pageTotalAdServices = api
                    .column( 7, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                pageTotalGuide = api
                    .column( 8, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                pageTotal = api
                    .column( 9, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api.column( 6 ).footer() ).html(
                    pageTotalPurchases+' ₽'
                );

                $( api.column( 7 ).footer() ).html(
                    pageTotalAdServices+' ₽'
                );

                $( api.column( 8 ).footer() ).html(
                    pageTotalGuide+' ₽'
                );

                $( api.column( 9 ).footer() ).html(
                    pageTotal+' ₽'
                );
            },
        }
    );

    $('#report_from, #report_till').change( function() {
        table.draw();
    } );
} );



