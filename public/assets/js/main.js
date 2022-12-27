var MYAPP = MYAPP || {};
MYAPP.common = {
    base_url: baseUrl,
    routeName: segment1,
    segment1: segment2,
    segment2: segment3,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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
            data: { image: imageData },
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
            method: 'get',
            dataType: 'json',
            headers: this.headers,
            url: MYAPP.common.base_url + '/get_appointment/' + tailor_id,
            beforeSend: function() {
                $('#appointment-form #custom-message').html('').addClass('d-none');
            },
            success: function(response) {
                let disabledDate = [];
                if(response.code === 200 && response.result && response.result.length > 0) {
                    disabledDate = response.result;
                }
                $('#appointment_datetime').flatpickr({
                    enableTime: true,
                    dateFormat: 'Y-m-d G:i K',
                    minDate: 'today',
                    disable: disabledDate // ["2022-11-18", "2022-11-20", "2022-11-28"]
                });
                $('#appointment-form #hidden-tailor-id').val(tailor_id);
                $('body #appointment-form')[0].reset();
                $('body #appointmentModal').modal('show');
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
                $('#appointment-form #custom-message').html('').addClass('d-none');
            },
            success: function(response) {
                let html = '';
                if(response.code === 202) {
                    response.errors.forEach(element => {
                        html += '<p class="text-danger mb-0">' + element + '</p>';
                    });
                    $('#appointment-form #book-now').attr('disabled', false);
                } else {
                    html += '<p class="text-success mb-0 text-center">' + response.message + '</p>';
                }
                $('#appointment-form #custom-message').html(html).removeClass('d-none');
            },
            error: function(response) {},
            complete: function(response) {}
        });
    },
    get_measurment_fields: function(action, data){
        $.ajax({
            method: 'post',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: data,
            url: action,
            success: function(response) {
                if (response.code === 200) {
                    if(response.data !== ''){
                        MYAPP.common.prepareMeasumentFields(response.data)
                    }else{
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
    prepareMeasumentFields:function(data) {
        fields = data.fields;
        let html = '';
        fields.forEach(e => {
            if(e.type === 'hidden'){
                html += `<input type="${e.type}" name="${e.name}" value="${e.value}" class="form-control dynamicAdded">`
            }else{
                html += ` <div class="col-md-6 mb-4 dynamicAdded">
                            <p class="mb-1 f-16 d-flex justify-content-between">${e.label} 
                                <i class="fa fa-info-circle"></i>
                            </p>
                            <input type="${e.type}" name="${e.name}" id="${e.name}" value="" class="form-control" placeholder="Enter ${e.label}" required>
                        </div>`
            }
        });
        $(".dynamicAdded").remove();
        $("#dynamicfields").append(html);
    },
    checkPincode: function(redirect_uri) {
        $.ajax({
            method: 'get',
            dataType: 'json',
            headers: this.headers,
            url: MYAPP.common.base_url + '/location',
            beforeSend: function() {},
            success: function(response) {
                if(response.code === 200 && response.result === true) {
                    window.location.href = redirect_uri;
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
                if(response.code === 200 && response.status === 'success') {
                    $('body #pincode-error').text('');
                    window.location.reload();
                }
            },
            error: function(response) {
                if(response.responseJSON.message) {
                    $('body #pincode-error').text(response.responseJSON.message);
                }
            },
            complete: function(response) {}
        });
    }
};

$(document).ready(function() {

    if (segment1 && segment2 && segment1.toLowerCase() === 'product' && (segment2.toLowerCase() === 'create' || segment3.toLowerCase() === 'edit')) {
        MYAPP.common.quillInit();
    }
    $("#material-title").keyup(function() {
        var title = $.trim($(this).val());
        $('#material-slug').val(MYAPP.common.convertToSlug(title));
    });

    $('.show_confirm').click(function(event) {
        event.preventDefault();
        var form = $(this).closest("form");
        var action = form.attr('action');
        $('#delete_modal form').attr('action', action);
        $('#delete_modal').modal('show');
    });

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
        if($(this).hasClass('measurment_button')){
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

    $('body #measurment-form').on('change', function(event){
        let action = `measurment/get_fields`;
        let params = { type: event.target.value, gender: event.target.dataset.gender };
        event.preventDefault();
        MYAPP.common.get_measurment_fields(action, params);
        $(".h3_title_measurment").html(event.target.selectedOptions[0].label.toUpperCase() + ' MEASUREMENT')
    });

    $('body').on('click', '#check-pincode', function(e){
        e.preventDefault();
        const redirect_uri = $.trim($(this).attr('href'));
        MYAPP.common.checkPincode(redirect_uri);
    });
    $('body').on('click', '#change-location', function(){
        $('body #search-location').modal('show');
    });
    $('body').on('click', '#search-location-btn', function(e){
        e.preventDefault();
        var form = $(this).closest("form");
        const formData = form.serializeArray();
        MYAPP.common.storePincode(formData);
    });
});
