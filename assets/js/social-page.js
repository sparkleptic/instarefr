var a2a_config = a2a_config || {};
a2a_config.vars = {
    vars: ["menu_type", "static_server", "linkmedia", "linkname", "linkurl", "linkname_escape", ["ssl", "http:" != document.location.protocol && "https://static.addtoany.com/menu"], "show_title", "onclick", "num_services", "hide_embeds", "prioritize", "exclude_services", "custom_services", ["templates", {}], "orientation", ["track_links", !1],
        ["track_links_key", ""], "awesm", "tracking_callback", "track_pub", "color_main", "color_bg", "color_border", "color_link_text", "color_link_text_hover", "color_arrow", "color_arrow_hover", ["localize", "", 1],
        ["add_services", !1, 1], "locale", "delay", "icon_color", "no_3p", "show_menu", "target"
    ],
    process: function() {
        for (var a, b, c, d, e, f = a2a_config.vars.vars, g = 0, h = "a2a_", i = f.length; g < i; g++)
            if ("string" == typeof f[g] ? (a = f[g], b = window[h + a], d = !1) : (a = f[g][0], b = window[h + a], c = f[g][1], d = !0, e = f[g][2]), "undefined" != typeof b && null != b) {
                if (a2a_config[a] = b, !e) try {
                    delete window[h + a]
                } catch (j) {
                    window[h + a] = null
                }
            } else d && !a2a_config[a] && (a2a_config[a] = c)
    }
}, a2a_config.vars.process(), a2a_config.static_server = a2a_config.static_server || "https://static.addtoany.com/menu";
var a2a = a2a || {
    total: 0,
    kit_services: [],
    icons_img_url: a2a_config.static_server + "/icons.36.png",
    head_tag: document.getElementsByTagName("head")[0],
    canonical_url: function() {
        if (!document.querySelector) return !1;
        var a, b, c = document.querySelector('meta[property="og:url"]');
        return c ? a = c.content : (b = document.querySelector('link[rel="canonical"]'), a = !!b && b.href), a
    }(),
    ieo: function() {
        for (var a = -1, b = document.createElement("b"); b.innerHTML = "<!--[if gt IE " + ++a + "]>1<![endif]-->", +b.innerHTML;);
        return a2a.ieo = function() {
            return a
        }, a
    },
    quirks: document.compatMode && "BackCompat" == document.compatMode ? 1 : null,
    has_touch: "ontouchend" in window,
    has_pointer: navigator.msPointerEnabled,
    fn_queue: [],
    dom: {
        isReady: !1,
        ready: function(a) {
            var b = function() {
                    return document.body ? (a(), void(a2a.dom.isReady = !0)) : setTimeout(a2a.dom.ready(a))
                },
                c = function(a) {
                    (document.addEventListener || "load" === a.type || "complete" === document.readyState) && (d(), b())
                },
                d = function() {
                    document.addEventListener ? (document.removeEventListener("DOMContentLoaded", c, !1), window.removeEventListener("load", c, !1)) : (document.detachEvent("onreadystatechange", c), window.detachEvent("onload", c))
                };
            if ("complete" === document.readyState) b();
            else if (document.addEventListener) document.addEventListener("DOMContentLoaded", c, !1), window.addEventListener("load", c, !1);
            else {
                document.attachEvent("onreadystatechange", c), window.attachEvent("onload", c);
                var e = !1;
                try {
                    e = null == window.frameElement && document.documentElement
                } catch (f) {}
                e && e.doScroll && ! function g() {
                    if (!a2a.dom.isReady) {
                        try {
                            e.doScroll("left")
                        } catch (a) {
                            return setTimeout(g, 50)
                        }
                        d(), b()
                    }
                }()
            }
        }
    },
    init: function(a, b, c) {
        var d, e, f, g, h = a2a.c,
            b = b || {},
            i = {},
            j = null,
            k = {},
            l = location.href,
            m = function(a, b) {
                a2a.total++, a2a.n = a2a.total, a2a["n" + a2a.n] = a;
                var c, d, e = a.node = a2a.set_this_index(a.node),
                    f = document.createElement("div"),
                    g = a2a.getData(e)["a2a-media"],
                    h = a2a.getData(e)["a2a-title"],
                    i = a2a.getData(e)["a2a-url"];
                return e ? (a.linkname_escape && (d = a2a.getByClass("a2a_linkname_escape", e.parentNode)[0] || a2a.getByClass("a2a_linkname_escape", e.parentNode.parentNode)[0], d && (a.linkname = d.textContent || d.innerText)), a.linkmedia = b.linkmedia = g || a.linkmedia, a.linkname = b.linkname = h || a.linkname, a.linkurl = b.linkurl = i || a.linkurl, h && (a.linkname_implicit = !1), i && (a.linkurl_implicit = !1), "textContent" in document ? f.textContent = a.linkname : f.innerText = a.linkname, c = f.childNodes[0], c && (a.linkname = c.nodeValue), delete f, void(e.a2a_kit ? a2a.kit(a, b) : a2a.button(a))) : void(a2a.c.show_menu || a2a.total--)
            };
        a2a.make_once(a);
        for (var n in b) h[n] = b[n];
        for (var n in h) i[n] = h[n];
        if (e = h.target)
            if ("string" == typeof e) {
                if (f = e.substr(0, 1), g = e.substr(1), "." == f) return a2a.multi_init(a2a.HTMLcollToArray(a2a.getByClass(g, document)), a, b), void(h.target = !1);
                j = a2a.gEl(g), d = j.className, d.indexOf("a2a_kit") >= 0 && d.indexOf("a2a_target") < 0 && (j = null)
            } else j = h.target;
        a = h.menu_type ? "mail" : a, a && (a2a.type = a, h.vars.process()), k.type = a2a.type, k.node = j, k.linkmedia = h.linkmedia, k.linkname = h.linkname || document.title || location.href, k.linkurl = h.linkurl || location.href, k.linkname_escape = h.linkname_escape, k.linkname_implicit = !h.linkname_escape && (document.title || l) == k.linkname, k.linkurl_implicit = l == k.linkurl, k.orientation = h.orientation || !1, k.track_links = h.track_links || !1, k.track_links_key = h.track_links_key || "", k.track_pub = h.track_pub || !1, h.linkmedia = h.linkname = h.linkurl = h.onclick = h.linkname_escape = h.show_title = h.custom_services = h.exclude_services = h.orientation = h.num_services = h.track_pub = h.target = !1, "custom" == h.track_links && (h.track_links = !1, h.track_links_key = ""), a2a.last_type = a2a.type, window["a2a" + a2a.type + "_init"] = 1, a2a.locale && !c ? a2a.fn_queue.push(function(a, b) {
            return function() {
                m(a, b)
            }
        }(k, i)) : (m(k, i), h.menu_type = !1, a2a.init_show())
    },
    init_all: function(a) {
        var b = a2a.unindexed(function(b) {
            b.className.indexOf("a2a_follow") >= 0 ? a2a.init("feed") : a2a.init(a)
        }, !0);
        !b && a2a.gEl("a2a_menu_container") && a2a.init(a)
    },
    multi_init: function(a, b, c) {
        for (var d = 0, e = a.length; d < e; d++) c.target = a[d], a2a.init(b, c)
    },
    button: function(a) {
        var b = a.node,
            c = a.type,
            d = a2a.gEl("a2a" + c + "_dropdown"),
            e = "mousedown",
            f = "mouseup";
        b.getAttribute("onclick") && (b.getAttribute("onclick") + "").indexOf("a2a_") != -1 || b.getAttribute("onmouseover") && (b.getAttribute("onmouseover") + "").indexOf("a2a_") != -1 || (a2a.fast_click.make(b, function(a) {
            if (a2a.preventDefault(a), a2a.stopPropagation(a), "block" == d.style.display) {
                var e = a2a[c].time_open;
                a2a[c].onclick || e && "OK" == e ? a2a.toggle_dropdown("none", c) : (a2a[c].last_focus = document.activeElement, d.focus())
            } else a2a.show_menu(b), a2a[c].last_focus = document.activeElement, d.focus()
        }), a2a.has_touch ? (e = "touchstart", f = "touchend") : a2a.has_pointer && (e = "MSPointerDown", f = "MSPointerUp"), a2a.add_event(b, e, a2a.stopPropagation), a2a.add_event(b, f, function(a) {
            a2a.stopPropagation(a), a2a.touch_used = 1
        }), a2a[a2a.type].onclick || (a2a.c.delay ? b.onmouseover = function() {
            a2a[a2a.type].over_delay = setTimeout(function() {
                a2a.show_menu(b)
            }, a2a.c.delay)
        } : b.onmouseover = function() {
            a2a.show_menu(b)
        }, b.onmouseout = function() {
            a2a.onMouseOut_delay(), a2a[a2a.type].over_delay && clearTimeout(a2a[a2a.type].over_delay)
        })), "a" == b.tagName.toLowerCase() && "page" == a2a.type && (b.href = "https://www.addtoany.com/share#url=" + encodeURIComponent(a.linkurl) + "&title=" + encodeURIComponent(a.linkname).replace(/'/g, "%27"))
    },
    kit: function(a, b) {
        var c = a2a.type,
            d = {
                behance: {
                    name: "Behance",
                    icon: "behance",
                    color: "007EFF",
                    url: "https://www.behance.net/${id}"
                },
                facebook: {
                    name: "Facebook",
                    icon: "facebook",
                    color: "3B5998",
                    url: "https://www.facebook.com/${id}"
                },
                flickr: {
                    name: "Flickr",
                    icon: "flickr",
                    color: "FF0084",
                    url: "https://www.flickr.com/photos/${id}"
                },
                foursquare: {
                    name: "Foursquare",
                    icon: "foursquare",
                    color: "F94877",
                    url: "https://foursquare.com/${id}"
                },
                github: {
                    name: "GitHub",
                    icon: "github",
                    color: "2A2A2A",
                    url: "https://github.com/${id}"
                },
                google_plus: {
                    name: "Google+",
                    icon: "google_plus",
                    color: "DD4B39",
                    url: "https://plus.google.com/${id}"
                },
                instagram: {
                    name: "Instagram",
                    icon: "instagram",
                    color: "E4405F",
                    url: "https://www.instagram.com/${id}"
                },
                linkedin: {
                    name: "LinkedIn",
                    icon: "linkedin",
                    color: "007BB5",
                    url: "https://www.linkedin.com/in/${id}"
                },
                linkedin_company: {
                    name: "LinkedIn",
                    icon: "linkedin",
                    color: "007BB5",
                    url: "https://www.linkedin.com/company/${id}"
                },
                pinterest: {
                    name: "Pinterest",
                    icon: "pinterest",
                    color: "BD081C",
                    url: "https://www.pinterest.com/${id}"
                },
                snapchat: {
                    name: "Snapchat",
                    icon: "snapchat",
                    color: "2A2A2A",
                    url: "https://www.snapchat.com/add/${id}"
                },
                tumblr: {
                    name: "Tumblr",
                    icon: "tumblr",
                    color: "35465C",
                    url: "http://${id}.tumblr.com"
                },
                twitter: {
                    name: "Twitter",
                    icon: "twitter",
                    color: "55ACEE",
                    url: "https://twitter.com/${id}"
                },
                vimeo: {
                    name: "Vimeo",
                    icon: "vimeo",
                    color: "1AB7EA",
                    url: "https://vimeo.com/${id}"
                },
                youtube: {
                    name: "YouTube",
                    icon: "youtube",
                    color: "CD201F",
                    url: "https://www.youtube.com/user/${id}"
                },
                youtube_channel: {
                    name: "YouTube Channel",
                    icon: "youtube",
                    color: "CD201F",
                    url: "https://www.youtube.com/channel/${id}"
                }
            },
            e = function(a, b) {
                var c, e = i(a, {}),
                    f = e["a2a-follow"],
                    g = d[b];
                return f && g && (c = g.url.replace("${id}", f)), c || a.href
            },
            f = ["facebook_like", "twitter_tweet", "google_plusone", "google_plus_share", "pinterest_pin", "linkedin_share"],
            g = a2a.counters.avail,
            h = function(a, b) {
                if (a && !a2a.in_array(a, f))
                    for (var d = 0, e = b ? a2a[c].services : a2a.services, g = e.length; d < g; d++)
                        if (a == e[d][1]) return [e[d][0], e[d][2], e[d][3], e[d][4], e[d][5]];
                return !b && [a, a]
            },
            i = function(a, b) {
                for (var c, d = 0, e = a.attributes.length, f = b; d < e; d++) c = a.attributes[d], c.name && "data-" == c.name.substr(0, 5) && (f[c.name.substr(5)] = c.value);
                return f
            },
            j = function() {
                t = a.linkurl = a2a.getData(m)["a2a-url"] || t, v = a.linkname = a2a.getData(m)["a2a-title"] || v, w = a.linkmedia = a2a.getData(m)["a2a-media"] || w, a2a.linker(this)
            },
            k = function(b, c, d) {
                var e = {
                        node: c,
                        service: b,
                        title: v,
                        url: t
                    },
                    f = a2a.cbs("share", e);
                "undefined" != typeof f && (f.url && (a.linkurl = f.url, a.linkurl_implicit = !1), f.title && (a.linkname = f.title, a.linkname_implicit = !1), a2a.linker(c), f.stop && d && a2a.preventDefault(d))
            },
            l = a2a.c.templates,
            m = a.node,
            n = a2a.getData(m),
            o = m.a2a_follow,
            p = a2a.HTMLcollToArray(m.getElementsByTagName("a")),
            q = p.length,
            r = document.createElement("div"),
            s = encodeURIComponent,
            t = a.linkurl,
            u = s(a.linkurl).replace(/'/g, "%27"),
            v = a.linkname,
            w = (s(a.linkname).replace(/'/g, "%27"), a.linkmedia),
            x = (w ? s(a.linkmedia).replace(/'/g, "%27") : "", n["a2a-icon-color"] || a2a.c.icon_color),
            y = x ? x.split(",", 2) : x,
            z = y ? y[0] : y,
            A = y ? y[1] : y,
            B = m.className.match(/a2a_kit_size_([\w\.]+)(?:\s|$)/),
            C = B ? B[1] : "16",
            D = C + "px",
            E = "a2a_svg a2a_s__default a2a_s_",
            F = {},
            G = {},
            H = a.linkurl_implicit && a2a.canonical_url ? encodeURIComponent(a2a.canonical_url).replace(/'/g, "%27") : u,
            I = m.className.indexOf("a2a_vertical_style") >= 0;
        C && !isNaN(C) && (a2a.svg.load(), x && "unset" != x && a2a.svg.works() && (z && "unset" != z && (F.backgroundColor = z), A && "unset" != A.trim() && (A = A.trim())), m.style.lineHeight = G.height = G.lineHeight = D, G.width = 2 * C + "px", G.fontSize = "16px", I && (G.height = G.lineHeight = C / 2 + "px", G.fontSize = "10px", G.width = C + "px"), 32 != C && (F.backgroundSize = F.height = F.lineHeight = F.width = D, G.borderRadius = F.borderRadius = (.14 * C).toFixed() + "px", G.fontSize = (parseInt(G.height, 10) + (I ? 4 : 0)) / 2 + "px")), a2a.kit.facebook_like = function() {
            ea.href = t, ea.width = "90", ea.layout = "button_count", ea.ref = "addtoany", ea = i(O, ea), O.style.width = ea.width + "px";
            var a = function() {
                    FB.init({
                        appId: "0",
                        status: !1,
                        xfbml: !0,
                        version: "v2.3"
                    }), FB.Event.subscribe("edge.create", function(a, b) {
                        a2a.GA.track("Facebook Like", "facebook_like", a, "pages", "AddToAny Share/Save Button"), k("Facebook Like", O)
                    })
                },
                b = a2a.i18n();
            b = b ? b.replace(/-/g, "_") : "en_US", 2 == b.length && (b += "_" + b.toUpperCase());
            for (var c in ea) da += " data-" + c + '="' + ea[c] + '"';
            window.fbAsyncInit || (window.fbAsyncInit = a, K = document.createElement("span"), K.id = "fb-root", document.body.insertBefore(K, document.body.firstChild)), a2a.kit.facebook_like_script || ! function(a, c, d) {
                var e, f = a.getElementsByTagName(c)[0];
                a.getElementById(d) || (e = a.createElement(c), e.id = d, e.src = "//connect.facebook.net/" + b + "/sdk.js", f.parentNode.insertBefore(e, f))
            }(document, "script", "facebook-jssdk"), a2a.kit.facebook_like_script = 1, O.innerHTML = '<div class="fb-like"' + da + "></div>";
            try {
                FB.XFBML.parse(O)
            } catch (d) {}
        }, a2a.kit.twitter_tweet = function() {
            ea.url = t, ea.lang = a2a.i18n() || "en", ea.related = "AddToAny,micropat";
            var a = l.twitter,
                b = a ? a.lastIndexOf("@") : null;
            b && b !== -1 && (b++, b = a.substr(b).split(" ", 1), b = b[0].replace(/:/g, "").replace(/\//g, "").replace(/-/g, "").replace(/\./g, "").replace(/,/g, "").replace(/;/g, "").replace(/!/g, ""), ea.related = b + ",AddToAny"), ea = i(O, ea);
            var c = document.createElement("a");
            c.className = "twitter-share-button";
            for (var d in ea) c.setAttribute("data-" + d, ea[d]);
            O.appendChild(c), a2a.kit.twitter_tweet_script || ! function(a, b, c) {
                var d, e, f = a.getElementsByTagName(b)[0];
                a.getElementById(c) || (e = a.createElement(b), e.id = c, e.src = "//platform.twitter.com/widgets.js", f.parentNode.insertBefore(e, f), window.twttr = window.twttr || (d = {
                    _e: [],
                    ready: function(a) {
                        d._e.push(a)
                    }
                }))
            }(document, "script", "twitter-wjs"), a2a.kit.twitter_tweet_script = 1;
            try {
                twttr.ready(function(a) {
                    a2a.twitter_bind || (a.events.bind("click", function(a) {
                        if (a && "tweet" == a.region) {
                            var b = function() {
                                var b = a.target.src.split("#")[1] || "";
                                if (b && b.indexOf("url=") > -1) {
                                    for (var c = {}, d = b.split("&"), e = d.length, f = 0; f < e; f++) {
                                        var g = d[f].split("=");
                                        c[g[0]] = g[1]
                                    }
                                    return c
                                }
                                return !1
                            }();
                            b && b.url && (a2a.GA.track("Twitter Tweet", "twitter_tweet", unescape(b.url), "pages", "AddToAny Share/Save Button"), k("Twitter Tweet", O))
                        }
                    }), a2a.twitter_bind = 1), a.widgets && a.widgets.load()
                })
            } catch (e) {}
        }, a2a.kit.pinterest_pin = function() {
            ea["pin-config"] = "beside", ea["pin-do"] = "buttonPin", ea.media = w, ea.url = t, ea = i(O, ea);
            var a = document.createElement("a");
            for (var b in ea) a.setAttribute("data-" + b, ea[b]);
            "beside" == ea["pin-config"] && "buttonPin" == ea["pin-do"] && (O.style.width = "76px"), a.href = "//www.pinterest.com/pin/create/button/?url=" + ea.url + (ea.media ? "&media=" + ea.media : "") + (ea.description ? "&description=" + encodeURIComponent(ea.description).replace(/'/g, "%27") : ""), a2a.add_event(O, "click", function() {
                a2a.GA.track("Pinterest Pin", "pinterest_pin", t, "pages", "AddToAny Share/Save Button"), k("Pinterest Pin", O)
            }), O.appendChild(a), a2a.kit.pinterest_pin_script || ! function(a) {
                var b = a.createElement("script"),
                    c = a.getElementsByTagName("script")[0];
                b.type = "text/javascript", b.async = !0, b.src = "//assets.pinterest.com/js/pinit.js", c.parentNode.insertBefore(b, c)
            }(document), a2a.kit.pinterest_pin_script = 1
        }, a2a.kit.linkedin_share = function() {
            ea.counter = "right", ea.onsuccess = "a2a.kit.linkedin_share_event", ea.url = t, ea = i(O, ea);
            for (var a in ea) da += " data-" + a + '="' + ea[a] + '"';
            a2a.kit.linkedin_share_event = function() {
                a2a.GA.track("LinkedIn Share", "linkedin_share", t, "pages", "AddToAny Share/Save Button"), k("LinkedIn Share", O)
            }, a2a.kit.linkedin_share_script || ! function(a) {
                var b = a.createElement("script"),
                    c = a.getElementsByTagName("script")[0];
                b.type = "text/javascript", b.async = !0, b.src = "//platform.linkedin.com/in.js", c.parentNode.insertBefore(b, c)
            }(document), a2a.kit.linkedin_share_script = 1, O.innerHTML = '<script type="IN/Share"' + da + "></script>"
        }, a2a.kit.google_plus = function() {
            window.google_plus_cb_a2a = function(a) {
                a.state && "off" == a.state || (a2a.GA.track("Google +1", "google_plusone", a.href, "pages", "AddToAny Share/Save Button"), k("Google +1", O))
            }, ea.href = t, ea.size = "medium", ea.annotation = "bubble", "google_plus_share" == T && (ea.action = "share"), ea = i(O, ea);
            var a = a2a.i18n() || "en-US";
            window.___gcfg = window.___gcfg || {
                lang: a
            };
            for (var b in ea) da += " data-" + b + '="' + ea[b] + '"';
            O.innerHTML = '<div class="g-plus' + ("share" == ea.action ? "" : "one") + '" data-callback="google_plus_cb_a2a"' + da + "></div>", a2a.kit.google_plus_script || (! function(a) {
                var b = a.createElement("script"),
                    c = a.getElementsByTagName("script")[0];
                b.type = "text/javascript", b.async = !0, b.src = "https://apis.google.com/js/platform.js", c.parentNode.insertBefore(b, c)
            }(document), a2a.kit.google_plus_script = 1)
        }, a2a.kit.google_plusone = a2a.kit.google_plus_share = a2a.kit.google_plus;
        for (var J = 0; J < q; J++) {
            var K, L, M, N, O = p[J],
                P = O.className,
                Q = P.match(/a2a_button_([\w\.]+)(?:\s|$)/),
                R = P.indexOf("a2a_dd") >= 0,
                S = P.indexOf("a2a_counter") >= 0,
                T = !!Q && Q[1],
                U = O.childNodes,
                V = h(T),
                W = o && d[T] ? d[T].name : V[0],
                X = "_blank",
                Y = o && d[T] ? d[T].icon : V[1],
                Z = o && d[T] ? d[T].color : V[2] || "CAE0FF",
                $ = V[3] || {},
                _ = $.type,
                aa = V[4],
                ba = !1,
                ca = !1,
                da = "",
                ea = {};
            if (R ? (b.target = O, a2a.init(c, b, 1), T = "a2a", Z = "0166FF", Y = "a2a", ca = !!S && 1) : "feed" == T || "print" == T ? X = "" : S && T && a2a.in_array(T, g) ? ca = 1 : T && a2a.in_array(T, f) && (a2a.kit[T](), ba = 1), T && !ba) {
                if (R || (O.target = X, !o || !d[T] && h(T, !0) ? "feed" == T ? O.href = O.href || a.linkurl : (O.href = "/#" + T, a2a.add_event(O, "mousedown", j), a2a.add_event(O, "keydown", j), O.rel = "nofollow") : O.href = e(O, T), O.a2a = {}, O.a2a.customserviceuri = aa, O.a2a.stype = _, O.a2a.linkurl = a.linkurl, O.a2a.servicename = W, O.a2a.safename = T, $.src && (O.a2a.js_src = $.src), $.url && (O.a2a.url = $.url), $.pu && (O.a2a.popup = 1), $.media && (O.a2a.media = 1), o || a2a.add_event(O, "click", function(a, b, d, e, f) {
                        return function(g) {
                            var h = screen.height,
                                i = 550,
                                j = 450,
                                l = "event=service_click&url=" + s(location.href) + "&title=" + s(document.title || "") + "&ev_service=" + s(a) + "&ev_service_type=kit&ev_menu_type=" + c + "&ev_url=" + s(d) + "&ev_title=" + s(e).replace(/'/g, "%27");
                            k(b, f, g), f.a2a.popup && !a2a.defaultPrevented(g) && "javascript:" != f.href.substr(0, 11) && (a2a.preventDefault(g), window.open(f.href, "_blank", "toolbar=0,personalbar=0,resizable,scrollbars,status,width=550,height=450,top=" + (h > j ? Math.round(h / 2 - j / 2) : 40) + ",left=" + Math.round(screen.width / 2 - i / 2))), a2a.util_frame_post(c, l), a2a.GA.track(b, a, d, "pages", "AddToAny Share/Save Button")
                        }
                    }(T, W, t, v, O))), U.length) {
                    for (var fa, ga = 0, ha = U.length; ga < ha; ga++)
                        if (fa = U[ga].className, 1 == U[ga].nodeType && "a2a_label" != fa && (N = !0, "string" == typeof fa && fa.indexOf("a2a_count") >= 0)) {
                            M = !0;
                            break
                        }
                    if (!N) {
                        K = document.createElement("span"), K.className = E + Y + " a2a_img_text", Z && (K.style.backgroundColor = "#" + Z), L = a2a.svg.get(Y, K, A), "pending" !== L && (K.innerHTML = L);
                        for (var ia in F) K.style[ia] = F[ia];
                        O.insertBefore(K, U[0])
                    }
                } else {
                    K = document.createElement("span"), K.className = E + Y, Z && (K.style.backgroundColor = "#" + Z), L = a2a.svg.get(Y, K, A), "pending" !== L && (K.innerHTML = L);
                    for (var ia in F) K.style[ia] = F[ia];
                    O.appendChild(K), K = document.createElement("span"), K.className = "a2a_label", K.innerHTML = W || ("feed" == c ? a2a.c.localize.Subscribe : a2a.c.localize.Share), O.appendChild(K)
                }
                if (I && C && C < 20 && (ca = !1), ca && !M) {
                    K = document.createElement("span"), K.className = "a2a_count", K.a2a = {}, K.a2a.kit = m;
                    for (var ia in G) K.style[ia] = G[ia];
                    O.appendChild(K), R ? (a2a.counters.get("facebook", K, H), K.a2a.is_a2a_dd_counter = 1, m.a2a_dd_counter = K) : a2a.counters.get(T, K, H)
                }
                "a2a_dd" != P && a2a.kit_services.push(O)
            }
        }
        m.className.indexOf("a2a_default_style") >= 0 && (r.style.clear = "both", m.appendChild(r))
    },
    counters: {
        get: function(a, b, c) {
            var d, e, f = decodeURIComponent(c),
                g = a2a.counters[a],
                h = g.api,
                i = (g.cb, b.a2a.is_a2a_dd_counter);
            if (d = g[f] = g[f] || {}, "undefined" != typeof d.num) return void(i ? a2a.counters.sum(b, d.num, a) : a2a.counters.set(b, d.num, a));
            if (d.queued = d.queued || [], d.queued.push(b), g.n = g.n || 0, g.n++, g["cb" + g.n] = function(c) {
                    var e = a2a.counters[a].cb(c, b);
                    if ("undefined" != typeof e)
                        for (var f = 0; f < d.queued.length; f++) queued_count_element = d.queued[f], d.num = e, queued_count_element.a2a.is_a2a_dd_counter ? a2a.counters.sum(queued_count_element, e, a) : a2a.counters.set(queued_count_element, e, a)
                }, "linkedin" == a) {
                var j = "abcdefghijklmnopqrstuvwxyz".charAt(g.n - 1),
                    k = "=linkedinTempCounterCallbacks.cb" + j;
                window.linkedinTempCounterCallbacks = window.linkedinTempCounterCallbacks || {}, window.linkedinTempCounterCallbacks["cb" + j] = g["cb" + g.n]
            } else var k = "=a2a.counters." + a + ".cb" + g.n;
            1 == d.queued.length && (e = h[0] + c + (h[1] || "&callback") + k, a2a.dom.ready(function() {
                a2a.loadExtScript(e)
            }))
        },
        set: function(a, b, c) {
            a.innerHTML = "<span>" + a2a.counters.format(b) + "</span>", "a2a" != c && a2a.counters.sum(a, b, c)
        },
        sum: function(a, b, c) {
            var d = a.a2a.kit,
                e = d.a2a_counts_sum || 0,
                f = d.a2a_counts_summed;
            "a2a" == c || f && f.indexOf(c) != -1 || (e = d.a2a_counts_sum = e + b, f = d.a2a_counts_summed = f || [], f.push(c)), d.a2a_dd_counter && a2a.counters.set(d.a2a_dd_counter, e, "a2a")
        },
        format: function(a) {
            var b = 1e6,
                c = 1e3;
            return a > 999 && (a < b ? a > 1e4 ? a = (a / c).toFixed() + "k" : (a += "", a = a.charAt(0) + "," + a.substring(1)) : a = a < 1e9 ? (a / b).toFixed(a % b > 94999) + "M" : "1B+"), a
        },
        avail: ["facebook", "linkedin", "pinterest", "reddit", "tumblr"],
        facebook: {
            api: ["https://graph.facebook.com/?id=", "&callback"],
            cb: function(a, b) {
                return a && a.share && !isNaN(a.share.share_count) ? a.share.share_count : 0
            }
        },
        linkedin: {
            api: ["https://www.linkedin.com/countserv/count/share?url="],
            cb: function(a, b) {
                if (a && !isNaN(a.count)) return a.count
            }
        },
        pinterest: {
            api: ["https://widgets.pinterest.com/v1/urls/count.json?url="],
            cb: function(a, b) {
                if (a && !isNaN(a.count)) return a.count
            }
        },
        reddit: {
            api: ["https://www.reddit.com/api/info.json?url=", "&jsonp"],
            cb: function(a, b) {
                var c = a.data;
                if (a && c && c.children) {
                    for (var d, e = 0, f = [], g = c.children; e < g.length; e++) d = g[e].data, d && !isNaN(d.ups) && f.push(d.ups);
                    if (f.length > 0) return Math.max.apply(null, f)
                }
            }
        },
        tumblr: {
            api: ["https://api.tumblr.com/v2/share/stats?url="],
            cb: function(a, b) {
                if (a && a.response && !isNaN(a.response.note_count)) return a.response.note_count
            }
        },
        twitter: {
            api: ["https://cdn.api.twitter.com/1/urls/count.json?url="],
            cb: function(a, b) {
                if (a && !isNaN(a.count)) return a.count
            }
        }
    },
    init_show: function() {
        var a = a2a_config,
            b = a2a[a2a.type],
            c = a2a.show_menu;
        a.bookmarklet && (b.no_hide = 1, c()), a.show_menu && (b.no_hide = 1, c(!1, a.show_menu))
    },
    unindexed: function(a, b) {
        function c(b) {
            for (var c, d, e = 0, f = b.length; e < f; e++)
                if (c = b[e], ("undefined" == typeof c.a2a_index || "" === c.a2a_index) && c.className.indexOf("a2a_target") < 0 && c.parentNode.className.indexOf("a2a_kit") < 0 && (d = a(c)), d) return d;
            return null
        }
        return b ? c(a2a.getByClass("a2a_kit", document)) || c(a2a.HTMLcollToArray(document.getElementsByName("a2a_dd")).concat(a2a.getByClass("a2a_dd", document))) : void c(a2a.getByClass("a2a_kit", document).concat(a2a.getByClass("a2a_dd", document), a2a.HTMLcollToArray(document.getElementsByName("a2a_dd"))))
    },
    set_this_index: function(a) {
        function b(a) {
            return a.className.indexOf("a2a_kit") >= 0 && (a.a2a_kit = 1, void(a.className.indexOf("a2a_follow") >= 0 && (a.a2a_follow = 1)))
        }
        var c = a2a.n;
        return a ? (a.a2a_index = c, b(a), a) : a2a.unindexed(function(a) {
            return a.a2a_index = c, b(a), a
        }, !0)
    },
    gEl: function(a) {
        return document.getElementById(a)
    },
    getByClass: function(a, b, c) {
        return document.getElementsByClassName && /\{\s*\[native code\]\s*\}/.test("" + document.getElementsByClassName) ? a2a.getByClass = function(a, b, c) {
            b = b || a2a.gEl("a2a" + a2a.type + "_dropdown");
            for (var d, e = b.getElementsByClassName(a), f = c ? new RegExp("\\b" + c + "\\b", "i") : null, g = [], h = 0, i = e.length; h < i; h += 1) d = e[h], f && !f.test(d.nodeName) || g.push(d);
            return g
        } : document.evaluate ? a2a.getByClass = function(a, b, c) {
            c = c || "*", b = b || a2a.gEl("a2a" + a2a.type + "_dropdown");
            for (var d, e, f = a.split(" "), g = "", h = "http://www.w3.org/1999/xhtml", i = document.documentElement.namespaceURI === h ? h : null, j = [], k = 0, l = f.length; k < l; k += 1) g += "[contains(concat(' ',@class,' '), ' " + f[k] + " ')]";
            try {
                d = document.evaluate(".//" + c + g, b, i, 0, null)
            } catch (m) {
                d = document.evaluate(".//" + c + g, b, null, 0, null)
            }
            for (; e = d.iterateNext();) j.push(e);
            return j
        } : a2a.getByClass = function(a, b, c) {
            c = c || "*", b = b || a2a.gEl("a2a" + a2a.type + "_dropdown");
            for (var d, e, f = a.split(" "), g = [], h = "*" === c && b.all ? b.all : b.getElementsByTagName(c), i = [], j = 0, k = f.length; j < k; j += 1) g.push(new RegExp("(^|\\s)" + f[j] + "(\\s|$)"));
            for (var l = 0, m = h.length; l < m; l += 1) {
                d = h[l], e = !1;
                for (var n = 0, o = g.length; n < o && (e = g[n].test(d.className), e); n += 1);
                e && i.push(d)
            }
            return i
        }, a2a.getByClass(a, b, c)
    },
    HTMLcollToArray: function(a) {
        for (var b = [], c = a.length, d = 0; d < c; d++) b[b.length] = a[d];
        return b
    },
    add_event: function(a, b, c, d) {
        if (a.addEventListener) return a.addEventListener(b, c, d), {
            destroy: function() {
                a.removeEventListener(b, c, d)
            }
        };
        var e = function() {
            c.call(a, window.event)
        };
        return a.attachEvent("on" + b, e), {
            destroy: function() {
                a.detachEvent("on" + b, e)
            }
        }
    },
    fast_click: {
        make: function(a, b, c) {
            this.init(), this.make = function(a, b, c) {
                new this.FastButton(a, b, c)
            }, this.make(a, b, c)
        },
        init: function() {
            function a(a, b, c, d) {
                var e = a.attachEvent ? function(a) {
                    c.handleEvent(window.event, c)
                } : c;
                return a2a.add_event(a, b, e, d)
            }
            this.FastButton = function(b, c, d) {
                this.events = [], this.touchEvents = [], this.element = b, this.handler = c, this.useCapture = d, a2a.has_touch ? this.events.push(a(b, "touchstart", this, this.useCapture)) : a2a.has_pointer && (b.style.msTouchAction = "manipulation"), this.events.push(a(b, "click", this, this.useCapture))
            }, this.FastButton.prototype.destroy = function() {
                for (var a = this.events.length - 1; a >= 0; a -= 1) this.events[a].destroy();
                this.events = this.touchEvents = this.element = this.handler = this.fast_click = null
            }, this.FastButton.prototype.handleEvent = function(a) {
                switch (a.type) {
                    case "touchstart":
                        this.onTouchStart(a);
                        break;
                    case "touchmove":
                        this.onTouchMove(a);
                        break;
                    case "touchend":
                        this.onClick(a);
                        break;
                    case "click":
                        this.onClick(a)
                }
            }, this.FastButton.prototype.onTouchStart = function(b) {
                a2a.stopPropagation(b), this.touchEvents.push(a(this.element, "touchend", this, this.useCapture)), this.touchEvents.push(a(document.body, "touchmove", this, this.useCapture)), this.startX = b.touches[0].clientX, this.startY = b.touches[0].clientY
            }, this.FastButton.prototype.onTouchMove = function(a) {
                (Math.abs(a.touches[0].clientX - this.startX) > 10 || Math.abs(a.touches[0].clientY - this.startY) > 10) && this.reset()
            }, this.FastButton.prototype.onClick = function(a) {
                a2a.stopPropagation(a), this.reset();
                var b = this.handler.call(this.element, a);
                return "touchend" == a.type && a2a.fast_click.clickbuster.preventGhostClick(this.startX, this.startY), b
            }, this.FastButton.prototype.reset = function() {
                for (var a = this.touchEvents.length - 1; a >= 0; a -= 1) this.touchEvents[a].destroy();
                this.touchEvents = []
            }, this.clickbuster = {
                coordinates: [],
                preventGhostClick: function(a, b) {
                    this.coordinates.push(a, b), window.setTimeout(this.pop2, 2500)
                },
                pop2: function() {
                    a2a.fast_click.clickbuster.coordinates.splice(0, 2)
                },
                onClick: function(a) {
                    for (var b, c, d = 0, e = a2a.fast_click.clickbuster; d < e.coordinates.length; d += 2) b = e.coordinates[d], c = e.coordinates[d + 1], Math.abs(a.clientX - b) < 25 && Math.abs(a.clientY - c) < 25 && (a2a.stopPropagation(a), a2a.preventDefault(a))
                }
            }, a2a.has_touch && a2a.add_event(document, "click", this.clickbuster.onClick, !0)
        }
    },
    stopPropagation: function(a) {
        a || (a = window.event), a.cancelBubble = !0, a.stopPropagation && a.stopPropagation()
    },
    preventDefault: function(a) {
        a.preventDefault ? a.preventDefault() : a.returnValue = !1
    },
    defaultPrevented: function(a) {
        return !!(a.defaultPrevented || a.returnValue === !1 || "undefined" == typeof a.defaultPrevented && a.getPreventDefault && a.getPreventDefault())
    },
    onLoad: function(a) {
        var b = window.onload;
        "function" != typeof window.onload ? window.onload = a : window.onload = function() {
            b && b(), a()
        }
    },
    in_array: function(a, b, c, d, e) {
        if ("object" == typeof b) {
            a = a.toLowerCase();
            for (var f, g = b.length, h = 0; h < g; h++)
                if (f = d ? b[h][d] : b[h], f = e ? f[e] : f, c) {
                    if (a == f.toLowerCase()) return b[h]
                } else if (a.indexOf(f.toLowerCase()) != -1 && "" !== f) return b[h]
        }
        return !1
    },
    serialize: function(a, b) {
        var c = [];
        for (var d in a)
            if (a.hasOwnProperty(d)) {
                var e = b ? b + "[" + d + "]" : d,
                    f = a[d];
                c.push("object" == typeof f ? a2a.serialize(f, e) : encodeURIComponent(e) + "=" + encodeURIComponent(f))
            }
        return c.join("&")
    },
    onMouseOut_delay: function() {
        var a = a2a.type,
            b = a2a.gEl("a2a" + a + "_dropdown").style.display;
        "none" == b || "" == b || a2a[a].find_focused || a2a[a].service_focused || a2a.touch_used || (a2a[a].out_delay = setTimeout(function() {
            a2a.toggle_dropdown("none", a), a2a[a].out_delay = null
        }, 501))
    },
    onMouseOver_stay: function() {
        a2a[a2a.type].out_delay && clearTimeout(a2a[a2a.type].out_delay)
    },
    toggle_dropdown: function(a, b) {
        if ("none" != a || !a2a[b].no_hide) {
            var c, d = a2a.gEl,
                e = d("a2a" + b + "_dropdown"),
                f = d("a2a" + b + "_shim"),
                g = "mousedown",
                h = "mouseup",
                i = (document.activeElement, a2a.show_menu.key_listener);
            e.style.display = a, f && "none" == a2a.getStyle(d("a2a" + b + "_full"), "display") && (f.style.display = a), a2a.onMouseOver_stay(), "none" == a ? (window.addEventListener ? (a2a.has_touch ? (g = "touchstart", h = "touchend") : a2a.has_pointer && (g = "MSPointerDown", h = "MSPointerUp"), document.removeEventListener(g, a2a.doc_mousedown_check_scroll, !1), document.removeEventListener(h, a2a[b].doc_mouseup_toggle_dropdown, !1), a2a.touch_used = null) : (c = document.detachEvent, c("on" + g, a2a.doc_mousedown_check_scroll), c("on" + h, a2a[b].doc_mouseup_toggle_dropdown)), delete a2a[b].doc_mouseup_toggle_dropdown, i && i[b] && i[b].destroy()) : a2a[b].onclick || (a2a[b].time_open = setTimeout(function() {
                a2a[b].time_open = "OK"
            }, 501))
        }
    },
    getData: function(a) {
        if (!a) return {};
        for (var b, c = 0, d = a.attributes.length, e = {}; c < d; c++) b = a.attributes[c], b.name && "data-" == b.name.substr(0, 5) && (e[b.name.substr(5)] = b.value);
        return e
    },
    getStyle: function(a, b) {
        return a.currentStyle ? a.currentStyle[b.replace(/-(\w)/gi, function(a, b) {
            return b.toUpperCase()
        })] : window.getComputedStyle(a, null).getPropertyValue(b)
    },
    getPos: function(a) {
        var b, c = Math.round;
        return "undefined" == typeof a.getBoundingClientRect ? a2a.getPosOld(a) : (b = a.getBoundingClientRect(), {
            left: c(b.left + a2a.getScrollDocDims("w")),
            top: c(b.top + a2a.getScrollDocDims("h"))
        })
    },
    getPosOld: function(a) {
        var b = 0,
            c = 0;
        do b += a.offsetLeft || 0, c += a.offsetTop || 0, a = a.offsetParent; while (a);
        return {
            left: b,
            top: c
        }
    },
    getDocDims: function(a) {
        var b = 0,
            c = 0;
        return "number" == typeof window.innerWidth ? (b = window.innerWidth, c = window.innerHeight) : document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight) ? (b = document.documentElement.clientWidth, c = document.documentElement.clientHeight) : document.body && (document.body.clientWidth || document.body.clientHeight) && (b = document.body.clientWidth, c = document.body.clientHeight), "w" == a ? b : c
    },
    getScrollDocDims: function(a) {
        var b = 0,
            c = 0;
        return "number" == typeof window.pageYOffset ? (b = window.pageXOffset, c = window.pageYOffset) : document.body && (document.body.scrollLeft || document.body.scrollTop) ? (b = document.body.scrollLeft, c = document.body.scrollTop) : document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop) && (b = document.documentElement.scrollLeft, c = document.documentElement.scrollTop), "w" == a ? b : c
    },
    show_more_less: function(a) {
        a2a.onMouseOver_stay();
        var b = a2a.type,
            c = "a2a" + b,
            d = a2a.gEl;
        d(c + "_show_more_less");
        if (a2a.show_full(), a2a.embeds_fix(!0), 0 == a) return !1
    },
    focus_find: function() {
        var a = a2a.gEl("a2a" + a2a.type + "_find");
        "none" != a.parentNode.style.display && a.focus()
    },
    default_services: function(a) {
        for (var b = a || a2a.type, c = a2a[b].main_services_col_1, d = c.length, e = 0; e < d; e++) c[e].style.display = ""
    },
    do_find: function() {
        var a, b = a2a.type,
            c = a2a[b].main_services,
            d = c.length,
            e = a2a.gEl("a2a" + b + "_find").value,
            f = a2a.in_array;
        if ("" !== e) {
            a = e.split(" ");
            for (var g, h = 0; h < d; h++) g = c[h].a2a.serviceNameLowerCase, f(g, a, !1) ? c[h].style.display = "" : c[h].style.display = "none"
        } else a2a.default_services()
    },
    selection: function() {
        var a, b = document.getElementsByTagName("meta"),
            c = b.length;
        if (window.getSelection) a = window.getSelection();
        else if (document.selection) {
            try {
                a = document.selection.createRange()
            } catch (d) {
                a = ""
            }
            a = a.text ? a.text : ""
        }
        if (a && "" != a) return a;
        if (a2a["n" + a2a.n].linkurl == location.href)
            for (var e, f, g = 0; g < c; g++)
                if (e = b[g].getAttribute("name"), e && "description" == e.toLowerCase()) {
                    f = b[g].getAttribute("content");
                    break
                }
        return f ? f.substring(0, 1200) : ""
    },
    collections: function(a) {
        var b = a2a.gEl,
            c = a2a[a],
            d = "a2a" + a;
        c.main_services_col_1 = a2a.getByClass("a2a_i", b(d + "_full_services"), "a"), c.main_services = c.main_services_col_1, c.email_services = a2a.getByClass("a2a_i", b(d + "_2_col1", "a")), c.all_services = c.main_services.concat(c.email_services)
    },
    cbs: function(a, b) {
        var c = a2a.c.callbacks || [],
            d = a2a.c.tracking_callback,
            e = {};
        d && (d[a] ? c.push(d) : d[0] == a ? (e[a] = d[1], c.push(e)) : "function" == typeof d && (e[a] = d, c.push(e)), a2a.c.tracking_callback = null);
        for (var f, g = 0, h = c.length; g < h; g++)
            if (f = c[g][a], "function" == typeof f && (returned = f(b), "ready" == a && (f = null), "undefined" != typeof returned)) return returned
    },
    linker: function(a) {
        var b, c = location.href,
            d = document.title || c,
            e = a2a["n" + (a.parentNode.a2a_index || a2a.n)],
            f = e.type,
            g = e.linkurl,
            h = e.linkurl_implicit && c != g ? c : g,
            i = encodeURIComponent(h).replace(/'/g, "%27"),
            j = e.linkname,
            k = e.linkname_implicit && d != j ? d : j,
            l = encodeURIComponent(k).replace(/'/g, "%27"),
            m = e.linkmedia,
            n = !!m && encodeURIComponent(m).replace(/'/g, "%27"),
            o = encodeURIComponent(a2a.selection()).replace(/'/g, "%27"),
            p = !e.track_links || "page" != f && "mail" != f ? "" : "&linktrack=" + e.track_links + "&linktrackkey=" + encodeURIComponent(e.track_links_key),
            q = a.a2a.customserviceuri || !1,
            r = a.a2a.safename,
            s = a.a2a.stype,
            t = a.a2a.js_src,
            u = a.a2a.url,
            v = a.a2a.media,
            w = a2a.c.templates,
            x = a2a.c.ssl ? "s" : "";
        return v && n || (s && "js" == s && t ? (a.target = "", b = "javascript:" == t.substr(0, 11) ? t.replace("${link}", g) : 'javascript:a2a.loadExtScript("' + t + '")') : u && ("email" != r || "email" == r && a2a.has_touch) && !w[r] && !p ? (a.target = "", b = u.replace("${link}", i).replace("${link_noenc}", g).replace("${link_nohttp}", g.replace(/^https?:\/\//, "")).replace("${title}", l)) : q && "undefined" != q && (b = q.replace(/A2A_LINKNAME_ENC/, l).replace(/A2A_LINKURL_ENC/, i).replace(/A2A_LINKNOTE_ENC/, o))), a.href = b || "http" + x + "://www.addtoany.com/add_to/" + r + "?linkurl=" + i + "&linkname=" + l + (n ? "&linkmedia=" + n : "") + p + (a2a.c.awesm ? "&linktrack_parent=" + a2a.c.awesm : "") + ("twitter" == r && w[r] ? "&template=" + encodeURIComponent(w[r]) : "") + (("email" == r || s && "email" == s) && w.email ? "&" + a2a.serialize({
            template: w.email
        }) : "") + ("feed" == f ? "&type=feed" : "") + "&linknote=" + o, !0
    },
    show_full: function() {
        var a = a2a.type,
            b = "a2a" + a,
            c = a2a.gEl,
            d = a2a.getByClass,
            e = c(b + "_find"),
            f = c(b + "_overlay"),
            g = c(b + "_shim"),
            h = c(b + "_full"),
            i = d("a2a_full_header", h)[0],
            j = c(b + "_full_services"),
            k = d("a2a_full_footer", h)[0];
        h.classList && a2a.getStyle(f, "transition-duration") && (h.classList.add("a2a_starting"), f.classList.add("a2a_starting")), h.style.display = f.style.display = "block", g && (g.style.display = "block"),
            h.classList && setTimeout(function() {
                h.classList.remove("a2a_starting"), f.classList.remove("a2a_starting")
            }, 1), j.style.cssText = "height:calc(10px)", j.style.height.length && (j.style.height = "calc(100% - " + (i.offsetHeight + k.offsetHeight) + "px)"), h.focus(), a2a.show_full.key_listener = a2a.add_event(document, "keydown", function(b) {
                var b = b || window.event,
                    c = b.which || b.keyCode,
                    d = document.activeElement;
                27 == c && e != d ? a2a.hide_full(a) : c > 40 && c < 91 && e != d && e.focus()
            })
    },
    hide_full: function(a) {
        function b() {
            f.style.display = e.style.display = c(d + "_modal").style.display = "none", shim = c(d + "_shim"), shim && ("none" == a2a.getStyle(c(d + "_dropdown"), "display") ? shim.style.display = "none" : (a2a.embeds_fix(), c(d + "_show_more_less").focus())), a2a.show_full.key_listener.destroy(), setTimeout(function() {
                delete a2a.show_full.key_listener
            }, 1), f.addEventListener && f.removeEventListener("transitionend", b, !1)
        }
        var c = a2a.gEl,
            d = "a2a" + a,
            e = c(d + "_full"),
            f = c(d + "_overlay");
        e.classList && a2a.getStyle(f, "transition-duration") ? (f.addEventListener("transitionend", b, !1), e.classList.add("a2a_starting"), f.classList.add("a2a_starting")) : b()
    },
    show_menu: function(a, b) {
        a ? a2a.n = a.a2a_index : (a2a.n = a2a.total, a2a[a2a.type].no_hide = 1);
        var c = a2a["n" + a2a.n],
            d = a2a.type = c.type,
            e = "a2a" + d,
            f = a2a.gEl(e + "_dropdown"),
            g = "mousedown",
            h = "mouseup";
        a2a.gEl(e + "_title").value = c.linkname, a2a.toggle_dropdown("block", d);
        var i, j, k, l, m = [f.clientWidth, f.clientHeight],
            n = a2a.getDocDims("w"),
            o = a2a.getDocDims("h"),
            p = a2a.getScrollDocDims("w"),
            q = a2a.getScrollDocDims("h");
        a ? (i = a.getElementsByTagName("img")[0], i ? (j = a2a.getPos(i), k = i.clientWidth, l = i.clientHeight) : (j = a2a.getPos(a), k = a.offsetWidth, l = a.offsetHeight), j.left - p + m[0] + k > n && (j.left = j.left - m[0] + k - 8), ("up" == c.orientation || "down" != c.orientation && j.top - q + m[1] + l > o && j.top > m[1]) && (j.top = j.top - m[1] - l), f.style.left = (j.left < 0 ? 0 : j.left) + 2 + "px", f.style.top = j.top + l + "px", a2a.embeds_fix()) : (b || (b = {}), f.style.position = b.position || "absolute", f.style.left = b.left || n / 2 - m[0] / 2 + "px", f.style.top = b.top || o / 2 - m[1] / 2 + "px"), a2a[d].doc_mouseup_toggle_dropdown || a2a[d].no_hide || (a2a.doc_mousedown_check_scroll = function() {
            a2a.last_scroll_pos = a2a.getScrollDocDims("h")
        }, a2a[d].doc_mouseup_toggle_dropdown = function(a) {
            return function() {
                a2a.last_scroll_pos == a2a.getScrollDocDims("h") && (a2a[d].last_focus && a2a[d].last_focus.focus(), a2a.toggle_dropdown("none", a))
            }
        }(d), window.addEventListener ? (a2a.has_touch ? (g = "touchstart", h = "touchend") : a2a.has_pointer && (g = "MSPointerDown", h = "MSPointerUp"), document.addEventListener(g, a2a.doc_mousedown_check_scroll, !1), document.addEventListener(h, a2a[d].doc_mouseup_toggle_dropdown, !1)) : (document.attachEvent("on" + g, a2a.doc_mousedown_check_scroll), document.attachEvent("on" + h, a2a[d].doc_mouseup_toggle_dropdown))), a2a.show_menu.key_listener = a2a.show_menu.key_listener || {}, a2a.show_menu.key_listener[d] = a2a.add_event(document, "keydown", function(a) {
            var a = a || window.event,
                b = a.which || a.keyCode;
            27 != b || a2a.show_full.key_listener || a2a.toggle_dropdown("none", d)
        }), a2a.svg.load();
        var r = encodeURIComponent,
            s = "event=menu_show&url=" + r(location.href) + "&title=" + r(document.title || "") + "&ev_menu_type=" + d;
        a2a.util_frame_post(d, s)
    },
    embeds_fix: function(a) {
        var b, c, d, e, f, g = a2a.gEl,
            h = a2a.type,
            i = "a2a" + h,
            j = g(i + "_shim");
        j || (j = document.createElement("iframe"), j.className = "a2a_shim", j.id = i + "_shim", j.title = "AddToAny Shim", j.setAttribute("frameBorder", "0"), j.setAttribute("src", 'javascript:"";'), j.tabIndex = -1, document.body.appendChild(j)), a ? (j.style.left = j.style.top = "0", j.style.width = "", j.style.height = "") : (b = g(i + "_dropdown"), c = parseInt(b.style.left), d = parseInt(b.style.top), e = b.clientWidth || b.offsetWidth, f = b.clientHeight || b.offsetHeight, j.style.left = c + "px", j.style.top = d + "px", j.style.width = e + "px", j.style.height = f + "px")
    },
    bmBrowser: function(a) {
        var b = a2a.c.localize.Bookmark,
            c = a2a["n" + a2a.n];
        if (document.all ? 1 == a ? b = a2a.c.localize.AddToYourFavorites : window.external.AddFavorite(c.linkurl, c.linkname) : 1 != a && (a2a.gEl("a2apage_note_BROWSER").innerHTML = '<div class="a2a_note_note">' + a2a.c.localize.BookmarkInstructions + "</div>"), 1 == a) return b
    },
    copyLink: function(a) {
        var b = "page",
            c = "a2a" + b,
            d = a2a.gEl,
            e = (a2a.getByClass, d(c + "_overlay")),
            f = (d(c + "_shim"), d(c + "_full")),
            g = d(c + "_modal"),
            h = d("a2a_copy_link_copied"),
            i = d("a2a_copy_link_text");
        a2a.copyLink.full_shown = "none" != a2a.getStyle(f, "display"), a2a.copyLink.clickListen || (a2a.add_event(i, "click", function(a) {
            i.setSelectionRange ? i.setSelectionRange(0, i.value.length) : i.select(), document.execCommand && document.execCommand("copy") && (h.style.display = "block", setTimeout(function() {
                g.style.display = h.style.display = "none", a2a.copyLink.full_shown ? f.style.display = "block" : a2a.hide_full(b)
            }, 700))
        }), a2a.copyLink.clickListen = 1), a2a.type = b, "none" == a2a.getStyle(e, "display") && a2a.show_full(), f.style.display = "none", i.value = a, e.style.display = g.style.display = "block", g.focus()
    },
    loadExtScript: function(a, b, c) {
        var d = document.createElement("script");
        if (d.charset = "UTF-8", d.src = a, document.body.appendChild(d), "function" == typeof b) var e = setInterval(function() {
            var a = !1;
            try {
                a = b.call()
            } catch (d) {}
            a && (clearInterval(e), c.call())
        }, 100)
    },
    track: function(a) {
        var b = new Image(1, 1);
        b.src = a, b.width = 1, b.height = 1
    },
    GA: function(a) {
        var b = window,
            c = a2a.type,
            d = function() {
                if ("function" == typeof urchinTracker) a2a.GA.track = function(a, b, c, d, e) {
                    urchinTracker("/addtoany.com/" + d), urchinTracker("/addtoany.com/" + d + "/" + (c || a2a["n" + a2a.n].linkurl)), urchinTracker("/addtoany.com/services/" + b)
                };
                else if ("object" == typeof pageTracker) a2a.GA.track = function(a, b, d, e, f) {
                    "feed" != c && pageTracker._trackSocial("AddToAny", a, d || a2a["n" + a2a.n].linkurl), pageTracker._trackEvent(f, a, d || a2a["n" + a2a.n].linkurl)
                };
                else if ("object" == typeof _gaq) a2a.GA.track = function(a, b, d, e, f) {
                    "feed" != c && _gaq.push(["_trackSocial", "AddToAny", a, d || a2a["n" + a2a.n].linkurl]), _gaq.push(["_trackEvent", f, a, d || a2a["n" + a2a.n].linkurl])
                };
                else {
                    if ("string" != typeof GoogleAnalyticsObject) return;
                    a2a.GA.track = function(a, d, e, f, g) {
                        "feed" != c && b[GoogleAnalyticsObject]("send", "social", "AddToAny", a, {
                            page: e || a2a["n" + a2a.n].linkurl
                        }), b[GoogleAnalyticsObject]("send", "event", g, a, e || a2a["n" + a2a.n].linkurl)
                    }
                }
            };
        a2a.GA.track = function() {}, a || /loaded|complete/.test(document.readyState) ? d() : a2a.onLoad(d)
    },
    add_services: function() {
        var a, b = a2a.type,
            c = a2a.gEl,
            d = parseInt(a2a[b].num_services),
            e = c("a2a" + b + "_full_services"),
            f = c("a2a" + b + "_mini_services");
        if (a2a[b].custom_services) {
            var g = a2a[b].custom_services,
                h = g.length,
                i = a2a.make_service,
                j = 0;
            g.reverse();
            for (var k, l = 0; l < h; l++) g[l] && (j += 1, k = i(g[l][0], g[l][0].replace(" ", "_"), !1, null, {}, g[l][1], g[l][2]), e.insertBefore(k, e.firstChild), k = i(g[l][0], g[l][0].replace(" ", "_"), !1, null, {}, g[l][1], g[l][2]), f.insertBefore(k, f.firstChild))
        }
        if ("page" == b && a2a.c.add_services)
            for (var g = a2a.c.add_services, h = g.length, i = a2a.make_service, j = 0, m = a2a.c.ssl, l = 0; l < h; l++) g[l] && (j += 1, m && (g[l].icon = !1), k = i(g[l].name, g[l].safe_name, !1, null, {}, !1, g[l].icon), e.insertBefore(k, e.firstChild), k = i(g[l].name, g[l].safe_name, !1, null, {}, !1, g[l].icon), f.insertBefore(k, f.firstChild));
        if (a = a2a.getByClass("a2a_i", f, "a"), a.length > d)
            for (var l = 0, n = a.length; l < n - d; l++) f.removeChild(f.lastChild)
    },
    util_frame_make: function(a) {
        var b = document.createElement("iframe"),
            c = document.createElement("div"),
            d = encodeURIComponent,
            e = document.referrer ? d(document.referrer) : "",
            f = d(location.href),
            g = (d(document.title || ""), navigator.browserLanguage || navigator.language, a2a.c.no_3p ? "&no_3p=1" : "");
        b.id = "a2a" + a + "_sm_ifr", b.width = b.height = 1, b.style.width = b.style.height = c.style.width = c.style.height = "1px", b.style.top = b.style.left = b.frameborder = b.style.border = 0, b.style.position = c.style.position = "absolute", b.style.zIndex = c.style.zIndex = 1e5, b.title = "AddToAny Utility Frame", b.setAttribute("transparency", "true"), b.setAttribute("allowTransparency", "true"), b.setAttribute("frameBorder", "0"), b.src = "https://static.addtoany.com/menu/sm.16.html#type=" + a + "&event=load&url=" + f + "&referrer=" + e + g, c.style.top = "0", c.style.visibility = "hidden", a2a.gEl("a2a" + a + "_dropdown").parentNode.insertBefore(c, null), c.insertBefore(b, null)
    },
    util_frame_listen: function(a) {
        a2a.util_frame_make(a), window.postMessage && !a2a[a].message_event && (a2a.add_event(window, "message", function(a) {
            if (".addtoany.com" === a.origin.substr(-13)) {
                var b = "string" == typeof a.data ? a.data.split("=") : [""],
                    c = b[0].substr(4),
                    d = b[1],
                    e = c.substr(0, 4);
                c == e + "_services" && (d = "" != d && d.split(","), a2a.top_services(d, e, " a2a_sss"), a2a.collections(e), a2a.default_services(e)), e && (a2a.gEl("a2a" + e + "_sm_ifr").style.display = "none")
            }
        }), a2a[a].message_event = 1)
    },
    util_frame_post: function(a, b) {
        window.postMessage && a2a.gEl("a2a" + a + "_sm_ifr").contentWindow.postMessage(b, "*")
    },
    fix_icons: function() {
        var a = a2a.ieo();
        if (a && a < 9) {
            var b = a2a.getByClass("a2a_s_a2a", document),
                b = b[0],
                c = a2a.fix_icons.tryNum || 0;
            if (b && !b.a2aFixed && !b.currentStyle.backgroundImage.split('"')[1] && c < 999) return a2a.fix_icons.tryNum = c + 1, setTimeout(a2a.fix_icons, 99);
            for (var d, e, f, g, h = 0, i = a2a.getByClass("a2a_svg", document), j = i.length; h < j; h++) g = i[h], d = g.currentStyle, e = d.backgroundImage.split('"')[1], !g.a2aFixed && e && (f = new Image, f.style.backgroundColor = d.backgroundColor, f.style.border = 0, f.style.height = d.height, f.style.width = d.width, f.src = e, g.style.background = "none", g.insertBefore(f, g.firstChild)), g.a2aFixed = 1
        } else fix_icons = function() {}
    },
    arrange_services: function() {
        var a = a2a.type,
            b = a2a.c.prioritize;
        b && a2a.top_services(b, a), a2a.add_services()
    },
    top_services: function(a, b, c) {
        var d = b || a2a.type,
            e = a2a.in_array,
            f = a2a.make_service,
            g = parseInt(a2a[d].num_services),
            h = a2a.gEl("a2a" + d + "_full_services"),
            i = a2a.gEl("a2a" + d + "_mini_services"),
            j = a2a.getByClass("a2a_i", h, "a"),
            k = a2a.getByClass("a2a_i", i, "a"),
            l = [];
        if (a) {
            for (var m = a.length - 1, c = c; m > -1; m--) {
                var n = a[m],
                    o = e(n, j, !0, "a2a", "safename");
                o && (c && (o.className = o.className + c), h.insertBefore(o, h.firstChild), l.push(o))
            }
            if (l.length > 0) {
                for (var p, q, r, m = 0, c = c; m < l.length; m++)(p = e(l[m].a2a.safename, k, !0, "a2a", "safename")) ? r = p : (q = l[m].a2a, r = f(q.servicename, q.safename, q.serviceIcon, q.serviceColor, {
                    src: q.js_src,
                    url: q.url,
                    type: q.serviceType,
                    pu: q.popup,
                    media: q.media
                })), c && (r.className = r.className + c), i.insertBefore(r, i.firstChild);
                if (k = a2a.getByClass("a2a_i", i, "a"), k.length > g)
                    for (var m = 0, s = k.length; m < s - g; m++) i.removeChild(i.lastChild)
            }
        }
    },
    css: function() {
        var a, b, c = a2a.c,
            d = c.css = document.createElement("style"),
            e = c.color_main || "EEE",
            f = c.color_bg || "FFF",
            g = c.color_border || "CCC",
            h = c.color_link_text || "0166FF",
            i = c.color_link_text_hover || "2A2A2A",
            j = (c.color_link_text_hover || "2A2A2A", c.color_link_text || "2A2A2A"),
            k = ("ffffff" == e.toLowerCase() ? "EEE" : e, c.color_link_text || "2A2A2A"),
            l = c.color_border || g,
            m = ".a2a_",
            n = "{background-position:0 ",
            o = "px!important}",
            p = m + "i_",
            q = o + p,
            r = m + "menu",
            s = "border",
            t = "background-color:",
            u = "color:",
            v = "margin:",
            w = "padding:";
        a = "" + r + "," + r + " * {-moz-box-sizing:content-box;-webkit-box-sizing:content-box;box-sizing:content-box;float:none;" + v + "0;" + w + "0;position: static;height:auto;width:auto;}" + r + " {" + s + "-radius: 6px;display:none;direction:ltr;background:#" + f + ';font: 16px sans-serif-light, "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Arial, Helvetica, "Liberation Sans", sans-serif;' + u + "#000;line-height:12px;" + s + ": 1px solid #" + g + ";vertical-align:baseline;outline: 0; overflow:hidden;}" + m + "mini {min-width:200px;position:absolute;width: 300px;z-index:9999997;}" + m + "overlay {display: none;background: #" + g + '; _height: expression( ((e=document.documentElement.clientHeight)?e:document.body.clientHeight)+"px" ); _width: expression( ((e=document.documentElement.clientWidth)?e:document.body.clientWidth)+"px" ); filter: alpha(opacity=50); opacity: .7;position: fixed;_position: absolute; top: 0;right: 0;left: 0;bottom: 0;z-index: 9999998;-webkit-tap-highlight-' + u + " rgba(0,0,0,0);transition: opacity .14s;}" + m + "full {background: #" + f + ';height: auto;height: calc(320px);top: 15%;_top: expression(40+((e=document.documentElement.scrollTop)?e:document.body.scrollTop)+"px"); left: 50%;margin-left: -320px; position: fixed;_position: absolute; text-align: center;width: 640px;z-index: 9999999;     transition: transform .14s, opacity .14s;}' + m + "full_header," + m + "full_services," + m + "full_footer {" + s + ": 0;" + v + " 0;" + w + " 12px;box-sizing: " + s + "-box;}" + m + "full_header {padding-bottom: 8px;}" + m + "full_services {height: 280px; overflow-y: scroll;" + w + " 0 12px;-webkit-overflow-scrolling: touch;}" + m + "full_services " + m + "i {display: inline-block;float: none;width: 181px;width: calc(33.334% - 18px);}div" + m + "full_footer {font-size: 12px;text-align: center;" + w + " 8px 14px;}div" + m + "full_footer a,div" + m + "full_footer a:visited {display: inline;font-size: 12px;line-height:14px;" + w + " 8px 14px; }div" + m + "full_footer a:hover,div" + m + "full_footer a:focus {background: none;" + s + ": 0;" + u + " #" + h + ";}div" + m + "full_footer a span" + m + "s_a2a,div" + m + "full_footer a span" + m + "w_a2a {background-size: 14px;" + s + "-radius: 3px;display: inline-block;height:14px;line-height:14px;" + v + " 0 3px 0 0;vertical-align: top;*vertical-align: middle; width:14px;}" + m + "modal {background: #" + f + ';font: 24px sans-serif-light, "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Arial, Helvetica, "Liberation Sans", sans-serif;height: auto;top: 50%;_top: expression(40+((e=document.documentElement.scrollTop)?e:document.body.scrollTop)+"px"); left: 50%;margin-left: -320px; margin-top: -36px; position: fixed;_position: absolute; text-align: center;width: 640px;z-index: 9999999;     transition: transform .14s, opacity .14s;-webkit-tap-highlight-' + u + " rgba(0,0,0,0);}" + m + "copy_link_container {position: relative;}span" + m + "s_link#a2a_copy_link_icon,span" + m + "w_link#a2a_copy_link_icon {background-size: 48px;" + s + "-radius: 0;display: inline-block;height:48px;left: 0;line-height:48px;" + v + " 0 3px 0 0;position: absolute;vertical-align: top;*vertical-align: middle; width:48px;}#a2a_copy_link_text {" + t + " transparent;_" + t + " #" + f + ";" + s + ": 0;" + u + " #" + k + ";font: inherit;height: 48px;left: 62px;" + w + " 0;position: relative;width: 564px;width: calc(100% - 76px);}#a2a_copy_link_copied {" + t + " #0166ff;background: linear-gradient(90deg, #0166ff 80%, #9cbfff);" + u + " #fff;display: none;font: inherit;font-size: 16px;" + w + " 6px 8px;}@media print {" + r + "," + m + "overlay {visibility: hidden;}}@keyframes a2aFadeIn {from { opacity: 0; }  to { opacity: 1; }}" + m + "starting {opacity: 0;}" + m + "starting" + m + "full {transform: scale(.8);}@media (max-width: 639px) {" + m + "full {" + s + "-radius: 0;top: 15%;left: 0;margin-left: auto;width: 100%;}" + m + "modal {left: 0;margin-left: 10px;width: calc(100% - 20px);}}@media (min-width: 318px) and (max-width: 437px) {" + m + "full " + m + "full_services " + m + "i {width: calc(50% - 18px);}}@media (max-width: 317px) {" + m + "full " + m + "full_services " + m + "i {width: calc(100% - 18px);}}@media (max-height: 436px) {" + m + "full {bottom: 40px;height: auto;top: 40px;}}" + r + " a {" + u + "#" + h + ';text-decoration:none;font: 16px sans-serif-light, "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Arial, Helvetica, "Liberation Sans", sans-serif;line-height:14px;height:auto;width:auto;outline:none;-moz-outline:none;}' + r + " a:visited{" + u + "#" + h + "}" + r + " a:hover," + r + " a:active," + r + " a:focus{" + u + " #" + i + ";" + s + "-" + u + " #" + e + ";" + s + "-style: solid;" + t + " #" + e + ";text-decoration: none;}" + r + " span" + m + "s_find {background-size: 24px;height:24px;left: 8px;position:absolute;top: 7px;width:24px;}" + r + " span" + m + "s_find svg {" + t + " #" + f + ";}" + r + " span" + m + "s_find svg path {fill: #" + l + ";}#a2a_menu_container{display:inline-block} #a2a_menu_container{_display:inline} " + r + "_find_container {" + s + ": 1px solid #" + l + ";" + s + "-radius: 6px;" + w + " 2px 24px 2px 0;position: relative;text-align: left;}" + m + "cols_container " + m + "col1{overflow-x:hidden;overflow-y:auto;-webkit-overflow-scrolling:touch}" + r + " input," + r + ' input[type="text"],input' + m + "copy_link_text,input" + m + 'copy_link_text[type="text"] { display:block;background-image:none;box-shadow:none;line-height:100%;' + v + "0;outline:0;overflow:hidden;" + w + "0;-moz-box-shadow:none;-webkit-box-shadow:none;-webkit-appearance:none} " + r + "_find_container input" + r + "_find {" + t + " transparent;_" + t + " #" + f + ";" + s + ": 0;" + u + " #" + k + ";font: inherit;font-size: 16px;height: 28px;line-height: 20px;left: 38px;outline: 0;" + w + " 2px 0;position: relative;width: 99%;}" + ("undefined" != typeof document.body.style.maxHeight ? "" + m + "clear{clear:both}" : "" + m + "clear{clear:both;height:0;width:0;line-height:0;font-size:0}") + " " + m + "img {background:url(" + a2a.icons_img_url + ");" + s + ":0;line-height:16px}" + m + "img," + m + "svg {background-repeat:no-repeat;display:block;overflow:hidden;}" + m + "img{height:16px;line-height:16px;width:16px;}" + m + "svg{height:32px;line-height:32px;width:32px;}" + m + "svg svg{background-repeat: no-repeat;background-position: 50% 50%;" + s + ": none;display: block;left: 0;" + v + " 0 auto;overflow: hidden;" + w + " 0;position: relative;top: 0;}a" + m + "i,i" + m + "i{display:block;float:left;" + s + ":1px solid #" + f + ";line-height:24px;" + w + "6px 8px;text-align:left;white-space:nowrap;overflow: hidden;text-overflow: ellipsis;width:132px;}a" + m + "i span,a" + m + "more span {display: inline-block;overflow: hidden;vertical-align: top;*vertical-align: middle; }a" + m + "i " + m + "img,a" + m + "i " + m + "svg {" + v + " 0 6px 0 0;}a" + m + "i " + m + "svg,a" + m + "more " + m + "svg {background-size: 24px;height:24px;line-height:24px;width:24px;}a" + m + "sss:hover {" + s + "-left: 1px solid #" + g + ";}a" + r + "_show_more_less{" + s + "-bottom:1px solid #" + f + ";" + s + "-left:0;" + s + "-right:0;line-height:24px;" + v + "6px 0 0;" + w + "6px}a" + r + "_show_more_less span{display:inline-block;height:24px;" + v + "0 6px 0 0;} " + m + "kit " + m + "svg { background-repeat: repeat; }" + m + "default_style a{float:left;line-height:16px;" + w + "0 2px}" + m + "default_style a:hover " + m + "img," + m + "default_style a:hover " + m + "svg," + m + "floating_style a:hover " + m + "img," + m + "floating_style a:hover " + m + "svg {opacity: .7;}" + m + "default_style " + m + "count," + m + "default_style " + m + "svg," + m + "floating_style " + m + "svg," + m + "vertical_style " + m + "count," + r + " " + m + "svg {" + s + "-radius:4px ;}" + m + "default_style " + m + "img, " + m + "default_style " + m + "dd, " + m + "default_style " + m + "svg," + m + "default_style " + m + "counter img { float: left;}" + m + "default_style " + m + "img_text{margin-right:4px}" + m + "default_style " + m + "divider{" + s + "-left:1px solid #000;display:inline;float:left;height:16px;line-height:16px;" + v + "0 5px}" + m + "kit a{cursor:pointer}" + m + "floating_style { " + t + " #fff; " + s + "-radius: 6px; " + w + " 4px; position: fixed; z-index: 9999995;    animation: a2aFadeIn .2s ease-in;}" + m + "vertical_style a { clear: left;display: block;overflow: hidden;" + w + " 4px;text-decoration: none; }" + m + "floating_style" + m + "default_style { bottom: 0; }" + m + "floating_style" + m + "default_style a { " + w + " 4px; }" + m + "count {" + t + " #fff;" + s + ": 1px solid #ccc;box-sizing: " + s + "-box;" + u + " #2a2a2a;display: block;float: left;font: 12px Arial,Helvetica,sans-serif;height: 16px;margin-left: 4px;position: relative;text-align: center;width: 50px;}" + m + "count:before," + m + "count:after {" + s + ": solid transparent;" + s + '-width: 4px 4px 4px 0;content: "";height: 0;left: 0;line-height: 0;' + v + " -4px 0 0 -4px;position: absolute;top: 50%;width: 0;}" + m + "count:before {" + s + "-right-" + u + " #ccc;}" + m + "count:after {" + s + "-right-" + u + " #fff;margin-left: -3px;}" + m + "count span {    animation: a2aFadeIn .14s ease-in;}" + m + "vertical_style " + m + "counter img {display: block;}" + m + "vertical_style " + m + "count {float: none;margin-left: 0;margin-top: 6px; }" + m + "vertical_style " + m + "count:before," + m + "vertical_style " + m + "count:after {" + s + ": solid transparent;" + s + '-width: 0 4px 4px 4px;content: "";height: 0;left: 50%;line-height: 0;' + v + " -4px 0 0 -4px;position: absolute;top: 0;width: 0;}" + m + "vertical_style " + m + "count:before {" + s + "-bottom-" + u + " #ccc;}" + m + "vertical_style " + m + "count:after {" + s + "-bottom-" + u + " #fff;margin-top: -3px;}" + m + "nowrap{white-space:nowrap}" + m + "note{" + v + "0 auto;" + w + "9px;font-size:12px;text-align:center}" + m + "note " + m + "note_note{" + v + "0;" + u + "#" + j + "}" + m + "wide a{display:block;margin-top:3px;" + s + "-top:1px solid #" + e + ";text-align:center}" + m + "label {position: absolute !important;clip: rect(1px 1px 1px 1px); clip: rect(1px, 1px, 1px, 1px);overflow: hidden; }iframe" + m + "shim {" + t + " transparent;" + s + ': 0;bottom: 0;filter: alpha(opacity=0); height: 100%;left: 0;right: 0;top: 0;position: absolute;width: 100%;z-index: 9999996;_height: expression( ((e=document.documentElement.clientHeight)?e:document.body.clientHeight)+"px" ); _width: expression( ((e=document.documentElement.clientWidth)?e:document.body.clientWidth)+"px" ); }' + m + "dd img {" + s + ":0;-ms-touch-action:manipulation;}" + m + 'button_facebook_like iframe {max-width: none;}iframe[id^="PIN_"][id$="_nag"] {display: none !important;}' + p + "a2a" + n + "0!important}" + p + "a2a_sm" + n + "-17" + q + "agregator" + n + "-34" + q + "amazon" + n + "-51" + q + "aol" + n + "-68" + q + "app_net" + n + "-85" + q + "baidu" + n + "-102" + q + "balatarin" + n + "-119" + q + "behance" + n + "-136" + q + "bibsonomy" + n + "-153" + q + "bitty" + n + "-170" + q + "blinklist" + n + "-187" + q + "blogger" + n + "-204" + q + "blogmarks" + n + "-221" + q + "bookmark" + n + "-238" + q + "bookmarks_fr" + n + "-255" + q + "box" + n + "-272" + q + "buddymarks" + n + "-289" + q + "buffer" + n + "-306" + q + "care2" + n + "-323" + q + "chrome" + n + "-340" + q + "citeulike" + n + "-357" + q + "dailyrotation" + n + "-374" + q + "default" + n + "-391" + q + "delicious" + n + "-408" + q + "designfloat" + n + "-425" + q + "diary_ru" + n + "-442" + q + "diaspora" + n + "-459" + q + "digg" + n + "-476" + q + "dihitt" + n + "-493" + q + "diigo" + n + "-510" + q + "dzone" + n + "-527" + q + "email" + n + "-544" + q + "evernote" + n + "-561" + q + "facebook" + n + "-578" + q + "fark" + n + "-595" + q + "feed" + n + "-612" + q + "feedblitz" + n + "-629" + q + "feedbucket" + n + "-646" + q + "feedly" + n + "-663" + q + "feedmailer" + n + "-680" + q + "find" + n + "-697" + q + "firefox" + n + "-714" + q + "flickr" + n + "-731" + q + "flipboard" + n + "-748" + q + "folkd" + n + "-765" + q + "foursquare" + n + "-782" + q + "github" + n + "-799" + q + "gmail" + n + "-816" + q + "google" + n + "-833" + q + "google_classroom" + n + "-850" + q + "google_plus" + n + "-867" + q + "hatena" + n + "-884" + q + "instapaper" + n + "-901" + q + "itunes" + n + "-918" + q + "jamespot" + n + "-935" + q + "kakao" + n + "-952" + q + "kik" + n + "-969" + q + "kindle" + n + "-986" + q + "klipfolio" + n + "-1003" + q + "known" + n + "-1020" + q + "line" + n + "-1037" + q + "link" + n + "-1054" + q + "linkedin" + n + "-1071" + q + "livejournal" + n + "-1088" + q + "mail_ru" + n + "-1105" + q + "mendeley" + n + "-1122" + q + "meneame" + n + "-1139" + q + "miro" + n + "-1156" + q + "mixi" + n + "-1173" + q + "myspace" + n + "-1190" + q + "netlog" + n + "-1207" + q + "netvibes" + n + "-1224" + q + "netvouz" + n + "-1241" + q + "newsalloy" + n + "-1258" + q + "newsisfree" + n + "-1275" + q + "newsvine" + n + "-1292" + q + "nujij" + n + "-1309" + q + "odnoklassniki" + n + "-1326" + q + "oknotizie" + n + "-1343" + q + "oldreader" + n + "-1360" + q + "outlook_com" + n + "-1377" + q + "pinboard" + n + "-1394" + q + "pinterest" + n + "-1411" + q + "plurk" + n + "-1428" + q + "pocket" + n + "-1445" + q + "podnova" + n + "-1462" + q + "print" + n + "-1479" + q + "printfriendly" + n + "-1496" + q + "protopage" + n + "-1513" + q + "pusha" + n + "-1530" + q + "qzone" + n + "-1547" + q + "reddit" + n + "-1564" + q + "rediff" + n + "-1581" + q + "renren" + n + "-1598" + q + "segnalo" + n + "-1615" + q + "share" + n + "-1632" + q + "sina_weibo" + n + "-1649" + q + "sitejot" + n + "-1666" + q + "skype" + n + "-1683" + q + "slashdot" + n + "-1700" + q + "sms" + n + "-1717" + q + "snapchat" + n + "-1734" + q + "stumbleupon" + n + "-1751" + q + "stumpedia" + n + "-1768" + q + "svejo" + n + "-1785" + q + "symbaloo" + n + "-1802" + q + "telegram" + n + "-1819" + q + "thefreedictionary" + n + "-1836" + q + "thefreelibrary" + n + "-1853" + q + "tumblr" + n + "-1870" + q + "twiddla" + n + "-1887" + q + "twitter" + n + "-1904" + q + "typepad" + n + "-1921" + q + "viadeo" + n, a += "-1938" + q + "viber" + n + "-1955" + q + "vimeo" + n + "-1972" + q + "vk" + n + "-1989" + q + "wanelo" + n + "-2006" + q + "webnews" + n + "-2023" + q + "wechat" + n + "-2040" + q + "whatsapp" + n + "-2057" + q + "winksite" + n + "-2074" + q + "wordpress" + n + "-2091" + q + "wykop" + n + "-2108" + q + "xing" + n + "-2125" + q + "y18" + n + "-2142" + q + "yahoo" + n + "-2159" + q + "yim" + n + "-2176" + q + "yoolink" + n + "-2193" + q + "youmob" + n + "-2210" + q + "youtube" + n + "-2227" + q + "yummly" + n + "-2244" + o, d.setAttribute("type", "text/css"), a2a.head_tag.appendChild(d), d.styleSheet ? d.styleSheet.cssText = a : (b = document.createTextNode(a), d.appendChild(b))
    },
    svg_css: function() {
        a2a.init("page");
        var a = a2a.c.css.sheet || a2a.c.css.styleSheet || {},
            b = "insertRule" in a,
            c = "addRule" in a;
        all_services = a2a.services.concat([
            [0, 0, "a2a", "0166FF"]
        ]);
        for (var d, e, f = 0, g = all_services.length; f < g; f++) d = ".a2a_s_" + all_services[f][2], e = "background-color:#" + all_services[f][3] + ";", b ? a.insertRule(d + "{" + e + "}", 0) : c && a.addRule(d, e, 0);
        a2a.svg.load(!0), a2a.svg_css = function() {}
    },
    svg: {
        icons: {},
        queue: [],
        tagO: '<svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">',
        tagC: "</svg>",
        fill: function(a, b) {
            return a.replace(/#FFF/gi, b)
        },
        get: function(a, b, c) {
            var d = a2a.svg,
                e = d.fill;
            return icons = d.icons, svg_tag_open = d.tagO, svg_tag_close = d.tagC, svg_src = icons[a], svg_src_default = icons.a2a, svg_src ? (svg_src = c ? e(svg_src, c) : svg_src, svg_tag_open + svg_src + svg_tag_close) : svg_src_default ? (svg_src_default = c ? e(svg_src_default, c) : svg_src_default, svg_tag_open + svg_src_default + svg_tag_close) : (a2a.svg.queue.push({
                name: a,
                node: b,
                color: c
            }), "pending")
        },
        set: function(a) {
            var b = a2a.svg,
                c = b.queue;
            if (icons = b.icons = a, svg_tag_open = b.tagO, svg_tag_close = b.tagC, icons.a2a)
                for (var d, e, f, g = 0, h = c.length; g < h; g++) d = c[g], e = d.name, color = d.color, f = icons[e] ? icons[e] : icons.a2a, f = color ? b.fill(f, color) : f, d.node.innerHTML = svg_tag_open + f + svg_tag_close
        },
        load: function(a) {
            var b = a2a.svg.works(),
                c = new window.Image;
            c.onerror = function() {
                loadCSS(!1)
            }, c.onload = function() {
                var d = 1 === c.width && 1 === c.height;
                b && !a ? a2a.svg.loadJS(document) : a2a.svg.loadCSS(d), a2a.svg.load = function(a) {
                    return function(b) {
                        b && a2a.svg.loadCSS(a)
                    }
                }(d)
            }, a2a.svg.load = function() {}, c.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=="
        },
        loadCSS: function(a) {
            var b = a2a.c.static_server,
                c = a2a.fix_icons,
                d = ["icons.19.svg.css", "icons.19.png.css", "icons.19.old.css"],
                e = a2a.svg.works(),
                f = window.document.createElement("link"),
                g = a && e && "https://static.addtoany.com/menu" != b ? b + "/" : b + "/svg/";
            f.rel = "stylesheet", f.href = g + d[a && e ? 0 : a ? 1 : 2], a2a.head_tag.appendChild(f), c(), a2a.svg.loadCSS = c
        },
        loadJS: function() {
            var a = document,
                b = a2a.c.static_server,
                c = a.createElement("script"),
                d = a.getElementsByTagName("script")[0];
            c.async = !0, c.src = "https://static.addtoany.com/menu" != b ? b + "/icons.19.svg.js" : b + "/svg/icons.19.svg.js", d.parentNode.insertBefore(c, d), a2a.svg.loadJS = function() {}
        },
        works: function() {
            var a = window,
                b = !(!a.document.createElementNS || !a.document.createElementNS("http://www.w3.org/2000/svg", "svg").createSVGRect || !document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Image", "1.1") || a.opera && navigator.userAgent.indexOf("Chrome") === -1);
            return a2a.svg.works = function() {
                return b
            }, b
        }
    },
    make_service: function(a, b, c, d, e, f, g) {
        var h, i, j = document.createElement("a"),
            k = a2a.c,
            l = function() {
                a2a.linker(this)
            },
            m = a2a.type,
            e = e || {},
            n = "a2a_svg a2a_s__default",
            o = k.icon_color,
            p = o ? o.split(",", 2) : o,
            q = p ? p[0] : p,
            r = p ? p[1] : p;
        return j.rel = "nofollow", j.className = "a2a_i", j.href = "/#" + b, j.target = "_blank", j.a2a = {}, j.a2a.safename = b, j.a2a.servicename = a, j.a2a.serviceNameLowerCase = a.toLowerCase(), j.a2a.serviceIcon = c, j.a2a.serviceColor = d, j.a2a.serviceType = e.type, j.innerHTML = "<span></span>" + a + " ", h = j.firstChild, e.type && (j.a2a.stype = e.type), e.src && (j.a2a.js_src = e.src), e.url && (j.a2a.url = e.url), e.pu && (j.a2a.popup = 1), e.media && (j.a2a.media = 1), f && (j.a2a.customserviceuri = f), g ? (h.style.backgroundImage = "url(" + g + ")", h.className = n) : o && a2a.svg.works() ? (h.className = n + " a2a_s_" + c, q && "unset" != q ? h.style.backgroundColor = q : d && (h.style.backgroundColor = "#" + d), r && (r = r.trim())) : c ? (h.className = n + " a2a_s_" + c, d && (h.style.backgroundColor = "#" + d)) : h.className = n, i = a2a.svg.get(c, h, r), "pending" !== i && (h.innerHTML = i), a2a.add_event(j, "mousedown", l), a2a.add_event(j, "keydown", l), a2a.add_event(j, "click", function(b) {
            var c = a2a["n" + a2a.n],
                d = {
                    node: j,
                    service: a,
                    title: c.linkname,
                    url: c.linkurl
                },
                e = a2a.cbs("share", d);
            "undefined" != typeof e && (e.url && (c.linkurl = e.url, c.linkurl_implicit = !1), e.title && (c.linkname = e.title, c.linkname_implicit = !1), a2a.linker(j), e.stop && a2a.preventDefault(b))
        }), a2a.add_event(j, "click", function(c) {
            var d = encodeURIComponent,
                e = a2a["n" + a2a.n],
                f = "page" == m ? "pages" : "subscriptions",
                g = "page" == m ? "AddToAny Share/Save Button" : "AddToAny Subscribe Button",
                h = screen.height,
                i = 550,
                k = 450,
                l = "event=service_click&url=" + d(location.href) + "&title=" + d(document.title || "") + "&ev_service=" + d(b) + "&ev_service_type=menu&ev_menu_type=" + m + "&ev_url=" + d(e.linkurl) + "&ev_title=" + d(e.linkname).replace(/'/g, "%27");
            j.a2a.popup && !a2a.defaultPrevented(c) && "javascript:" != j.href.substr(0, 11) && (a2a.preventDefault(c), window.open(j.href, "_blank", "toolbar=0,personalbar=0,resizable,scrollbars,status,width=550,height=450,top=" + (h > k ? Math.round(h / 2 - k / 2) : 40) + ",left=" + Math.round(screen.width / 2 - i / 2))), a2a.util_frame_post(m, l), a2a.GA.track(a, b, e.linkurl, f, g)
        }), j
    },
    i18n: function() {
        if ("https://static.addtoany.com/menu" != a2a.c.static_server) return !1;
        var a = ["ar", "id", "ms", "bn", "bs", "bg", "ca", "ca-AD", "ca-ES", "cs", "cy", "da", "de", "dv", "el", "et", "es", "es-AR", "es-VE", "eo", "en-US", "eu", "fa", "fr", "fr-CA", "gd", "he", "hi", "hr", "is", "it", "ja", "ko", "ku", "lv", "lt", "li", "hu", "mk", "nl", "no", "pl", "pt", "pt-BR", "pt-PT", "ro", "ru", "sr", "fi", "sk", "sl", "sv", "ta", "te", "tr", "uk", "vi", "zh-CN", "zh-TW"],
            b = a2a.c.locale || (navigator.browserLanguage || navigator.language).toLowerCase(),
            c = a2a.in_array(b, a, !0);
        if (!c) {
            var d = b.indexOf("-");
            d != -1 && (c = a2a.in_array(b.substr(0, d), a, !0))
        }
        return !("en-us" == b || !c) && c
    }
};
a2a.c = a2a_config, a2a.make_once = function(a) {
        if (a2a.type = a2a.c.menu_type || a, !a2a[a2a.type] && !window["a2a" + a2a.type + "_init"]) {
            a2a[a2a.type] = {}, window.a2a_show_dropdown = a2a.show_menu, window.a2a_onMouseOut_delay = a2a.onMouseOut_delay, window.a2a_init = a2a.init, a2a["create_" + a2a.type + "_dropdown"] = function(a, b) {
                var c, d, e, f = a2a.gEl,
                    g = a2a.type = a,
                    h = "a2a" + g,
                    i = a2a.c,
                    j = a2a.ieo(),
                    k = document.createElement("i"),
                    l = document.createDocumentFragment(),
                    m = document.createDocumentFragment(),
                    n = (document.createElement("a"), i.icon_color),
                    o = n ? n.split(",", 2) : n,
                    p = o ? o[0] : o,
                    q = o ? o[1] : o,
                    r = "a2a_svg a2a_s__default a2a_s_",
                    s = q ? q : "#FFF",
                    t = ' style="background-color:' + (p && "unset" != p ? p : "#0166ff") + '"',
                    u = '<svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><g fill="' + s + '"><path d="M14 7h4v18h-4z"/><path d="M7 14h18v4H7z"/></g></svg>',
                    v = i.localize;
                a2a.css(), v = i.localize = {
                    Share: v.Share || "Share",
                    Save: v.Save || "Save",
                    Subscribe: v.Subscribe || "Subscribe",
                    Email: v.Email || "Email",
                    Bookmark: v.Bookmark || "Bookmark",
                    ShowAll: v.ShowAll || "Show all",
                    ShowLess: v.ShowLess || "Show less",
                    FindAnyServiceToAddTo: v.FindAnyServiceToAddTo || "Find any service",
                    PoweredBy: v.PoweredBy || "By",
                    AnyEmail: "Any email",
                    ShareViaEmail: v.ShareViaEmail || "Share via email",
                    SubscribeViaEmail: v.SubscribeViaEmail || "Subscribe via email",
                    BookmarkInYourBrowser: v.BookmarkInYourBrowser || "Bookmark in your browser",
                    BookmarkInstructions: v.BookmarkInstructions || "Press Ctrl+D or &#8984;+D to bookmark this page",
                    AddToYourFavorites: v.AddToYourFavorites || "Add to Favorites",
                    SendFromWebOrProgram: v.SendFromWebOrProgram || "Send from any other email service",
                    EmailProgram: v.EmailProgram || "Email application",
                    More: v.More || "More&#8230;"
                };
                var w = '<div class="a2a_overlay" id="a2a' + g + '_overlay"></div>';
                w += '<div id="a2a' + g + '_modal" class="a2a_menu a2a_modal" role="dialog" tabindex="-1" aria-label="Copy link" style="display:none">', "page" == g && (w += '<div class="a2a_copy_link_container"><span id="a2a_copy_link_icon" class="a2a_svg a2a_s_link"' + t + ' onclick="a2a.gEl(\'a2a_copy_link_text\').click()"><svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="' + s + '" d="M24.4 21.18c0-.36-.1-.67-.36-.92l-2.8-2.8a1.24 1.24 0 0 0-.92-.38c-.38 0-.7.14-.97.43.02.04.1.12.25.26l.3.3.2.24c.08.12.14.24.17.35.03.1.05.23.05.37 0 .36-.13.66-.38.92a1.25 1.25 0 0 1-.92.37 1.4 1.4 0 0 1-.37-.03 1.06 1.06 0 0 1-.35-.18 2.27 2.27 0 0 1-.25-.2 6.82 6.82 0 0 1-.3-.3l-.24-.25c-.3.28-.44.6-.44.98 0 .36.13.66.38.92l2.78 2.8c.24.23.54.35.9.35.37 0 .68-.12.93-.35l1.98-1.97c.26-.25.38-.55.38-.9zm-9.46-9.5c0-.37-.13-.67-.38-.92l-2.78-2.8a1.24 1.24 0 0 0-.9-.37c-.36 0-.67.1-.93.35L7.97 9.92c-.26.25-.38.55-.38.9 0 .36.1.67.37.92l2.8 2.8c.24.25.55.37.92.37.36 0 .7-.13.96-.4-.03-.04-.1-.12-.26-.26s-.24-.23-.3-.3a2.67 2.67 0 0 1-.2-.24 1.05 1.05 0 0 1-.17-.35 1.4 1.4 0 0 1-.04-.37c0-.36.1-.66.36-.9.26-.26.56-.4.92-.4.14 0 .26.03.37.06.12.03.23.1.35.17.1.1.2.16.25.2l.3.3.24.26c.3-.28.44-.6.44-.98zM27 21.17c0 1.07-.38 2-1.15 2.73l-1.98 1.98c-.74.75-1.66 1.12-2.73 1.12-1.1 0-2-.38-2.75-1.14l-2.8-2.8c-.74-.74-1.1-1.65-1.1-2.73 0-1.1.38-2.04 1.17-2.82l-1.18-1.17c-.8.8-1.72 1.18-2.82 1.18-1.08 0-2-.36-2.75-1.12l-2.8-2.8C5.38 12.8 5 11.9 5 10.82c0-1.08.38-2 1.15-2.74L8.13 6.1C8.87 5.37 9.78 5 10.86 5c1.1 0 2 .38 2.75 1.15l2.8 2.8c.74.73 1.1 1.65 1.1 2.72 0 1.1-.38 2.05-1.17 2.82l1.18 1.18c.8-.8 1.72-1.2 2.82-1.2 1.08 0 2 .4 2.75 1.14l2.8 2.8c.76.76 1.13 1.68 1.13 2.76z"/></svg></span><input id="a2a_copy_link_text" type="text" title="Copy link"/><div id="a2a_copy_link_copied">Copied!</div></div>'), w += "</div>", w += '<div class="a2a_menu a2a_full" id="a2a' + g + '_full" role="dialog" tabindex="-1" aria-label="' + ("feed" == g ? v.Subscribe : v.Share) + '"><div class="a2a_full_header"><div id="a2a' + g + '_find_container" class="a2a_menu_find_container"><input id="a2a' + g + '_find" class="a2a_menu_find" type="text" onclick="a2a.focus_find()" onkeyup="a2a.do_find()" autocomplete="off" title="' + v.FindAnyServiceToAddTo + '"/><span id="a2a' + g + '_find_icon" class="a2a_svg a2a_s_find" onclick="a2a.focus_find()"><svg focusable="false" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#CCC" d="M19.7 18.2l-4.5-4.5c.7-1.1 1.2-2.3 1.2-3.6 0-3.5-2.8-6.3-6.3-6.3s-6.3 2.8-6.3 6.3 2.8 6.3 6.3 6.3c1.4 0 2.6-.4 3.6-1.2l4.5 4.5c.6.6 1.3.7 1.7.2.5-.4.4-1.1-.2-1.7zm-9.6-3.6c-2.5 0-4.5-2.1-4.5-4.5 0-2.5 2.1-4.5 4.5-4.5 2.5 0 4.5 2.1 4.5 4.5s-2 4.5-4.5 4.5z"/></svg></span></div></div><div class="a2a_full_services" id="a2a' + g + '_full_services" role="presentation"></div><div class="a2a_full_footer"><a href="https://www.addtoany.com" title="Share Buttons" target="_blank"><span class="' + r + 'a2a"' + t + ">" + u + '</span>AddToAny</a></div></div><div id="a2a' + g + '_dropdown" class="a2a_menu a2a_mini" onmouseover="a2a.onMouseOver_stay()"' + (a2a[g].onclick ? "" : ' onmouseout="a2a.onMouseOut_delay()"') + ' tabindex="-1" aria-label="' + ("feed" == g ? v.Subscribe : v.Share) + '" style="display:none"><div id="a2a' + g + '_title_container" class="a2a_menu_title_container" style="display:none"><div id="a2a' + g + '_title" class="a2a_menu_title"></div></div><div class="a2a_mini_services" id="a2a' + g + '_mini_services"></div>', w += '<div id="a2a' + g + '_cols_container" class="a2a_cols_container"><div class="a2a_col1" id="a2a' + g + '_col1"' + ("mail" == g ? ' style="display:none"' : "") + '></div><div id="a2a' + g + '_2_col1"' + ("mail" != g ? ' style="display:none"' : "") + '></div><div class="a2a_clear"></div></div>', "mail" != g && (w += '<div class="a2a' + g + '_wide a2a_wide"><a href="" id="a2a' + g + '_show_more_less" class="a2a_menu_show_more_less a2a_more" title="' + v.ShowAll + '"><span class="' + r + 'a2a"' + t + ">" + u + "</span>" + v.More + "</a></div>"), w += "</div>";
                var x = "a2a_menu_container",
                    y = f(x) || document.createElement("div");
                a2a.add_event(y, "mouseup", a2a.stopPropagation), a2a.add_event(y, "mousedown", a2a.stopPropagation), a2a.add_event(y, "touchstart", a2a.stopPropagation), a2a.add_event(y, "touchend", a2a.stopPropagation), a2a.add_event(y, "MSPointerDown", a2a.stopPropagation), a2a.add_event(y, "MSPointerUp", a2a.stopPropagation), y.innerHTML = w, y.id != x && (y.style.position = "static", j && j < 9 ? document.body.insertBefore(y, document.body.firstChild) : document.body.insertBefore(y, null));
                var z = new RegExp("[\\?&]awesm=([^&#]*)"),
                    A = z.exec(window.location.href);
                null != A ? i.awesm = A[1] : i.awesm = !1;
                var B = a2a.make_service;
                if ("mail" != g) {
                    for (var C = 0, D = b.most, E = D.length, F = parseInt(a2a[g].num_services), G = 0, H = a2a[g].exclude_services; C < E; C++) {
                        var I = D[C];
                        H && a2a.in_array(I[1], H, !0) || l.appendChild(B(I[0], I[1], I[2], I[3], I[4])), !(G < F) || H && a2a.in_array(I[1], H, !0) || (m.appendChild(B(I[0], I[1], I[2], I[3], I[4])), G++)
                    }
                    f(h + "_full_services").appendChild(l), f(h + "_mini_services").appendChild(m)
                }
                c = f(h + "_full_services"), k.className = "a2a_i", d = k.cloneNode(), c.appendChild(k), c.appendChild(d);
                for (var C = 0, J = b.email, K = J.length; C < K; C++) {
                    var I = J[C];
                    H && a2a.in_array(I[1], H, !0) || f(h + "_2_col1").appendChild(B(I[0], I[1], I[2], I[3], I[4]))
                }
                if ("feed" != g) {
                    var L = B("Email app", "email_app", "email", null, null, "mailto:?subject=A2A_LINKNAME_ENC&body=A2A_LINKURL_ENC");
                    L.className = "a2a_i a2a_emailer a2a_email_client", L.id = "a2a" + g + "_email_client", L.target = "", f(h + "_2_col1").appendChild(L)
                }
                a2a[g].services = b.most.concat(b.email), "mail" != g && (a2a.fast_click.make(f(h + "_overlay"), function(a) {
                    a2a.hide_full(g)
                }), a2a.fast_click.make(f(h + "_show_more_less"), function(a) {
                    a2a.preventDefault(a), a2a.show_more_less(0)
                })), a2a.arrange_services(), a2a.util_frame_listen(g), a2a.collections(g), a2a.default_services(), "mail" != g && (e = f(h + "_find"), e.onkeydown = function(a) {
                    var a = a || window.event,
                        b = a.which || a.keyCode,
                        c = a2a.type;
                    if (13 == b) {
                        for (var d, f = 0, g = a2a[c].main_services, h = g.length; f < h; f++)
                            if (d = g[f], "none" != d.style.display) return d.focus(), !1
                    } else 27 == b && ("" == e.value && e.blur(), e.value = "", a2a.do_find())
                })
            };
            var b = {};
            b.page = {
                most: [
                    ["Facebook", "facebook", "facebook", "3B5998", {
                        pu: 1
                    }],
                    ["Twitter", "twitter", "twitter", "55ACEE", {
                        pu: 1
                    }],
                    ["Google+", "google_plus", "google_plus", "DD4B39", {
                        pu: 1
                    }],
                    ["Pinterest", "pinterest", "pinterest", "BD081C", {
                        type: "js",
                        src: "https://static.addtoany.com/menu/pinmarklet.js",
                        media: 1,
                        pu: 1
                    }],
                    ["Email", "email", "email", "0166FF", {
                        url: "mailto:?subject=${title}&body=${link}"
                    }],
                    ["LinkedIn", "linkedin", "linkedin", "007BB5", {
                        pu: 1
                    }],
                    ["Reddit", "reddit", "reddit", "ff4500"],
                    ["Tumblr", "tumblr", "tumblr", "35465C", {
                        pu: 1
                    }],
                    ["WordPress", "wordpress", "wordpress", "464646"],
                    ["Google Gmail", "google_gmail", "gmail", "DD5347", {
                        type: "email",
                        pu: 1
                    }],
                    ["WhatsApp", "whatsapp", "whatsapp", "12AF0A", {
                        url: "whatsapp://send?text=${title}%20${link}"
                    }],
                    ["StumbleUpon", "stumbleupon", "stumbleupon", "EF4E23"],
                    ["AIM", "aim", "aim", "00C2FF"],
                    ["Amazon Wish List", "amazon_wish_list", "amazon", "F90"],
                    ["AOL Mail", "aol_mail", "aol", "2A2A2A", {
                        type: "email",
                        pu: 1
                    }],
                    ["App.net", "app_net", "app_net", "5D5D5D"],
                    ["Baidu", "baidu", "baidu", "2319DC"],
                    ["Balatarin", "balatarin", "balatarin", "079948"],
                    ["BibSonomy", "bibsonomy", "bibsonomy", "2A2A2A"],
                    ["Bitty Browser", "bitty_browser", "bitty", "999"],
                    ["Blinklist", "blinklist", "blinklist", "3D3C3B"],
                    ["Blogger Post", "blogger_post", "blogger", "FDA352"],
                    ["BlogMarks", "blogmarks", "blogmarks", "535353"],
                    ["Bookmarks.fr", "bookmarks_fr", "bookmarks_fr", "96C044"],
                    ["Box.net", "box_net", "box", "1A74B0"],
                    ["BuddyMarks", "buddymarks", "buddymarks", "96C044"],
                    ["Buffer", "buffer", "buffer", "2A2A2A"],
                    ["Care2 News", "care2_news", "care2", "6EB43F"],
                    ["CiteULike", "citeulike", "citeulike", "2781CD"],
                    ["Copy Link", "copy_link", "link", "0166FF", {
                        type: "js",
                        src: "javascript:a2a.copyLink('${link}')"
                    }],
                    ["Delicious", "delicious", "delicious", "39F"],
                    ["Design Float", "design_float", "designfloat", "8AC8FF"],
                    ["Diary.Ru", "diary_ru", "diary_ru", "912D31"],
                    ["Diaspora", "diaspora", "diaspora", "2E3436"],
                    ["Digg", "digg", "digg", "2A2A2A"],
                    ["diHITT", "dihitt", "dihitt", "FF6300"],
                    ["Diigo", "diigo", "diigo", "4A8BCA"],
                    ["Douban", "douban", "douban", "071", {
                        pu: 1
                    }],
                    ["Draugiem", "draugiem", "draugiem", "F60", {
                        pu: 1
                    }],
                    ["DZone", "dzone", "dzone", "82C251"],
                    ["Evernote", "evernote", "evernote", "8BE056"],
                    ["Facebook Messenger", "facebook_messenger", "facebook_messenger", "0084FF", {
                        pu: 1
                    }],
                    ["Fark", "fark", "fark", "555"],
                    ["Flipboard", "flipboard", "flipboard", "C00", {
                        pu: 1
                    }],
                    ["Folkd", "folkd", "folkd", "0F70B2"],
                    ["Google Bookmarks", "google_bookmarks", "google", "4285F4"],
                    ["Google Classroom", "google_classroom", "google_classroom", "FFC112"],
                    ["Hacker News", "hacker_news", "y18", "F60"],
                    ["Hatena", "hatena", "hatena", "00A6DB"],
                    ["Instapaper", "instapaper", "instapaper", "2A2A2A"],
                    ["Jamespot", "jamespot", "jamespot", "FF9E2C"],
                    ["Kakao", "kakao", "kakao", "FCB700", {
                        pu: 1
                    }],
                    ["Kik", "kik", "kik", "2A2A2A"],
                    ["Kindle It", "kindle_it", "kindle", "2A2A2A"],
                    ["Known", "known", "known", "2A2A2A"],
                    ["Line", "line", "line", "00C300"],
                    ["LiveJournal", "livejournal", "livejournal", "113140"],
                    ["Mail.Ru", "mail_ru", "mail_ru", "356FAC"],
                    ["Mendeley", "mendeley", "mendeley", "A70805"],
                    ["Meneame", "meneame", "meneame", "FF7D12"],
                    ["Mixi", "mixi", "mixi", "D1AD5A"],
                    ["MySpace", "myspace", "myspace", "2A2A2A"],
                    ["Netlog", "netlog", "netlog", "2A2A2A"],
                    ["Netvouz", "netvouz", "netvouz", "6C3"],
                    ["NewsVine", "newsvine", "newsvine", "055D00"],
                    ["NUjij", "nujij", "nujij", "D40000"],
                    ["Odnoklassniki", "odnoklassniki", "odnoklassniki", "F2720C"],
                    ["Oknotizie", "oknotizie", "oknotizie", "88D32D"],
                    ["Outlook.com", "outlook_com", "outlook_com", "0072C6", {
                        type: "email"
                    }],
                    ["Pinboard", "pinboard", "pinboard", "1341DE", {
                        pu: 1
                    }],
                    ["Plurk", "plurk", "plurk", "CF682F"],
                    ["Pocket", "pocket", "pocket", "EE4056"],
                    ["Print", "print", "print", "0166FF", {
                        type: "js",
                        src: "javascript:print()"
                    }],
                    ["PrintFriendly", "printfriendly", "printfriendly", "6D9F00"],
                    ["Protopage Bookmarks", "protopage_bookmarks", "protopage", "413FFF"],
                    ["Pusha", "pusha", "pusha", "0072B8"],
                    ["Qzone", "qzone", "qzone", "2B82D9"],
                    ["Rediff MyPage", "rediff", "rediff", "D20000"],
                    ["Renren", "renren", "renren", "005EAC", {
                        pu: 1
                    }],
                    ["Segnalo", "segnalo", "segnalo", "FF6500"],
                    ["Sina Weibo", "sina_weibo", "sina_weibo", "E6162D"],
                    ["SiteJot", "sitejot", "sitejot", "FFC808"],
                    ["Skype", "skype", "skype", "00AFF0"],
                    ["Slashdot", "slashdot", "slashdot", "004242"],
                    ["SMS", "sms", "sms", "6CBE45", {
                        url: "sms://&body=${title}%20${link}"
                    }],
                    ["Stumpedia", "stumpedia", "stumpedia", "FFC808"],
                    ["Svejo", "svejo", "svejo", "5BD428"],
                    ["Symbaloo Feeds", "symbaloo_feeds", "symbaloo", "6DA8F7"],
                    ["Telegram", "telegram", "telegram", "2CA5E0"],
                    ["Trello", "trello", "trello", "0079BF", {
                        pu: 1
                    }],
                    ["Tuenti", "tuenti", "tuenti", "0075C9"],
                    ["Twiddla", "twiddla", "twiddla", "2A2A2A"],
                    ["TypePad Post", "typepad_post", "typepad", "D2DE61"],
                    ["Viadeo", "viadeo", "viadeo", "2A2A2A", {
                        pu: 1
                    }],
                    ["Viber", "viber", "viber", "7C529E", {
                        url: "viber://forward?text=${title}%20${link}"
                    }],
                    ["VK", "vk", "vk", "587EA3", {
                        pu: 1
                    }],
                    ["Wanelo", "wanelo", "wanelo", "9cb092"],
                    ["Webnews", "webnews", "webnews", "CC2512"],
                    ["WeChat", "wechat", "wechat", "7BB32E"],
                    ["Wykop", "wykop", "wykop", "367DA9"],
                    ["XING", "xing", "xing", "165B66", {
                        pu: 1
                    }],
                    ["Yahoo Bookmarks", "yahoo_bookmarks", "yahoo", "400090"],
                    ["Yahoo Mail", "yahoo_mail", "yahoo", "400090", {
                        type: "email"
                    }],
                    ["Yahoo Messenger", "yahoo_messenger", "yim", "400090", {
                        url: "ymsgr:sendim?+&m=${link}"
                    }],
                    ["Yoolink", "yoolink", "yoolink", "A2C538"],
                    ["YouMob", "youmob", "youmob", "3B599D"],
                    ["Yummly", "yummly", "yummly", "E16120", {
                        type: "js",
                        src: "https://www.yummly.com/js/yumlet.js",
                        media: 1,
                        pu: 1
                    }]
                ],
                email: [
                    ["Google Gmail", "google_gmail", "gmail", "DD5347", {
                        type: "email",
                        pu: 1
                    }],
                    ["AOL Mail", "aol_mail", "aol", "2A2A2A", {
                        type: "email",
                        pu: 1
                    }],
                    ["Outlook.com", "outlook_com", "outlook_com", "0072C6", {
                        type: "email"
                    }],
                    ["Yahoo Mail", "yahoo_mail", "yahoo", "400090", {
                        type: "email"
                    }]
                ]
            }, b.feed = {
                most: [
                    ["Feed", "feed", "feed", "E3702D", {
                        url: "${link_noenc}"
                    }],
                    ["Feedly", "feedly", "feedly", "2BB24C"],
                    ["My Yahoo", "my_yahoo", "yahoo", "400090"],
                    ["FeedBlitz", "feedblitz", "feedblitz", "FF8B23", {
                        type: "email"
                    }],
                    ["AOL Reader", "my_aol", "aol", "2A2A2A"],
                    ["The Old Reader", "oldreader", "oldreader", "D73F31"],
                    ["Agregator", "agregator", "agregator", "359440"],
                    ["Bitty Browser Preview", "bitty_browser_preview", "bitty", "999"],
                    ["Daily Rotation", "daily_rotation", "dailyrotation", "2A2A2A"],
                    ["Feed Mailer", "feed_mailer", "feedmailer", "78A8D1"],
                    ["FeedBucket", "feedbucket", "feedbucket", "E3702D"],
                    ["iTunes", "itunes", "itunes", "FB233A", {
                        url: "itpc://${link_nohttp}"
                    }],
                    ["KlipFolio", "klipfolio", "klipfolio", "E82329"],
                    ["Miro", "miro", "miro", "D41700"],
                    ["Netvibes", "netvibes", "netvibes", "7CA900"],
                    ["NewsAlloy", "newsalloy", "newsalloy", "8E2B3D"],
                    ["NewsIsFree", "newsisfree", "newsisfree", "316CA9"],
                    ["Outlook", "outlook", "outlook_com", "0072C6", {
                        url: "feed://${link_nohttp}"
                    }],
                    ["PodNova", "podnova", "podnova", "B50419"],
                    ["Protopage News Feeds", "protopage_news_feeds", "protopage", "413FFF"],
                    ["Symbaloo Bookmarks", "symbaloo_bookmarks", "symbaloo", "6DA8F7"],
                    ["The Free Dictionary", "the_free_dictionary", "thefreedictionary", "004B85"],
                    ["The Free Library", "the_free_library", "thefreelibrary", "004B85"],
                    ["WINKsite", "winksite", "winksite", "6FE738"]
                ],
                email: [
                    ["FeedBlitz", "feedblitz", "feedblitz", "FF8B23", {
                        type: "email"
                    }]
                ]
            }, a2a.services = b.page.most.concat(b.feed.most);
            var c = a2a.type,
                d = a2a[c],
                e = "feed" == c ? "feed" : "page",
                f = a2a.c;
            location.host.split(".").slice(-1);
            d.find_focused = !1, d.show_all = !1, d.onclick = f.onclick || !1, d.show_title = f.show_title || !1, d.num_services = f.num_services || 8, d.exclude_services = f.exclude_services || !1, d.custom_services = f.custom_services || !1, a2a.locale = a2a.i18n(), a2a.locale && "custom" != a2a.locale ? (a2a.loadExtScript(f.static_server + "/locale/" + a2a.locale + ".js", function() {
                return "" != a2a_localize
            }, function() {
                for (f.localize = a2a_localize, f.add_services = window.a2a_add_services, a2a["create_" + a2a.type + "_dropdown"](c, b[e]); a2a.fn_queue.length > 0;) a2a.fn_queue.shift()();
                a2a.locale = null, a2a.GA(1), a2a.init_show()
            }), f.menu_type = !1) : (a2a["create_" + a2a.type + "_dropdown"](c, b[e]), a2a.GA());
            try {
                document.execCommand("BackgroundImageCache", !1, !0)
            } catch (g) {}
        }
    },
    function() {
        var a = function() {
            a2a.type = "page", a2a.cbs("ready"), a = function() {}
        };
        document.body && (a2a.init_all("page"), a()), a2a.dom.ready(function() {
            a2a.init_all("page"), a()
        })
    }();