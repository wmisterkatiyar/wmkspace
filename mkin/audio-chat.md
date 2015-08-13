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
    easyrtc.connect("easyrtc.audioVideoSimple", 
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

      // step5: video chat section
      
      // easyrtc.setVideoDims(1280,720);

      $("#hangupButton").click(function(){
        easyrtc.hangupAll();
      });

      easyrtc.initMediaSource(function (){
        easyrtc.setVideoObjectSrc( document.getElementById("selfVideo"), easyrtc.getLocalStream());
      });

      easyrtc.setStreamAcceptor( function(easyrtcid, stream) {
        var video = document.getElementById('callerVideo');
        easyrtc.setVideoObjectSrc(video,stream);
      });

      easyrtc.setOnStreamClosed( function (easyrtcid) {
        easyrtc.setVideoObjectSrc(document.getElementById('callerVideo'), "");
      });

      var successCB = function() {
      };

      var failureCB = function() {
      };
      
      var acceptedCB = function(accepted, easyrtcid) {
        if( !accepted ) {
          easyrtc.showError("CALL-REJECTEd", "Sorry, your call to " + easyrtc.idToName(easyrtcid) + " was rejected");
        }
      };

      function connect_room_media_stream(roomId){

        var users = easyrtc.getRoomOccupantsAsArray("room_meeting_001");
        users.splice(users.indexOf(easyrtc.myEasyrtcid),1);
        if( users[0] ) {
          otherEasyrtcid = users[0];
          easyrtc.hangupAll();
          easyrtc.call(otherEasyrtcid, successCB, failureCB, acceptedCB);
        } else {
          alert('user is offline..');
        }
      }
      
      $("."+config.chatBoxClass+" button").click(function(){
        roomId = $(this).closest(".chat-box").data("room-id");
        connect_room_media_stream(roomId);
      ;});

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
