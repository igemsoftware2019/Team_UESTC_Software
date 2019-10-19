// $(".libs>li>a").on('click',function(){
// 		if($(this).next('ul').css('display')=='none'){
// 			$(".libs>li>a").next('ul').slideUp(300)
// 			$(this).next('ul').slideDown(300)
// 			$(this).parent('li').addClass('nav-show').siblings('li').removeClass('nav-show');
// 		}else{
// 			$(this).next('ul').slideUp(300)
// 			$('.libs .nav-show').removeClass('nav-show');
// 		}
// })
// 左侧导航栏的展开

$(".libs>li>ul>li>a,#Download_nav>a").on('click',function(){
	$('html, body').stop().animate({
                scrollTop: $($(this).attr('href')).offset().top - 150
            }, 500);
	return false;
})








