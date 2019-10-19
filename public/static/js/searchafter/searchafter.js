$('.p2 .triangle-up').on('click',function(){
	var value=$(this).parent().next().val();
	if(value<10){
		value++;
		$(this).parent().next().val(value);
	}
})
$('.p2 .triangle-down').on('click',function(){
	var value=$(this).parent().next().val();
	if(value>=2){
		value=value-1;
		$(this).parent().next().val(value);
	}
})
$('.p1 li').on('click',function(){
	$(this).siblings().removeClass('selected');
	$(this).addClass('selected')
})
$('.search-dropdown .dropdown-menu li a').on('click',function(){
	$('.tab-selected').text($(this).text())
})

$('.search-dropdown .dropdown-menu li a').on('click',function(){
	$('.tab-selected').text($(this).text());
	$('#forphp').val($(this).text());
})