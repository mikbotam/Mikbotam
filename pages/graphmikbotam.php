<?php
//=====================================================START====================//

/*
 *  Base Code   : BangAchil
 *  Email       : kesumaerlangga@gmail.com
 *  Telegram    : @bangachil
 *
 *  Name        : Mikrotik bot telegram - php
 *  Function    : Mikortik api
 *  Manufacture : November 2018
 *  Last Edited : 26 Desember 2018
 *
 *  Please do not change this code
 *  All damage caused by editing we will not be responsible please think carefully,
 *
 */

//=====================================================START SCRIPT====================//

error_reporting(0);

if (!isset($_SESSION["Mikbotamuser"])) {
    header("Location:admin/login.php");
} else {
    include '../config/system.conn.php';
    include '../config/system.byte.php';
    include '../Api/routeros_api.class.php';
    $datavoucher = sethistory($id);
    date_default_timezone_set('Asia/Jakarta');
    $API = new routeros_api();

    if ($API->connect($mikrotik_ip, $mikrotik_username, $mikrotik_password, $mikrotik_port)) {
        $API->write('/interface/getall');
        $ARRAY2 = $API->read();
    }
}

?>


        <script src="../lib/highchart/highcharts.js"></script>
                <style type="text/css">
.highcharts-tooltip>span {
    background: rgba(255,255,255,0.85);
    border: 1px solid silver;
    border-radius: 3px;
    box-shadow: 1px 1px 2px #888;
    padding: 3px;
}
        </style>
            <div class="sl-pagebody">
        <div class="row row-sm mg-t-10-force">
           <div class="col-lg-12">
                <div class="card bd-primary">
                    <div class="card-header bg-primary tx-white">
                        <i class="fa fa-shield"></i> Monitoring </div>
                    <div class="card-body pd-sm-15">
            <div class="col-sm-12 mg-b-10 mg-sm-t-0">
                <select class="form-control select2id" id="interface" name="interface" data-placeholder="Select interface">
                      <option value="">Select ID</option>
                      <?php
                      foreach ($ARRAY2 as $ARRAY1 => $jengkol): ?>
                      <option value="<?=$jengkol['name'];?>"><?php echo $jengkol['name']; ?></option>
                      <?php endforeach;?>
                                </select>
            </div>
              <script type="text/javascript">
              var chart;
