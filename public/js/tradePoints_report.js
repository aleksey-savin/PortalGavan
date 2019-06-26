$(document).ready(function() {
    var table = $('#report-tradePoint-table').DataTable(
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
        }
    );
} );
