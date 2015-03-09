 self.onError=null;
 currentX = currentY = 0;
 whichIt = null;
 lastScrollX = 0; lastScrollY = 0;
 NS = navigator.appName == "Netscape";
 IE = navigator.appName == "Microsoft Internet Explorer";
 if(NS) NSVer=parseFloat(navigator.appVersion);
 function scrollmenu() {
 if(IE) { diffY = document.body.scrollTop; diffX = document.body.scrollLeft; }
 if(NS) { diffY = self.pageYOffset; diffX = self.pageXOffset; }
 if(diffY!=lastScrollY) {
 percent=.1*(diffY-lastScrollY);
 if(percent>0) percent=Math.ceil(percent);
 else percent=Math.floor(percent);
 if(IE) document.all.FlashMenuLabs.style.pixelTop+=percent;
 if(NS){
 if (NSVer>4){
 menu=document.getElementById("FlashMenuLabs");
 menu.style.top=parseInt(menu.style.top)+percent+"px";
 }else
 document.FlashMenuLabs.top += percent;
 }
 lastScrollY = lastScrollY + percent;
 }
 if(diffX!=lastScrollX) {
 percent=.1*(diffX-lastScrollX);
 if(percent>0) percent=Math.ceil(percent);
 else percent=Math.floor(percent);
 if(IE) document.all.FlashMenuLabs.style.pixelTop+=percent;
 if(NS){
 if (NSVer>4){
 menu=document.getElementById("FlashMenuLabs");
 menu.style.top=parseInt(menu.style.top)+percent+"px";
 }else
 document.FlashMenuLabs.top += percent;
 }
 lastScrollX = lastScrollX + percent;
 }
 }if(NS || IE) action = window.setInterval("scrollmenu()",1);
