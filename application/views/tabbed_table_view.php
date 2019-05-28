<div id="headerbar"></div>
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b><?php echo $title; ?></b>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs nav-tabs-noborder nav-tabs-justified">
                        <li class="active">
                            <a data-toggle="tab" href="#tab-attendance" title="View attendance report"><i class="fa fa-check"></i> Overall Attendance</a>
                        </li>
                        <li><a data-toggle="tab" href="#tab-mobilization" title="View mobilization report"><i class="fa fa-list"></i> Mobilization</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-attendance" class="tab-pane active">
                            <div class="table-responsive">
                                <table id="tblAttendanceReport" class="table table-striped table-condensed table-hover" width="100%" >
                                    <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th id="selector4">Designation</th>
                                            <th id="selector5">Work District</th>
                                            <th id="selector6">Venue</th>
                                            <th id="selector7">Venue District</th>
                                            <!--th>Start Date</th>
                                            <th>End Date</th-->
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        <tr>
                                            <th>PHW Names</th>
                                            <th title="Mobile/Airtel Money Phone">M/A Money Phone</th>
                                            <th>PSP Name</th>
                                            <th>Reg. No</th>
                                            <th>Designation</th>
                                            <th>Work District</th>
                                            <th>Venue</th>
                                            <th>Venue District</th>
                                            <!--th>Start Date</th>
                                            <th>End Date</th-->
                                            <th title="Sessions attended">SA</th>
                                            <th title="Sessions Not Attended">SNA</th>
                                            <th>Transport Refund</th>
                                            <th>Per Diem</th>
                                            <th>Facilitation Fee</th>
                                            <th>Amount Paid</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total</th>
                                            <th colspan="9"></th>
                                            <th>Transport Refund</th>
                                            <th>Per Diem</th>
                                            <th>Facilitation</th>
                                            <th>Amount Paid</th>
                                            <th>Balance</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div id="tab-mobilization" class="tab-pane">
                            <div class="table-responsive">
                                <table id="tblMobilizationReport" class="table table-striped table-condensed table-hover" width="100%" >
                                    <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th id="selector3">District</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        <tr>
                                            <th>DM Names</th>
                                            <th>Phone No</th>
                                            <th>Venue</th>
                                            <th>District</th>
                                            <th>Airtime</th>
                                            <th>Transport</th>
                                            <th>Internet</th>
                                            <th>PHW Count</th>
                                            <th>Bonus</th>
                                            <th>Compensation</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total</th>
                                            <th colspan="3"></th>
                                            <th>Airtime</th>
                                            <th>Transport</th>
                                            <th>Internet</th>
                                            <th>PHW Count</th>
                                            <th>Bonus</th>
                                            <th>Compensation</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var dt = null;
