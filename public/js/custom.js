/* DELETE TRADEPOINT */
const trade_points = document.getElementById('trade_points');

if(trade_points)
{
   trade_points.addEventListener('click',(e) => {
       if (e.target.className === 'dropdown-item delete-trade_point')
       {
           if (confirm(`Вы уверены, что хотите удалить данный магазин?`))
           {
               const id = e.target.getAttribute('data-id');

               fetch(`/trade_point/delete/${id}`, {
                   method: 'DELETE'
               }).then(resp => window.location.reload());
           }
       }
   });
}

/* DELETE FOREIGN COMPANY */
const foreign_companies = document.getElementById('foreign_companies');

if(foreign_companies)
{
    foreign_companies.addEventListener('click',(e) => {
        if (e.target.className === 'dropdown-item delete-foreign_company')
        {
            if (confirm(`Вы уверены, что хотите удалить данную компанию?`))
            {
                const id = e.target.getAttribute('data-id');

                fetch(`/foreign_company/delete/${id}`, {
                    method: 'DELETE'
                }).then(resp => window.location.reload());
            }
        }
    });
}

/* DELETE USER */
const users = document.getElementById('users');

if(users)
{
    users.addEventListener('click',(e) => {
        if (e.target.className === 'dropdown-item delete-user')
        {
            if (confirm(`Вы уверены, что хотите удалить данного пользователя?`))
            {
                const id = e.target.getAttribute('data-id');

                fetch(`/users/delete/${id}`, {
                    method: 'DELETE'
                }).then(resp => window.location.reload());
            }
        }
    });
}

/* DELETE SERVICES SUPPLIER */
const services_suppliers = document.getElementById('services_suppliers');

if(services_suppliers)
{
    services_suppliers.addEventListener('click',(e) => {
        if (e.target.className === 'dropdown-item delete-services-supplier')
        {
            if (confirm(`Вы уверены, что хотите удалить данную компанию?`))
            {
                const id = e.target.getAttribute('data-id');

                fetch(`/services_supplier/delete/${id}`, {
                    method: 'DELETE'
                }).then(resp => window.location.reload());
            }
        }
    });
}

/* DELETE PURCHASE */
const purchases = document.getElementById('purchase-table');

if(purchases)
{
    purchases.addEventListener('click',(e) => {
        if (e.target.className === 'dropdown-item delete-purchase')
        {
            if (confirm(`Вы уверены, что хотите удалить данную покупку?`))
            {
                const id = e.target.getAttribute('data-id');

                fetch(`/purchase/delete/${id}`, {
                    method: 'DELETE'
                }).then(resp => window.location.reload());
            }
        }
    });
}

$(function () {
    $('[data-toggle="popover"]').popover()
});


/* REQUESTS ON STATUS CHANGE */
const touristGroup = document.getElementById('change-status');

if(touristGroup)
{
    touristGroup.addEventListener('click',(e) => {
        if (e.target.className === 'btn btn-info change-status')
        {
            if (confirm('Вы уверены?'))
            {
                const id = e.target.getAttribute('data-id');
                fetch(`change_status/${id}`, {
                    method: 'POST'
                }).then(resp => window.location.reload());
            }
        }
    });
}


// Tables. Manual https://datatables.net/manual/index
$(document).ready(function() {
    $('#standard-table').DataTable( {
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
        }
    } );
} );

$(document).ready(function() {
    $('#trade_points').DataTable( {
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
        }
    } );
} );

$(document).ready(function() {
    $('#purchase-table').DataTable( {
        dom: 'rt',
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
        }
    } );
} );

$(document).ready(function() {
    $('#ad-ser-table').DataTable( {
        dom: 'rt',
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
        }
    } );
} );

$(document).ready(function() {
    $('#ad-ser-guide-table').DataTable( {
        dom: 'rt',
        responsive: true,
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
        }
    } );
} );

