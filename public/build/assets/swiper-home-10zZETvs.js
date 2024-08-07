import{m as u,e as H,a as O,c as F,b as E,S as T,A as q}from"./autoplay-BGHAakiq.js";function x(b){return b===void 0&&(b=""),`.${b.trim().replace(/([\.:!+\/])/g,"\\$1").replace(/ /g,".")}`}function G(b){let{swiper:e,extendParams:P,on:g,emit:y}=b;const d="swiper-pagination";P({pagination:{el:null,bulletElement:"span",clickable:!1,hideOnClick:!1,renderBullet:null,renderProgressbar:null,renderFraction:null,renderCustom:null,progressbarOpposite:!1,type:"bullets",dynamicBullets:!1,dynamicMainBullets:1,formatFractionCurrent:a=>a,formatFractionTotal:a=>a,bulletClass:`${d}-bullet`,bulletActiveClass:`${d}-bullet-active`,modifierClass:`${d}-`,currentClass:`${d}-current`,totalClass:`${d}-total`,hiddenClass:`${d}-hidden`,progressbarFillClass:`${d}-progressbar-fill`,progressbarOppositeClass:`${d}-progressbar-opposite`,clickableClass:`${d}-clickable`,lockClass:`${d}-lock`,horizontalClass:`${d}-horizontal`,verticalClass:`${d}-vertical`,paginationDisabledClass:`${d}-disabled`}}),e.pagination={el:null,bullets:[]};let L,m=0;function k(){return!e.params.pagination.el||!e.pagination.el||Array.isArray(e.pagination.el)&&e.pagination.el.length===0}function A(a,s){const{bulletActiveClass:t}=e.params.pagination;a&&(a=a[`${s==="prev"?"previous":"next"}ElementSibling`],a&&(a.classList.add(`${t}-${s}`),a=a[`${s==="prev"?"previous":"next"}ElementSibling`],a&&a.classList.add(`${t}-${s}-${s}`)))}function S(a){const s=a.target.closest(x(e.params.pagination.bulletClass));if(!s)return;a.preventDefault();const t=O(s)*e.params.slidesPerGroup;if(e.params.loop){if(e.realIndex===t)return;e.slideToLoop(t)}else e.slideTo(t)}function h(){const a=e.rtl,s=e.params.pagination;if(k())return;let t=e.pagination.el;t=u(t);let i,p;const C=e.virtual&&e.params.virtual.enabled?e.virtual.slides.length:e.slides.length,I=e.params.loop?Math.ceil(C/e.params.slidesPerGroup):e.snapGrid.length;if(e.params.loop?(p=e.previousRealIndex||0,i=e.params.slidesPerGroup>1?Math.floor(e.realIndex/e.params.slidesPerGroup):e.realIndex):typeof e.snapIndex<"u"?(i=e.snapIndex,p=e.previousSnapIndex):(p=e.previousIndex||0,i=e.activeIndex||0),s.type==="bullets"&&e.pagination.bullets&&e.pagination.bullets.length>0){const l=e.pagination.bullets;let f,c,$;if(s.dynamicBullets&&(L=H(l[0],e.isHorizontal()?"width":"height"),t.forEach(n=>{n.style[e.isHorizontal()?"width":"height"]=`${L*(s.dynamicMainBullets+4)}px`}),s.dynamicMainBullets>1&&p!==void 0&&(m+=i-(p||0),m>s.dynamicMainBullets-1?m=s.dynamicMainBullets-1:m<0&&(m=0)),f=Math.max(i-m,0),c=f+(Math.min(l.length,s.dynamicMainBullets)-1),$=(c+f)/2),l.forEach(n=>{const r=[...["","-next","-next-next","-prev","-prev-prev","-main"].map(o=>`${s.bulletActiveClass}${o}`)].map(o=>typeof o=="string"&&o.includes(" ")?o.split(" "):o).flat();n.classList.remove(...r)}),t.length>1)l.forEach(n=>{const r=O(n);r===i?n.classList.add(...s.bulletActiveClass.split(" ")):e.isElement&&n.setAttribute("part","bullet"),s.dynamicBullets&&(r>=f&&r<=c&&n.classList.add(...`${s.bulletActiveClass}-main`.split(" ")),r===f&&A(n,"prev"),r===c&&A(n,"next"))});else{const n=l[i];if(n&&n.classList.add(...s.bulletActiveClass.split(" ")),e.isElement&&l.forEach((r,o)=>{r.setAttribute("part",o===i?"bullet-active":"bullet")}),s.dynamicBullets){const r=l[f],o=l[c];for(let v=f;v<=c;v+=1)l[v]&&l[v].classList.add(...`${s.bulletActiveClass}-main`.split(" "));A(r,"prev"),A(o,"next")}}if(s.dynamicBullets){const n=Math.min(l.length,s.dynamicMainBullets+4),r=(L*n-L)/2-$*L,o=a?"right":"left";l.forEach(v=>{v.style[e.isHorizontal()?o:"top"]=`${r}px`})}}t.forEach((l,f)=>{if(s.type==="fraction"&&(l.querySelectorAll(x(s.currentClass)).forEach(c=>{c.textContent=s.formatFractionCurrent(i+1)}),l.querySelectorAll(x(s.totalClass)).forEach(c=>{c.textContent=s.formatFractionTotal(I)})),s.type==="progressbar"){let c;s.progressbarOpposite?c=e.isHorizontal()?"vertical":"horizontal":c=e.isHorizontal()?"horizontal":"vertical";const $=(i+1)/I;let n=1,r=1;c==="horizontal"?n=$:r=$,l.querySelectorAll(x(s.progressbarFillClass)).forEach(o=>{o.style.transform=`translate3d(0,0,0) scaleX(${n}) scaleY(${r})`,o.style.transitionDuration=`${e.params.speed}ms`})}s.type==="custom"&&s.renderCustom?(l.innerHTML=s.renderCustom(e,i+1,I),f===0&&y("paginationRender",l)):(f===0&&y("paginationRender",l),y("paginationUpdate",l)),e.params.watchOverflow&&e.enabled&&l.classList[e.isLocked?"add":"remove"](s.lockClass)})}function B(){const a=e.params.pagination;if(k())return;const s=e.virtual&&e.params.virtual.enabled?e.virtual.slides.length:e.grid&&e.params.grid.rows>1?e.slides.length/Math.ceil(e.params.grid.rows):e.slides.length;let t=e.pagination.el;t=u(t);let i="";if(a.type==="bullets"){let p=e.params.loop?Math.ceil(s/e.params.slidesPerGroup):e.snapGrid.length;e.params.freeMode&&e.params.freeMode.enabled&&p>s&&(p=s);for(let C=0;C<p;C+=1)a.renderBullet?i+=a.renderBullet.call(e,C,a.bulletClass):i+=`<${a.bulletElement} ${e.isElement?'part="bullet"':""} class="${a.bulletClass}"></${a.bulletElement}>`}a.type==="fraction"&&(a.renderFraction?i=a.renderFraction.call(e,a.currentClass,a.totalClass):i=`<span class="${a.currentClass}"></span> / <span class="${a.totalClass}"></span>`),a.type==="progressbar"&&(a.renderProgressbar?i=a.renderProgressbar.call(e,a.progressbarFillClass):i=`<span class="${a.progressbarFillClass}"></span>`),e.pagination.bullets=[],t.forEach(p=>{a.type!=="custom"&&(p.innerHTML=i||""),a.type==="bullets"&&e.pagination.bullets.push(...p.querySelectorAll(x(a.bulletClass)))}),a.type!=="custom"&&y("paginationRender",t[0])}function M(){e.params.pagination=F(e,e.originalParams.pagination,e.params.pagination,{el:"swiper-pagination"});const a=e.params.pagination;if(!a.el)return;let s;typeof a.el=="string"&&e.isElement&&(s=e.el.querySelector(a.el)),!s&&typeof a.el=="string"&&(s=[...document.querySelectorAll(a.el)]),s||(s=a.el),!(!s||s.length===0)&&(e.params.uniqueNavElements&&typeof a.el=="string"&&Array.isArray(s)&&s.length>1&&(s=[...e.el.querySelectorAll(a.el)],s.length>1&&(s=s.filter(t=>E(t,".swiper")[0]===e.el)[0])),Array.isArray(s)&&s.length===1&&(s=s[0]),Object.assign(e.pagination,{el:s}),s=u(s),s.forEach(t=>{a.type==="bullets"&&a.clickable&&t.classList.add(...(a.clickableClass||"").split(" ")),t.classList.add(a.modifierClass+a.type),t.classList.add(e.isHorizontal()?a.horizontalClass:a.verticalClass),a.type==="bullets"&&a.dynamicBullets&&(t.classList.add(`${a.modifierClass}${a.type}-dynamic`),m=0,a.dynamicMainBullets<1&&(a.dynamicMainBullets=1)),a.type==="progressbar"&&a.progressbarOpposite&&t.classList.add(a.progressbarOppositeClass),a.clickable&&t.addEventListener("click",S),e.enabled||t.classList.add(a.lockClass)}))}function z(){const a=e.params.pagination;if(k())return;let s=e.pagination.el;s&&(s=u(s),s.forEach(t=>{t.classList.remove(a.hiddenClass),t.classList.remove(a.modifierClass+a.type),t.classList.remove(e.isHorizontal()?a.horizontalClass:a.verticalClass),a.clickable&&(t.classList.remove(...(a.clickableClass||"").split(" ")),t.removeEventListener("click",S))})),e.pagination.bullets&&e.pagination.bullets.forEach(t=>t.classList.remove(...a.bulletActiveClass.split(" ")))}g("changeDirection",()=>{if(!e.pagination||!e.pagination.el)return;const a=e.params.pagination;let{el:s}=e.pagination;s=u(s),s.forEach(t=>{t.classList.remove(a.horizontalClass,a.verticalClass),t.classList.add(e.isHorizontal()?a.horizontalClass:a.verticalClass)})}),g("init",()=>{e.params.pagination.enabled===!1?w():(M(),B(),h())}),g("activeIndexChange",()=>{typeof e.snapIndex>"u"&&h()}),g("snapIndexChange",()=>{h()}),g("snapGridLengthChange",()=>{B(),h()}),g("destroy",()=>{z()}),g("enable disable",()=>{let{el:a}=e.pagination;a&&(a=u(a),a.forEach(s=>s.classList[e.enabled?"remove":"add"](e.params.pagination.lockClass)))}),g("lock unlock",()=>{h()}),g("click",(a,s)=>{const t=s.target,i=u(e.pagination.el);if(e.params.pagination.el&&e.params.pagination.hideOnClick&&i&&i.length>0&&!t.classList.contains(e.params.pagination.bulletClass)){if(e.navigation&&(e.navigation.nextEl&&t===e.navigation.nextEl||e.navigation.prevEl&&t===e.navigation.prevEl))return;const p=i[0].classList.contains(e.params.pagination.hiddenClass);y(p===!0?"paginationShow":"paginationHide"),i.forEach(C=>C.classList.toggle(e.params.pagination.hiddenClass))}});const D=()=>{e.el.classList.remove(e.params.pagination.paginationDisabledClass);let{el:a}=e.pagination;a&&(a=u(a),a.forEach(s=>s.classList.remove(e.params.pagination.paginationDisabledClass))),M(),B(),h()},w=()=>{e.el.classList.add(e.params.pagination.paginationDisabledClass);let{el:a}=e.pagination;a&&(a=u(a),a.forEach(s=>s.classList.add(e.params.pagination.paginationDisabledClass))),z()};Object.assign(e.pagination,{enable:D,disable:w,render:B,update:h,init:M,destroy:z})}new T(".home-swiper",{modules:[G,q],loop:!0,pagination:{el:".swiper-pagination",enabled:!0,clickable:!0},updateOnWindowResize:!0,autoplay:{delay:5e3,pauseOnMouseEnter:!0}});
