
Ext.define("Forecaster.view.period.Panel",{
    extend: "Ext.grid.Grid",
    alias: 'widget.period-panel',

    requires: [
        "Forecaster.view.period.PanelController",
        "Forecaster.view.period.PanelModel"
    ],

    controller: "period-panel",
    viewModel: {
        type: "period-panel"
    }
    // ,

    // html: "Hello, Modern period.Panel!!"
});
