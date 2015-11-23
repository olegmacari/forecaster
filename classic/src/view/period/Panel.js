
Ext.define("Forecaster.view.period.Panel",{
    extend: "Ext.tree.Panel",
    alias: 'widget.period-panel',

    requires: [
        "Forecaster.view.period.PanelController",
        "Forecaster.view.period.PanelModel"
    ],

    controller: "period-panel",
    viewModel: {
        type: "period-panel"
    },

    title: 'Periods',

    store: 'Periods',

    reserveScrollbar: true,
    rootVisible: false,

    columns: [
        { xtype: 'treecolumn', text: 'Code', dataIndex: 'code', flex: 1, sortable: true},
        { text: 'Type',  dataIndex: 'type' },
        { text: 'Year', dataIndex: 'year', flex: 1 }
    ]
});
