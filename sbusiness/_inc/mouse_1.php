<script>
	//1단 마우스 오버
	$(document).ready(function(){
		$("ul.headmenu li").mouseover(function(){
			$(this).stop().children("div.openMenu").show();
		})
		$("ul.headmenu li").mouseleave(function(){
			$(this).children("div.openMenu").hide();
		})

		$(".ham_full .ham").click(function(){
			$(".full_menu").addClass("active");
			$(".menu_back").addClass("active");
		})

		$(".full_menu .x a").click(function(){
			$(".full_menu").removeClass("active");
			$(".menu_back").removeClass("active");
		})
	});
	


</script>