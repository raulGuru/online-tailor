var MYAPP = MYAPP || {};
MYAPP.common = {
    base_url: baseUrl,
    routeName: segment1,
    segment1: segment2,
    segment2: segment3,
    testFunction: function() {
        console.log('Hello world');
    }
};
$(document).ready(function() {

    MYAPP.common.testFunction();

});