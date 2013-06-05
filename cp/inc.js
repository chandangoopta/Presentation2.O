function load(){
	$.ajax({
		url:"parse_presentation_file.php",
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

function checkSlideStatus(){
	$.ajax({
		url:"slide.php",
		dataType:"json",
		success:function(data){
			if(checkSlideStatus.filename != data.presentationFilename || checkSlideStatus.slideId != data.presentationSlideId){
				load();
				checkSlideStatus.filename = data.presentationFilename;
				checkSlideStatus.slideId = data.presentationSlideId;
			}else if(checkSlideStatus.blockId != data.presentationBlockId){
				$.ajax({
					url:"parse_presentation_file.php",
					dataType:"json",
					success:function(data2){
						$("#content").append(data2.content[data.presentationBlockId]);
						checkSlideStatus.blockId = data.presentationBlockId;
					},
					error: function(jqXHR, textStatus, errorThrown) {
						requestError();
					}
				});
			}
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

			}else{
				alert('Slide could not be changed');
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
			requestError();
		}
	});
}
	
