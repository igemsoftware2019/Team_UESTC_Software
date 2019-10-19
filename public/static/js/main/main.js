$(function(){
	
	var width_full = window.screen.availWidth;
	
	var len=$(".main_banner li").length;
	var index_2=0;
	var timer=800;
	var intervaltimer=0;
	var isMoving=false;
	var h_c_width="20%"; var h_c_height="20%"; var h_c_top="60px"; var h_c_left="0px"; var h_c_opacity=0; var h_c_else_left="400px";
	var h_s_width="40%"; var h_s_height="90%"; var h_s_top="20px"; var h_s_left="0px"; var h_s_opacity=1; var h_s_else_left="60%";
	var c_s_width="40%"; var c_s_height="90%"; var c_s_top="20px"; var c_s_left="60%"; var c_s_opacity=1; var c_s_else_left="0px";
	var n_s_width="20%"; var n_s_height="20%"; var n_s_top="60px"; var n_s_left="400px"; var n_s_opacity=0; 
	var n_s_else_width="60%"; var n_s_else_height="97%"; var n_s_else_top="0px"; var n_s_else_left="20%"; var n_s_else_opacity=1; 
	var p_s_width="60%"; var p_s_height="97%"; var p_s_top="0px"; var p_s_left="20%"; var p_s_opacity=1;
	var p_s_else_width="20%"; var p_s_else_height="20%"; var p_s_else_top="60px"; var p_s_else_left="0px"; var p_s_else_opacity=0;
	var f_c_bottom="-50px";
	
	
	function slide(slideMode){//轮播方法		
		if (isMoving==false){
			isMoving=true;
			var prev; var next; var hidden;
			var curr=$("#imgCard"+index_2);//当前正中显示
			
			if(index_2==0){								//当前正中显示的是第0张时 prev为最后一张
				prev=$("#imgCard"+(len-1));					
			}else{												//否则  序列号-1
				prev=$("#imgCard"+(index_2-1)); 		
			}
			if(index_2==(len-1)){					//当前正中显示的是最后一张时 next为第0张
				next=$("#imgCard0");
			}else{											//否则  序列号+1
				next=$("#imgCard"+(index_2+1));
			}
	
			if(slideMode){			//slideMode为1(true)，执行slide(1)，上一张
				if(index_2-2>=0){									//index_2						2		3		4
					hidden=$("#imgCard"+(index_2-2));//									0		1		2
				}else{													//index_2		0		1
					hidden=$("#imgCard"+(len+index_2-2));//			3		4
				}
				prev.css("z-index","7");			//点击prev按钮  让prev位置上的这张图片 层级最高 显示
				next.css("z-index","1");
				curr.css("z-index","2");			
				hidden.css("z-index","1");
				//当index_2自减，各图片往右运动效果
				
				hidden.css({width:h_c_width,height:h_c_height,top:h_c_top,"left":h_c_left,"opacity":h_c_opacity});
				hidden.stop(true,true).animate({width:h_s_width,height:h_s_height,top:h_s_top,left:h_s_left,opacity:h_s_opacity},timer);
				curr.stop(true,true).animate({width:c_s_width,height:c_s_height,top:c_s_top,left:c_s_left,opacity:c_s_opacity},timer);
				next.stop(true,true).animate({width:n_s_width,height:n_s_height,top:n_s_top,"left":n_s_left,"opacity":n_s_opacity},timer,function(){next.find("span").css("opacity",0); isMoving = false;});
				//prev  -->  curr     prev中的图片li轮换到curr的位置      其他一次轮换
				prev.find("span").css("opacity",0);
				$(".main_banner_box li").find("p").css({"bottom":f_c_bottom});//所有标题隐藏
				prev.stop(true,true).animate({width:p_s_width,height:p_s_height,top:p_s_top, left:p_s_left,opacity:p_s_opacity},timer,function(){
					$(this).find("p").animate({"bottom":"0px"});	//当前这张图片的标题运动出来
				});
				index_2--;
			}else{			//执行next 操作
				if(index_2+2>=len){								//index_2								3		4	
					hidden=$("#imgCard"+(index_2+2-len));//										0		1
				}else{													//index_2		0		1		2
					hidden=$("#imgCard"+(index_2+2));//						2		3		4
				}
				prev.css("z-index","1");
				next.css("z-index","7");			//点击next按钮  让next位置上的这张图片 层级最高 显示
				curr.css("z-index","2");
				hidden.css("z-index","1");
				//当index_2自增，各图片往左运动效果
				
				hidden.css({width:h_c_width,height:h_c_height,top:h_c_top,"left":h_c_else_left,"opacity":h_c_opacity});
				hidden.stop(true,true).animate({width:h_s_width,height:h_s_height,top:h_s_top,left:h_s_else_left,opacity:h_s_opacity},timer);
				curr.stop(true,true).animate({width:c_s_width,height:c_s_height,top:c_s_top,left:c_s_else_left,opacity:c_s_opacity},timer);
				//next  -->  curr     next中的图片li轮换到curr的位置      其他一次轮换
				next.find("span").css("opacity",0);
				$(".main_banner_box li").find("p").css({"bottom":f_c_bottom});//所有标题隐藏
				next.stop(true,true).animate({width:n_s_else_width,height:n_s_else_height,top:n_s_else_top,"left":n_s_else_left,"opacity":n_s_else_opacity},timer,function(){
					$(this).find("p").animate({"bottom":"0px"});	//当前这张图片的标题运动出来
				});
				prev.stop(true,true).animate({width:p_s_else_width,height:p_s_else_height,top:p_s_else_top,left:p_s_else_left,opacity:p_s_else_opacity},timer,function(){
					isMoving = false;
				}); 
				index_2++;	
			}//if else
	
			hidden.find("span").css("opacity",0.5);
			curr.find("span").css("opacity",0.5);
	
			if(index_2==len) index_2=0;
			if(index_2<0) index_2=len+index_2;			//限制index_2的范围
			$(".btn_list span").removeClass('curr').eq(index_2).addClass('curr');//给序列号按钮添加、移除样式
		}
	}//slide()


	if(len>3){
		//序列号按钮 跳序切换 方法
		$(".btn_list span").click(function(event){
			
			if (isMoving ) return;
			var oIndex=$(this).index();
	
			if(oIndex==index_2) return;//点击按钮的序列号与当前图片的序列号一致，return
			clearInterval(intervaltimer)
			intervaltimer=null;
	
			var flag=false;
			//当前显示图片的序列号  和  被点击按钮的序列号  间隔超过1且不是首尾两个的时候
			if(Math.abs(index_2-oIndex)>1&&Math.abs(len-Math.abs(index_2-oIndex))!=1){
				//统一样式
				$(".main_banner_box li").css({width:"300px",height:"120px",left:"640px",top:"60px",opacity:0});
				//如果当前的序列号   比    被点击按钮序列号     大     而且     不相邻、不是首尾  
				if(index_2>oIndex&&len-Math.abs(index_2-oIndex)!=1){
					flag=true;
					index_2=oIndex+1;		//oIndex+1    通过slide()  运动回上一张    oIndex
				}else{//比   小     而且     不相邻、不是首尾
					index_2=oIndex-1;		//oIndex-1     通过slide()  运动到下一张    oIndex
					if(index_2<0) index_2=len-1;
				}
			}else{//当前 比 被点击  大	且   相邻									//从0    跳到     4		要执行上一张方法
				if((index_2>oIndex&&len-(index_2-oIndex)!=1)||(index_2<oIndex&&len+(index_2-oIndex)==1)){
					flag=true;			//执行上一张
				}
			}
			slide(flag);
			intervaltimer=setInterval(slide,3000);//自动轮播
			
		});
	
		$(".main_banner_box li").on("mousemove",function(){
			if($(this).css("width")=="650px"){//鼠标移入为当前正中显示的图片li，则清除定时器
				clearInterval(intervaltimer);
				intervaltimer=null;
			}
		}).on("mouseout",function(){//鼠标移除重新滚动
				clearInterval(intervaltimer);
				intervaltimer=null;
				intervaltimer=setInterval(slide,3000);
		});
		
		$(".js_pre").click(function(event){//上一张
			if (isMoving ) return;
			clearInterval(intervaltimer);
			intervaltimer=null;
			slide(1);
			intervaltimer=setInterval(slide,3000);
		});
	
		$(".js_next").click(function(event){//下一张
			if (isMoving ) return;
			clearInterval(intervaltimer);
			intervaltimer=null;
			slide();
			intervaltimer=setInterval(slide,3000);        
		});
		
		intervaltimer=setInterval(slide,3000);
		
	}else{
		
		$(".js_pre").hide();
		$(".js_next").hide();
		
	}//if else

});

$('.search-dropdown .dropdown-menu li a').on('click',function(){
	$('.tab-selected').text($(this).text());
	$('#forphp').val($(this).text());
})