/**
 * @class Forecaster.store.Facts
 * @extends Ext.data.Store
 * Description
 */
Ext.define('Forecaster.store.Facts', {
    extend: 'Ext.data.Store',

    model: 'Forecaster.model.Fact',

    autoLoad: true,
    autoSync: true,
    // sorters: [{
    //     property: 'position',
    //     direction: 'ASC'
    // }],
    autoFilters: true,

    proxy: {
        type: 'ajax',
        api: {
            read:    'app.php/facts/view',
            create:  'app.php/facts/create',
            update:  'app.php/facts/update',
            destroy: 'app.php/facts/destroy'
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