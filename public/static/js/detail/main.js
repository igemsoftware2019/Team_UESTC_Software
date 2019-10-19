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
$(window).scroll(function(){
				
				$('.libs>li>ul>li:not(.banned)>a').each(function(){
					var target = $($(this).attr('href')).offset().top-150;
					var up = $(window).scrollTop();
					if(up >= target){
						$('.libs>li').removeClass('li-selected');
						$(this).parent().parent().parent().addClass('li-selected');
						
						// $(this).sibling().removeClass('nav__item--current');
						// alert('1')
					}
				})
				
			})

$(".libs > li").on('click',function(){
	$(".libs li").removeClass('li-selected');
	$(this).addClass('li-selected');
});

$(".organism-select .dropdown-x-menu li").on('click', function() {
	var text = $(this).children('a').html();
	$(".org-text").html(text);
	$(this).parent('.dropdown-x-menu').parent('.dropdown-x').removeClass('open');
	if (text == "the all organisms") {
		$('.org-table1 > div div.dialog table tr').removeClass('hidden');
		
		$('.Enzyme_Basical_Information > div .dialog').each(function(index, el) {
			var tr_inner = $(this).find('table tbody tr').eq(0).html();
			$('.Enzyme_Basical_Information > table tbody tr:eq(' + index + ') td:first-child').siblings().remove();
			$('.Enzyme_Basical_Information > table tbody tr:eq(' + index + ')').append(tr_inner);
			$('.Enzyme_Basical_Information > table tbody tr:eq(' + index + ') td:first-child button').show();
		})
		
		$('.Enzyme_Experiment_Information > div .dialog').each(function(index, el) {
			var tr_inner = $(this).find('table tbody tr').eq(0).html();
			$('.Enzyme_Experiment_Information > table tbody tr:eq(' + index + ') td:first-child').siblings().remove();
			$('.Enzyme_Experiment_Information > table tbody tr:eq(' + index + ')').append(tr_inner);
			$('.Enzyme_Experiment_Information > table tbody tr:eq(' + index + ') td:first-child button').show();
		})
		
		$('.org-table2 table tr').removeClass('hidden');
		$('.org-table2 .blank-row').remove();
		
	}else {
		$('.Enzyme_Basical_Information > div .dialog').each(function(index, el) {
			$(this).find('table tbody tr').addClass('hidden');
			$(this).find('table tbody tr td:contains(' + text + ')').parent('tr').removeClass('hidden');
			var tr_inner = $(this).find('table tbody tr td:contains(' + text + ')').parent('tr').eq(0).html();
			$('.Enzyme_Basical_Information > table tbody tr:eq(' + index + ') td:first-child').siblings().remove();
			if (tr_inner == null) {
				$('.Enzyme_Basical_Information > table tbody tr:eq(' + index + ')').append('<td colspan="4">None</td>');
				$('.Enzyme_Basical_Information > table tbody tr:eq(' + index + ') td:first-child button').hide();
			} else {
				$('.Enzyme_Basical_Information > table tbody tr:eq(' + index + ')').append(tr_inner);
				$('.Enzyme_Basical_Information > table tbody tr:eq(' + index + ') td:first-child button').show();
				
			}
		})
		
		$('.Enzyme_Experiment_Information > div .dialog').each(function(index, el) {
			$(this).find('table tbody tr').addClass('hidden');
			$(this).find('table tbody tr td:contains(' + text + ')').parent('tr').removeClass('hidden');
			var tr_inner = $(this).find('table tbody tr td:contains(' + text + ')').parent('tr').eq(0).html();
			$('.Enzyme_Experiment_Information > table tbody tr:eq(' + index + ') td:first-child').siblings().remove();
			if (tr_inner == null) {
				$('.Enzyme_Experiment_Information > table tbody tr:eq(' + index + ')').append('<td colspan="4">None</td>');
				$('.Enzyme_Experiment_Information > table tbody tr:eq(' + index + ') td:first-child button').hide();
			} else {
				$('.Enzyme_Experiment_Information > table tbody tr:eq(' + index + ')').append(tr_inner);
				$('.Enzyme_Experiment_Information > table tbody tr:eq(' + index + ') td:first-child button').show();
			}
		})
		
		$('.org-table2').each(function(){
			$(this).find('table tbody tr').addClass('hidden');
			$(this).find('table tbody tr td:contains(' + text + ')').parent('tr').removeClass('hidden');
			var tr_inner = $(this).find('table tbody tr td:contains(' + text + ')').parent('tr').eq(0).html();
			if(tr_inner == null){
				var cow=$(this).find('table thead th').length;
				$(this).find('table tbody').append('<tr><td class="blank-row" colspan="'+cow+'">None</td></tr>')
			}
		})
	}
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
	if($(".nav-top").hasClass('nav-hidden')){
		// $(".top-part").removeClass('top-hidden');
		$(".nav-top").removeClass('nav-hidden');
		$(".nav-part").css({top:'100%'});
		$('body').removeClass('body-collapse');
		$('.main-content').addClass('col-sm-10').addClass('col-sm-offset-2');
	}
	else{
		// $(".top-part").addClass('top-hidden');
		$(".nav-top").addClass('nav-hidden');
		$(".nav-part").css({top:'-440px'});
		$('body').addClass('body-collapse');
		$('.main-content').removeClass('col-sm-10').removeClass('col-sm-offset-2');
	}
})

