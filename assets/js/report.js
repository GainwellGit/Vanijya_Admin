window.onload = function() {
//Module 1
//Static
var dataPoints = [];

var options =  {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Datewise Number of Registered Users"
	},
	axisY: {
		title: "Number of Registered Users",
		titleFontSize: 18,
		includeZero: false
	},
	axisX: {
		title: "Registration Date",
		titleFontSize: 18
		
	},
	data: [{
		type: "line", 
		connectNullData:true,
		yValueFormatString: "#0 user(s) registered",
		dataPoints: dataPoints
	}]
};

function addData(data) {
	for (var i = 0; i < data.length; i++) {
		dataPoints.push({
			label: data[i].event_date,
			y: parseInt(data[i].count_val) 
		});
	}
	$("#chartContainer").CanvasJSChart(options);

}
$.ajax({
									  dataType: "json",
									  url: 'http://demo.quizy.mobi/admin/report/getuserstat/',
									  method:'POST',
									  data: { flag: 0,dtype:0} ,
									  success: addData
									});
//Static End


$(document).ready(function(){
                    $(".target" ).change(function(){
                        var daterange = $("input[name='daterange']:checked").val();
                        var date1	  = $("input[name='datefrom']").val();
            			var date2     = $("input[name='dateto']").val();

            			if(daterange<4){
            							var date1="0";
            							var date2="0";
           								}
                        if (daterange==4) {
								            	$("#datepicker").show();
								            }
								            else{
								            	$("#datepicker").hide();
								            }

var dataPoints = [];

var options =  {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Datewise Number of Registered Users"
	},
	axisY: {
		title: "Number of Registered Users",
		titleFontSize: 18,
		includeZero: false
	},
	axisX: {
		title: "Registration Date",
		titleFontSize: 18
		
	},
	data: [{
		type: "line", 
		connectNullData:true,
		yValueFormatString: "#0 user(s) registered",
		dataPoints: dataPoints
	}]
};

function addData(data) {
	for (var i = 0; i < data.length; i++) {
		dataPoints.push({
			label: data[i].event_date,
			y: parseInt(data[i].count_val) 
		});
	}
	$("#chartContainer").CanvasJSChart(options);

}
$.ajax({
									  dataType: "json",
									  url: 'http://demo.quizy.mobi/admin/report/getuserstat/',
									  method:'POST',
									  data: { flag: daterange, d1: date1, d2: date2, dtype:0} ,
									  success: addData
									});



 			});
                      
    });

//Module 2
var dataPoints1 = [];

var options1 =  {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Datewise Number of Logged Users"
	},
	axisY: {
		title: "Number of Logged Users",
		titleFontSize: 18,
		includeZero: false
	},
	axisX: {
		title: "Login Date",
		titleFontSize: 18
		
	},
	data: [{
		type: "line", 
		connectNullData:true,
		yValueFormatString: "#0 user(s) logged in",
		dataPoints: dataPoints1
	}]
};

function addData1(data) {
	for (var i = 0; i < data.length; i++) {
		dataPoints1.push({
			label: data[i].event_date,
			y: parseInt(data[i].count_val) 
		});
	}
	$("#chartContainer1").CanvasJSChart(options1);

}
$.ajax({
									  dataType: "json",
									  url: 'http://demo.quizy.mobi/admin/report/getuserstat/',
									  method:'POST',
									  data: { flag: 0,dtype:1} ,
									  success: addData1
									});
//Static End


$(document).ready(function(){
                    $(".target1" ).change(function(){
                        var daterange1 = $("input[name='daterange1']:checked").val();
                        // if(daterange1){
                        // 	alert(daterange1);
                        // }
                        var date1a	  = $("input[name='datefrom1']").val();
            			var date2a     = $("input[name='dateto1']").val();

            			if(daterange1<4){
            							var date1a="0";
            							var date2a="0";
           								}
                        if (daterange1==4) {
								            	$("#datepicker1").show();
								            }
								            else{
								            	$("#datepicker1").hide();
								            }

var dataPoints1 = [];
var options1 =  {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Datewise Number of Logged Users"
	},
	axisY: {
		title: "Number of Logged Users",
		titleFontSize: 18,
		includeZero: false
	},
	axisX: {
		title: "Login Date",
		titleFontSize: 18
		
	},
	data: [{
		type: "line", 
		connectNullData:true,
		yValueFormatString: "#0 user(s) logged in",
		dataPoints: dataPoints1
	}]
};

function addData1(data) {
	for (var i = 0; i < data.length; i++) {
		dataPoints1.push({
			label: data[i].event_date,
			y: parseInt(data[i].count_val) 
		});
	}
	$("#chartContainer1").CanvasJSChart(options1);

}
$.ajax({
									  dataType: "json",
									  url: 'http://demo.quizy.mobi/admin/report/getuserstat/',
									  method:'POST',
									  data: { flag: daterange1, d1: date1a, d2: date2a, dtype:1} ,
									  success: addData1
									});



 			});
                      
    });
//Module 3
var dataPoints2 = [];

var options2 =  {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Datewise Number of Quiz Played"
	},
	axisY: {
		title: "Number of Quiz Played",
		titleFontSize: 18,
		includeZero: false
	},
	axisX: {
		title: "Date of Play",
		titleFontSize: 18
		
	},
	data: [{
		type: "line", 
		connectNullData:true,
		yValueFormatString: "#0 quiz(s) played",
		dataPoints: dataPoints2
	}]
};

function addData2(data) {
	for (var i = 0; i < data.length; i++) {
		dataPoints2.push({
			label: data[i].event_date,
			y: parseInt(data[i].count_val) 
		});
	}
	$("#chartContainer2").CanvasJSChart(options2);

}
$.ajax({
									  dataType: "json",
									  url: 'http://demo.quizy.mobi/admin/report/getuserstat/',
									  method:'POST',
									  data: { flag: 0,dtype:2} ,
									  success: addData2
									});
//Static End


$(document).ready(function(){
                    $(".target2" ).change(function(){
                        var daterange2 = $("input[name='daterange2']:checked").val();
                        // if(daterange1){
                        // 	alert(daterange1);
                        // }
                        var date1b	  = $("input[name='datefrom2']").val();
            			var date2b     = $("input[name='dateto2']").val();

            			if(daterange2<4){
            							var date1b="0";
            							var date2b="0";
           								}
                        if (daterange2==4) {
								            	$("#datepicker2").show();
								            }
								            else{
								            	$("#datepicker2").hide();
								            }

var dataPoints2 = [];
var options2 =  {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Datewise Number of Quiz Played"
	},
	axisY: {
		title: "Number of Quiz Played",
		titleFontSize: 18,
		includeZero: false
	},
	axisX: {
		title: "Date of Play",
		titleFontSize: 18
		
	},
	data: [{
		type: "line", 
		connectNullData:true,
		yValueFormatString: "#0 quiz(s) played",
		dataPoints: dataPoints2
	}]
};

function addData2(data) {
	for (var i = 0; i < data.length; i++) {
		dataPoints2.push({
			label: data[i].event_date,
			y: parseInt(data[i].count_val) 
		});
	}
	$("#chartContainer2").CanvasJSChart(options2);

}
$.ajax({
									  dataType: "json",
									  url: 'http://demo.quizy.mobi/admin/report/getuserstat/',
									  method:'POST',
									  data: { flag: daterange2, d1: date1b, d2: date2b, dtype:2} ,
									  success: addData2
									});



 			});
                      
    });








}