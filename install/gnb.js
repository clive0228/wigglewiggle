$(function() {

	_domHeadGnb = $("#headGnb");
	_domHeadVisual = _domHeadGnb.find(".dp2_list .vis img");
	_domLinkBtnArr = _domHeadGnb.find(".dp2_list .ctgory a");

	_domLinkBtnArr.bind("mouseenter", interactionLinkBtnHandler);
	_domLinkBtnArr.bind("mouseleave", interactionLinkBtnHandler);

	_domHeadVisual.attr("src", _domLinkBtnArr.eq(1).attr("data-imgurl"));
	_domHeadVisual.css("visibility", "visible");
	
	
	_domHeadGnb = $("#headGnb");
	_domBaseBg = _domHeadGnb.find(".base_bg");
	_domDimmBg = _domHeadGnb.find(".dimm_bg");
	_domDp1Product = _domHeadGnb.find(".dp1.product > a");
	_domDp2Wrap = _domHeadGnb.find(".dp2_wrap");
	_domDp2Product = _domDp2Wrap.find(".dp2_list");

	_domVisImg = _domDp2Product.find(".vis");
	
	_openHeight = _domDp2Product.height() + 40;
	_domDp2Wrap.css({ height : 0 });
	_domBaseBg.css({ opacity : _defaultOpacity });
	_domDimmBg.css({ display : "none", opacity : 0 });
	_domDp2Product.css({ visibility: "visible", top : -(_openHeight) });

	_domDp1Product.bind("click", interactionProductDp1Handler);
	_domDimmBg.bind("click", interactionDimmHandler);

	_domHeadGnb.bind("mouseenter", interactionHeaderHandler);
	_domHeadGnb.bind("mouseleave", interactionHeaderHandler);
	$(".cm_head").bind("mouseenter", interactionHeaderHandler);
	$(".cm_head").bind("mouseleave", interactionHeaderHandler);
});

var _domHeadGnb = null;
var _domDp1Product = null;
var _domDp2Wrap = null;
var _domDp2Product
var _domBaseBg = null;
var _domDimmBg = null;
var _domVisImg = null;
var _openHeight = 0;
var _defaultOpacity = 0.5;
var _isOpen = false;
var _isCloseComplete = true;
var _domHeadGnb = null;
var _domHeadVisual = null;
var _domLinkBtnArr = [];
var _domActiveLinkBtn = null;

function interactionLinkBtnHandler(evt){
	var btn = $(this);
	switch(evt.type){
		case "mouseenter" :
			if (_domActiveLinkBtn != null){
				$(_domActiveLinkBtn).removeClass("active");
				_domActiveLinkBtn = null;
			}
			btn.addClass("active");
			_domHeadVisual.attr("src", btn.attr("data-imgurl"));
			_domActiveLinkBtn = this;
			break;

		case "mouseleave" :
			break;
	}
}

function interactionHeaderHandler(evt){
	if (_isCloseComplete == false) {
		return;
	}
	switch (evt.type) {
		case "mouseenter" :
			if (_isOpen == true) {
				return;
			}
			_domBaseBg.stop().animate({ opacity : 1 }, 300);
			break;

		case "mouseleave" :
			if (_isOpen == true) {
				return;
			}
			_domBaseBg.stop().animate({ opacity : _defaultOpacity }, 300);
			break;
	}
}
function setDefaultOpacity(opacity){
	_defaultOpacity = opacity;
	_domBaseBg.stop().css({ opacity : _defaultOpacity });
};

function interactionDimmHandler(evt){
	evt.preventDefault();
	setOpen(false);
}

function interactionProductDp1Handler(evt){
	evt.preventDefault();
	setOpen(!_isOpen);
}

function setOpen(bool){
	if (_isOpen == true) {
		_domBaseBg.stop().animate({ height : 70, opacity : _defaultOpacity }, 600, "easeInOutExpo");
		_domDp2Product.stop().animate({ top : -(_openHeight) }, 600, "easeInOutExpo");
		_domDp2Wrap.stop().animate({ height : 0 }, 600, "easeInOutExpo", function(){
			_isCloseComplete = true; 
		});
		_domDimmBg.stop().animate({ opacity : 0 }, 200, function(){
			_domDimmBg.css({ display: "none" });
		});
		_domVisImg.stop().delay(200).animate({ opacity : 0 }, 300);
	} else {
		
		_domBaseBg.stop().animate({ height : _openHeight+70 , opacity : 1 }, 600, "easeOutExpo");
		_domDp2Product.stop().animate({ top : 0 }, 700, "easeOutExpo");
		_domDp2Wrap.stop().css({ height: _openHeight });
		_domDimmBg.stop().css({ display: "block" }).animate({ opacity : 0.3 }, 100);
		_domVisImg.css({ opacity : 0 });
		_domVisImg.stop().delay(250).animate({ opacity : 1 }, 500);
		_isCloseComplete = false;
	}
	_isOpen = bool;
};