function load(){
	$.ajax({
		url:"cp/parse_presentation_file.php?loc=1",
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
		url:"cp/slide.php",
		dataType:"json",
		success:function(data){
			if(checkSlideStatus.blockId != data.presentationBlockId){
				checkSlideStatus.blockId = data.presentationBlockId;
				load();
			}else if(checkSlideStatus.filename != data.presentationFilename || checkSlideStatus.slideId != data.presentationSlideId){
				runDropEffect();
				load();
				checkSlideStatus.filename = data.presentationFilename;
				checkSlideStatus.slideId = data.presentationSlideId;
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
			</div>');
}

