<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head,useForm } from '@inertiajs/vue3';


        try{
        theViewer.defaultViewer = new theViewer.Viewer({});
        }catch(e){}

        (function(){function b(a,b,e,f){var c=(a.className||"").split(/\s+/g);""===c[0]&&c.shift();var d=c.indexOf(b);0>d&&e&&c.push(b);0<=d&&f&&c.splice(d,1);a.className=c.join(" ");return 0<=d}if(!("classList"in document.createElement("div"))){var e={add:function(a){b(this.element,a,!0,!1)},contains:function(a){return b(this.element,a,!1,!1)},remove:function(a){b(this.element,a,!1,!0)},toggle:function(a){b(this.element,a,!0,!0)}};Object.defineProperty(HTMLElement.prototype,"classList",{get:function(){if(this._classList)return this._classList;
        var a=Object.create(e,{element:{value:this,writable:!1,enumerable:!0}});Object.defineProperty(this,"_classList",{value:a,writable:!1,enumerable:!1});return a},enumerable:!0})}})();
        (function(){
        var theViewer=window.theViewer=window.theViewer||{},CSS_CLASS_NAMES={page_frame:"pf",page_content_box:"pc",page_data:"pi",background_image:"bi",link:"l",input_radio:"ir",__dummy__:"no comma"},DEFAULT_CONFIG={container_id:"page-container",sidebar_id:"sidebar",outline_id:"outline",loading_indicator_cls:"loading-indicator",preload_pages:3,render_timeout:100,scale_step:0.9,key_handler:!0,hashchange_handler:!0,view_history_handler:!0,__dummy__:"no comma"},EPS=1E-6;
        function invert(a){var b=a[0]*a[3]-a[1]*a[2];return[a[3]/b,-a[1]/b,-a[2]/b,a[0]/b,(a[2]*a[5]-a[3]*a[4])/b,(a[1]*a[4]-a[0]*a[5])/b]}function transform(a,b){return[a[0]*b[0]+a[2]*b[1]+a[4],a[1]*b[0]+a[3]*b[1]+a[5]]}function get_page_number(a){return parseInt(a.getAttribute("data-page-no"),16)}function disable_dragstart(a){for(var b=0,c=a.length;b<c;++b)a[b].addEventListener("dragstart",function(){return!1},!1)}
        function clone_and_extend_objs(a){for(var b={},c=0,e=arguments.length;c<e;++c){var h=arguments[c],d;for(d in h)h.hasOwnProperty(d)&&(b[d]=h[d])}return b}
        function Page(a){if(a){this.shown=this.loaded=!1;this.page=a;this.num=get_page_number(a);this.original_height=a.clientHeight;this.original_width=a.clientWidth;var b=a.getElementsByClassName(CSS_CLASS_NAMES.page_content_box)[0];b&&(this.content_box=b,this.original_scale=this.cur_scale=this.original_height/b.clientHeight,this.page_data=JSON.parse(a.getElementsByClassName(CSS_CLASS_NAMES.page_data)[0].getAttribute("data-data")),this.ctm=this.page_data.ctm,this.ictm=invert(this.ctm),this.loaded=!0)}}
        Page.prototype={hide:function(){this.loaded&&this.shown&&(this.content_box.classList.remove("opened"),this.shown=!1)},show:function(){this.loaded&&!this.shown&&(this.content_box.classList.add("opened"),this.shown=!0)},rescale:function(a){this.cur_scale=0===a?this.original_scale:a;this.loaded&&(a=this.content_box.style,a.msTransform=a.webkitTransform=a.transform="scale("+this.cur_scale.toFixed(3)+")");a=this.page.style;a.height=this.original_height*this.cur_scale+"px";a.width=this.original_width*this.cur_scale+
        "px"},view_position:function(){var a=this.page,b=a.parentNode;return[b.scrollLeft-a.offsetLeft-a.clientLeft,b.scrollTop-a.offsetTop-a.clientTop]},height:function(){return this.page.clientHeight},width:function(){return this.page.clientWidth}};function Viewer(a){this.config=clone_and_extend_objs(DEFAULT_CONFIG,0<arguments.length?a:{});this.pages_loading=[];this.init_before_loading_content();var b=this;document.addEventListener("DOMContentLoaded",function(){b.init_after_loading_content()},!1)}
        Viewer.prototype={scale:1,cur_page_idx:0,first_page_idx:0,init_before_loading_content:function(){this.pre_hide_pages()},initialize_radio_button:function(){for(var a=document.getElementsByClassName(CSS_CLASS_NAMES.input_radio),b=0;b<a.length;b++)a[b].addEventListener("click",function(){this.classList.toggle("checked")})},init_after_loading_content:function(){this.sidebar=document.getElementById(this.config.sidebar_id);this.outline=document.getElementById(this.config.outline_id);this.container=document.getElementById(this.config.container_id);
        this.loading_indicator=document.getElementsByClassName(this.config.loading_indicator_cls)[0];for(var a=!0,b=this.outline.childNodes,c=0,e=b.length;c<e;++c)if("ul"===b[c].nodeName.toLowerCase()){a=!1;break}a||this.sidebar.classList.add("opened");this.find_pages();if(0!=this.pages.length){disable_dragstart(document.getElementsByClassName(CSS_CLASS_NAMES.background_image));this.config.key_handler&&this.register_key_handler();var h=this;this.config.hashchange_handler&&window.addEventListener("hashchange",
        function(a){h.navigate_to_dest(document.location.hash.substring(1))},!1);this.config.view_history_handler&&window.addEventListener("popstate",function(a){a.state&&h.navigate_to_dest(a.state)},!1);this.container.addEventListener("scroll",function(){h.update_page_idx();h.schedule_render(!0)},!1);[this.container,this.outline].forEach(function(a){a.addEventListener("click",h.link_handler.bind(h),!1)});this.initialize_radio_button();this.render()}},find_pages:function(){for(var a=[],b={},c=this.container.childNodes,
        e=0,h=c.length;e<h;++e){var d=c[e];d.nodeType===Node.ELEMENT_NODE&&d.classList.contains(CSS_CLASS_NAMES.page_frame)&&(d=new Page(d),a.push(d),b[d.num]=a.length-1)}this.pages=a;this.page_map=b},load_page:function(a,b,c){var e=this.pages;if(!(a>=e.length||(e=e[a],e.loaded||this.pages_loading[a]))){var e=e.page,h=e.getAttribute("data-page-url");if(h){this.pages_loading[a]=!0;var d=e.getElementsByClassName(this.config.loading_indicator_cls)[0];"undefined"===typeof d&&(d=this.loading_indicator.cloneNode(!0),
        d.classList.add("active"),e.appendChild(d));var f=this,g=new XMLHttpRequest;g.open("GET",h,!0);g.onload=function(){if(200===g.status||0===g.status){var b=document.createElement("div");b.innerHTML=g.responseText;for(var d=null,b=b.childNodes,e=0,h=b.length;e<h;++e){var p=b[e];if(p.nodeType===Node.ELEMENT_NODE&&p.classList.contains(CSS_CLASS_NAMES.page_frame)){d=p;break}}b=f.pages[a];f.container.replaceChild(d,b.page);b=new Page(d);f.pages[a]=b;b.hide();b.rescale(f.scale);disable_dragstart(d.getElementsByClassName(CSS_CLASS_NAMES.background_image));
        f.schedule_render(!1);c&&c(b)}delete f.pages_loading[a]};g.send(null)}void 0===b&&(b=this.config.preload_pages);0<--b&&(f=this,setTimeout(function(){f.load_page(a+1,b)},0))}},pre_hide_pages:function(){var a="@media screen{."+CSS_CLASS_NAMES.page_content_box+"{display:none;}}",b=document.createElement("style");b.styleSheet?b.styleSheet.cssText=a:b.appendChild(document.createTextNode(a));document.head.appendChild(b)},render:function(){for(var a=this.container,b=a.scrollTop,c=a.clientHeight,a=b-c,b=
        b+c+c,c=this.pages,e=0,h=c.length;e<h;++e){var d=c[e],f=d.page,g=f.offsetTop+f.clientTop,f=g+f.clientHeight;g<=b&&f>=a?d.loaded?d.show():this.load_page(e):d.hide()}},update_page_idx:function(){var a=this.pages,b=a.length;if(!(2>b)){for(var c=this.container,e=c.scrollTop,c=e+c.clientHeight,h=-1,d=b,f=d-h;1<f;){var g=h+Math.floor(f/2),f=a[g].page;f.offsetTop+f.clientTop+f.clientHeight>=e?d=g:h=g;f=d-h}this.first_page_idx=d;for(var g=h=this.cur_page_idx,k=0;d<b;++d){var f=a[d].page,l=f.offsetTop+f.clientTop,
        f=f.clientHeight;if(l>c)break;f=(Math.min(c,l+f)-Math.max(e,l))/f;if(d===h&&Math.abs(f-1)<=EPS){g=h;break}f>k&&(k=f,g=d)}this.cur_page_idx=g}},schedule_render:function(a){if(void 0!==this.render_timer){if(!a)return;clearTimeout(this.render_timer)}var b=this;this.render_timer=setTimeout(function(){delete b.render_timer;b.render()},this.config.render_timeout)},register_key_handler:function(){var a=this;window.addEventListener("DOMMouseScroll",function(b){if(b.ctrlKey){b.preventDefault();var c=a.container,
        e=c.getBoundingClientRect(),c=[b.clientX-e.left-c.clientLeft,b.clientY-e.top-c.clientTop];a.rescale(Math.pow(a.config.scale_step,b.detail),!0,c)}},!1);window.addEventListener("keydown",function(b){var c=!1,e=b.ctrlKey||b.metaKey,h=b.altKey;switch(b.keyCode){case 61:case 107:case 187:e&&(a.rescale(1/a.config.scale_step,!0),c=!0);break;case 173:case 109:case 189:e&&(a.rescale(a.config.scale_step,!0),c=!0);break;case 48:e&&(a.rescale(0,!1),c=!0);break;case 33:h?a.scroll_to(a.cur_page_idx-1):a.container.scrollTop-=
        a.container.clientHeight;c=!0;break;case 34:h?a.scroll_to(a.cur_page_idx+1):a.container.scrollTop+=a.container.clientHeight;c=!0;break;case 35:a.container.scrollTop=a.container.scrollHeight;c=!0;break;case 36:a.container.scrollTop=0,c=!0}c&&b.preventDefault()},!1)},rescale:function(a,b,c){var e=this.scale;this.scale=a=0===a?1:b?e*a:a;c||(c=[0,0]);b=this.container;c[0]+=b.scrollLeft;c[1]+=b.scrollTop;for(var h=this.pages,d=h.length,f=this.first_page_idx;f<d;++f){var g=h[f].page;if(g.offsetTop+g.clientTop>=
        c[1])break}g=f-1;0>g&&(g=0);var g=h[g].page,k=g.clientWidth,f=g.clientHeight,l=g.offsetLeft+g.clientLeft,m=c[0]-l;0>m?m=0:m>k&&(m=k);k=g.offsetTop+g.clientTop;c=c[1]-k;0>c?c=0:c>f&&(c=f);for(f=0;f<d;++f)h[f].rescale(a);b.scrollLeft+=m/e*a+g.offsetLeft+g.clientLeft-m-l;b.scrollTop+=c/e*a+g.offsetTop+g.clientTop-c-k;this.schedule_render(!0)},fit_width:function(){var a=this.cur_page_idx;this.rescale(this.container.clientWidth/this.pages[a].width(),!0);this.scroll_to(a)},fit_height:function(){var a=this.cur_page_idx;
        this.rescale(this.container.clientHeight/this.pages[a].height(),!0);this.scroll_to(a)},get_containing_page:function(a){for(;a;){if(a.nodeType===Node.ELEMENT_NODE&&a.classList.contains(CSS_CLASS_NAMES.page_frame)){a=get_page_number(a);var b=this.page_map;return a in b?this.pages[b[a]]:null}a=a.parentNode}return null},link_handler:function(a){var b=a.target,c=b.getAttribute("data-dest-detail");if(c){if(this.config.view_history_handler)try{var e=this.get_current_view_hash();window.history.replaceState(e,
        "","#"+e);window.history.pushState(c,"","#"+c)}catch(h){}this.navigate_to_dest(c,this.get_containing_page(b));a.preventDefault()}},navigate_to_dest:function(a,b){try{var c=JSON.parse(a)}catch(e){return}if(c instanceof Array){var h=c[0],d=this.page_map;if(h in d){for(var f=d[h],h=this.pages[f],d=2,g=c.length;d<g;++d){var k=c[d];if(null!==k&&"number"!==typeof k)return}for(;6>c.length;)c.push(null);var g=b||this.pages[this.cur_page_idx],d=g.view_position(),d=transform(g.ictm,[d[0],g.height()-d[1]]),
        g=this.scale,l=[0,0],m=!0,k=!1,n=this.scale;switch(c[1]){case "XYZ":l=[null===c[2]?d[0]:c[2]*n,null===c[3]?d[1]:c[3]*n];g=c[4];if(null===g||0===g)g=this.scale;k=!0;break;case "Fit":case "FitB":l=[0,0];k=!0;break;case "FitH":case "FitBH":l=[0,null===c[2]?d[1]:c[2]*n];k=!0;break;case "FitV":case "FitBV":l=[null===c[2]?d[0]:c[2]*n,0];k=!0;break;case "FitR":l=[c[2]*n,c[5]*n],m=!1,k=!0}if(k){this.rescale(g,!1);var p=this,c=function(a){l=transform(a.ctm,l);m&&(l[1]=a.height()-l[1]);p.scroll_to(f,l)};h.loaded?
        c(h):(this.load_page(f,void 0,c),this.scroll_to(f))}}}},scroll_to:function(a,b){var c=this.pages;if(!(0>a||a>=c.length)){c=c[a].view_position();void 0===b&&(b=[0,0]);var e=this.container;e.scrollLeft+=b[0]-c[0];e.scrollTop+=b[1]-c[1]}},get_current_view_hash:function(){var a=[],b=this.pages[this.cur_page_idx];a.push(b.num);a.push("XYZ");var c=b.view_position(),c=transform(b.ictm,[c[0],b.height()-c[1]]);a.push(c[0]/this.scale);a.push(c[1]/this.scale);a.push(this.scale);return JSON.stringify(a)}};
        theViewer.Viewer=Viewer;})();
