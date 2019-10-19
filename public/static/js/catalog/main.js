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
});

$(".libs > li").on('click',function(){
	$(".libs li").removeClass('li-selected');
	$(this).addClass('li-selected');
});

$(".organism-select .dropdown-menu li").on('click',function(){
	var text=$(this).html();
	$(".org-text").html(text)
});

function centerModals() { 
  $('.modal').each(function(i) { 
    var $clone = $(this).clone().css('display', 'block').appendTo('body'); 
    var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2); 
    top = top > 50 ? top : 0; 
    $clone.remove(); 
    $(this).find('.modal-content').css("margin-top", top - 50); 
  }); 
} 
// 在模态框出现的时候调用垂直居中方法 
$('.modal').on('show.bs.modal', centerModals); 
// 在窗口大小改变的时候调用垂直居中方法 
$(window).on('resize', centerModals);


$(".nav-dropdown").on('click',function(){
	if($(".top-part").hasClass('top-hidden')){
		$(".top-part").removeClass('top-hidden');
		$(".nav-top").removeClass('nav-hidden');
		$(".nav-part").css({top:'100%'});
		$('body').removeClass('body-collapse');
		$('.main-content').addClass('col-sm-10').addClass('col-sm-offset-2');
	}
	else{
		$(".top-part").addClass('top-hidden');
		$(".nav-top").addClass('nav-hidden');
		$(".nav-part").css({top:'-500px'});
		$('body').addClass('body-collapse');
		$('.main-content').removeClass('col-sm-10').removeClass('col-sm-offset-2');
	}
})

$('#xs-btn').on('click',function(){
	var content=$(".navbar-header + div");
	if(content.hasClass('collapse')){
		$(content).removeClass('collapse');
		// 点击后判断竖屏与横屏
		if(window.orientation == 90 || window.orientation == -90){
			$('.nav-part-xs').removeClass('hidden-xs').removeClass('hidden');
		}
		if(window.orientation == 180 || window.orientation == 0){
			$('.nav-part').removeClass('hidden-xs');
		}
	}
	else{
		$(content).addClass('collapse');
		$('.nav-part').addClass('hidden-xs');
		$('.nav-part-xs').addClass('hidden-xs');
	}
})

window.onorientationchange=function(){
	$(".navbar-header + div").addClass('collapse');
	$('.nav-part').addClass('hidden-xs');
	$('.nav-part-xs').addClass('hidden-xs');
	// 每次旋转都进行一次初始化，防止只有一次点击事件而出现bug
	if(window.orientation == 90 || window.orientation == -90){ 
		// 竖屏显示
		$('.nav-part-xs').removeClass('hidden');
		$('.nav-part').addClass('hidden');
	}
		// 横屏显示
	if (window.orientation == 180 || window.orientation == 0){
		$('.nav-part').removeClass('hidden');
		$('.nav-part-xs').addClass('hidden');
	}
}

$(function(){
	var str=$('.sequence-text').html();
	if(str.length>300){
		$('.sequence-text').html(str.substring(0,297)+'...')
	}
})