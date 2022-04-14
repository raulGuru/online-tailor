var MYAPP = MYAPP || {};
MYAPP.common = {
    base_url: baseUrl,
    routeName: segment1,
    segment1: segment2,
    segment2: segment3,
    quillInit: function() {
        /*
            product_details quill_editor
        */
        var quill_editor = new Quill('#product-details', {
            theme: 'snow',
            placeholder: 'Product description here...',
        });

        const delta = quill_editor.clipboard.convert($('#product_details').val());
        quill_editor.setContents(delta, 'silent');

        quill_editor.on('text-change', function(delta, oldDelta, source) {
            $('#product_details').val(quill_editor.container.firstChild.innerHTML);
        });

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
    removeItem: function(action, imageData) {
        $.ajax({
            method: 'post',
            dataType: 'json',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: { image: imageData },
            url: action,
            success: function(response) {
                console.log('Response => ', response);
            },
            error: function(response) {},
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
            $('#material-slug').val(MYAPP.common.removeItem(action_url, image));
        }
    });

    $('.remove-material-image-2').click(function() {

    });

});