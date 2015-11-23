Ext.define('Forecaster.view.indicator.Pivot', {
    extend: 'Ext.pivot.Grid',
    xtype: 'pivot-grid',
    // controller: 'pivotlayout',

    // requires: [
    //     'Forecaster.store.pivot.Sales',
    //     'Forecaster.view.pivot.LayoutController'
    // ],

    title: 'Outline layout',
    collapsible: true,
    multiSelect: true,
    // height: 350,

    store: 'Facts',

    selModel: {
        type: 'rowmodel'
    },

    viewLayoutType: 'outline',

    // Set this to false if multiple dimensions are configured on leftAxis and
    // you want to automatically expand the row groups when calculations are ready.
    //startRowGroupsCollapsed: false,

    // Configure the aggregate dimensions. Multiple dimensions are supported.
    aggregate: [{
        dataIndex:  'value',
        header:     'Sum of value',
        aggregator: 'sum',
        width:      90
    }],

    // Configure the left axis dimensions that will be used to generate the grid rows
    leftAxis: [{
        dataIndex:  'indicator',
//        header:     'Indicator',
        width:      90
    }],

    /**
     * Configure the top axis dimensions that will be used to generate the columns.
     * When columns are generated the aggregate dimensions are also used. If multiple aggregation dimensions
     * are defined then each top axis result will have in the end a column header with children
     * columns for each aggregate dimension defined.
     */
    topAxis: [{
        dataIndex:  'period',
        header:     'Period',
        width:      100
    }]



});    