/**
 * @class Forecaster.store.Periods
 * @extends Ext.data.Store
 * Description
 */
Ext.define('Forecaster.store.Periods', {
    extend: 'Ext.data.TreeStore',

    model: 'Forecaster.model.Period',

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
            read:    'app.php/periods/view',
            create:  'app.php/periods/create',
            update:  'app.php/periods/update',
            destroy: 'app.php/periods/destroy'
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

});