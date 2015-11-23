Ext.define('Forecaster.view.indicator.PanelModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.indicator-panel',
    
    data: {
        name: 'Forecaster indicator Panel'
    },

    stores: {
        facts:   	'Facts',
        formulas:   'Formulas'
  //       indicators: 'Indicators',
  //       periods:    {
  //       	type: 'tree',
		//     model: 'Forecaster.model.Period',
		//     autoLoad: true,
		//     // autoSync: false,
		//     // autoFilters: true,

		//     parentIdProperty: 'parent',

		//     proxy: {
		//         type: 'ajax',
		//         url: 'app.php/periods/view'
		//     },
	 //        reader: {
	 //            type: 'json',
	 //            successProperty: 'success',
	 //            rootProperty: 'data',
	 //            messageProperty: 'message'
	 //        }


		// }

    }    

});
