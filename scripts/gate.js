var Gate	= {
	max: function(ID) {
		$('#ship'+ID+'_input').val($('#ship'+ID+'_value').text().replace(/\./g, ""));
	},
	
	submit: function() {
		$.getJSON('?page=infos&gid=43&action=send&'+$('.jumpgate').serialize(), function(data) {
			if(data.error)
				Dialog.alert(data.message);
			else
				Dialog.alert(data.message, Dialog.close);
		});		
	},
}