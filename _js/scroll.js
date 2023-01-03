$(document).ready(function(){
	
	
	if (document.body.clientWidth > 980) { //웹

		$("ul.history_box > li").eq(0).addClass("his_view");
		$(window).scroll(function() {
			var scroll = $(window).scrollTop();
			var list = $("ul.history_box > li");
			//메인
			if (scroll >= 300) {
				$(".main_cont01").addClass("t_view");
			}

			if (scroll >= 750) {
				$(".main_cont02").addClass("t_view");
			}
			if (scroll >= 1200) {
				$(".main_cont03").addClass("t_view");
			}

			if (scroll >= 1650) {
				$(".main_cont04").addClass("t_view");
			}

			//연혁
			if(scroll >= 200) {
				$(list).eq(1).addClass("his_view");
			}
			if (scroll >= 600) {
				$(list).eq(2).addClass("his_view");
			}
			if (scroll >= 1000) {
				$(list).eq(3).addClass("his_view");
			}
			if (scroll >= 1400) {
				$(list).eq(4).addClass("his_view");
			}
			if (scroll >= 1600) {
				$(list).eq(5).addClass("his_view");
			}

			//함께해요
			if(scroll >= 400){
				$("span.join_mail_02").addClass("ani02");
				$("span.join_mail_01").addClass("ani01");
			}
		});



	}

	if (document.body.clientWidth < 980) {
		
		$("ul.history_box > li").eq(0).addClass("his_view");
		$(window).scroll(function() {
			var scroll = $(window).scrollTop();
			var list = $("ul.history_box > li");
			//메인
			if (scroll >= 150) {
				$(".main_cont01").addClass("t_view");
			}

			if (scroll >= 450) {
				$(".main_cont02").addClass("t_view");
			}
			if (scroll >= 800) {
				$(".main_cont03").addClass("t_view");
			}

			if (scroll >= 1200) {
				$(".main_cont04").addClass("t_view");
			}

			//연혁
			if(scroll >= 10) {
				$(list).eq(1).addClass("his_view");
			}
			if (scroll >= 300) {
				$(list).eq(2).addClass("his_view");
			}
			if (scroll >= 600) {
				$(list).eq(3).addClass("his_view");
			}
			if (scroll >= 800) {
				$(list).eq(4).addClass("his_view");
			}
			if (scroll >= 1000) {
				$(list).eq(5).addClass("his_view");
			}

			//함께해요
			if(scroll >= 100){
				$("span.join_mail_02").addClass("ani02");
				$("span.join_mail_01").addClass("ani01");
			}
		});

		

	}

	if (document.body.clientWidth < 640) {
		
		$("ul.history_box > li").eq(0).addClass("his_view");
		$(window).scroll(function() {
			var scroll = $(window).scrollTop();
			var list = $("ul.history_box > li");
			
			//메인
			if (scroll >= 0) {
				$(".main_cont01").addClass("t_view");
			}

			if (scroll >= 300) {
				$(".main_cont02").addClass("t_view");
			}
			if (scroll >= 800) {
				$(".main_cont03").addClass("t_view");
			}

			if (scroll >= 900) {
				$(".main_cont04").addClass("t_view");
			}

			//연혁
			if(scroll >= 10) {
				$(list).eq(1).addClass("his_view");
			}
			if (scroll >= 280) {
				$(list).eq(2).addClass("his_view");
			}
			if (scroll >=450) {
				$(list).eq(3).addClass("his_view");
			}
			if (scroll >= 600) {
				$(list).eq(4).addClass("his_view");
			}
			if (scroll >= 800) {
				$(list).eq(5).addClass("his_view");
			}

			//함께해요
			if(scroll >= 150){
				$("span.join_mail_02").addClass("ani02");
				$("span.join_mail_01").addClass("ani01");
			}
		});

		


	}


});