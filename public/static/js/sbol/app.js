var 
	gridDemo1 = document.getElementById('gridDemo-up'),
	gridDemo2 = document.getElementById('gridDemo-down');

// Grid demo

new Sortable(gridDemo1, {
	group: {
		name: 'shared',
		pull: 'clone',
	},
	sort: false // To disable sorting: set sort to false
});

new Sortable(gridDemo2, {
	group: {
	name:'shared',
	put:'false',
	forceFallback: true,
	},
	animation: 250,
	onRemove: function(){
		document.getElementById("gridDemo-up").innerHTML = "999999999999999\n999999999999999\n999999999999999\n999999999999999";//当移动触发事件，清空上部分即垃圾箱的所有东西，防止出现上部分还存有feature的情况。
		var Elemmm = document.getElementsByClassName("tooltip fade top in");//当移动触发事件，清空浮窗，否则将有残留
		for(var i=0; i<Elemmm.length; i++){
			Elemmm[i].innerHTML = "";
		}
		

	},//也可以放上面，但是好像下面效果更好。
	onChoose: function(){//当进行移动时，隐藏所有悬浮窗
		$('span[id*=tooltip]').hide();
		$('span[id*=arrow]').hide();
	},
	onMove:function(){
		$('span[id*=tooltip]').hide();
		$('span[id*=arrow]').hide();
	},
	onEnd:function(){
		dynamicCount();
	}
	
});
