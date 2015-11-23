/**
 * @class Forecaster.model.Fact
 * @extends Ext.data.Model
 * Description
 */
Ext.define('Forecaster.model.Fact', {
    extend: 'Ext.data.Model',

    fields: [
        {name: 'period',        type: 'int'},
        {name: 'indicator',     type: 'int'},
        {name: 'goal',          type: 'float'},
        {name: 'opt_val',       type: 'float'},
        {name: 'est_val',       type: 'float'},
        {name: 'pes_val',       type: 'float'},
        {name: 'min_val',       type: 'float'},
        {name: 'max_val',       type: 'float'},
        {name: 'value',         type: 'float'},
        {name: 'formula',       type: 'string'}
    ]
});