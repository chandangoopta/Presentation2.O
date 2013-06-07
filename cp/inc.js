function load(){
	$.ajax({
		url:"parse_presentation_file.php?loc=0",
		dataType:"json",
		success:function(data){
			var html = Mustache.to_html(template, data);
			$("#body").html(html);
		},
		error: function(jqXHR, textStatus, errorThrown) {
			requestError();
		}
	});
}

function slide_action(key){
	$.ajax({
		url:"config_slide.php?action="+key,
		dataType:"json",
		success:function(data){
			if(data.status =="true"){
				load();
			}else{
				alert('Slide could not be changed');
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
			requestError();
		}
	});
}
