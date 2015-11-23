/**
 * @class Forecaster.model.Indicator
 * @extends Ext.data.Model
 * Description
 */
Ext.define('Forecaster.model.Indicator', {
    extend: 'Ext.data.TreeModel',

    fields: [
        {name: 'parent',        type: 'int',

            convert: function (value) {
                 return value == 0 ? null : value;
            }
        },
        {name: 'type',          type: 'string'},
        {name: 'code',          type: 'string'},
        {name: 'name',          type: 'string'},
        {name: 'beg_period',    type: 'int'},
        {name: 'end_period',    type: 'int'},
        {name: 'position',      type: 'int'},
        
        {name: 'p1',            reference: 'Fact'},
        {name: 'p2',            reference: 'Fact'},
        {name: 'p3',            reference: 'Fact'},
        {name: 'p4',            reference: 'Fact'},
        {name: 'p5',            reference: 'Fact'},
        {name: 'p6',            reference: 'Fact'},
        {name: 'p7',            reference: 'Fact'},
        {name: 'p8',            reference: 'Fact'},
        {name: 'p9',            reference: 'Fact'},
        {name: 'p10',           reference: 'Fact'},
        {name: 'p11',           reference: 'Fact'},
        {name: 'p12',           reference: 'Fact'},
        {name: 'p13',           reference: 'Fact'},
        {name: 'p14',           reference: 'Fact'},
        {name: 'p15',           reference: 'Fact'},
        {name: 'p16',           reference: 'Fact'},
        {name: 'p17',           reference: 'Fact'},
        {name: 'p18',           reference: 'Fact'},
        {name: 'p19',           reference: 'Fact'},
        {name: 'p20',           reference: 'Fact'},
        {name: 'p21',           reference: 'Fact'},
        {name: 'p22',           reference: 'Fact'},
        {name: 'p23',           reference: 'Fact'},
        {name: 'p24',           reference: 'Fact'},
        {name: 'p25',           reference: 'Fact'},
        {name: 'p26',           reference: 'Fact'},
        {name: 'p27',           reference: 'Fact'},
        {name: 'p28',           reference: 'Fact'},
        {name: 'p29',           reference: 'Fact'},
        {name: 'p30',           reference: 'Fact'},
        {name: 'p31',           reference: 'Fact'},
        {name: 'p32',           reference: 'Fact'},
        {name: 'p33',           reference: 'Fact'},
        {name: 'p34',           reference: 'Fact'},
        {name: 'p35',           reference: 'Fact'},
        {name: 'p36',           reference: 'Fact'}

    ],



    proxy: {
        type: 'ajax',
        url: 'app.php/indicators/update'
    },
    
    initComponent: function() {

      
        this.callParent(arguments);
    }

});