function requestDatta(interface) {

    if (interface.length == 0){

    }else{

    $.ajax({
        url: '../Graph/Graph.php?interface='+interface,
        datatype: "json",
        success: function(data) {
            var midata = JSON.parse(data);
            if( midata.length > 0 ) {
                var TX=parseInt(midata[0].data);
                var RX=parseInt(midata[1].data);
                var x = (new Date()).getTime();
                shift=chart.series[0].data.length > 19;
                chart.series[0].addPoint([x, TX], true, shift);
                chart.series[1].addPoint([x, RX], true, shift);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.error("Status: " + textStatus + " request: " + XMLHttpRequest); console.error("Error: " + errorThrown);
        }
    });
    }
}

$(document).ready(function() {

    Highcharts.theme = {
        colors: ["#008080", "#f86c6b"],
        xAxis: {
            gridLineColor: '#c1c1c1',
            gridLineWidth: 1,
            labels: {
                style: {
                    color: '#3E3E3E'
                }
            },

            lineColor: '#c1c1c1',
            tickColor: '#c1c1c1',
            title: {
                style: {
                    color: '#3E3E3E',
                    fontWeight: 'bold',
                    fontSize: '12px',
                    fontFamily: 'bold 16px "Trebuchet MS", Verdana, sans-serif, Roboto,"Seggoe UI"'

                }
            }
        },
        yAxis: {
            gridLineColor: '#c1c1c1',
            labels: {
                style: {
                    color: '#3E3E3E'
                }
            },
            lineColor: '#c1c1c1',
            minorTickInterval: null,
            tickColor: '#c1c1c1',
            tickWidth: 1,
            title: {
                style: {
                    color: '#3E3E3E',
                    fontWeight: 'bold',
                    fontSize: '12px',
                    fontFamily: 'bold 16px "Trebuchet MS", Verdana, sans-serif, Roboto,"Seggoe UI"'
                }
            }
        },
        plotOptions: {
            series: {
                fillOpacity: 0.1
            }
        },
        tooltip: {
        backgroundColor: null,
        borderWidth: 0,
        shadow: false,
        useHTML: true,
        style: {
            padding: 0
        }

        },
        legend: {
            itemStyle: {
                font: '9pt Trebuchet MS, Verdana, sans-serif',
                color: '#3E3E3E'
            },
            itemHoverStyle: {
                color: '#20a8d8'
            },
            itemHiddenStyle: {
                color: '#E9EBEE'
            }
        },
        credits: {
            enabled: 0,
        }
    };

    var highchartsOptions = Highcharts.setOptions(Highcharts.theme);

    Highcharts.setOptions({
        global: {
            useUTC: false
        },
    });
  var namerouter='<?=$Name_router;?>';

    chart = new Highcharts.Chart({

        chart: {
            renderTo: 'graphmikbotam',
            animation: Highcharts.svg,
            type: 'areaspline',
            events: {
                load: function () {
                    setInterval(function () {
                        requestDatta(document.getElementById("interface").value);
                        chart.setTitle({ text: namerouter });
                    }, 3000);
                }
            }
        },
        title: {
            text: namerouter
        },
        subtitle: {
            text: '',
            style: {
                display: 'none'
            }
        },

        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000,
        },
        yAxis: {
            minPadding: 0,
            maxPadding: 0,
            title: {
                text: '',
                margin: 0
            },
            labels: {
              formatter: function () {
                var bytes = this.value;
                var sizes = ['bps', 'kbps', 'Mbps', 'Gbps', 'Tbps'];
                if (bytes == 0) return '0 bps';
                var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];
              },
              style: {
                    color: '#c1c1c1',
                    fontSize: '11px',
                    fontFamily: '"Trebuchet MS", Verdana, sans-serif, Roboto,"Seggoe UI"'

                },
            },
        },
        tooltip: {
             formatter: function () {

var _0xcd73=["\x79","\x62\x70\x73","\x6B\x62\x70\x73","\x4D\x62\x70\x73","\x47\x62\x70\x73","\x54\x62\x70\x73","\x30\x20\x62\x70\x73","\x6C\x6F\x67","\x66\x6C\x6F\x6F\x72","\x74\x6F\x46\x69\x78\x65\x64","\x70\x6F\x77","\x20","\x3C\x73\x70\x61\x6E\x20\x73\x74\x79\x6C\x65\x3D\x22\x63\x6F\x6C\x6F\x72\x3A","\x63\x6F\x6C\x6F\x72","\x22\x3E\u229A\x20\x20\x3C\x2F\x73\x70\x61\x6E\x3E\x20\x3C\x62\x3E","\x6E\x61\x6D\x65","\x73\x65\x72\x69\x65\x73","\x3C\x2F\x62\x3E","\x3A\x20","\x3C\x68\x72\x3E","\x3C\x64\x69\x76\x20\x63\x6C\x61\x73\x73\x3D\x22\x63\x61\x72\x64\x2D\x68\x65\x61\x64\x65\x72\x20\x62\x67\x2D\x70\x72\x69\x6D\x61\x72\x79\x20\x74\x78\x2D\x77\x68\x69\x74\x65\x22\x3E\x3C\x69\x20\x63\x6C\x61\x73\x73\x3D\x22\x66\x61\x20\x66\x61\x2D\x73\x68\x69\x65\x6C\x64\x22\x3E\x3C\x2F\x69\x3E\x20\x20","\x3C\x2F\x64\x69\x76\x3E\x3C\x63\x65\x6E\x74\x65\x72\x3E","\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x72\x65\x64\x75\x63\x65","\x70\x6F\x69\x6E\x74\x73"];return this[_0xcd73[24]][_0xcd73[23]](function(_0x5456x1,_0x5456x2){var _0x5456x3=_0x5456x2[_0xcd73[0]];var _0x5456x4=[_0xcd73[1],_0xcd73[2],_0xcd73[3],_0xcd73[4],_0xcd73[5]];if(_0x5456x3== 0){return _0xcd73[6]};var _0x5456x5=parseInt(Math[_0xcd73[8]](Math[_0xcd73[7]](_0x5456x3)/ Math[_0xcd73[7]](1024)));var _0x5456x6=parseFloat((_0x5456x3/ Math[_0xcd73[10]](1024,_0x5456x5))[_0xcd73[9]](2))+ _0xcd73[11]+ _0x5456x4[_0x5456x5];return _0x5456x1+ _0xcd73[12]+ _0x5456x2[_0xcd73[13]]+ _0xcd73[14]+ _0x5456x2[_0xcd73[16]][_0xcd73[15]]+ _0xcd73[17]+ _0xcd73[18]+ _0x5456x6+ _0xcd73[19]},_0xcd73[20]+ namerouter+ _0xcd73[21]+ formatDate( new Date())+ _0xcd73[22])

        },
                          shared: true
                        },

        plotOptions: {
            line: {
                marker: {
                    enabled: false
                }
            }
        },
        series: [{
            name: 'Tx',
            data: [],
        }, {
            name: 'Rx',
            data: [],
        }]
    });
});
var _0xcfb0=["\x66\x61\x73\x74","\x66\x61\x64\x65\x49\x6E","\x2E\x2E\x2F\x47\x72\x61\x70\x68\x2F\x4C\x69\x76\x65\x70\x69\x6E\x67\x2E\x70\x68\x70","\x65\x72\x72\x6F\x72","\x3C\x63\x65\x6E\x74\x65\x72\x3E\x3C\x68\x31\x3E\x50\x6C\x75\x67\x69\x6E\x20\x6E\x6F\x74\x20\x6C\x6F\x61\x64\x65\x64\x3C\x2F\x68\x31\x3E\x3C\x62\x72\x3E\x44\x6F\x77\x6E\x6C\x6F\x61\x64\x20\x50\x6C\x75\x67\x69\x6E\x20\x66\x6F\x72\x20\x74\x6F\x6F\x6C\x20\x70\x69\x6E\x67\x20\x4C\x69\x76\x65\x20\x3C\x2F\x63\x65\x6E\x74\x65\x72\x3E","\x68\x74\x6D\x6C","\x23\x6C\x69\x76\x65","\x6C\x6F\x61\x64"];var timer;var auto_refresh=setInterval(function(){$(_0xcfb0[6])[_0xcfb0[7]](_0xcfb0[2],function(_0xda73x3,_0xda73x4,_0xda73x5){if(_0xda73x4== _0xcfb0[3]){$(_0xcfb0[6])[_0xcfb0[5]](_0xcfb0[4])}})[_0xcfb0[1]](_0xcfb0[0])},5000)
</script>

    <div id="graphmikbotam" style="min-width:200px;height:400px;margin:0 auto"></div>

    </div>
            </div>
        </div>                 <div class="col-lg-12 mg-t-10">
                <div class="card bd-primary">
                    <div class="card-header bg-primary tx-white">
                        <i class="fa fa-shield"></i> Live Ping </div>
                      <div class="card-body pd-sm-15">

                         <div id="live"><center><h2>Loading....</h2></center></div>

            </div>
        </div>
    </div>
    </div>
    </div>