$(function() {
	if ($(window).height()<660) {
		$('#xs-btn').addClass('show-s');
		$('.main-content').removeClass('col-sm-10').removeClass('col-sm-offset-2');
	}
	else{
		$('.nav-part').show();
		$('.navbar-nav').show();
		$('.nav-dropdown').show();
	}
})
$(window).resize(function() {
	if ($(window).height()<660) {
		$('#xs-btn').addClass('show-s');
		$('.nav-part').hide();
		$('.navbar-nav').hide();
		$('.nav-dropdown').hide();
		$('.main-content').removeClass('col-sm-10').removeClass('col-sm-offset-2');
	}
	else{
		$('#xs-btn').removeClass('show-s');
		$('.nav-part').show();
		$('.navbar-nav').show();
		$('.nav-dropdown').show();
		$('.main-content').addClass('col-sm-10').addClass('col-sm-offset-2');
	}
	if($(window).width()<768){
		$('.nav-part').hide();
		$('.nav-dropdown').hide();
	}
})

$('#xs-btn').on('click', function() {
	var content = $(".navbar-header + div");
	if (content.hasClass("collapse")) {
		// 点击后判断竖屏与横屏
		if ($(window).height()<660) {
			$('.nav-part-xs').removeClass('hidden');
		}
		else{
			$('.nav-part').show();
		}
	} else {
		$('.nav-part').hide();
		$('.nav-part-xs').addClass('hidden');
	}
})

$(function(){
	$('.sequence-text').each(function(){
		var str=$(this).html();
		if(str.length>800){
			$(this).html(str.substring(0,290)+'...');
			$(this).next().removeClass('hidden');
		}
	}) 

})


// bootstrap替换js dropdown
$('.dropdown-x .dropdown-x-toggle').click(function(event) {
	var target = $(this).parent('.dropdown-x');
	target.siblings().removeClass('open');
	if ($(this).next().is(':hidden')) {
		target.addClass('open');
	} else {
		target.removeClass('open');
	}
})
//点击其他地方隐藏下拉菜单
$(document).bind('click', function(e) {
	var e = e || window.event; //浏览器兼容性
	var elem = e.target || e.srcElement;
	while (elem) { //循环判断至根节点，防止点击的是目标子元素
		if ($(elem).hasClass('dropdown-x')) {
			return;
		}
		elem = elem.parentNode;
	}
	$('.dropdown-x').removeClass('open'); //点击的不是目标或其子元素
});

$('.nav-tabs li').on('click',function(){
	$(this).addClass('active');
	$(this).siblings().removeClass('active');
})

// 代替模态框
$('.dialog_open').on('click',function(){
	var tar = $($(this).attr('href'))
	tar.children('.mask').show();
	tar.children('.dialog').show();
		$('body').css('overflow','hidden');
	})
	$('.dialog_close').on('click',function(){
		$(this).parents('.dialog').hide();
		$(this).parents('.dialog').prev().hide();
		$('body').css('overflow','scroll');
	})
	$('.mask').on('click',function(){
		$('.mask').hide();
		$('.dialog').hide();
		$('body').css('overflow','scroll');
	})

// bootstrap替换js dropup
$('.dropup-x .dropdown-x-toggle').click(function(event) {
	var target = $(this).parent('.dropup-x');
	target.siblings().removeClass('open');
	if ($(this).next().is(':hidden')) {
		target.addClass('open');
	} else {
		target.removeClass('open');
	}
})
//点击其他地方隐藏下拉菜单
$(document).bind('click', function(e) {
	var e = e || window.event; //浏览器兼容性
	var elem = e.target || e.srcElement;
	while (elem) { //循环判断至根节点，防止点击的是目标子元素
		if ($(elem).hasClass('dropup-x')) {
			return;
		}
		elem = elem.parentNode;
	}
	$('.dropup-x').removeClass('open'); //点击的不是目标或其子元素
});
$('.nav-tabs li').on('click',function(){
	$(this).addClass('active');
	$(this).siblings().removeClass('active');
})
