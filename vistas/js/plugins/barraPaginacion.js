if(document.getElementsByClassName("paginacion").length != 0){

var options = {
    containerID: "",
    first: false,
    previous: "prev",
    next: "next",
    last: false,
    links: "numeric", // blank || title
    startPage: 1,
    perPage: 10,
    midRange: 3,
    startRange: 1,
    endRange: 1,
    keyBrowse: false,
    scrollBrowse: false,
    pause: 0,
    clickStop: false,
    delay: 50,
    direction: "forward", // backwards || auto || random ||
    animation: "", // http://daneden.me/animate/ - any entrance animations
    fallback: 400,
    minHeight: true,
    callback: undefined // function( pages, items ) { }
};

// Variables para controlar el inicio de la paginacion
jQwindow = $(window);
jQdocument = $(document);
_nav = {};
_first = $(options.first);
_previous = $(options.previous);
_next = $(options.next);
_last = $(options.last);
_numPages = 0;
_currentPageNum = options.startPage;
_clicked = false;
_holder = $("div.holder");

// para cargar los elementos que se esconden (de la paginacion, en la navegacion)
function setStyles() {
    var requiredStyles = "<style>" +
    ".jp-invisible { visibility: hidden !important; } " +
    ".jp-hidden { display: none !important; }" +
    "</style>";

    $(requiredStyles).appendTo("head");
}

function setNav() {
    var navhtml = writeNav();

    _holder.each(bind(function(index, element) {
      var holder = $(element);
      holder.html(navhtml);
      cacheNavElements(holder, index);
      bindNavHandlers(index);
      disableNavSelection(element);
    }, this));

}

function writeNav() {
    var i = 1, navhtml;
    navhtml = writeBtn("first") + writeBtn("previous");

    for (; i <= _numPages; i++) {
      if (i === 1 && options.startRange === 0) navhtml += "<span>...</span>";
      if (i > options.startRange && i <= _numPages - options.endRange)
        navhtml += "<a class='jp-hidden botonActivo'>";
      else
        navhtml += "<a class='botonActivo'>";

      switch (options.links) {
        case "numeric":
          navhtml += i;
          break;
        case "blank":
          break;
      }

      navhtml += "</a>";
      if (i === options.startRange || i === _numPages - options.endRange)
        navhtml += "<span>...</span>";
    }
    navhtml += writeBtn("next") + writeBtn("last") + "</div>";
    return navhtml;
}

function writeBtn (which) {
  if(options[which] !== false && !$(this["_" + which]).length){
    if(options[which] == "next"){
      return "<a class='" + which +" jp-" + which + "'> <i class='fas fa-angle-double-right'></i> </a>"
    }else if(options[which] == "prev"){
      return "<a class='" + which +" jp-" + which + "'><i class='fas fa-angle-double-left'></i></a>"
    }else{
      return ""; // Opciones futuras para los botones
    }
  }else{
    return "";
  }
}

function bind (fn, me) {
    return function() {
      return fn.apply(me, arguments);
    };
}

function bindNavHandlers (index) {
    var nav = _nav[index];

    // default nav
    nav.holder.bind("click.jPages", this.bind(function(evt) {
      var newPage = this.getNewPage(nav, $(evt.target));
      if (this.validNewPage(newPage)) {
        this._clicked = true;
        this.paginate(newPage);
      }
      evt.preventDefault();
    }, this));

    // custom first
    if (this._first.length) {
      this._first.bind("click.jPages", this.bind(function() {
        if (this.validNewPage(1)) {
          this._clicked = true;
          this.paginate(1);
        }
      }, this));
    }

    // custom previous
    if (this._previous.length) {
      this._previous.bind("click.jPages", this.bind(function() {
        var newPage = this._currentPageNum - 1;
        if (this.validNewPage(newPage)) {
          this._clicked = true;
          this.paginate(newPage);
        }
      }, this));
    }

    // custom next
    if (this._next.length) {
      this._next.bind("click.jPages", this.bind(function() {
        var newPage = this._currentPageNum + 1;
        if (this.validNewPage(newPage)) {
          this._clicked = true;
          this.paginate(newPage);
        }
      }, this));
    }

    // custom last
    if (this._last.length) {
      this._last.bind("click.jPages", this.bind(function() {
        if (this.validNewPage(this._numPages)) {
          this._clicked = true;
          this.paginate(this._numPages);
        }
      }, this));
    }

  }

function getNewPage(nav, target) {
    if (target.is(nav.currentPage)) return this._currentPageNum;
    if (target.is(nav.pages)) return nav.pages.index(target) + 1;
    if (target.is(nav.first)) return 1;
    if (target.is(nav.last)) return this._numPages;
    if (target.is(nav.previous)) return nav.pages.index(nav.currentPage);
    if (target.is(nav.next)) return nav.pages.index(nav.currentPage) + 2;
}

function validNewPage(newPage) {
    return newPage !== this._currentPageNum && newPage > 0 && newPage <= this._numPages;
}

// Este es el metodo que se llama para paginar el nuevo contenido
function paginate (page) {
    var pageInterval;
    pageInterval = this.updatePages(page);
    this._currentPageNum = page;
    this.updatePause();
}

function updatePages(page) {
    var interval, index, nav;
    interval = this.getInterval(page);
    for (index in this._nav) {
      if (this._nav.hasOwnProperty(index)) {
        nav = this._nav[index];
        this.updateBtns(nav, page);
        this.updateCurrentPage(nav, page);
        this.updatePagesShowing(nav, interval);
        this.updateBreaks(nav, interval);
      }
    }
    return interval;
}

function getInterval(page) {
    var neHalf, upperLimit, start, end;
    neHalf = Math.ceil(this.options.midRange / 2);
    upperLimit = this._numPages - this.options.midRange;
    start = page > neHalf ? Math.max(Math.min(page - neHalf, upperLimit), 0) : 0;
    end = page > neHalf ?
      Math.min(page + neHalf - (this.options.midRange % 2 > 0 ? 1 : 0), this._numPages) :
      Math.min(this.options.midRange, this._numPages);
    return {start: start,end: end};
}

function updateBtns(nav, page) {
    if (page === 1) {
      nav.first.addClass("jp-disabled");
      nav.previous.addClass("jp-disabled");
    }
    if (page === this._numPages) {
      nav.next.addClass("jp-disabled");
      nav.last.addClass("jp-disabled");
    }
    if (this._currentPageNum === 1 && page > 1) {
      nav.first.removeClass("jp-disabled");
      nav.previous.removeClass("jp-disabled");
    }
    if (this._currentPageNum === this._numPages && page < this._numPages) {
      nav.next.removeClass("jp-disabled");
      nav.last.removeClass("jp-disabled");
    }
}

  function updateCurrentPage(nav, page) {
    nav.currentPage.removeClass("jp-current");
    nav.currentPage = nav.pages.eq(page - 1).addClass("jp-current");
}

  function updatePagesShowing(nav, interval) {
    var newRange = nav.pages.slice(interval.start, interval.end).not(nav.permPages);
    nav.pagesShowing.not(newRange).addClass("jp-hidden");
    newRange.not(nav.pagesShowing).removeClass("jp-hidden");
    nav.pagesShowing = newRange;
}

  function updateBreaks(nav, interval) {
    if (
      interval.start > this.options.startRange ||
      (this.options.startRange === 0 && interval.start > 0)
    ) nav.fstBreak.removeClass("jp-hidden");
    else nav.fstBreak.addClass("jp-hidden");

    if (interval.end < this._numPages - this.options.endRange) nav.lstBreak.removeClass("jp-hidden");
    else nav.lstBreak.addClass("jp-hidden");
}

function disableNavSelection(element) {
    if (typeof element.onselectstart != "undefined")
      element.onselectstart = function() {
        return false;
      };
    else if (typeof element.style.MozUserSelect != "undefined")
      element.style.MozUserSelect = "none";
    else
      element.onmousedown = function() {
        return false;
      };
}

function cacheNavElements(holder, index) {
    this._nav[index] = {};
    this._nav[index].holder = holder;
    this._nav[index].first = this._first.length ? this._first : this._nav[index].holder.find("a.jp-first");
    this._nav[index].previous = this._previous.length ? this._previous : this._nav[index].holder.find("a.jp-previous");
    this._nav[index].next = this._next.length ? this._next : this._nav[index].holder.find("a.jp-next");
    this._nav[index].last = this._last.length ? this._last : this._nav[index].holder.find("a.jp-last");
    this._nav[index].fstBreak = this._nav[index].holder.find("span:first");
    this._nav[index].lstBreak = this._nav[index].holder.find("span:last");
    this._nav[index].pages = this._nav[index].holder.find("a").not(".jp-first, .jp-previous, .jp-next, .jp-last");
    this._nav[index].permPages =
      this._nav[index].pages.slice(0, this.options.startRange)
        .add(this._nav[index].pages.slice(this._numPages - this.options.endRange, this._numPages));
    this._nav[index].pagesShowing = $([]);
    this._nav[index].currentPage = $([]);
}

function updatePause() {
    if (this.options.pause && this._numPages > 1) {
      clearTimeout(this._pause);
      if (this.options.clickStop && this._clicked) return;
      else {
        this._pause = setTimeout(this.bind(function() {
          this.paginate(this._currentPageNum !== this._numPages ? this._currentPageNum + 1 : 1);
        }, this), this.options.pause);
      }
    }
}

function iniciarBarraPaginacion(numPag){
  this._numPages = numPag;
  setStyles();
  setNav();
  _currentPageNum = options.startPage;
  paginate(_currentPageNum);
}

function getCurrentPage(){
  return parseInt(this._currentPageNum);
}

}