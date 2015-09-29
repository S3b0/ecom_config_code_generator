(function(t){function r(){t("#ccg-configurator-canvas .configurator-part-group-select").each(function(){t(this).siblings(".configurator-part-group-state").height(t(this).outerHeight())})}r();t(window).resize(function(){r()})})(jQuery);(function(t){var r=t("#ccg-configurator-canvas #configurator-summary-table");t("#ccg-configurator-canvas .configurator-result-review-config").on("click",function(o){o.preventDefault();t(this).stop().toggleClass("active");r.stop().slideToggle("slow").toggleClass("active");if(r.hasClass("active")){t("html, body").stop().animate({scrollTop:r.offset().top},"slow")}})})(jQuery);function addAjaxLoader(t){$("#"+t).addClass("ajaxloader")}function removeAjaxLoader(t){$("#"+t).removeClass("ajaxloader")}function ccgUpdatePart(t){$(".configurator-select-part-group-part-selector").on("click",function(r){r.preventDefault();if($(this).hasClass("disabled")){$(this).blur();return void 0}var o=$(this).attr("data-modal"),a=$(this).attr("data-part"),e=$(this).attr("data-part-state");if(o>0&&t.modals&&e==0){swal({title:t.modals[o]["title"],text:t.modals[o]["text"],type:"info",html:true,showCancelButton:true,confirmButtonColor:"#43AC6A",confirmButtonText:"Proceed »",cancelButtonText:"Cancel"},function(t){if(t){ccgUpdatePartExec(a,e)}else{$(this).blur();return void 0}})}else{ccgUpdatePartExec(a,e)}})}function ccgUpdatePartExec(t,r){addAjaxLoader("ccg-configurator-ajax-loader");genericAjaxRequest(t3pid,t3lang,1441344351,"updatePart",{part:t,unset:r,cObj:t3cobj},function(t){onSuccessFunction(t)})}function ccgIndex(t){$(t).on("click",function(t){t.preventDefault();if($(this).hasClass("configurator-part-group-state-0")&&$(".configurator-part-group-state-0").first().attr("id")!==$(this).attr("id")||$(this).hasClass("configurator-locked-part-group")||$(this).hasClass("current")){$(this).blur();return false}addAjaxLoader("ccg-configurator-ajax-loader");genericAjaxRequest(t3pid,t3lang,1441344351,"index",{partGroup:$(this).attr("data-part-group"),cObj:t3cobj},function(t){onSuccessFunction(t)})})}function getPartInformation(t){genericAjaxRequest(t3pid,t3lang,1441344351,"showHint",{part:t,cObj:t3cobj},function(t){swal({title:null,text:t,type:"info",html:true,confirmButtonText:"OK"})});return false}function genericAjaxRequest(t,r,o,a,e,n){$.ajax({async:"true",url:"index.php",type:"POST",dataType:"json",data:{eID:"EcomConfigCodeGenerator",id:parseInt(t),L:parseInt(r),type:parseInt(o),request:{controllerName:"AjaxRequest",actionName:a,arguments:e}},success:n,error:function(t,r,o){console.log("Request failed with "+r+": "+o+"!")}})}function onSuccessFunction(t){var r=$("#configurator-reset-configuration-button"),o=$("#configurator-next-button"),a=$("#configurator-config-header-config-price");removeAjaxLoader("ccg-configurator-ajax-loader");updateProgressIndicator(t.progress);r.toggle(!t.showResultingConfiguration&&t.progress>0);$("#configurator-part-group-select-index").html(t.selectPartGroupsHTML);$("#configurator-select-parts-ajax-update").html(t.selectPartsHTML);if(a){a.html(t.configurationPrice)}if(t.showResultingConfiguration){$("#configurator-result-canvas").show();$("#configurator-part-group-select-part-index").hide();alterPartGroupInformation("hide");$("#configurator-show-result-button").hide();o.hide();o.attr("data-current",0);$("#configurator-result-canvas .configurator-result h3.configurator-result-label").first().html(t.title);$("#configurator-result-canvas .configurator-result small.configurator-result-code").first().html(t.configurationCode["code"]);$("#configurator-summary-table").html(t.configurationCode["summaryTable"])}else{$("#configurator-result-canvas").hide();$("#configurator-part-group-select-part-index").show();alterPartGroupInformation(t.currentPartGroup);$("#configurator-show-result-button").toggle(t.progress===1&&!t.currentPartGroup["last"]);o.attr("data-part-group",t.nextPartGroup);o.attr("data-current",t.currentPartGroup?t.currentPartGroup["uid"]:0);if(t.currentPartGroup&&$("#configurator-part-group-"+t.currentPartGroup["uid"]+"-link").hasClass("configurator-part-group-state-1")){o.removeClass("disabled")}else{o.addClass("disabled")}o.show();if(t.progress===0){r.addClass("disabled")}else{r.removeClass("disabled")}}assignListeners(t);$("#ccg-configurator-canvas").scrollTop()}function alterPartGroupInformation(t){var r=$("#configurator-part-group-info");switch(t){case"show":r.show();break;case"hide":r.hide();break;default:if(t instanceof Object){var o=t.dependentNotesFluidParsedMessages!==undefined?t.dependentNotesFluidParsedMessages:"";r.html("<h2>"+t.title+"</h2><p>"+t.prompt+"</p><p>"+o+"</p>").show()}}}function updateProgressIndicator(t){$("#configurator-progress-value").animate({value:t});$(".configurator-progress-value-print").each(function(r,o){$({countNum:$(o).text()}).animate({countNum:Math.floor(t*100)},{duration:800,easing:"linear",step:function(){$(o).text(Math.floor(this.countNum))},complete:function(){$(o).text(this.countNum)}})})}function addInfoTrigger(){var t="#ccg-configurator-canvas .configurator-select-part-group-part-info";$(t).on("click",function(t){t.preventDefault();getPartInformation($(this).parents("a").first().attr("data-part"));return false})}function assignListeners(t){$("#configurator-part-group-select-index").tooltip({tooltipClass:"ecompc-custom-tooltip-styling",track:true});$(".syntax-help").tooltip({tooltipClass:"ecom-custom-tooltip-styling",track:true});ccgUpdatePart(t);addInfoTrigger();ccgIndex(".configurator-part-group-select")}(function(){$("#configurator-result-canvas").toggle(showResult);$("#configurator-reset-configuration-button").toggle(!showResult);$("#configurator-next-button").toggle(!showResult);$("#configurator-part-group-select-part-index").toggle(!showResult);$("#configurator-show-result-button").hide();assignListeners(preResult);ccgIndex("#configurator-next-button")})(jQuery);