$(document).ready(function() {
    $('#main-page-new-table').DataTable( {
        dom: 'rt',
        responsive: true,
        paging: false,
        ordering: true,
        language: {
            search: "Поиск",
            processing: "Пожалуйста, подождите",
            emptyTable: "Новые группы отсутствуют",
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
        }
    } );
} );

$(document).ready(function() {
    $('#main-page-waiting-table').DataTable( {
        dom: 'rt',
        responsive: true,
        paging: false,
        ordering: true,
        language: {
            search: "Поиск",
            processing: "Пожалуйста, подождите",
            emptyTable: "Группы, ожидающие подтверждения отчёта, отсутствуют",
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
        }
    } );
} );

$(document).ready(function() {
    $('#main-page-approved-table').DataTable( {
        dom: 'rt',
        responsive: true,
        paging: false,
        ordering: true,
        language: {
            search: "Поиск",
            processing: "Пожалуйста, подождите",
            emptyTable: "Утверждённые группы отсутствуют",
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
        }
    } );
} );

$(document).ready(function() {
    $('#tourist-group-show-guide-table').DataTable( {
        dom: 'rt',
        responsive: true,
        paging: false,
        ordering: true,
        language: {
            search: "Поиск",
            processing: "Пожалуйста, подождите",
            emptyTable: "Новые группы отсутствуют",
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
        }
    } );
} );

$(document).ready(function() {
    $('#foreign_companies').DataTable( {
        dom: 'frt',
        responsive: false,
        paging: false,
        ordering: true,
        language: {
            search: "Поиск",
            processing: "Пожалуйста, подождите",
            emptyTable: "Новые группы отсутствуют",
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
        }
    } );
} );

$(document).ready(function() {
    $('#users').DataTable( {
        dom: 'frt',
        responsive: false,
        paging: false,
        ordering: true,
        language: {
            search: "Поиск",
            processing: "Пожалуйста, подождите",
            emptyTable: "Новые группы отсутствуют",
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
        }
    } );
} );

$(document).ready(function() {
    $('#services_suppliers').DataTable( {
        dom: 'frt',
        responsive: false,
        paging: false,
        ordering: true,
        language: {
            search: "Поиск",
            processing: "Пожалуйста, подождите",
            emptyTable: "Новые группы отсутствуют",
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
        }
    } );
} );



//Related lists in Purchase
$('#purchase_tradePoint').change(function () {
    const tradePointSelector = $(this);

    $.ajax({
        url: "/get-commissions-from-tradepoint",
        type: "GET",
        dataType: "JSON",
        data: {
            tradePointId: tradePointSelector.val()
        },
        success: function (commissions) {
            let commissionSelect = $("#purchase_commission");

            // Remove current options
            commissionSelect.html('');

            // Empty value ...
            commissionSelect.append('<option value> Выберите коммиссию магазина ' + tradePointSelector.find("option:selected").text() + ' ...</option>');


            $.each(commissions, function (key, commission) {
                commissionSelect.append('<option value="' + commission.id + '">' + commission.name + '</option>');
            });
        },
        error: function (err) {
            alert("Во время обработки данных произошла ошибка ...");
        }
    });

    // Запросить комиссии выбранного магазина.
    $.ajax({
        url: "/get-commissions-from-tradepoint",
        type: "GET",
        dataType: "JSON",
        data: {
            tradePointId: tradePointSelector.val()
        },
        success: function (commissions) {
            let commissionSelect = $("#purchase_commission");

            // Remove current options
            commissionSelect.html('');

            // Empty value ...
            commissionSelect.append('<option value> Выберите коммиссию магазина ' + tradePointSelector.find("option:selected").text() + ' ...</option>');


            $.each(commissions, function (key, commission) {
                commissionSelect.append('<option value="' + commission.id + '">' + commission.name + '</option>');
            });
        },
        error: function (err) {
            alert("Во время обработки данных произошла ошибка ...");
        }
    });
});