;
(function(){
	'use strict';

	var options1 = {
		multipleDate : true,
        showCurrentDateButton: false,
        preDates: ['2017/3/1','2017/3/15','2017/3/14'],//yyyy-mm-dd
        preDatesClickable: true,
        activation: 'always-on',
        singleCalendarMode: true,
        showCurrentDate: true,
		format: 'mm-dd-yy',
        callback: function(date){
            console.log(date);
        }
        
		//minDate: '1/3/2017', // dd/mm/yyyy
        //maxDate: '3/3/2017',
        //animation: 'flipInY',
	}
    var options2 = {
		multipleDate : true,
		minDate: '1/3/2017', // dd/mm/yyyy
		maxDate: '14/3/2017',
//		animation: 'flipInY',
        activation: 'onClick',
//		format: 'D MMMM, YYYY'	
        showCurrentDateButton: false,
        singleCalendarMode: false,
        disableClickEvent : false
	}

//	$('.date').datePicky(options1);
	$('#date1').datePicky(options2);
})();
