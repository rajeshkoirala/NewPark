(function ($) {
    $.fn.ajaxGrid = function (options) {
        var _wrapper = $(this);
        var _wrapper_back = $(this).clone();
        _wrapper.html('');
        var dataFetching = false;
        var _defaults = {
            init: false,
            sn: false,
            url: "",
            offset: 0,
            limit: 5,
            page: 1,
            columns: [],
            goPagination: false,
            numberPagination: true,
            currentPage: 1,
            beforeNextRow: false,
            noRecord: "No record found",
            limitOption: [5, 10, 20, 50, 100],
            filter: false,
            previous: "&laquo;",
            next: "&raquo;",
            loadMore: false,
            scrollLoad: false,
            rowSortable: false,
            destination: "#fds",
            loadingClass: false,
            extraFooterMsg: false,
            afterAjaxComplete:false
        };

        var _settings = $.extend({}, _defaults, options);
        var xhr;

        var _offsetSetByUser = _settings.offset;
        var _limitSetByUser = _settings.limit;

        var _data = {data: [], count: 0};
        var _filterParams = "";
        if (_settings.filter) {
            _filterParams = _settings.filter;
        }

        var _noOfPages = 1;

        var table = {
            _init: function () {

                table._begin();
            },
            _begin: function () {

                _wrapper.on("refreshGrid", function (event, jsonParameters) {
                    //_wrapper.html('');
                    _filterParams = jsonParameters;
                    table._reset();
                    table._process(true);
                });

                table._process(false);
            },
            _process: function (resetDiv) {

                if (!_settings.init) {

                    if (_settings.loadingClass) {
                        $(_settings.loadingClass).show();
                    }

                    if (xhr && xhr.readyState != 4 && xhr.readyState != 0) {
                        xhr.abort();
                    }

                    dataFetching = true;
                    xhr = $.ajax({
                        'url': _settings.url,
                        'data': {
                            offset: _settings.offset,
                            limit: _settings.limit,
                            page: _settings.page,
                            filter: _filterParams
                        },
                        'dataType': "json",
                        'success': function (data) {
                            if(resetDiv) {
                                _wrapper.html('');
                            }
                            dataFetching = false;
                            _data = data;
                            _noOfPages = Math.ceil(data.count / _settings.limit);

                            table._create();
                            pagination._init();

                            if (_settings.loadingClass) {
                                $(_settings.loadingClass).hide();
                            }

                            if (_settings.rowSortable) {
                                table._makeRowSortable();
                            }

                            if(_settings.afterAjaxComplete) {
                                _settings.afterAjaxComplete.call(this);
                            }
                        }
                    });
                } else {
                    _settings.init = false;
                    if(_settings.loadingClass) {
                        $(_settings.loadingClass).hide()
                    }
                }
            },
            _create: function () {

                if (_settings.loadMore == false) table._clear();
                //debugger;
                var _div = _wrapper_back.html();

                if (_data.count > 0) {

                    _data.data.forEach(function (dt) {

                        var div = _div;
                        _settings.columns.forEach(function (items) {

                            if (typeof items.data != "undefined") {

                                while (1) {
                                    var n = div.search('{' + items.data + '}');
                                    if (n <= 0) {
                                        break;
                                    }
                                    div = div.replace('{' + items.data + '}', dt[items.data]);
                                }
                            } else if (typeof items.mRender != "undefined") {
                                var customField = items.mRender.call(this, dt);

                                for (var key in customField) {
                                    while (1) {
                                        var m = div.search('{' + key + '}');
                                        if (m <= 0) {
                                            break;
                                        }
                                        div = div.replace('{' + key + '}', customField[key]);
                                    }
                                }
                            }

                        });

                        _wrapper.append(div);
                    });
                } else {
                    var colspan = table._totalColumns();
                    _wrapper.html("<p style='margin-left: 20px;'>" + _settings.noRecord + "</p>");
                }

            },
            _totalColumns: function () {
                return _settings.columns.length;
            },
            _refresh: function () {
                table._begin()
            },
            _reset: function () {
                _settings.offset = _offsetSetByUser;
                _settings.limit = _limitSetByUser;
                _settings.currentPage = _defaults.currentPage;
            },
            _clear: function () {
                _wrapper.html("");
            },
            _fillData: function () {

            },
            _makeRowSortable: function () {
                var previousOrder = [];
                var previousOrderArr = _wrapper.find('tbody tr');
                previousOrderArr.each(function () {
                    previousOrder.push($(this).attr('row-data'));
                });

                _wrapper.find('tbody').sortable({
                    axis: 'y',
                    update: function (event, ui) {
                        var latestOrder = [];
                        var latestOrderArr = _wrapper.find('tbody tr');
                        latestOrderArr.each(function () {
                            latestOrder.push($(this).attr('row-data'));
                        });

                        var hash = {};

                        for (var i = 0; i < previousOrder.length; i++) {
                            if (previousOrder[i] != latestOrder[i])
                                hash[previousOrder[i].toString()] = latestOrder[i].toString();
                        }
                        _settings.rowSortable.call(this, hash);
                    }
                });
            }
        };

        var pagination = {
            _init: function () {
                pagination._create();
                pagination._enableDisable();
            },
            _create: function () {
                var paginationNav = $('<nav aria-label="Page navigation" id="PageNavigation" class="global-pagination text-center pagination-space"/>');
                var paginationUl = $('<ul class="pagination"/>');

                if (_settings.loadMore == false) {
                    paginationUl.append('<li id="ajax-grid-previous-button"><a role="button" aria-label="Previous" style="margin-right: 10px;"><span aria-hidden="true" >' + _settings.previous + '</span></a></li>');

                    if (_settings.goPagination) {
                        paginationUl.append('<li ><span>Page</span></li>');
                        paginationUl.append('<li ><span id="ajax-grid-page-no" contenteditable="true">' + _settings.currentPage + '</span></li>');
                        paginationUl.append('<li id="ajax-grid-goto-page"><a role="button"  aria-label="Go" style="margin-right: 5px;"><span>Go !</span></a></li>');
                    }
                    if (_settings.numberPagination) {
                        paginationUl.append(pagination._numberPagination());
                    }
                    paginationUl.append('<li id="ajax-grid-next-button"><a role="button" aria-label="Next" style="margin-left: 5px;" ><span aria-hidden="true">' + _settings.next + '</span></a></li>');
                    paginationNav.append(paginationUl);
                    _wrapper.parent().find("#PageNavigation").remove();
                } else {
                    paginationNav = $('<div id="ajax-grid-load-more" class="row"/>');
                    _wrapper.parent().find("#ajax-grid-load-more").remove();
                    paginationNav.append('<a role="button" id="ajax-grid-next-button" class="btn btn-primary btn-load-more" aria-label="Next" style="margin-left: 30px;" data-loading-text="<i class=\'fa fa-spinner fa-spin \'></i> Processing"><span aria-hidden="true">Load More</span></a>');
                }

                if (_noOfPages > 0) {
                    _wrapper.after(paginationNav);
                }

                if (_settings.scrollLoad && _settings.loadMore) {
                    _wrapper.parent().find("#ajax-grid-load-more").hide();
                }

                if (_settings.extraFooterMsg) {
                    footer._init();
                }

            },
            _numberPagination: function () {
                var currentPageNo = _settings.currentPage;
                var paginationExtraBtns = "";
                if (_noOfPages < 5) {
                    var i = 1;
                    while (i < _noOfPages + 1) {
                        if (i == currentPageNo) paginationExtraBtns += getButton(i, "active");
                        else paginationExtraBtns += getButton(i);
                        i++;
                    }
                } else {
                    if (currentPageNo == 1) {
                        paginationExtraBtns += getButton(currentPageNo, "active");
                        paginationExtraBtns += getButton(currentPageNo + 1);
                        paginationExtraBtns += getButton(currentPageNo + 2);
                        paginationExtraBtns += "<li><span>...</span></li>";
                        paginationExtraBtns += getButton(_noOfPages);
                    } else if (currentPageNo == 2) {
                        paginationExtraBtns += getButton(currentPageNo - 1);
                        paginationExtraBtns += getButton(currentPageNo, "active");
                        paginationExtraBtns += getButton(currentPageNo + 1);
                        paginationExtraBtns += "<li><span>...</span></li>";
                        paginationExtraBtns += getButton(_noOfPages);
                    } else if (currentPageNo == 3) {
                        paginationExtraBtns += getButton(currentPageNo - 2);
                        paginationExtraBtns += getButton(currentPageNo - 1);
                        paginationExtraBtns += getButton(currentPageNo, "active");
                        paginationExtraBtns += getButton(currentPageNo + 1);
                        paginationExtraBtns += "<li><span>...</span></li>";
                        paginationExtraBtns += getButton(_noOfPages);
                    } else if (currentPageNo == (_noOfPages - 2)) {
                        paginationExtraBtns += getButton(1);
                        paginationExtraBtns += "<li><span>...</span></li>";
                        paginationExtraBtns += getButton(currentPageNo - 1);
                        paginationExtraBtns += getButton(currentPageNo, "active");
                        paginationExtraBtns += getButton(currentPageNo + 1);
                        paginationExtraBtns += getButton(currentPageNo + 2);
                    } else if (currentPageNo == (_noOfPages - 1)) {
                        paginationExtraBtns += getButton(1);
                        paginationExtraBtns += "<li><span>...</span></li>";
                        paginationExtraBtns += getButton(currentPageNo - 1);
                        paginationExtraBtns += getButton(currentPageNo, "active");
                        paginationExtraBtns += getButton(currentPageNo + 1);
                    } else if (currentPageNo == _noOfPages) {
                        paginationExtraBtns += getButton(1);
                        paginationExtraBtns += "<li><span>...</span></li>";
                        paginationExtraBtns += getButton(currentPageNo - 2);
                        paginationExtraBtns += getButton(currentPageNo - 1);
                        paginationExtraBtns += getButton(currentPageNo, "active");
                    } else {
                        paginationExtraBtns += getButton(1);
                        paginationExtraBtns += "<li><span>...</span></li>";
                        paginationExtraBtns += getButton(currentPageNo - 1);
                        paginationExtraBtns += getButton(currentPageNo, "active");
                        paginationExtraBtns += getButton(currentPageNo + 1);
                        paginationExtraBtns += "<li><span>...</span></li>";
                        paginationExtraBtns += getButton(_noOfPages);
                    }
                }

                return paginationExtraBtns;

                function getButton(pageNo, isActive) {
                    return '<li class="' + isActive + '"><a role="button" class="ajax-grid-pagination-btn" page-no="' + pageNo + '">' + pageNo + '</a></li>';
                }
            },
            _previousPage: function () {
                if ($(this).attr("class") != "disabled") {
                    _settings.offset -= _settings.limit;
                    _settings.currentPage -= 1;
                    table._refresh();
                }
            },
            _nextPage: function () {
                var $this = $(this);
                $this.button('loading');
                setTimeout(function() {
                    $this.button('reset');
                }, 8000);

                if ($(this).attr("class") != "disabled") {
                    _settings.offset += _settings.limit;
                    _settings.currentPage += 1;
                    table._refresh();
                }
            },
            _goToPage: function (pageNo) {
                if (($("#ajax-grid-goto-page").attr("class") != "disabled" && !isNaN(parseInt($("#ajax-grid-page-no").text()))) || !isNaN(pageNo)) {
                    _settings.currentPage = parseInt(_wrapper.parent().find("#ajax-grid-page-no").text());
                    if (!isNaN(pageNo)) _settings.currentPage = parseInt(pageNo);
                    _settings.offset = (_settings.currentPage - 1) * _settings.limit;
                    table._refresh();
                }
            },
            _refresh: function () {
                pagination._init();
            },
            _disableGo: function () {
                var pageNo = parseInt($(this).text());
                var gotoPage = _wrapper.parent().find("#ajax-grid-goto-page");
                _wrapper.parent().find("#ajax-grid-previous-button").addClass("disabled");
                _wrapper.parent().find("#ajax-grid-next-button").addClass("disabled");
                if (isNaN(pageNo) || pageNo > _noOfPages) gotoPage.addClass("disabled");
                else gotoPage.removeClass("disabled");
            },
            _enableDisable: function () {
                var pageNo = _settings.currentPage;
                if (pageNo < 2) _wrapper.parent().find("#ajax-grid-previous-button").addClass("disabled");
                if ((pageNo >= _noOfPages)) _wrapper.parent().find("#ajax-grid-next-button").addClass("disabled");
            },
            _paginationButtonsClick: function () {
                var pageNo = parseInt($(this).attr("page-no"));
                pagination._goToPage(pageNo);
            }
        };

        var footer = {
            _init: function () {
                var paginationDiv = $(".pagination");

                var start = (_settings.offset + 1);
                if (_settings.loadMore) {
                    start = 1;
                }

                var msg = "<i id='footer-message' style='line-height: 32px; margin-left: 10px;'>" +
                    "Showing " + start + " to " + (_settings.offset + _data.data.length) + " of " + _data.count + " entries" +
                    "</i>";
                paginationDiv.find("#footer-message").remove();
                paginationDiv.append("<li>" + msg + "</li>");
            }
        };

        table._init();

        _wrapper.parent().on('click', "#ajax-grid-previous-button", pagination._previousPage);
        _wrapper.parent().on('click', '#ajax-grid-next-button', pagination._nextPage);
        _wrapper.parent().on('click', '#ajax-grid-goto-page', pagination._goToPage);
        _wrapper.parent().on('keyup', '#ajax-grid-page-no', pagination._disableGo);
        _wrapper.parent().on('click', '.ajax-grid-pagination-btn', pagination._paginationButtonsClick);

        /*window.bind('scroll',footer.chk_scroll);
        function chk_scroll(e)
        {
            var elem = $(e.currentTarget);
            if (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight())
            {
                console.log("bottom");
            }

        }*/
        /*$(window).on('scroll', function () {

            if ($(window).scrollTop() >= _wrapper.offset().top + _wrapper.outerHeight() - window.innerHeight) {
                if (_settings.loadMore && _settings.scrollLoad && dataFetching == false /!*&& _data.length > 0*!/) {
                    _wrapper.parent().find('#ajax-grid-next-button').trigger('click');
                }
            }
        });*/
        var lastScrollTop = 0;

        $(_wrapper.parent()).on('scroll', function() {

            st = $(_wrapper.parent()).scrollTop();
            if(st > lastScrollTop) {
                /*console.log('_wrapper.parent().scrollTop(): ' + _wrapper.parent().scrollTop());
                 console.log('_wrapper.offset().top: ' + _wrapper.offset().top);
                 console.log('_wrapper.outerHeight(): ' + _wrapper.outerHeight());
                 console.log('_wrapper.parent().innerHeight(): ' + _wrapper.parent().innerHeight());*/

                if (_wrapper.parent().scrollTop() >= _wrapper.parent().offset().top + _wrapper.outerHeight() - _wrapper.parent().innerHeight()) {
                    if (_settings.loadMore && _settings.scrollLoad) {
                        _wrapper.parent().find('#ajax-grid-next-button').trigger('click');
                    }
                }
            }
            lastScrollTop = st;
        });
    }

})(jQuery);
