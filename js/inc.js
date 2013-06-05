function load(){
	$.ajax({
		url:"cp/parse_presentation_file.php",
		dataType:"json",
		success:function(data){
			runDropEffect();
			var html = Mustache.to_html(template, data);
			$("#header-content").html(data.header);
			$("#body").html(html);
		},
		error: function(jqXHR, textStatus, errorThrown) {
			requestError();
		}
	});
}

function checkSlideStatus(){
	$.ajax({
		url:"cp/slide.php",
		dataType:"json",
		success:function(data){
			if(checkSlideStatus.filename != data.presentationFilename || checkSlideStatus.slideId != data.presentationSlideId){
				load();
				checkSlideStatus.filename = data.presentationFilename;
				checkSlideStatus.slideId = data.presentationSlideId;
			}else if(checkSlideStatus.blockId != data.presentationBlockId){
				$.ajax({
					url:"cp/parse_presentation_file.php",
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

function init(){
	var appTimer = setInterval(function(){
		checkSlideStatus();
	},1000);
}


function runDropEffect() {
	// run the effect
	var options = {};
	$( "#body" ).effect( 'drop', options, 500, callback );
};

// callback function to bring a hidden box back
function callback() {
	setTimeout(function() {
		$( "#body" ).removeAttr( "style" ).hide().fadeIn();
	}, 1000 );
};

function requestError(){
	$("#body").html('<div class="error">\
			<div class="error-before">:(</div>\
			<div class="error-text">Oops! Request could not be completed.</div>\
		</div>\
');
}

