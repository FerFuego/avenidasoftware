$(document).ready(function () {
    $('#role_name').keyup( function (e) {
        var str = $('#role_name').val()
        str = str.replace(/\W+(?!$)/g, '-').toLowerCase() //replace stapces with dash
        $('#role_slug').val(str)
        $('#role_slug').attr('placeholder', str)
    })
})

$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var user_id = button.data('userid')
    var modal = $(this)
    /* modal.find('.modal-footer #user_id').val(user_id) */
    modal.find('form').attr('action','/users/'+ user_id)
})

$('#deleteRolModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var role_id = button.data('roleid')
    var modal = $(this)
    modal.find('form').attr('action','/roles/'+ role_id)
})

$('#deleteSucursalsModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var sucursal_id = button.data('sucursalid')
    var modal = $(this)
    modal.find('form').attr('action','/sucursals/'+ sucursal_id)
})

$('#deleteSaleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var sale_id = button.data('saleid')
    var modal = $(this)
    modal.find('form').attr('action','/sales/'+ sale_id)
})

$('#deleteTaskModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var task_id = button.data('taskid')
    var modal = $(this)
    modal.find('form').attr('action','/tasks/'+ task_id)
})

$('#deleteTodoModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var todo_id = button.data('todoid')
    var modal = $(this)
    modal.find('form').attr('action','/todos/'+ todo_id)
})

$('#deleteOfferModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var offer_id = button.data('offerid')
    var modal = $(this)
    modal.find('form').attr('action','/offers/'+ offer_id)
})

$('#deleteRRhhModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var rrhh_id = button.data('rrhhid')
    var modal = $(this)
    modal.find('form').attr('action','/rrhhs/'+ rrhh_id)
})

$("#roles_permissions").tagsinput('items')

$(document).ready(function () {
    
    var permissions_box = $('#permissions_box')
    var permissions_checkbox_list = $('#permissions_checkbox_list')
    
    $('#role').on('change', function () {
        var role = $(this).find(':selected')
        var role_id = role.data('role-id')
        var role_slug = role.data('role-slug')
        permissions_checkbox_list.empty()
        
        $.ajax ({
            url: "/users/create",
            method: 'get',
            dataType: 'json',
            data:  {
                role_id: role_id,
                role_slug: role_slug
            },
        }).done ( function (data) {
            permissions_box.show()
            $.each(data, function(index, element){
                $(permissions_checkbox_list).append(
                    '<div class="custom-control custom-checkbox">' +
                    '<input type="checkbox" name="permissions[]" class="custom-control-input" id="'+ element.slug +'" value="' + element.id + '" checked>' +
                    '<label for="'+ element.slug +'" class="custom-control-label">' + element.name + '</label>' +
                    '</div>'
                )
            })
        })
    })
});

// Mark as readW
document.addEventListener('DOMContentLoaded', () => {

    // Select all cta with the name 'settings' using querySelectorAll.
    var ctas = document.querySelectorAll(".js-read");

    ctas.forEach(function(cta) {
        cta.addEventListener('click', function() {

            var id = $(this).attr('data-notificationid')

            var attrs = {
                'notification_id' : id,
                'state' : 1
            }

            const ops = {
                method: 'PATCH',
                headers: {
                    'content-type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(attrs) ,
                url: '/notifications/' + id
            };

            axios(ops).then(function (response) {
                $('#js-read-'+id).html('Leida');
                $(cta).addClass('d-none');
            })

            .catch(function (error) {
                console.log(error);
            })
        })
    })
});

// Select sercheables
$('#select_sucursal').selectpicker();
$('#select_gerent').selectpicker();

//Tables
$("#tableSucursals, #tableSales, #tableRoles, #tableUsers").DataTable({
    "responsive": true,
    "autoWidth": false,
    "language": {
        url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json',
    },
});

//Calendar
$('#calendar').datetimepicker({
    format: 'L',
    inline: true,
    language: 'es',
    closeText: 'Cerrar',
    prevText: '<Ant',
    nextText: 'Sig>',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
});

//Bootstrap Duallistbox
$('.duallistbox').bootstrapDualListbox();

//TodoList check
document.addEventListener('DOMContentLoaded', () => {

    // Select all checkboxes with the name 'settings' using querySelectorAll.
    var checkboxes = document.querySelectorAll("input[type=checkbox][name=task_id]");
    var is_complete = 0;
    var state = '';
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                this.parentElement.parentElement.classList.add("done");
                this.parentElement.parentElement.classList.add("complete");
                is_complete = 1;
                state = 'Completada';
            } else {
                this.parentElement.parentElement.classList.remove("done");
                this.parentElement.parentElement.classList.remove("complete");
                is_complete = 0;
                state = 'Incompleta';
            }

            var attrs = {
                'task_id' : this.value,
                'state' : state,
                'is_complete' : is_complete
            }
        
            const ops = {
                method: 'POST',
                headers: {
                    'content-type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(attrs) ,
                url: '/tasks/check'
            };
    
            axios(ops).then(function (response) {
               /*  let content = createHtmlContent( response );
                currentDiv.innerHTML = '';
                currentDiv.append(content); */
            })
    
            .catch(function (error) {
                console.log(error);
            })
        })
    })
})

