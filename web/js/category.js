$(document).ready(function (){		
		$('#jstree_demo_div').jstree({ 
		'core' : {
			'data' : dataJsComponente
		},
		'checkbox': {
			three_state: false,
			cascade: 'up'
		},
		'plugins' : [ 'wholerow', 'checkbox' ]
		});		

	$('#jstree_demo_div').on("changed.jstree", function (e, data) {
		var dataTemplate = $('#products-template').val()
		dataTemplate = JSON.parse(dataTemplate);
		
		var objetNew = []
		
		data.selected.forEach(function(element){
			//var newTax = new Object();
			//newTax.id = element
			objetNew.push(element)
		});
		dataTemplate.taxonomy = objetNew
		
		$('#products-template').val(JSON.stringify(dataTemplate))	
	})
})