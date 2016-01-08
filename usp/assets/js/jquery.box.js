/**
 * bootbox.js v3.3.0
 *
 * http://bootboxjs.com/license.txt
 */
var bootbox=window.bootbox||function(e,t){function h(e,t){if(typeof t==="undefined"){t=n}if(typeof c[t][e]==="string"){return c[t][e]}if(t!=r){return h(e,r)}return e}var n="en",r="en",i=true,s="static",o="javascript:;",u="",a={},f={},l={};l.setLocale=function(e){for(var t in c){if(t==e){n=e;return}}throw new Error("Invalid locale: "+e)};l.addLocale=function(e,t){if(typeof c[e]==="undefined"){c[e]={}}for(var n in t){c[e][n]=t[n]}};l.setIcons=function(e){f=e;if(typeof f!=="object"||f===null){f={}}};l.setBtnClasses=function(e){a=e;if(typeof a!=="object"||a===null){a={}}};l.alert=function(){var e="",t=h("OK"),n=null;switch(arguments.length){case 1:e=arguments[0];break;case 2:e=arguments[0];if(typeof arguments[1]=="function"){n=arguments[1]}else{t=arguments[1]}break;case 3:e=arguments[0];t=arguments[1];n=arguments[2];break;default:throw new Error("Incorrect number of arguments: expected 1-3")}return l.dialog(e,{label:t,icon:f.OK,"class":a.OK,callback:n},{onEscape:n||true})};l.confirm=function(){var e="",t=h("CANCEL"),n=h("CONFIRM"),r=null;switch(arguments.length){case 1:e=arguments[0];break;case 2:e=arguments[0];if(typeof arguments[1]=="function"){r=arguments[1]}else{t=arguments[1]}break;case 3:e=arguments[0];t=arguments[1];if(typeof arguments[2]=="function"){r=arguments[2]}else{n=arguments[2]}break;case 4:e=arguments[0];t=arguments[1];n=arguments[2];r=arguments[3];break;default:throw new Error("Incorrect number of arguments: expected 1-4")}var i=function(){if(typeof r==="function"){return r(false)}};var s=function(){if(typeof r==="function"){return r(true)}};return l.dialog(e,[{label:t,icon:f.CANCEL,"class":a.CANCEL,callback:i},{label:n,icon:f.CONFIRM,"class":a.CONFIRM,callback:s}],{onEscape:i})};l.prompt=function(){var e="",n=h("CANCEL"),r=h("CONFIRM"),i=null,s="";switch(arguments.length){case 1:e=arguments[0];break;case 2:e=arguments[0];if(typeof arguments[1]=="function"){i=arguments[1]}else{n=arguments[1]}break;case 3:e=arguments[0];n=arguments[1];if(typeof arguments[2]=="function"){i=arguments[2]}else{r=arguments[2]}break;case 4:e=arguments[0];n=arguments[1];r=arguments[2];i=arguments[3];break;case 5:e=arguments[0];n=arguments[1];r=arguments[2];i=arguments[3];s=arguments[4];break;default:throw new Error("Incorrect number of arguments: expected 1-5")}var o=e;var u=t("<form></form>");u.append("<input class='input-block-level' autocomplete=off type=text value='"+s+"' />");var c=function(){if(typeof i==="function"){return i(null)}};var p=function(){if(typeof i==="function"){return i(u.find("input[type=text]").val())}};var d=l.dialog(u,[{label:n,icon:f.CANCEL,"class":a.CANCEL,callback:c},{label:r,icon:f.CONFIRM,"class":a.CONFIRM,callback:p}],{header:o,show:false,onEscape:c});d.on("shown",function(){u.find("input[type=text]").focus();u.on("submit",function(e){e.preventDefault();d.find(".btn-primary").click()})});d.modal("show");return d};l.dialog=function(n,r,a){function N(e){var t=null;if(typeof a.onEscape==="function"){t=a.onEscape()}if(t!==false){S.modal("hide")}}var f="",l=[];if(!a){a={}}if(typeof r==="undefined"){r=[]}else if(typeof r.length=="undefined"){r=[r]}var c=r.length;while(c--){var h=null,p=null,d=null,v="",m=null;if(typeof r[c]["label"]=="undefined"&&typeof r[c]["class"]=="undefined"&&typeof r[c]["callback"]=="undefined"){var g=0,y=null;for(var b in r[c]){y=b;if(++g>1){break}}if(g==1&&typeof r[c][b]=="function"){r[c]["label"]=y;r[c]["callback"]=r[c][b]}}if(typeof r[c]["callback"]=="function"){m=r[c]["callback"]}if(r[c]["class"]){d=r[c]["class"]}else if(c==r.length-1&&r.length<=2){d="btn-primary"}if(r[c]["link"]!==true){d="btn "+d}if(r[c]["label"]){h=r[c]["label"]}else{h="Option "+(c+1)}if(r[c]["icon"]){v="<i class='"+r[c]["icon"]+"'></i> "}if(r[c]["href"]){p=r[c]["href"]}else{p=o}f="<a data-handler='"+c+"' class='"+d+"' href='../../../UltimateSpeed1.5/assets/js/"+p+"'>"+v+""+h+"</a>"+f;l[c]=m}var w=["<div class='bootbox modal' tabindex='-1' style='overflow:hidden;'><div class='modal-dialog'><div class='modal-content'>"];if(a["header"]){var E="";if(typeof a["headerCloseButton"]=="undefined"||a["headerCloseButton"]){E="<a href='../../../UltimateSpeed1.5/assets/js/"+o+"' class='close'>×</a>"}w.push("<div class='modal-header'>"+E+"<h3 class='modal-title'>"+a["header"]+"</h3></div>")}w.push("<div class='modal-body'></div>");if(f){w.push("<div class='modal-footer'>"+f+"</div>")}w.push("</div></div></div>");var S=t(w.join("\n"));var x=typeof a.animate==="undefined"?i:a.animate;if(x){S.addClass("fade")}var T=typeof a.classes==="undefined"?u:a.classes;if(T){S.addClass(T)}S.find(".modal-body").html(n);S.on("keyup.dismiss.modal",function(e){if(e.which===27&&a.onEscape){N("escape")}});S.on("click","a.close",function(e){e.preventDefault();N("close")});S.on("shown",function(){S.find("a.btn-primary:first").focus()});S.on("hidden",function(e){if(e.target===this){S.remove()}});S.on("click",".modal-footer a",function(e){var n=t(this).data("handler"),i=l[n],s=null;if(typeof n!=="undefined"&&typeof r[n]["href"]!=="undefined"){return}e.preventDefault();if(typeof i==="function"){s=i(e)}if(s!==false){S.modal("hide")}});t("body").append(S);S.modal({backdrop:typeof a.backdrop==="undefined"?s:a.backdrop,keyboard:false,show:false});S.on("show",function(n){t(e).off("focusin.modal")});if(typeof a.show==="undefined"||a.show===true){S.modal("show")}return S};l.modal=function(){var e;var n;var r;var i={onEscape:null,keyboard:true,backdrop:s};switch(arguments.length){case 1:e=arguments[0];break;case 2:e=arguments[0];if(typeof arguments[1]=="object"){r=arguments[1]}else{n=arguments[1]}break;case 3:e=arguments[0];n=arguments[1];r=arguments[2];break;default:throw new Error("Incorrect number of arguments: expected 1-3")}i["header"]=n;if(typeof r=="object"){r=t.extend(i,r)}else{r=i}return l.dialog(e,[],r)};l.hideAll=function(){t(".bootbox").modal("hide")};l.animate=function(e){i=e};l.backdrop=function(e){s=e};l.classes=function(e){u=e};var c={br:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Sim"},da:{OK:"OK",CANCEL:"Annuller",CONFIRM:"Accepter"},de:{OK:"OK",CANCEL:"Abbrechen",CONFIRM:"Akzeptieren"},en:{OK:"OK",CANCEL:"Cancel",CONFIRM:"OK"},es:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Aceptar"},fr:{OK:"OK",CANCEL:"Annuler",CONFIRM:"D'accord"},it:{OK:"OK",CANCEL:"Annulla",CONFIRM:"Conferma"},nl:{OK:"OK",CANCEL:"Annuleren",CONFIRM:"Accepteren"},pl:{OK:"OK",CANCEL:"Anuluj",CONFIRM:"Potwierdź"},ru:{OK:"OK",CANCEL:"Отмена",CONFIRM:"Применить"},zh_CN:{OK:"OK",CANCEL:"取消",CONFIRM:"确认"},zh_TW:{OK:"OK",CANCEL:"取消",CONFIRM:"確認"}};return l}(document,window.jQuery);window.bootbox=bootbox