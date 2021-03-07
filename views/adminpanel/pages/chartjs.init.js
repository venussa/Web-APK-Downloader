/*
 Template Name: Upcube - Bootstrap 4 Admin Dashboard
 Author: Themesdesign
 Website: www.themesdesign.in
 File: Chart js 
 */

!function(r){"use strict";var o=function(){};o.prototype.respChart=function(o,e,a,t){function n(){o.attr("width",r(d).width());switch(e){case"Line":new Chart(i,{type:"line",data:a,options:t});break;case"Doughnut":new Chart(i,{type:"doughnut",data:a,options:t});break;case"Pie":new Chart(i,{type:"pie",data:a,options:t});break;case"Bar":new Chart(i,{type:"bar",data:a,options:t});break;case"Radar":new Chart(i,{type:"radar",data:a,options:t});break;case"PolarArea":new Chart(i,{data:a,type:"polarArea",options:t})}}var i=o.get(0).getContext("2d"),d=r(o).parent();r(window).resize(n),n()},o.prototype.init=function(){var o={labels:["January","February","March","April","May","June","July","August","September","October"],datasets:[{label:"Sales Analytics",fill:!0,lineTension:.5,backgroundColor:"rgba(0, 151, 167, 0.2)",borderColor:"#0097a7",borderCapStyle:"butt",borderDash:[],borderDashOffset:0,borderJoinStyle:"miter",pointBorderColor:"#0097a7",pointBackgroundColor:"#fff",pointBorderWidth:1,pointHoverRadius:5,pointHoverBackgroundColor:"#0097a7",pointHoverBorderColor:"#eef0f2",pointHoverBorderWidth:2,pointRadius:1,pointHitRadius:10,data:[65,59,80,81,56,55,40,55,30,80]},{label:"Monthly Earnings",fill:!0,lineTension:.5,backgroundColor:"rgba(235, 239, 242, 0.2)",borderColor:"#ebeff2",borderCapStyle:"butt",borderDash:[],borderDashOffset:0,borderJoinStyle:"miter",pointBorderColor:"#ebeff2",pointBackgroundColor:"#fff",pointBorderWidth:1,pointHoverRadius:5,pointHoverBackgroundColor:"#ebeff2",pointHoverBorderColor:"#eef0f2",pointHoverBorderWidth:2,pointRadius:1,pointHitRadius:10,data:[80,23,56,65,23,35,85,25,92,36]}]},e={scales:{yAxes:[{ticks:{max:100,min:20,stepSize:10}}]}};this.respChart(r("#lineChart"),"Line",o,e);var a={labels:["Desktops","Tablets"],datasets:[{data:[300,210],backgroundColor:["#0097a7","#ebeff2"],hoverBackgroundColor:["#0097a7","#ebeff2"],hoverBorderColor:"#fff"}]};this.respChart(r("#doughnut"),"Doughnut",a);var t={labels:["Desktops","Tablets"],datasets:[{data:[300,180],backgroundColor:["#0f9cf3","#ebeff2"],hoverBackgroundColor:["#0f9cf3","#ebeff2"],hoverBorderColor:"#fff"}]};this.respChart(r("#pie"),"Pie",t);var n={labels:["January","February","March","April","May","June","July"],datasets:[{label:"Sales Analytics",backgroundColor:"#77c949",borderColor:"#77c949",borderWidth:1,hoverBackgroundColor:"#77c949",hoverBorderColor:"#77c949",data:[65,59,81,45,56,80,50,20]}]};this.respChart(r("#bar"),"Bar",n);var i={labels:["Eating","Drinking","Sleeping","Designing","Coding","Cycling","Running"],datasets:[{label:"Desktops",backgroundColor:"rgba(179,181,198,0.2)",borderColor:"rgba(179,181,198,1)",pointBackgroundColor:"rgba(179,181,198,1)",pointBorderColor:"#fff",pointHoverBackgroundColor:"#fff",pointHoverBorderColor:"rgba(179,181,198,1)",data:[65,59,90,81,56,55,40]},{label:"Tablets",backgroundColor:"rgba(103, 168, 228, 0.2)",borderColor:"#67a8e4",pointBackgroundColor:"#67a8e4",pointBorderColor:"#fff",pointHoverBackgroundColor:"#fff",pointHoverBorderColor:"#67a8e4",data:[28,48,40,19,96,27,100]}]};this.respChart(r("#radar"),"Radar",i);var d={datasets:[{data:[11,16,7,18],backgroundColor:["#77c949","#0097a7","#ffbb44","#f32f53"],label:"My dataset",hoverBorderColor:"#fff"}],labels:["Series 1","Series 2","Series 3","Series 4"]};this.respChart(r("#polarArea"),"PolarArea",d)},r.ChartJs=new o,r.ChartJs.Constructor=o}(window.jQuery),function(r){"use strict";r.ChartJs.init()}(window.jQuery);
