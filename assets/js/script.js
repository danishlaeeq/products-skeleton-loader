jQuery(function () {
  "use strict";

  /**
   * All of the Javascript code for checking if the internet is connected should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */

  const products = document.querySelectorAll(".pslfree-product"),
    galleryproducts = document.querySelectorAll(".pslfree-single-product");
   
  function onLoad(loading, loaded) {
    if (document.readyState === "complete") {
      return loaded();
    }
    loading();
    if (window.addEventListener) {
      window.addEventListener("load", loaded, false);
    } else if (window.attachEvent) {
      window.attachEvent("onload", loaded);
    }
  }

  onLoad(
    function () {},
    function () {
      for (let i = 0; i < products.length; i++) {
        const element = products[i];
        element.classList.remove("pslfree-product");        
      }

      for (let i = 0; i < galleryproducts.length; i++) {
        const element = galleryproducts[i];
        element.classList.remove("pslfree-single-product");
      }
    }
  );

});
