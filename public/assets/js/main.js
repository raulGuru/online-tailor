var MYAPP = MYAPP || {};
/*global showModal */
MYAPP.common = {
    base_url: baseUrl,
    routeName: segment1,
    segment1: segment2,
    segment2: segment3,
    fullUrl: fullUrl,
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    quillInit: function() {
        /*
            additional_details quill_editor
        */
        var quill_editor2 = new Quill('#product-additional-detail', {
            theme: 'snow',
            placeholder: 'Additional information here...',
        });

        const delta2 = quill_editor2.clipboard.convert($('#additional_details').val());
        quill_editor2.setContents(delta2, 'silent');

        quill_editor2.on('text-change', function(delta, oldDelta, source) {
            $('#additional_details').val(quill_editor2.container.firstChild.innerHTML);
        });
    },
    convertToSlug: function(Text) {
        return Text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
    },
    removeItem: function(currentRow, action, imageData) {
        $.ajax({
            method: 'post',
            dataType: 'json',
            headers: this.headers,
            data: {
                image: imageData
            },
            url: action,
            success: function(response) {
                if (response.code === 200) {
                    if ($(currentRow).parents('.thumbnail-img').remove()) {
                        const parentItemLength = $('body .thumbnail-img').length;
                        if (parentItemLength <= 2) {
                            $('body .remove-material-image').remove();
                        }
                    }
                } else {
                    alert('Error: ', response.message);
                }
            },
            error: function(response) {},
            complete: function(response) {}
        });
    },
    setParams: function(key, value) {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set(key, value);
        window.location.search = urlParams;
        return window.location.href;
    },
    getAppointmentDate: function(tailor_id) {
        $.ajax({
            type: 'get',
            dataType: 'json',
            headers: this.headers,
            url: MYAPP.common.base_url + '/get_appointment/' + tailor_id,
            beforeSend: function() {
                $('#appointment-form #custom-message').html('').addClass('d-none');
            },
            success: function(response) {
                let disabledDate = [];
                if (response.code === 200 && response.result) {
                    if (response.result.disabled_date) {
                        disabledDate = response.result.disabled_date;
                    }
                    let services = '';
                    if (response.result.services && response.result.services.length > 0) {
                        response.result.services.forEach((elem, i) => {
                            services += '<div class="form-check form-check-inline">';
                            services += '<input class="form-check-input" name="services[]" type="checkbox" id="service_checkbox_' + i + '" value="' + elem + '">';
                            services += '<label class="form-check-label" for="service_checkbox_' + i + '">' + elem + '</label>';
                            services += '</div>';
                        });
                        $('#appointment-form #ajax-services').html(services);
                    }
                    if (response.result.user) {
                        $('.appointment .email').attr('value', response.result.user.email);
                        $('.appointment .mobile').attr('value', response.result.user.phone);
                    }
                }
                $('.appointment_datetime').flatpickr({
                    enableTime: true,
                    dateFormat: 'Y-m-d G:i K',
                    minDate: 'today',
                    disable: disabledDate // ["2022-11-18", "2022-11-20", "2022-11-28"]
                });
                $('#appointment-form #hidden-tailor-id').val(tailor_id);
                $('body #appointment-form')[0].reset();
                $('body #appointmentModal').modal('show');
                $('#book-now').attr('disabled', false);
            },
            error: function(response) {},
            complete: function(response) {}
        });
    },
    save_appointment: function(action, data) {
        $.ajax({
            method: 'post',
            dataType: 'json',
            headers: this.headers,
            data: data,
            url: action,
            beforeSend: function() {
                $('body #custom-message').html('Please wait while we are sending your information to the selected tailor').removeClass('d-none');
                $('#book-now').attr('disabled', true);
            },
            success: function(response) {
                let html = '';
                if (response.code === 202) {
                    response.errors.forEach(element => {
                        html += '<p class="text-danger mb-0">' + element + '</p>';
                    });
                    $('#appointment-form #book-now').attr('disabled', false);
                }
                if (response.code === 200) {
                    html += '<p class="text-success mb-0 text-center">' + response.message + '</p>';
                    // $('body #appointment-form')[0].reset();
                }
                $('#appointment-form #custom-message').html(html).removeClass('d-none');
            },
            error: function(response) {},
            complete: function(response) {
                $('#book-now').attr('disabled', false);
            }
        });
    },
    get_measurement_fields: function(action, data) {
        $.ajax({
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            url: action,
            success: function(response) {
                if (response.code === 200) {
                    if (response.data !== '') {
                        MYAPP.common.prepareMeasumentFields(response.data)
                    } else {
                        alert("Error: ", 'Something went wrong');
                    }
                } else {
                    alert('Error: ', response.message);
                }
            },
            error: function(response) {
                // console.log(response)
            },
            complete: function(response) {
                // console.log(response)
            }
        });
    },
    prepareMeasumentFields: function(data) {
        let html = '';
        html += `<h3 class="font-weight-500 mb-4 mt-4">${data.selType.toUpperCase()} MEASUREMENT <i class="fa fa-info-circle measureInfo" data-seltype="${data.selType}"></i></h3>`;        
        const stitches = data.stitches;
        if(stitches) {
            html += `<div class="col-md-6 mb-4"><p class="mb-1 f-16 d-flex justify-content-between">Stitch Type*</p><select class="form-control" name="selStitchType" id="selStitchType">`;
            stitches.forEach(e => {
                html += `<option value="${e.id}">${e.stitch_name}</option>`;
            });
            html += `</select></div>`;
        }
        const panna = data.panna;
        if(panna) {
            html += `<div class="col-md-6 mb-4"><p class="mb-1 f-16 d-flex justify-content-between">Panna*</p><select class="form-control" name="selPanna" id="selPanna">`;
            panna.forEach(e => {
                html += `<option value="${e.meter}">${e.label}</option>`;
            });
            html += `</select></div>`;
        }
        const fields = data.fields;
        fields.forEach(e => {
            if (e.type === 'hidden') {
                html += `<input type="${e.type}" name="${e.name}" value="${e.value}" class="form-control">`
            } else {
                html += `<div class="col-md-6 mb-4">
                            <p class="mb-1 f-16 d-flex justify-content-between">${e.label}`;
                if(e.type === 'textbox') {
                    html += `*`;
                }
                if(e.info) {
                    html += ` (${e.info})`;
                }
                html += `</p>`;
                if (e.type === 'textbox') {
                    html += `<input type="${e.type}" name="${e.name}" id="${e.name}" 
                                value="" class="form-control ${e.validate != undefined ? e.validate : ''}" placeholder="Enter ${e.label} in Inches" required>`;
                }
                if (e.type === 'textarea') {
                    html += `<textarea name="${e.name}" id="${e.name}" class="form-control placeholder="Enter ${e.label}" rows="4" cols="50"></textarea>`;
                }
                html += `</div>`
            }
        });
        $("#dynamicfields").html('')
        $("#dynamicfields").append(html);
        $("#image_row").removeClass('d-none');
    },
    checkPincode: function(redirect_uri) {
        $.ajax({
            method: 'get',
            dataType: 'json',
            headers: this.headers,
            url: MYAPP.common.base_url + '/location',
            beforeSend: function() {},
            success: function(response) {
                if (response.code === 404 && response.result === false) {
                    const html = '<a href="' + MYAPP.common.base_url + '/login?redirectTo=' + encodeURI(fullUrl) + '" class="btn btn-primary">Yes</a>';
                    $('#dynamic-content').html(html);
                    $('#confirm-dialog').modal('show');
                } else if (response.code === 200 && response.result === true) {
                    if (localStorage.getItem('measurement_redirect') != null && localStorage.getItem('measurement_redirect') === 'false') {
                        $('body #search-location').modal('hide');
                        localStorage.removeItem('measurement_redirect');
                        $('#measurement-form button[type=submit]').removeAttr('id');
                        $('#measurement-form').submit();
                    } else if (redirect_uri) {
                        window.location.href = redirect_uri;
                    }
                } else {
                    localStorage.setItem('is_redirect', true);
                    $('body #search-location').modal('show');
                }
            },
            error: function(response) {},
            complete: function(response) {}
        });
    },
    storePincode: function(data) {
        $.ajax({
            method: 'post',
            dataType: 'json',
            headers: this.headers,
            data: data,
            url: MYAPP.common.base_url + '/location',
            beforeSend: function() {},
            success: function(response) {
                if (response.code === 200 && response.status === 'success') {
                    $('body #pincode-error').text('');
                    if (localStorage.getItem('measurement_redirect') != null && localStorage.getItem('measurement_redirect') === 'false') {
                        $('body #search-location').modal('hide');
                        localStorage.removeItem('measurement_redirect');
                        $('#measurement-form button[type=submit]').removeAttr('id');
                    } else {
                        window.location.reload();
                    }
                }
            },
            error: function(response) {
                if (response.responseJSON.message) {
                    $('body #pincode-error').text(response.responseJSON.message);
                }
            },
            complete: function(response) {}
        });
    },
    get_product_category: function(action, data) {
        $.ajax({
            method: 'post',
            dataType: 'json',
            headers: this.headers,
            data: data,
            url: MYAPP.common.base_url + action,
            beforeSend: function() {},
            success: function(response) {
                if (response.code === 200 && response.status === 'success') {
                    let html = '<option value="" selected disabled>Sub category</option>';
                    let data = response.data
                    $.each(data, function(e, v) {
                        html += `<option value="${e}">${v}</option>`;
                    });
                    $("#product_subtype").html(html);
                }
            },
            error: function(response) {
                if (response.responseJSON.message) {
                    $('body #pincode-error').text(response.responseJSON.message);
                }
            },
            complete: function(response) {}
        });
    },
    tailor_change: function(data) {
        $.ajax({
            type: 'post',
            dataType: 'json',
            headers: this.headers,
            data: data,
            url: MYAPP.common.base_url + '/product/tailor_change',
            beforeSend: function() {},
            success: function(response) {
                if (response.code === 200 && response.status === 'success') {
                    let commission = response.result.commission;
                    $("body #commission-price-hidden").val(commission);
                    var material_price = parseInt($.trim($("body #material-price").val()));
                    var price = 0;
                    if (material_price) {
                        price = material_price;
                    }
                    var commission_percentage = parseInt(commission);
                    var percentage = 0;
                    if (commission_percentage) {
                        percentage = commission_percentage;
                    }
                    commission = (percentage / 100) * price;
                    var new_price = price + commission;
                    $('body #commission-price').val(new_price);
                }
            },
            error: function(response) {},
            complete: function(response) {}
        });
    },
};

