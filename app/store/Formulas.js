/**
 * @class Forecaster.store.Formulas
 * @extends Ext.data.Store
 * Description
 */
Ext.define('Forecaster.store.Formulas', {
    extend: 'Ext.data.Store',

    model: 'Forecaster.model.Formula',

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
            read:    'app.php/formulas/view',
            create:  'app.php/formulas/create',
            update:  'app.php/formulas/update',
            destroy: 'app.php/formulas/destroy'
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