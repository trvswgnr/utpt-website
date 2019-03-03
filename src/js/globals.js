/**
 * Global Variables and Methods
 */

export const viewportWidth = $( window ).width();

/**
 * Determine if the target element is in view and if so return true
 */
export const isInView = function( target, elOffset = 0 ) {
  const amountScrolled = $( window ).scrollTop();
  let elPosition = $( target ).offset();
    elPosition = elPosition ? elPosition.top : '';

  let offset = elOffset;
  let triggerPosition = elPosition - offset;
  if ( amountScrolled >= triggerPosition ) {
    return true;
  }
};

/**
 * Adds the :onScreen pseudo selector to jQuery to affect elements visible in the viewport.
 */
( function( $ ) {
  $.expr[':'].onScreen = function( elem ) {
    var $window = $( window );
    var viewportTop = $window.scrollTop();
    var viewportHeight = $window.height();
    var viewportBottom = viewportTop + viewportHeight;
    var $elem = $( elem );
    var top = $elem.offset().top;
    var height = $elem.height();
    var bottom = top + height;

    return ( top >= viewportTop && top < viewportBottom ) ||
      ( bottom > viewportTop && bottom <= viewportBottom ) ||
      ( height > viewportHeight && top <= viewportTop && bottom >= viewportBottom );
  };
}( jQuery ) );