$(document).ready(function() {
    var dTable = {};
	var handleDataTableButtons = function() {
	  if ($("#tblAttendanceReport").length) {
		dTable['tblAttendancereport'] = $('#tblAttendanceReport').DataTable( {
			dom: "<\".col-md-5\"B><\".col-md-3\"l><\".col-md-4\"f>rt<\".col-md-7\"i><\".col-md-5\"p>",
			paging: true,
			ordering: true,
			searching:true,
			order: [[6,'asc'],[0,'asc']],
                        ajax: "<?php echo site_url("reports/dT_Classes");?>",
                        initComplete: function () {
                            var select_header = ['designations','districts',  'venues', 'districts'];
                            this.api().columns([4,5,6,7]).every( function () {
                                var column = this;
                                var col_index = column.index();
                                var select = $('<select class="form-control input-sm"><option value="">All '+select_header[col_index-4]+'</option></select>')
                                                .appendTo( $("#selector"+col_index).empty() )
                                                .on( 'change', function () {
                                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                                    column.search( val ? '^'+val+'$' : '', true, false ).draw();
                                                } );
                                                column.data().unique().sort().each( function ( d, j ) {
                                                    select.append( '<option value="'+d+'">'+(col_index===6?'Class ':'')+d+'</option>' )
                                                } );
                            } );
                        },
                        "footerCallback": function (tfoot, data, start, end, display ) {
                            var api = this.api(), cols = [10,11,12,13,14];
                            $.each(cols, function(key, val){
                                    var total = api.column(val).data().sum();
                                    var pageAmount = api.column(val, { page: 'current'}).data().sum();
                                    $(api.column(val).footer()).html( curr_format(pageAmount)+"("+curr_format(total)+") " );
                            });
                        },
                        columns:[{ data: 'participant_names' },
                                { data: 'phone1' },
                                { data: 'psp_name' },
                                { data: 'regno' },
                                { data: 'designation' },
                                { data: 'work_district' },
                                { data: 'venue_name', render:function ( data, type, full, meta ) {return data+" <sup data-toggle='tooltip' title='"+full.description+"'><i class='fa fa-info-circle'></i>"+"</sup>";}  },
                                 { data: 'venue_district' },
                                    //{ data: 'start_date', render: function ( data, type, full, meta ) {return moment(data, 'X').format('DD, MMM YYYY');}},
                                    //{ data: 'end_date', render: function ( data, type, full, meta ) {return moment(data, 'X').format('DD, MMM YYYY');}},
                                    { data: 'morning_1', render: function ( data, type, full, meta ) {return (parseInt(data)+parseInt(full.morning_2)+parseInt(full.morning_3)+parseInt(full.afternoon_1)+parseInt(full.afternoon_2)+parseInt(full.afternoon_3));} },
                                    { data: 'morning_1', render: function ( data, type, full, meta ) {return ((Math.round((parseInt(full.end_date)-parseInt(full.start_date))/86400)+1)*2)-(parseInt(data)+parseInt(full.morning_2)+parseInt(full.morning_3)+parseInt(full.afternoon_1)+parseInt(full.afternoon_2)+parseInt(full.afternoon_3));} },
		{ data: 'rate', render: function (data, type, full, meta) {return data?curr_format(data*1):'';} },
		{ data: 'per_diem', render: function (data, type, full, meta) {return data?curr_format(data*1):'';}},
		{ data: 'facilitation_fee', render: function (data, type, full, meta) {return data?curr_format(data*1):'';}},
		{ data: 'afternoon_1' },
		{ data: 'afternoon_2' }
		],
                                buttons: [
                                    {
                                        extend: "copy",
                                        className: "btn-sm"
                                    },
                                    {
                                        extend: "csv",
                                        className: "btn-sm"
                                    },
                                    {
                                        extend: "excel",
                                        className: "btn-sm"
                                    },
                                    {
                                        extend: "pdfHtml5",
                                        className: "btn-sm",
                                        title: 'IMMT Attendance and Payments Report',
                                        message: 'Includes per transport, per diem, faciliation fees ',
                                        orientation: 'landscape',
                                        customize: function ( doc ) {
                                            $(window.document.body).css( 'font-size', '10pt' );
                                            $(window.document.body).find( 'table#tblAttendanceReport' ).addClass( 'compact' ).css( 'font-size', '8pt' );
                                        }
                                    },
                                     {
                                         extend: "print",
                                        className: "btn-sm",
                                        title: 'IMMT Attendance and Payments Report',
                                        message: 'Includes per transport, per diem, faciliation fees ',
                                        orientation: 'landscape',
                                        customize: function ( doc ) {
                                            $(window.document.body).css( 'font-size', '10pt' );
                                            $(window.document.body).find( 'table#tblAttendanceReport' ).addClass( 'compact' ).css( 'font-size', '8pt' );
                                        }
                                     }/*,
                                     {
                                         extend: 'colvis',
                                        text: 'Choose fields to show <span class="caret"></span>',
                                        className: 'btn-sm'
                                    }*/
                                    ],
                                    responsive: true
		});
	  }
	  if ($("#tblMobilizationReport").length) {
		dTable['tblMobilizationReport'] = $('#tblMobilizationReport').DataTable( {
			dom: "<\".col-md-5\"B><\".col-md-3\"l><\".col-md-4\"f>rt<\".col-md-7\"i><\".col-md-5\"p>",
			paging: true,
			ordering: true,
			searching:true,
			order: [[0,'asc']],
                        ajax: "<?php echo site_url("reports/mobilization_setting");?>",
                        initComplete: function () {
                            var select_header = ['districts', 'classes'];
                            this.api().columns([3]).every( function () {
                                var column = this;
                                var col_index = column.index();
                                var select = $('<select class="form-control input-sm"><option value="">All '+select_header[col_index-3]+'</option></select>')
                                                .appendTo( $("#selector"+col_index).empty() )
                                                .on( 'change', function () {
                                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                                    column.search( val ? '^'+val+'$' : '', true, false ).draw();
                                                } );
                                                column.data().unique().sort().each( function ( d, j ) {
                                                    select.append( '<option value="'+d+'">'+d+'</option>' )
                                                } );
                            } );
                        },
                        "columnDefs": [
                        {
                            "targets": [ 7 ],
                            "visible": false,
                            "searchable": false
                        }
                        ],
                        "footerCallback": function (tfoot, data, start, end, display ) {
                            var api = this.api();
                            var bonusPage = 0, bonusTotal = 0;
                            var bonusPage = 0, bonusTotal = 0, totalCompPage = 0, totalCompTotal = 0;
                            var at_page = api.column(4, { page: 'current'}).data();
                            var at_overall = api.column(4).data();
                            var tp_page = api.column(5, { page: 'current'}).data();
                            var tp_overall = api.column(5).data();
                            var internet_data_page = api.column(6, { page: 'current'}).data();
                            var internet_data_overall = api.column(6).data();
                            var phws_page = api.column(7, { page: 'current'}).data();
                            var phws_overall = api.column(7).data();
                             var bonus_p = api.column(8, {page: 'current'}).data();
                             var bonus_ov = api.column(8).data();
                            var total_comp_page = api.column(9, { page: 'current'}).data();
                            var total_comp_overall = api.column(9).data();
                             
                             $.each(bonus_p, function(key, val){
                                 var bonus_page = 0;
                                 bonusPage += bonus_page = val?(parseFloat(val)*(phws_page[key]?parseFloat(phws_page[key]):0)*1):0;
                                 var total_comp = (tp_page[key]?parseFloat(tp_page[key]):0)
                                         +(at_page[key]?parseFloat(at_page[key]):0)
                                         +(internet_data_page[key]?parseFloat(internet_data_page[key]):0)
                                         + (total_comp_page[key]?parseFloat(total_comp_page[key]):0);
                                 totalCompPage+= bonus_page + total_comp;
                                 });
                             $.each(bonus_ov, function(key, val){
                                 var bonus_total = 0;
                                 bonusTotal += bonus_total = val?(parseFloat(val)*(phws_overall[key]?parseFloat(phws_overall[key]):0)*1):0;
                                 var total_comp = (tp_overall[key]?parseFloat(tp_overall[key]):0)
                                         +(at_overall[key]?parseFloat(at_overall[key]):0)
                                         +(internet_data_overall[key]?parseFloat(internet_data_overall[key]):0)
                                         + (total_comp_overall[key]?parseFloat(total_comp_overall[key]):0);
                                 totalCompTotal += bonus_total + total_comp;
                                 });
                            $(api.column(4).footer()).html( curr_format(at_page.sum())+"("+curr_format(at_overall.sum())+") " );
                            $(api.column(5).footer()).html( curr_format(tp_page.sum())+"("+curr_format(tp_overall.sum())+") " );
                            $(api.column(6).footer()).html( curr_format(internet_data_page.sum())+"("+curr_format(internet_data_overall.sum())+") " );
                            $(api.column(7).footer()).html( curr_format(phws_page.sum())+"("+curr_format(phws_overall.sum())+") " );
                            $(api.column(8).footer()).html( curr_format(bonusPage)+"("+curr_format(bonusTotal)+") " );
                            $(api.column(9).footer()).html( curr_format(total_comp_page.sum())+"("+curr_format(total_comp_overall.sum())+") " );
                            $(api.column(10).footer()).html( curr_format(totalCompPage)+"("+curr_format(totalCompTotal)+") " );
                        },
                        columns:[{ data: 'fname', render: function ( data, type, full, meta ) { return data + ' ' + full.lname + ' ' + (full.othernames?full.othernames:'')}},
                                { data: 'phone', render:function ( data, type, full, meta ) {return "<a href='tel:"+data+"'>"+data+"</a>";}},
                                { data: 'venue_name', render:function ( data, type, full, meta ) {return data+" <sup data-toggle='tooltip' title='"+full.description+"'><i class='fa fa-info-circle'></i>"+"</sup>";} },
                                { data: 'district_name' },
                                { data: "airtime_amount", render: function (data, type, full, meta){return data?curr_format(data*1):0;} },
                                { data: "tp_amount", render: function (data, type, full, meta){return data?curr_format(data*1):0;} },
                                { data: "internet_data_amt", render: function (data, type, full, meta){return data?curr_format(data*1):0;} },
                                { data: "phw_cnt" },
                                { data: "perparticipant_bonus", render: function (data, type, full, meta){return (full.phw_cnt && data)?curr_format(data*full.phw_cnt*1):0;} },
                                { data: "total_compensation_amt", render: function (data, type, full, meta){return data?curr_format(data*1):0;} },
                                { data: "total_compensation_amt", render: function (data, type, full, meta){
                                        var other_amounts = (data?parseFloat(data):0)+(full.airtime_amount?parseFloat(full.airtime_amount):o)
                                                +(full.internet_data_amt?parseFloat(full.internet_data_amt):0)
                                                +(full.tp_amount?parseFloat(full.tp_amount):0);
                                        var bonus_amount = (full.phw_cnt && full.perparticipant_bonus)?curr_format(full.perparticipant_bonus*full.phw_cnt*1):0;
                                        return data?curr_format((other_amounts+bonus_amount)*1):0;
                                    }
                                },
		],
                                buttons: [
                                    {
                                        extend: "copy",
                                        className: "btn-sm"
                                    },
                                    {
                                        extend: "csv",
                                        className: "btn-sm"
                                    },
                                    {
                                        extend: "excel",
                                        className: "btn-sm"
                                    },
                                    {
                                        extend: "pdfHtml5",
                                        className: "btn-sm",
                                        title: 'IMMT PHW Mobilization Payment Schedule',
                                        message: 'Includes airtime, internet data, bonus for each phw attending the workshop and total compensation fees ',
                                        orientation: 'landscape',
                                        customize: function ( doc ) {
                                            $(window.document.body).css( 'font-size', '10pt' );
                                            $(window.document.body).find( 'table#tblMobilizationReport' ).addClass( 'compact' ).css( 'font-size', '8pt' );
                                        }
                                    },
                                     {
                                         extend: "print",
                                        className: "btn-sm",
                                        title: 'IMMT PHW Mobilization Payment Schedule',
                                        message: 'Includes airtime, internet data, bonus for each phw attending the workshop and total compensation fees ',
                                        orientation: 'landscape',
                                        customize: function ( doc ) {
                                            $(window.document.body).css( 'font-size', '10pt' );
                                            $(window.document.body).find( 'table#tblMobilizationReport' ).addClass( 'compact' ).css( 'font-size', '8pt' );
                                        }
                                     }/*,
                                     {
                                         extend: 'colvis',
                                        text: 'Choose fields to show <span class="caret"></span>',
                                        className: 'btn-sm'
                                    }*/
                                    ],
                                    responsive: true
		});
	  }
	};
	TableManageButtons = function() {
	  "use strict";
	  return {
		init: function() {
		  handleDataTableButtons();
		}
	  };
	}();
	TableManageButtons.init();
});
</script>