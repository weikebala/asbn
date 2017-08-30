!
function(e) {
    var a = {
        delay: function(e, a) {
            a = a === undefined || a < 0 ? 1e3: a;
            return setTimeout(function() {
                e()
            },
            a)
        },
        url: {
            redirect: function(e, a) {
                if (!a) {
                    location.href = e
                } else {
                    location.href = e + (e.indexOf("?") == -1 ? "?": "&") + $.param(a)
                }
            },
            delayRedirect: function(e, n, t) {
                return a.delay(function() {
                    a.url.redirect(e, t)
                },
                n)
            }
        },
        layer: {
            alert: function(e, a) {
                return layer.alert(e, -1, a)
            },
            fail: function(e, a) {
                return layer.msg(e == undefined ? "??????????????????????????????...": e, a > 0 ? a: 2, {
                    type: 8,
                    shade: false
                })
            },
            ok: function(e, a) {
                return layer.msg(e == undefined ? "????????????": e, a > 0 ? a: 2, {
                    type: 1,
                    shade: false
                })
            },
            mess: function(e, n) {
                return a.layer.info(e, n)
            },
            info: function(e, a) {
                return layer.msg(e, a > 0 ? a: 2, {
                    type: -1,
                    shade: false
                })
            },
            load: function(e) {
                return layer.load(e == undefined ? "????????????????????????": e, 0)
            },
            close: function(e) {
                if (e > 0) {
                    layer.close(e)
                } else {
                    layer.closeAll()
                }
            },
            ajaxClose: function(e) {
                setTimeout(function() {
                    a.layer.close(e)
                },
                600)
            },
            ajaxInfo: function(e, n, t) {
                setTimeout(function() {
                    a.layer.close(t);
                    a.layer.info(e, n)
                },
                600)
            }
        },
        storage: {
            support: function() {
                return "localStorage" in e && e["localStorage"] !== null
            },
            get: function(e) {
                if (a.storage.support()) {
                    try {
                        return localStorage.getItem(e)
                    } catch(n) {
                        a.layer.info("?????????????????????/?????????????????????????????????????????????????????????????????????");
                        return ""
                    }
                } else {
                    return ""
                }
            },
            set: function(e, n) {
                if (a.storage.support()) {
                    try {
                        localStorage.setItem(e, n);
                        return true
                    } catch(t) {
                        a.layer.info("?????????????????????/?????????????????????????????????????????????????????????????????????");
                        return false
                    }
                } else {
                    return false
                }
            },
            remove: function(e) {
                try {
                    localStorage.removeItem(e);
                    return true
                } catch(n) {
                    a.layer.info("?????????????????????/?????????????????????????????????????????????????????????????????????");
                    return false
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
            override: function() {},
            callback: function(e) {
                var a = $(".udz-popup-login");
                var n = '<img src="' + (e.photo ? e.photo: GlobalConfigUrl.imageRootUrl + "/statics/udz/images/thumb.png") + '"> ' + (e.nickname ? e.nickname: e.username);
                a.parent().html(n);
                $("#newhead").find(".queryorder,.seller").addClass("login")
            },
            popup: function() {
                var n = $.layer({
                    type: 2,
                    title: "????????????",
                    fadeIn: 400,
                    shadeClose: false,
                    maxmin: false,
                    fix: true,
                    area: ["480px", "520px"],
                    iframe: {
                        src: GlobalConfigUrl.indexUrl + "/_loginpopup"
                    }
                });
                e.fnLoginPopupProcess = function(e) {
                    if (typeof a.login.callback == "function") {
                        a.login.callback(e)
                    }
                    if (typeof a.login.override == "function") {
                        a.login.override(e)
                    }
                    setTimeout(function() {
                        layer.close(n)
                    },
                    1e3)
                };
                return false
            }
        },
        tongji: {
            process: function(e, a) {
                var n = GlobalConfigUrl.aicurl + e;
                var t = [];
                for (var i in a) {
                    t.push(i + "=" + a[i])
                }
                n += t.join("&");
                var r = $("#img-udz-statistics");
                if (r.length > 0) {
                    r.attr("src", n)
                } else {
                    r = $("<img src=" + n + ' id="img-udz-statistics" />');
                    $(document.body).append(r)
                }
            },
            tongjiOptions: {
                rf: encodeURIComponent(document.referrer),
                siteid: 1
            },
            tongjiProcess: function(e) {
                if (GlobalConfigUrl.productionEnv == "0") {
                    return false
                }
                e = $.extend(e, a.tongji.tongjiOptions);
                a.tongji.process("/collect?", e)
            },
            eventOptions: {
                rf: encodeURIComponent(document.referrer),
                siteid: 1
            },
            eventProcess: function(e) {
                if (GlobalConfigUrl.productionEnv == "0") {
                    return false
                }
                e = $.extend(e, a.tongji.eventOptions);
                a.tongji.process("/events?", e)
            }
        },
        date: {
            format: function(e, a) {
                if (typeof a === "undefined") {
                    a = e;
                    e = new Date
                }
                var n = {
                    "M+": e.getMonth() + 1,
                    "d+": e.getDate(),
                    "h+": e.getHours(),
                    "m+": e.getMinutes(),
                    "s+": e.getSeconds(),
                    "q+": Math.floor((e.getMonth() + 3) / 3),
                    S: e.getMilliseconds()
                };
                if (/(y+)/.test(a)) a = a.replace(RegExp.$1, (e.getFullYear() + "").substr(4 - RegExp.$1.length));
                for (var t in n) if (new RegExp("(" + t + ")").test(a)) a = a.replace(RegExp.$1, RegExp.$1.length == 1 ? n[t] : ("00" + n[t]).substr(("" + n[t]).length));
                return a
            }
        },
        cookie: {
            get: function(e) {
                var a = e + "=";
                var n = a.length;
                var t = document.cookie.length;
                var i = 0;
                while (i < t) {
                    var r = i + n;
                    if (document.cookie.substring(i, r) == a) {
                        var o = document.cookie.indexOf(";", r);
                        if (o == -1) {
                            o = document.cookie.length
                        }
                        return decodeURIComponent(document.cookie.substring(r, o))
                    }
                    i = document.cookie.indexOf(" ", i) + 1;
                    if (i == 0) break
                }
                return ""
            },
            set: function(e, a, n, t, i, r) {
                document.cookie = e + "=" + encodeURIComponent(a) + (n ? "; expires=" + n: "") + (t ? "; path=" + t: "") + (i ? "; domain=" + i: "") + (r ? "; secure": "")
            },
            del: function(e, a, n) {
                if (this.get(e)) {
                    document.cookie = e + "=" + (a ? "; path=" + a: "") + (n ? "; domain=" + n: "") + "; expires=Thu, 01-Jan-70 00:00:01 GMT"
                }
            }
        },
        header: function() {},
        footer: function() {},
        shareInit: function(e, a, n, t, i, r) {
            var o = 1660997320;
            var s = window.location.href;
            var l = "";
            function c() {
                l = e.join("||")
            }
            function d() {
                var e = (GlobalConfigUrl.devicetype == undefined || GlobalConfigUrl.devicetype == "pc" ? "http://v.t.sina.com.cn/share/share.php?": "http://service.weibo.com/share/mobile.php?") + "appkey=" + o + "&title=" + encodeURIComponent(r) + "&url=" + encodeURIComponent(n) + "&pic=" + encodeURIComponent(l) + "&summary=" + encodeURIComponent(r);
                $("#shareSinaWeibo").attr("href", e).attr("target", "_blank")
            }
            function u() {
                var e = "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?" + "desc=" + encodeURIComponent(t) + "&url=" + encodeURIComponent(n) + "&pics=" + encodeURIComponent(l) + "&summary=" + encodeURIComponent(t);
                $("#shareQzone").attr("href", e).attr("target", "_blank")
            }
            function f() {
                var a = "http://widget.renren.com/dialog/share?" + "title=" + encodeURIComponent(i) + "&resourceUrl=" + encodeURIComponent(n) + "&srcUrl=" + encodeURIComponent(n) + "&thumbnail_url=" + encodeURIComponent(e[0]) + "&summary=" + encodeURIComponent(i);
                $("#shareRenren").attr("href", a).attr("target", "_blank")
            }
            function p() {
                var e = $("#qrcode");
                var n = "";
                var t = {};
                if (e.length > 0 && !e.attr("data-src") && a > 0) {
                    n = "_campaignQrcode";
                    t = {
                        id: a
                    }
                }
                h(n, t, e)
            }
            function m() {
                var e = $("#shopqrcode");
                var n = "";
                var t = {};
                if (e.length > 0 && !e.attr("data-src") && a > 0) {
                    n = "_storeQrcode";
                    t = {
                        storeid: a
                    }
                }
                h(n, t, e)
            }
            function v() {
                var e = $("#recommendqrcode");
                var a = "";
                var n = {};
                if (e.length > 0 && !e.attr("data-src")) {
                    a = "_recommendQrcode"
                }
                h(a, n, e)
            }
            function h(e, a, n) {
                if (e) {
                    $.ajax({
                        url: e,
                        type: "get",
                        dataType: "json",
                        data: a
                    }).done(function(e) {
                        if (e.code == 200) {
                            n.attr("data-src", e.data.url)
                        }
                    }).fail(function(e) {}).always(function() {})
                }
                var t;
                n.parent().on("mouseenter",
                function() {
                    if (n.attr("data-src")) {
                        n.attr("src", n.attr("data-src"));
                        n.removeAttr("data-src")
                    }
                    t = setTimeout(function() {
                        n.show()
                    },
                    300)
                }).on("mouseleave",
                function() {
                    clearTimeout(t);
                    n.hide()
                })
            }
            function g() {
                $("#shareSinaWeiboForm").submit()
            }
            function y() {
                if (window.location.hostname == "localhost") {
                    return
                }
                $("#shareQzoneForm").submit()
            }
            function b() {
                $("#shareRenrenForm").submit()
            }
            c();
            d();
            u();
            f();
            p();
            m();
            v()
        },
        lazyLoadImg: function() {
            $.fn.scrollLoading = function(e) {
                var a = {
                    attr: "data-loadsrc"
                };
                var n = $.extend({},
                a, e || {});
                n.cache = [];
                $(this).each(function() {
                    var e = $(this);
                    var a = this.nodeName.toLowerCase(),
                    t = e.attr(n["attr"]);
                    e.removeAttr(n["attr"]);
                    if (!t) {
                        return
                    }
                    var i = {
                        obj: e,
                        tag: a,
                        url: t
                    };
                    n.cache.push(i)
                });
                var t = function(e) {
                    var a = $(window).scrollTop(),
                    t = a + $(window).height();
                    $.each(n.cache,
                    function(e, n) {
                        var i = n.obj,
                        r = n.tag,
                        o = n.url;
                        if (i) {
                            post = i.offset().top;
                            posb = post + i.height();
                            if (post > a && post < t || posb > a && posb < t) {
                                i.attr("src", o);
                                n.obj = null
                            }
                        }
                    });
                    return false
                };
                t(1);
                $(window).on("scroll", t)
            }
        },
        udzInit: function() {
            if ("placeholder" in document.createElement("input") === false && typeof require != "undefined") {
                require(["placeholder"],
                function() {
                    $("[placeholder]").each(function() {
                        var e = $(this);
                        e.placeholder({
                            labelMode: true,
                            labelStyle: e.data("phstyle"),
                            labelAlpha: true
                        })
                    })
                })
            }
            var e = 0;
            $("#newhead").on("click", ".udz-popup-login",
            function() {
                a.login.popup();
                return false
            }).on("click", ".logout",
            function() {
                $.ajax({
                    url: "_doLogout",
                    type: "post"
                }).done(function(e) {}).fail(function(e) {}).always(function() {
                    location.reload()
                });
                return false
            });
            $(".norightkey").on("contextmenu",
            function() {
                return false
            });
            var n;
            var t = $(window),
            i = $("html,body"),
            r = $(".up-top-btn");
            if (r.length > 0) {
                t.on("scroll",
                function(e) {
                    clearTimeout(n);
                    n = setTimeout(function() {
                        if (t.scrollTop() > 600) {
                            r.css({
                                display: "block",
                                opacity: 1
                            })
                        } else {
                            r.css({
                                display: "none",
                                opacity: 0
                            })
                        }
                    },
                    100)
                }).trigger("scroll");
                r.on("click",
                function(e) {
                    i.animate({
                        scrollTop: 0
                    },
                    300);
                    return false
                })
            }
            var o = +new Date;
            $.fn.docBindkeydown = function(e) {
                var a = this;
                this.keydown(function(n) {
                    if (n.keyCode == "13") {
                        var t = a.val() == "" ? "T???": a.val();
                        e(t, $("#newhead .select").data("url"))
                    }
                });
                $("#newhead .searchbtn").on("click",
                function() {
                    var n = a.val() == "" ? "T???": a.val();
                    e(n, $("#newhead .select").data("url"))
                });
                $(".searchtypelist").on("click", ".searchtypeone",
                function() {
                    if ($(".searchtypeone").index($(this)) == 0) {
                        $(this).parents(".select").data("url", "_searchCampaign").find("span").text($(this).text())
                    } else {
                        $(this).parents(".select").data("url", "_searchStore").find("span").text($(this).text())
                    }
                })
            };
            $("#searchid").docBindkeydown(function(e, n) {
                var t = +new Date - o;
                o = +new Date;
                a.tongji.eventProcess({
                    v4: t,
                    v3: "btn-search-box-click"
                });
                location.href = encodeURI("_search#keywords-" + e + "/smallcategoryname-/label-/sort-0/type-/freeshipping-0/currentPage-1/pageSize-20/url-" + n)
            });
            $(document).on("click", ".SEARCH",
            function() {
                if ($(this).parents(".KEYWORD").length) {
                    location.href = "_search#keywords-" + $(this).text() + "/smallcategoryname-/label-/sort-0/type-/freeshipping-0/currentPage-1/pageSize-20/url-_searchCampaign"
                }
                if ($(this).parents(".LABEL").length) {
                    if ($(this).attr("target") == "_blank") {
                        window.open("_search#keywords-/smallcategoryname-/label-" + $(this).text() + "/sort-0/type-/freeshipping-0/currentPage-1/pageSize-20/url-_searchCampaign")
                    } else {
                        location.href = "_search#keywords-/smallcategoryname-/label-" + $(this).text() + "/sort-0/type-/freeshipping-0/currentPage-1/pageSize-20/url-_searchCampaign"
                    }
                }
            });
            a.lazyLoadImg()
        },
        shareH5Init: function(e, a, n, t, i, r) {
            var o = 1660997320;
            var s = window.location.href;
            var l = "";
            function c() {
                l = e.join("||")
            }
            function d() {
                var e = "http://service.weibo.com/share/mobile.php?" + "appkey=" + o + "&title=" + encodeURIComponent(r) + "&url=" + encodeURIComponent(n) + "&pic=" + encodeURIComponent(l) + "&summary=" + encodeURIComponent(r);
                $("#shareSinaWeibo").attr("href", e).attr("target", "_blank")
            }
            function u() {
                var a = "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?" + "desc=" + encodeURIComponent(t) + "&url=" + encodeURIComponent(n) + "&pics=" + encodeURIComponent(e[0]) + "&summary=" + encodeURIComponent(t);
                $("#shareQzone").attr("href", a).attr("target", "_blank")
            }
            function f() {
                var a = "http://widget.renren.com/dialog/share?" + "title=" + encodeURIComponent(i) + "&resourceUrl=" + encodeURIComponent(n) + "&srcUrl=" + encodeURIComponent(n) + "&thumbnail_url=" + encodeURIComponent(e[0]) + "&summary=" + encodeURIComponent(i);
                $("#shareRenren").attr("href", a).attr("target", "_blank")
            }
            function p() {
                var e = $("#qrcode");
                var n = $("#img-qrcode");
                if (n.length > 0 && !n.attr("src")) {
                    $.ajax({
                        url: "_campaignQrcode",
                        type: "post",
                        dataType: "json",
                        data: {
                            id: a
                        }
                    }).done(function(e) {
                        if (e.code == 200) {
                            n.attr("src", e.data.url);
                            n.show()
                        } else {}
                    }).fail(function(e) {}).always(function() {})
                }
            }
            c();
            d();
            u();
            f();
            p()
        },
        udzH5Init: function() {
            var e = function(e) {
                if (!e) {
                    e = ".head-title,#header,#footer,#mainbody"
                }
                $(e).addClass("blur2")
            };
            var n = function() {
                $("#header,#footer,#mainbody").removeClass("blur2")
            };
            var t = function(a, n) {
                var t = $('<div id="div-shadedlayer">').on("click",
                function() {
                    i();
                    if (typeof n == "function") {
                        n()
                    }
                });
                $(document.body).append(t);
                e(a)
            };
            var i = function() {
                $("#div-shadedlayer").remove();
                n()
            };
            var r = function() {
                var e = $(".login-reg");
                $(".header").on("click", ".menu",
                function() {
                    if (e.hasClass("down")) {
                        i();
                        e.removeClass("down")
                    } else {
                        t("#mainbody,#footer",
                        function() {
                            e.removeClass("down")
                        });
                        e.addClass("down")
                    }
                    return false
                });
                e.on("click", "span",
                function() {
                    var e = $(this);
                    var n = new Date;
                    n.setDate(n.getDate() + 1);
                    var t = GlobalConfigUrl.domain;
                    if (!t) {
                        t = GlobalConfigUrl.indexUrl.replace("http://", "")
                    }
                    if (e.hasClass("store")) {
                        a.cookie.set("UDZH5ReturnUrl", location.href, n, "/", t)
                    }
                    if (e.hasClass("ydz-login")) {
                        location.href = GlobalConfigUrl.mdomainUrl + "/_login"
                    } else if (e.hasClass("ydz-reg")) {
                        location.href = GlobalConfigUrl.mdomainUrl + "/_register"
                    } else if (e.hasClass("sellerhome")) {
                        a.cookie.set("UDZH5ReturnUrl", GlobalConfigUrl.mdomainUrl + "/_sellerhome", n, "/", t);
                        location.href = GlobalConfigUrl.mdomainUrl + "/_login"
                    } else if (e.hasClass("mycoupon")) {
                        a.cookie.set("UDZH5ReturnUrl", GlobalConfigUrl.mdomainUrl + "/_mycoupon", n, "/", t);
                        location.href = GlobalConfigUrl.mdomainUrl + "/_login"
                    }
                    return false
                }).on("click", ".logout",
                function() {
                    if (confirm("?????????????????????")) {
                        $.ajax({
                            url: "_doLogout",
                            type: "post"
                        }).done(function(e) {
                            location.reload()
                        });
                        return false
                    }
                });
                var n;
                var r = $(window),
                o = $("html,body"),
                s = $(".up-top-btn");
                if (s.length > 0) {
                    r.on("scroll",
                    function(e) {
                        clearTimeout(n);
                        n = setTimeout(function() {
                            if (r.scrollTop() > 600) {
                                s.css({
                                    display: "block",
                                    opacity: 1
                                })
                            } else {
                                s.css({
                                    display: "none",
                                    opacity: 0
                                })
                            }
                        },
                        100)
                    }).trigger("scroll");
                    s.on("click",
                    function(e) {
                        o.animate({
                            scrollTop: 0
                        },
                        300);
                        return false
                    })
                }
            };
            r();
            a.lazyLoadImg()
        }
    };
    e.udz = a;
    if (typeof define == "function" && define.amd) {
        define("udz", ["jquery", "layer"],
        function() {
            return a
        })
    }
} (window); !
function(e) {
    var a = 1;
    function n(e) {
        return s(r(l(e)))
    }
    function t(e, a) {
        return s(o(l(e), l(a)))
    }
    function i() {
        return n("abc").toLowerCase() == "900150983cd24fb0d6963f7d28e17f72"
    }
    function r(e) {
        return d(u(c(e), e.length * 8))
    }
    function o(e, a) {
        var n = c(e);
        if (n.length > 16) {
            n = u(n, e.length * 8)
        }
        var t = Array(16),
        i = Array(16);
        for (var r = 0; r < 16; r++) {
            t[r] = n[r] ^ 909522486;
            i[r] = n[r] ^ 1549556828
        }
        var o = u(t.concat(c(a)), 512 + a.length * 8);
        return d(u(i.concat(o), 512 + 128))
    }
    function s(e) {
        try {
            a
        } catch(n) {
            a = 0
        }
        var t = a ? "0123456789ABCDEF": "0123456789abcdef";
        var i = "";
        var r;
        for (var o = 0; o < e.length; o++) {
            r = e.charCodeAt(o);
            i += t.charAt(r >>> 4 & 15) + t.charAt(r & 15)
        }
        return i
    }
    function l(e) {
        var a = "";
        var n = -1;
        var t, i;
        while (++n < e.length) {
            t = e.charCodeAt(n);
            i = n + 1 < e.length ? e.charCodeAt(n + 1) : 0;
            if (55296 <= t && t <= 56319 && 56320 <= i && i <= 57343) {
                t = 65536 + ((t & 1023) << 10) + (i & 1023);
                n++
            }
            if (t <= 127) {
                a += String.fromCharCode(t)
            } else {
                if (t <= 2047) {
                    a += String.fromCharCode(192 | t >>> 6 & 31, 128 | t & 63)
                } else {
                    if (t <= 65535) {
                        a += String.fromCharCode(224 | t >>> 12 & 15, 128 | t >>> 6 & 63, 128 | t & 63)
                    } else {
                        if (t <= 2097151) {
                            a += String.fromCharCode(240 | t >>> 18 & 7, 128 | t >>> 12 & 63, 128 | t >>> 6 & 63, 128 | t & 63)
                        }
                    }
                }
            }
        }
        return a
    }
    function c(e) {
        var a = Array(e.length >> 2);
        for (var n = 0; n < a.length; n++) {
            a[n] = 0
        }
        for (var n = 0; n < e.length * 8; n += 8) {
            a[n >> 5] |= (e.charCodeAt(n / 8) & 255) << n % 32
        }
        return a
    }
    function d(e) {
        var a = "";
        for (var n = 0; n < e.length * 32; n += 8) {
            a += String.fromCharCode(e[n >> 5] >>> n % 32 & 255)
        }
        return a
    }
    function u(e, a) {
        e[a >> 5] |= 128 << a % 32;
        e[(a + 64 >>> 9 << 4) + 14] = a;
        var n = 1732584193;
        var t = -271733879;
        var i = -1732584194;
        var r = 271733878;
        for (var o = 0; o < e.length; o += 16) {
            var s = n;
            var l = t;
            var c = i;
            var d = r;
            n = p(n, t, i, r, e[o + 0], 7, -680876936);
            r = p(r, n, t, i, e[o + 1], 12, -389564586);
            i = p(i, r, n, t, e[o + 2], 17, 606105819);
            t = p(t, i, r, n, e[o + 3], 22, -1044525330);
            n = p(n, t, i, r, e[o + 4], 7, -176418897);
            r = p(r, n, t, i, e[o + 5], 12, 1200080426);
            i = p(i, r, n, t, e[o + 6], 17, -1473231341);
            t = p(t, i, r, n, e[o + 7], 22, -45705983);
            n = p(n, t, i, r, e[o + 8], 7, 1770035416);
            r = p(r, n, t, i, e[o + 9], 12, -1958414417);
            i = p(i, r, n, t, e[o + 10], 17, -42063);
            t = p(t, i, r, n, e[o + 11], 22, -1990404162);
            n = p(n, t, i, r, e[o + 12], 7, 1804603682);
            r = p(r, n, t, i, e[o + 13], 12, -40341101);
            i = p(i, r, n, t, e[o + 14], 17, -1502002290);
            t = p(t, i, r, n, e[o + 15], 22, 1236535329);
            n = m(n, t, i, r, e[o + 1], 5, -165796510);
            r = m(r, n, t, i, e[o + 6], 9, -1069501632);
            i = m(i, r, n, t, e[o + 11], 14, 643717713);
            t = m(t, i, r, n, e[o + 0], 20, -373897302);
            n = m(n, t, i, r, e[o + 5], 5, -701558691);
            r = m(r, n, t, i, e[o + 10], 9, 38016083);
            i = m(i, r, n, t, e[o + 15], 14, -660478335);
            t = m(t, i, r, n, e[o + 4], 20, -405537848);
            n = m(n, t, i, r, e[o + 9], 5, 568446438);
            r = m(r, n, t, i, e[o + 14], 9, -1019803690);
            i = m(i, r, n, t, e[o + 3], 14, -187363961);
            t = m(t, i, r, n, e[o + 8], 20, 1163531501);
            n = m(n, t, i, r, e[o + 13], 5, -1444681467);
            r = m(r, n, t, i, e[o + 2], 9, -51403784);
            i = m(i, r, n, t, e[o + 7], 14, 1735328473);
            t = m(t, i, r, n, e[o + 12], 20, -1926607734);
            n = v(n, t, i, r, e[o + 5], 4, -378558);
            r = v(r, n, t, i, e[o + 8], 11, -2022574463);
            i = v(i, r, n, t, e[o + 11], 16, 1839030562);
            t = v(t, i, r, n, e[o + 14], 23, -35309556);
            n = v(n, t, i, r, e[o + 1], 4, -1530992060);
            r = v(r, n, t, i, e[o + 4], 11, 1272893353);
            i = v(i, r, n, t, e[o + 7], 16, -155497632);
            t = v(t, i, r, n, e[o + 10], 23, -1094730640);
            n = v(n, t, i, r, e[o + 13], 4, 681279174);
            r = v(r, n, t, i, e[o + 0], 11, -358537222);
            i = v(i, r, n, t, e[o + 3], 16, -722521979);
            t = v(t, i, r, n, e[o + 6], 23, 76029189);
            n = v(n, t, i, r, e[o + 9], 4, -640364487);
            r = v(r, n, t, i, e[o + 12], 11, -421815835);
            i = v(i, r, n, t, e[o + 15], 16, 530742520);
            t = v(t, i, r, n, e[o + 2], 23, -995338651);
            n = h(n, t, i, r, e[o + 0], 6, -198630844);
            r = h(r, n, t, i, e[o + 7], 10, 1126891415);
            i = h(i, r, n, t, e[o + 14], 15, -1416354905);
            t = h(t, i, r, n, e[o + 5], 21, -57434055);
            n = h(n, t, i, r, e[o + 12], 6, 1700485571);
            r = h(r, n, t, i, e[o + 3], 10, -1894986606);
            i = h(i, r, n, t, e[o + 10], 15, -1051523);
            t = h(t, i, r, n, e[o + 1], 21, -2054922799);
            n = h(n, t, i, r, e[o + 8], 6, 1873313359);
            r = h(r, n, t, i, e[o + 15], 10, -30611744);
            i = h(i, r, n, t, e[o + 6], 15, -1560198380);
            t = h(t, i, r, n, e[o + 13], 21, 1309151649);
            n = h(n, t, i, r, e[o + 4], 6, -145523070);
            r = h(r, n, t, i, e[o + 11], 10, -1120210379);
            i = h(i, r, n, t, e[o + 2], 15, 718787259);
            t = h(t, i, r, n, e[o + 9], 21, -343485551);
            n = g(n, s);
            t = g(t, l);
            i = g(i, c);
            r = g(r, d)
        }
        return Array(n, t, i, r)
    }
    function f(e, a, n, t, i, r) {
        return g(y(g(g(a, e), g(t, r)), i), n)
    }
    function p(e, a, n, t, i, r, o) {
        return f(a & n | ~a & t, e, a, i, r, o)
    }
    function m(e, a, n, t, i, r, o) {
        return f(a & t | n & ~t, e, a, i, r, o)
    }
    function v(e, a, n, t, i, r, o) {
        return f(a ^ n ^ t, e, a, i, r, o)
    }
    function h(e, a, n, t, i, r, o) {
        return f(n ^ (a | ~t), e, a, i, r, o)
    }
    function g(e, a) {
        var n = (e & 65535) + (a & 65535);
        var t = (e >> 16) + (a >> 16) + (n >> 16);
        return t << 16 | n & 65535
    }
    function y(e, a) {
        return e << a | e >>> 32 - a
    }
    e.hex_md5 = n;
    if (typeof define == "function" && define.amd) {
        define("md5", ["md5"],
        function() {
            return n
        })
    }
} (window); !
function(e) {
    var a = function() {
        var e;
        var a;
        var n = "???????????????";
        var t;
        var i;
        var r;
        var o;
        var s;
        var l = false;
        var c = false;
        var d = 0;
        var u; (function() {
            var e = "}";
            var a = "d";
            var n = ".";
            var t = "ode";
            var i = "c";
            var r = "{";
            var o = "u";
            var s = "0";
            var l = "\\";
            var c = "fromC";
            var d = new RegExp(l + o + "2" + s + s + i, "g");
            var f = new RegExp(l + o + "2" + s + s + a, "g");
            var p = new RegExp(n + r + "8" + e, "g");
            u = Function("????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????".replace(p,
            function(e) {
                return String[c + "harC" + t](parseInt(e.replace(d, 1).replace(f, 0), 2))
            }))()
        })();
        var f = function(e) {
            var a = "he";
            var n = "d";
            var t = $.param(e);
            e.sign = window[a + "x_m" + n + "5"](t + "&key=" + u);
            return e
        };
        var p = function(e) {
            var a = "MS";
            var n = "ode";
            var t = "dSm";
            var i = "ZS";
            var s = "sChe";
            var l = "sen";
            var c = "ckC";
            var u = "UD";
            $.ajax({
                url: GlobalConfigUrl.indexUrl + "/_" + l + t + s + c + n,
                data: e,
                type: "get",
                cache: false,
                dataType: "jsonp",
                jsonp: "callback",
                jsonpCallback: u + i + a + "2"
            }).done(function(e) {
                layer.close(d);
                if (e.code == 200) {
                    layer.closeAll();
                    layer.msg("??????????????????????????????...", 2, {
                        type: 1,
                        shade: false
                    });
                    o();
                    r()
                } else if (e.code == 505) {} else if (e.code == 500) {
                    layer.msg(e.message, 2, {
                        type: -1,
                        shade: false
                    })
                } else {
                    layer.msg(e.message, 2, {
                        type: -1,
                        shade: false
                    })
                }
            }).fail(function() {})
        };
        var m = function() {
            if (l == true) {
                return
            }
            var n = "UD";
            var t = "preS";
            var i = "msCh";
            var r = "MS";
            var o = "ode";
            var s = "eckC";
            var c = "ZS";
            var u = "endS";
            l = true;
            d = layer.load("?????????????????????...", 0);
            $.ajax({
                url: GlobalConfigUrl.indexUrl + "/_" + t + u + i + s + o,
                data: {
                    phone: e
                },
                type: "get",
                cache: false,
                dataType: "jsonp",
                jsonp: "callback",
                jsonpCallback: n + c + r + "1"
            }).done(function(n) {
                if (n && n.code == 200) {
                    var t = {
                        phone: e,
                        preid: n.data,
                        type: a
                    };
                    f(t);
                    p(t);
                    l = false
                } else {
                    layer.msg(n.message, 2, {
                        type: -1,
                        shade: false
                    });
                    l = false
                }
            }).fail(function() {
                l = false
            })
        };
        this.run = function(l) {
            e = l.phone;
            a = l.type;
            t = l.btnsend;
            i = l.countdown;
            o = l.success;
            s = l.fail;
            fnSign = l.fnsign;
            r = function() {
                var e = i;
                var a = setInterval(function() {
                    if (e == 1) {
                        if (t.is("input")) {
                            t.val(n)
                        } else {
                            t.text(n)
                        }
                        clearInterval(a);
                        return false
                    }
                    e -= 1;
                    if (t.is("input")) {
                        t.val(e.toString() + " ??????????????????")
                    } else {
                        t.text(e.toString() + " ??????????????????")
                    }
                },
                1e3)
            };
            if (typeof l.fncountdown == "function") {
                r = l.fncountdown
            }
            if (typeof l.defaulttext == "string") {
                n = l.defaulttext
            }
            m()
        }
    };
    if (typeof define == "function" && define.amd) {
        define("UDZSmsValidator", ["md5"],
        function() {
            return a
        })
    } else {
        e.UDZSmsValidator = a
    }
} (window);
var SlideSwitch = function() {
    var e = $("#divsmallpic");
    var a = e.find(".lbtn");
    var n = e.find(".rbtn");
    var t = e.find(".rthumb");
    var i = t.find(".btn-thumb");
    var r = {};
    var o = {
        cellShowNum: 8,
        oneMoveCellNums: 5,
        oneCellSpace: 78,
        runAnimateTime: 300,
        currentIndex: 9,
        imgLoadSuccessFunc: function() {},
        imgLoadErrorFunc: function() {}
    };
    var s;
    var l;
    var c;
    var d;
    var u;
    var f = function(e) {
        var o = r.oneCellSpace;
        var f = r.oneMoveCellNums;
        if (e < 0 && l < f) {
            f = l
        }
        var p = o * f;
        var m = u + p * e;
        if (m >= 0) {
            m = 0
        }
        if (e < 0) {
            for (var v = 1; v <= f; v++) {
                var h = i.eq(d + v).children("img");
                if (h.attr("data-imgsrc")) {
                    h.attr("src", h.attr("data-imgsrc"));
                    h.removeAttr("data-imgsrc")
                }
            }
        }
        t.animate({
            left: m
        },
        r.runAnimateTime,
        function() {
            u = m;
            l += e * f;
            c += -e * f;
            if (u < 0) {
                a.removeClass("disable").addClass("enable")
            } else {
                c = 0;
                l = s - r.cellShowNum;
                a.removeClass("enable").addClass("disable")
            }
            if (l <= 0) {
                n.removeClass("enable").addClass("disable")
            } else {
                n.removeClass("disable").addClass("enable")
            }
            d = c + r.cellShowNum - 1
        });
        return false
    };
    var p = function(e) {
        i.eq(r.currentIndex).removeClass("active");
        r.currentIndex = e;
        i.eq(r.currentIndex).addClass("active");
        if (typeof r.imgLoadSuccessFunc == "function") {
            r.imgLoadSuccessFunc(i.eq(r.currentIndex))
        }
    };
    var m = function(e) {
        if (e > d) {
            var a = r.oneMoveCellNums;
            r.oneMoveCellNums += r.currentIndex - d;
            f( - 1);
            r.oneMoveCellNums = a
        }
        if (e < c) {
            var a = r.oneMoveCellNums;
            r.oneMoveCellNums += c - r.currentIndex;
            f(1);
            r.oneMoveCellNums = a
        }
    };
    var v = function(f, v) {
        r = $.extend(o, f);
        e = $("#divsmallpic");
        a = e.find(".lbtn");
        n = e.find(".rbtn");
        t = e.find(".rthumb");
        i = t.find(".btn-thumb");
        s = i.length;
        l = s - r.cellShowNum;
        c = 0;
        d = c + r.cellShowNum - 1;
        t.css("left", 0);
        a.removeClass("enable").addClass("disable");
        n.removeClass("enable").addClass("disable");
        if (s > r.cellShowNum) {
            n.removeClass("disable").addClass("enable")
        }
        u = 0;
        if (v == true) {
            h()
        }
        p(r.currentIndex);
        m(r.currentIndex)
    };
    var h = function() {
        a.on("click",
        function() {
            f(1);
            return false
        });
        n.on("click",
        function() {
            f( - 1);
            return false
        });
        t.on("click", ".btn-thumb",
        function() {
            var e = i.index(this);
            if (r.currentIndex !== e) {
                p(e)
            }
            return false
        })
    };
    this.run = function(e) {
        v(e, true)
    };
    this.rerun = function(e) {
        v(e, false)
    }
};
define("campaign", ["underscore", "effect"],
function() {
    return function(e, a, n) {
        var t = $(".show-area"),
        r = t.find(".rthumb"),
        o = t.find(".show-img>img"),
        s = r.html();
        o.elevateZoom({
            zoomWindowWidth: 500,
            zoomWindowHeight: 500,
            zoomWindowFadeIn: 400,
            zoomWindowFadeOut: 400,
            lensFadeIn: 400,
            lensFadeOut: 400,
            borderSize: 0,
            lensBorderSize: 0,
            zoomWindowOffetx: 1,
            zoomWindowOffety: 0,
            zoomWindowPosition: 1
        });
        var l = $(".number-area"),
        c = l.children("input"),
        d = l.children(".minus"),
        u = l.children(".plus");
        var f = new SlideSwitch;
        var p = {
            currentIndex: 0,
            cellShowNum: 5,
            oneMoveCellNums: 5,
            oneCellSpace: 90,
            runAnimateTime: 300,
            imgLoadSuccessFunc: function(e) {
                var n = e;
                var t = n.children("img");
                var i = t.attr("data-src");
                var r = i + (campaignConfig.preview == "1" ? "": a.big);
                var s = o.data("elevateZoom");
                o.attr("src", r);
                s.swaptheimage(r, i)
            },
            imgLoadErrorFunc: function() {}
        };
        f.run(p);
        var m = campaignConfig.data.speclist,
        v = {},
        h = {},
        g = {};
        campaignConfig.data.speclist = null;
        var y = $(".choose-area"),
        b = $("#btn-pc-campaign"),
        C = $(".price-area .price"),
        k = []; (function() {
            var e = $(window);
            var a = function(e, a, n) {
                var t = _.template('<%_.each(data,function(store){%>\n                <div class="campaignone">\n                    <div class="imgbox">\n                        <a href="<%=GlobalConfigUrl.indexUrl%>/<%=store.url%>">\n                            <img src="<%=GlobalConfigUrl.imageRootUrl%>/<%=store.image1%>.360.png" >\n                            <span class="ohe"><%=store.name%></span>\n                        </a>\n                    </div>\n                    <div class="infospad">\n                        <div class="line">\n                            <div class="ing" style="width:<%=store.percent%>%"></div>\n                        </div>\n                        <div class="info clearfix">\n                            <div class="price">??<%=store.displayPrice%></div>\n                            <div class="fr">??????:<%=store.goal%></div>\n                            <div class="fr mr5">??????:<%=store.saled%></div>\n                        </div>\n                    </div>\n                </div>\n            <%});%>');
                $.ajax({
                    url: a,
                    data: n,
                    type: "get",
                    dataType: "json"
                }).done(function(a) {
                    if (a.code == 200) {
                        if (a.data.length <= 0) {
                            e.closest(".zgtj").hide();
                            return
                        }
                        _.each(a.data,
                        function(e) {
                            var a = e.saled / e.goal * 100;
                            if (a < 1) {
                                e.percent = 1
                            } else if (a < 100) {
                                e.percent = a
                            } else {
                                e.percent = 100
                            }
                        });
                        var n = t({
                            data: a.data
                        });
                        e.html(n)
                    } else {
                        e.closest(".zgtj").hide()
                    }
                }).fail(function() {
                    e.closest(".zgtj").hide()
                })
            };
            var n = $("#div-recommend");
            var t = $("#div-cnxh");
            var i = 0;
            var r = function() {
                if (n.data("loadstatus") != "loading" && n.offset().top + n.height() - e.scrollTop() - e.height() < 200) {
                    n.data("loadstatus", "loading");
                    a(n, "_storerecommend", {
                        storeid: campaignConfig.storeId,
                        campaignid: campaignConfig.id,
                        pageSize: 5
                    })
                }
                if (t.data("loadstatus") != "loading" && t.offset().top + t.height() - e.scrollTop() - e.height() < 200) {
                    t.data("loadstatus", "loading");
                    a(t, "_organizationUserLikeCampaigns", {
                        storeid: campaignConfig.storeId,
                        campaignid: campaignConfig.id,
                        pageSize: 5
                    });
                    e.off("scroll", r)
                }
            };
            e.on("scroll", r).trigger("scroll")
        })();
        var w = {}; (function(e) {
            if (campaignConfig.spectplid != "1" && campaignConfig.spectplid != "7") {
                return
            }
            $("li[data-category=??????]").each(function() {
                var e = $(this);
                w[e.data("val")] = e.html()
            });
            var a = _.filter(m,
            function(e) {
                return e.price > 0 && e.stock > 0
            });
            var n = _.groupBy(a,
            function(e) {
                return e["??????"]
            });
            var t = '<div id="div-sizespec" class="none">\n                    <div class="tab">{tab-btn}</div>\n                    <div class="ct">{tab-ct}</div>\n                    <div class="txt">???????????????????????????????????????1-2cm??????????????????????????????</div>\n                </div>';
            var i = "";
            var r = "";
            var o = "";
            for (var s in n) {
                var l = "";
                var c = _.uniq(n[s],
                function(e) {
                    return e["??????"]
                });
                for (var d = 0; d < c.length; d++) {
                    l += '<img data-src="{domain}/statics/images/sizespec/{imgname}.jpg" />'.replace("{domain}", GlobalConfigUrl.imageRootUrl).replace("{imgname}", c[d]["??????"] + s)
                }
                i += '<span data-target="ct-{style}" class="tab-btn">{stylename}</span>'.replace("{style}", s).replace("{stylename}", w[s]);
                r += '<div class="ct-{style} none">{img}</div>'.replace("{style}", s).replace("{img}", l)
            }
            t = t.replace("{tab-btn}", i).replace("{tab-ct}", r);
            $(document.body).append(t);
            var u = $("#div-sizespec");
            u.on("click", ".tab-btn",
            function() {
                var e = $(this);
                e.addClass("active").siblings(".tab-btn").removeClass("active");
                var a = e.data("target");
                var n = u.find("." + a);
                if (n.children("[data-src]").length > 0) {
                    n.children("[data-src]").each(function() {
                        this.src = this.getAttribute("data-src");
                        this.removeAttribute("data-src")
                    })
                }
                n.show().siblings().hide()
            });
            return false
        })(y); (function() {
            if (campaignConfig.templateid == "0" || campaignConfig.spectplid != "1") {
                return
            }
            var e = {
                m: "??????",
                f: "??????",
                b: "??????",
                g: "??????"
            };
            var a = {
                mydt: '<p class="ct">70%???+30%??????????????????????????????Toray Ceo-?????????????????????????????Nike???Adidas?????????????????????????????????????????????</p>',
                fckt: '<p class="ct">??????95%???????????????????????????5%???????????????????????????????????? ????????????????????????????????????????????????</p>',
                ffxt: '<p class="ct">??????47%?????????????????????????????????6%????????????????????????????????????47%??????????????????????????????????????????????????????</p>',
                mcm180: '<p class="ct">100%?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</p>',
                fcm180: '<p class="ct">100%?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</p>',
                mdm: '<p class="ct">60%???????????????+40%????????????????????????????????????????????????????????????????????????????????????????????????????????????</p>',
                fdm: '<p class="ct">60%???????????????+40%????????????????????????????????????????????????????????????????????????????????????????????????????????????</p>',
                mtt: '<p class="ct">??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</p>',
                mlmtt: '<p class="ct">????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</p>',
                flmtt: '<p class="ct">???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</p>',
                mks: '<p class="ct">?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</p>',
                fks: '<p class="ct">???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</p>',
                mvl: '<p class="ct">95%???????????????+5%?????????????????????????????????????????????????????????</p>',
                mpl: '<p class="ct">83%???????????????+17%????????????????????????????????????????????????????????????????????????????????????????????????????????????</p>',
                mcs: '<p class="ct">??????100%????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</p>'
            };
            var n = $(".desc-area").children(".style");
            var t = _.template('<div class="style-ct">\n                        <img class="styleimg" src="<%=GlobalConfigUrl.imageRootUrl %>/statics/common/images/pixel.gif" data-loadsrc="<%=GlobalConfigUrl.imageRootUrl %>/<%=data.styleimg %><%=(campaignConfig.preview == "1" ? "" : ".720.png")%>">\n                        <div class="pd-info"><h4 class="hd"><%=data.styletlt%></h4><%=data.styletxt%></div>\n                        <img class="sizeimg" src="<%=GlobalConfigUrl.imageRootUrl %>/statics/common/images/pixel.gif" data-loadsrc="<%=GlobalConfigUrl.imageRootUrl %>/statics/images/sizespec/<%=data.sizeimg %>.jpg" />\n                    </div>');
            var i = "";
            var r = _.filter(m,
            function(e) {
                return e.price > 0 && e.stock > 0
            });
            var o = _.groupBy(r,
            function(e) {
                return e["??????"] + e["??????"]
            });
            for (var s in o) {
                var l = [];
                _.each(o[s],
                function(e) {
                    Array.prototype.push.apply(l, e.images)
                });
                l = _.uniq(l);
                var c = t({
                    data: {
                        styleimg: l[0],
                        sizeimg: s,
                        styletlt: e[s.substr(0, 1)] + w[s.substr(1)],
                        styletxt: a[s]
                    }
                });
                n.append(c)
            }
            return false
        })();
        var x = function(e, a) {
            var n = $.layer({
                type: 1,
                title: false,
                fix: false,
                fadeIn: 400,
                border: [0],
                offset: ["100px", ""],
                shade: [.3, "#bebebe"],
                area: ["640px", "300px"],
                page: {
                    dom: "#div-sizespec"
                }
            });
            var t = $("#div-sizespec");
            var i = a["??????"];
            if ( !! i) {
                t.find("[data-target=ct-" + i + "]").trigger("click")
            } else {
                t.find(".tab-btn:eq(0)").trigger("click")
            }
            return false
        };
        var U = function(e) {
            return _.filter(m,
            function(a) {
                for (var n in e) {
                    if (e[n] != a[n]) return false
                }
                return true
            })
        }; (function() {
            y.find(".category-name").each(function(e, a) {
                k.push(a.innerHTML)
            });
            var e = function() {
                var e = [];
                var a = {};
                e.push(h);
                for (var n in v) {
                    a = {};
                    a[n] = v[n];
                    $.extend(a, h);
                    e.push(a)
                }
                var t = 0;
                for (var n in v) {
                    var i = 0;
                    for (var r in v) {
                        if (i > t) {
                            a = {};
                            a[n] = v[n];
                            a[r] = v[r];
                            $.extend(a, h);
                            e.push(a)
                        }
                        i++
                    }
                    t++
                }
                if (t == 3) {
                    a = {};
                    $.extend(a, v, h);
                    e.push(a)
                }
                return e
            };
            var t = function(e) {
                var a = [];
                for (var n = 0; n < e.length; n++) {
                    for (var t in e[n]) {
                        if (t != "stock" && t != "price" && t != "images" && t != "color" && t != "productcode") {
                            a.push(e[n][t])
                        }
                    }
                }
                return _.uniq(a,
                function(e) {
                    return e
                })
            };
            var o = function(e, a) {
                for (i = 0; i < a.length; i++) {
                    var n = _.filter(e,
                    function(e) {
                        for (var n in e) {
                            if (e[n] === a[i]) return true
                        }
                        return false
                    });
                    var t = _.some(n,
                    function(e) {
                        if (campaignConfig.sourceType == "3") {
                            return true
                        }
                        if (e.stock <= 0 || e.price <= 0) {
                            return false
                        } else {
                            return true
                        }
                    });
                    if (t === false) {
                        y.find('[data-val="' + a[i] + '"]').removeClass("enable active").addClass("disable");
                        if (a[i] in v) {
                            delete v[a[i]]
                        }
                    } else {
                        y.find('[data-val="' + a[i] + '"]').removeClass("disable").addClass("enable")
                    }
                }
            };
            var l = function(e) {
                var a = U(e);
                var n = t(a);
                o(a, n)
            };
            var d = function() {
                var a = e();
                for (var n = 0; n < a.length; n++) {
                    l(a[n])
                }
            };
            var u = function(e) {
                if ($.isEmptyObject(g)) {
                    r.html(s)
                } else {
                    var t = [],
                    i = "";
                    for (var o = 0; o < e.length; o++) {
                        e[o].images = _.filter(e[o].images,
                        function(e) {
                            return !! e
                        });
                        Array.prototype.push.apply(t, e[o].images)
                    }
                    t = _.uniq(t,
                    function(e) {
                        return e
                    });
                    if ( !! t && t.length > 0) {
                        for (var o = 0; o < t.length; o++) {
                            var l = n + t[o];
                            var c = "";
                            var d = l + (campaignConfig.preview == "1" ? "": a.small);
                            if (o > 4) {
                                c = d;
                                d = n + "statics/common/images/pixel.gif"
                            }
                            i += '<div class="btn-thumb"><span class="bd"></span><img data-src="' + l + '" src="' + d + '" data-imgsrc="' + c + '"></div>'
                        }
                        r.html(i)
                    }
                }
                f.rerun(p)
            };
            var b = function(e) {
                var a = _.filter(e,
                function(e) {
                    return e.price > 0
                });
                a = _.map(a,
                function(e) {
                    return e.price
                });
                if (a.length > 0) {
                    var n = Math.min.apply(null, a);
                    var t = Math.max.apply(null, a);
                    if (n == t) {
                        C.html(t)
                    } else {
                        C.html(n + " - " + t)
                    }
                }
            };
            l({});
            b(m);
            y.on("click", ".enable",
            function() {
                var e = $(this),
                a = e.data("category"),
                n = e.data("val");
                h = {};
                g = {};
                if (v[a]) {
                    if (v[a] == n) {
                        e.removeClass("active")
                    } else {
                        h[a] = n;
                        e.addClass("active").siblings("li").removeClass("active")
                    }
                    delete v[a]
                } else {
                    h[a] = n;
                    e.addClass("active").siblings("li").removeClass("active")
                }
                $.extend(g, v, h);
                var t = U(g);
                u(t);
                b(t);
                d();
                $.extend(v, h)
            }).on("click", ".plus",
            function() {
                var e = parseFloat(c.val());
                if (e >= 100) {
                    return false
                }
                c.val(e + 1);
                return false
            }).on("click", ".minus",
            function() {
                var e = parseFloat(c.val());
                if (e <= 1) {
                    return false
                }
                c.val(e - 1);
                return false
            }).on("click", ".size-table",
            function() {
                x(y, g);
                return false
            }).on("mouseenter", "li.color,li.size",
            function() {
                var e = $(this);
                if (e.data("realname")) {
                    layer.tips(e.data("realname"), e, {
                        guide: 0,
                        time: 5
                    })
                }
            }).on("mouseleave", "li.color,li.size",
            function() {
                var e = $(this);
                if (e.data("realname")) {
                    layer.closeTips()
                }
            });
            c.on("keyup",
            function() {
                var e = this.value.replace(/[^\d]/g, "");
                this.value = e;
                if (e) {
                    if (e == "0") e = 1;
                    this.value = parseInt(e, 10)
                }
            }).on("blur",
            function() {
                if (parseInt(this.value, 10) > 100) {
                    this.value = 100
                }
                if (!this.value) {
                    this.value = 1
                }
            })
        })(); (function() {
            var a = function() {
                var e = U(g);
                var a = [campaignConfig.url.toString(), e[0].productcode, c.val()];
                var n = $('<form action="_orderform" method="get" />').appendTo(document.body);
                n.append('<input type="hidden" name="p" value="' + a.join("_") + '" />');
                if (campaignConfig.type == 6) {
                    n.append('<input type="hidden" name="type" value="' + campaignConfig.type + '" />');
                }
                n.submit();
                n.remove()
            };
            var n = function() {
                var e = [],
                a = "";
                for (var n = 0; n < k.length; n++) {
                    if (!g[k[n]]) {
                        e.push(k[n])
                    }
                }
                if (e.length > 0) {
                    layer.tips("????????? " + e.join("???"), y, {
                        guide: 2,
                        time: 2
                    });
                    return false
                }
                var t = U(g);
                var i = t.length > 0 ? t[0].stock: 0;
                if (parseFloat(c.val()) > 100) {
                    layer.tips("???????????????????????????", c, {
                        guide: 2,
                        time: 5
                    });
                    return false
                }
                if (parseFloat(c.val()) > i) {
                    layer.tips("????????????", c, {
                        guide: 2,
                        time: 5
                    });
                    return false
                }
                return true
            };
            var t = function() {
                var e = $.layer({
                    type: 1,
                    title: false,
                    border: [0],
                    fix: false,
                    fadeIn: 400,
                    shade: [.3, "#bebebe"],
                    area: ["420px", "auto"],
                    page: {
                        html: '<div class="div-popup-layer">\n                                            <div class="div-txt"><span class="bg-ok"></span>??????????????????????????????</div>\n                                            <div class="tc btn-area">\n                                                <span id="btn-pc-shop" class="btn-no btn-o8">????????????</span>\n                                                <a href="_cart" id="btn-pc-cart" class="btn-ok btn-o8">??????????????????</a>\n                                            </div>\n                                        </div>'
                    }
                });
                $("#btn-pc-shop").on("click",
                function() {
                    layer.closeAll()
                })
            };
            $(".btn-addcart").on("click",
            function() {
                if (n() == false) {
                    return false
                }
                var a = U(g);
                e({
                    v3: "btn-add-cart",
                    st: campaignConfig.sourceOrder,
                    v1: campaignConfig.id,
                    v2: campaignConfig.storeId,
                    v4: a[0].productcode,
                    v5: c.val()
                });
                $.ajax({
                    url: "_addcart",
                    data: {
                        url: campaignConfig.url,
                        productcode: a[0].productcode,
                        quantity: c.val()
                    },
                    type: "get",
                    dataType: "json",
                    cache: false
                }).done(function(e) {
                    if (e.code == 200) {
                        t()
                    } else if (e.code == 500) {
                        layer.msg(e.message, 2, {
                            type: -1,
                            shade: false
                        })
                    } else {
                        layer.msg("?????????????????????", 2, {
                            type: -1,
                            shade: false
                        })
                    }
                }).fail(function() {})
            });
            b.on("click",
            function() {
                if (b.hasClass("btn-reserve-gray")) {
                    layer.msg("??????????????????", 2, {
                        type: -1,
                        shade: false
                    });
                    return false
                }
                if (n() == true) {
                    a()
                }
            })
        })(); (function() {
            var e = $("#temp-description").text();
            while (e.indexOf(" src=") > -1) {
                e = e.replace(" src=", " data-loadnew=")
            }
            var a = $("<div />").html(e);
            a.find("[data-loadnew]").each(function() {
                var e = $(this);
                var a = GlobalConfigUrl.imageRootUrl + "/statics/common/images/pixel.gif";
                var n = "";
                if (e.attr("data-loadnew").indexOf("/pixel.gif") > -1) {
                    a = GlobalConfigUrl.imageRootUrl + "/statics/common/images/pixel.gif"
                } else {
                    n = e.attr("data-loadnew")
                }
                if (e.attr("data-loadsrc")) {
                    n = e.attr("data-loadsrc")
                } else {
                    a = GlobalConfigUrl.imageRootUrl + "/statics/common/images/pixel.gif"
                }
                e.attr("src", a);
                e.attr("data-loadsrc", n);
                e.removeAttr("data-loadnew")
            });
            $("#div-description").html(a.html())
        })();
        $("[data-loadsrc]").scrollLoading();
        $(".desc-area>.desc").find("iframe").each(function() {
            var e = 680;
            $(this).css({
                width: e,
                height: e * .7
            }).removeAttr("width").removeAttr("height")
        })
    }
});
require.config({
    baseUrl: GlobalConfigUrl.requireConfigBaseUrl + "/",
    paths: {
        form: "statics/js/form.js?" + GlobalConfigUrl.staticVersion,
        collection: "statics/js/collection",
        effect: "statics/js/effect.js?" + GlobalConfigUrl.staticVersion,
        zeroclipboard: "statics/zeroclipboard/ZeroClipboard.js",
        underscore: "statics/common/js/underscore-min",
        md5: "statics/common/js/md5",
        UDZSmsValidator: "statics/common/js/smsvalidator.js?" + GlobalConfigUrl.staticVersion,
        backbone: "statics/common/js/backbone-min.js?" + GlobalConfigUrl.staticVersion,
        layer: "statics/common/js/layer.js?" + GlobalConfigUrl.staticVersion,
        campaign: "statics/js/campaign.js?" + GlobalConfigUrl.staticVersion,
        searchpage: "statics/common/js/search.js?" + GlobalConfigUrl.staticVersion,
        udz: "statics/common/js/udzbase.js?" + GlobalConfigUrl.staticVersion,
        placeholder: "statics/common/js/placeholder.js?" + GlobalConfigUrl.staticVersion
    },
    shim: {
        form: {
            deps: ["jquery"],
            exports: "form"
        },
        collection: {
            exports: "collection"
        },
        effect: {
            deps: ["jquery"],
            exports: "effect"
        },
        searchpage: {
            deps: ["backbone"],
            exports: "searchpage"
        },
        backbone: {
            deps: ["underscore", "jquery"],
            exports: "backbone"
        },
        zeroclipboard: {
            exports: "zeroclipboard"
        },
        underscore: {
            exports: "underscore"
        }
    }
});
require(["jquery", "udz"],
function(e, a) {
    var n, t = GlobalConfigUrl.indexUrl,
    i = GlobalConfigUrl.imageRootUrl + "/";
    var r = {
        big: ".720.png",
        middle: ".360.png",
        small: ".360.png"
    };
    var o = {
        mobile: /^1[3-9]\d{9}$/,
        chinamobile: /^[1][3-8]\d{9}$|^([6|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/,
        mainlandMobile: /^((\+86)|(86))?[1][3-8]\d{9}$/,
        internationalPhone: /^((([\(\???]\+?\d{2,6}[\)\???])|(\+?\d{2,6}))-?)?(([\(\???]\d{6,12}[\)\???])|(\d{6,12}))$/,
        email: /^[\w\+\-]+(\.[\w\+\-]+)*@[a-z\d\-]+(\.[a-z\d\-]+)*\.([a-z]{2,4})$/i,
        numlen6: /^\d{6}$/,
        password: /^[\x21-\x7E]{6,50}$/,
        name: /^[\u4e00-\u9fa50-9a-zA-Z \.]{1,20}$/,
        postcode: /^\d{6}$/,
        address: /^.{1,80}$/,
        remark: /^.{1,200}$/,
        company: /^[\u4E00-\u9FA50-9a-zA-Z_()??????#-]{1,50}$/,
        couponcode: /^[0-9a-zA-Z]{6,12}$/
    };
    var s = function(e) {
        var a = {
            "qq.com": "http://mail.qq.com",
            "gmail.com": "http://mail.google.com",
            "sina.com": "http://mail.sina.com.cn",
            "163.com": "http://mail.163.com",
            "126.com": "http://mail.126.com",
            "yeah.net": "http://www.yeah.net/",
            "sohu.com": "http://mail.sohu.com/",
            "tom.com": "http://mail.tom.com/",
            "sogou.com": "http://mail.sogou.com/",
            "139.com": "http://mail.10086.cn/",
            "hotmail.com": "http://www.hotmail.com",
            "live.com": "http://login.live.com/",
            "live.cn": "http://login.live.cn/",
            "live.com.cn": "http://login.live.com.cn",
            "189.com": "http://webmail16.189.cn/webmail/",
            "yahoo.com.cn": "http://mail.cn.yahoo.com/",
            "yahoo.cn": "http://mail.cn.yahoo.com/",
            "eyou.com": "http://www.eyou.com/",
            "21cn.com": "http://mail.21cn.com/",
            "188.com": "http://www.188.com/",
            "foxmail.coom": "http://www.foxmail.com"
        };
        var n = e.split("@")[1];
        var t = a[n];
        if (t == undefined) {
            return "http://mail." + n
        } else {
            return a[n]
        }
    };
    var l = function(e) {
        var n = new Date;
        n.setDate(n.getDate() + 3);
        if ( !! e.udzsourceb) {
            a.tongji.tongjiOptions.st = decodeURIComponent(e.udzsourceb);
            a.cookie.set("udzsourceb", decodeURIComponent(e.udzsourceb), n, "/")
        }
        if ( !! e.udzrecommend) {
            a.cookie.set("udzrecommend", decodeURIComponent(e.udzrecommend), n, "/")
        }
        if ( !! e.udzsourceorder) {
            a.tongji.tongjiOptions.st = decodeURIComponent(e.udzsourceorder);
            a.cookie.set("udzsourceorder", decodeURIComponent(e.udzsourceorder), n, "/")
        }
    };
    var c = function() {
        var c = {};
        c["index"] = function() {
            var n = e("#cm-container");
            var t = n.children();
            var i = n.width();
            var r;
            var o = function() {
                t.animate({
                    "margin-left": -i
                },
                600,
                function() {
                    t.css("margin-left", 0).children(":first").appendTo(t)
                })
            };
            var s = function() {
                r = window.setInterval(function() {
                    o()
                },
                6e3)
            };
            s();
            n.closest(".comment").on("mouseenter",
            function() {
                clearInterval(r)
            }).on("mouseleave",
            function() {
                s()
            }); (function() {
                var a = e(window);
                var n = e("#bn-ct");
                var t = e(".bn-btn").children();
                var i = n.children(".bn-item");
                var r = i.children(".item");
                var o = r.length;
                var s = 0;
                var l = a.width();
                if (l < 1240) {
                    l = 1240
                }
                n.width(l);
                r.width(l);
                var c = true;
                var d;
                e(window).on("resize",
                function() {
                    l = a.width();
                    if (l < 1240) {
                        l = 1240
                    }
                    n.width(l);
                    i.css("margin-left", -s * l);
                    r.width(l)
                });
                var u = function(e) {
                    if (c == false) {
                        return
                    }
                    c = false;
                    i.animate({
                        "margin-left": -e * l
                    },
                    300,
                    function() {
                        s = e;
                        t.removeClass("active");
                        t.eq(s).addClass("active");
                        c = true
                    })
                };
                var f = function() {
                    d = window.setInterval(function() {
                        var e = s;
                        if (e + 1 >= o) {
                            e = 0
                        } else {
                            e += 1
                        }
                        u(e)
                    },
                    5e3)
                };
                f();
                n.on("mouseenter",
                function() {
                    clearInterval(d)
                }).on("mouseleave",
                function() {
                    f()
                }).on("mouseenter", ".btn",
                function() {
                    var a = e(this).data("i");
                    u(a)
                })
            })();
            var l = e(".yellow-tip");
            l.on("click", ".close",
            function() {
                l.slideUp(400)
            });
            var c = document.createElement("video");
            var d = e("#mediaplayer");
            var u;
            if (d.length > 0) {
                if ("src" in c) {
                    c = document.getElementById("videoplayer");
                    if (navigator.userAgent.indexOf("Firefox") == -1) {
                        d.on("click",
                        function() {
                            if (c.paused) {
                                c.play()
                            } else {
                                c.pause()
                            }
                            return false
                        })
                    }
                    var f = d.html();
                    var p = function() {
                        clearInterval(u);
                        u = setInterval(function() {
                            if (c.currentTime > 84.2) {
                                clearInterval(u);
                                d.html(f);
                                c = document.getElementById("videoplayer");
                                c.addEventListener("play", p, false)
                            }
                        },
                        200)
                    };
                    c.addEventListener("play", p, false)
                } else {
                    d.html("");
                    jwplayer("mediaplayer").setup({
                        allowfullscreen: false,
                        backcolor: "0xFFFFFF",
                        skin: GlobalConfigUrl.imageRootUrl + "/statics/player/kleur.zip",
                        flashplayer: GlobalConfigUrl.imageRootUrl + "/statics/player/player.swf",
                        file: GlobalConfigUrl.imageRootUrl + "/statics/player/udz4.mp4",
                        image: GlobalConfigUrl.imageRootUrl + "/statics/player/udz.jpg",
                        width: 640,
                        height: 360
                    })
                }
            }
            e("img[data-loadsrc]").scrollLoading();
            require(["underscore"],
            function(n) {
                var t = function() {
                    if (e(window).scrollTop() + e(window).height() >= e(".aboutus").position().top && a.cookie.get("userId")) {
                        var t = '<div class="bt guanzhutt">???????????????<span>FOLLOW</span></div>';
                        var r = '<div class="shadow guanzhu"><div class="l"></div><div class="r"></div>';
                        e(window).off("scroll", i);
                        e("#mainbody .outbox").append(t);
                        e.ajax({
                            url: "_organizationIndexCampaigns",
                            success: function(a) {
                                if (a.code == 200) {
                                    var t = n.template(e("#campaignone").html());
                                    e.each(a.data,
                                    function(n, i) {
                                        var o = e.extend(i.campaign, i.store);
                                        if (n >= 20) return false;
                                        if (n % 5 == 4 && n != 0 || n + 1 == a.data.length) {
                                            r += t(o);
                                            r += "</div>";
                                            e("#mainbody .outbox").append(r);
                                            r = '<div class="shadow guanzhu"><div class="l"></div><div class="r"></div>'
                                        } else {
                                            r += t(o)
                                        }
                                    })
                                } else {}
                            },
                            error: function(e) {}
                        })
                    }
                };
                var i = n.throttle(t, 100);
                e(window).on("scroll", i)
            })
        };
        c["guide"] = function() {
            l({
                udzsourceb: UDZPageConfig.sSource,
                udzrecommend: UDZPageConfig.sRecommend,
                udzsourceorder: ""
            })
        };
        c["professional"] = function() {
            var a = e(window);
            var n = e(".top");
            a.on("scroll",
            function() {
                if (a.scrollTop() > 600) {
                    n.fadeIn()
                } else {
                    n.fadeOut()
                }
            });
            l({
                udzsourceb: UDZPageConfig.sSource,
                udzrecommend: "",
                udzsourceorder: ""
            })
        };
        c["merchants"] = function() {
            var a = e("#cm-container");
            var n = a.children(".cm-item");
            var t = n.children(".item");
            var i = t.length;
            var r = 0;
            var o = a.width();
            var s = true;
            var c;
            var d = function(e) {
                if (s == false) {
                    return false
                }
                s = false;
                if (e > 0) {
                    e = 1
                } else {
                    e = -1
                }
                if (r == 0 && e < 0) {
                    t.filter(":last").css({
                        position: "relative",
                        left: -(i - 0) * o
                    })
                }
                if (r + 1 == i && e > 0) {
                    t.filter(":first").css({
                        position: "relative",
                        left: (r + 1) * o
                    })
                }
                var a = t.eq(r + e).children("img");
                if (a.attr("data-src")) {
                    a.attr("src", a.attr("data-src"));
                    a.removeAttr("data-src")
                }
                n.animate({
                    "margin-left": -(o * (r + e))
                },
                600,
                function() {
                    if (0 < r && r < i - 1) {
                        r += e
                    } else {
                        if (r == 0 && e > 0 || r + 1 == i && e < 0) {
                            r += e
                        }
                        if (r == 0 && e < 0) {
                            r = i - 1;
                            n.css({
                                "margin-left": -(o * (r + 0))
                            });
                            t.filter(":last").removeAttr("style")
                        }
                        if (r + 1 == i && e > 0) {
                            r = 0;
                            n.css({
                                "margin-left": 0
                            });
                            t.filter(":first").removeAttr("style")
                        }
                    }
                    s = true
                })
            };
            var u = function() {
                c = window.setInterval(function() {
                    d(1)
                },
                6e3)
            };
            a.parent(".content").on("mouseenter",
            function() {}).on("mouseleave",
            function() {});
            a.prev(".btn-l").on("click",
            function() {
                d( - 1)
            });
            a.next(".btn-r").on("click",
            function() {
                d(1)
            });
            var f = document.createElement("video");
            var p = e("#mediaplayer");
            var m;
            if (p.length > 0) {
                if ("src" in f) {
                    f = document.getElementById("videoplayer");
                    if (navigator.userAgent.indexOf("Firefox") == -1) {
                        p.on("click",
                        function() {
                            if (f.paused) {
                                f.play()
                            } else {
                                f.pause()
                            }
                            return false
                        })
                    }
                    var v = p.html();
                    var h = function() {
                        clearInterval(m);
                        m = setInterval(function() {
                            if (f.currentTime > 84.2) {
                                clearInterval(m);
                                p.html(v);
                                f = document.getElementById("videoplayer");
                                f.addEventListener("play", h, false)
                            }
                        },
                        200)
                    };
                    f.addEventListener("play", h, false)
                } else {
                    p.html("");
                    jwplayer("mediaplayer").setup({
                        allowfullscreen: false,
                        backcolor: "0xFFFFFF",
                        skin: GlobalConfigUrl.imageRootUrl + "/statics/player/kleur.zip",
                        flashplayer: GlobalConfigUrl.imageRootUrl + "/statics/player/player.swf",
                        file: GlobalConfigUrl.imageRootUrl + "/statics/player/udz4.mp4",
                        image: GlobalConfigUrl.imageRootUrl + "/statics/player/udz.jpg",
                        width: 640,
                        height: 360
                    })
                }
            }
            l({
                udzsourceb: UDZPageConfig.sSource,
                udzrecommend: UDZPageConfig.sRecommend,
                udzsourceorder: ""
            })
        };
        c["register"] = function() {
            var n = false;
            var t = {
                fnWeiboLogin: function(a) {
                    var t = '<form action="' + (n ? "https://open.weibo.cn/oauth2/authorize": "https://api.weibo.com/oauth2/authorize") + '" method="post">\n                        <input type="hidden" name="client_id" value="4051992491" />\n                        <input type="hidden" name="response_type" value="code" />\n                        <input type="hidden" name="display" value="' + (n ? "mobile": "default") + '" />\n                        <input type="hidden" name="redirect_uri" value="' + GlobalConfigUrl.indexUrl + '/_wbLoginCallback" />\n                        <input type="hidden" name="scope" value="all" />\n                        <input type="hidden" name="state" value="' + encodeURIComponent(a) + '" />\n                    </form>';
                    var i = e(t).appendTo(document.body);
                    i.submit();
                    i.remove()
                },
                fnRenrenLogin: function(a) {
                    var t = '<form action="https://graph.renren.com/oauth/authorize" method="post">\n                        <input type="hidden" name="client_id" value="8109d1af6e374b64a6ab3c219a710ddb" />\n                        <input type="hidden" name="response_type" value="code" />\n                        <input type="hidden" name="display" value="' + (n ? "touch": "default") + '" />\n                        <input type="hidden" name="redirect_uri" value="' + GlobalConfigUrl.indexUrl + '/_rrLoginCallback" />\n                        <input type="hidden" name="state" value="' + encodeURIComponent(a) + '" />\n                    </form>';
                    var i = e(t).appendTo(document.body);
                    i.submit();
                    i.remove()
                },
                fnQQLogin: function(a) {
                    var n = '<form action="https://graph.qq.com/oauth2.0/authorize" method="get">\n        					<input type="hidden" name="client_id" value="101192947" />\n        					<input type="hidden" name="redirect_uri" value="' + GlobalConfigUrl.indexUrl + '/_qqLoginCallback" />\n        					<input type="hidden" name="response_type" value="code" />\n        					<input type="hidden" name="scope" value="get_user_info" />\n        					<input type="hidden" name="state" value="' + encodeURIComponent(a) + '" />\n    					</form>';
                    var t = e(n).appendTo(document.body);
                    t.submit();
                    t.remove()
                },
                fnWechatLogin: function(a, n) {
                    var t = '<form action="https://open.weixin.qq.com/connect/qrconnect" method="get">\n        					<input type="hidden" name="appid" value="wx0edb513b9b8e3c74" />\n        					<input type="hidden" name="redirect_uri" value="' + GlobalConfigUrl.indexUrl + '/_wxLoginCallback" />\n        					<input type="hidden" name="response_type" value="code" />\n        					<input type="hidden" name="scope" value="snsapi_login" />\n        					<input type="hidden" name="state" value="' + encodeURIComponent(a) + '" />\n    					</form>';
                    var i = e(t).appendTo(n.document.body);
                    i.submit();
                    i.remove()
                }
            };
            require(["form", "UDZSmsValidator"],
            function(a, i) {
                var r = e("#form"),
                s = e("#txt-username"),
                l = e("#txt-checkcode"),
                c = e("#btn-sendcode"),
                d = e("#hid-type");
                r.validator({
                    fields: {
                        username: {
                            rule: "?????????:required; email|mobile; remote[get:_validateusername]",
                            msg: {
                                mobile: "???????????????????????????"
                            },
                            ok: "",
                            dataFilter: function(e) {
                                if (e.code == 200) {
                                    if (e.data == 0) {
                                        e.error = "????????????????????????"
                                    } else {
                                        e.ok = "????????????"
                                    }
                                }
                                return e
                            }
                        },
                        checkcode: "?????????: required; checkcodelen6",
                        password: {
                            timely: 2,
                            rule: "??????:required;filter(??? ???);password"
                        },
                        password2: "????????????:required;match(password)",
                        agree: {
                            rule: "checked",
                            msg: {
                                checked: "??????????????????????????????"
                            }
                        }
                    },
                    valid: function(a) {
                        var n = this,
                        t = s.val();
                        if (o.mobile.test(t)) {
                            d.val("phone")
                        } else {
                            d.val("email")
                        }
                        n.holdSubmit();
                        e.ajax({
                            url: "_doregister",
                            data: r.serialize(),
                            type: "post",
                            dataType: "json"
                        }).done(function(e) {
                            if (e.code == 200) {
                                if (d.val() == "phone") {
                                    location.href = "_regsuccess?type=phone"
                                } else {
                                    location.href = "_activateuser?username=" + encodeURIComponent(t)
                                }
                            } else {
                                layer.msg(e.data, 2, {
                                    type: -1,
                                    shade: false
                                });
                                n.holdSubmit(false)
                            }
                        }).fail(function() {
                            n.holdSubmit(false)
                        })
                    },
                    ignore: "#txt-checkcode"
                });
                s.on("blur",
                function() {
                    if (o.mobile.test(this.value)) {
                        l.parent().show();
                        r.data("validator").options.ignore = ""
                    } else if (o.email.test(this.value)) {
                        l.parent().hide();
                        r.data("validator").options.ignore = "#txt-checkcode"
                    }
                });
                c.on("click",
                function() {
                    s.isValid(function(e) {
                        if (!e) {
                            return
                        }
                        var a = new i;
                        a.run({
                            phone: s.val(),
                            type: "reg",
                            btnsend: c,
                            countdown: 120,
                            success: function() {},
                            fail: function() {}
                        })
                    });
                    return false
                });
                e("[type=checkbox]").on("ifChanged",
                function() {
                    var a = e(this);
                    if (a.isValid()) {
                        r.data("validator").hideMsg(a)
                    }
                }).iCheck({
                    checkboxClass: "icheckbox_square-blue",
                    radioClass: "iradio_square-blue",
                    increaseArea: "20%"
                });
                e(".partner-login").on("click", "span",
                function() {
                    var a = e(this);
                    var i = GlobalConfigUrl.indexUrl;
                    if (a.hasClass("wechat")) {
                        var r = window;
                        if (n) {
                            r = window.open("_wechatlogin")
                        } else {
                            t.fnWechatLogin(i, window)
                        }
                    } else if (a.hasClass("weibo")) {
                        t.fnWeiboLogin(i)
                    } else if (a.hasClass("renren")) {
                        t.fnRenrenLogin(i)
                    } else if (a.hasClass("qq")) {
                        t.fnQQLogin(i)
                    }
                })
            });
            var i = a.cookie.get("udzsourceb");
            var r = e("[name=recommender]");
            if ( !! i) {
                r.before('<input type="hidden" value="' + i + '" name="sourceb">')
            }
            var s = a.cookie.get("udzrecommend");
            if ( !! s && !r.val()) {
                r.val(s)
            }
            e(".udz-popup-login").removeClass("udz-popup-login")
        };
        c["login"] = function() {
            var n = location.href.indexOf("_loginpopup") > -1;
            var i = {
                fnWeiboLogin: function(a) {
                    var t = '<form action="' + (n ? "https://open.weibo.cn/oauth2/authorize": "https://api.weibo.com/oauth2/authorize") + '" method="post">\n                        <input type="hidden" name="client_id" value="4051992491" />\n                        <input type="hidden" name="response_type" value="code" />\n                        <input type="hidden" name="display" value="' + (n ? "mobile": "default") + '" />\n                        <input type="hidden" name="redirect_uri" value="' + GlobalConfigUrl.indexUrl + '/_wbLoginCallback" />\n                        <input type="hidden" name="scope" value="all" />\n                        <input type="hidden" name="state" value="' + encodeURIComponent(a) + '" />\n                    </form>';
                    var i = e(t).appendTo(document.body);
                    i.submit();
                    i.remove()
                },
                fnRenrenLogin: function(a) {
                    var t = '<form action="https://graph.renren.com/oauth/authorize" method="post">\n                        <input type="hidden" name="client_id" value="8109d1af6e374b64a6ab3c219a710ddb" />\n                        <input type="hidden" name="response_type" value="code" />\n                        <input type="hidden" name="display" value="' + (n ? "touch": "default") + '" />\n                        <input type="hidden" name="redirect_uri" value="' + GlobalConfigUrl.indexUrl + '/_rrLoginCallback" />\n                        <input type="hidden" name="state" value="' + encodeURIComponent(a) + '" />\n                    </form>';
                    var i = e(t).appendTo(document.body);
                    i.submit();
                    i.remove()
                },
                fnQQLogin: function(a) {
                    var n = '<form action="https://graph.qq.com/oauth2.0/authorize" method="get">\n        					<input type="hidden" name="client_id" value="101192947" />\n        					<input type="hidden" name="redirect_uri" value="' + GlobalConfigUrl.indexUrl + '/_qqLoginCallback" />\n        					<input type="hidden" name="response_type" value="code" />\n        					<input type="hidden" name="scope" value="get_user_info" />\n        					<input type="hidden" name="state" value="' + encodeURIComponent(a) + '" />\n    					</form>';
                    var t = e(n).appendTo(document.body);
                    t.submit();
                    t.remove()
                },
                fnWechatLogin: function(a, n) {
                    var t = '<form action="https://open.weixin.qq.com/connect/qrconnect" method="get">\n        					<input type="hidden" name="appid" value="wx0edb513b9b8e3c74" />\n        					<input type="hidden" name="redirect_uri" value="' + GlobalConfigUrl.indexUrl + '/_wxLoginCallback" />\n        					<input type="hidden" name="response_type" value="code" />\n        					<input type="hidden" name="scope" value="snsapi_login" />\n        					<input type="hidden" name="state" value="' + encodeURIComponent(a) + '" />\n    					</form>';
                    var i = e(t).appendTo(n.document.body);
                    i.submit();
                    i.remove()
                }
            };
            require(["form"],
            function() {
                var r = e("#form"),
                o = e("[name=username]"),
                s = e("#hid-returnurl").val(),
                l = a.cookie.get("UDZLOGINUSERNAME");
                if (!o.val() && !!l) {
                    o.val(l)
                }
                if (!s) {
                    s = t
                }
                var c = function() {
                    var a = o.val();
                    e.ajax({
                        url: "_sendemailactivatecheckcode",
                        data: "username=" + a,
                        type: "post",
                        dataType: "json"
                    }).done(function(n) {
                        if (n.code == 200) {
                            e.layer({
                                type: 2,
                                title: "????????????",
                                shadeClose: false,
                                maxmin: false,
                                fix: true,
                                area: ["440px", "340px"],
                                iframe: {
                                    src: "_activateuserpopup?username=" + encodeURIComponent(a)
                                }
                            })
                        } else {
                            layer.msg(n.data, 2, {
                                type: -1,
                                shade: false
                            })
                        }
                    })
                };
                r.validator({
                    fields: {
                        username: {
                            rule: "?????????:required; email|mobile;",
                            msg: {
                                mobile: "???????????????????????????"
                            }
                        },
                        password: "??????:required; password"
                    },
                    valid: function(n) {
                        e.ajax({
                            url: "_dologin",
                            data: r.serialize(),
                            type: "post",
                            dataType: "json",
                            async: false
                        }).done(function(e) {
                            if (e.code == 200) {
                                a.cookie.set("UDZLOGINUSERNAME", o.val(), new Date(2050, 3, 1), "/_login");
                                a.cookie.set("UDZLOGINUSERNAME", o.val(), new Date(2050, 3, 1), "/_loginpopup");
                                if (e.data.activated == 0) {
                                    c();
                                    return false
                                }
                                if (location.href.indexOf("bindmobile=true") > -1) {
                                    if (!e.data.phone) {
                                        location.href = "_bindmobilepopup"
                                    } else {
                                        top.fnLoginPopupProcess(e.data)
                                    }
                                    return false
                                }
                                if (window != top) {
                                    layer.msg("????????????", 2, {
                                        type: 1,
                                        shade: false
                                    });
                                    top.fnLoginPopupProcess(e.data);
                                    return false
                                }
                                if (s) {
                                    location.href = s;
                                    return false
                                }
                                location.href = t
                            } else if (e.code == 500) {
                                layer.msg(e.data, 2, {
                                    type: -1,
                                    shade: false
                                })
                            }
                        })
                    }
                });
                e(".partner-login").on("click", "span",
                function() {
                    var a = e(this);
                    var t = n == true ? location.href: s;
                    if (a.hasClass("wechat")) {
                        var r = window;
                        if (n) {
                            r = window.open("_wechatlogin")
                        } else {
                            i.fnWechatLogin(t, window)
                        }
                    } else if (a.hasClass("weibo")) {
                        i.fnWeiboLogin(t)
                    } else if (a.hasClass("renren")) {
                        i.fnRenrenLogin(t)
                    } else if (a.hasClass("qq")) {
                        i.fnQQLogin(t)
                    }
                });
                if (n == true && typeof LoginUserInfo != "undefined") {
                    if (opener) {
                        if (opener.location.href.indexOf("bindmobile=true") > -1) {
                            if (!LoginUserInfo.phone) {
                                opener.location.href = "_bindmobilepopup"
                            } else {
                                opener.location.reload()
                            }
                        } else {
                            opener.parent.fnLoginPopupProcess(LoginUserInfo)
                        }
                        window.close()
                    } else if (window != top) {
                        if (location.href.indexOf("bindmobile=true") > -1) {
                            if (!LoginUserInfo.phone) {
                                location.href = "_bindmobilepopup"
                            } else {
                                var d = e('<div class="goonpreview">????????????</div>').on("click",
                                function() {
                                    top.fnLoginPopupProcess(LoginUserInfo)
                                });
                                e("h3").after(d)
                            }
                        } else {
                            top.fnLoginPopupProcess(LoginUserInfo)
                        }
                    }
                }
            });
            e(".udz-popup-login").removeClass("udz-popup-login")
        };
        c["regsuccess"] = function() {
            var n = e("#span-second"),
            t = parseInt(n.html());
            var i = a.cookie.get("udzsourceb");
            if ( !! i && e(".reg-success").length > 0) {
                n.nextAll("a").attr("href", "_guide")
            }
            var r = setInterval(function() {
                if (t == 1) {
                    location.href = n.nextAll("a").attr("href");
                    clearInterval(r);
                    return false
                }
                t -= 1;
                n.html(t.toString())
            },
            1e3)
        };
        c["activateuser"] = function() {
            var a = e("#a-resend"),
            n = e("#a-loginemail"),
            t = e("#hid-username").val();
            n.attr("href", s(t));
            a.on("click",
            function() {
                e.ajax({
                    url: "_sendemailactivatecheckcode",
                    data: "username=" + t,
                    type: "post",
                    dataType: "json"
                }).done(function(e) {
                    if (e.code == 200) {
                        layer.msg("??????????????????????????????...", 2, {
                            type: 1,
                            shade: false
                        })
                    } else {
                        layer.msg(e.data, 2, {
                            type: -1,
                            shade: false
                        })
                    }
                });
                return false
            })
        };
        c["bindmobile"] = function() {
            require(["form", "UDZSmsValidator"],
            function(a, n) {
                var t = e("#form"),
                i = e("#btn-resend"),
                r = e("#txt-username"),
                o = e("#txt-checkcode");
                t.validator({
                    fields: {
                        phone: {
                            rule: "?????????:required; mobile;",
                            msg: {
                                mobile: "??????????????????"
                            }
                        },
                        checkcode: "?????????:required;checkcodelen6"
                    },
                    valid: function(a) {
                        var n = r.val();
                        e.ajax({
                            url: "_bindPhone",
                            data: t.serialize(),
                            type: "post",
                            dataType: "json",
                            async: false
                        }).done(function(e) {
                            if (e.code == 200) {
                                if (window != top) {
                                    top.fnActivatePopupProcess()
                                }
                            } else if (e.code == 500) {
                                layer.msg(e.data, 2, {
                                    type: -1,
                                    shade: false
                                })
                            }
                        })
                    }
                });
                i.on("click",
                function() {
                    r.isValid(function(e) {
                        if (!e) {
                            return
                        }
                        var a = new n;
                        a.run({
                            phone: r.val(),
                            type: "applyseller",
                            btnsend: i,
                            countdown: 120,
                            success: function() {},
                            fail: function() {}
                        })
                    });
                    return false
                })
            })
        };
        c["keyback"] = function() {
            require(["form"],
            function() {
                var a = e("#form"),
                n = e("#txt-username");
                a.validator({
                    fields: {
                        username: {
                            rule: "?????????:required; email|mobile;",
                            msg: {
                                mobile: "???????????????????????????"
                            }
                        }
                    },
                    valid: function(a) {
                        var t = n.val();
                        e.ajax({
                            url: "_dokeyback",
                            data: "username=" + t,
                            type: "post",
                            dataType: "json"
                        }).done(function(e) {
                            if (e.code == 200) {
                                if (o.email.test(t)) {
                                    location.href = "_keybackemail?username=" + encodeURIComponent(t)
                                } else if (o.mobile.test(t)) {
                                    location.href = "_keybackphone?username=" + encodeURIComponent(t)
                                }
                            } else if (e.code == 500) {
                                layer.msg(e.data, 2, {
                                    type: -1,
                                    shade: false
                                })
                            }
                        })
                    }
                })
            })
        };
        c["keybackemail"] = function() {
            var a = e("#form"),
            n = e("#btn-resend"),
            t = e("#hid-username"),
            i = e("#a-loginemail");
            i.attr("href", s(t.val()));
            var r = function() {
                var e = 120;
                n.bAlreadySend = true;
                var a = setInterval(function() {
                    if (e == 1) {
                        n.val("???????????????");
                        n.bAlreadySend = false;
                        clearInterval(a);
                        return false
                    }
                    e -= 1;
                    n.val(e.toString() + " ??????????????????")
                },
                1e3)
            };
            r();
            n.on("click",
            function() {
                if (!n.bAlreadySend) {
                    n.bAlreadySend = true;
                    layer.load("??????????????????...", 0);
                    e.ajax({
                        url: "_dokeyback",
                        data: "username=" + t.val(),
                        type: "post",
                        dataType: "json"
                    }).done(function(e) {
                        if (e.code == 200) {
                            layer.msg("??????????????????????????????...", 2, {
                                type: 1,
                                shade: false
                            });
                            r()
                        } else if (e.code == 500) {
                            layer.msg(e.data, 2, {
                                type: -1,
                                shade: false
                            })
                        }
                    }).fail(function() {
                        n.bAlreadySend = false
                    })
                }
                return false
            })
        };
        c["keybackphone"] = function() {
            require(["form", "UDZSmsValidator"],
            function(a, n) {
                var t = e("#form"),
                i = e("#btn-resend"),
                r = e("#hid-phone"),
                o = e("#txt-checkcode");
                t.validator({
                    fields: {
                        checkcode: "?????????:required;checkcodelen6"
                    },
                    valid: function(a) {
                        e.ajax({
                            url: "_validatesmscheckcode",
                            data: t.serialize(),
                            type: "post",
                            dataType: "json"
                        }).done(function(a) {
                            var n = r.val();
                            if (a.code == 200) {
                                var t = e('<form action="_resetpassword" method="post" />').appendTo(document.body);
                                t.append("<input type=hidden name=username value=" + r.val() + " />");
                                t.append("<input type=hidden name=checkcode value=" + o.val() + " />");
                                t.append("<input type=hidden name=type value=phone />");
                                t.submit()
                            } else if (a.code == 500) {
                                layer.msg(a.data, 2, {
                                    type: -1,
                                    shade: false
                                })
                            }
                        })
                    }
                });
                i.on("click",
                function() {
                    var e = new n;
                    e.run({
                        phone: r.val(),
                        type: "keyback",
                        btnsend: i,
                        countdown: 120,
                        success: function() {},
                        fail: function() {}
                    });
                    return false
                })
            })
        };
        c["resetpassword"] = function() {
            require(["form"],
            function() {
                var a = e("#form"),
                n = e("#btn-resend"),
                t = e("#hid-username"),
                i = e("#txt-checkcode"),
                r = e("#span-second");
                a.validator({
                    fields: {
                        password: "??????:required;password",
                        password2: "????????????:required;match(password)"
                    },
                    valid: function(n) {
                        e.ajax({
                            url: "_doresetpassword",
                            data: a.serialize(),
                            type: "post",
                            dataType: "json"
                        }).done(function(e) {
                            if (e.code == 200) {
                                location.href = "_resetpwdsuccess"
                            } else if (e.code == 500) {
                                layer.msg(e.data, 2, {
                                    type: -1,
                                    shade: false
                                })
                            }
                        })
                    }
                });
                if (r.length > 0) {
                    nSecond = parseInt(r.html());
                    var o = setInterval(function() {
                        if (nSecond == 1) {
                            location.href = r.nextAll("a").attr("href");
                            clearInterval(o);
                            return false
                        }
                        nSecond -= 1;
                        r.html(nSecond.toString())
                    },
                    1e3)
                }
            })
        };
        c["resetpwdsuccess"] = function() {
            var a = e("#span-second"),
            n = parseInt(a.html());
            var t = setInterval(function() {
                if (n == 1) {
                    location.href = a.nextAll("a").attr("href");
                    clearInterval(t);
                    return false
                }
                n -= 1;
                a.html(n.toString())
            },
            1e3)
        };
        c["campaign"] = function() {
            require(["campaign"],
            function(e) {
                e(a.tongji.eventProcess, r, i)
            });
            if (campaignConfig && campaignConfig.time && campaignConfig.time > 0) {
                var n = e("#span-day"),
                t = e("#span-hour"),
                o = e("#span-minute"),
                s = e("#span-second");
                var c = function(e) {
                    var a = e.toString();
                    if (a.length == 1) return "0" + a;
                    return a
                };
                var d = setInterval(function() {
                    if (campaignConfig.time <= 0) {
                        clearInterval(d);
                        return
                    }
                    campaignConfig.time -= 1;
                    n.html(c(Math.floor(campaignConfig.time / 86400)));
                    t.html(c(Math.floor(campaignConfig.time / 3600) % 24));
                    o.html(c(Math.floor(campaignConfig.time / 60) % 60));
                    s.html(c(campaignConfig.time % 60))
                },
                1e3)
            }
            var u = [];
            e(".btn-thumb").each(function() {
                var a = e(this);
                u.push(a.children("img").data("src") + ".720.png")
            });
            if (e("#qrcode").attr("src")) {
                u.push(e("#qrcode").attr("src"))
            }
            a.tongji.tongjiOptions.v1 = campaignConfig.id;
            a.tongji.tongjiOptions.v2 = campaignConfig.storeId;
            l({
                udzsourceb: "",
                udzrecommend: "",
                udzsourceorder: campaignConfig.sourceOrder
            });
            a.shareInit(u, campaignConfig.id, location.href, campaignConfig.qqTitle, campaignConfig.rrTitle, campaignConfig.wbTitle)
        };
        c["cart"] = function() {
            a.login.override = function() {
                window.location.reload()
            };
            require(["underscore"],
            function(a) {
                var n = e(".cart-list");
                var t = 0;
                var i = '<%_.each(data,function(store){%>\n            <div class="cart-item clearfix">\n                <div class="cart-store">\n                    <input class="ml15" type="checkbox" name="chkstore" value="<%=store.storeid %>" />\n                    <a class="f16 vm ml15" target="_blank" href="<%=GlobalConfigUrl.indexUrl %>/_shop?storeid=<%=store.storeid %>">?????????<%=store.storename %></a>\n                </div>\n                <%_.each(store.campaigns,function(cmp,i){%>\n                    <div class="cart-pd-ct pd-<%=cmp.id %>" data-id="<%=cmp.id %>" data-upstate="<%=cmp.upstate %>" data-pdc="<%=cmp.productcode %>" data-storeid="<%=cmp.storeid %>" data-url="<%=cmp.url %>" data-price="<%=cmp.price %>">\n                        <%if(i>0){%><div class="hr"></div><%}%>\n                        <ul class="cart-pd tc clearfix">\n                            <li class="tl lh100 wp9 ">\n                                <%if(cmp.upstate==0){%><p class="ml15 mt10">?????????<br/>?????????</p><%}else{%>\n                                    <input class="ml15" checked="checked" type="checkbox" name="chkcmp" value="<%=cmp.url %>" />\n                                <%}%>\n                            </li>\n                            <li class="tl wp31">\n                                <a href="<%=GlobalConfigUrl.indexUrl %>/<%=cmp.url %>" target="_blank"><img width="80" class="fl" src="<%=GlobalConfigUrl.imageRootUrl %>/<%=cmp.image1 %>.360.png"></a>\n                                <p class="pt"><%=cmp.campaignname %></p>\n                                <p class="pd mt5"><%=cmp.values.join(" / ") %></p>\n                            </li>\n                            <li class="wp15"><%=cmp.price %></li>\n                            <li class="wp15">\n                                <div class="number-area clearfix">\n                                    <span class="minus">-</span><input class="rs-ipt" type="text" name="number" value="<%=cmp.quantity %>" /><span class="plus">+</span>\n                                </div>\n                            </li>\n                            <li class="wp20"><%=cmp.quantity*cmp.price %></li>\n                            <li class="wp10"><span class="item-del">??????</span></li>\n                        </ul>\n                    </div>\n                <%});%>\n            </div>\n        <%});%>';
                var r = a.template(i);
                var o = e("#span-allnum");
                var s = e("#span-choicenum");
                var l = e("#span-allprice");
                var c = function(a) {
                    var n = [];
                    e("div.cart-pd-ct").each(function() {
                        var t = e(this);
                        var i = t.data("price");
                        var r = t.find("[name=chkcmp]").prop("checked");
                        var o = t.find("[name=number]");
                        var s = {
                            id: t.data("id"),
                            pdc: t.data("pdc"),
                            checked: r,
                            quantity: o.val(),
                            storeid: t.data("storeid"),
                            url: t.data("url"),
                            price: i
                        };
                        if (a == true) {
                            if (r == true) {
                                n.push(s)
                            }
                        } else {
                            if (t.data("upstate") > 0) {
                                n.push(s)
                            }
                        }
                        t.removeAttr("data-price data-id data-url data-storeid data-pdc")
                    });
                    return n
                };
                var d = function() {
                    o.text(e("div.cart-pd-ct").length)
                };
                var u = function() {
                    var e = 0;
                    var n = 0;
                    var t = c(false);
                    a.each(t,
                    function(a) {
                        if (a.checked) {
                            e += 1;
                            n += a.price * a.quantity
                        }
                    });
                    s.text(e);
                    if (!isNaN(n)) {
                        l.text("?? " + n)
                    }
                };
                var f = function(a) {
                    clearInterval(t);
                    t = setTimeout(function() {
                        e.ajax({
                            url: "_updatecart",
                            data: a,
                            type: "get",
                            dataType: "json"
                        }).done(function(e) {}).fail(function() {})
                    },
                    600)
                };
                var p = function() {
                    var n = e("[name=chkcmp]");
                    var t = false;
                    if (n.length > 0) {
                        t = a.all(n,
                        function(e) {
                            return e.checked
                        })
                    }
                    e("[name=chkall]").prop("checked", t)
                };
                var m = function() {
                    var n = e(".cart-item");
                    n.each(function() {
                        var n = e(this);
                        var t = n.find("[name=chkcmp]");
                        var i = false;
                        if (t.length > 0) {
                            i = a.all(t,
                            function(e) {
                                return e.checked
                            })
                        }
                        n.find("[name=chkstore]").prop("checked", i)
                    })
                };
                var v = function() {
                    if (e(".cart-item").length == 0) {
                        n.html('<div class="nonedata">?????????????????????</div>')
                    }
                };
                var h = function() {
                    e.ajax({
                        url: "_cartlist",
                        data: {},
                        type: "get",
                        dataType: "json",
                        cache: false
                    }).done(function(e) {
                        if (e.code == 200) {
                            if (e.data.length == 0) {
                                v();
                                return false
                            }
                            var a = r(e);
                            n.html(a);
                            m();
                            p();
                            d();
                            u()
                        } else if (e.code == 3e3) {
                            layer.msg("?????????????????????", 2, {
                                type: -1,
                                shade: false
                            })
                        } else {
                            layer.msg("?????????????????????", 2, {
                                type: -1,
                                shade: false
                            })
                        }
                    }).fail(function() {})
                };
                h();
                var g = function(a) {
                    layer.load("??????????????????...", 0);
                    e.ajax({
                        url: "_deletecart",
                        data: {
                            ids: a.join("_")
                        },
                        type: "post",
                        dataType: "json"
                    }).done(function(t) {
                        if (t.code == 200) {
                            layer.msg("????????????", 2, {
                                type: 1,
                                shade: false
                            });
                            for (var i = 0; i < a.length; i++) {
                                n.find(".pd-" + a[i]).remove()
                            }
                            n.children(".cart-item").each(function() {
                                var a = e(this);
                                if (a.children(".cart-pd-ct").length == 0) {
                                    a.remove()
                                }
                            });
                            m();
                            p();
                            d();
                            u();
                            v()
                        } else if (t.code == 3e3) {
                            layer.msg("????????????", 2, {
                                type: -1,
                                shade: false
                            })
                        } else {
                            layer.msg("????????????", 2, {
                                type: -1,
                                shade: false
                            })
                        }
                    }).fail(function() {})
                };
                var y = function() {
                    n.on("keyup", "[name=number]",
                    function() {
                        var e = this.value.replace(/[^\d]/g, "");
                        this.value = e;
                        if (e) {
                            if (e == "0") e = 1;
                            this.value = parseInt(e, 10)
                        }
                    }).on("blur", "[name=number]",
                    function() {
                        if (parseInt(this.value, 10) > 100) {
                            this.value = 100
                        }
                        if (!this.value) {
                            this.value = 1
                        }
                        var a = e(this);
                        var n = a.closest(".cart-pd-ct");
                        var t = n.data("price");
                        var i = parseFloat(this.value);
                        a.closest("li").next().text(t * i);
                        u();
                        f({
                            id: n.data("id"),
                            qt: i
                        })
                    }).on("click", ".plus",
                    function() {
                        var a = e(this).prev();
                        var n = parseFloat(a.val());
                        if (n >= 100) {
                            return false
                        }
                        n += 1;
                        a.val(n);
                        var t = a.closest(".cart-pd-ct");
                        var i = t.data("price");
                        a.closest("li").next().text(i * n);
                        u();
                        f({
                            id: t.data("id"),
                            qt: n
                        });
                        return false
                    }).on("click", ".minus",
                    function() {
                        var a = e(this).next();
                        var n = parseFloat(a.val());
                        if (n <= 1) {
                            return false
                        }
                        n -= 1;
                        a.val(n);
                        var t = a.closest(".cart-pd-ct");
                        var i = t.data("price");
                        a.closest("li").next().text(i * n);
                        u();
                        f({
                            id: t.data("id"),
                            qt: n
                        });
                        return false
                    });
                    e("#mainbody").on("change", "[name=chkall]",
                    function() {
                        var a = e(this);
                        var n = a.prop("checked");
                        e("[type=checkbox]").prop("checked", n);
                        u();
                        return false
                    }).on("change", "[name=chkstore]",
                    function() {
                        var a = e(this);
                        var n = a.prop("checked");
                        a.closest(".cart-item").find("[type=checkbox]").prop("checked", n);
                        p();
                        u();
                        return false
                    }).on("change", "[name=chkcmp]",
                    function() {
                        m();
                        p();
                        u();
                        return false
                    }).on("click", ".btn-del",
                    function() {
                        var e = c(true);
                        if (e.length == 0) {
                            layer.msg("??????????????????", 2, {
                                type: -1,
                                shade: false
                            });
                            return false
                        }
                        var n = [];
                        a.each(e,
                        function(e) {
                            n.push(e.id)
                        });
                        if (confirm("????????????????????????????????????")) {
                            g(n)
                        }
                        return false
                    }).on("click", ".item-del",
                    function() {
                        if (confirm("????????????????????????????????????")) {
                            var a = e(this);
                            g([a.closest(".cart-pd-ct").data("id")])
                        }
                        return false
                    }).on("click", ".btn-sbm",
                    function() {
                        var n = c(true);
                        if (n.length == 0) {
                            layer.msg("??????????????????", 2, {
                                type: -1,
                                shade: false
                            });
                            return false
                        }
                        var t = [];
                        var i = e('<form action="_orderform" method="get" />').appendTo(document.body);
                        a.each(n,
                        function(e) {
                            i.append('<input type="hidden" name="p" value="' + (e.url + "_" + e.pdc + "_" + e.quantity) + '" />');
                            t.push(e.id)
                        });
                        i.append('<input type="hidden" name="c" value="' + t.join("_") + '" />');
                        i.submit();
                        i.remove();
                        return false
                    })
                };
                y()
            })
        };
        c["orderform"] = function() {
            $('.morebtn').on('click',
            function() {
                $('.fapiao').toggleClass('none');
            });
            a.login.override = function() {
                window.location.reload()
            };
            require(["form", "underscore"],
            function() {
                var n = e("#form"),
                t = e("input[name=company]"),
                i = t.parent(),
                r = e(".order-new-address"),
                s = e(".order-bill"),
                l = e("p.realprice"),
                c = e("p.postprice"),
                d = e("p.baseprice"),
                u = parseFloat(d.data("baseprice")),
                f = 0,
                p = 0,
                m = '<p class="price coupon"><span class="colon">?????????</span> <strong>?? -{couponprice}</strong></p>';
                var v = e("#hid-provincename"),
                h = e("#hid-cityname"),
                g = e("#hid-districtname"),
                y = e("#hid-useraddressid");
                var b = e("[name=sendtime]");
                var C = e("[name=needbill]");
                var k = e("[name=receive]");
                var w = e("[name=company]");
                var x = {};
                var U = {};
                var q = {};
                var I = e(".order-list");
                var j = function() {
                    var e = 0;
                    for (var a in x) {
                        e += x[a]
                    }
                    return e
                };
                var $ = function() {
                    var a = 0;
                    for (var n in q) {
                        e(".cmp" + n).find(".post").text("??" + q[n]);
                        a += q[n]
                    }
                    return a
                };
                var z = function(e) {
                    f = $();
                    c.children("strong").text("?? " + f)
                };
                var S = function() {
                    var a = [];
                    e(".order-item").each(function() {
                        var n = e(this);
                        var t = {
                            productSpecModels: [],
                            campaignid: n.data("cid"),
                            stock: n.data("stock"),
                            url: n.data("url"),
                            storeid: n.data("storeid"),
                            remark: n.find(".txta").val(),
                            couponcode: n.find(".cp-code").data("code")
                        };
                        n.removeAttr("data-cid data-url data-storeid data-stock");
                        n.children(".order-pd").each(function() {
                            var a = e(this);
                            var n = {
                                quantity: a.data("qt"),
                                productcode: a.data("pdc")
                            };
                            a.removeAttr("data-qt data-pdc");
                            t.productSpecModels.push(n)
                        });
                        a.push(t)
                    });
                    return a
                };
                var R = S();
                var T = function(e) {
                    p = j();
                    l.prev(".coupon").remove();
                    if (p > 0) {
                        l.before(m.replace("{couponprice}", p))
                    }
                };
                var A = function() {
                    var e = u + f - p;
                    if (e < 0) {
                        e = 0
                    }
                    l.children("strong").text("?? " + e)
                };
                var G = function(a) {
                    e.ajax({
                        url: "_calculateRealdeliverfee",
                        data: {
                            specsvalues: JSON.stringify(R),
                            provinceid: a
                        },
                        type: "get",
                        dataType: "json"
                    }).done(function(e) {
                        if (e.code == 200) {
                            q = e.deliverfeeMap
                        } else {}
                        z();
                        A()
                    }).fail(function() {})
                };
                var L = function() {
                    e("[type=radio]").iCheck("destroy").on("ifCreated",
                    function() {
                        var a = e(this);
                        if (a.prop("checked") == true && a.attr("name") == "useraddress") {
                            G(a.data("provinceid"))
                        }
                    }).on("ifChecked",
                    function() {
                        var a = e(this);
                        if (a.prop("checked") == true && a.attr("name") == "useraddress") {
                            G(a.data("provinceid"))
                        }
                        if (a.isValid()) {
                            n.data("validator").hideMsg(a)
                        }
                        if (a.attr("name") == "receive") {
                            if (a.data("flag") == "company") {
                                i.fadeIn();
                                n.data("validator").setField({
                                    company: {
                                        rule: "required",
                                        msg: {
                                            required: "??????????????????"
                                        }
                                    }
                                })
                            } else {
                                i.fadeOut();
                                n.data("validator").setField({
                                    company: null
                                })
                            }
                        }
                    }).iCheck({
                        checkboxClass: "icheckbox_square-blue",
                        radioClass: "iradio_square-blue",
                        increaseArea: "20%"
                    })
                };
                L(); (function() {
                    var n = e(document.body);
                    var t = e("#couponlist-ct");
                    var i = _.template(e("#couponone-temp").text());
                    var r = null;
                    var o = function(a) {
                        var n = a.closest(".order-item");
                        var r = n.data("cid");
                        var o = 0;
                        n.children(".order-pd").each(function() {
                            var a = e(this);
                            o += a.data("prc") * a.data("qt")
                        });
                        e.ajax({
                            url: "_queryCoupon",
                            data: {
                                listtype: 1,
                                campaignid: r,
                                price: o,
                                pageSize: 20
                            },
                            cache: false,
                            type: "get",
                            dataType: "json"
                        }).done(function(e) {
                            if (e.code == 200 && e.data && e.data.listCoupon) {
                                var a = i({
                                    data: e.data.listCoupon
                                });
                                setTimeout(function() {
                                    t.children(".loading").hide();
                                    t.append(a);
                                    s()
                                },
                                400)
                            }
                        }).fail(function(e) {})
                    };
                    var s = function() {
                        t.find(".couponone").each(function() {
                            var a = e(this).removeClass("used").data("status", "");
                            var n = a.data("code");
                            a.data("message");
                            a.data("amount");
                            a.removeAttr("data-message data-amount data-code");
                            if (U[n] == "used") {
                                a.addClass("used");
                                a.data("status", "used")
                            }
                        })
                    };
                    var l = function() {
                        layer.closeAll()
                    };
                    I.on("click", ".btn-cp",
                    function() {
                        if (!a.cookie.get("userId")) {
                            layer.msg("??????????????????????????????", 2, {
                                type: -1,
                                shade: false
                            });
                            return false
                        }
                        var n = e(this);
                        r = n;
                        t.children(".loading").show();
                        t.children(".couponlist").remove();
                        var i = e.layer({
                            type: 1,
                            title: false,
                            fix: false,
                            fadeIn: 400,
                            shade: [.4, "#000"],
                            area: ["1160px", "600px"],
                            page: {
                                dom: "#couponlist-ct",
                                ok: function(e) {}
                            }
                        });
                        e("#xubox_layer" + i).find(".xubox_close").on("click",
                        function() {
                            l()
                        });
                        t.addClass("show");
                        o(n);
                        return false
                    });
                    t.on("click", ".close",
                    function() {
                        l();
                        return false
                    }).on("click", ".cash",
                    function() {
                        var a = e(this);
                        var n = a.siblings("input").val();
                        if (/^[0-9a-zA-Z]{6,12}$/.test(n) == false) {
                            layer.msg("??????????????????????????????", 2, {
                                type: -1,
                                shade: false
                            });
                            return false
                        }
                        var i = layer.load("????????????????????????");
                        e.ajax({
                            url: "_exchangeCoupon",
                            data: {
                                code: n
                            },
                            type: "post",
                            dataType: "json"
                        }).done(function(e) {
                            if (e.code == 200) {
                                console.log(e);
                                setTimeout(function() {
                                    layer.close(i);
                                    layer.msg("????????????", 2, {
                                        type: -1,
                                        shade: false
                                    });
                                    t.children(".couponlist").remove();
                                    o(r)
                                },
                                500)
                            } else {
                                setTimeout(function() {
                                    layer.msg(e.message, 2, {
                                        type: -1,
                                        shade: false
                                    })
                                },
                                500)
                            }
                        }).fail(function(e) {});
                        return false
                    }).on("click", ".nouse",
                    function() {
                        var a = e(this);
                        var n = r.siblings(".cp-code").data("code");
                        var t = r.closest(".order-item").data("url");
                        l();
                        r.data("op", "use").text("???????????????").siblings(".cp-code").data("code", "").html("").css("display", "none");
                        delete U[n];
                        delete x[t];
                        T();
                        A();
                        return false
                    }).on("click", ".couponone",
                    function() {
                        var a = e(this);
                        var n = a.data("message");
                        var t = a.data("status");
                        var i = a.data("code");
                        var o = r.siblings(".cp-code").data("code");
                        var s = r.closest(".order-item").data("url");
                        var c = a.data("amount");
                        if (t == "used") {
                            layer.msg("????????????????????????", 2, {
                                type: -1,
                                shade: false
                            });
                            return false
                        }
                        if (n == "ok") {
                            l();
                            r.data("op", "alter").text("???????????????").siblings(".cp-code").data("code", i).html("????????? ??" + c).css("display", "inline-block");
                            delete U[o];
                            U[i] = "used";
                            x[s] = c;
                            T();
                            A()
                        } else {
                            layer.msg(n, 2, {
                                type: -1,
                                shade: false
                            });
                            return false
                        }
                        return false
                    })
                })();
                e("[type=checkbox]").iCheck("destroy").on("ifChanged",
                function() {
                    var a = e(this);
                    if (a.prop("checked")) {
                        s.show();
                        if (t.is(":visible")) {
                            n.data("validator").setField({
                                company: {
                                    rule: "required",
                                    msg: {
                                        required: "??????????????????"
                                    }
                                }
                            })
                        }
                    } else {
                        s.hide();
                        n.data("validator").setField({
                            company: null
                        })
                    }
                }).iCheck({
                    checkboxClass: "icheckbox_square-blue",
                    radioClass: "iradio_square-blue",
                    increaseArea: "20%"
                });
                var P = true;
                var D = function(a) {
                    if (!a) {
                        a = S()
                    }
                    var n = {
                        sendtime: b.val(),
                        needbill: C.prop("checked"),
                        receive: k.filter(":checked").val(),
                        company: w.val(),
                        specsvalues: JSON.stringify(a),
                        c: e("#hid-cartids").val()
                    };
                    if (r.length > 0) {
                        n.provinceid = Z.val();
                        n.cityid = M.val();
                        n.districtid = O.val();
                        n.provincename = Z.children(":checked").text();
                        n.cityname = M.children(":checked").text();
                        n.districtname = O.children(":checked").text();
                        n.name = N.val();
                        n.address = B.val();
                        n.phone = V.val();
                        n.phoneb = W.val();
                        n.postcode = Q.val()
                    } else {
                        n.useraddressid = e("[name=useraddress]:checked").val()
                    }
                    layer.load("??????????????????????????????...", 0);
                    e.ajax({
                        url: "_submitOrder",
                        data: n,
                        type: "post",
                        dataType: "json"
                    }).done(function(e) {
                        if (e.code == 200) {
                            layer.msg("?????????????????????????????????...", 2, {
                                type: 1,
                                shade: false
                            });
                            window.setTimeout(function() {
                                location.href = "_pay?tradeid=" + e.data.toString()
                            },
                            500)
                        } else if (e.code == 201) {
                            location.href = "_payResult?tradeid=" + e.data.toString()
                        } else if (e.code == 501) {} else {
                            layer.msg(e.message, 2, {
                                type: -1,
                                shade: false
                            });
                            P = true
                        }
                    }).fail(function() {
                        P = true
                    })
                };
                var F = function(a) {
                    var n = "";
                    for (var t = 0; t < a.length; t++) {
                        n += '<p class="item">{content}</p>'.replace("{content}", a[t].campaignname + "&nbsp&nbsp&nbsp" + a[t].specnamevalue)
                    }
                    e.layer({
                        type: 1,
                        title: false,
                        border: [0],
                        fix: false,
                        fadeIn: 400,
                        shade: [.3, "#bebebe"],
                        area: ["460px", "auto"],
                        page: {
                            html: '<div class="div-validate-stock">\n                                            <p>???????????????????????????????????????????????????????????????????????????????????????????????????</p>\n                                            {styleitem}\n                                            <p class="mt10">????????????????????????<span class="day">45??????</span>??????</p>\n                                            <div class="tc btn-area">\n                                                <span id="btn-pc-now-reserve" class="btn-now-reserve btn-s1 btn-o8">????????????</span>\n                                                <span class="btn-choice-other btn-s1 btn-o8">??????????????????</span>\n                                            </div>\n                                        </div>'.replace("{styleitem}", n)
                        }
                    });
                    e(".xubox_setwin").css({
                        top: 16,
                        right: 20
                    });
                    e(".xubox_title em").css({
                        top: 15,
                        left: 20
                    });
                    e(".btn-now-reserve").on("click",
                    function() {
                        layer.closeAll();
                        D()
                    });
                    e(".btn-choice-other").on("click",
                    function() {
                        layer.closeAll()
                    })
                };
                var E = function(a) {
                    e.ajax({
                        url: "_judgePresell?" + a.join("&"),
                        data: {},
                        type: "get",
                        dataType: "json",
                        cache: false
                    }).done(function(e) {
                        if (e.code == 200) {
                            D()
                        } else if (e.code == 300) {
                            F(e.data)
                        }
                        P = true
                    }).fail(function() {
                        P = true
                    })
                };
                n.validator({
                    rules: {
                        newphone: function(e) {
                            var a = Z.val();
                            var n = o.mainlandMobile;
                            if (a == "32" || a == "33" || a == "34") {
                                n = o.internationalPhone
                            }
                            return n.test(e.value) || "???????????????????????????"
                        }
                    },
                    fields: {
                        remark: "remark"
                    },
                    valid: function(e) {
                        if (P === true) {
                            P = false;
                            var a = [];
                            var n = false;
                            var t = S();
                            for (var i in t) {
                                if (t[i].stock == 1) {
                                    n = true;
                                    for (var r = 0; r < t[i].productSpecModels.length; r++) {
                                        a.push("p=" + t[i].url + "_" + t[i].productSpecModels[r].productcode + "_" + t[i].productSpecModels[r].quantity)
                                    }
                                }
                            }
                            if (n == true) {
                                E(a)
                            } else {
                                D(t)
                            }
                        }
                    },
                    invalid: function() {
                        var a = e("span.n-error:visible:first");
                        if (a.length > 0) {
                            var n = a.offset().top;
                            e("html,body").animate({
                                scrollTop: n - 50
                            },
                            300)
                        }
                    }
                });
                if (r.length > 0) {
                    var Z = e("select[name=provinceid]"),
                    M = e("select[name=cityid]"),
                    O = e("select[name=districtid]");
                    var N = e("[name=name]"),
                    V = e("[name=phone]"),
                    W = e("[name=phoneb]"),
                    B = e("[name=address]"),
                    Q = e("[name=postcode]");
                    e("select.ads").dropkick({
                        change: function(e, a) {
                            if (this.isValid()) {
                                n.data("validator").hideMsg(this)
                            }
                            H(this.attr("name"), e);
                            if (this.attr("name") == "provinceid") {
                                if (e) {
                                    G(e)
                                } else {
                                    z();
                                    A()
                                }
                            }
                        }
                    });
                    n.data("validator").setField({
                        name: {
                            rule: "required;name",
                            msg: {
                                required: "???????????????"
                            }
                        },
                        address: {
                            rule: "required;address",
                            msg: {
                                required: "???????????????"
                            }
                        },
                        phone: {
                            rule: "required;newphone",
                            msg: {
                                required: "???????????????"
                            }
                        },
                        phoneb: {
                            rule: "newphone",
                            msg: {
                                required: "???????????????"
                            }
                        },
                        provinceid: {
                            rule: "required",
                            msg: {
                                required: "???????????????"
                            }
                        },
                        cityid: {
                            rule: "required",
                            msg: {
                                required: "???????????????"
                            }
                        },
                        districtid: {
                            rule: "required",
                            msg: {
                                required: "???????????????"
                            }
                        },
                        postcode: "????????????:postcode"
                    });
                    var H = function(a, n) {
                        if (a != "provinceid" && a != "cityid") return;
                        if (!n) return;
                        var t = "_getCity",
                        i = {
                            provinceID: n
                        },
                        r = '<option value="">?????????</option>';
                        if (a == "cityid") {
                            t = "_getDistrict";
                            i = {
                                cityID: n
                            };
                            r = '<option value="">?????????</option>'
                        }
                        e.ajax({
                            url: t,
                            data: i,
                            method: "post",
                            dataType: "json"
                        }).done(function(e) {
                            for (var n = 0; n < e.length; n++) {
                                r += '<option value="' + e[n]["value"] + '">' + e[n]["name"] + "</option>"
                            }
                            if (a == "provinceid") {
                                M.html(r);
                                M.val(M.children("option:eq(1)").val());
                                M.trigger("change");
                                M.dropkick("refresh")
                            } else if (a == "cityid") {
                                O.html(r);
                                O.dropkick("refresh")
                            }
                        })
                    }
                } else {
                    var J = e(".use-address"),
                    Y = e(".order-use-address");
                    n.data("validator").setField({
                        useraddress: {
                            rule: "checked",
                            msg: {
                                checked: "?????????????????????"
                            }
                        }
                    });
                    Y.on("click", ".del-address",
                    function() {
                        var a = e(this).closest("li");
                        if (confirm("?????????????????????")) {
                            e.ajax({
                                url: "_deleteaddress",
                                data: {
                                    useraddressid: a.data("addressid")
                                },
                                method: "post",
                                dataType: "json"
                            }).done(function(e) {
                                if (e.code == 200) {
                                    a.remove();
                                    var n = J.find(".del-address");
                                    if (n.length == 1) {
                                        n.remove()
                                    } else {
                                        var t = J.prev("h2");
                                        if (t.children(".add-address").length == 0) {
                                            t.append('<a href="#" class="add-address">??????????????????</a>')
                                        }
                                    }
                                } else if (e.code == 500) {
                                    layer.msg(e.data, 2, {
                                        type: -1,
                                        shade: false
                                    })
                                }
                            })
                        }
                        return false
                    }).on("click", ".alter-address",
                    function() {
                        var a = e(this).closest("li");
                        K(a.data("addressid"));
                        return false
                    }).on("click", ".add-address",
                    function() {
                        K(0);
                        return false
                    });
                    var K = function(a) {
                        var n = e.layer({
                            type: 2,
                            title: a == "0" ? "??????????????????": "??????????????????",
                            shadeClose: false,
                            maxmin: false,
                            fix: false,
                            area: ["700px", "550px"],
                            iframe: {
                                src: "_orderformpopup?useraddressid=" + a
                            }
                        });
                        window.fnVaryAddressInWindow = function(t) {
                            var i = '<input type="radio" data-provinceid="' + t.provinceid + '" value="' + t.id + '" id="useraddress-' + t.id + '" class="v-hidden" name="useraddress" />\n                            <label for="useraddress-' + t.id + '">\n                            <span class="name">' + t.name + '</span>\n                            <span class="phone">' + t.phone + '</span>\n                            <span class="">' + t.provincename + " " + t.cityname + " " + t.districtname + '</span>\n                            <span class="address">' + t.address + "</span>" + (t.postcode ? '<span class="postcode">???' + t.postcode + "???</span>": "") + '</label><a href="#" data-id="' + t.id + '" class="del-address">??????</a><a href="#" data-id="' + t.id + '" class="alter-address">??????</a>';
                            if (a == 0) {
                                i = '<li data-addressid="' + t.id + '">' + i + "</li>";
                                J.append(i);
                                if (J.children("li").length >= 5) {
                                    Y.find(".add-address").remove()
                                } else {
                                    J.find(".alter-address").each(function() {
                                        var a = e(this);
                                        if (a.prev(".del-address").length == 0) {
                                            a.before('<a href="#" data-id="' + a.data("id") + '" class="del-address">??????</a>')
                                        }
                                    })
                                }
                            } else {
                                J.find("[data-addressid=" + a + "]").html(i);
                                if (J.children("li").length == 1) {
                                    J.find(".del-address").remove()
                                }
                            }
                            L();
                            setTimeout(function() {
                                layer.close(n)
                            },
                            1e3)
                        };
                        return false
                    }
                }
                e(".btn-submit").on("click",
                function() {
                    n.submit()
                })
            })
        };
        c["orderformpopup"] = function() {
            require(["form"],
            function() {
                var a = e("#form"),
                n = e("select[name=provinceid]"),
                t = e("select[name=cityid]"),
                i = e("select[name=districtid]");
                var r = e("#hid-provincename"),
                s = e("#hid-cityname"),
                l = e("#hid-districtname"),
                c = e("#hid-useraddressid");
                e("select.ads").dropkick({
                    change: function(e, n) {
                        if (this.isValid()) {
                            a.data("validator").hideMsg(this)
                        }
                        d(this.attr("name"), e)
                    }
                });
                a.validator({
                    rules: {
                        newphone: function(e) {
                            var a = n.val();
                            var t = o.mainlandMobile;
                            if (a == "32" || a == "33" || a == "34") {
                                t = o.internationalPhone
                            }
                            return t.test(e.value) || "???????????????????????????"
                        }
                    },
                    fields: {
                        name: {
                            rule: "required;name",
                            msg: {
                                required: "???????????????"
                            }
                        },
                        address: {
                            rule: "required;address",
                            msg: {
                                required: "???????????????"
                            }
                        },
                        phone: {
                            rule: "required;newphone",
                            msg: {
                                required: "???????????????"
                            }
                        },
                        phoneb: {
                            rule: "newphone",
                            msg: {
                                required: "???????????????"
                            }
                        },
                        provinceid: {
                            rule: "required",
                            msg: {
                                required: "???????????????"
                            }
                        },
                        cityid: {
                            rule: "required",
                            msg: {
                                required: "???????????????"
                            }
                        },
                        districtid: {
                            rule: "required",
                            msg: {
                                required: "???????????????"
                            }
                        },
                        postcode: "????????????:postcode"
                    },
                    valid: function(o) {
                        if (window == top) return;
                        r.val(n.children(":checked").text());
                        s.val(t.children(":checked").text());
                        l.val(i.children(":checked").text());
                        var c = a.serializeArray();
                        var d = {};
                        for (var u = 0; u < c.length; u++) {
                            d[c[u].name] = c[u].value
                        }
                        e.ajax({
                            url: d.useraddressid > 0 ? "_updateaddress": "_submitaddress",
                            data: d,
                            type: "post",
                            dataType: "json"
                        }).done(function(e) {
                            if (e.code == 200) {
                                layer.msg("????????????", 2, {
                                    type: 1,
                                    shade: false
                                });
                                d.id = e.data || d.useraddressid;
                                top.fnVaryAddressInWindow(d)
                            } else if (e.code == 403) {
                                layer.msg("???????????????", 2, {
                                    type: -1,
                                    shade: false
                                })
                            } else if (e.code == 500) {
                                layer.msg(e.data, 2, {
                                    type: -1,
                                    shade: false
                                })
                            }
                        })
                    }
                });
                var d = function(a, n) {
                    if (a != "provinceid" && a != "cityid") return;
                    if (!n) return;
                    var r = "_getCity",
                    o = {
                        provinceID: n
                    },
                    s = '<option value="">?????????</option>';
                    if (a == "cityid") {
                        r = "_getDistrict";
                        o = {
                            cityID: n
                        };
                        s = '<option value="">?????????</option>'
                    }
                    e.ajax({
                        url: r,
                        data: o,
                        method: "post",
                        dataType: "json"
                    }).done(function(e) {
                        for (var n = 0; n < e.length; n++) {
                            s += '<option value="' + e[n]["value"] + '">' + e[n]["name"] + "</option>"
                        }
                        if (a == "provinceid") {
                            t.html(s);
                            if (t.data("default-cityid")) {
                                t.val(t.data("default-cityid"));
                                t.data("default-cityid", null)
                            } else {
                                t.val(t.children("option:eq(1)").val())
                            }
                            t.trigger("change");
                            t.dropkick("refresh")
                        } else if (a == "cityid") {
                            i.html(s);
                            if (i.data("default-districtid")) {
                                i.val(i.data("default-districtid"));
                                i.data("default-districtid", null)
                            }
                            i.dropkick("refresh")
                        }
                    })
                };
                if (c.val() > 0) {
                    e.ajax({
                        url: "_queryaddress",
                        data: {
                            useraddressid: c.val()
                        },
                        method: "get",
                        dataType: "json",
                        cache: false
                    }).done(function(a) {
                        if (a.code == 200) {
                            if (a.data.length > 0) {
                                var r = a.data[0];
                                e("[name=name]").val(r.name);
                                e("[name=address]").val(r.address);
                                e("[name=phone]").val(r.phone);
                                e("[name=phoneb]").val(r.phoneb);
                                e("[name=postcode]").val(r.postcode);
                                n.data("default-provinceid", r.provinceid);
                                t.data("default-cityid", r.cityid);
                                i.data("default-districtid", r.districtid);
                                n.val(r.provinceid);
                                n.dropkick("refresh");
                                d("provinceid", r.provinceid)
                            }
                        } else if (a.code == 500) {
                            layer.msg(a.data, 2, {
                                type: -1,
                                shade: false
                            })
                        }
                    })
                }
            })
        };
        c["payment"] = function() {
            require(["form"],
            function() {
                var n = e("#form"),
                t = e("#div-form"),
                i = e("#hid-tradeid"),
                r = i.val(),
                o = e("[name=paytype]");
                var s = function() {
                    var a = 0;
                    var n = function() {
                        e.ajax({
                            url: "_checkPaymentSuccess",
                            data: {
                                gtradeid: r
                            },
                            type: "get",
                            cache: false
                        }).done(function(e) {
                            if (e.code == 200) {
                                clearInterval(t);
                                location.href = "_payResult?tradeid=" + r
                            } else {}
                        })
                    };
                    var t = setInterval(function() {
                        if (a > 180) {
                            clearInterval(t);
                            return false
                        }
                        n();
                        a += 1
                    },
                    1e4)
                };
                e("[type=radio]").on("ifChecked",
                function() {}).iCheck({
                    checkboxClass: "icheckbox_square-blue",
                    radioClass: "iradio_square-blue",
                    increaseArea: "20%"
                });
                e(".pay-popup").on("click", "a.close",
                function() {
                    layer.closeAll();
                    return false
                });
                e(".btn-submit").on("click",
                function() {
                    var i = o.filter(":checked");
                    if (!r) {
                        layer.msg("??????????????????????????????", 2, {
                            type: -1,
                            shade: false
                        });
                        return false
                    }
                    if (i.length == 0) {
                        layer.msg("?????????????????????", 2, {
                            type: -1,
                            shade: false
                        });
                        return false
                    }
                    a.tongji.eventProcess({
                        v3: "btn-order-pay",
                        v6: r,
                        v5: i.val()
                    });
                    if (i.val() == "wechat") {
                        var l = new Image;
                        l.onload = function() {
                            var a = e.layer({
                                type: 1,
                                title: false,
                                shadeClose: true,
                                fix: false,
                                fadeIn: 400,
                                shade: [.3, "#bebebe"],
                                area: ["528px", "300px"],
                                page: {
                                    html: '<img class="fl" src="_wxUnifiedorder?tradeid=' + r + '" onerror="fnTimeover" /><img class="fr" style="margin-top:100px;margin-left:-10px" src="' + GlobalConfigUrl.imageRootUrl + '/statics/images/wechatpaytext.png" />'
                                }
                            });
                            s()
                        };
                        l.onerror = function() {
                            layer.msg("???????????????", 2, {
                                type: -1,
                                shade: false
                            })
                        };
                        l.src = "_wxUnifiedorder?tradeid=" + r;
                        return false
                    }
                    e.ajax({
                        url: "_payOrderform",
                        type: "post",
                        async: false,
                        dataType: "json",
                        data: n.serialize()
                    }).done(function(a) {
                        if (a.code == 200) {
                            if (a.data != "") {
                                e.layer({
                                    type: 1,
                                    fadeIn: 400,
                                    area: ["440px", "280px"],
                                    title: false,
                                    border: [0],
                                    page: {
                                        dom: ".pay-popup"
                                    }
                                });
                                t.append(a.data);
                                setTimeout(function() {
                                    t.empty()
                                },
                                500)
                            }
                        } else if (a.code == 403) {} else {
                            layer.msg(a.data, 2, {
                                type: -1,
                                shade: false
                            })
                        }
                    }).fail(function(e) {
                        layer.msg("??????????????????????????????", 2, {
                            type: -1,
                            shade: false
                        })
                    }).always(function() {});
                    return false
                })
            })
        };
        c["paysuccess"] = function() {
            a.tongji.tongjiOptions.v3 = campaignConfig.type;
            if (campaignConfig.type == "paysuccess") {} else if (campaignConfig.type == "payerror") {} else if (campaignConfig.type == "payverify") {
                var n = 0;
                var t = function() {
                    e.ajax({
                        url: "_checkPaymentSuccess",
                        data: {
                            gtradeid: campaignConfig.id
                        },
                        type: "get",
                        cache: false
                    }).done(function(e) {
                        if (e.code == 200) {
                            clearInterval(i);
                            location.reload()
                        } else {}
                    })
                };
                var i = setInterval(function() {
                    if (n > 30) {
                        clearInterval(i);
                        return false
                    }
                    t();
                    n += 1
                },
                2e3)
            }
        };
        c["recommend"] = function() {
            a.login.override = function() {
                window.location.reload()
            };
            e(".login").on("click",
            function() {
                fnLoginPopup();
                return false
            });
            var n = document.getElementById("txt-url");
            if ( !! n) {
                require(["zeroclipboard"],
                function(a) {
                    var t = document.getElementById("span-copy");
                    var i = new a(document.getElementById("span-copy"), {
                        moviePath: document.getElementById("hid-swfpath").value
                    });
                    i.on("aftercopy",
                    function(e) {
                        layer.msg("????????????", 2, {
                            type: 1,
                            shade: false
                        })
                    });
                    i.on("error",
                    function(a) {
                        if (a.name == "flash-disabled") {
                            e(t).on("click",
                            function() {
                                layer.alert("?????????????????????????????????????????????????????????<br/>" + n.value)
                            })
                        }
                    })
                });
                a.shareInit([""], 0, n.value, campaignConfig.title, campaignConfig.title, campaignConfig.title);
                n.onmouseover = function() {
                    n.select()
                }
            }
        };
        c["showshop"] = function() {
            a.login.override = function() {
                window.location.reload()
            };
            var n = e(".list-container");
            var t = n.offset().top;
            var i = e(".loading");
            var o = e(window);
            var s = e(document.body);
            var c = o.height();
            var d = 1;
            var u = 1;
            var f = 12;
            var p = e(".focus-shop");
            var m = e(".set-shop");
            var v = e(".fans-num>.num");
            var h = false;
            var g = '<div class="item-ct" data-sort="{sort}" data-state="{state}" data-url="{url}">\n                                <div class="item">\n                                    <a href="{href}" title="{title}" target="_blank">\n                                        <img title="{imgtitle}" alt="{alt}" src="{src}">\n                                        <span class="ohe"> {name}</span>\n                                    </a>\n                                    <div class="percent-bg">\n                                        <div style="width: {percent}%;" class="percent-f"></div>\n                                    </div>\n                                    <div class="status clearfix">\n                                        <div class="price">?? {price}</div>\n                                        <div class="first"><span class="num">{goal}</span><span class="txt">??????</span></div>\n                                        <div><span class="num">{saled}</span><span class="txt">??????</span></div>\n                                    </div>\n                                </div>\n                                <div class="shade{shadedp}"><div class="layer"></div><div class="icon"></div></div>\n                                <div class="tools{toolsdp}">{toolshtml}</div>\n                            </div>';
            var y = function(e, a, n) {
                var t = "";
                var i = "";
                if (e.data.length > 0) {
                    var r;
                    for (var o = 0; o < e.data.length; o++) {
                        i = "";
                        r = e.data[o];
                        t += b(r, i)
                    }
                } else {
                    if (UDZPageConfig.upstate == "1") {
                        t = '<div class="no-data">????????????????????????????????????????????????<a class="a1" href="_shop?storeid=' + UDZPageConfig.shopid + '">?????????????????????</a></div>'
                    } else {
                        t = '<div class="no-data">????????????????????????????????????????????????<a class="a1" href="_shop?storeid=' + UDZPageConfig.shopid + '&upstate=1">?????????????????????</a></div>'
                    }
                }
                a.append(t)
            };
            var b = function(e, a) {
                var n = "";
                if (e.isdist == 0) {
                    if (e.storeupstate == 1) {
                        n = '<div class="btn totop"><span class="icon"></span><span>??????</span></div><div class="btn hidden"><span class="icon"></span><span>??????</span></div>'
                    } else {
                        n = '<a href="' + GlobalConfigUrl.indexUrl + "/" + e.url + '" target="_blank" class="btn look"><span class="icon"></span><span>??????</span></a><div class="btn show"><span class="icon"></span><span>??????</span></div>'
                    }
                } else {
                    n = '<div class="cfff pl10">?????????????????????????????????</div>'
                }
                return g.replace("{state}", e.storeupstate).replace("{sort}", e.storesort).replace("{url}", e.url).replace("{href}", GlobalConfigUrl.indexUrl + "/" + e.url + (e.isdist == 1 ? "?referUnionId=" + encodeURIComponent(UDZPageConfig.username) : "")).replace("{title}", e.name).replace("{imgtitle}", e.name).replace("{alt}", e.name).replace("{src}", GlobalConfigUrl.imageRootUrl + "/" + e.image1 + r.small).replace("{name}", e.name).replace("{percent}", e.saled >= e.goal ? 100 : e.saled / e.goal * 100).replace("{price}", e.displayPrice).replace("{goal}", e.goal).replace("{saled}", e.saled).replace("{shadedp}", e.storeupstate == 0 ? "": " none").replace("{toolsdp}", h ? "": " none").replace("{toolshtml}", n)
            };
            var C = function(a) {
                e.ajax({
                    url: "_storeCampaign",
                    data: a,
                    type: "get",
                    dataType: "json",
                    cache: false
                }).done(function(e) {
                    if (e.code == 200) {
                        y(e, n, e.currentPage);
                        d += 1;
                        u = e.totalPage;
                        i.hide()
                    } else if (e.code == 501) {
                        layer.msg("?????????????????????", 2, {
                            type: -1,
                            shade: false
                        })
                    } else {}
                }).always(function(e) {
                    n.data("loadstatus", "ready")
                })
            };
            p.on("click",
            function() {
                var a = e(this);
                var n = a.data("focus");
                var t = "_attentionStore";
                if (n == "1") {
                    t = "_cancelAttention"
                }
                e.ajax({
                    url: t,
                    data: {
                        storeid: UDZPageConfig.shopid
                    },
                    type: "get",
                    dataType: "json",
                    cache: false
                }).done(function(e) {
                    if (e.code == 200) {
                        if (n == "0") {
                            layer.msg("????????????", 2, {
                                type: 1,
                                shade: false
                            });
                            p.data("focus", "1");
                            p.text("????????????");
                            v.text(parseInt(v.text(), 10) + 1)
                        } else {
                            layer.msg("????????????", 2, {
                                type: 1,
                                shade: false
                            });
                            p.data("focus", "0");
                            p.text("????????????");
                            v.text(parseInt(v.text(), 10) - 1)
                        }
                    } else if (e.code == 403) {
                        fnLoginPopup()
                    } else if (e.code == 500) {
                        layer.msg(e.data, 2, {
                            type: -1,
                            shade: false
                        })
                    } else {
                        layer.msg(e.data, 2, {
                            type: -1,
                            shade: false
                        })
                    }
                }).fail(function(e) {})
            });
            m.on("click",
            function() {
                if (h == false) {
                    m.html("????????????");
                    n.find(".tools").show();
                    h = true
                } else {
                    m.html("????????????");
                    n.find(".tools").hide();
                    h = false
                }
            });
            var k = function(a, n, t) {
                e.ajax({
                    url: "_storeup",
                    data: {
                        url: a,
                        storeupstate: n
                    },
                    type: "post",
                    dataType: "json"
                }).done(function(e) {
                    if (e.code == 200) {
                        t()
                    } else {
                        layer.msg(e.data, 2, {
                            type: -1,
                            shade: false
                        })
                    }
                }).fail(function() {
                    layer.msg("??????????????????????????????", 2, {
                        type: -1,
                        shade: false
                    })
                })
            };
            n.on("click", ".totop",
            function() {
                var a = e(this);
                var t = a.closest(".item-ct");
                var i = t.data("state");
                var r = t.data("sort");
                var o = t.data("url");
                var r = n.children(":first").data("sort") + 1;
                e.ajax({
                    url: "_storesort",
                    data: {
                        url: o,
                        storesort: r
                    },
                    type: "post",
                    dataType: "json"
                }).done(function(e) {
                    if (e.code == 200) {
                        n.prepend(t);
                        t.data("sort", r)
                    } else {
                        layer.msg(e.data, 2, {
                            type: -1,
                            shade: false
                        })
                    }
                }).fail(function() {
                    layer.msg("??????????????????????????????", 2, {
                        type: -1,
                        shade: false
                    })
                })
            }).on("click", ".hidden",
            function() {
                var a = e(this);
                var n = a.closest(".item-ct");
                var t = n.data("state");
                var i = n.data("sort");
                var r = n.data("url");
                k(r, 0,
                function() {
                    n.find(".shade").show();
                    n.find(".tools").html('<a href="' + GlobalConfigUrl.indexUrl + "/" + r + '" target="_blank" class="btn look"><span class="icon"></span><span>??????</span></a><div class="btn show"><span class="icon"></span><span>??????</span></div>')
                })
            }).on("click", ".show",
            function() {
                var a = e(this);
                var n = a.closest(".item-ct");
                var t = n.data("state");
                var i = n.data("sort");
                var r = n.data("url");
                k(r, 1,
                function() {
                    n.find(".shade").hide();
                    n.find(".tools").html('<div class="btn totop"><span class="icon"></span><span>??????</span></div><div class="btn hidden"><span class="icon"></span><span>??????</span></div>')
                })
            });
            o.on("scroll",
            function() {
                if (d <= u && n.data("loadstatus") != "loading" && t + n.height() - o.scrollTop() - o.height() < 200) {
                    n.data("loadstatus", "loading");
                    i.show();
                    C({
                        storeid: UDZPageConfig.shopid,
                        upstate: UDZPageConfig.upstate,
                        currentPage: d,
                        pageSize: f
                    })
                }
            }).trigger("scroll");
            if (location.hash == "#set") {
                m.trigger("click")
            }
            l({
                udzsourceb: "",
                udzrecommend: "",
                udzsourceorder: UDZPageConfig.sourceOrder
            });
            a.tongji.tongjiOptions.v2 = UDZPageConfig.shopid;
            a.shareInit([""], UDZPageConfig.shopid, location.href, UDZPageConfig.qqTitle, UDZPageConfig.rrTitle, UDZPageConfig.wbTitle)
        };
        c["download"] = function() {
            var a;
            e(".apple,.android").on("mouseenter",
            function() {
                var n = e(this);
                a = setTimeout(function() {
                    n.children(".layer").fadeIn(200)
                },
                200)
            }).on("mouseleave",
            function() {
                clearTimeout(a);
                e(this).children(".layer").fadeOut(200)
            })
        };
        c["privilege"] = function() {
            require(["form"],
            function() {
                var a = e("#form");
                var n = e("#hid-type");
                var t = e(".li-idimg1");
                var i = e(".li-idimg2");
                var r = e(".idnumber");
                var o = e("[name=managemode]");
                a.validator({
                    fields: {
                        realname: "??????: required; name",
                        mobile: "?????????: required; mobile",
                        email: "??????: required; email",
                        city: "??????: required; chinese",
                        username: "????????????:required; email|mobile;",
                        idnumber: "????????????: required; ID_card",
                        shopurl: "????????????: url",
                        idimg1: {
                            rule: "required; pngjpg",
                            msg: {
                                required: "???????????????????????????"
                            }
                        },
                        idimg2: "??????????????????: required;"
                    },
                    valid: function(e) {
                        e.submit()
                    }
                });
                o.on("change",
                function() {
                    if (o.filter(":checked").val() == "person") {
                        r.html("????????????");
                        i.show();
                        a.data("validator").setField({
                            idnumber: "????????????: required; ID_card",
                            idimg2: {
                                rule: "required; pngjpg",
                                msg: {
                                    required: "???????????????????????????"
                                }
                            }
                        });
                        a.data("validator").hideMsg(a.find("[name=idnumber]"))
                    } else {
                        r.html("?????????????????????");
                        i.hide();
                        a.data("validator").setField({
                            idnumber: {
                                rule: "?????????????????????:required; number;",
                                msg: {
                                    number: "???????????????????????????????????????"
                                }
                            },
                            idimg2: null
                        });
                        a.data("validator").hideMsg(a.find("[name=idnumber]"));
                        a.data("validator").hideMsg(a.find("[name=idimg2]"))
                    }
                })
            });
            l({
                udzsourceb: UDZPageConfig.sSource,
                udzrecommend: "",
                udzsourceorder: ""
            });
            if ( !! UDZPageConfig.sStatus) {
                e.layer({
                    title: "????????????",
                    dialog: {
                        type: -1,
                        msg: "?????????????????????????????????????????????????????????????????????????????????<br/><br/>"
                    }
                })
            }
        };
        c["search"] = function() {
            require(["searchpage"],
            function() {})
        };
        if (typeof c[n] === "function") {
            c[n]()
        }
    };
    var d = function() {
        n = document.body.className;
        a.udzInit();
        c();
        a.tongji.tongjiProcess()
    };
    d()
});