//TodoList state
document.addEventListener('DOMContentLoaded', () => {

    // Select all cta with the name 'settings' using querySelectorAll.
    var ctas = document.querySelectorAll(".todo-state");
    var state = '';
    var is_complete = 0;
    ctas.forEach(function(cta) {
        cta.addEventListener('click', function() {

            var process = 'process' + this.getAttribute('data-process');
            var elem = document.getElementById(process);

            if (this.getAttribute('data-state') == '' || this.getAttribute('data-state') == 'Incompleta') {
                state = 'En Proceso';
            } else {
                state = 'Incompleta';
            }

            this.setAttribute('data-state', state);

            var attrs = {
                'task_id' : this.getAttribute('data-id'),
                'state' : state,
                'is_complete' : is_complete
            }
        
            const ops = {
                method: 'POST',
                headers: {
                    'content-type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(attrs),
                url: '/tasks/check'
            };
    
            axios(ops).then(function (response) {
                
                if ( response.data.state == 'En Proceso') {
                    elem.classList.add("inline-block");
                    elem.classList.remove("d-none");
                } else {
                    elem.classList.add("d-none");
                    elem.classList.remove("inline-block");
                }
                
                window.location.reload();
            })
    
            .catch(function (error) {
                console.log(error);
            })
        })
    })
})

//Todo change state
document.addEventListener('DOMContentLoaded', () => {

    var ctas = document.querySelector(".todo-state-changer");
    if (ctas) {
        ctas.addEventListener('change', function() {

            var is_complete = (this.getAttribute('value') == 'Completada') ? 1 : 0;
            var attrs = {
                'task_id' : this.getAttribute('data-id'),
                'state'   : this.value,
                'is_complete' : is_complete
            }

            console.log(attrs);
        
            const ops = {
                method: 'POST',
                headers: {
                    'content-type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(attrs),
                url: '/tasks/change-state'
            };
    
            axios(ops).then(function (response) {
                window.location.reload();
            })
    
            .catch(function (error) {
                console.log(error);
            })
        })
    }
})

// jQuery UI sortable for the todo list
$('.todo-list').sortable({
    placeholder         : 'sort-highlight',
    handle              : '.handle',
    forcePlaceholderSize: true,
    zIndex              : 999999
})

function openPopUp(id) {
    $('#item_' + id).toggleClass('d-none');
}

function setStateBooking(id, state) {
    var attrs = {
        'id' : id,
        'state' : state
    }

    const ops = {
        method: 'POST',
        headers: {
            'content-type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: JSON.stringify(attrs),
        url: '/bookings/state'
    };

    axios(ops).then(function (response) {
        var classe = (state == 'Completada') ? 'badge-success' : (state == 'Cancelado') ? 'd-none' : 'badge-warning';
        $('#'+id).removeClass('badge-success');
        $('#'+id).removeClass('badge-danger');
        $('#'+id).removeClass('d-none'); //new
        $('#'+id).removeClass('badge-warning');
        $('#'+id).removeClass('badge-info');
        $('#'+id).addClass(classe);
    })

    .catch(function (error) {
        console.log(error);
    })
}

/**
 * Supplier Booking
 */
function getBookingDay(value) {
    var time = new Date(value + " 07:00");
    var x = document.getElementById('pallets').value;
    const cant = 75;
    const ops = {
        method: 'POST',
        headers: {
            'content-type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: JSON.stringify(value),
        url: '/bookings/day'
    };

    axios(ops).then(function (response) {
        var data = response.data;
        var info = (x>1) ? '(Seleccione ' + x + ' horarios consecutivos)' : '(Seleccione ' + x + ' horario)';
        var html = '<label>Hora <span class="text-info">'+info+'</span></label>'
                    + '<table class="table table-bordered table-striped table-custom">'
                    + '<tr>'
                    + '<td>Hora</td>'
                    + '<td colspan="4">Minutos</td>'
                    + '</tr>'
                    + '<tr>';
        for(var i=0; i<cant; i++) {
            if (i>0 && i%5 == 0) {
                html += '</tr>'
            }
            if (i==0 || i%5 == 0) {
                brand=true
                html += '<tr>'
            }
            if (i>0 && i%5 !== 0) {
                html += '<td><span class="badge">'+format(time, 'hh:mm')+'</span> <input type="checkbox" name="time[]" value="'+format(time, 'yyyy-MM-dd hh:mm:ss')+'" title="'+format(time, 'yyyy-MM-dd hh:mm:ss')+'" '+disableTime(this, data, time)+'></td>';
                time.setMinutes ( time.getMinutes() + 15 )
            }
        }
        html += '</table>';
        $('#js-calendar').html(html);
    })

    .catch(function (error) {
        console.log(error);
    })
}

format = function date2str(x, y) {
    var z = {
        M: x.getMonth() + 1,
        d: x.getDate(),
        h: x.getHours(),
        m: x.getMinutes(),
        s: x.getSeconds()
    };
    y = y.replace(/(M+|d+|h+|m+|s+)/g, function(v) {
        return ((v.length > 1 ? "0" : "") + z[v.slice(-1)]).slice(-2)
    });

    return y.replace(/(y+)/g, function(v) {
        return x.getFullYear().toString().slice(-v.length)
    });
}

function disableTime(obj, data, time) {
    var enabled = '';
    data.forEach(function(item) {
        var newT = format(time, 'yyyy-MM-dd hh:mm:ss');
        if (item.start == newT && item.state !== 'Cancelado') {
            enabled = 'checked disabled';
        }
    })
    return enabled;
}

/**
 * Admin Booking
 */
$('#openDayModal').on('show.bs.modal', function (event) {
    var modal = $(this)
    const cant = 75;
    var button = $(event.relatedTarget)
    var day = button.data('day')
    var time = new Date(day + " 07:00");
    const ops = {
        method: 'POST',
        headers: {
            'content-type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: JSON.stringify(day),
        url: '/bookings/day'
    };

    axios(ops).then(function (response) {
        var data = response.data;
        var html = '<table class="table table-bordered table-striped table-custom">'
                    + '<tr>'
                    + '<td>Hora</td>'
                    + '<td colspan="4">Minutos</td>'
                    + '</tr>'
                    + '<tr>'
            for(var i=0; i<cant; i++) {
                if (i>0 && i%5 == 0) {
                    html += '</tr>'
                }
                if (i==0 || i%5 == 0) {
                    html += '<tr>'
                }
                if (i>0 && i%5 !== 0) {
                    html += '<td><span class="badge">'+format(time, 'hh:mm')+'</span> <span class="badge '+getState(data, time)+'">'+printTime(this, data, time)+'</span></td>';
                    time.setMinutes ( time.getMinutes() + 15 )
                }
            }
            html += '</table>';

            $('#bookingsPerDay').html(html);
            $('#bookingsReport').attr('data-day', day);
    })

    .catch(function (error) {
        console.log(error);
    })
})

function printTime(obj, data, time) {
    var enabled = '';
    data.forEach(function(item) {
        var newT = format(time, 'yyyy-MM-dd hh:mm:ss');
        if (item.start == newT) {
            enabled = item.supplier;
        }
    })
    return enabled;
}

function getState(data, time) {
    var state = '';
    data.forEach(function(item) {
        var newT = format(time, 'yyyy-MM-dd hh:mm:ss');
        if (item.start == newT) {
            state = (item.state == 'Completada') ? 'badge-success': (item.state == 'Cancelado') ? 'badge-danger': (item.state == 'En proceso') ? 'badge-warning':'badge-info';
        }
    })

    return state;
}

$(document).ready(function () {
    $("#cta_month").change(function () {
        var value = $(this).val();
        $("#rta_month").val(value);
    });

    $("#cta_year").change(function () {
        var value = $(this).val();
        $("#rta_year").val(value);
    });
});

/**
 * Toggle menu
 */
document.addEventListener('DOMContentLoaded', () => {
    let cta = document.querySelector('.toggle-menu'); //toggle-menu

    cta.addEventListener('click', function() {
        let body = document.querySelector('body');
        body.classList.toggle('sidebar-closed');
        body.classList.toggle('sidebar-collapse');
        body.classList.toggle('sidebar-open');
    });
});

/**
 * Delete Photo
 */
function deletePhoto(id) {
    if (confirm('¿Estás seguro de que deseas eliminar esta foto?')) {
        const ops = {
            method: 'DELETE',
            headers: {
                'content-type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify(id),
            url: '/photos/' + id,
        };

        axios(ops).then(function (response) {
            window.location.reload();
        })

        .catch(function (error) {
            console.log(error);
        })
    }
}