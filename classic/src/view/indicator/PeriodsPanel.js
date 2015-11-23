Ext.define("Forecaster.view.indicator.PeriodsPanel",{
    extend: "Ext.tree.Panel",
    alias: 'widget.indicator-periodspanel',

    requires: [
        "Forecaster.view.indicator.PanelController",
        "Forecaster.view.indicator.PanelModel"
    ],

    controller: "indicator-panel",
    viewModel: {
        type: "indicator-panel"
    },

    bind: {

        title: '{name}'
        // ,
        // store: '{periods}'
    },

    store: 'Periods',

    // bind: {

    //     store: '{periods}'
    // },


    reserveScrollbar: true,
    rootVisible: false,

    columns: [
        // { xtype: 'treecolumn', text: 'Name', dataIndex: 'name', flex: 1, sortable: true},
        { xtype: 'treecolumn', text: 'Code', dataIndex: 'code', flex: 1 }
    ],

    initComponent: function() {

        var facts = this.getViewModel().get('facts'),
            formulas = this.getViewModel().get('formulas');
            
        if (!facts) { console.log('facts is null!'); }
        if (!formulas) { console.log('formulas is null!'); }
  
        // var store =  Ext.create('Ext.data.TreeStore', {

        // });

        // periods = Ext.getStore('Periods');

        // periods.load();


//         facts.source.load({
//             scope: this,
//             callback: function(records, operation, success) {
//                 // the operation object
//                 // contains all of the details of the load operation
//                 console.log(records);
//             }
//         });


 // debugger;
 //        periods.data.each(function(period) {
            
 //            console.log('period id - ' + period.getId());
 //        });

        fields = [];


      //  indicators.root = true;


        this.callParent(arguments);
    } // eo initComponent
});
