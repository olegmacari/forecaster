/**
 * @class Forecaster.store.Indicators
 * @extends Ext.data.Store
 * Description
 */
Ext.define('Forecaster.store.Indicators', {
    extend: 'Ext.data.TreeStore',

    model: 'Forecaster.model.Indicator',

    autoLoad: true,
    autoSync: true,
    // sorters: [{
    //     property: 'position',
    //     direction: 'ASC'
    // }],
    autoFilters: true,

    parentIdProperty: 'parent',

    proxy: {
        type: 'ajax',
        api: {
            read:    'app.php/indicators/view',
            create:  'app.php/indicators/create',
            update:  'app.php/indicators/update',
            destroy: 'app.php/indicators/destroy'
        },
        reader: {
            type: 'json',
            successProperty: 'success',
            rootProperty: 'data',
            messageProperty: 'message'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            rootProperty: 'data'
        },

        listeners: {
            exception: function(proxy, response, operation){
                Ext.MessageBox.show({
                    title: 'REMOTE EXCEPTION',
                    msg: operation.getError(),
                    icon: Ext.MessageBox.ERROR,
                    buttons: Ext.Msg.OK
                });
            }
        }
    }
    // ,

    // listeners: {
    //     load: function(store, records) {
    //             store.each(function(indicator) { console.log('indicator: ' + indicator.get('p1'));  

                    

    //         });

    //         console.log('on - load!');
    //     }
    // }


});