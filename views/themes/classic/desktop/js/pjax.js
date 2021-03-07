if(typeof console === 'undefined') console = {"log":function(m){}}
		pjax.connect({
			'pre-content': 'next-content',
			'beforeSend' : function(){
			    $("#page-lazy").show();
	            $(".pre-content").hide();
			},
			'success': function(event){
				var url = (typeof event.data !== 'undefined') ? event.data.url : '';
				console.log("Successfully loaded "+ url);
				$("#page-lazy").hide();
	            $(".pre-content").show();
	            
	            var imported = document.createElement('script');
                imported.src = '/execute/js/disqus.js';
                document.head.appendChild(imported);
                
                var imported = document.createElement('script');
                imported.src = '/execute/js/lazy.js';
                document.head.appendChild(imported);
                
			},
			'error': function(event){
				var url = (typeof event.data !== 'undefined') ? event.data.url : '';
				console.log("Could not load "+ url);
			},
			'ready': function(){
				console.log("PJAX loaded!");
			}
		});