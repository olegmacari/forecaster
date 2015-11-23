/**
 * @class Forecaster.model.Period
 * @extends Ext.data.Model
 * Description
 */
Ext.define('Forecaster.model.Period', {
    extend: 'Ext.data.TreeModel',

    fields: [
        {name: 'parent',        type: 'int',

            convert: function (value) {
                 return value == 0 ? null : value;
            }
        },
        {name: 'type',    		type: 'string'},
        {name: 'code',          type: 'string'},
        {name: 'year',          type: 'string'},
        {name: 'quarter',       type: 'string'},
        {name: 'month',         type: 'string'},
        {name: 'week',          type: 'string'},
        {name: 'day',           type: 'string'},
        {name: 'closed', 	    type: 'bool', defaultValue: false}
    ]
});