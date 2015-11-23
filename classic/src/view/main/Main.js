/**
 * This class is the main view for the application. It is specified in app.js as the
 * "mainView" property. That setting automatically applies the "viewport"
 * plugin causing this view to become the body element (i.e., the viewport).
 *
 * TODO - Replace this content of this view to suite the needs of your application.
 */
Ext.define('Forecaster.view.main.Main', {
    extend: 'Ext.tab.Panel',
    xtype: 'app-main',

    requires: [
        'Ext.plugin.Viewport',
        'Ext.window.MessageBox',

        'Forecaster.view.main.MainController',
        'Forecaster.view.main.MainModel',
        'Forecaster.view.main.List',
        'Forecaster.view.period.Panel',
        'Forecaster.view.indicator.Panel',
        'Forecaster.view.indicator.Pivot',
        'Forecaster.view.indicator.PeriodsPanel'
    ],

    controller: 'main',
    viewModel: 'main',

    ui: 'navigation',

    // tabBarHeaderPosition: 1,
    // titleRotation: 0,
    // tabRotation: 0,

    header: {
        layout: {
            align: 'stretchmax'
        },
        title: {
            bind: {
                text: '{name}'
            },
            flex: 0
        },
        iconCls: 'fa-th-list'
    },

    tabBar: {
        flex: 1,
        layout: {
            align: 'stretch',
            overflowHandler: 'none'
        }
    },

    responsiveConfig: {
        tall: {
            headerPosition: 'top'
        },
        wide: {
            headerPosition: 'left'
        }
    },

    defaults: {
        bodyPadding: 20,
        tabConfig: {
            plugins: 'responsive',
            responsiveConfig: {
                wide: {
                    iconAlign: 'left',
                    textAlign: 'left'
                },
                tall: {
                    iconAlign: 'top',
                    textAlign: 'center',
                    width: 120
                }
            }
        }
    },

    items: [{
        title: 'Home',
        iconCls: 'fa-home',
        // The following grid shares a store with the classic version's grid as well!
        items: [{
            xtype: 'mainlist'
        }]
    }, {
        title: 'Periods',
        iconCls: 'fa-calendar',
        // bind: {
        //     html: '{loremIpsum}'
        // }
        items: [{
            xtype: 'period-panel'
        }]
    }, {
        title: 'Indicators',
        iconCls: 'fa-line-chart',
        items: [{
            xtype: 'indicator-panel'
        }]
    }, {
        title: 'Settings',
        iconCls: 'fa-cog',
        items: [{
            xtype: 'indicator-periodspanel'
        }]
    }]
});
