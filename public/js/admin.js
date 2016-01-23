var admincontroller = {
    orderlisturl : '/admin/orderslist',
    
    //start payment transfer grid  
      order_list_grid : function(){
        var self = this;

        $(document).ready(function () {
            //alert(self.offlinebookingrequesturl);
            var rawurl= self.orderlisturl;
            var fields=new Array('id');
            var jqxgridid='#jqxgrid';
           
            var source =
            {
                datatype: "json",
                cache: false,
                datafields: [
                    { name: 'id',type: 'number' },
                    { name: 'client_id'},
                    { name: 'customer_design'},
                    { name: 'available_design' },
                    { name: 'order_color' },
                    { name: 'available_color' },
                    { name: 'width' },
                    { name: 'length'},
                    { name: 'unit' },  
                    { name: 'order_quantity' },
                    { name: 'total_sqmt'}, 
                    { name: 'quality_per_sqmt' },
                    { name :'remarks'}, 
                    { name: 'order_date' }, 
                    { name: 'delivery_date' },   
                    { name: 'created_at' }, 
                    { name: 'updated_at'} 
                   
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
                    
                
                    },
                
            };

            var dataAdapter = new $.jqx.dataAdapter(source);
           // alert(dataAdapter);

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
               // selectionmode: 'checkbox',
                //selectionmode: 'none',
                pagesizeoptions: ['50', '100','500'],
                virtualmode: true,
                rendergridrows: function()
                {
                      return dataAdapter.records;     
                },
                columns: [
                    { text: 'Id', datafield: 'id', width: 50 ,filtercondition : 'EQUAL', editable: false},
                    { text: 'Client', datafield: 'client_id', width: 90 , editable: false},
                    { text: 'Customer Design', datafield: 'customer_design', width: 110, editable: false},
                    { text: 'Available Design', datafield: 'available_design', width: 130,editable: false }, 
                    { text: 'Order Color', datafield: 'order_color', width: 130,editable: false }, 
                    { text: 'Available Color', datafield: 'available_color', width: 130,editable: false },
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


     }
     //end payment transfer grid  

   

}