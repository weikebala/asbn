﻿; !function (a, b) {
    "use strict";
    var c, d,
    e = "/dzwindFront/static/", //组件存放目录，为空表示自动获取
    f = { getPath: function () { var a = document.scripts, b = a[a.length - 1].src; return e ? e : b.substring(0, b.lastIndexOf("/") + 1) }, type: ["dialog", "page", "iframe", "loading", "tips"] }; a.layer = { v: "1.8.5", ie6: !!a.ActiveXObject && !a.XMLHttpRequest, index: 0, path: f.getPath(), use: function (a, b) { var d = c("head")[0], a = a.replace(/\s/g, ""), e = /\.css$/.test(a), f = document.createElement(e ? "link" : "script"), g = a.replace(/\.|\//g, ""); e && (f.type = "text/css", f.rel = "stylesheet"), f[e ? "href" : "src"] = /^http:\/\//.test(a) ? a : layer.path + a, f.id = g, c("#" + g)[0] || d.appendChild(f), b && (document.all ? c(f).ready(b) : c(f).load(b)) }, alert: function (a, b, d, e) { var f = "function" == typeof d, g = { dialog: { msg: a, type: b, yes: f ? d : e }, area: ["auto", "auto"] }; return f || (g.title = d), c.layer(g) }, confirm: function (a, b, d, e) { var f = "function" == typeof d, g = { dialog: { msg: a, type: 4, btns: 2, yes: b, no: f ? d : e } }; return f || (g.title = d), c.layer(g) }, msg: function (a, d, e, f) { var g = { title: !1, closeBtn: !1, time: d === b ? 2 : d, dialog: { msg: "" === a || a === b ? "&nbsp;" : a }, end: f }; return "object" == typeof e ? (g.dialog.type = e.type, g.shade = e.shade, g.shift = e.rate) : "function" == typeof e ? g.end = e : g.dialog.type = e, c.layer(g) }, load: function (a, b) { return "string" == typeof a ? layer.msg(a, b || 0, 16) : c.layer({ time: a, loading: { type: b }, bgcolor: b ? "#fff" : "", shade: b ? [.1, "#000"] : [0], border: 3 !== b && b ? [6, .3, "#000"] : [0], type: 3, title: ["", !1], closeBtn: [0, !1] }) }, tips: function (a, b, d, e, f, g) { var h = { type: 4, shade: !1, success: function (a) { this.closeBtn || a.find(".xubox_tips").css({ "padding-right": 10 }) }, bgcolor: "", tips: { msg: a, follow: b } }; return h.time = "object" == typeof d ? d.time : 0 | d, d = d || {}, h.closeBtn = d.closeBtn || !1, h.maxWidth = d.maxWidth || e, h.tips.guide = d.guide || f, h.tips.style = d.style || g, h.tips.more = d.more, c.layer(h) } }; var g = ["xubox_layer", "xubox_iframe", ".xubox_title", ".xubox_text", ".xubox_page", ".xubox_main"], h = function (a) { var b = this, d = b.config; layer.index++, b.index = layer.index, b.config = c.extend({}, d, a), b.config.dialog = c.extend({}, d.dialog, a.dialog), b.config.page = c.extend({}, d.page, a.page), b.config.iframe = c.extend({}, d.iframe, a.iframe), b.config.loading = c.extend({}, d.loading, a.loading), b.config.tips = c.extend({}, d.tips, a.tips), b.creat() }; h.pt = h.prototype, h.pt.config = { type: 0, shade: [.1, "#333"], fix: !0, move: ".xubox_title", title: "&#x4FE1;&#x606F;", offset: ["", "50%"], area: ["310px", "auto"], closeBtn: [0, !0], time: 0, bgcolor: "#fff", border: [6, .3, "#000"], zIndex: 19891014, maxWidth: 400, dialog: { btns: 1, btn: ["&#x786E;&#x5B9A;", "&#x53D6;&#x6D88;"], type: 8, msg: "", yes: function (a) { layer.close(a) }, no: function (a) { layer.close(a) } }, page: { dom: "#xulayer", html: "", url: "" }, iframe: { src: "http://sentsin.com", scrolling: "auto" }, loading: { type: 0 }, tips: { msg: "", follow: "", guide: 0, isGuide: !0, style: ["background-color:#FF9900; color:#fff;", "#FF9900"] }, success: function () { }, close: function (a) { layer.close(a) }, end: function () { } }, h.pt.space = function (a) { var b = this, a = a || "", c = b.index, d = b.config, e = d.dialog, f = -1 === e.type ? "" : '<span class="xubox_msg xulayer_png32 xubox_msgico xubox_msgtype' + e.type + '"></span>', h = ['<div class="xubox_dialog">' + f + '<span class="xubox_msg xubox_text" style="' + (f ? "" : "padding-left:20px") + '">' + e.msg + "</span></div>", '<div class="xubox_page">' + a + "</div>", '<iframe scrolling="' + d.iframe.scrolling + '" allowtransparency="true" id="' + g[1] + c + '" name="' + g[1] + c + '" onload="this.className=\'' + g[1] + '\'" class="' + g[1] + '" frameborder="0" src="' + d.iframe.src + '"></iframe>', '<span class="xubox_loading xubox_loading_' + d.loading.type + '"></span>', '<div class="xubox_tips" style="' + d.tips.style[0] + '"><div class="xubox_tipsMsg">' + d.tips.msg + '</div><i class="layerTipsG"></i></div>'], i = "", j = "", k = d.zIndex + c, l = "z-index:" + k + "; background-color:" + d.shade[1] + "; opacity:" + d.shade[0] + "; filter:alpha(opacity=" + 100 * d.shade[0] + ");"; d.shade[0] && (i = '<div times="' + c + '" id="xubox_shade' + c + '" class="xubox_shade" style="' + l + '"></div>'), d.zIndex = k; var m = "", n = "", o = "z-index:" + (k - 1) + ";  background-color: " + d.border[2] + "; opacity:" + d.border[1] + "; filter:alpha(opacity=" + 100 * d.border[1] + "); top:-" + d.border[0] + "px; left:-" + d.border[0] + "px;"; d.border[0] && (j = '<div id="xubox_border' + c + '" class="xubox_border" style="' + o + '"></div>'), !d.maxmin || 1 !== d.type && 2 !== d.type || /^\d+%$/.test(d.area[0]) && /^\d+%$/.test(d.area[1]) || (n = '<a class="xubox_min" href="javascript:;"><cite></cite></a><a class="xubox_max xulayer_png32" href="javascript:;"></a>'), d.closeBtn[1] && (n += '<a class="xubox_close xulayer_png32 xubox_close' + d.closeBtn[0] + '" href="javascript:;" style="' + (4 === d.type ? "position:absolute; right:-3px; _right:7px; top:-4px;" : "") + '"></a>'); var p = "object" == typeof d.title; return d.title && (m = '<div class="xubox_title" style="' + (p ? d.title[1] : "") + '"><em>' + (p ? d.title[0] : d.title) + "</em></div>"), [i, '<div times="' + c + '" showtime="' + d.time + '" style="z-index:' + k + '" id="' + g[0] + c + '" class="' + g[0] + '"><div style="background-color:' + d.bgcolor + "; z-index:" + k + '" class="xubox_main">' + h[d.type] + m + '<span class="xubox_setwin">' + n + '</span><span class="xubox_botton"></span></div>' + j + "</div>"] }, h.pt.creat = function () { var a = this, b = "", d = a.config, e = d.dialog, f = a.index, h = d.page, i = c("body"), j = function (d) { var d = d || ""; b = a.space(d), i.append(c(b[0])) }; switch (d.type) { case 0: d.title || (d.area = ["auto", "auto"]), c(".xubox_dialog")[0] && layer.close(c(".xubox_dialog").parents("." + g[0]).attr("times")); break; case 1: if ("" !== h.html) j('<div class="xuboxPageHtml">' + h.html + "</div>"), i.append(c(b[1])); else if ("" !== h.url) j('<div class="xuboxPageHtml" id="xuboxPageHtml' + f + '">' + h.html + "</div>"), i.append(c(b[1])), c.get(h.url, function (a) { c("#xuboxPageHtml" + f).html(a.toString()), h.ok && h.ok(a) }); else { if (0 != c(h.dom).parents(g[4]).length) return; j(), c(h.dom).show().wrap(c(b[1])) } break; case 3: d.title = !1, d.area = ["auto", "auto"], d.closeBtn = ["", !1], c(".xubox_loading")[0] && layer.closeLoad(); break; case 4: d.title = !1, d.area = ["auto", "auto"], d.fix = !1, d.border = [0], d.tips.more || layer.closeTips() } 1 !== d.type && (j(), i.append(c(b[1]))); var k = a.layerE = c("#" + g[0] + f); if (k.css({ width: d.area[0], height: d.area[1] }), d.fix || k.css({ position: "absolute" }), d.title && (3 !== d.type || 4 !== d.type)) { var l = 0 === d.type ? e : d, m = k.find(".xubox_botton"); switch (l.btn = d.btn || e.btn, l.btns) { case 0: m.html("").hide(); break; case 1: m.html('<a href="javascript:;" class="xubox_yes xubox_botton1">' + l.btn[0] + "</a>"); break; case 2: m.html('<a href="javascript:;" class="xubox_yes xubox_botton2">' + l.btn[0] + '</a><a href="javascript:;" class="xubox_no xubox_botton3">' + l.btn[1] + "</a>") } } "auto" === k.css("left") ? (k.hide(), setTimeout(function () { k.show(), a.set(f) }, 500)) : a.set(f), d.time <= 0 || a.autoclose(), a.callback() }, f.fade = function (a, b, c) { a.css({ opacity: 0 }).animate({ opacity: c }, b) }, h.pt.offset = function () { var a = this, b = a.config, c = a.layerE, e = c.outerHeight(); a.offsetTop = "" === b.offset[0] && e < d.height() ? (d.height() - e - 2 * b.border[0]) / 2 : -1 != b.offset[0].indexOf("px") ? parseFloat(b.offset[0]) : parseFloat(b.offset[0] || 0) / 100 * d.height(), a.offsetTop = a.offsetTop + b.border[0] + (b.fix ? 0 : d.scrollTop()), -1 != b.offset[1].indexOf("px") ? a.offsetLeft = parseFloat(b.offset[1]) + b.border[0] : (b.offset[1] = "" === b.offset[1] ? "50%" : b.offset[1], a.offsetLeft = "50%" === b.offset[1] ? b.offset[1] : parseFloat(b.offset[1]) / 100 * d.width() + b.border[0]) }, h.pt.set = function (a) { var b = this, e = b.config, h = (e.dialog, e.page), i = (e.loading, b.layerE), j = i.find(g[2]); switch (b.autoArea(a), e.title ? 0 === e.type && layer.ie6 && j.css({ width: i.outerWidth() }) : 4 !== e.type && i.find(".xubox_close").addClass("xubox_close1"), i.attr({ type: f.type[e.type] }), b.offset(), 4 !== e.type && (e.shift && !layer.ie6 ? "object" == typeof e.shift ? b.shift(e.shift[0], e.shift[1] || 500, e.shift[2]) : b.shift(e.shift, 500) : i.css({ top: b.offsetTop, left: b.offsetLeft })), e.type) { case 0: i.find(g[5]).css({ "background-color": "#fff" }), e.title ? i.find(g[3]).css({ paddingTop: 18 + j.outerHeight() }) : (i.find(".xubox_msgico").css({ top: 8 }), i.find(g[3]).css({ marginTop: 11 })); break; case 1: i.find(h.dom).addClass("layer_pageContent"), e.shade[0] && i.css({ zIndex: e.zIndex + 1 }), e.title && i.find(g[4]).css({ top: j.outerHeight() }); break; case 2: var k = i.find("." + g[1]), l = i.height(); k.addClass("xubox_load").css({ width: i.width() }), k.css(e.title ? { top: j.height(), height: l - j.height() } : { top: 0, height: l }), layer.ie6 && k.attr("src", e.iframe.src); break; case 4: var m = [0, i.outerHeight()], n = c(e.tips.follow), o = { width: n.outerWidth(), height: n.outerHeight(), top: n.offset().top, left: n.offset().left }, p = i.find(".layerTipsG"); e.tips.isGuide || p.remove(), i.outerWidth() > e.maxWidth && i.width(e.maxWidth), o.tipColor = e.tips.style[1], m[0] = i.outerWidth(), o.autoLeft = function () { o.left + m[0] - d.width() > 0 ? (o.tipLeft = o.left + o.width - m[0], p.css({ right: 12, left: "auto" })) : o.tipLeft = o.left }, o.where = [function () { o.autoLeft(), o.tipTop = o.top - m[1] - 10, p.removeClass("layerTipsB").addClass("layerTipsT").css({ "border-right-color": o.tipColor }) }, function () { o.tipLeft = o.left + o.width + 10, o.tipTop = o.top, p.removeClass("layerTipsL").addClass("layerTipsR").css({ "border-bottom-color": o.tipColor }) }, function () { o.autoLeft(), o.tipTop = o.top + o.height + 10, p.removeClass("layerTipsT").addClass("layerTipsB").css({ "border-right-color": o.tipColor }) }, function () { o.tipLeft = o.left - m[0] + 10, o.tipTop = o.top, p.removeClass("layerTipsR").addClass("layerTipsL").css({ "border-bottom-color": o.tipColor }) }], o.where[e.tips.guide](), 0 === e.tips.guide ? o.top - (d.scrollTop() + m[1] + 16) < 0 && o.where[2]() : 1 === e.tips.guide ? d.width() - (o.left + o.width + m[0] + 16) > 0 || o.where[3]() : 2 === e.tips.guide ? o.top - d.scrollTop() + o.height + m[1] + 16 - d.height() > 0 && o.where[0]() : 3 === e.tips.guide ? m[0] + 16 - o.left > 0 && o.where[1]() : 4 === e.tips.guide, i.css({ left: o.tipLeft, top: o.tipTop }) } e.fadeIn && (f.fade(i, e.fadeIn, 1), f.fade(c("#xubox_shade" + a), e.fadeIn, e.shade[0])), e.fix && "" === e.offset[0] && !e.shift && d.on("resize", function () { i.css({ top: (d.height() - i.outerHeight()) / 2 }) }), b.move() }, h.pt.shift = function (a, b, c) { var e = this, f = e.config, g = e.layerE, h = 0, i = d.width(), j = d.height() + (f.fix ? 0 : d.scrollTop()); h = "50%" == f.offset[1] || "" == f.offset[1] ? g.outerWidth() / 2 : g.outerWidth(); var k = { t: { top: e.offsetTop }, b: { top: j - g.outerHeight() - f.border[0] }, cl: h + f.border[0], ct: -g.outerHeight(), cr: i - h - f.border[0] }; switch (a) { case "left-top": g.css({ left: k.cl, top: k.ct }).animate(k.t, b); break; case "top": g.css({ top: k.ct }).animate(k.t, b); break; case "right-top": g.css({ left: k.cr, top: k.ct }).animate(k.t, b); break; case "right-bottom": g.css({ left: k.cr, top: j }).animate(c ? k.t : k.b, b); break; case "bottom": g.css({ top: j }).animate(c ? k.t : k.b, b); break; case "left-bottom": g.css({ left: k.cl, top: j }).animate(c ? k.t : k.b, b); break; case "left": g.css({ left: -g.outerWidth() }).animate({ left: e.offsetLeft }, b) } }, h.pt.autoArea = function (a) { var b, d = this, a = a || d.index, e = d.config, f = e.page, h = c("#" + g[0] + a), i = h.find(g[2]), j = h.find(g[5]), k = e.title ? i.innerHeight() : 0, l = 0; switch ("auto" === e.area[0] && j.outerWidth() >= e.maxWidth && h.css({ width: e.maxWidth }), e.type) { case 0: var m = h.find(".xubox_botton>a"); b = h.find(g[3]).outerHeight() + 20, m.length > 0 && (l = m.outerHeight() + 20); break; case 1: var n = h.find(g[4]); b = c(f.dom).outerHeight(), "auto" === e.area[0] && h.css({ width: n.outerWidth() }), ("" !== f.html || "" !== f.url) && (b = n.outerHeight()); break; case 2: h.find("iframe").css({ width: h.outerWidth(), height: h.outerHeight() - (e.title ? i.innerHeight() : 0) }); break; case 3: var o = h.find(".xubox_loading"); b = o.outerHeight(), j.css({ width: o.width() }) } "auto" === e.area[1] && j.css({ height: k + b + l }), c("#xubox_border" + a).css({ width: h.outerWidth() + 2 * e.border[0], height: h.outerHeight() + 2 * e.border[0] }), layer.ie6 && "auto" !== e.area[0] && j.css({ width: h.outerWidth() }), h.css("50%" !== e.offset[1] && "" != e.offset[1] || 4 === e.type ? { marginLeft: 0 } : { marginLeft: -h.outerWidth() / 2 }) }, h.pt.move = function () { var a = this, b = a.config, e = { setY: 0, moveLayer: function () { if (0 == parseInt(e.layerE.css("margin-left"))) var a = parseInt(e.move.css("left")); else var a = parseInt(e.move.css("left")) + -parseInt(e.layerE.css("margin-left")); "fixed" !== e.layerE.css("position") && (a -= e.layerE.parent().offset().left, e.setY = 0), e.layerE.css({ left: a, top: parseInt(e.move.css("top")) - e.setY }) } }, f = a.layerE.find(b.move); b.move && f.attr("move", "ok"), f.css(b.move ? { cursor: "move" } : { cursor: "auto" }), c(b.move).on("mousedown", function (a) { if (a.preventDefault(), "ok" === c(this).attr("move")) { e.ismove = !0, e.layerE = c(this).parents("." + g[0]); var f = e.layerE.offset().left, h = e.layerE.offset().top, i = e.layerE.width() - 6, j = e.layerE.height() - 6; c("#xubox_moves")[0] || c("body").append('<div id="xubox_moves" class="xubox_moves" style="left:' + f + "px; top:" + h + "px; width:" + i + "px; height:" + j + 'px; z-index:2147483584"></div>'), e.move = c("#xubox_moves"), b.moveType && e.move.css({ opacity: 0 }), e.moveX = a.pageX - e.move.position().left, e.moveY = a.pageY - e.move.position().top, "fixed" !== e.layerE.css("position") || (e.setY = d.scrollTop()) } }), c(document).mousemove(function (a) { if (e.ismove) { var c = a.pageX - e.moveX, f = a.pageY - e.moveY; if (a.preventDefault(), !b.moveOut) { e.setY = d.scrollTop(); var g = d.width() - e.move.outerWidth() - b.border[0], h = b.border[0] + e.setY; c < b.border[0] && (c = b.border[0]), c > g && (c = g), h > f && (f = h), f > d.height() - e.move.outerHeight() - b.border[0] + e.setY && (f = d.height() - e.move.outerHeight() - b.border[0] + e.setY) } e.move.css({ left: c, top: f }), b.moveType && e.moveLayer(), c = null, f = null, g = null, h = null } }).mouseup(function () { try { e.ismove && (e.moveLayer(), e.move.remove()), e.ismove = !1 } catch (a) { e.ismove = !1 } b.moveEnd && b.moveEnd() }) }, h.pt.autoclose = function () { var a = this, b = a.config.time, c = function () { b--, 0 === b && (layer.close(a.index), clearInterval(a.autotime)) }; a.autotime = setInterval(c, 1e3) }, f.config = { end: {} }, h.pt.callback = function () { var a = this, b = a.layerE, d = a.config, e = d.dialog; a.openLayer(), a.config.success(b), layer.ie6 && a.IE6(b), b.find(".xubox_close").on("click", function () { d.close(a.index), layer.close(a.index) }), b.find(".xubox_yes").on("click", function () { d.yes ? d.yes(a.index) : e.yes(a.index) }), b.find(".xubox_no").on("click", function () { d.no ? d.no(a.index) : e.no(a.index), layer.close(a.index) }), a.config.shadeClose && c("#xubox_shade" + a.index).on("click", function () { layer.close(a.index) }), b.find(".xubox_min").on("click", function () { layer.min(a.index, d), d.min && d.min(b) }), b.find(".xubox_max").on("click", function () { c(this).hasClass("xubox_maxmin") ? (layer.restore(a.index), d.restore && d.restore(b)) : (layer.full(a.index, d), d.full && d.full(b)) }), f.config.end[a.index] = d.end }, f.reselect = function () { c.each(c("select"), function () { var a = c(this); a.parents("." + g[0])[0] || 1 == a.attr("layer") && c("." + g[0]).length < 1 && a.removeAttr("layer").show(), a = null }) }, h.pt.IE6 = function (a) { var b = this, e = a.offset().top; if (b.config.fix) var f = function () { a.css({ top: d.scrollTop() + e }) }; else var f = function () { a.css({ top: e }) }; f(), d.scroll(f), c.each(c("select"), function () { var a = c(this); a.parents("." + g[0])[0] || "none" == a.css("display") || a.attr({ layer: "1" }).hide(), a = null }) }, h.pt.openLayer = function () { { var a = this; a.layerE } layer.autoArea = function (b) { return a.autoArea(b) }, layer.shift = function (b, c, d) { a.shift(b, c, d) }, layer.setMove = function () { return a.move() }, layer.zIndex = a.config.zIndex, layer.setTop = function (a) { var b = function () { layer.zIndex++, a.css("z-index", layer.zIndex + 1) }; return layer.zIndex = parseInt(a[0].style.zIndex), a.on("mousedown", b), layer.zIndex } }, f.isauto = function (a, b, c) { "auto" === b.area[0] && (b.area[0] = a.outerWidth()), "auto" === b.area[1] && (b.area[1] = a.outerHeight()), a.attr({ area: b.area + "," + c }), a.find(".xubox_max").addClass("xubox_maxmin") }, f.rescollbar = function (a) { g.html.attr("layer-full") == a && (g.html[0].style.removeProperty ? g.html[0].style.removeProperty("overflow") : g.html[0].style.removeAttribute("overflow"), g.html.removeAttr("layer-full")) }, layer.getIndex = function (a) { return c(a).parents("." + g[0]).attr("times") }, layer.getChildFrame = function (a, b) { return b = b || c("." + g[1]).parents("." + g[0]).attr("times"), c("#" + g[0] + b).find("." + g[1]).contents().find(a) }, layer.getFrameIndex = function (a) { return c(a ? "#" + a : "." + g[1]).parents("." + g[0]).attr("times") }, layer.iframeAuto = function (a) { a = a || c("." + g[1]).parents("." + g[0]).attr("times"); var b = layer.getChildFrame("body", a).outerHeight(), d = c("#" + g[0] + a), e = d.find(g[2]), f = 0; e && (f = e.height()), d.css({ height: b + f }); var h = -parseInt(c("#xubox_border" + a).css("top")); c("#xubox_border" + a).css({ height: b + 2 * h + f }), c("#" + g[1] + a).css({ height: b }) }, layer.iframeSrc = function (a, b) { c("#" + g[0] + a).find("iframe").attr("src", b) }, layer.area = function (a, b) { var d = [c("#" + g[0] + a), c("#xubox_border" + a)], e = d[0].attr("type"), h = d[0].find(g[5]), i = d[0].find(g[2]); if (e === f.type[1] || e === f.type[2]) { if (d[0].css(b), h.css({ width: b.width, height: b.height }), e === f.type[2]) { var j = d[0].find("iframe"); j.css({ width: b.width, height: i ? b.height - i.innerHeight() : b.height }) } "0px" !== d[0].css("margin-left") && (b.hasOwnProperty("top") && d[0].css({ top: b.top - (d[1][0] ? parseFloat(d[1].css("top")) : 0) }), b.hasOwnProperty("left") && d[0].css({ left: b.left + d[0].outerWidth() / 2 - (d[1][0] ? parseFloat(d[1].css("left")) : 0) }), d[0].css({ marginLeft: -d[0].outerWidth() / 2 })), d[1][0] && d[1].css({ width: parseFloat(b.width) - 2 * parseFloat(d[1].css("left")), height: parseFloat(b.height) - 2 * parseFloat(d[1].css("top")) }) } }, layer.min = function (a, b) { var d = c("#" + g[0] + a), e = [d.position().top, d.position().left + parseFloat(d.css("margin-left"))]; f.isauto(d, b, e), layer.area(a, { width: 180, height: 35 }), d.find(".xubox_min").hide(), "page" === d.attr("type") && d.find(g[4]).hide(), f.rescollbar(a) }, layer.restore = function (a) { { var b = c("#" + g[0] + a), d = b.attr("area").split(","); b.attr("type") } layer.area(a, { width: parseFloat(d[0]), height: parseFloat(d[1]), top: parseFloat(d[2]), left: parseFloat(d[3]) }), b.find(".xubox_max").removeClass("xubox_maxmin"), b.find(".xubox_min").show(), "page" === b.attr("type") && b.find(g[4]).show(), f.rescollbar(a) }, layer.full = function (a, b) { var e, h = c("#" + g[0] + a), i = 2 * b.border[0] || 6, j = [h.position().top, h.position().left + parseFloat(h.css("margin-left"))]; f.isauto(h, b, j), g.html.attr("layer-full") || g.html.css("overflow", "hidden").attr("layer-full", a), clearTimeout(e), e = setTimeout(function () { layer.area(a, { top: "fixed" === h.css("position") ? 0 : d.scrollTop(), left: "fixed" === h.css("position") ? 0 : d.scrollLeft(), width: d.width() - i, height: d.height() - i }) }, 100) }, layer.title = function (a, b) { var d = c("#" + g[0] + (b || layer.index)).find(".xubox_title>em"); d.html(a) }, layer.close = function (a) { var b = c("#" + g[0] + a), d = b.attr("type"), e = c("#xubox_moves, #xubox_shade" + a); if (b[0]) { if (d == f.type[1]) if (b.find(".xuboxPageHtml")[0]) b[0].innerHTML = "", b.remove(); else { b.find(".xubox_setwin,.xubox_close,.xubox_botton,.xubox_title,.xubox_border").remove(); for (var h = 0; 3 > h; h++) b.find(".layer_pageContent").unwrap().hide() } else b[0].innerHTML = "", b.remove(); e.remove(), layer.ie6 && f.reselect(), f.rescollbar(a), "function" == typeof f.config.end[a] && f.config.end[a](), delete f.config.end[a] } }, layer.closeLoad = function () { layer.close(c(".xubox_loading").parents("." + g[0]).attr("times")) }, layer.closeTips = function () { layer.closeAll("tips") }, layer.closeAll = function (a) { c.each(c("." + g[0]), function () { var b = c(this), d = a ? b.attr("type") === a : 1; d && layer.close(b.attr("times")), d = null }) }, f.run = function () { c = jQuery, d = c(a), g.html = c("html"), /* layer.use("skin/layer.css"),*/ c.layer = function (a) { var b = new h(a); return b.index } /*,(new Image).src = layer.path + "images/xubox_ico0.png"*/ }, /*"function" == typeof define ? define(function () { return f.run(), layer }) :*/ f.run()
}(window);

(function ($, undefined) { $.fn.placeholder = function (options) { var defaults = { labelMode: false, labelStyle: {}, labelAlpha: false, labelAcross: false }; var params = $.extend({}, defaults, options || {}); var funLabelAlpha = function (elementEditable, elementCreateLabel) { if (elementEditable.val() === "") { elementCreateLabel.css("opacity", 0.4).html(elementEditable.data("placeholder")) } else { elementCreateLabel.html("") } }, funPlaceholder = function (ele) { if (document.querySelector) { return $(ele).attr("placeholder") } else { var ret; ret = ele.getAttributeNode("placeholder"); return ret && ret.nodeValue !== "" ? ret.nodeValue : undefined } }; $(this).each(function () { var element = $(this), isPlaceholder = "placeholder" in document.createElement("input"), placeholder = funPlaceholder(this); if (!placeholder || (!params.labelMode && isPlaceholder) || (params.labelMode && !params.labelAcross && isPlaceholder)) { return } element.data("placeholder", placeholder); if (params.labelMode) { var idElement = element.attr("id"), elementLabel = null; if (!idElement) { idElement = "placeholder" + Math.random(); element.attr("id", idElement) } elementLabel = $('<label for="' + idElement + '"></label>').css($.extend({ lineHeight: "1.3", position: "absolute", color: "graytext", cursor: "text", marginLeft: element.css("marginLeft"), marginTop: element.css("marginTop"), paddingLeft: element.css("paddingLeft"), paddingTop: element.css("paddingTop") }, params.labelStyle)).insertBefore(element); if (params.labelAlpha) { element.bind({ "focus": function () { funLabelAlpha($(this), elementLabel) }, "input": function () { funLabelAlpha($(this), elementLabel) }, "blur": function () { if (this.value === "") { elementLabel.css("opacity", 1).html(placeholder) } } }); if (!window.screenX) { element.get(0).onpropertychange = function (event) { event = event || window.event; if (event.propertyName == "value") { funLabelAlpha(element, elementLabel) } } } elementLabel.get(0).oncontextmenu = function () { element.trigger("focus"); return false } } else { element.bind({ "focus": function () { elementLabel.html("") }, "blur": function () { if ($(this).val() === "") { elementLabel.html(placeholder) } } }) } if (params.labelAcross) { element.removeAttr("placeholder") } if (element.val() === "") { elementLabel.html(placeholder) } } else { element.bind({ "focus": function () { if ($(this).val() === placeholder) { $(this).val("") } $(this).css("color", "") }, "blur": function () { if ($(this).val() === "") { $(this).val(placeholder).css("color", "graytext") } } }); if (element.val() === "") { element.val(placeholder).css("color", "graytext") } } }); return $(this) } })(jQuery);

; var fnShareInit = function (aImgs, cId, sUrl, qqTitle, rrTitle, wbTitle) {
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
            //请求生成商品二维码
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
            //alert("qq分享不能分享Localhost的url，所以开发环境不行，但线上环境可以。");
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
}
; var oCookie = {
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
};

; (function ($) {
    $.fn.scrollLoading = function (options) {
        var defaults = {
            attr: "data-loadsrc"
        };
        var params = $.extend({}, defaults, options || {});
        params.cache = [];
        $(this).each(function () {
            var jqThis = $(this);
            jqThis.css("opacity", 0.5);
            var node = this.nodeName.toLowerCase(), url = jqThis.attr(params["attr"]);
            jqThis.removeAttr(params["attr"]);
            if (!url) { return; }
            //重组
            var data = {
                obj: jqThis,
                tag: node,
                url: url
            };
            params.cache.push(data);
        });

        //动态显示数据
        var loading = function (chk) {
            var st = $(window).scrollTop(), sth = st + $(window).height();
            $.each(params.cache, function (i, data) {
                var o = data.obj, tag = data.tag, url = data.url;
                if (o) {
                    post = o.offset().top; posb = post + o.height();
                    if ((post > st && post < sth) || (posb > st && posb < sth)) {
                        //在浏览器窗口内
                        //if (tag === "img") {
                        if (chk != 1) {
                            o.on("load", function () { o.animate({ opacity: 1 }, 300); });
                        }
                        else {
                            o.css("opacity", 1);
                        }
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

        //事件触发
        //加载完毕即执行
        loading(1);
        //滚动执行
        $(window).on("scroll", loading);
    };
})(jQuery);

if (typeof define == "function" && define.amd) {
    define("base", ["jquery"], function () {
        return {
            getMailLoginUrl: function (mail) {
                var hash = {
                    'qq.com': 'http://mail.qq.com',
                    'gmail.com': 'http://mail.google.com',
                    'sina.com': 'http://mail.sina.com.cn',
                    '163.com': 'http://mail.163.com',
                    '126.com': 'http://mail.126.com',
                    'yeah.net': 'http://www.yeah.net/',
                    'sohu.com': 'http://mail.sohu.com/',
                    'tom.com': 'http://mail.tom.com/',
                    'sogou.com': 'http://mail.sogou.com/',
                    '139.com': 'http://mail.10086.cn/',
                    'hotmail.com': 'http://www.hotmail.com',
                    'live.com': 'http://login.live.com/',
                    'live.cn': 'http://login.live.cn/',
                    'live.com.cn': 'http://login.live.com.cn',
                    '189.com': 'http://webmail16.189.cn/webmail/',
                    'yahoo.com.cn': 'http://mail.cn.yahoo.com/',
                    'yahoo.cn': 'http://mail.cn.yahoo.com/',
                    'eyou.com': 'http://www.eyou.com/',
                    '21cn.com': 'http://mail.21cn.com/',
                    '188.com': 'http://www.188.com/',
                    'foxmail.coom': 'http://www.foxmail.com'
                };
                var domain = mail.split('@')[1];

                var url = hash[domain];
                if (url == undefined) {
                    return "http://mail." + domain;
                } else {
                    return hash[domain];
                }
            },
            shareInit: fnShareInit,
            cookie: oCookie
        }
    });
}