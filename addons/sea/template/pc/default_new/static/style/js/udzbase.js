; !function (win) {
    var UDZBase = {
        delay: function (fnFun, nTime) {
            nTime = ((nTime === undefined || nTime < 0) ? 1000 : nTime);
            return setTimeout(function () { fnFun(); }, nTime);
        },
        url: {
            redirect: function (sUrl, oParam) {
                if (!oParam) {
                    location.href = sUrl
                } else {
                    location.href = sUrl + (sUrl.indexOf('?') == -1 ? '?' : '&') + $.param(oParam);
                }
            },
            delayRedirect: function (sUrl, nTime, oParams) {
                return UDZBase.delay(function () {
                    UDZBase.url.redirect(sUrl, oParams);
                }, nTime)
            }
        },
        layer: {
            alert: function (sContent, callback) {
                return layer.alert(sContent, -1, callback);
            },
            fail: function (sContent, nTime) {
                return layer.msg((sContent == undefined ? "??????????????????????????????..." : sContent), (nTime > 0 ? nTime : 2), { type: 8, shade: false });
            },
            ok: function (sContent, nTime) {
                return layer.msg((sContent == undefined ? "????????????" : sContent), (nTime > 0 ? nTime : 2), { type: 1, shade: false });
            },
            mess: function (sContent, nTime) {
                return UDZBase.layer.info(sContent, nTime);
            },
            info: function (sContent, nTime) {
                return layer.msg(sContent, (nTime > 0 ? nTime : 2), { type: -1, shade: false });
            },
            load: function (sContent) {
                return layer.load((sContent == undefined ? '????????????????????????' : sContent), 0);
            },
            close: function (nIndex) {
                if (nIndex > 0) {
                    layer.close(nIndex);
                } else {
                    layer.closeAll();
                }
            },
            ajaxClose: function (nIndex) {
                setTimeout(function () {
                    UDZBase.layer.close(nIndex);
                }, 600);
            },
            ajaxInfo: function (sContent, nTime, nIndex) {
                setTimeout(function () {
                    UDZBase.layer.close(nIndex);
                    UDZBase.layer.info(sContent, nTime);
                }, 600);
            }
        },
        storage: {
            support: function () {
                return "localStorage" in win && win['localStorage'] !== null;
            },
            get: function (sKey) {
                if (UDZBase.storage.support()) {
                    try {
                        return localStorage.getItem(sKey);
                    } catch (e) {
                        UDZBase.layer.info("?????????????????????/?????????????????????????????????????????????????????????????????????");
                        return "";
                    }
                } else {
                    return "";
                }
            },
            set: function (sKey, sVal) {
                if (UDZBase.storage.support()) {
                    try {
                        localStorage.setItem(sKey, sVal);
                        return true;
                    } catch (e) {
                        UDZBase.layer.info("?????????????????????/?????????????????????????????????????????????????????????????????????");
                        return false;
                    }
                } else {
                    return false;
                }
            },
            remove: function (key) {
                try {
                    localStorage.removeItem(key);
                    return true;
                } catch (e) {
                    UDZBase.layer.info("?????????????????????/?????????????????????????????????????????????????????????????????????");
                    return false;
                }
            }
        },
        regExp: {
            mobile: /^1[3-9]\d{9}$/,
            email: /^[\w\+\-]+(\.[\w\+\-]+)*@[a-z\d\-]+(\.[a-z\d\-]+)*\.([a-z]{2,4})$/i,
            numlen6: /^\d{6}$/,
            password: /^[\x21-\x7E]{6,50}$/,
            name: /^[\u4e00-\u9fa50-9a-zA-Z \.]{1,20}$/,
            postcode: /^\d{6}$/,
            address: /^[\u4E00-\u9FA50-9a-zA-Z_()??????#-]{1,78}$/,
            remark: /^[\u4E00-\u9FA5 \x21-\x7E]{1,200}$/,
            remark2: /.{1,200}/,
            company: /^[\u4E00-\u9FA50-9a-zA-Z_()??????#-]{1,50}$/,
            couponcode: /^[0-9a-zA-Z]{6,12}$/
        },
        login: {
            override: function () { },
            callback: function (userInfo) {
                var jqLogin = $(".udz-popup-login");
                var sAHtmlStr = '<img src="' + (userInfo.photo ? userInfo.photo : GlobalConfigUrl.imageRootUrl + '/statics/udz/images/thumb.png') + '"> ' + (userInfo.nickname ? userInfo.nickname : userInfo.username);
                jqLogin.parent().html(sAHtmlStr);
                $('#newhead').find('.queryorder,.seller').addClass('login');
            },
            popup: function () {
                var nLayerIndex = $.layer({
                    type: 2,
                    title: '????????????',
                    fadeIn: 400,
                    shadeClose: false,
                    maxmin: false,
                    fix: true,
                    area: ["480px", "520px"],
                    iframe: {
                        src: GlobalConfigUrl.indexUrl + "/_loginpopup"
                    }
                });

                win.fnLoginPopupProcess = function (userInfo) {
                    if (typeof UDZBase.login.callback == "function") {
                        UDZBase.login.callback(userInfo);
                    }

                    if (typeof UDZBase.login.override == "function") {
                        UDZBase.login.override(userInfo);
                    }

                    setTimeout(function () {
                        layer.close(nLayerIndex);
                    }, 1000);
                };

                return false;
            }
        },
        tongji: {
            process: function (sUrl, options) {
                var sSrc = GlobalConfigUrl.aicurl + sUrl;
                var aParam = [];
                for (var key in options) {
                    aParam.push(key + "=" + options[key]);
                }
                sSrc += aParam.join("&");
                var jqImg = $("#img-udz-statistics");
                if (jqImg.length > 0) {
                    jqImg.attr("src", sSrc);
                } else {
                    jqImg = $('<img src=' + sSrc + ' id="img-udz-statistics" />');
                    $(document.body).append(jqImg);
                }
            },

            tongjiOptions: { rf: encodeURIComponent(document.referrer), siteid: 1 },
            tongjiProcess: function (options) {
                if (GlobalConfigUrl.productionEnv == "0") {
                    return false;
                }
                options = $.extend(options, UDZBase.tongji.tongjiOptions);
                UDZBase.tongji.process("/collect?", options);
            },

            eventOptions: { rf: encodeURIComponent(document.referrer), siteid: 1 },
            eventProcess: function (options) {
                if (GlobalConfigUrl.productionEnv == "0") {
                    return false;
                }
                options = $.extend(options, UDZBase.tongji.eventOptions);
                UDZBase.tongji.process("/events?", options);
            }
        },
        date: {
            format: function (date, fmt) {
                if (typeof fmt === 'undefined') {
                    fmt = date;
                    date = new Date();
                }
                var o = {
                    "M+": date.getMonth() + 1, //??????
                    "d+": date.getDate(), //???
                    "h+": date.getHours(), //??????
                    "m+": date.getMinutes(), //???
                    "s+": date.getSeconds(), //???
                    "q+": Math.floor((date.getMonth() + 3) / 3), //??????
                    "S": date.getMilliseconds() //??????
                };
                if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (date.getFullYear() + "").substr(4 - RegExp.$1.length));
                for (var k in o)
                    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
                return fmt;
            }
        },
        cookie: {
            get: function (name) {
                var arg = name + "=";
                var alen = arg.length;
                var clen = document.cookie.length;
                var i = 0;
                while (i < clen) {
                    var j = i + alen;
                    if (document.cookie.substring(i, j) == arg) {
                        var endstr = document.cookie.indexOf(";", j);
                        if (endstr == -1) {
                            endstr = document.cookie.length;
                        }
                        return decodeURIComponent(document.cookie.substring(j, endstr));
                    }
                    i = document.cookie.indexOf(" ", i) + 1;
                    if (i == 0) break;
                }
                return "";
            },
            set: function (name, value, expires, path, domain, secure) {
                document.cookie = name + "=" + encodeURIComponent(value) +
                ((expires) ? "; expires=" + expires : "") +
                ((path) ? "; path=" + path : "") +
                ((domain) ? "; domain=" + domain : "") +
                ((secure) ? "; secure" : "");
            },
            del: function (name, path, domain) {
                if (this.get(name)) {
                    document.cookie = name + "=" +
                            ((path) ? "; path=" + path : "") +
                            ((domain) ? "; domain=" + domain : "") +
                            "; expires=Thu, 01-Jan-70 00:00:01 GMT";
                }
            }
        },
        header: function () {

        },
        footer: function () {

        },
        shareInit: function (aImgs, cId, sUrl, qqTitle, rrTitle, wbTitle) {
            var appkeySinaWeibo = 1660997320;
            var link_url = window.location.href;
            var pic = "";
            //sUrl = "http://" + location.host + "/" + sUrl;
            function createShareContent() {
                pic = aImgs.join("||");
            }

            function createShareSinaWeiboUrl() {
                var shareUrl = ((GlobalConfigUrl.devicetype == undefined || GlobalConfigUrl.devicetype == "pc") ? "http://v.t.sina.com.cn/share/share.php?" : "http://service.weibo.com/share/mobile.php?")
                    + "appkey=" + appkeySinaWeibo
                    + "&title=" + encodeURIComponent(wbTitle)
                    + "&url=" + encodeURIComponent(sUrl)
                    + "&pic=" + encodeURIComponent(pic)
                    + "&summary=" + encodeURIComponent(wbTitle);

                $("#shareSinaWeibo").attr("href", shareUrl).attr("target", "_blank");
            }

            function createShareQzoneUrl() {
                var shareUrl = "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?"
                    + "desc=" + encodeURIComponent(qqTitle)
                    + "&url=" + encodeURIComponent(sUrl)
                    + "&pics=" + encodeURIComponent(pic)
                    + "&summary=" + encodeURIComponent(qqTitle);

                $("#shareQzone").attr("href", shareUrl).attr("target", "_blank");
            }

            function createShareRenrenUrl() {
                var shareUrl = "http://widget.renren.com/dialog/share?"
                    + "title=" + encodeURIComponent(rrTitle)
                    + "&resourceUrl=" + encodeURIComponent(sUrl)
                    + "&srcUrl=" + encodeURIComponent(sUrl)
                    + "&thumbnail_url=" + encodeURIComponent(aImgs[0])
                    + "&summary=" + encodeURIComponent(rrTitle);

                $("#shareRenren").attr("href", shareUrl).attr("target", "_blank");
            }

            function createShareWeixinQrcode() {
                var jqQRCode = $("#qrcode");
                var sUrl = "";
                var oData = {};
                if (jqQRCode.length > 0 && !jqQRCode.attr("data-src") && cId > 0) {
                    sUrl = "_campaignQrcode";
                    oData = { id: cId };
                }
                switchQrcodeShowHide(sUrl, oData, jqQRCode);
            }

            function createShopShareWeixinQrcode() {
                var jqQRCode = $("#shopqrcode");
                var sUrl = "";
                var oData = {};
                if (jqQRCode.length > 0 && !jqQRCode.attr("data-src") && cId > 0) {
                    sUrl = "_storeQrcode";
                    oData = { storeid: cId };
                }
                switchQrcodeShowHide(sUrl, oData, jqQRCode);
            }

            function createRecommendShareWeixinQrcode() {
                var jqQRCode = $("#recommendqrcode");
                var sUrl = "";
                var oData = {};
                if (jqQRCode.length > 0 && !jqQRCode.attr("data-src")) {
                    sUrl = "_recommendQrcode";
                }
                switchQrcodeShowHide(sUrl, oData, jqQRCode);
            }

            function switchQrcodeShowHide(sUrl, oData, jqQRCode) {
                if (sUrl) {
                    //???????????????????????????
                    $.ajax({
                        url: sUrl,
                        type: "get",
                        dataType: "json",
                        data: oData
                    }).done(function (result) {
                        if (result.code == 200) {
                            jqQRCode.attr("data-src", result.data.url);
                        }
                    }).fail(function (result) {
                    }).always(function () {

                    });
                }

                var nTimer;
                jqQRCode.parent().on("mouseenter", function () {
                    if (jqQRCode.attr("data-src")) {
                        jqQRCode.attr("src", jqQRCode.attr("data-src"));
                        jqQRCode.removeAttr("data-src");
                    }
                    nTimer = setTimeout(function () {
                        jqQRCode.show();
                    }, 300);
                }).on("mouseleave", function () {
                    clearTimeout(nTimer);
                    jqQRCode.hide();
                });
            }

            function shareSinaWeibo() {
                $("#shareSinaWeiboForm").submit();
            }

            function shareQzone() {
                if (window.location.hostname == "localhost") {
                    //alert("qq??????????????????Localhost???url??????????????????????????????????????????????????????");
                    return;
                }

                $("#shareQzoneForm").submit();
            }

            function shareRenren() {
                $("#shareRenrenForm").submit();
            }

            createShareContent();
            createShareSinaWeiboUrl();
            createShareQzoneUrl();
            createShareRenrenUrl();
            createShareWeixinQrcode(); createShopShareWeixinQrcode(); createRecommendShareWeixinQrcode()
        },
        lazyLoadImg: function () {
            $.fn.scrollLoading = function (options) {
                var defaults = {
                    attr: "data-loadsrc"
                };
                var params = $.extend({}, defaults, options || {});
                params.cache = [];
                $(this).each(function () {
                    var jqThis = $(this);
                    //jqThis.css("opacity", 0.5);
                    var node = this.nodeName.toLowerCase(), url = jqThis.attr(params["attr"]);
                    jqThis.removeAttr(params["attr"]);
                    if (!url) { return; }
                    //??????
                    var data = {
                        obj: jqThis,
                        tag: node,
                        url: url
                    };
                    params.cache.push(data);
                });

                //??????????????????
                var loading = function (chk) {
                    var st = $(window).scrollTop(), sth = st + $(window).height();
                    $.each(params.cache, function (i, data) {
                        var o = data.obj, tag = data.tag, url = data.url;
                        if (o) {
                            post = o.offset().top; posb = post + o.height();
                            if ((post > st && post < sth) || (posb > st && posb < sth)) {
                                //?????????????????????
                                //if (tag === "img") {
                                //if (chk != 1) {
                                //    o.on("load", function () { o.animate({ opacity: 1 }, 300); });
                                //}
                                //else {
                                //    o.css("opacity", 1);
                                //}
                                o.attr("src", url);
                                //} else {
                                //    o.load(url);
                                //}
                                data.obj = null;
                            }
                        }
                    });
                    return false;
                };

                //????????????
                //?????????????????????
                loading(1);
                //????????????
                $(window).on("scroll", loading);
            };
        },
        udzInit: function () {
            if (("placeholder" in document.createElement("input")) === false && typeof require != "undefined") {
                require(["placeholder"], function () {
                    $("[placeholder]").each(function () {
                        var jqThis = $(this);
                        jqThis.placeholder({
                            labelMode: true,
                            labelStyle: jqThis.data("phstyle"),
                            labelAlpha: true
                            //, labelAcross: true
                        });
                    });
                });
            };

            var nUserDownTimer = 0;
            $("#newhead").on("click", ".udz-popup-login", function () { UDZBase.login.popup(); return false; })
                         .on("click", ".logout", function () {
                             $.ajax({
                                 url: '_doLogout',
                                 type: "post"
                             }).done(function (reply) {
                             }).fail(function (reply) {
                             }).always(function () {
                                 location.reload();
                                 //location.href = sRootUrl;
                             });
                             return false;
                         });

            $(".norightkey").on("contextmenu", function () { return false; });

            var scrollTimer;
            var jqWindow = $(window),
                jqHB = $("html,body"),
                jqGoTop = $(".up-top-btn");
            if (jqGoTop.length > 0) {
                jqWindow.on("scroll", function (e) {
                    clearTimeout(scrollTimer);
                    scrollTimer = setTimeout(function () {
                        if (jqWindow.scrollTop() > 600) {
                            jqGoTop.css({ display: "block", opacity: 1 });
                        }
                        else {
                            jqGoTop.css({ display: "none", opacity: 0 });
                        }
                    }, 100);
                }).trigger("scroll");

                jqGoTop.on("click", function (e) {
                    jqHB.animate({ scrollTop: 0 }, 300);
                    return false;
                });
            };

            // ????????????
            var inpageTime = +new Date();
            $.fn.docBindkeydown = function (next) {
                var _this = this;
                this.keydown(function (event) {
                    if (event.keyCode == '13') {
                        var val = _this.val() == '' ? 'T???' : _this.val()
                        next(val, $('#newhead .select').data('url'));
                    }
                });
                $('#newhead .searchbtn').on('click', function () {
                    var val = _this.val() == '' ? 'T???' : _this.val()
                    next(val, $('#newhead .select').data('url'));
                });
                $('.searchtypelist').on('click', '.searchtypeone', function () {
                    if ($('.searchtypeone').index($(this)) == 0) {
                        $(this).parents('.select').data('url', '_searchCampaign').find('span').text($(this).text());

                    } else {
                        $(this).parents('.select').data('url', '_searchStore').find('span').text($(this).text());
                    }
                })
            }
            $('#searchid').docBindkeydown(function (val, url) {
                var searchTime = +new Date() - inpageTime;
                inpageTime = +new Date();
                UDZBase.tongji.eventProcess({ v4: searchTime, v3: 'btn-search-box-click' });
                location.href = encodeURI('_search#keywords-' + val + '/smallcategoryname-/label-/sort-0/type-/freeshipping-0/currentPage-1/pageSize-20/url-' + url);
            });
            $(document).on('click', '.SEARCH', function () {
                if ($(this).parents('.KEYWORD').length) {
                    location.href = '_search#keywords-' + $(this).text() + '/smallcategoryname-/label-/sort-0/type-/freeshipping-0/currentPage-1/pageSize-20/url-_searchCampaign';
                }
                if ($(this).parents('.LABEL').length) {
                    if ($(this).attr('target') == '_blank') {
                        window.open('_search#keywords-/smallcategoryname-/label-' + $(this).text() + '/sort-0/type-/freeshipping-0/currentPage-1/pageSize-20/url-_searchCampaign');
                    } else {
                        location.href = '_search#keywords-/smallcategoryname-/label-' + $(this).text() + '/sort-0/type-/freeshipping-0/currentPage-1/pageSize-20/url-_searchCampaign';
                    }
                }
            });

            UDZBase.lazyLoadImg();
        },

        shareH5Init: function (aImgs, cId, sUrl, qqTitle, rrTitle, wbTitle) {
            var appkeySinaWeibo = 1660997320;
            var link_url = window.location.href;
            var pic = "";
            //sUrl = "http://" + location.host + "/" + sUrl;
            function createShareContent() {
                pic = aImgs.join("||");
            }

            function createShareSinaWeiboUrl() {
                var shareUrl = "http://service.weibo.com/share/mobile.php?"
                    + "appkey=" + appkeySinaWeibo
                    + "&title=" + encodeURIComponent(wbTitle)
                    + "&url=" + encodeURIComponent(sUrl)
                    + "&pic=" + encodeURIComponent(pic)
                    + "&summary=" + encodeURIComponent(wbTitle);

                $("#shareSinaWeibo").attr("href", shareUrl).attr("target", "_blank");
            }

            function createShareQzoneUrl() {
                var shareUrl = "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?"
                    + "desc=" + encodeURIComponent(qqTitle)
                    + "&url=" + encodeURIComponent(sUrl)
                    + "&pics=" + encodeURIComponent(aImgs[0])
                    + "&summary=" + encodeURIComponent(qqTitle);

                $("#shareQzone").attr("href", shareUrl).attr("target", "_blank");
            }

            function createShareRenrenUrl() {
                var shareUrl = "http://widget.renren.com/dialog/share?"
                    + "title=" + encodeURIComponent(rrTitle)
                    + "&resourceUrl=" + encodeURIComponent(sUrl)
                    + "&srcUrl=" + encodeURIComponent(sUrl)
                    + "&thumbnail_url=" + encodeURIComponent(aImgs[0])
                    + "&summary=" + encodeURIComponent(rrTitle);

                $("#shareRenren").attr("href", shareUrl).attr("target", "_blank");
            }

            function createShareWeixinQrcode() {
                var jqQRCode = $("#qrcode");
                var jqImgqrcode = $("#img-qrcode");
                if (jqImgqrcode.length > 0 && !jqImgqrcode.attr("src")) {
                    //???????????????????????????
                    $.ajax({
                        url: '_campaignQrcode',
                        type: "post",
                        dataType: "json",
                        data: {
                            id: cId
                        }
                    }).done(function (result) {
                        if (result.code == 200) {
                            jqImgqrcode.attr("src", result.data.url);
                            jqImgqrcode.show();
                        } else {
                            //alert(result.data);
                        }
                    }).fail(function (result) {
                        //alert("????????????????????????");
                    }).always(function () {

                    });
                };
            }

            createShareContent();
            createShareSinaWeiboUrl();
            createShareQzoneUrl();
            createShareRenrenUrl();
            createShareWeixinQrcode();
        },
        udzH5Init: function () {
            var fnShowBlur = function (selector) {
                if (!selector) {
                    selector = ".head-title,#header,#footer,#mainbody";
                }
                $(selector).addClass("blur2");
            };

            var fnHideBlur = function () {
                $("#header,#footer,#mainbody").removeClass("blur2");
            };

            var fnShowShadedLayer = function (selector, callback) {
                var jqLayer = $('<div id="div-shadedlayer">').on("click", function () {
                    fnHideShadedLayer();
                    if (typeof callback == "function") {
                        callback();
                    }
                });
                $(document.body).append(jqLayer);
                fnShowBlur(selector);
            };

            var fnHideShadedLayer = function () {
                $("#div-shadedlayer").remove();
                fnHideBlur();
            };

            var fnCommon = function () {
                var jqLoginReg = $(".login-reg");
                $(".header").on("click", ".menu", function () {
                    if (jqLoginReg.hasClass("down")) {
                        fnHideShadedLayer();
                        jqLoginReg.removeClass("down");
                    } else {
                        fnShowShadedLayer("#mainbody,#footer", function () {
                            jqLoginReg.removeClass("down");
                        });
                        jqLoginReg.addClass("down");
                    }
                    return false;
                });

                jqLoginReg.on("click", "span", function () {
                    var jqThis = $(this);
                    var dNowDate = new Date();
                    dNowDate.setDate(dNowDate.getDate() + 1);
                    var sDomain = GlobalConfigUrl.domain;
                    if (!sDomain) {
                        sDomain = GlobalConfigUrl.indexUrl.replace('http://', '');
                    }

                    if (jqThis.hasClass("store")) {
                        UDZBase.cookie.set('UDZH5ReturnUrl', location.href, dNowDate, '/', sDomain);
                    }
                    if (jqThis.hasClass("ydz-login")) {
                        location.href = GlobalConfigUrl.mdomainUrl + "/_login";
                    } else if (jqThis.hasClass("ydz-reg")) {
                        location.href = GlobalConfigUrl.mdomainUrl + "/_register";
                    } else if (jqThis.hasClass("sellerhome")) {
                        UDZBase.cookie.set('UDZH5ReturnUrl', GlobalConfigUrl.mdomainUrl + '/_sellerhome', dNowDate, '/', sDomain);
                        location.href = GlobalConfigUrl.mdomainUrl + '/_login';
                    } else if (jqThis.hasClass("mycoupon")) {
                        UDZBase.cookie.set('UDZH5ReturnUrl', GlobalConfigUrl.mdomainUrl + '/_mycoupon', dNowDate, '/', sDomain);
                        location.href = GlobalConfigUrl.mdomainUrl + '/_login';
                    }
                    return false;
                }).on("click", ".logout", function () {
                    if (confirm("?????????????????????")) {
                        $.ajax({
                            url: '_doLogout',
                            type: "post"
                        }).done(function (reply) {
                            location.reload();
                        });
                        return false;
                    }
                });

                var scrollTimer;
                var jqWindow = $(window),
                    jqHB = $("html,body"),
                    jqGoTop = $(".up-top-btn");
                if (jqGoTop.length > 0) {
                    jqWindow.on("scroll", function (e) {
                        clearTimeout(scrollTimer);
                        scrollTimer = setTimeout(function () {
                            if (jqWindow.scrollTop() > 600) {
                                jqGoTop.css({ display: "block", opacity: 1 });
                            }
                            else {
                                jqGoTop.css({ display: "none", opacity: 0 });
                            }
                        }, 100);
                    }).trigger("scroll");

                    jqGoTop.on("click", function (e) {
                        jqHB.animate({ scrollTop: 0 }, 300);
                        return false;
                    });
                };
            };
            fnCommon();

            UDZBase.lazyLoadImg();
        }
    };

    win.udz = UDZBase;

    if (typeof define == "function" && define.amd) {
        define("udz", ["jquery", "layer"], function () {
            return UDZBase;
        });
    }
}(window);