var admincontroller = {
    orderlisturl : '/admin/orderslist',
    storlisturl: '/store/viewstorelist',
    


     orderlist_grid : function(){
        var self = this;

        $(document).ready(function () {
            var rawurl= self.orderlisturl;
            var fields=new Array('id','user_id','name','email','title','status_title','created_at','updated_at','deleted_at');
            var jqxgridid='#jqxgrid';
           
            var source =
            {
                datatype: "json",
                cache: false,
                datafields: [
                    { name: 'id',type: 'number' },
                    { name: 'client_name'},
                    { name: 'customer_design'},
                    { name: 'design_name' },
                    { name: 'order_color' },
                    { name: 'color_name' },
                    { name: 'width' },
                    { name: 'length'},
                    { name: 'units' },  
                    { name: 'order_quantity' },
                    { name: 'total_sqmt'}, 
                    { name: 'quality_per_sqmt' },
                    { name :'remarks'}, 
                    { name: 'order_date' }, 
                    { name: 'delivery_date' },   
                    { name: 'created_at' }, 
                    { name: 'updated_at'} ,
                    
                ],
                id: 'id',
                url: rawurl,
                root: 'Rows',
                beforeprocessing: function(data)
                {       
                    source.totalrecords = data[0].TotalRows;
                    
                },

                sort: function () {
                // update the grid and send a request to the server.
                $("#jqxgrid").jqxGrid('updatebounddata', 'sort');
                },

                filter: function (rowid, rowdata) {
                    // update the grid and send a request to the server.
                    $(jqxgridid).jqxGrid('updatebounddata', 'filter');
                },
                // addrow: function (rowid, rowdata, position, commit) {
                //     // synchronize with the server - send insert command
                //     var data = "insert=true&" + $.param(rowdata);
                //     ajax_grid(data,commit,rawurl);
                // },
                // deleterow: function (rowid, commit) {
                //     // synchronize with the server - send delete command
                //     var data = "delete=true&" + $.param({ id: rowid });
                //     ajax_grid(data,commit,rawurl);
                // },
                updaterow: function (rowid, rowdata, commit) {
                    // synchronize with the server - send update command
                   //  var data = "update=true&" + $.param(rowdata);
                    
                   // // ajax_grid(data,commit,rawurl);
                  
                   //  var brid = rowdata.id;
                   //  var status = rowdata.served_status;
                   //  var served_by = rowdata.served_by;
                   
                   //  $.ajaxq('queue',{
                   //  url: self.bookingserveurl,
                   //  type: "get",
                   //  data: {'request_id' : brid,'status' : status,'served_by' : served_by},
                   //  success: function (data, textStatus, jqXHR) {

                   //  },
                   //  error: function (jqXHR, textStatus, errorThrown) {
                   //  // error check
                   //  }
                   //  }); // end ajax 

                }
            };

            var dataAdapter = new $.jqx.dataAdapter(source);

            // initialize jqxGrid
            $(jqxgridid).jqxGrid(
            {
                width: '100%',
                height: 450,
                source: dataAdapter,
                theme: theme,
                editable: true,
                showfilterrow: true,
                filterable: true,
                sortable: true,
                pageable: true,
                pagesize: 50,
                pagesizeoptions: ['50', '100', '500'],
                virtualmode: true,
                //selectionmode: 'checkbox',
                rendergridrows: function()
                {
                    
                      return dataAdapter.records;     
                },
                columns: [
                    { text: 'Id', datafield: 'id', width: 50 ,filtercondition : 'EQUAL', editable: false},
                    { text: 'Client Name', datafield: 'client_name', width: 90 , editable: false},
                    { text: 'Customer Design', datafield: 'customer_design', width: 110, editable: false},
                    { text: 'Available Design', datafield: 'design_name', width: 130,editable: false }, 
                    { text: 'Order Color', datafield: 'order_color', width: 130,editable: false }, 
                    { text: 'Available Color', datafield: 'color_name', width: 130,editable: false },
                    { text: 'Width', datafield: 'width', width: 100,editable: false },
                    { text: 'Length', datafield: 'length', width: 80, editable: false},
                    { text: 'Unit', datafield: 'unit', width: 100, editable: false},
                    
                    { text: 'Order Quantity', datafield: 'order_quantity', width: 120 ,editable: false},
                    { text: 'Total Sqmt', datafield: 'total_sqmt', width: 120 ,editable: false},
                    { text: 'Quality Per Sqmt', datafield: 'quality_per_sqmt', width: 120 ,editable: false},
                    { text: 'Order Date', datafield: 'order_date', width: 100, editable: false},
                    { text: 'Delivery Date', datafield: 'delivery_date', filtercondition : 'CONTAINS',width: 130, editable: false},
                    { text: 'Created At', datafield: 'created_at', width: 130, filtercondition : 'CONTAINS', editable: false},
                    { text: 'Updated At', datafield: 'updated_at', width: 130,  filtercondition : 'CONTAINS',editable: false},
          
                ]
            });


//trigger filter on notification button click
$('body').on('click','.notif-filter',function(){
    set_filter($(this).data('filtercol'),$(this).data('filterval'));
});

$('body').on('click','.reset-filter',function(){
    $(jqxgridid).jqxGrid('clearfilters');
});

function set_filter(colname,val){
        var searchText = val;
        // $("#jqxgrid").jqxGrid('removefilter', 'firstname');
        var filtergroup = new $.jqx.filter();
        var filtervalue = searchText;
        var filtercondition = 'contains';
        var filter = filtergroup.createfilter('stringfilter', filtervalue, filtercondition);
        // used when there are multiple filters on a grid column:
        var filter_or_operator = 1;
        // used when there are multiple filters on the grid:
        filtergroup.operator = 'or';
        filtergroup.addfilter(filter_or_operator, filter);
        //remove other filters
        $(jqxgridid).jqxGrid('addfilter', colname, filtergroup);
        $(jqxgridid).jqxGrid('applyfilters');     
}            
//trigger filter on notification button click
        }); // end document.ready func

    }, // end users br_grid func
    store_grid : function(){
        var self = this;

        $(document).ready(function () {
            //alert(self.offlinebookingrequesturl);
            var rawurl= self.storlisturl;
            var fields=new Array('id','name','email');
            var jqxgridid='#jqxgrid';
           
            var source =
            {
                datatype: "json",
                cache: false,
                datafields: [
                    { name: 'id' },
                    { name: 'item_name' },
                    { name: 'item_type' },
                    { name: 'units' },
                    { name: 'order_id' },
                    { name: 'vendor_id' },
                    { name: 'vendor_name' },  
                    { name: 'vendor_email' }, 
                    { name: 'quantity' },  
                    { name: 'vendor_contact' } , 
                    { name: 'name'}, 
                    { name: 'item_description'},              
                    { name: 'created_at' },
                    { name: 'updated_at' },
                    { name :'last_edited_by'},  
                    
                               
                ],
                id: 'id',
                url: rawurl,
                root: 'Rows',
                beforeprocessing: function(data)
                {       
                    source.totalrecords = data[0].TotalRows;
                    
                },
                 sort: function () {
                // update the grid and send a request to the server.
                $("#jqxgrid").jqxGrid('updatebounddata', 'sort');
                },
                filter: function (rowid, rowdata) {
                   // alert(1);
                    // update the grid and send a request to the server.
                    $(jqxgridid).jqxGrid('updatebounddata', 'filter');
                },
                updaterow: function (rowid, rowdata, commit) {
                    
                //    // alert(1);
                //     // synchronize with the server - send update command
                //     var data = "update=true&" + $.param(rowdata);
                //     var id = rowdata.id;
                //     var status = rowdata.enquiry_status;
                //    // var notes = rowdata.notes;
                   

                //     $.ajaxq('queue',{
                //     url: '/admin/enquiryupdate',
                //     type: "POST",
                //     dataType: 'json',
                //     data: {'id': id, 'status': status},
                //     success: function (data, textStatus, jqXHR) {
                //         if(data.success == 1)
                //         {
                //           $("#jqxgrid").jqxGrid('updatebounddata');

                //         }
                //     }
                // });

                    },
                
            };

            var dataAdapter = new $.jqx.dataAdapter(source);
            //alert(source);

            // initialize jqxGrid
            $(jqxgridid).jqxGrid(
            {
                width: '100%',
                height: 400,
                source: dataAdapter,
                theme: theme,
                editable: true,
                showfilterrow: true,
                filterable: true,
                sortable: true,
                pageable: true,
                pagesize: 50,
                //selectionmode: 'checkbox',
                //selectionmode: 'none',
                pagesizeoptions: ['50', '100','500'],
                virtualmode: true,
                rendergridrows: function()
                {
                      return dataAdapter.records;     
                },
                
                columns: [
                    { text: 'Item ID', datafield: 'id', width: 80 ,filtercondition : 'EQUAL', editable: false},
                    { text: 'Item Name', datafield: 'item_name', width: 110, editable: false},
                    { text: 'Item Type', datafield: 'item_type', width: 130,editable: false }, 
                    { text: 'units', datafield: 'units', width: 80,editable: false }, 
                    { text: 'Quantity', datafield: 'quantity', width: 100, editable: false},
                    { text: 'Order Id', datafield: 'order_id', width: 100, editable: false},
                    { text: 'Vendor Name', datafield: 'vendor_name', width: 200, editable: false},
                    //  { text: 'Status', datafield: 'enquiry_status', width: 100,  displayfield: 'enquiry_status', columntype: 'dropdownlist',
                    //     createeditor: function (row, value, editor) {
                    //         editor.jqxDropDownList({ source: enquirystatusAdapter, displayMember: 'status_title', valueMember: 'status_id' });
                    //     }
                    // },
                   
                    { text: 'Vendor Email', datafield: 'vendor_email', width: 100, editable: false},
                    
                    { text: 'Vendor Contact', datafield: 'vendor_contact', width: 100 ,editable: false},
                    { text: 'Item Added By', datafield: 'name', width: 150, editable: false},
                    { text: 'Created At', datafield: 'created_at', width: 150, filtercondition : 'CONTAINS', editable: false},
                    { text: 'Updated At', datafield: 'updated_at', width: 150,  filtercondition : 'CONTAINS',editable: false},
                    { text: 'Item Descrition', datafield: 'item_description', width: 200,editable: false},
                    
                    
                   ]
            });

        //trigger filter on notification button click
        $('body').on('click','.notif-filter',function(){
            set_filter($(this).data('filtercol'),$(this).data('filterval'));
        });

        $('body').on('click','.reset-filter',function(){
            $(jqxgridid).jqxGrid('clearfilters');
        });

        function set_filter(colname,val){
                var searchText = val;
                // $("#jqxgrid").jqxGrid('removefilter', 'firstname');
                var filtergroup = new $.jqx.filter();
                var filtervalue = searchText;
                var filtercondition = 'EQUAL';
                var filter = filtergroup.createfilter('stringfilter', filtervalue, filtercondition);
                // used when there are multiple filters on a grid column:
                var filter_or_operator = 1;
                // used when there are multiple filters on the grid:
                filtergroup.operator = 'or';
                filtergroup.addfilter(filter_or_operator, filter);
                //remove other filters
                $(jqxgridid).jqxGrid('addfilter', colname, filtergroup);
                $(jqxgridid).jqxGrid('applyfilters');     
        }            
        //trigger filter on notification button click

        });


     },//end user enquery grid
     order_grid : function(){
        var self = this;

        $(document).ready(function () {
            //alert(self.orderslist);
            var rawurl= self.orderlisturl;
            var fields=new Array('id','name','email');
            var jqxgridid='#jqxgrid';
           
            var source =
            {
                datatype: "json",
                cache: false,
                datafields: [
                    { name: 'id' },
                    { name: 'client_name' },
                    { name: 'customer_design'},
                    { name: 'design_name' },
                    { name: 'order_color' },
                    { name: 'color_name' },
                    { name: 'width' },
                    { name: 'yarn_length'},
                    { name: 'units' },  
                    { name: 'order_quantity' },
                    { name: 'total_sqmt'}, 
                    { name: 'quality_per_sqmt' },
                    { name :'remarks'}, 
                    { name: 'order_date' }, 
                    { name: 'delivery_date' },   
                    { name: 'created_at' }, 
                    { name: 'updated_at'} ,
                    { name: 'name'}
                               
                ],
                id: 'id',
                url: rawurl,
                root: 'Rows',
                beforeprocessing: function(data)
                {       
                    source.totalrecords = data[0].TotalRows;
                    
                },
                 sort: function () {
                // update the grid and send a request to the server.
                $("#jqxgrid").jqxGrid('updatebounddata', 'sort');
                },
                filter: function (rowid, rowdata) {
                   // alert(1);
                    // update the grid and send a request to the server.
                    $(jqxgridid).jqxGrid('updatebounddata', 'filter');
                },
                updaterow: function (rowid, rowdata, commit) {
                    
                //    // alert(1);
                //     // synchronize with the server - send update command
                //     var data = "update=true&" + $.param(rowdata);
                //     var id = rowdata.id;
                //     var status = rowdata.enquiry_status;
                //    // var notes = rowdata.notes;
                   

                //     $.ajaxq('queue',{
                //     url: '/admin/enquiryupdate',
                //     type: "POST",
                //     dataType: 'json',
                //     data: {'id': id, 'status': status},
                //     success: function (data, textStatus, jqXHR) {
                //         if(data.success == 1)
                //         {
                //           $("#jqxgrid").jqxGrid('updatebounddata');

                //         }
                //     }
                // });

                    },
                
            };

            var dataAdapter = new $.jqx.dataAdapter(source);
            //alert(source);

            // initialize jqxGrid
            $(jqxgridid).jqxGrid(
            {
                width: '100%',
                height: 400,
                source: dataAdapter,
                theme: theme,
                editable: true,
                showfilterrow: true,
                filterable: true,
                sortable: true,
                pageable: true,
                pagesize: 50,
                //selectionmode: 'checkbox',
                //selectionmode: 'none',
                pagesizeoptions: ['50', '100','500'],
                virtualmode: true,
                rendergridrows: function()
                {
                      return dataAdapter.records;     
                },
                 columns: [
                    { text: 'ID', datafield: 'id', width: 80 ,filtercondition : 'EQUAL', editable: false},
                    { text: 'Client Name', datafield: 'client_name', width: 110, editable: false},
                    { text: 'Customer Design', datafield: 'customer_design', width: 130,editable: false }, 
                    { text: 'Available Design', datafield: 'design_name', width: 120,editable: false }, 
                    { text: 'Order Color', datafield: 'order_color', width: 100, editable: false},
                    { text: 'Available Color', datafield: 'color_name', width: 100, editable: false},
                    { text: 'Width', datafield: 'width', width: 80, editable: false},
                   
                    { text: 'Length', datafield: 'yarn_length', width: 100, editable: false},
                    
                    { text: 'Units', datafield: 'units', width: 80 ,editable: false},
                    { text: 'Order Quantity', datafield: 'order_quantity', width: 100, editable: false},
                    { text: 'Total Sqmt', datafield: 'total_sqmt', width: 100, editable: false},
                    { text: 'Quality Per Sqmt', datafield: 'quality_per_sqmt', width: 100,editable: false},
                    { text: 'Order_date', datafield: 'order_date', width: 100,editable: false},
                    { text: 'Delivery Date', datafield: 'delivery_date', width: 100,editable: false},
                    { text: 'Remarks', datafield: 'remarks', width: 200,editable: false},
                    { text: 'Created By', datafield: 'name', width: 200,editable: false},
                    
                    
                   ]
            });

        //trigger filter on notification button click
        $('body').on('click','.notif-filter',function(){
            set_filter($(this).data('filtercol'),$(this).data('filterval'));
        });

        $('body').on('click','.reset-filter',function(){
            $(jqxgridid).jqxGrid('clearfilters');
        });

        function set_filter(colname,val){
                var searchText = val;
                // $("#jqxgrid").jqxGrid('removefilter', 'firstname');
                var filtergroup = new $.jqx.filter();
                var filtervalue = searchText;
                var filtercondition = 'EQUAL';
                var filter = filtergroup.createfilter('stringfilter', filtervalue, filtercondition);
                // used when there are multiple filters on a grid column:
                var filter_or_operator = 1;
                // used when there are multiple filters on the grid:
                filtergroup.operator = 'or';
                filtergroup.addfilter(filter_or_operator, filter);
                //remove other filters
                $(jqxgridid).jqxGrid('addfilter', colname, filtergroup);
                $(jqxgridid).jqxGrid('applyfilters');     
        }            
        //trigger filter on notification button click

        });


     },//end user enquery grid
    


}

