var qs = $('#m_quicksearch');
var url = $(location).attr('pathname');
var submitForm = $('.m-list-search__form');
function commonSearch(){
    qs.mQuicksearch({
        type: qs.data('search-type'), // quick search type
        // source: url + '/search',            
        spinner: 'm-loader m-loader--skin-light m-loader--right',
        input: '#m_quicksearch_input',
        iconClose: '#m_quicksearch_close',
        iconCancel: '#m_quicksearch_cancel',
        iconSearch: '#m_quicksearch_search',

        hasResultClass: 'm-list-search--has-result',
        minLength: 0,            
        templates: {
            error: function(qs) {
                return '<div class="m-search-results m-search-results--skin-light"><span class="m-search-result__message">Something went wrong</div></div>';
            }                            
        }
    });
}
// submitForm.on('submit', function(e){
//     // e.preventDefault();
//     var data = $(this).serialize();
//     $.ajax({
//         method: "GET",
//         url: url + '/search',
//         data: data,
//     })
//     .done(function( msg ) {
//         $(msg).appendTo('#haind');
//     });
// });

// qs.keypress(function (e) {
//     if (e.which == 13) {
//         callSearch();
//     }
// });


// qs.keyup(function() {
//     callSearch();
// });

// var timer;
// function callSearch() {
//     window.clearTimeout(timer);
//     timer = window.setTimeout(function() {
//         commonSearch();
//         console.log("commonSearch");
//     }, 2000);
// }

//== Initialization
jQuery(document).ready(function() {
    $('.datepicker').datepicker();
});