</script>

<template>
    <Head title="View Travel" />

    <AuthenticatedLayout>
        <template #header>
            <div class="sm:flex sm:items-center sm:justify-between">
        <h2 class="text-lg font-semibold  text-gray-800 dark:text-white">Travel Order</h2>

        <div class="flex items-center mt-4 gap-x-3">


            <button @click="openModal(1)" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_3098_154395)">
                    <path d="M13.3333 13.3332L9.99997 9.9999M9.99997 9.9999L6.66663 13.3332M9.99997 9.9999V17.4999M16.9916 15.3249C17.8044 14.8818 18.4465 14.1806 18.8165 13.3321C19.1866 12.4835 19.2635 11.5359 19.0351 10.6388C18.8068 9.7417 18.2862 8.94616 17.5555 8.37778C16.8248 7.80939 15.9257 7.50052 15 7.4999H13.95C13.6977 6.52427 13.2276 5.61852 12.5749 4.85073C11.9222 4.08295 11.104 3.47311 10.1817 3.06708C9.25943 2.66104 8.25709 2.46937 7.25006 2.50647C6.24304 2.54358 5.25752 2.80849 4.36761 3.28129C3.47771 3.7541 2.70656 4.42249 2.11215 5.23622C1.51774 6.04996 1.11554 6.98785 0.935783 7.9794C0.756025 8.97095 0.803388 9.99035 1.07431 10.961C1.34523 11.9316 1.83267 12.8281 2.49997 13.5832" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_3098_154395">
                    <rect width="20" height="20" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>

                <span>Print</span>
            </button>
        </div>
    </div>
            
        </template>
        
        <!-- i want this on center -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="pf1" class="pf w0 h0" data-page-no="1">
                <div class="pc pc1 w0 h0">
                    <img class="background-image bi x0 y0 w1 h1" >
                        <div class="c x1 y1 w2 h2">
                            <div class="t m0 x2 h3 y2 ff1 fs0 fc0 sc0 ls0 ws0">Republic of the Philippines</div>
                        </div>
                        <div class="c x3 y3 w3 h4">
                            <div class="t m0 x4 h5 y4 ff2 fs1 fc0 sc0 ls0 ws0">Doc. Ref. No.:</div>
                        </div>
                        <div class="c x5 y3 w4 h4"> 
                            <div class="t m0 x6 h5 y4 ff3 fs1 fc0 sc0 ls0 ws0">CA- TO -2023-04-806</div>
                        </div>
                        <div class="c x3 y1 w3 h4">
                            <div class="t m0 x4 h5 y4 ff2 fs1 fc0 sc0 ls0 ws0">Effectivity Date:</div>
                        </div>
                        <div class="c x5 y1 w4 h4">
                            <div class="t m0 x7 h5 y4 ff2 fs1 fc0 sc0 ls0 ws0">4/26/2023</div>
                        </div>
                        <div class="c x1 y5 w2 h4">
                            <div class="t m0 x8 h6 y6 ff3 fs2 fc0 sc0 ls0 ws0">KALINGA STATE UNIVERSITY</div>
                        </div>
                        <div class="c x3 y5 w3 h4">
                            <div class="t m0 x4 h5 y4 ff2 fs1 fc0 sc0 ls0 ws0">Revision No.:</div>
                        </div>
                        <div class="c x5 y5 w4 h4">
                            <div class="t m0 x9 h5 y4 ff2 fs1 fc0 sc0 ls0 ws0">0</div>
                        </div>
                        <div class="c x1 y7 w2 h4">
                            <div class="t m0 xa h3 y8 ff1 fs0 fc0 sc0 ls0 ws0">Bulanao, Tabuk City, Kalinga</div>
                        </div>
                        <div class="c x3 y7 w3 h4">
                            <div class="t m0 x4 h5 y4 ff2 fs1 fc0 sc0 ls0 ws0">Series No.</div>
                        </div>
                        <div class="c x5 y7 w4 h4">
                            <div class="t m0 xb h5 y4 ff2 fs1 fc0 sc0 ls0 ws0">755</div>
                        </div>
                        <div class="c x1 y9 w5 h2">
                            <div class="t m0 xc h7 ya ff3 fs3 fc0 sc0 ls0 ws0">AUTHORITY TO TRAVEL</div>
                        </div>
                        <div class="c x1 yb w6 h4">
                            <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">Name of Official/Employees</div>
                        </div>
                        <div class="c x3 yb w7 h4">
                            <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">Position</div>
                        </div>
                        <div class="c x1 yd w6 h4">
                            <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">JENNIFER BACTAD</div>
                        </div>
                        <div class="c x1 ye w6 h8">
                            <div class="t m0 x4 h3 yf ff3 fs0 fc0 sc0 ls0 ws0">VENUS F. BALILING</div>
                        </div>
                        <div class="c x3 y10 w7 h4">
                            <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">Time of Travel</div>
                        </div>
                        <div class="c xd y11 w8 h4">
                            <div class="t m0 x4 h9 y12 ff4 fs1 fc1 sc0 ls0 ws0"> </div>
                        </div>
                        <div class="c xe y13 w9 h4">
                            <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">Destination: </div>
                        </div>
                        <div class="c x3 y13 w7 h4">
                            <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">Inclusive Date of Travel</div>
                        </div>
                        <div class="c x1 y14 w6 ha">
                            <div class="t m0 xf h3 y15 ff2 fs0 fc0 sc0 ls0 ws0">KSU-Bulanao Kalinga</div>
                        </div>
                        <div class="c xe y14 w9 ha">
                            <div class="t m0 x10 hb y16 ff2 fs4 fc0 sc0 ls0 ws0">LA TRINIDAD, BENGUET</div>
                        </div>
                        <div class="c x3 y17 w7 h4">
                            <div class="t m0 x11 hb y18 ff2 fs4 fc0 sc0 ls0 ws0">MAY 3-5, 2023</div>
                        </div>
                        <div class="c x1 y19 w6 h4">
                            <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">Purpose of Travel:</div>
                        </div>
                        <div class="c x3 y19 w7 h4">
                            <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">Nature of Travel </div>
                        </div>
                        <div class="c x1 y1a w2 hc">
                            <div class="t m0 x4 hb y1b ff2 fs4 fc0 sc0 ls0 ws0">To attend the PAFTE-CAR Students Congress on May 4, 2023 at BSU</div>
                            <div class="t m0 x4 hb y1c ff2 fs4 fc0 sc0 ls0 ws0">Gymnasium Benguet.</div>
                        </div>
                        <div class="c x3 y1d w7 h4">
                            <div class="t m0 x4 h3 yc ff2 fs0 fc0 sc0 ls0 ws0">(x) Official Business</div>
                        </div>
                        <div class="c x3 y1e w7 h4">
                            <div class="t m0 x4 h3 yf ff2 fs0 fc0 sc0 ls0 ws0">() Official Time</div>
                        </div>
                        <div class="c xe y1f w9 h4">
                            <div class="t m0 x7 hd y20 ff5 fs1 fc0 sc0 ls0 ws0">RECOMMENDING APPROVAL:</div>
                        </div>
                        <div class="c x3 y1f w7 h4">
                            <div class="t m0 x12 hd y20 ff5 fs1 fc0 sc0 ls0 ws0">APPROVED BY:</div>
                        </div>
                        <div class="c xe y21 w9 h4">
                            <div class="t m0 x4 h9 y12 ff6 fs1 fc2 sc0 ls0 ws0">ṅṅ</div>
                        </div>
                        <div class="c xe y22 w9 h4">
                            <div class="t m0 x13 hd y20 ff5 fs1 fc3 sc0 ls0 ws0">BRENDA B. LUMINES</div>
                        </div>
                        <div class="c x3 y22 w7 h4">
                            <div class="t m0 x14 hd y20 ff5 fs1 fc0 sc0 ls0 ws0">GIARHARD C. AWIS, MIT</div>
                        </div>
                        <div class="c xe y23 w9 h4">
                            <div class="t m0 x15 he y24 ff2 fs5 fc4 sc0 ls0 ws0">DEAN, COED</div>
                        </div>
                        <div class="c x3 y23 w7 h4">
                            <div class="t m0 x16 he y24 ff1 fs5 fc0 sc0 ls0 ws0">BULANAO CAMPUS ADMINISTRATOR</div>
                        </div>
                        <div class="c x1 y25 w6 hf">
                            <div class="t m0 x4 h5 y20 ff2 fs1 fc1 sc0 ls0 ws0">.</div>
                        </div>
                        <div class="c xe y26 w9 hf">
                            <div class="t m0 x4 h5 y27 ff2 fs1 fc1 sc0 ls0 ws0">            </div>
                        </div>
                        <div class="c x1 y28 w6 hf">
                            <div class="t m0 x17 h5 y27 ff3 fs1 fc1 sc0 ls0 ws0"> </div>
                        </div>
                    </div>
                </div>
            </div>
    </AuthenticatedLayout>
