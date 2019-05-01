//=====================================================START====================//

/*
 *  Base Code  	: BangAchil
 *  Email     		: kesumaerlangga@gmail.com
 *  Telegram  		: @bangachil
 *
 *  Name      		: Mikrotik bot telegram - php
 *  Function   	: Mikortik api 
 *  Manufacture	: November 2018
 *  Last Edited	: 26 Desember 2018
 *
 *  Please do not change this code
 *  All damage caused by editing we will not be responsible please think carefully,
 *
*/

//=====================================================START SCRIPT====================//



function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
};

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
};

function formatDate(date) {
  var monthNames = [
    "Januari", "Februari", "Maret",
    "April", "Mei", "juni", "Juli",
    "Augustus", "September", "Oktober",
    "November", "Desember"
  ];

  var day = date.getDate();
  var monthIndex = date.getMonth();
  var year = date.getFullYear();

  return day + ' ' + monthNames[monthIndex] + ' ' + year;
};

$(function() {
    'use strict';
    
  $('.fadesa').slick({
 autoplay: true,
  dots: false,
  infinite: true,
  speed: 500,
  fade: true,
  cssEase: 'linear'
});
  $('.select2').select2({
        minimumResultsForSearch: Infinity
    });        
  $('.select2id').select2({
                    minimumResultsForSearch: ''
                });
  $('.datepicker').datepicker({
    showOtherMonths: true,
    selectOtherMonths: true
  });

var _0xbb86=["\x53\x65\x61\x72\x63\x68\x2E\x2E\x2E","","\x5F\x4D\x45\x4E\x55\x5F\x20\x69\x74\x65\x6D\x73\x2F\x70\x61\x67\x65","\x42\x66\x72\x74\x69\x70","\x41\x64\x64\x20\x50\x50\x50\x20\x50\x72\x6F\x66\x69\x6C\x65","\x73\x68\x6F\x77","\x6D\x6F\x64\x61\x6C","\x23\x6D\x79\x4D\x6F\x64\x61\x6C","\x23\x70\x70\x70\x6C\x69\x73\x74\x70\x72\x6F\x66\x69\x6C\x65","\x41\x64\x64\x20\x55\x73\x65\x72\x20\x53\x65\x63\x72\x65\x74","\x23\x70\x70\x70\x6C\x69\x73\x74","\x41\x64\x64\x20\x55\x73\x65\x72","\x23\x48\x6F\x74\x73\x70\x6F\x74\x61\x64\x64","\x23\x68\x6F\x74\x73\x70\x6F\x74","\x23\x75\x73\x65\x72\x6C\x69\x73\x74","\x23\x75\x73\x65\x72\x68\x69\x73\x74\x6F\x72\x79\x32","\x73\x65\x6C\x65\x63\x74\x32","\x2E\x64\x61\x74\x61\x54\x61\x62\x6C\x65\x73\x5F\x6C\x65\x6E\x67\x74\x68\x20\x73\x65\x6C\x65\x63\x74","\x30\x30\x30\x30\x2D\x30\x30\x30\x30\x2D\x30\x30\x30\x30","\x6D\x61\x73\x6B","\x23\x6E\x6F\x74\x65\x6C\x66\x75\x6E","\x30\x2E\x30\x30\x30\x2E\x30\x30\x30\x2E\x30\x30\x30","\x23\x53\x61\x6C\x64\x6F","\x30\x5A\x5A\x2E\x30\x5A\x5A\x2E\x30\x5A\x5A\x2E\x30\x5A\x5A","\x23\x69\x70\x61\x64\x64\x72\x65\x73\x73"];$(_0xbb86[8]).DataTable({paging:false,ordering:false,info:false,scrollX:true,scrollY:400,language:{searchPlaceholder:_0xbb86[0],sSearch:_0xbb86[1],lengthMenu:_0xbb86[2]},dom:_0xbb86[3],buttons:[{text:_0xbb86[4],action:function(_0x7e35x1,_0x7e35x2,_0x7e35x3,_0x7e35x4){$(_0xbb86[7])[_0xbb86[6]](_0xbb86[5])}}]});$(_0xbb86[10]).DataTable({paging:false,ordering:false,info:false,scrollX:true,scrollY:400,language:{searchPlaceholder:_0xbb86[0],sSearch:_0xbb86[1],lengthMenu:_0xbb86[2]},dom:_0xbb86[3],buttons:[{text:_0xbb86[9],action:function(_0x7e35x1,_0x7e35x2,_0x7e35x3,_0x7e35x4){$(_0xbb86[7])[_0xbb86[6]](_0xbb86[5])}}]});$(_0xbb86[13]).DataTable({paging:false,ordering:false,info:false,scrollX:true,scrollY:400,language:{searchPlaceholder:_0xbb86[0],sSearch:_0xbb86[1],lengthMenu:_0xbb86[2]},dom:_0xbb86[3],buttons:[{text:_0xbb86[11],action:function(_0x7e35x1,_0x7e35x2,_0x7e35x3,_0x7e35x4){$(_0xbb86[12])[_0xbb86[6]](_0xbb86[5])}}]});$(_0xbb86[14]).DataTable({paging:false,ordering:false,info:false,scrollX:true,scrollY:400,language:{searchPlaceholder:_0xbb86[0],sSearch:_0xbb86[1],lengthMenu:_0xbb86[2]}});$(_0xbb86[15]).DataTable({paging:false,ordering:false,info:false,scrollX:true,scrollY:300,searching:false});$(_0xbb86[17])[_0xbb86[16]]({minimumResultsForSearch:Infinity});$(_0xbb86[20])[_0xbb86[19]](_0xbb86[18]);$(_0xbb86[22])[_0xbb86[19]](_0xbb86[21],{reverse:true});$(_0xbb86[24])[_0xbb86[19]](_0xbb86[23],{translation:{"\x5A":{pattern:/[0-9]/,optional:true}}})
  $('#textnya').keyup(function() {
                var len = this.value.length;
                if (len >= 4200) {
                    this.value = this.value.substring(0, 4200);
                }
                $('#hitung').text(4200 - len);
            });
  $('.mailbox-sideleft').perfectScrollbar();
  $('#showMailboxLeft').on('click', function(){
  $('body').toggleClass('show-mailbox-left');


        });

    $('.poll').select2({
 tags: true,
  createTag: function (params) {
    return {
      id: params.term,
      text: params.term,
      newOption: true
    }
  },
  templateResult: function (data) {
    var $result = $("<span></span>");

    $result.text(data.text);

    if (data.newOption) {
      $result.append(" <em>(custom, click me)</em>");
    }

    return $result;
  }

});

});