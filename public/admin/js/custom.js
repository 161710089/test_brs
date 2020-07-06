(function($) {
  "use strict";

 /*jslint browser: true*/
 /*global $, jQuery, alert*/

 $(document).ready(function () {

     "use strict";

     var body = $("body");

     $(function () {
         $(".preloader").fadeOut();
        //  $('#side-menu').metisMenu();
     });

     /* ===== Theme Settings ===== */

     $(".open-close").on("click", function () {
         body.toggleClass("show-sidebar").toggleClass("hide-sidebar");
         $(".sidebar-head .open-close i").toggleClass("ti-menu");
     });



     /* ===========================================================
         Loads the correct sidebar on window load.
         collapses the sidebar on window resize.
         Sets the min-height of #page-wrapper to window size.
     =========================================================== */

     $(function () {
         var set = function () {
                 var topOffset = 60,
                     width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width,
                     height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
                 if (width < 768) {
                     $('div.navbar-collapse').addClass('collapse');
                     topOffset = 100; /* 2-row-menu */
                 } else {
                     $('div.navbar-collapse').removeClass('collapse');
                 }

                 /* ===== This is for resizing window ===== */

                 if (width < 1170) {
                     body.addClass('content-wrapper');
                     $(".sidebar-nav, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible");
                 } else {
                     body.removeClass('content-wrapper');
                 }

                 height = height - topOffset;
                 if (height < 1) {
                     height = 1;
                 }
                 if (height > topOffset) {
                     $("#page-wrapper").css("min-height", (height) + "px");
                 }
             },
             url = window.location,
             element = $('ul.nav a').filter(function () {
                 return this.href === url || url.href.indexOf(this.href) === 0;
             }).addClass('active').parent().parent().addClass('in').parent();
         if (element.is('li')) {
             element.addClass('active');
         }
         $(window).ready(set);
         $(window).bind("resize", set);
     });


     /* ===== Tooltip Initialization ===== */

     $(function () {
         $('[data-toggle="tooltip"]').tooltip();
     });

     /* ===== Popover Initialization ===== */

     $(function () {
         $('[data-toggle="popover"]').popover();
     });

     /* ===== Task Initialization ===== */

     $(".list-task li label").on("click", function () {
         $(this).toggleClass("task-done");
     });
     $(".settings_box a").on("click", function () {
         $("ul.theme_color").toggleClass("theme_block");
     });

     /* ===== Collepsible Toggle ===== */

     $(".collapseble").on("click", function () {
         $(".collapseblebox").fadeToggle(350);
     });

     /* ===== Sidebar ===== */

     $('.slimscrollright').slimScroll({
         height: '100%',
         position: 'right',
         size: "5px",
         color: '#dcdcdc'
     });
     $('.slimscrollsidebar').slimScroll({
         height: '100%',
         position: 'right',
         size: "6px",
         color: 'rgba(0,0,0,0.3)'
     });
     $('.chat-list').slimScroll({
         height: '100%',
         position: 'right',
         size: "0px",
         color: '#dcdcdc'
     });

     /* ===== Resize all elements ===== */

     body.trigger("resize");

     /* ===== Visited ul li ===== */

     $('.visited li a').on("click", function (e) {
         $('.visited li').removeClass('active');
         var $parent = $(this).parent();
         if (!$parent.hasClass('active')) {
             $parent.addClass('active');
         }
         e.preventDefault();
     });

     /* ===== Login and Recover Password ===== */

     $('#to-recover').on("click", function () {
         $("#loginform").slideUp();
         $("#recoverform").fadeIn();
     });

     /* ================================================================= 
         Update 1.5
         this is for close icon when navigation open in mobile view
     ================================================================= */

     $(".navbar-toggle").on("click", function () {
         $(".navbar-toggle i").toggleClass("ti-menu").addClass("ti-close");
     });
 });

})(jQuery);

