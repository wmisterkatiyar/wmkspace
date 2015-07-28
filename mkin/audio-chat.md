(function(pchat, $){
  
  pchat.initChatBoxes = function(config){
    
    var base_config = {
      verbose: false,
      socketUrl: "node.psccare.com:80",
      chatBoxClass: "chat-box",
	  highlightContainerClass:"chat-box-container",
	  highlightClass:"back-green"
    }
    config = $.extend({}, base_config, config);
    easyrtc.setSocketUrl(config.socketUrl);

    // step1: connect to server.
    easyrtc.connect("easyrtc.instantMessaging", 
      function(){
        config.verbose && console.log('connected: ' + easyrtc.myEasyrtcid);
        // step2: join all rooms specified in each chat box
        $("."+config.chatBoxClass).each(function(){
          roomName = $(this).data("room-id");
          config.verbose && console.log("joining room: " + roomName);
          easyrtc.joinRoom(roomName, null, null, null);
        });

        // step3: listen and update intended chat box
        function peerListener(who, msgType, content, targeting) {
          roomName = targeting.targetRoom;
          chatBox = $("."+config.chatBoxClass+"[data-room-id='"+roomName+"']");
          remoteName = $(chatBox).data("remote-name");
          $(chatBox).find("div").append( "<b>" + remoteName + "</b>: " + content + "<br>" );
		  // highlight chat container
		  $(chatBox).closest("."+config.highlightContainerClass).addClass(config.highlightClass);
        }
        easyrtc.setPeerListener(peerListener);

        // step4: type and post to intended room and current box
        function meListener(input, content){
          $(input).closest("."+config.chatBoxClass).find("div").append( "<b>Me</b>: " + content + "<br>" );
        }

        $("."+config.chatBoxClass+" input").on('keypress',function(e){
          if(e.which==13) {
            var sendText = $(this).val();
            var dest = {};
            dest.targetRoom = $(this).closest("."+config.chatBoxClass).data("room-id");
            if(sendText) {
              $(this).val("");
              meListener(this, sendText);
              easyrtc.sendDataWS(dest, "message", sendText, function(reply) {
                if (reply.msgType === "error") {
                  easyrtc.showError(reply.msgData.errorCode, reply.msgData.errorText);
                }
              });
            }
          }
        });
		
		// un-highlight current chat box container on click or on focus
		$("."+config.chatBoxClass+" input").on('click focus keypress',function(e){
			$(this).closest("."+config.highlightContainerClass).removeClass(config.highlightClass);
		});
      },function() { 
        config.verbose && console.log('connecting: ' + config.socketUrl);
      }
    );
  };
})(window.pchat = window.pchat || {}, jQuery);
