(function ($) {
    $.fn.ajaxGrid = function (options) {
        var _wrapper = $(this);
        var _destination = $(options.destination);
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
            rowSortable: false,
            destination: "#fds",
            filterData: false
        };
        //debugger;
        var _settings = $.extend({}, _defaults, options);
        var _data = {data: [], count: 0};
        var _filterParams = "";
        if (_settings.filterData) {
            _filterParams = _settings.filterData;
        }
        /*some global variable*/
        var _noOfPages = 1;


        var filter = {
            _init: function () {
                if (_settings.filter) filter._create();
            },
            _create: function () {
                var limitDiv = $("<div class='limit-filter form-inline pull-right'/>");
                var select = $("<select class='ajax-grid-limit-search form-control'/>");
                var option;
                _settings.limitOption.forEach(function (val) {
                    option = "<option value='" + val + "'>" + val + "</option>";
                    if (val == _settings.limit) {
                        option = "<option value='" + val + "' selected='selected'>" + val + "</option>";
                    }
                    select.append(option);
                });
                limitDiv.append("<span>Show</span> ");
                limitDiv.append(select);
                limitDiv.append(" <span>Entries</span> ");
                _wrapper.before(limitDiv);
            },
            _update: function () {
                _settings.offset = _defaults.offset;
                _settings.limit = parseInt($(this).val());
                _settings.currentPage = _defaults.currentPage;
                table._init();
            }
        };

        var table = {
            _init: function () {

                table._begin();
            },
            _begin: function () {

                _wrapper.on("refreshGrid", function (event, jsonParameters) {

                    _filterParams = jsonParameters;
                    table._reset();
                    table._fillData();
                    table._create();
                    pagination._init();
                });

                if (_settings.init) {
                    _settings.init = false;
                } else {
                    table._fillData();
                }
                table._create();
                pagination._init();

                if (_settings.rowSortable) {
                    table._makeRowSortable();
                }
            },
            _create: function () {

                if (_settings.loadMore == false) table._clear();

                var _div = _wrapper.html();

                if (_data.count > 0) {

                    _data.data.forEach(function (dt) {

                        var div = _div;
                        _settings.columns.forEach(function (items) {

                            if (typeof items.data != "undefined") {

                                while (1) {
                                    var n = div.search('_' + items.data + '_');
                                    if (n <= 0) {
                                        break;
                                    }
                                    div = div.replace('_' + items.data + '_', dt[items.data]);
                                }
                            } else if (typeof items.mRender != "undefined") {
                                var customField = items.mRender.call(this, dt);

                                for (var key in customField) {
                                    while (1) {
                                        var m = div.search('_' + key + '_');
                                        if (m <= 0) {
                                            break;
                                        }
                                        div = div.replace('_' + key + '_', customField[key]);
                                    }
                                }
                            }

                        });

                        _destination.append(div);
                    });
                } else {
                    var colspan = table._totalColumns();
                    _destination.append("<p style='margin-left: 20px;'>" + _settings.noRecord + "</p>");
                }

            },
            _totalColumns: function () {
                return _settings.columns.length;
            },
            _refresh: function () {
                table._begin()
            },
            _reset: function () {
                _settings.offset = _defaults.offset;
                _settings.limit = _defaults.limit;
                _settings.currentPage = _defaults.currentPage;
            },
            _clear: function () {
                _destination.html("");
            },
            _fillData: function () {
                var left = _destination.width() / 2 - 75;
                var processing = "<div style='left: " + left + "px;width: 150px;z-index: 101; margin-top: 500px; position: absolute; height: 30px; display: block; padding: 5px; background: #E4E3E4; text-align: center;' id ='Processing'>processing...</div>";
                _destination.parent().find("#Processing").remove();
                _destination.before(processing);
                _data = (function () {
                    var json = null;
                    $.ajax({
                        'async': false,
                        'global': false,
                        'url': _settings.url,
                        'data': {
                            offset: _settings.offset,
                            limit: _settings.limit,
                            page: _settings.page,
                            filter: _filterParams
                        },
                        'dataType': "json",
                        'success': function (data) {
                            json = data;
                            setTimeout(function () {
                                _destination.parent().find("#Processing").remove();
                            }, 500);

                        }
                    });
                    _noOfPages = Math.ceil(json.count / _settings.limit);
                    return json;
                })();
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
                var paginationNav = $('<nav aria-label="Page navigation" id="PageNavigation"/>');
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
                } else {
                    paginationUl.append('<li id="ajax-grid-next-button"><a role="button" aria-label="Next" style="margin-left: 5px;" ><span aria-hidden="true">Load More</span></a></li>');
                }

                paginationNav.append(paginationUl);
                //_wrapper.parent().find("#PageNavigation").remove();
                _destination.parent().find("#PageNavigation").remove();
                //_wrapper.after(paginationNav);
                if(_noOfPages > 0) {
                    _destination.after(paginationNav);
                }

                footer._init();
            },
            _numberPagination: function () {
                var currentPageNo = _settings.currentPage;
                var paginationExtraBtns = "";
                if (_noOfPages < 5) {
                    var i = 1;
                    while (i < _noOfPages + 1) {
                        if (i == currentPageNo) paginationExtraBtns += getButton(i, "Active");
                        else paginationExtraBtns += getButton(i);
                        i++;
                    }
                } else {
                    if (currentPageNo == 1) {
                        paginationExtraBtns += getButton(currentPageNo, "Active");
                        paginationExtraBtns += getButton(currentPageNo + 1);
                        paginationExtraBtns += getButton(currentPageNo + 2);
                        paginationExtraBtns += "<li><span>...</span></li>";
                        paginationExtraBtns += getButton(_noOfPages);
                    } else if (currentPageNo == 2) {
                        paginationExtraBtns += getButton(currentPageNo - 1);
                        paginationExtraBtns += getButton(currentPageNo, "Active");
                        paginationExtraBtns += getButton(currentPageNo + 1);
                        paginationExtraBtns += "<li><span>...</span></li>";
                        paginationExtraBtns += getButton(_noOfPages);
                    } else if (currentPageNo == 3) {
                        paginationExtraBtns += getButton(currentPageNo - 2);
                        paginationExtraBtns += getButton(currentPageNo - 1);
                        paginationExtraBtns += getButton(currentPageNo, "Active");
                        paginationExtraBtns += getButton(currentPageNo + 1);
                        paginationExtraBtns += "<li><span>...</span></li>";
                        paginationExtraBtns += getButton(_noOfPages);
                    } else if (currentPageNo == (_noOfPages - 2)) {
                        paginationExtraBtns += getButton(1);
                        paginationExtraBtns += "<li><span>...</span></li>";
                        paginationExtraBtns += getButton(currentPageNo - 1);
                        paginationExtraBtns += getButton(currentPageNo, "Active");
                        paginationExtraBtns += getButton(currentPageNo + 1);
                        paginationExtraBtns += getButton(currentPageNo + 2);
                    } else if (currentPageNo == (_noOfPages - 1)) {
                        paginationExtraBtns += getButton(1);
                        paginationExtraBtns += "<li><span>...</span></li>";
                        paginationExtraBtns += getButton(currentPageNo - 1);
                        paginationExtraBtns += getButton(currentPageNo, "Active");
                        paginationExtraBtns += getButton(currentPageNo + 1);
                    } else if (currentPageNo == _noOfPages) {
                        paginationExtraBtns += getButton(1);
                        paginationExtraBtns += "<li><span>...</span></li>";
                        paginationExtraBtns += getButton(currentPageNo - 2);
                        paginationExtraBtns += getButton(currentPageNo - 1);
                        paginationExtraBtns += getButton(currentPageNo, "Active");
                    } else {
                        paginationExtraBtns += getButton(1);
                        paginationExtraBtns += "<li><span>...</span></li>";
                        paginationExtraBtns += getButton(currentPageNo - 1);
                        paginationExtraBtns += getButton(currentPageNo, "Active");
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
                if ($(this).attr("class") != "disabled") {
                    _settings.offset += _settings.limit;
                    _settings.currentPage += 1;
                    table._refresh();
                }
            },
            _goToPage: function (pageNo) {
                if (($("#ajax-grid-goto-page").attr("class") != "disabled" && !isNaN(parseInt($("#ajax-grid-page-no").text()))) || !isNaN(pageNo)) {
                    _settings.currentPage = parseInt($("#ajax-grid-page-no").text());
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
                var gotoPage = $("#ajax-grid-goto-page");
                $("#ajax-grid-previous-button").addClass("disabled");
                $("#ajax-grid-next-button").addClass("disabled");
                if (isNaN(pageNo) || pageNo > _noOfPages) gotoPage.addClass("disabled");
                else gotoPage.removeClass("disabled");
            },
            _enableDisable: function () {
                var pageNo = _settings.currentPage;
                if (pageNo < 2) $("#ajax-grid-previous-button").addClass("disabled");
                if ((pageNo >= _noOfPages)) $("#ajax-grid-next-button").addClass("disabled");
            },
            _paginationButtonsClick: function () {
                var pageNo = parseInt($(this).attr("page-no"));
                pagination._goToPage(pageNo);
            }
        };

        var footer = {
            _init: function () {
                var paginationDiv = $(".pagination");
                var msg = "<i id='footer-message' style='line-height: 32px; margin-left: 10px;'>" +
                    "Showing " + (_settings.offset + 1) + " to " + (_settings.offset + _data.data.length) + " of " + _data.count + " entries" +
                    "</i>";
                paginationDiv.find("#footer-message").remove();
                paginationDiv.append("<li>" + msg + "</li>");
            }
        };

        filter._init();
        table._init();

        /* List of events */
        $(document).on('click', "#ajax-grid-previous-button", pagination._previousPage);
        $(document).on('click', '#ajax-grid-next-button', pagination._nextPage);
        $(document).on('click', '#ajax-grid-goto-page', pagination._goToPage);
        $(document).on('change', '.ajax-grid-limit-search', filter._update);
        $(document).on('keyup', '#ajax-grid-page-no', pagination._disableGo);
        $(document).on('click', '.ajax-grid-pagination-btn', pagination._paginationButtonsClick);
    }

})(jQuery);