// Restricts input for the set of matched elements to the given inputFilter function.
(function($) {
    $.fn.inputFilter = function(inputFilter) {
      return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
        if (inputFilter(this.value)) {
          this.oldValue = this.value;
          this.oldSelectionStart = this.selectionStart;
          this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
          this.value = this.oldValue;
          this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
          this.value = "";
        }
      });
    };
  }(jQuery));


  /**
   * @author Argan
   */
    $(() => {
        $(".number-only").inputFilter(function(value) {
        return /^\d*$/.test(value);    // Allow digits only, using a RegExp
        });
    });
    /*--------------------------------------
            BlockUI 
    ---------------------------------------*/
    function blockUI(message){
        $.blockUI({
            message: '<span class="text-semibold"><img src="'+base_url+'/assets/img/loading_argan.gif'+'" style="height: 30px;">'+ (message ? message : ' Sedang Memproses') +'</span>',
            baseZ: 10000,
            overlayCSS: {
                backgroundColor: '#000',
                opacity: 0.3,
                cursor: 'wait'
            },
            css: {
                'z-index': 10020,
                padding: '10px 5px',
                margin: '0px',
                width: '20%',
                top: '40%',
                left: '40%',
                'text-align': 'center',
                color: 'rgb(92, 132, 50)',
                border: '0px',
                'background-color': 'rgb(255, 255, 255)',
                cursor: 'wait',
                'border-radius': '12px',
                border: '2px rgb(92, 132, 50) solid',
                'font-size': '16px',
                'min-width': "95px",
                // border: 0,
                // padding: '10px 15px',
                // color: '#fff',
                // '-webkit-border-radius': 2,
                // '-moz-border-radius': 2,
                // backgroundColor: '#333',
                // 'z-index' : 10020,
                // width: '25%',
                // left: '38%',
            } 
        })
    }

    function blockElement(element, message, border){
        border = border ? border : '0px';
        $(element).block({
            message: '<span class="text-semibold"><img src="'+base_url+'/assets/dist/img/loading_argan.gif'+'" style="height: 30px;">'+(message ? message : ' Sedang Memproses') +'</span>',
            overlayCSS: {
                backgroundColor: '#000',
                opacity: 0.3,
                cursor: 'wait',
                borderRadius: border,
            },
            css: {
                'z-index': 10020,
                padding: '10px 5px',
                margin: '0px',
                width: '20%',
                top: '40%',
                left: '40%',
                'text-align': 'center',
                color: 'rgb(92, 132, 50)',
                border: '0px',
                'background-color': 'rgb(255, 255, 255)',
                cursor: 'wait',
                'border-radius': '12px',
                border: '2px rgb(92, 132, 50) solid',
                'font-size': '16px',
                'min-width': "95px",
            } 
        });

    }

    function copyToHeartEl(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
        $.toast({
            heading: 'Info!',
            text: 'Data Tersalin',
            position: 'top-right',
            loaderBg: '#fff',
            icon: 'info',
            hideAfter: 10000,
            stack: 6
        });
    }
    function copyToHeart(val) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(val).select();
        document.execCommand("copy");
        $temp.remove();
        $.toast({
            heading: 'Info!',
            text: 'Data Tersalin',
            position: 'top-right',
            loaderBg: '#fff',
            icon: 'info',
            hideAfter: 10000,
            stack: 6
        });
    }

    const myOptions = {
        digitGroupSeparator     : '.',
        decimalCharacter        : ',',
        minimumValue            : '0',
        currencySymbol          : 'Rp. ',
        decimalPlaces           : 2,
        decimalPlacesShownOnBlur: 2,
        alwaysAllowDecimalCharacter : true,
        decimalPlacesOverride: 2
    };
    const myOptions2 = {
        digitGroupSeparator     : '.',
        decimalCharacter        : ',',
        minimumValue            : '0',
        currencySymbol          : '',
        decimalPlaces           : 2,
        decimalPlacesShownOnBlur: 2,
        alwaysAllowDecimalCharacter : true,
        decimalPlacesOverride: 2
    };

    const myOptions3 = {
        digitGroupSeparator     : '.',
        decimalCharacter        : ',',
        minimumValue            : '0',
        currencySymbol          : '',
        decimalPlaces           : 0,
        decimalPlacesShownOnBlur: 0,
        alwaysAllowDecimalCharacter : false,
        decimalPlacesOverride: 0
    };

    $('.rupiah').autoNumeric('init', myOptions);
    $('.nominal').autoNumeric('init', myOptions2);
    $('.penomoran').autoNumeric('init', myOptions3);
    // const swal = Swal.mixin({
    //     customClass: {
    //         confirmButton: 'btn btn-primary',
    //         cancelButton: 'btn btn-danger'
    //     },
    //     buttonsStyling: false
    // })

    $(() => {
        $('[data-toggle="popover"]').popover({
            trigger: 'hover',
                'placement': 'top'
        });
    })


    function format_date_time_id(str){ //Format Tanggal Indonesia + Jam JavaScript
        if (str == ''){
            return '';
        }
        else {
            var replace = str.replace(/\ /g,'-');
            var date = replace.split('-');
            // menit = date[4];
            var jam = date[3];
            var day = date[2];
            var year = date[0];
            var month = '';
            //console.log(date);

            switch (parseInt(date[1])) {
                case 1:
                    month = 'Januari';
                    break;
                case 2:
                    month = 'Februari';
                    break;
                case 3:
                    month = 'Maret';
                    break;
                case 4:
                    month = 'April';
                    break;
                case 5:
                    month = 'Mei';
                    break;
                case 6:
                    month = 'Juni';
                    break;
                case 7:
                    month = 'Juli';
                    break;
                case 8:
                    month = 'Agustus';
                    break;
                case 9:
                    month = 'September';
                    break;
                case 10:
                    month = 'Oktober';
                    break;
                case 11:
                    month = 'November';
                    break;
                case 12:
                    month = 'Desember';
                    break;
                default:
                    
                    break;
            }
            return day+' '+month+' '+year+ ', '+jam;    
        }
    
    }

    function format_date_id(str){ //Format Tanggal Indonesia + Jam JavaScript
        if (str == ''){
            return '';
        }
        else {
            var replace = str.replace(/\ /g,'-');
            var date = replace.split('-');
            // menit = date[4];
            var day = date[2];
            var year = date[0];
            var month = '';
            //console.log(date);

            switch (parseInt(date[1])) {
                case 1:
                    month = 'Januari';
                    break;
                case 2:
                    month = 'Februari';
                    break;
                case 3:
                    month = 'Maret';
                    break;
                case 4:
                    month = 'April';
                    break;
                case 5:
                    month = 'Mei';
                    break;
                case 6:
                    month = 'Juni';
                    break;
                case 7:
                    month = 'Juli';
                    break;
                case 8:
                    month = 'Agustus';
                    break;
                case 9:
                    month = 'September';
                    break;
                case 10:
                    month = 'Oktober';
                    break;
                case 11:
                    month = 'November';
                    break;
                case 12:
                    month = 'Desember';
                    break;
                default:
                    
                    break;
            }
            return day+' '+month+' '+year;    
        }
    
    }
