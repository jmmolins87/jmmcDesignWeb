// JavaScript Document

$(document).ready(function(){
 				"use strict";
	$('.ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 1000);
	});
 
	$(window).scroll(function(){
		if( $(this).scrollTop() > 0 ){
			$('.ir-arriba').fadeIn(1000);
		} else {
			$('.ir-arriba').fadeOut(1000);
		}
	});
 
});