$(document).ready(function() {

    if (segment1 && segment2 && segment1.toLowerCase() === 'product' && (segment2.toLowerCase() === 'create' || segment3.toLowerCase() === 'edit')) {
        MYAPP.common.quillInit();
    }
    $("#material-title").keyup(function() {
        var title = $.trim($(this).val());
        $('#material-slug').val(MYAPP.common.convertToSlug(title));
    });
    // Onload logic
    var material_price = parseInt($.trim($('#material-price').val()));
    var price = 0;
    if (material_price) {
        price = material_price;
    }
    var commission_percentage = parseInt($('body #commission-price-hidden').val());
    var percentage = 0;
    if (commission_percentage) {
        percentage = commission_percentage;
    }
    commission = (percentage / 100) * price;
    var new_price = price + commission;
    $('body #commission-price').val(new_price);
    // Keyup logic
    $("body #material-price").keyup(function() {
        var material_price = parseInt($.trim($(this).val()));
        var price = 0;
        if (material_price) {
            price = material_price;
        }
        var commission_percentage = parseInt($('body #commission-price-hidden').val());
        var percentage = 0;
        if (commission_percentage) {
            percentage = commission_percentage;
        }
        commission = (percentage / 100) * price;
        var new_price = price + commission;
        $('body #commission-price').val(new_price);
    });

    $("body #tailor-change").on('change', function(event) {
        let params = {
            id: $.trim($(this).val())
        };
        event.preventDefault();
        MYAPP.common.tailor_change(params);
    });

    $('.show_confirm').click(function(event) {
        event.preventDefault();
        var form = $(this).closest("form");
        var action = form.attr('action');
        $('#delete_modal form').attr('action', action);
        $('#delete_modal').modal('show');
    });

    $('body').on('mouseenter', '.measureInfo', function() {
        const type = $(this).attr('data-seltype');
        const img = 'public/assets/img/measurement/' + type + '.jpeg';
        $('#imageModal').find('img').attr('src', img);
        $('#imageModal').modal('show');
    })

    $('#delete_modal').on('hidden.bs.modal', function(e) {
        $('#delete_modal form').attr('action', '');
    })

    $('.remove-material-image').click(function() {
        const action_url = $.trim($(this).attr('data-action-url'));
        const image = $.trim($(this).attr('data-image'));
        if (action_url && image) {
            $('#material-slug').val(MYAPP.common.removeItem(this, action_url, image));
        }
    });

    $('body .change-limit').change(function() {
        MYAPP.common.setParams('limit', $(this).val());
    });

    $("body #order").on('change', function() {
        const title = $.trim($(this).val());
        MYAPP.common.setParams('order', title);
    });

    $("body .appointment_button").on('click', function() {
        const tailor_id = $.trim($(this).attr('data-id'));
        if ($(this).hasClass('measurement_button')) {
            $('#appointment-form1 #hidden-tailor-id1').val(tailor_id);
            $('body #appointmentModal1').modal('show');
            return;
        }
        MYAPP.common.getAppointmentDate(tailor_id);
    });

    $('body #appointment-form').on('submit', function(event) {
        const formData = $(this).serializeArray();
        const action = $(this).attr('action');
        event.preventDefault();
        MYAPP.common.save_appointment(action, formData);
    });

    $('body #measurement-form #measurement').on('change', function(event) {
        event.preventDefault();
        MYAPP.common.get_measurement_fields('measurement/get_fields', {
            type: event.target.value,
            gender: event.target.dataset.gender
        });
    });

    $("body").on("keyup", ".validateNumber", function (event) {
        const inputValue = event.target.value;
        event.target.value = /^\d*\.?\d*$/.test(inputValue) ? inputValue : '';
    });

    $("body").on("blur", ".validateNumber", function (event) {
        const inputValue = event.target.value;    
        if (/^\d*\.?\d+$/.test(inputValue)) {
            const id = event.target.id;    
            const number = parseFloat(inputValue);
            if (id === 'chest') {
                if (number < 35 || number > 45) {
                    event.target.value = '';
                }
            } else if(id === 'length') {
                if (number < 25 || number > 30) {
                    event.target.value = '';
                }
            }
        } else {
            event.target.value = '';
        }
    });

    $('body').on('click', '.check-pincode', function(e) {
        e.preventDefault();
        const redirect_uri = $.trim($(this).attr('href'));
        if (this.dataset.redirect != undefined) {
            localStorage.setItem('measurement_redirect', false);
        }
        MYAPP.common.checkPincode(redirect_uri);
    });

    $('body').on('click', '#change-location', function() {
        $('body #search-location').modal('show');
    });

    $('body').on('click', '#search-location-btn', function(e) {
        e.preventDefault();
        var form = $(this).closest("form");
        const formData = form.serializeArray();
        MYAPP.common.storePincode(formData);
    });

    $("body #product_type").on('change', function(event) {
        const id = $.trim($(this).val());
        let params = {
            id: id
        };
        const action = "/product/get_subcategory";
        event.preventDefault();
        MYAPP.common.get_product_category(action, params);
    });
    
    if (typeof showModal !== undefined || showModal === true) {
        $('#approve-reject').modal('show');
    }
});

// window.addEventListener("load", (event) => {
//     if (event.currentTarget.document.forms['measurement-form'] != undefined) {
//         if ($("#measurement").val() != null) {
//             $("#measurement").trigger("change");
//         }
//     }
// });