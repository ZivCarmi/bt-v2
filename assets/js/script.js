//======================================================================
// TABLE OF CONTENTS
//======================================================================
/*

= IMAGES/BACKGROUND IMAGES LAZY LOAD

= WHOLE SITE

*/
//======================================================================
// TABLE OF CONTENTS
//======================================================================

//===============================================================================
// IMAGES/BACKGROUND IMAGES LAZY LOAD
//===============================================================================

($ => {
	let bt_lazy_load_images;

	(bt_lazy_load_images = (scroll_from_top = 0) => {
		if (scroll_from_top === 0) scroll_from_top = $(window).scrollTop() + screen.height + 100;

		$('.bt-lazy-load').each((index, e) => {
			const $this = jQuery(e);

			switch ($this.data('bt-lazy-load-type')) {
				case 'image':
					if ($this.offset().top <= scroll_from_top) {
						$this.attr('src', $this.data('bt-lazy-load-src')).removeClass('bt-lazy-load');

						if ($this.hasClass('bt-lazy-load-slick-slide')) {
							const $slick = $this.closest('.bt-lazy-load-slick');

							if ($slick.length > 0 && !$slick.hasClass('bt-lazy-load-resize')) {
								$slick.addClass('bt-lazy-load-resize');

								setTimeout(() => {
									$slick.trigger('resize');
								}, 500);
							}
						}
					}

					break;
				case 'bg':
					if ($this.offset().top <= scroll_from_top) {
						let style_attr = $this.attr('style');

						let style_attr_parts = style_attr.split(';');

						let new_style_attr = '';

						style_attr_parts.forEach(property => {
							if (property) {
								let property_parts = property.split(': ');

								if (property_parts[0] === 'background-image') {
									property_parts[1] = 'url(' + $this.data('bt-lazy-load-src') + ')';
								}

								new_style_attr += property_parts.join(': ') + ';';
							}
						});

						$this.attr('style', new_style_attr).removeClass('bt-lazy-load');
					}

					break;
			}
		});
	})();

	$(window).scroll(e => {
		const $this = jQuery(e.currentTarget);

		bt_lazy_load_images($this.scrollTop() + screen.height + 100);
	});
})(jQuery);

// <img> example
// <img src="<?= TINYGIF; ?>" alt="<?= IMAGE_ALT; ?>" class="bt-lazy-load" data-bt-lazy-load-type="image" data-bt-lazy-load-src="<?= IMAGE_SRC; ?>">

// background image example
// <div style="background-image: url(<?= TINYGIF; ?>)" class="bg-cover bt-lazy-load" data-bt-lazy-load-type="bg" data-bt-lazy-load-src="<?= IMAGE_SRC; ?>">

// IMPORTANT!!! Don't use this when working with display: none;/any images carousel

//===============================================================================
// IMAGES/BACKGROUND IMAGES LAZY LOAD - END
//===============================================================================

//======================================================================
// WHOLE SITE
//======================================================================



//======================================================================
// WHOLE SITE - END
//======================================================================
