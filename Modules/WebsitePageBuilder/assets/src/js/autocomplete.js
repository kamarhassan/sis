// ==UserScript==
// @name         Autocomplete
// @namespace    http://tampermonkey.net/
// @version      0.1
// @description  try to take over the world!
// @author       You
// @match        https://zapier.com/app/developer/app/11961/visibility
// @match        https://codecanyon.net/*
// @match        https://mail.google.com/mail/*
// @grant        unsafeWindow
// ==/UserScript==

var acpDictionary = [
    "{Please check your mailbox for our reply. Thank you.",
    "{Thank you for your interest in our product. ",
    "Thank you.",
    "Please shoot us a message through our profile/support contact form. We will get back to you shortly. Thank you.",
    `It seems you did not setup the cronjob on your hosting server yet
Cronjob is needed for actually sending email campaigns, updating the listing as well as verifying/importing/exporting
Please go to Admin View > Setting > All Settings > Background Job
Then capture the cronjob generated and install it into your hosting server.

If you are running on cPanel, you can find it here:
http://kb.xyzscripts.com/wp-content/uploads/2012/04/1.png

If you are using Plesk:
https://www.dropbox.com/s/p1e2x71yy3xxk0v/cron-02.png?dl=0

If you are using SSH console:
http://prntscr.com/mpn999

Let me know if you are not familiar with setting up cronjob, we can help then`,
    `We have the installation & getting started guideline (for cPanel or unmanaged server/VPS) included in the guideline/ folder of the software package you download from CodeCanyon (go to the guideline/ folder, double click on the index.html file to open it on your browser)
Just check it out and let us know if you still cannot get it to work, we are willing to help then`
];

function acpAutocomplete (editor, arr) {
	/*the autocomplete function takes two arguments,
	the text field element and an array of possible autocompleted values:*/
	var currentFocus;
  var regexp = /\{[a-zA-Z0-9\_]*(?=\s|$)/g;

	/*execute a function when someone writes in the text field:*/
	$("#builder_iframe").contents().find("body").on("keyup", function(e) {
		
		if (e.keyCode == 40) {
			return;
		}
		
		if (editor.selected == null) {
			return;
		}
		
        var string = editor.selected.obj.html();
				
		var a, b, i, val, val2 = null;
        var matched = string.match(regexp); // Only get the last phrase. FOr example, if the content is "Hello! Thank you for", then only "Thank you for is counted
        if (matched != null) {
            val = matched[0];
        }
		/*close any already open lists of autocompleted values*/
		closeAllLists();
		if (!val) { return false;}
		currentFocus = -1;
		/*create a DIV element that will contain the items (values):*/
		a = document.createElement("DIV");
		a.setAttribute("id", this.id + "autocomplete-list");
		a.setAttribute("class", "autocomplete-items");

        if (!editor.selected.obj.hasClass('autocomplete')) {
            editor.selected.obj.addClass('autocomplete');
        }
        
		/*append the DIV element as a child of the autocomplete container:*/
		editor.selected.obj.after(a);
		/*for each item in the array...*/
		for (i = 0; i < arr.length; i++) {
			/*check if the item starts with the same letters as the text field value:*/
			if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
				/*create a DIV element for each matching element:*/
				b = document.createElement("DIV");
				/*make the matching letters bold:*/
				b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
				b.innerHTML += arr[i].substr(val.length);
				/*insert a input field that will hold the current array item's value:*/
				b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";

				a.appendChild(b);
				
				/*execute a function when someone clicks on the item value (DIV element):*/
				$(b).click(function() {
					var vv = $(this).find('input').val();
					var string = editor.selected.obj.html();
					/*insert the value for the autocomplete text field:*/
					var newVal = string.replace(regexp, vv);
					
					//var newVal = .replace(regexp, vv);
					editor.selected.obj.html(newVal);
					/*close the list of autocompleted values,
					(or any other open lists of autocompleted values:*/
					closeAllLists();
				});
			}
		}
	});
	/*execute a function presses a key on the keyboard:*/
	$("#builder_iframe").contents().find("body").on("keydown", function(e) {
			var x = $("#builder_iframe").contents().find("#autocomplete-list")[0];
			if (x) x = x.getElementsByTagName("div");
			if (e.keyCode == 40) {
				/*If the arrow DOWN key is pressed,
				increase the currentFocus variable:*/
				currentFocus++;
				/*and and make the current item more visible:*/
				addActive(x);
			} else if (e.keyCode == 38) { //up
				/*If the arrow UP key is pressed,
				decrease the currentFocus variable:*/
				currentFocus--;
				/*and and make the current item more visible:*/
				addActive(x);
			} else if (e.keyCode == 13) {
				/*If the ENTER key is pressed, prevent the form from being submitted,*/
				e.preventDefault();
				if (currentFocus > -1) {
					/*and simulate a click on the "active" item:*/
					if (x) x[currentFocus].click();
				} else {
						/*if no active item, just click on the first one*/
						if (x) x[0].click();
				}
				return false;
			}
	});
	function addActive(x) {
		/*a function to classify an item as "active":*/
		if (!x) return false;
		/*start by removing the "active" class on all items:*/
		removeActive(x);
		if (currentFocus >= x.length) currentFocus = 0;
		if (currentFocus < 0) currentFocus = (x.length - 1);
		/*add class "autocomplete-active":*/
		x[currentFocus].classList.add("autocomplete-active");
	}
	function removeActive(x) {
		/*a function to remove the "active" class from all autocomplete items:*/
		for (var i = 0; i < x.length; i++) {
			x[i].classList.remove("autocomplete-active");
		}
	}
	function closeAllLists(elmnt) {
		/*close all autocomplete lists in the document,
		except the one passed as an argument:*/
		//var x = document.getElementsByClassName("autocomplete-items");
		//for (var i = 0; i < x.length; i++) {
		//	if (elmnt != x[i] && elmnt != inp) {
		//		x[i].parentNode.removeChild(x[i]);
		//	}
		//}
        
        $("#builder_iframe").contents().find(".autocomplete-items").remove();
	}
	/*execute a function when someone clicks in the document:*/
	document.addEventListener("click", function (e) {
		closeAllLists(e.target);
	});
}

function acpAddCss() {
  var style = document.createElement("style");
  style.innerHTML = '.autocomplete{position:relative}.autocomplete-items{position:absolute;border:1px solid #d4d4d4;border-bottom:none;border-top:none;z-index:99;top:100%;left:0;right:0}.autocomplete-items div{padding:10px;cursor:pointer;background-color:#fff;border-bottom:1px solid #d4d4d4}.autocomplete-items div:hover{background-color:#e9e9e9}.autocomplete-active{background-color:#1e90ff!important;color:#fff}';
  document.head.appendChild(style);
}

export {
    acpAutocomplete,
    acpAddCss,
    acpDictionary
};