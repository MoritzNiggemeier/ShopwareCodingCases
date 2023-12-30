import DomAccess from 'src/helper/dom-access.helper';
import AddToCartPlugin from 'src/plugin/add-to-cart/add-to-cart.plugin';

export default class VisualAddToCartIndicator extends AddToCartPlugin {

	init() {
		this.element = DomAccess.querySelector( this.el, '.btn-buy');
		super.init();
	};

	_openOffCanvasCart( instance, requestUrl, formData ){
		
		// check config for static/animated style
		let className = ( window.va2ci.animation === '1' ) ? 'va2ci-animation' : 'va2ci-static';  

		// apply text and style to element
		this.element.textContent = window.va2ci.text;
		this.element.classList.add( className );

		// revert text and style after configured duration
		window.setTimeout(() => {
			this.element.textContent = window.va2ci.textOriginal;
			this.element.classList.remove( className );
		}, window.va2ci.duration * 1000 );
	};

}