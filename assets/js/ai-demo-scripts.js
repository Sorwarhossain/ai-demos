(function ($) {
    "use strict";

	
	
$(window).load(function(){
	var targetWidth = 768;
	if ( $(window).width() >= targetWidth) {     
	 	
	}
});


    // init Isotope
var $grid = $('#ai_demos_wrapper').isotope({
    itemSelector: '.ai_demos_item',
    layoutMode: 'fitRows',
});

var iso = $grid.data('isotope');
aiDemoUpdateCount(iso.filteredItems);
	
  
// store filter for each group
var filters = {};

$('.aidemos_filters').on( 'click', '.filter_button', function( event ) {
    event.preventDefault();
    var $button = $( event.currentTarget );
    // get group key
    var $buttonGroup = $button.parents('.ai_filter_list');
    var filterGroup = $buttonGroup.attr('data-filter-group');
    // set filter for group
    filters[ filterGroup ] = $button.attr('data-filter');
    // combine filters
    var filterValue = concatValues( filters );
    // set filter for Isotope
    $grid.isotope({ filter: filterValue });
	
	aiDemoUpdateCount(iso.filteredItems);

});
  
// change is-checked class on buttons
$('.ai_filter_list').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', '.filter_button', function( event ) {
        $buttonGroup.find('.is-checked').removeClass('is-checked');
        var $button = $( event.currentTarget );
        $button.addClass('is-checked');
    });
});
    
// flatten object by concatting values
function concatValues( obj ) {
    var value = '';
    for ( var prop in obj ) {
        value += obj[ prop ];
    }
    return value;
}

function aiDemoUpdateCount(count){
	var coutn_text = '';
	if(count.length < 2){
		coutn_text = count.length + ' demo';
	} else {
		coutn_text = count.length + ' demos';
	}
	$('.ai_item_count').text(coutn_text);
}


    $("#aidemos_reset_filer").click(function(){
		filters = {};
        $("#ai_demos_wrapper").isotope({
            filter: '*'
        });
        $('.aidemos_filters .filter_button').removeClass('is-checked');
		aiDemoUpdateCount(iso.filteredItems);
    });
    




}(jQuery));