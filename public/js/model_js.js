 
 function upperFirstletter(str){
 	return str[0].toUpperCase() + str.substring(1);
 }

 function build_form_inputs(){
	let build = '';
	let fldNames = model_js_mess['fldNames'];

	build ='<form class="form-horizontal" role="form">'; 	
  	for (var i = 0; i < fldNames.length; i++) {
        build +='<div class="form-group">'+
                '<label class="col-sm-3 control-label" for="textinput">'+upperFirstletter(fldNames[i])+'</label>'+
                '<div class="col-sm-8">'+
                '<input type="text" id="'+fldNames[i]+'" placeholder="'+fldNames[i]+'" class="form-control">'+
            	'</div>'+
          		'</div>';
  	}
 	build += '</form>';
    return build;
 } 

function ezBSAlert (options) {
	var deferredObject = $.Deferred();
	var defaults = {
		type: "alert", //alert, prompt,confirm 
		modalSize: 'modal-sm', //modal-sm, modal-lg
		okButtonText: 'Ok',
		cancelButtonText: 'Cancel',
		yesButtonText: 'Yes',
		noButtonText: 'No',
		headerText: 'Attention',
		messageText: 'Message',
		alertType: 'default', //default, primary, success, info, warning, danger
		inputFieldType: 'text', //could ask for number,email,etc
	}
	$.extend(defaults, options);
  
	var _show = function(){
		var headClass = "navbar-default";
		console.log('headClass', headClass, ' | ',defaults.alertType);
		switch (defaults.alertType) {
			case "primary":
				headClass = "alert-primary";
				break;
			case "success":
				headClass = "alert-success";
				break;
			case "info":
				headClass = "alert-info";
				break;
			case "warning":
				headClass = "alert-warning";
				break;
			case "danger":
				headClass = "alert-danger";
				break;
        }
		$('BODY').append(
			'<div id="ezAlerts" class="modal fade">' +
			'<div class="modal-dialog" class="' + defaults.modalSize + '">' +
			'<div class="modal-content">' +
			'<div id="ezAlerts-header" class="modal-header ' + headClass + '">' +
			'<button id="close-button" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>' +
			'<h4 id="ezAlerts-title" class="modal-title">Modal title</h4>' +
			'</div>' +
			'<div id="ezAlerts-body" class="modal-body">' +
			'<div id="ezAlerts-message" ></div>' +
			'</div>' +
			'<div id="ezAlerts-footer" class="modal-footer"  style="padding:10px;">' +
			'</div>' +
			'</div>' +
			'</div>' +
			'</div>'
		);

		$('.modal-header').css({
			'padding': '15px 15px',
			'-webkit-border-top-left-radius': '5px',
			'-webkit-border-top-right-radius': '5px',
			'-moz-border-radius-topleft': '5px',
			'-moz-border-radius-topright': '5px',
			'border-top-left-radius': '5px',
			'border-top-right-radius': '5px'
		});

		/* change model header colors */
		$('.alert-primary').css({
    		'background-color': '#428BCA',
    		'color' : '#fff'
		});

		$('.alert-danger').css({
    		'background-color': '#D9534F',
    		'color' : '#fff'
		});
    
		$('#ezAlerts-title').text(defaults.headerText);
		$('#ezAlerts-message').html(defaults.messageText);

		var keyb = "false", backd = "static";
		var calbackParam = "";
		switch (defaults.type) {
			case 'alert':
				keyb = "true";
				backd = "true";
				$('#ezAlerts-footer').html('<button class="btn btn-' + defaults.alertType + '">' + defaults.okButtonText + '</button>').on('click', ".btn", function () {
					calbackParam = true;
					$('#ezAlerts').modal('hide');
				});
				break;
			case 'confirm':
				var btnhtml = '<button id="ezok-btn" class="btn btn-primary">' + defaults.yesButtonText + '</button>';
				if (defaults.noButtonText && defaults.noButtonText.length > 0) {
					btnhtml += '<button id="ezclose-btn" class="btn btn-default">' + defaults.noButtonText + '</button>';
				}
				$('#ezAlerts-footer').html(btnhtml).on('click', 'button', function (e) {
						if (e.target.id === 'ezok-btn') {
							calbackParam = true;
							$('#ezAlerts').modal('hide');
						} else if (e.target.id === 'ezclose-btn') {
							calbackParam = false;
							$('#ezAlerts').modal('hide');
						}
					});
				break;

			case 'myForm':
				var btnhtml = '<button id="ezclose-btn" class="btn btn-default"> Cancel </button>';
					btnhtml += '<button id="ezok-btn" class="btn btn-primary"> Submit </button>';

				$('#ezAlerts-footer').html(btnhtml).on('click', 'button', function (e) {
						if (e.target.id === 'ezok-btn') {
							calbackParam = true;
							$('#ezAlerts').modal('hide');
						} else if (e.target.id === 'ezclose-btn') {
							calbackParam = false;
							$('#ezAlerts').modal('hide');
						}
					});
				break;

			case 'prompt':
				$('#ezAlerts-message').html(defaults.messageText + '<br /><br /><div class="form-group"><input type="' + defaults.inputFieldType + '" class="form-control" id="prompt" /></div>');
				$('#ezAlerts-footer').html('<button class="btn btn-primary">' + defaults.okButtonText + '</button>').on('click', ".btn", function () {
					calbackParam = $('#prompt').val();
					$('#ezAlerts').modal('hide');
				});
				break;
		}
   
		$('#ezAlerts').modal({ 
          show: false, 
          backdrop: backd, 
          keyboard: keyb 
        }).on('hidden.bs.modal', function (e) {
			$('#ezAlerts').remove();
			deferredObject.resolve(calbackParam);
		}).on('shown.bs.modal', function (e) {
			if ($('#prompt').length > 0) {
				$('#prompt').focus();
			}
		}).modal('show');
	}
    
  _show();  
  return deferredObject.promise();    
}


$(document).ready(function(){
  $("#btnAlert").on("click", function(){  	
    var prom = ezBSAlert({
      messageText: "hello world",
      alertType: "danger"
    }).done(function (e) {
      $("body").append('<div>Callback from alert</div>');
    });
  });   

  $("#btnPrompt").on("click", function(){  	
    ezBSAlert({
      type: "prompt",
      messageText: "Enter Something",
      alertType: "primary"
    }).done(function (e) {
      ezBSAlert({
        messageText: "You entered: " + e,
        alertType: "success"
      });
    });
  });   

// ================================
// similar behavior as an HTTP redirect
// window.location.replace("http://stackoverflow.com");
// similar behavior as clicking on a link
// window.location.href = "http://stackoverflow.com";

  $(".btnConfirm").on("click", function(e){ 
	e.preventDefault();
	console.log( this.id);
    var btnName = (this.id).split('-');
   	var messText  = model_js_mess[btnName[0]]; 
	var href = $(this).attr('href');

    ezBSAlert({
      type: "confirm",
      messageText: messText,
      alertType: btnName[1]
    }).done(function (e) {
      // console.log('href '+href);	
	  if( e ) window.location.replace( href );	  	
    });
  });   

  $(".btnSubmitForm").on("click", function(e){ 
	e.preventDefault();

	let myHeader = this.id;
    let myBuild = '';
    myBuild = build_form_inputs();

    ezBSAlert({
      type: "myForm",
      messageText: myBuild,
      headerText : myHeader,
      alertType: "primary"
    }).done(function (e) {
      // console.log('href '+href);	
	  if( e ) window.location.replace( href );	  	
    });
  });   

  
//==================================

  
});