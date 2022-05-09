import $ from "jquery";

class Search {
  // 1 describe and create/initiate our object
  constructor() {
    this.resultDiv = $("#search-overlay__results");
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $("#search-term");
    this.events();
    this.isOverlayOpen = false;
    this.typingTimer;
  }
  // 2 events
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
    $(document).on("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.on("keydown", this.typingLogic.bind(this));
  }

  // 3 methods (function, action...)
  typingLogic() {
    clearTimeout(this.typingTimer);
    this.resultDiv.html('<div class ="spinner-loader"></div>');
    this.typingTimer = setTimeout(this.getResults.bind(this), 2000);
  }

  getResults() {
    this.resultDiv.html("Imagine real search result here");
  }

  keyPressDispatcher(e) {
    //  To know the code of a key
    // console.log(e.keyCode);
    if (e.keyCode == 83 && this.isOverlayOpen) {
      this.openOverlay();
    }

    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }
  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    this.isOverlayOpen = true;
  }
  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    this.isOverlayOpen = false;
  }
}

export default Search;
