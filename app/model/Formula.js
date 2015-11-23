/**
 * @class Forecaster.model.Formula
 * @extends Ext.data.Model
 * Description
 */
Ext.define('Forecaster.model.Formula', {
    extend: 'Ext.data.Model',

    fields: [
        {name: 'period',        type: 'int'},
        {name: 'indicator',     type: 'int'},
        {name: 'expression',    type: 'string'}
    ]
});