</template>

<style>
.background-image {
  background-image: url('/images/bg1.png');
  background-size: cover;
}
    @keyframes fadein{from{opacity:0}to{opacity:1}}@-webkit-keyframes fadein{from{opacity:0}to{opacity:1}}@keyframes swing{0{transform:rotate(0)}10%{transform:rotate(0)}90%{transform:rotate(720deg)}100%{transform:rotate(720deg)}}@-webkit-keyframes swing{0{-webkit-transform:rotate(0)}10%{-webkit-transform:rotate(0)}90%{-webkit-transform:rotate(720deg)}100%{-webkit-transform:rotate(720deg)}}@media screen{#sidebar{background-color:#2f3236;background-image:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPgo8cmVjdCB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjNDAzYzNmIj48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDBMNCA0Wk00IDBMMCA0WiIgc3Ryb2tlLXdpZHRoPSIxIiBzdHJva2U9IiMxZTI5MmQiPjwvcGF0aD4KPC9zdmc+")}#outline{font-family:Georgia,Times,"Times New Roman",serif;font-size:13px;margin:2em 1em}#outline ul{padding:0}#outline li{list-style-type:none;margin:1em 0}#outline li>ul{margin-left:1em}#outline a,#outline a:visited,#outline a:hover,#outline a:active{line-height:1.2;color:#e8e8e8;text-overflow:ellipsis;white-space:nowrap;text-decoration:none;display:block;overflow:hidden;outline:0}#outline a:hover{color:#0cf}#page-container{background-color:#9e9e9e;background-image:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1IiBoZWlnaHQ9IjUiPgo8cmVjdCB3aWR0aD0iNSIgaGVpZ2h0PSI1IiBmaWxsPSIjOWU5ZTllIj48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDVMNSAwWk02IDRMNCA2Wk0tMSAxTDEgLTFaIiBzdHJva2U9IiM4ODgiIHN0cm9rZS13aWR0aD0iMSI+PC9wYXRoPgo8L3N2Zz4=");-webkit-transition:left 500ms;transition:left 500ms}.pf{margin:13px auto;box-shadow:1px 1px 3px 1px #333;border-collapse:separate}.pc.opened{-webkit-animation:fadein 100ms;animation:fadein 100ms}.loading-indicator.active{-webkit-animation:swing 1.5s ease-in-out .01s infinite alternate none;animation:swing 1.5s ease-in-out .01s infinite alternate none}.checked{background:no-repeat url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3goQDSYgDiGofgAAAslJREFUOMvtlM9LFGEYx7/vvOPM6ywuuyPFihWFBUsdNnA6KLIh+QPx4KWExULdHQ/9A9EfUodYmATDYg/iRewQzklFWxcEBcGgEplDkDtI6sw4PzrIbrOuedBb9MALD7zv+3m+z4/3Bf7bZS2bzQIAcrmcMDExcTeXy10DAFVVAQDksgFUVZ1ljD3yfd+0LOuFpmnvVVW9GHhkZAQcxwkNDQ2FSCQyRMgJxnVdy7KstKZpn7nwha6urqqfTqfPBAJAuVymlNLXoigOhfd5nmeiKL5TVTV+lmIKwAOA7u5u6Lped2BsbOwjY6yf4zgQQkAIAcedaPR9H67r3uYBQFEUFItFtLe332lpaVkUBOHK3t5eRtf1DwAwODiIubk5DA8PM8bYW1EU+wEgCIJqsCAIQAiB7/u253k2BQDDMJBKpa4mEon5eDx+UxAESJL0uK2t7XosFlvSdf0QAEmlUnlRFJ9Waho2Qghc1/U9z3uWz+eX+Wr+lL6SZfleEAQIggA8z6OpqSknimIvYyybSCReMsZ6TislhCAIAti2Dc/zejVNWwCAavN8339j27YbTg0AGGM3WltbP4WhlRWq6Q/btrs1TVsYHx+vNgqKoqBUKn2NRqPFxsbGJzzP05puUlpt0ukyOI6z7zjOwNTU1OLo6CgmJyf/gA3DgKIoWF1d/cIY24/FYgOU0pp0z/Ityzo8Pj5OTk9PbwHA+vp6zWghDC+VSiuRSOQgGo32UErJ38CO42wdHR09LBQK3zKZDDY2NupmFmF4R0cHVlZWlmRZ/iVJUn9FeWWcCCE4ODjYtG27Z2Zm5juAOmgdGAB2d3cBADs7O8uSJN2SZfl+WKlpmpumaT6Yn58vn/fs6XmbhmHMNjc3tzDGFI7jYJrm5vb29sDa2trPC/9aiqJUy5pOp4f6+vqeJ5PJBAB0dnZe/t8NBajx/z37Df5OGX8d13xzAAAAAElFTkSuQmCC)}};
    #sidebar{position:absolute;top:0;left:0;bottom:0;width:250px;padding:0;margin:0;overflow:auto}#page-container{position:absolute;top:0;left:0;margin:0;padding:0;border:0}@media screen{#sidebar.opened+#page-container{left:250px}#page-container{bottom:0;right:0;overflow:auto}.loading-indicator{display:none}.loading-indicator.active{display:block;position:absolute;width:64px;height:64px;top:50%;left:50%;margin-top:-32px;margin-left:-32px}.loading-indicator img{position:absolute;top:0;left:0;bottom:0;right:0}}@media print{@page{margin:0}html{margin:0}body{margin:0;-webkit-print-color-adjust:exact}#sidebar{display:none}#page-container{width:auto;height:auto;overflow:visible;background-color:transparent}.d{display:none}}.pf{position:relative;background-color:white;overflow:hidden;margin:0;border:0}.pc{position:absolute;border:0;padding:0;margin:0;top:0;left:0;width:100%;height:100%;overflow:hidden;display:block;transform-origin:0 0;-ms-transform-origin:0 0;-webkit-transform-origin:0 0}.pc.opened{display:block}.bf{position:absolute;border:0;margin:0;top:0;bottom:0;width:100%;height:100%;-ms-user-select:none;-moz-user-select:none;-webkit-user-select:none;user-select:none}.bi{position:absolute;border:0;margin:0;-ms-user-select:none;-moz-user-select:none;-webkit-user-select:none;user-select:none}@media print{.pf{margin:0;box-shadow:none;page-break-after:always;page-break-inside:avoid}@-moz-document url-prefix(){.pf{overflow:visible;border:1px solid #fff}.pc{overflow:visible}}}.c{position:absolute;border:0;padding:0;margin:0;overflow:hidden;display:block}.t{position:absolute;white-space:pre;font-size:1px;transform-origin:0 100%;-ms-transform-origin:0 100%;-webkit-transform-origin:0 100%;unicode-bidi:bidi-override;-moz-font-feature-settings:"liga" 0}.t:after{content:''}.t:before{content:'';display:inline-block}.t span{position:relative;unicode-bidi:bidi-override}._{display:inline-block;color:transparent;z-index:-1}::selection{background:rgba(127,255,255,0.4)}::-moz-selection{background:rgba(127,255,255,0.4)}.pi{display:none}.d{position:absolute;transform-origin:0 100%;-ms-transform-origin:0 100%;-webkit-transform-origin:0 100%}.it{border:0;background-color:rgba(255,255,255,0.0)}.ir:hover{cursor:pointer}
    .ff0{font-family:sans-serif;visibility:hidden;}
    @font-face{font-family:ff1;src:url()format("woff");}.ff1{font-family:ff1;line-height:0.988281;font-style:normal;font-weight:normal;visibility:visible;}
    @font-face{font-family:ff2;src:url()format("woff");}.ff2{font-family:ff2;line-height:0.988281;font-style:normal;font-weight:normal;visibility:visible;}
    @font-face{font-family:ff3;src:url()format("woff");}.ff3{font-family:ff3;line-height:0.976074;font-style:normal;font-weight:normal;visibility:visible;}
    @font-face{font-family:ff4;src:url()format("woff");}.ff4{font-family:ff4;line-height:0.666504;font-style:normal;font-weight:normal;visibility:visible;}
    @font-face{font-family:ff5;src:url()format("woff");}.ff5{font-family:ff5;line-height:0.885254;font-style:normal;font-weight:normal;visibility:visible;}
    @font-face{font-family:ff6;src:url()format("woff");}.ff6{font-family:ff6;line-height:0.669434;font-style:normal;font-weight:normal;visibility:visible;}
    .m0{transform:matrix(0.250000,0.000000,0.000000,0.250000,0,0);-ms-transform:matrix(0.250000,0.000000,0.000000,0.250000,0,0);-webkit-transform:matrix(0.250000,0.000000,0.000000,0.250000,0,0);}
    .v0{vertical-align:0.000000px;}
    .ls0{letter-spacing:0.000000px;}
    .sc_{text-shadow:none;}
    .sc0{text-shadow:-0.015em 0 transparent,0 0.015em transparent,0.015em 0 transparent,0 -0.015em  transparent;}
    @media screen and (-webkit-min-device-pixel-ratio:0){
    .sc_{-webkit-text-stroke:0px transparent;}
    .sc0{-webkit-text-stroke:0.015em transparent;text-shadow:none;}
    }
    .ws0{word-spacing:0.000000px;}
    .fc3{color:rgb(91,155,213);}
    .fc0{color:rgb(0,112,192);}
    .fc1{color:rgb(0,0,0);}
    .fc4{color:rgb(47,85,151);}
    .fc2{color:rgb(255,255,255);}
    .fs5{font-size:44.160000px;}
    .fs1{font-size:48.000000px;}
    .fs4{font-size:56.160000px;}
    .fs0{font-size:63.840000px;}
    .fs2{font-size:72.000000px;}
    .fs3{font-size:87.840000px;}
    .y24{bottom:3.047900px;}
    .y20{bottom:3.250500px;}
    .y27{bottom:3.250600px;}
    .y18{bottom:3.680800px;}
    .y12{bottom:3.719200px;}
    .yc{bottom:4.085800px;}
    .yf{bottom:4.085900px;}
    .y6{bottom:4.516100px;}
    .y8{bottom:5.176100px;}
    .y4{bottom:6.885000px;}
    .ya{bottom:14.074200px;}
    .y2{bottom:16.079600px;}
    .y15{bottom:26.983100px;}
    .y16{bottom:27.668500px;}
    .y0{bottom:53.500000px;}
    .y1c{bottom:97.693200px;}
    .y1b{bottom:115.138800px;}
    .y28{bottom:1526.949300px;}
    .y26{bottom:1541.971900px;}
    .y25{bottom:1647.372400px;}
    .y23{bottom:1684.202000px;}
    .y22{bottom:1706.009000px;}
    .y21{bottom:1793.237000px;}
    .y1f{bottom:1858.658000px;}
    .y1a{bottom:1880.465100px;}
    .y1e{bottom:1902.272000px;}
    .y1d{bottom:1967.693100px;}
    .y19{bottom:2011.307100px;}
    .y14{bottom:2076.728100px;}
    .y17{bottom:2098.535100px;}
    .y13{bottom:2163.956100px;}
    .y11{bottom:2272.991100px;}
    .y10{bottom:2316.605100px;}
    .ye{bottom:2338.412100px;}
    .yd{bottom:2360.219200px;}
    .yb{bottom:2403.833200px;}
    .y9{bottom:2447.447200px;}
    .y7{bottom:2512.868200px;}
    .y5{bottom:2534.675200px;}
    .y1{bottom:2556.482200px;}
    .y3{bottom:2578.289200px;}
    .hf{height:14.522600px;}
    .h4{height:21.307000px;}
    .h8{height:21.307100px;}
    .h9{height:31.992188px;}
    .he{height:34.586250px;}
    .hd{height:35.554688px;}
    .h5{height:37.593750px;}
    .h2{height:43.114000px;}
    .hb{height:43.984687px;}
    .h3{height:49.999688px;}
    .h6{height:56.390625px;}
    .ha{height:64.921000px;}
    .h7{height:68.796562px;}
    .hc{height:130.342000px;}
    .h1{height:2547.500000px;}
    .h0{height:2653.846200px;}
    .w8{width:51.101700px;}
    .w3{width:117.216500px;}
    .w4{width:187.362500px;}
    .w6{width:255.089800px;}
    .w9{width:302.660200px;}
    .w7{width:305.079000px;}
    .w2{width:558.250100px;}
    .w5{width:863.829100px;}
    .w1{width:866.000000px;}
    .w0{width:1068.332500px;}
    .x4{left:1.825000px;}
    .x6{left:27.868800px;}
    .xf{left:44.542000px;}
    .x0{left:49.500000px;}
    .x1{left:50.650000px;}
    .x16{left:53.883000px;}
    .x7{left:60.760400px;}
    .x10{left:67.083300px;}
    .x14{left:75.816800px;}
    .xb{left:82.299400px;}
    .x13{left:87.679700px;}
    .x9{left:89.887300px;}
    .x11{left:101.048100px;}
    .x12{left:106.209400px;}
    .x17{left:114.138700px;}
    .x15{left:116.504000px;}
    .x8{left:142.015700px;}
    .xa{left:162.195400px;}
    .x2{left:173.678400px;}
    .xc{left:291.362000px;}
    .xe{left:306.239800px;}
    .x3{left:609.400100px;}
    .x5{left:727.116500px;}
    .xd{left:966.580800px;}
    @media print{
    .v0{vertical-align:0.000000pt;}
    .ls0{letter-spacing:0.000000pt;}
    .ws0{word-spacing:0.000000pt;}
    .fs5{font-size:58.880000pt;}
    .fs1{font-size:64.000000pt;}
    .fs4{font-size:74.880000pt;}
    .fs0{font-size:85.120000pt;}
    .fs2{font-size:96.000000pt;}
    .fs3{font-size:117.120000pt;}
    .y24{bottom:4.063867pt;}
    .y20{bottom:4.334000pt;}
    .y27{bottom:4.334133pt;}
    .y18{bottom:4.907733pt;}
    .y12{bottom:4.958933pt;}
    .yc{bottom:5.447733pt;}
    .yf{bottom:5.447867pt;}
    .y6{bottom:6.021467pt;}
    .y8{bottom:6.901467pt;}
    .y4{bottom:9.180000pt;}
    .ya{bottom:18.765600pt;}
    .y2{bottom:21.439467pt;}
    .y15{bottom:35.977467pt;}
    .y16{bottom:36.891333pt;}
    .y0{bottom:71.333333pt;}
    .y1c{bottom:130.257600pt;}
    .y1b{bottom:153.518400pt;}
    .y28{bottom:2035.932400pt;}
    .y26{bottom:2055.962533pt;}
    .y25{bottom:2196.496533pt;}
    .y23{bottom:2245.602667pt;}
    .y22{bottom:2274.678667pt;}
    .y21{bottom:2390.982667pt;}
    .y1f{bottom:2478.210667pt;}
    .y1a{bottom:2507.286800pt;}
    .y1e{bottom:2536.362667pt;}
    .y1d{bottom:2623.590800pt;}
    .y19{bottom:2681.742800pt;}
    .y14{bottom:2768.970800pt;}
    .y17{bottom:2798.046800pt;}
    .y13{bottom:2885.274800pt;}
    .y11{bottom:3030.654800pt;}
    .y10{bottom:3088.806800pt;}
    .ye{bottom:3117.882800pt;}
    .yd{bottom:3146.958933pt;}
    .yb{bottom:3205.110933pt;}
    .y9{bottom:3263.262933pt;}
    .y7{bottom:3350.490933pt;}
    .y5{bottom:3379.566933pt;}
    .y1{bottom:3408.642933pt;}
    .y3{bottom:3437.718933pt;}
    .hf{height:19.363467pt;}
    .h4{height:28.409333pt;}
    .h8{height:28.409467pt;}
    .h9{height:42.656250pt;}
    .he{height:46.115000pt;}
    .hd{height:47.406250pt;}
    .h5{height:50.125000pt;}
    .h2{height:57.485333pt;}
    .hb{height:58.646250pt;}
    .h3{height:66.666250pt;}
    .h6{height:75.187500pt;}
    .ha{height:86.561333pt;}
    .h7{height:91.728750pt;}
    .hc{height:173.789333pt;}
    .h1{height:3396.666667pt;}
    .h0{height:3538.461600pt;}
    .w8{width:68.135600pt;}
    .w3{width:156.288667pt;}
    .w4{width:249.816667pt;}
    .w6{width:340.119733pt;}
    .w9{width:403.546933pt;}
    .w7{width:406.772000pt;}
    .w2{width:744.333467pt;}
    .w5{width:1151.772133pt;}
    .w1{width:1154.666667pt;}
    .w0{width:1424.443333pt;}
    .x4{left:2.433333pt;}
    .x6{left:37.158400pt;}
    .xf{left:59.389333pt;}
    .x0{left:66.000000pt;}
    .x1{left:67.533333pt;}
    .x16{left:71.844000pt;}
    .x7{left:81.013867pt;}
    .x10{left:89.444400pt;}
    .x14{left:101.089067pt;}
    .xb{left:109.732533pt;}
    .x13{left:116.906267pt;}
    .x9{left:119.849733pt;}
    .x11{left:134.730800pt;}
    .x12{left:141.612533pt;}
    .x17{left:152.184933pt;}
    .x15{left:155.338667pt;}
    .x8{left:189.354267pt;}
    .xa{left:216.260533pt;}
    .x2{left:231.571200pt;}
    .xc{left:388.482667pt;}
    .xe{left:408.319733pt;}
    .x3{left:812.533467pt;}
    .x5{left:969.488667pt;}
    .xd{left:1288.774400pt;}
    }

</style>