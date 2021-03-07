
if(typeof console === 'undefined') console = {"log":function(m){}}
		pjax.connect({
			'tempat'     : 'ngisi',
			'cont' 		 : 'data-pjax',
			'beforeSend' : function(){
			    $("#pre-load").fadeIn();
			},
			'success': function(event){
				var url = (typeof event.data !== 'undefined') ? event.data.url : '';
				console.log("Successfully loaded "+ url);
				
	            $("#pre-load").fadeOut();
	            
	            
                
			},
			'error': function(event){
				var url = (typeof event.data !== 'undefined') ? event.data.url : '';
				console.log("Could not load "+ url);
			},
			'ready': function(){
				console.log("PJAX loaded!");
				

			}
		});