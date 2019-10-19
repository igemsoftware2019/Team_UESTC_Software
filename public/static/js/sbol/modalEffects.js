/**
 * modalEffects.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
var ModalEffects = (function() {
//，函数名就是modaleffect    一定会触发，刚开始时触发，加载到这个js文件 
	function init() {
//定义函数，后面使用 
		var overlay = document.querySelector( '.md-overlay' );
// querySelector是匹配class选择器的第一个子元素，querryselectorAll返回一个list，md-overlay只有一个无需考虑
		[].slice.call( document.querySelectorAll( '.md-trigger' ) ).forEach( function( el, i ) {//添加事件只需要改一下这个.md-trigger
//foreach  相当于 数组 a[i] = el，  还有第三位元素此处没列出代表a    花括号内可选。传递给函数的值一般用 "this" 值。
//如果这个参数为空， "undefined" 会传递给 "this" 值
			var modal = document.querySelector( '#' + el.getAttribute( 'data-modal' ) ),
				close = modal.querySelector( '.md-close' );
//getattribute直接得到modal-16，#demo 是针对id
			function removeModal( hasPerspective ) {
				classie.remove( modal, 'md-show' );
//hasPerspective定义变量，参数      
				if( hasPerspective ) {
					classie.remove( document.documentElement, 'md-perspective' );
				}
			}

			function removeModalHandler() {
				removeModal( classie.has( el, 'md-setperspective' ) ); 
			}
//关闭window
			el.addEventListener( 'click', function( ev ) {
				classie.add( modal, 'md-show' );
				// overlay.removeEventListener( 'click', removeModalHandler );
				overlay.addEventListener( 'click', removeModalHandler );
//EventListener前面是触发方式，后面是触发的函数
				if( classie.has( el, 'md-setperspective' ) ) {
					setTimeout( function() {
						classie.add( document.documentElement, 'md-perspective' );
					}, 25 );
				}
			});

			close.addEventListener( 'click', function( ev ) {
				ev.stopPropagation();
				removeModalHandler();
			});

		} );

	}

	init();

})();


//添加后修改的弹窗
	function dontknow(){

	function init() {

		var overlay = document.querySelector( '.md-overlay' );

		[].slice.call( document.querySelectorAll( '.md-mr-dd' ) ).forEach( function( el, i ) {

			var modal = document.querySelector( '#' + el.getAttribute( 'data-modal' ) ),
				close = modal.querySelector( '.md-close' );

			function removeModal( hasPerspective ) {
				classie.remove( modal, 'md-show' );

				if( hasPerspective ) {
					classie.remove( document.documentElement, 'md-perspective' );
				}
			}

			function removeModalHandler() {
				removeModal( classie.has( el, 'md-setperspective' ) ); 
			}
			
			

				function buttonno3() {
					classie.add( modal, 'md-show' );
					// overlay.removeEventListener( 'click', removeModalHandler );
					overlay.addEventListener( 'click', removeModalHandler );
				
					if( classie.has( el, 'md-setperspective' ) ) {
						setTimeout( function() {
							classie.add( document.documentElement, 'md-perspective' );
						}, 25 );
					}
					getMemberId = el.getAttribute( 'id' );
				}
			var neibubianliang3 = el.getAttribute("class");
			if(neibubianliang3.indexOf("line") == -1){//当有module存在的时候不给双击事件
				el.addEventListener( 'dblclick',buttonno3);
			}
			// el.addEventListener( 'dblclick',buttonno3);
//添加事件监听器, getMemberId获得双击事件的id
		
			close.addEventListener( 'click', function( ev ) {
				ev.stopPropagation();
				removeModalHandler();
			});

		} );

	}

	init();

}
dontknow();

function newName() {
//，函数名就是modaleffect    一定会触发，刚开始时触发，加载到这个js文件 
	function init() {
//定义函数，后面使用 
		var overlay = document.querySelector( '.md-overlay' );
// querySelector是匹配class选择器的第一个子元素，querryselectorAll返回一个list，md-overlay只有一个无需考虑
		[].slice.call( document.querySelectorAll( '.md-conment' ) ).forEach( function( el, i ) {
//foreach  相当于 数组 a[i] = el，  还有第三位元素此处没列出代表a    花括号内可选。传递给函数的值一般用 "this" 值。
//如果这个参数为空， "undefined" 会传递给 "this" 值
			var modal = document.querySelector( '#' + el.getAttribute( 'data-modal' ) );
				close = modal.querySelector( '.md-close' );
//getattribute直接得到modal-14，#demo 是针对id
			function removeModal( hasPerspective ) {
				classie.remove( modal, 'md-show' );
//hasPerspective定义变量，参数      
				if( hasPerspective ) {
					classie.remove( document.documentElement, 'md-perspective' );
				}
			}

			function removeModalHandler() {
				removeModal( classie.has( el, 'md-setperspective' ) ); 
			}
//关闭window
			el.addEventListener( 'click', function( ev ) {
				classie.add( modal, 'md-show' );
				// overlay.removeEventListener( 'click', removeModalHandler );
				overlay.addEventListener( 'click', removeModalHandler );
//EventListener前面是触发方式，后面是触发的函数
				if( classie.has( el, 'md-setperspective' ) ) {
					setTimeout( function() {
						classie.add( document.documentElement, 'md-perspective' );
					}, 25 );
				}
			});

			close.addEventListener( 'click', function( ev ) {
				ev.stopPropagation();
				removeModalHandler();
			});

		} );

	}

	init();
}
newName();


function tanchuang() {
//，函数名就是modaleffect    一定会触发，刚开始时触发，加载到这个js文件 
	function init() {
//定义函数，后面使用 
		var overlay = document.querySelector( '.md-overlay' );
// querySelector是匹配class选择器的第一个子元素，querryselectorAll返回一个list，md-overlay只有一个无需考虑
		[].slice.call( document.querySelectorAll( '.md-tanchuang' ) ).forEach( function( el, i ) {
//foreach  相当于 数组 a[i] = el，  还有第三位元素此处没列出代表a    花括号内可选。传递给函数的值一般用 "this" 值。
//如果这个参数为空， "undefined" 会传递给 "this" 值
			var modal = document.querySelector( '#' + el.getAttribute( 'data-modal' ) );
				close = modal.querySelector( '.md-close' );
//getattribute直接得到modal-14，#demo 是针对id
			function removeModal( hasPerspective ) {
				classie.remove( modal, 'md-show' );
//hasPerspective定义变量，参数      
				if( hasPerspective ) {
					classie.remove( document.documentElement, 'md-perspective' );
				}
			}

			function removeModalHandler() {
				removeModal( classie.has( el, 'md-setperspective' ) ); 
			}
//关闭window
			el.addEventListener( 'click', function( ev ) {
				classie.add( modal, 'md-show' );
				// overlay.removeEventListener( 'click', removeModalHandler );
				overlay.addEventListener( 'click', removeModalHandler );
//EventListener前面是触发方式，后面是触发的函数
				if( classie.has( el, 'md-setperspective' ) ) {
					setTimeout( function() {
						classie.add( document.documentElement, 'md-perspective' );
					}, 25 );
				}
			});

			close.addEventListener( 'click', function( ev ) {
				ev.stopPropagation();
				removeModalHandler();
			});

		} );

	}

	init();

}
tanchuang();