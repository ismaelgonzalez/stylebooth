/*
 Sergio Mireles
 mireles001@gmail.com
 20130222

 Carousel Maker is a simple and hopefuly handy for someone wishing to create a web carousel component on his/her website

 FIX: 20140209
 Using fade transition won't fadeout the old slide item, it will now wait until the new slide finish fadein
 and the it will be removed. Substitute fadeOut for setTimeout.
 */
var carousel = {
	tweenSpeed  : 1000,
	tweenHold   : 3000,
	tweenType   : 'slide',
	labels      : {
		items   : 'carousel_items',
		viewer  : 'carousel_viewer',
		button  : 'carousel_btn'
	},
	dom         : [],
	init : function (_params){
		if(_params.target != undefined && this.dom[_params.target] == undefined){
			var targetName = '_'+_params.target;
			this.dom[targetName] = {};

			var holder  = $('#'+_params.target),
				items   = $('#'+this.labels.items,holder),
				viewer  = $('#'+this.labels.viewer,holder),
				button  = $('#'+this.labels.button,holder).hide(),
				doms    = [],
				buttons = [],
				index   = 0,
				w       = parseInt(holder.css('width')),
				h       = parseInt(holder.css('height')),
				i;
			items.hide();
			viewer.css('overflow','hidden').css('width',w+'px').css('height',h+'px').css('position','relative').css('z-index','1');
			for(i=0;i<items.children().size();i++){
				doms.push(items.children().eq(i));
			}
			var first = doms[index].clone().css('width',w+'px').css('height',h+'px').css('position','absolute').hide();
			viewer.append(first);

			/*Add nav buttons*/
			if(button.length > 0){
				var buttonLayer  = $('<div></div>').css('position','absolute').css('z-index','10'),
					buttonHolder = $('<div class="carousel_btns"></div>').css('position','relative'),
					newButton;
				for(i=0;i<doms.length;i++){
					newButton = button.clone().show().attr('id',i+'-'+targetName).css('cursor','pointer').click(function(){
						var params = $(this).attr('id').split('-');
						carousel.goTo({target:params[1],index:parseInt(params[0]),auto:false});
					});
					buttonHolder.append(newButton);
					buttons.push(newButton);
				}
				buttonLayer.append(buttonHolder);
				holder.prepend(buttonLayer);
				this.dom[targetName].buttons = buttons;
			}
			if(_params.autoscroll != undefined && !_params.autoscroll) {
				this.dom[targetName].autoscroll = false;
			}else{
				this.dom[targetName].autoscroll = true;
			}
			if(_params.tween != undefined){
				this.dom[targetName].tween = _params.tween;
			}else{
				this.dom[targetName].tween = this.tweenSpeed;
			}
			if(_params.hold != undefined){
				this.dom[targetName].hold = _params.hold;
			}else{
				this.dom[targetName].hold = this.tweenHold;
			}
			if(this.dom[targetName].hold <= this.dom[targetName].tween){
				this.dom[targetName].hold = this.dom[targetName].tween+1;
			}
			if(_params.type != undefined && _params.type != this.tweenType){
				this.dom[targetName].type = 'fade';
			}else{
				this.dom[targetName].type = this.tweenType;
			}
			this.dom[targetName].viewer = viewer;
			this.dom[targetName].items = doms;
			this.dom[targetName].index = index;
			this.dom[targetName].w = w;
			this.dom[targetName].h = h;
			this.dom[targetName].locked = false;

			first.fadeIn(500,function(){
				$(this).attr('id','old');
				var targetName = '_'+$(this).parent().parent().attr('id');
				if(carousel.dom[targetName].autoscroll){
					carousel.dom[targetName].interval = setInterval(function(){
						carousel.carouselInterval(targetName);
					},carousel.dom[targetName].hold);
				}
				carousel.turnOnOffButton(carousel.dom[targetName],true);
			});
		}
	},
	carouselInterval : function (_targetName){
		var nextItem = carousel.dom[_targetName].index+1;
		if(nextItem >= carousel.dom[_targetName].items.length) { nextItem = 0; }
		carousel.goTo({target:_targetName,index:nextItem,auto:true});
	},
	goTo : function (_params) {
		var blnAnimate = false;

		if(!_params.auto && carousel.dom[_params.target].index != _params.index && !carousel.dom[_params.target].locked){
			if(carousel.dom[_params.target].autoscroll){
				clearInterval(carousel.dom[_params.target].interval);
				carousel.dom[_params.target].interval = setInterval(function(){
					carousel.carouselInterval(_params.target);
				},carousel.dom[_params.target].hold);
			}
			blnAnimate = true;
		}else{
			if(_params.auto){
				blnAnimate = true;
			}
		}

		if(blnAnimate){
			var direction = 1;
			if(_params.index > carousel.dom[_params.target].index || _params.auto){
				direction = -1;
			}

			carousel.dom[_params.target].locked = true;

			this.turnOnOffButton(carousel.dom[_params.target],false);
			carousel.dom[_params.target].index = _params.index;
			this.turnOnOffButton(carousel.dom[_params.target],true);

			var domNew = carousel.dom[_params.target].items[_params.index].clone().attr('id','new')
					.css('position','absolute').css('left','0').css('top','0')
					.css('width',carousel.dom[_params.target].w+'px').css('height',carousel.dom[_params.target].h+'px').hide(),
				domOld = $('#old',carousel.dom[_params.target].viewer);
			carousel.dom[_params.target].viewer.append(domNew);

			if(carousel.dom[_params.target].type == 'slide'){
				domOld.animate({left: '+='+carousel.dom[_params.target].w*direction },carousel.dom[_params.target].tween, function(){
					$(this).remove();
				});
				domNew.show().css('left',carousel.dom[_params.target].w*(-1*direction))
					.animate({left: '+='+carousel.dom[_params.target].w*direction },carousel.dom[_params.target].tween,
					function(){
						$(this).attr('id','old');
						carousel.dom['_'+$(this).parent().parent().attr('id')].locked = false;
					});
			}else if(carousel.dom[_params.target].type == 'fade') {
				setTimeout(function(){ domOld.remove(); },carousel.dom[_params.target].tween);
				domNew.fadeIn(carousel.dom[_params.target].tween,function(){
					$(this).attr('id','old');
					carousel.dom['_'+$(this).parent().parent().attr('id')].locked = false;
				});
			}
		}
	},
	turnOnOffButton : function (_obj,_selectButton) {
		if(_obj.buttons != undefined){
			if(_selectButton){
				if(!_obj.buttons[_obj.index].hasClass('selected')){
					_obj.buttons[_obj.index].addClass('selected');
				}
			}else{
				if(_obj.buttons[_obj.index].hasClass('selected')){
					_obj.buttons[_obj.index].removeClass('selected');
				}
			}
		}
	}
};