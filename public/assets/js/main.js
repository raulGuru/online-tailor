var MYAPP = MYAPP || {};
MYAPP.common = {
    base_url: baseUrl,
    routeName: segment1,
    segment1: segment2,
    segment2: segment3,
    testFunction: function() {
        console.log('Hello world');
    },
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
            console.log(quill_editor.container.firstChild.innerHTML)
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
            console.log(quill_editor2.container.firstChild.innerHTML)
            $('#additional_details').val(quill_editor2.container.firstChild.innerHTML);
        });
    },
    convertToSlug: function(Text) {
        return Text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
    }
};
$(document).ready(function() {

    MYAPP.common.testFunction();
    MYAPP.common.quillInit();
    $("#product-title").keyup(function() {
        var title = $.trim($(this).val());
        $('#product-slug').val(MYAPP.common.convertToSlug(title));
    });
});