
Ext.define("Forecaster.view.indicator.Panel",{
    extend: "Ext.tree.Panel",
    alias: 'widget.indicator-panel',

    requires: [
        "Forecaster.view.indicator.PanelController",
        "Forecaster.view.indicator.PanelModel"
    ],

    controller: "indicator-panel",
    viewModel: {
        type: "indicator-panel"
    },

    title: 'Indicators',
    // width: 1000,
    // height: 600,
    store: 'Indicators',

    reserveScrollbar: true,
    rootVisible: false,

    columns: [
        { xtype: 'treecolumn', text: 'Name', dataIndex: 'name', width: 250, sortable: false, editor: 'textfield'},
        // { text: 'Type',  dataIndex: 'type' },
        // { text: 'Code', dataIndex: 'code', flex: 1 },
        { text: 'Year 1', columns: [
                {text: '01', dataIndex: 'p1',  renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '02', dataIndex: 'p2',  renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '03', dataIndex: 'p3',  renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '04', dataIndex: 'p4',  renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '05', dataIndex: 'p5',  renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '06', dataIndex: 'p6',  renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '07', dataIndex: 'p7',  renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '08', dataIndex: 'p8',  renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '09', dataIndex: 'p9',  renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '10', dataIndex: 'p10', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '11', dataIndex: 'p11', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '12', dataIndex: 'p12', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1}
            ]},
        { text: 'Year 2', columns: [
                {text: '01', dataIndex: 'p13', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '02', dataIndex: 'p14', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '03', dataIndex: 'p15', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '04', dataIndex: 'p16', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '05', dataIndex: 'p17', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '06', dataIndex: 'p18', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '07', dataIndex: 'p19', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '08', dataIndex: 'p20', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '09', dataIndex: 'p21', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '10', dataIndex: 'p22', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '11', dataIndex: 'p23', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '12', dataIndex: 'p24', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1}
            ]},
        { text: 'Year 3', columns: [
                {text: '01', dataIndex: 'p25', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '02', dataIndex: 'p26', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '03', dataIndex: 'p27', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '04', dataIndex: 'p28', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '05', dataIndex: 'p29', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '06', dataIndex: 'p30', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '07', dataIndex: 'p31', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '08', dataIndex: 'p32', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '09', dataIndex: 'p33', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '10', dataIndex: 'p34', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '11', dataIndex: 'p35', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1},
                {text: '12', dataIndex: 'p36', renderer: function(cell){ if (cell) return Ext.getStore('Facts').getById(cell).get('value') }, align: 'right', flex: 1}
            ]}
    ],

    tbar: [
    {
        itemId: 'add-button',
        text: 'Add Indicator',
        handler: function(button) {
            // Go up from the view to the owning TreePanel
           var panel = button.up('indicator-panel');
           panel.addClick();
        }
    },{
        itemId: 'del-button',
        text: 'Delete Indicator',
        handler: function(button) {
            // Go up from the view to the owning TreePanel
           var panel = button.up('indicator-panel');
           panel.delClick();
        }
    }
    ],

    selModel: {
        allowDeselect: true
    },
    
    plugins: [{
        ptype: 'cellediting',
        clicksToEdit: 2
    }],

    addClick: function() {

        var target = this.selModel.getSelection()[0] || this.getRootNode(),
        node;

        store = Ext.getStore('Indicators');
        store.autoSync = false;

        node = {//Forecaster.model.Indicator.create({
            parent: '',
            name: 'nnn',
            type: '',
            code: '',
            leaf: true
        }; 
        
        if (target.isRoot()) {
            node.children = [];
        } else {
            node.parent = target.getId();
        } 

        node = target.appendChild(node, true);

        if (!target.isExpanded()) {
            target.expand(false);
        }

        store.sync();
        store.autoSync = true;

        this.selModel.select(node);
    },

    delClick: function() {

        var target = this.selModel.getSelection()[0] || this.getRootNode();

        // store = Ext.getStore('Indicators');
        // store.autoSync = false;

        target.erase();

        // store.sync();
        // store.autoSync = true;
    },

    getValue: function(cell) {

        return Ext.getStore('Facts').getById(cell).get('value'); 
    }
});
